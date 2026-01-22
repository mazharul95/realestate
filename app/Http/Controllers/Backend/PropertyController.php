<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Property;
use App\Models\MultiImage;
use App\Models\Facility;
use App\Models\Amenities;
use App\Models\PropertyType;
use App\Models\User;
use Intervention\Image\Facades\Image;
use Haruncpi\LaravelIdGenerator\IdGenerator;
use Carbon\Carbon;

class PropertyController extends Controller
{
    public function AllProperty(){
        $property = Property::latest()->get();
        return view('backend.property.indexProperty',compact('property'));
    } // End Method

    public function AddProperty(){
        $propertytype = PropertyType::latest()->get();
        $amenities = Amenities::latest()->get();
        $activeAgent = User::where('status','active')->where('role','agent')->latest()->get();
        return view('backend.property.addEditProperty',compact('propertytype','amenities','activeAgent'));
    }// End Method

    // Store New Property
    public function StoreProperty(Request $request)
    {
//        $request->validate([
//            'property_name' => 'required',
//            'property_status' => 'required',
//            'lowest_price' => 'required',
//            'max_price' => 'required',
//            'main_thumbnail' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
//        ]);

        $amen =$request->amenities_id;
        $amenites =implode(",",$amen);
       // dd($amenities);

        $pcode = IdGenerator::generate(['table' => 'properties',
            'field' => 'property_code','length' => 5, 'prefix' => 'PC' ]);

        if ($request->hasFile('property_thambnail')) {
            $image = $request->file('property_thambnail');
            $name_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();

            // Define the path
            $save_path = public_path('upload/property/thambnail/');

            // Auto-create directory if it's missing
            if (!file_exists($save_path)) {
                mkdir($save_path, 0777, true);
            }
            // Save image
            Image::make($image)->resize(370,250)->save($save_path.$name_gen);
            $save_url = 'upload/property/thambnail/'.$name_gen;
        }

        $property_id = Property::insert([
            'ptype_id' => $request->ptype_id,
            'amenities_id' => $amenites,
            'property_name' => $request->property_name,
            'property_slug' => strtolower(str_replace(' ', '-', $request->property_name)),
            'property_code' => $pcode,
            'property_status' => $request->property_status,

            'lowest_price' => $request->lowest_price,
            'max_price' => $request->max_price,
            'short_descp' => $request->short_descp,
            'long_descp' => $request->long_descp,
            'bedrooms' => $request->bedrooms,
            'bathrooms' => $request->bathrooms,
            'garage' => $request->garage,
            'garage_size' => $request->garage_size,

            'property_size' => $request->property_size,
            'property_video' => $request->property_video,
            'address' => $request->address,
            'city' => $request->city,
            'state' => $request->state,
            'postal_code' => $request->postal_code,

            'neighborhood' => $request->neighborhood,
            'latitude' => $request->latitude,
            'longitude' => $request->longitude,
            'featured' => $request->featured,
            'hot' => $request->hot,
            'agent_id' => $request->agent_id,
            'status' => 'active',
            'property_thambnail' => $save_url,
            'created_at' => Carbon::now(),
        ]);

        /// start Multiple Image Upload From Here ////

        if ($request->hasFile('multi_img')) {
            $images = $request->file('multi_img');
            $save_path = public_path('upload/property/multi-image/');
            if (!file_exists($save_path)) {
                mkdir($save_path, 0777, true);
            }
            foreach ($images as $img) {
                $make_name = hexdec(uniqid()) . '.' . $img->getClientOriginalExtension();
                Image::make($img)->resize(770, 520)->save($save_path . $make_name);
                $uploadPath = 'upload/property/multi-image/' . $make_name;

                MultiImage::insert([
                    'property_id' => $property_id,
                    'photo_name'  => $uploadPath,
                    'created_at'  => Carbon::now(),
                ]);
            }
        } // End Foreach
        /// End Multiple Image Upload From Here ////

        /// Facilities Add From Here ////
        $facilities = Count($request->facility_name);

        if ($facilities != NULL) {
            for ($i=0; $i < $facilities; $i++) {
                $fcount = new Facility();
                $fcount->property_id = $property_id;
                $fcount->facility_name = $request->facility_name[$i];
                $fcount->distance = $request->distance[$i];
                $fcount->save();
            }
        }
        /// End Facilities  ////


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
