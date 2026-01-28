@extends('admin.admin_dashboard')
@section('admin')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>

    <div class="page-content">
        <div class="row profile-body">
            <div class="col-md-12 col-xl-12 middle-wrapper">
                <div class="row">
                    <div class="card">
                        <div class="card-body">
                            <h6 class="card-title">{{ $property->exists ? 'Edit Property' : 'Add Property' }}</h6>

                            <form action="{{ $property->exists ? route('update.property') : route('store.property') }}" method="POST" enctype="multipart/form-data" id="myForm">
                                @csrf

                                @if($property->exists)
                                    <input type="hidden" name="id" value="{{ $property->id }}">
                                @endif

                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group mb-3">
                                            <label class="form-label">Property Name</label>
                                            <input type="text" name="property_name" class="form-control" value="{{ $property->property_name ?? old('property_name') }}">
                                        </div>
                                    </div>

                                    <div class="col-sm-6">
                                        <div class="form-group mb-3">
                                            <label class="form-label">Property Status</label>
                                            <select name="property_status" class="form-select" id="exampleFormControlSelect1">
                                                <option selected="" disabled="">Select Status</option>
                                                <option value="rent" {{ ($property->exists && $property->property_status == 'rent') ? 'selected' : '' }}>For Rent</option>
                                                <option value="buy" {{ ($property->exists && $property->property_status == 'buy') ? 'selected' : '' }}>For Buy</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-sm-6">
                                        <div class="form-group mb-3">
                                            <label class="form-label">Lowest Price</label>
                                            <input type="number" name="lowest_price" class="form-control" value="{{ $property->lowest_price ?? old('lowest_price') }}">
                                        </div>
                                    </div>

                                    <div class="col-sm-6">
                                        <div class="form-group mb-3">
                                            <label class="form-label">Max Price</label>
                                            <input type="number" name="max_price" class="form-control" value="{{ $property->max_price ?? old('max_price') }}">
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-sm-3">
                                        <div class="form-group mb-3">
                                            <label class="form-label">Bedrooms</label>
                                            <input type="text" name="bedrooms" class="form-control" value="{{ $property->bedrooms ?? old('bedrooms') }}">
                                        </div>
                                    </div>

                                    <div class="col-sm-3">
                                        <div class="form-group mb-3">
                                            <label class="form-label">Bathrooms</label>
                                            <input type="text" name="bathrooms" class="form-control" value="{{ $property->bathrooms ?? old('bathrooms') }}">
                                        </div>
                                    </div>

                                    <div class="col-sm-3">
                                        <div class="form-group mb-3">
                                            <label class="form-label">Garage</label>
                                            <input type="text" name="garage" class="form-control" value="{{ $property->garage ?? old('garage') }}">
                                        </div>
                                    </div>

                                    <div class="col-sm-3">
                                        <div class="form-group mb-3">
                                            <label class="form-label">Garage Size</label>
                                            <input type="text" name="garage_size" class="form-control" value="{{ $property->garage_size ?? old('garage_size') }}">
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-sm-3">
                                        <div class="form-group mb-3">
                                            <label class="form-label">Address</label>
                                            <input type="text" name="address" class="form-control" value="{{ $property->address ?? old('address') }}">
                                        </div>
                                    </div>

                                    <div class="col-sm-3">
                                        <div class="form-group mb-3">
                                            <label class="form-label">City</label>
                                            <input type="text" name="city" class="form-control" value="{{ $property->city ?? old('city') }}">
                                        </div>
                                    </div>

                                    <div class="col-sm-3">
                                        <div class="form-group mb-3">
                                            <label class="form-label">State</label>
                                            <input type="text" name="state" class="form-control" value="{{ $property->state ?? old('state') }}">
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="form-group mb-3">
                                            <label class="form-label">Postal Code</label>
                                            <input type="text" name="postal_code" class="form-control" value="{{ $property->postal_code ?? old('postal_code') }}">
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-sm-4">
                                        <div class="form-group mb-3">
                                            <label class="form-label">Property Size</label>
                                            <input type="text" name="property_size" class="form-control" value="{{ $property->property_size ?? old('property_size') }}">
                                        </div>
                                    </div>

                                    <div class="col-sm-4">
                                        <div class="form-group mb-3">
                                            <label class="form-label">Property Video</label>
                                            <input type="text" name="property_video" class="form-control" value="{{ $property->property_video ?? old('property_video') }}">
                                        </div>
                                    </div>

                                    <div class="col-sm-4">
                                        <div class="form-group mb-3">
                                            <label class="form-label">Neighborhood</label>
                                            <input type="text" name="neighborhood" class="form-control" value="{{ $property->neighborhood ?? old('neighborhood') }}">
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group mb-3">
                                            <label class="form-label">Latitude</label>
                                            <input type="text" name="latitude" class="form-control" value="{{ $property->latitude ?? old('latitude') }}">
                                            <a href="https://www.latlong.net/convert-address-to-lat-long.html" target="_blank">Go here to get Latitude from address</a>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group mb-3">
                                            <label class="form-label">Longitude</label>
                                            <input type="text" name="longitude" class="form-control" value="{{ $property->longitude ?? old('longitude') }}">
                                            <a href="https://www.latlong.net/convert-address-to-lat-long.html" target="_blank">Go here to get Longitude from address</a>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-sm-4">
                                        <div class="form-group mb-3">
                                            <label class="form-label">Property Type </label>
                                            <select name="ptype_id" class="form-select" id="exampleFormControlSelect1">
                                                <option selected="" disabled="">Select Type</option>
                                                @foreach($propertytype as $ptype)
                                                    <option value="{{ $ptype->id }}" {{ ($property->exists && $ptype->id == $property->ptype_id) ? 'selected' : '' }}>{{ $ptype->type_name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-sm-4">
                                        <div class="form-group mb-3">
                                            <label class="form-label">Property Amenities </label>
                                            <select name="amenities_id[]" class="js-example-basic-multiple form-select" multiple="multiple" data-width="100%">
                                                @foreach($amenities as $ameni)
                                                    <option value="{{ $ameni->id }}" {{ (in_array($ameni->id,$property_ami)) ? 'selected' : '' }}>
                                                        {{ $ameni->amenitis_name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-sm-4">
                                        <div class="form-group mb-3">
                                            <label class="form-label"> Agent </label>
                                            <select name="agent_id" class="form-select" id="exampleFormControlSelect1">
                                                <option selected="" disabled="">Select Agent</option>
                                                @foreach($activeAgent as $agent)
                                                    <option value="{{ $agent->id }}" {{ ($property->exists && $agent->id == $property->agent_id) ? 'selected' : '' }}>{{ $agent->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-sm-12">
                                    <div class="form-group mb-3">
                                        <label class="form-label">Short Description</label>
                                        <textarea name="short_descp" class="form-control" id="exampleFormControlTextarea1" rows="3">{{ $property->short_descp }}</textarea>
                                    </div>
                                </div>

                                <div class="col-sm-12">
                                    <div class="form-group mb-3">
                                        <label class="form-label">Long Description</label>
                                        <textarea class="form-control" name="long_descp" id="tinymceExample" rows="10">{{ $property->long_descp }}</textarea>
                                    </div>
                                </div>

                                {{-- Main Thumbnail Image (Only for Add Mode) --}}
                                @if(!$property->exists)
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="form-group mb-3">
                                            <label class="form-label">Main Thumbnail</label>
                                            <input type="file" name="property_thambnail" class="form-control" onChange="mainThamUrl(this)" id="image">
                                            <img src="" id="mainThmb">
                                        </div>
                                    </div>
                                </div>
                                @endif

                                {{-- Multi Images (Only for Add Mode) --}}
                                @if(!$property->exists)
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="form-group mb-3">
                                            <label class="form-label">Multi Images</label>
                                            <input type="file" name="multi_img[]" class="form-control" multiple="" id="multiImg">
                                            <div class="row" id="preview_img"></div>
                                        </div>
                                    </div>
                                </div>
                                @endif

                                {{-- Facilities Section (For both Add and Edit) --}}
                                <hr>
                                <h6 class="card-title">Property Facilities</h6>
                                <div class="row add_item">
                                    @if($property->exists && $facilities->count() > 0)
                                        @foreach($facilities as $item)
                                        <div class="whole_extra_item_add" id="whole_extra_item_add">
                                            <div class="whole_extra_item_delete" id="whole_extra_item_delete">
                                                <div class="container mt-2">
                                                    <div class="row">
                                                        <div class="form-group col-md-4">
                                                            <label for="facility_name">Facilities</label>
                                                            <select name="facility_name[]" id="facility_name" class="form-control">
                                                                <option value="">Select Facility</option>
                                                                <option value="Hospital" {{ $item->facility_name == 'Hospital' ? 'selected' : '' }}>Hospital</option>
                                                                <option value="SuperMarket" {{ $item->facility_name == 'SuperMarket' ? 'selected' : '' }}>Super Market</option>
                                                                <option value="School" {{ $item->facility_name == 'School' ? 'selected' : '' }}>School</option>
                                                                <option value="Entertainment" {{ $item->facility_name == 'Entertainment' ? 'selected' : '' }}>Entertainment</option>
                                                                <option value="Pharmacy" {{ $item->facility_name == 'Pharmacy' ? 'selected' : '' }}>Pharmacy</option>
                                                                <option value="Airport" {{ $item->facility_name == 'Airport' ? 'selected' : '' }}>Airport</option>
                                                                <option value="Railways" {{ $item->facility_name == 'Railways' ? 'selected' : '' }}>Railways</option>
                                                                <option value="Bus Stop" {{ $item->facility_name == 'Bus Stop' ? 'selected' : '' }}>Bus Stop</option>
                                                                <option value="Beach" {{ $item->facility_name == 'Beach' ? 'selected' : '' }}>Beach</option>
                                                                <option value="Mall" {{ $item->facility_name == 'Mall' ? 'selected' : '' }}>Mall</option>
                                                                <option value="Bank" {{ $item->facility_name == 'Bank' ? 'selected' : '' }}>Bank</option>
                                                            </select>
                                                        </div>
                                                        <div class="form-group col-md-4">
                                                            <label for="distance">Distance</label>
                                                            <input type="text" name="distance[]" id="distance" class="form-control" value="{{ $item->distance }}">
                                                        </div>
                                                        <div class="form-group col-md-4" style="padding-top: 20px">
                                                            <span class="btn btn-success btn-sm addeventmore"><i class="fa fa-plus-circle"> Add</i></span>
                                                            <span class="btn btn-danger btn-sm removeeventmore"><i class="fa fa-minus-circle"> Remove</i></span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        @endforeach
                                    @else
                                        {{-- Default empty facility row for Add mode --}}
                                        <div class="whole_extra_item_add" id="whole_extra_item_add">
                                            <div class="whole_extra_item_delete" id="whole_extra_item_delete">
                                                <div class="container mt-2">
                                                    <div class="row">
                                                        <div class="form-group col-md-4">
                                                            <label for="facility_name">Facilities</label>
                                                            <select name="facility_name[]" id="facility_name" class="form-control">
                                                                <option value="">Select Facility</option>
                                                                <option value="Hospital">Hospital</option>
                                                                <option value="SuperMarket">Super Market</option>
                                                                <option value="School">School</option>
                                                                <option value="Entertainment">Entertainment</option>
                                                                <option value="Pharmacy">Pharmacy</option>
                                                                <option value="Airport">Airport</option>
                                                                <option value="Railways">Railways</option>
                                                                <option value="Bus Stop">Bus Stop</option>
                                                                <option value="Beach">Beach</option>
                                                                <option value="Mall">Mall</option>
                                                                <option value="Bank">Bank</option>
                                                            </select>
                                                        </div>
                                                        <div class="form-group col-md-4">
                                                            <label for="distance">Distance</label>
                                                            <input type="text" name="distance[]" id="distance" class="form-control" placeholder="Distance (Km)">
                                                        </div>
                                                        <div class="form-group col-md-4" style="padding-top: 20px">
                                                            <span class="btn btn-success btn-sm addeventmore"><i class="fa fa-plus-circle"> Add</i></span>
                                                            <span class="btn btn-danger btn-sm removeeventmore"><i class="fa fa-minus-circle"> Remove</i></span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                </div>

                                <hr>

                                <div class="mb-3">
                                    <div class="form-check form-check-inline">
                                        <input type="checkbox" name="featured" value="1" class="form-check-input" id="checkInline1" {{ ($property->exists && $property->featured == '1') ? 'checked' : '' }}>
                                        <label class="form-check-label" for="checkInline1">
                                            Features Property
                                        </label>
                                    </div>

                                    <div class="form-check form-check-inline">
                                        <input type="checkbox" name="hot" value="1" class="form-check-input" id="checkInline" {{ ($property->exists && $property->hot == '1') ? 'checked' : '' }}>
                                        <label class="form-check-label" for="checkInline">
                                            Hot Property
                                        </label>
                                    </div>
                                </div>

                                <button type="submit" class="btn btn-primary">{{ $property->exists ? 'Update Property' : 'Add Property' }}</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- ONLY SHOW THESE SECTIONS IN EDIT MODE --}}
    @if($property->exists)

        <!--  /// Property Main Thumbnail Image Update //// -->
        <div class="page-content" style="margin-top: -35px;">
            <div class="row profile-body">
                <div class="col-md-12 col-xl-12 middle-wrapper">
                    <div class="row">
                        <div class="card">
                            <div class="card-body">
                                <h6 class="card-title">Edit Main Thumbnail Image</h6>

                                <form action="{{ route('update.property.thambnail') }}" method="POST" enctype="multipart/form-data" id="myForm">
                                    @csrf
                                    <input type="hidden" name="id" value="{{ $property->id }}">
                                    <input type="hidden" name="old_img" value="{{ $property->property_thambnail }}">

                                    <div class="row mb-3">
                                        <div class="form-group col-md-6">
                                            <label class="form-label">Main Thumbnail </label>
                                            <input type="file" name="property_thambnail" class="form-control" onChange="mainThamUrl(this)">
                                            <img src="" id="mainThmb">
                                        </div>

                                        <div class="form-group col-md-6">
                                            <label class="form-label">Current Image</label>
                                            <img src="{{ asset($property->property_thambnail) }}" style="width:100px; height:100px;">
                                        </div>
                                    </div>

                                    <button type="submit" class="btn btn-primary">Update Thumbnail</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!--  /// Property Multi Image Update //// -->
        <div class="page-content" style="margin-top: -35px;">
            <div class="row profile-body">
                <div class="col-md-12 col-xl-12 middle-wrapper">
                    <div class="row">
                        <div class="card">
                            <div class="card-body">
                                <h6 class="card-title">Edit Multi Image</h6>

                                <form action="{{ route('update.property.multiImage') }}" method="POST" enctype="multipart/form-data" id="myForm">
                                    @csrf

                                    <div class="table-responsive">
                                        <table class="table table-striped">
                                            <thead>
                                            <tr>
                                                <th>Sl</th>
                                                <th>Image</th>
                                                <th>Change Image</th>
                                                <th>Delete</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($multiImage as $key => $img)
                                                <tr>
                                                    <td>{{ $key + 1 }}</td>
                                                    <td class="py-1">
                                                        <img src="{{ asset($img->photo_name) }}" alt="image" style="width:50px; height:50px;">
                                                    </td>
                                                    <td>
                                                        <input type="file" class="form-control" name="multi_img[{{ $img->id }}]">
                                                    </td>
                                                    <td>
                                                        <input type="submit" class="btn btn-primary px-4" value="Update Image">
                                                        <a href="{{ route('property.multiimg.delete',$img->id) }}" class="btn btn-danger" id="delete">Delete</a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </form>

                                <form method="post" action="{{ route('store.new.multiImage') }}" id="myForm" enctype="multipart/form-data">
                                    @csrf
                                    <input type="hidden" name="imageid" value="{{ $property->id }}">

                                    <table class="table table-striped">
                                        <tbody>
                                        <tr>
                                            <td>
                                                <input type="file" class="form-control" name="multi_img">
                                            </td>
                                            <td>
                                                <input type="submit" class="btn btn-info px-4" value="Add Image">
                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    @endif
    {{-- END EDIT MODE ONLY SECTIONS --}}

    <!--========== Start of add multiple class with ajax ==============-->
    <div style="visibility: hidden">
        <div class="whole_extra_item_add" id="whole_extra_item_add">
            <div class="whole_extra_item_delete" id="whole_extra_item_delete">
                <div class="container mt-2">
                    <div class="row">
                        <div class="form-group col-md-4">
                            <label for="facility_name">Facilities</label>
                            <select name="facility_name[]" id="facility_name" class="form-control">
                                <option value="">Select Facility</option>
                                <option value="Hospital">Hospital</option>
                                <option value="SuperMarket">Super Market</option>
                                <option value="School">School</option>
                                <option value="Entertainment">Entertainment</option>
                                <option value="Pharmacy">Pharmacy</option>
                                <option value="Airport">Airport</option>
                                <option value="Railways">Railways</option>
                                <option value="Bus Stop">Bus Stop</option>
                                <option value="Beach">Beach</option>
                                <option value="Mall">Mall</option>
                                <option value="Bank">Bank</option>
                            </select>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="distance">Distance</label>
                            <input type="text" name="distance[]" id="distance" class="form-control" placeholder="Distance (Km)">
                        </div>
                        <div class="form-group col-md-4" style="padding-top: 20px">
                            <span class="btn btn-success btn-sm addeventmore"><i class="fa fa-plus-circle"> Add</i></span>
                            <span class="btn btn-danger btn-sm removeeventmore"><i class="fa fa-minus-circle"> Remove</i></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!----For Section-------->
    <script type="text/javascript">
        $(document).ready(function(){
            var counter = 0;
            $(document).on("click",".addeventmore",function(){
                var whole_extra_item_add = $("#whole_extra_item_add").html();
                $(this).closest(".add_item").append(whole_extra_item_add);
                counter++;
            });
            $(document).on("click",".removeeventmore",function(event){
                $(this).closest("#whole_extra_item_delete").remove();
                counter -= 1
            });
        });
    </script>

    <!--========== js field validation  ==============-->
    <script type="text/javascript">
        $(document).ready(function (){
            $('#myForm').validate({
                rules: {
                    property_name: {
                        required : true,
                    },
                    property_status: {
                        required : true,
                    },
                    lowest_price: {
                        required : true,
                    },
                    max_price: {
                        required : true,
                    },
                    ptype_id: {
                        required : true,
                    },
                    @if(!$property->exists)
                    property_thambnail: {
                        required : true,
                    },
                    @endif
                },
                messages :{
                    property_name: {
                        required : 'Please Enter Property Name',
                    },
                    property_status: {
                        required : 'Please Select Property Status',
                    },
                    lowest_price: {
                        required : 'Please Enter Lowest Price',
                    },
                    max_price: {
                        required : 'Please Enter Max Price',
                    },
                    ptype_id: {
                        required : 'Please Select Property Type',
                    },
                    @if(!$property->exists)
                    property_thambnail: {
                        required : 'Please Select Property Thumbnail',
                    },
                    @endif
                },
                errorElement : 'span',
                errorPlacement: function (error,element) {
                    error.addClass('invalid-feedback');
                    element.closest('.form-group').append(error);
                },
                highlight : function(element, errorClass, validClass){
                    $(element).addClass('is-invalid');
                },
                unhighlight : function(element, errorClass, validClass){
                    $(element).removeClass('is-invalid');
                },
            });
        });
    </script>

    <script type="text/javascript">
        function mainThamUrl(input){
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e){
                    $('#mainThmb').attr('src',e.target.result).width(80).height(80);
                };
                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>

    <script>
        $(document).ready(function(){
            $('#multiImg').on('change', function(){
                if (window.File && window.FileReader && window.FileList && window.Blob)
                {
                    var data = $(this)[0].files;

                    $.each(data, function(index, file){
                        if(/(\.|\/)(gif|jpe?g|png|webp)$/i.test(file.type)){
                            var fRead = new FileReader();
                            fRead.onload = (function(file){
                                return function(e) {
                                    var img = $('<img/>').addClass('thumb').attr('src', e.target.result).width(100)
                                        .height(80);
                                    $('#preview_img').append(img);
                                };
                            })(file);
                            fRead.readAsDataURL(file);
                        }
                    });
                }else{
                    alert("Your browser doesn't support File API!");
                }
            });
        });
    </script>

@endsection
