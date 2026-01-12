<?php
namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PropertyType;

class PropertyTypeController extends Controller
{
    public function AllType()
    {
        $types = PropertyType::latest()->get();
        return view('backend.type.all_type', compact('types'));
    }

    public function AddType()
    {
        $lastIcon = PropertyType::orderBy('id', 'desc')->value('type_icon');
        if ($lastIcon && preg_match('/Icon-(\d+)/', $lastIcon, $matches)) {
            $nextNumber = (int) $matches[1] + 1;
        } else {
            $nextNumber = 1;
        }
        $nextTypeIcon = 'Icon-' . $nextNumber;

        return view('backend.type.addEditTypePage', compact('nextTypeIcon'));
    }

    public function StoreType(Request $request)
    {
        DB::transaction(function () use ($request) {

            $request->validate([
                'type_name' => 'required|unique:property_types|max:200',
                'type_icon' => 'required|unique:property_types,type_icon',
            ]);

            PropertyType::create([
                'type_name' => $request->type_name,
                'type_icon' => $request->type_icon,
                'status' => 'active'
            ]);
        });

        return redirect()->route('all.type')->with([
            'message' => 'Property Type Create Successfully',
            'alert-type' => 'success'
        ]);
    }// End Method

    public function EditType($id)
    {
        $types = PropertyType::findOrFail($id);
        return view('backend.type.addEditTypePage', compact('types'));
    }// End Method

    public function UpdateType(Request $request)
    {
        $pid = $request->id;
        PropertyType::findOrFail($pid)->update([
            'type_name' => $request->type_name,
            'type_icon' => $request->type_icon,
        ]);

        $notification = array(
            'message' => 'Property Type Updated Successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('all.type')->with($notification);

    }// End Method

    // Combined Delete Function
    public function DeleteType($id)
    {
        PropertyType::findOrFail($id)->update([
            'status' => 'inactive'
        ]);

        $notification = [
            'message' => 'Property Type Deleted Successfully',
            'alert-type' => 'success'
        ];

        return redirect()->back()->with($notification);
    }

}
