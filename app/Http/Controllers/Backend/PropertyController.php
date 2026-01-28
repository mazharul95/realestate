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
use Illuminate\Support\Facades\File;

class PropertyController extends Controller
{
    public function AllProperty(){
        $property = Property::latest()->get();
        return view('backend.property.indexProperty',compact('property'));
    } // End Method

    public function AddProperty(){
        // Create a new empty property instance
        $property = new Property();
        $propertytype = PropertyType::latest()->get();
        $amenities = Amenities::latest()->get();
        $activeAgent = User::where('status','active')->where('role','agent')->latest()->get();

        // For add mode, set empty values
        $property_ami = [];
        $multiImage = collect();
        $facilities = collect();

        return view('backend.property.addEditProperty',compact('property','propertytype','property_ami','amenities','activeAgent','multiImage','facilities'));
    }// End Method

    // Store New Property
    public function StoreProperty(Request $request)
    {
        $request->validate([
            'property_name' => 'required',
            'property_status' => 'required',
            'lowest_price' => 'required',
            'max_price' => 'required',
            'property_thambnail' => 'required|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
        ]);

        $amen = $request->amenities_id;
        $amenites = implode(",",$amen);

        $pcode = IdGenerator::generate(['table' => 'properties',
            'field' => 'property_code','length' => 5, 'prefix' => 'PC' ]);

        // Handle Main Thumbnail
        $save_url = '';
        if ($request->hasFile('property_thambnail')) {
            $image = $request->file('property_thambnail');
            $name_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
            $save_path = public_path('upload/property/thambnail/');

            // Create directory if it doesn't exist
            if (!file_exists($save_path)) {
                mkdir($save_path, 0777, true);
            }

            Image::make($image)->resize(370,250)->save($save_path.$name_gen);
            $save_url = 'upload/property/thambnail/'.$name_gen;
        }

        // Insert Property
        $property_id = Property::insertGetId([
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

        /// Multiple Image Upload - FIXED VERSION
        if ($request->hasFile('multi_img')) {
            $images = $request->file('multi_img');
            $save_path = public_path('upload/property/multi-image/');

            // Create directory if it doesn't exist
            if (!file_exists($save_path)) {
                mkdir($save_path, 0777, true);
            }

            foreach ($images as $img) {
                // Validate that $img is actually a file
                if ($img->isValid()) {
                    $make_name = hexdec(uniqid()) . '.' . $img->getClientOriginalExtension();

                    // Use the file directly, not the path
                    Image::make($img->getRealPath())->resize(770, 520)->save($save_path . $make_name);
                    $uploadPath = 'upload/property/multi-image/' . $make_name;

                    MultiImage::insert([
                        'property_id' => $property_id,
                        'photo_name'  => $uploadPath,
                        'created_at'  => Carbon::now(),
                    ]);
                }
            }
        }

        /// Facilities Add
        if ($request->facility_name != NULL) {
            $facilities = Count($request->facility_name);
            for ($i=0; $i < $facilities; $i++) {
                $fcount = new Facility();
                $fcount->property_id = $property_id;
                $fcount->facility_name = $request->facility_name[$i];
                $fcount->distance = $request->distance[$i];
                $fcount->save();
            }
        }

        $notification = array(
            'message' => 'Property Added Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('all.property')->with($notification);
    }

    public function EditProperty($id){
        $facilities = Facility::where('property_id',$id)->get();
        $property = Property::findOrFail($id);

        $type = $property->amenities_id;
        $property_ami = explode(',', $type);

        $multiImage = MultiImage::where('property_id',$id)->get();

        $propertytype = PropertyType::latest()->get();
        $amenities = Amenities::latest()->get();
        $activeAgent = User::where('status','active')->where('role','agent')->latest()->get();

        return view('backend.property.addEditProperty',compact('property','propertytype','amenities','activeAgent','property_ami', 'multiImage','facilities'));
    }// End Method

    // Update Property
    public function UpdateProperty(Request $request){
        $request->validate([
            'property_name' => 'required',
            'property_status' => 'required',
            'lowest_price' => 'required',
            'max_price' => 'required',
        ]);

        $amen = $request->amenities_id;
        $amenites = implode(",", $amen);

        $property_id = $request->id;

        Property::findOrFail($property_id)->update([
            'ptype_id' => $request->ptype_id,
            'amenities_id' => $amenites,
            'property_name' => $request->property_name,
            'property_slug' => strtolower(str_replace(' ', '-', $request->property_name)),
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
            'updated_at' => Carbon::now(),
        ]);

        $notification = array(
            'message' => 'Property Updated Successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('all.property')->with($notification);
    } // End Update Property

    public function UpdatePropertyThambnail(Request $request)
    {
        $pro_id = $request->id;
        $oldImage = $request->old_img;

        $image = $request->file('property_thambnail');
        $name_gen = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
        Image::make($image)->resize(370, 250)->save('upload/property/thambnail/' . $name_gen);
        $save_url = 'upload/property/thambnail/' . $name_gen;

        if (file_exists($oldImage)) {
            unlink($oldImage);
        }
        Property::findOrFail($pro_id)->update([
            'property_thambnail' => $save_url,
            'updated_at' => Carbon::now(),
        ]);

        $notification = array(
            'message' => 'Property Image Thambnail Updated Successfully',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    } // End Method

    public function UpdatePropertyMultiImage(Request $request)
    {
        if ($request->hasFile('multi_img')) {
            foreach ($request->file('multi_img') as $id => $img) {
                $imgDel = MultiImage::findOrFail($id);
                $path = public_path($imgDel->photo_name);
                if (file_exists($path)) {
                    unlink($path);
                }

                $make_name = hexdec(uniqid()).'.'.$img->getClientOriginalExtension();
                Image::make($img)->resize(770,520)->save('upload/property/multi-image/'.$make_name);
                $uploadPath = 'upload/property/multi-image/'.$make_name;

                MultiImage::where('id',$id)->update([
                    'photo_name' => $uploadPath,
                ]);
            }
        }

        $notification = [
            'message' => 'Property Multi Image Updated Successfully',
            'alert-type' => 'success'
        ];
        return redirect()->back()->with($notification);
    }

    public function PropertyMultiImageDelete($id)
    {
        $oldImg = MultiImage::findOrFail($id);
        unlink($oldImg->photo_name);

        MultiImage::findOrFail($id)->delete();

        $notification = array(
            'message' => 'Property Multi Image Deleted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }

    public function StoreNewMultiImage(Request $request){
        $new_multi = $request->imageid;
        $image = $request->file('multi_img');

        $make_name = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
        Image::make($image)->resize(770,520)->save('upload/property/multi-image/'.$make_name);
        $uploadPath = 'upload/property/multi-image/'.$make_name;

        MultiImage::insert([
            'property_id' => $new_multi,
            'photo_name' => $uploadPath,
            'created_at' => Carbon::now(),
        ]);

        $notification = array(
            'message' => 'Property Multi Image Added Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }// End Method

    public function UpdatePropertyFacilities(Request $request){
        $pid = $request->id;
        if ($request->facility_name == NULL) {
            return redirect()->back();
        }else{
            Facility::where('property_id',$pid)->delete();
            $facilities = Count($request->facility_name);

            for ($i=0; $i < $facilities; $i++) {
                $fcount = new Facility();
                $fcount->property_id = $pid;
                $fcount->facility_name = $request->facility_name[$i];
                $fcount->distance = $request->distance[$i];
                $fcount->save();
            }
        }

        $notification = array(
            'message' => 'Property Facility Updated Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }// End Method

    public function DeleteProperty($id)
    {
        $property = Property::findOrFail($id);
        unlink($property->property_thambnail);

        Property::findOrFail($id)->delete();

        $image = MultiImage::where('property_id', $id)->get();
        foreach ($image as $img) {
            unlink($img->photo_name);
            MultiImage::where('property_id', $id)->delete();
        }

        $facilitiesData = Facility::where('property_id', $id)->get();
        foreach ($facilitiesData as $item) {
            $item->facility_name;
            Facility::where('property_id', $id)->delete();
        }

        $notification = array(
            'message' => 'Property Deleted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }// End Method

    public function DetailsProperty($id)
    {

        $facilities = Facility::where('property_id', $id)->get();
        $property = Property::findOrFail($id);

        $type = $property->amenities_id;
        $property_ami = explode(',', $type);

        $multiImage = MultiImage::where('property_id', $id)->get();

        $propertytype = PropertyType::latest()->get();
        $amenities = Amenities::latest()->get();
        $activeAgent = User::where('status', 'active')->where('role', 'agent')->latest()->get();

        return view('backend.property.detailsProperty', compact('property', 'propertytype', 'amenities', 'activeAgent', 'property_ami', 'multiImage', 'facilities'));

    } //end method



}
