<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Property;
use App\Models\MultiImage;
use App\Models\Facility;

class PropertyController extends Controller
{
    public function AllProperty(){
        $property = Property::latest()->get();
        return view('backend.property.index_property',compact('property'));
    } // End Method
    public function AddProperty(){
        return view('backend.property.addEditProperty');
    }// End Method

    // Store New Property
    public function StoreProperty(Request $request)
    {
        $request->validate([
            'property_name' => 'required',
            'property_status' => 'required',
            'lowest_price' => 'required',
            'max_price' => 'required',
            'main_thumbnail' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Main Thumbnail Upload
        $image = $request->file('main_thumbnail');
        $name_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
        Image::make($image)->resize(370, 250)->save('upload/property/thumbnail/'.$name_gen);
        $save_url = 'upload/property/thumbnail/'.$name_gen;

        // Multiple Images Upload
        $multi_img = array();
        if($request->hasFile('multi_img')){
            $images = $request->file('multi_img');
            foreach($images as $img){
                $name_gen = hexdec(uniqid()).'.'.$img->getClientOriginalExtension();
                Image::make($img)->resize(770, 520)->save('upload/property/multi-image/'.$name_gen);
                $upload_path = 'upload/property/multi-image/'.$name_gen;
                array_push($multi_img, $upload_path);
            }
        }

        Property::insert([
            'property_name' => $request->property_name,
            'property_status' => $request->property_status,
            'lowest_price' => $request->lowest_price,
            'max_price' => $request->max_price,
            'main_thumbnail' => $save_url,
            'multi_img' => json_encode($multi_img),
            'city' => $request->city,
            'state' => $request->state,
            'zip' => $request->zip,
            'created_at' => now(),
        ]);

        $notification = array(
            'message' => 'Property Added Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('all.property')->with($notification);
    }

    // Show Edit Property Form
    public function EditProperty($id)
    {
        $property = Property::findOrFail($id);
        return view('admin.property.add_property', compact('property'));
    }

    // Update Property
    public function UpdateProperty(Request $request, $id)
    {
        $property = Property::findOrFail($id);

        $request->validate([
            'property_name' => 'required',
            'property_status' => 'required',
            'lowest_price' => 'required',
            'max_price' => 'required',
        ]);

        // Check if new main thumbnail is uploaded
        if($request->file('main_thumbnail')){
            // Delete old thumbnail
            if(File::exists($property->main_thumbnail)){
                File::delete($property->main_thumbnail);
            }

            // Upload new thumbnail
            $image = $request->file('main_thumbnail');
            $name_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
            Image::make($image)->resize(370, 250)->save('upload/property/thumbnail/'.$name_gen);
            $save_url = 'upload/property/thumbnail/'.$name_gen;

            $property->main_thumbnail = $save_url;
        }

        // Check if new multiple images are uploaded
        if($request->hasFile('multi_img')){
            // Delete old images
            $old_images = json_decode($property->multi_img);
            if($old_images){
                foreach($old_images as $old_img){
                    if(File::exists($old_img)){
                        File::delete($old_img);
                    }
                }
            }

            // Upload new images
            $multi_img = array();
            $images = $request->file('multi_img');
            foreach($images as $img){
                $name_gen = hexdec(uniqid()).'.'.$img->getClientOriginalExtension();
                Image::make($img)->resize(770, 520)->save('upload/property/multi-image/'.$name_gen);
                $upload_path = 'upload/property/multi-image/'.$name_gen;
                array_push($multi_img, $upload_path);
            }

            $property->multi_img = json_encode($multi_img);
        }

        // Update other fields
        $property->property_name = $request->property_name;
        $property->property_status = $request->property_status;
        $property->lowest_price = $request->lowest_price;
        $property->max_price = $request->max_price;
        $property->city = $request->city;
        $property->state = $request->state;
        $property->zip = $request->zip;
        $property->updated_at = now();
        $property->save();

        $notification = array(
            'message' => 'Property Updated Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('all.property')->with($notification);
    }

    // Delete Property
    public function DeleteProperty($id)
    {
        $property = Property::findOrFail($id);

        // Delete main thumbnail
        if(File::exists($property->main_thumbnail)){
            File::delete($property->main_thumbnail);
        }

        // Delete multiple images
        $images = json_decode($property->multi_img);
        if($images){
            foreach($images as $img){
                if(File::exists($img)){
                    File::delete($img);
                }
            }
        }

        $property->delete();

        $notification = array(
            'message' => 'Property Deleted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }

}
