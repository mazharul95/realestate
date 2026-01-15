<?php
namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\PropertyType;
use App\Models\Amenities;

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


    ///////////// Amenitites All Method //////////////
    public function AllAmenitie(){
        $amenities = Amenities::where('status', 'active')
            ->orderBy('id', 'DESC')
            ->get();
        return view('backend.amenities.all_amenities',compact('amenities'));

    } // End Method

    public function AddAmenitie(){
        return view('backend.amenities.addEditAmenities');
    }// End Method

    public function StoreAmenitie(Request $request)
    {
        // Validation
        $request->validate([
            'amenitis_name' => 'required|string|max:255|unique:amenities,amenitis_name',
        ],[
            'amenitis_name.required' => 'Amenity name is required',
            'amenitis_name.unique'   => 'This amenity already exists',
        ]);
        // Insert
        Amenities::create([
            'amenitis_name' => $request->amenitis_name,
            'status' => 'active'
        ]);
        $notification = [
            'message' => 'Amenities Create Successfully',
            'alert-type' => 'success'
        ];
        return redirect()->route('all.amenitie')->with($notification);
    }

    public function EditAmenitie($id){
        $amenities = Amenities::findOrFail($id);
        return view('backend.amenities.addEditAmenities', compact('amenities'));
    }// End Method

    public function UpdateAmenitie(Request $request){
        $ame_id = $request->id;
        Amenities::findOrFail($ame_id)->update([
            'amenitis_name' => $request->amenitis_name,
        ]);
        $notification = array(
            'message' => 'Amenities Updated Successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('all.amenitie')->with($notification);

    }// End Method

    // Combined Delete Function
    public function DeleteAmenitie($id)
    {
        $amenity = Amenities::findOrFail($id);
        $amenity->status = 'inactive';
        $amenity->save();

        $notification = [
            'message' => 'Amenities Deleted Successfully',
            'alert-type' => 'success'
        ];
        return redirect()->back()->with($notification);
    }

}
