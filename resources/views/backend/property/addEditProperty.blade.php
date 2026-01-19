
@extends('admin.admin_dashboard')
@section('admin')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>

    <div class="page-content">
        <div class="row profile-body">
            <div class="col-md-12 col-xl-12 middle-wrapper">
                <div class="row">
                    <div class="card">
                        <div class="card-body">
                            <h6 class="card-title">{{ isset($property) ? 'Edit Property' : 'Add Property' }}</h6>

                            <form action="{{ isset($property) ? route('update.property', $property->id) : route('store.property') }}" method="POST" enctype="multipart/form-data" id="myForm">
                                @csrf
                                @if(isset($property))
                                    @method('PUT')
                                @endif

                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="mb-3">
                                            <label class="form-label">Property Name</label>
                                            <input type="text" name="property_name" class="form-control" value="{{ $property->property_name ?? old('property_name') }}">
                                        </div>
                                    </div>

                                    <div class="col-sm-6">
                                        <div class="mb-3">
                                            <label class="form-label">Property Status</label>
                                            <select name="property_status" class="form-select" id="exampleFormControlSelect1">
                                                <option selected="" disabled="">Select Status</option>
                                                <option value="rent" {{ (isset($property) && $property->property_status == 'rent') ? 'selected' : '' }}>For Rent</option>
                                                <option value="buy" {{ (isset($property) && $property->property_status == 'buy') ? 'selected' : '' }}>For Buy</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-sm-6">
                                        <div class="mb-3">
                                            <label class="form-label">Lowest Price</label>
                                            <input type="text" name="lowest_price" class="form-control" value="{{ $property->lowest_price ?? old('lowest_price') }}">
                                        </div>
                                    </div>

                                    <div class="col-sm-6">
                                        <div class="mb-3">
                                            <label class="form-label">Max Price</label>
                                            <input type="text" name="max_price" class="form-control" value="{{ $property->max_price ?? old('max_price') }}">
                                        </div>
                                    </div>

                                    <div class="col-sm-6">
                                        <div class="mb-3">
                                            <label class="form-label">Main Thumbnail</label>
                                            <input type="file" name="property_thambnail " class="form-control" onChange="mainThamUrl(this)"  >
                                            <img src="" id="mainThmb">
                                            @if(isset($property) && $property->main_thumbnail)
                                                <img src="{{ asset($property->main_thumbnail) }}" style="width:100px; height:100px; margin-top:10px;">
                                            @endif

                                        </div>
                                    </div>

                                    <div class="col-sm-6">
                                        <div class="mb-3">
                                            <label class="form-label">Multiple Image</label>
                                            <input type="file" name="multi_img[]" class="form-control" id="multiImg" multiple="" >
                                            @if(isset($property) && $property->multi_img)
                                                <div style="margin-top:10px;">
                                                    @foreach(json_decode($property->multi_img) as $img)
                                                        <img src="{{ asset($img) }}" style="width:80px; height:80px; margin-right:5px;">
                                                    @endforeach
                                                </div>
                                            @endif
                                            <div class="row" id="preview_img"> </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-sm-3">
                                        <div class="mb-3">
                                            <label class="form-label">Bedrooms</label>
                                            <input type="text" name="bedrooms" class="form-control" value="{{ $property->state ?? old('bedrooms') }}">
                                        </div>
                                    </div>

                                    <div class="col-sm-3">
                                        <div class="mb-3">
                                            <label class="form-label">Bathrooms</label>
                                            <input type="text" name="bathrooms" class="form-control" value="{{ $property->state ?? old('bathrooms') }}">
                                        </div>
                                    </div>

                                    <div class="col-sm-3">
                                        <div class="mb-3">
                                            <label class="form-label">Garage</label>
                                            <input type="text" name="garage" class="form-control" value="{{ $property->garage ?? old('garage') }}">
                                        </div>
                                    </div>

                                    <div class="col-sm-3">
                                        <div class="mb-3">
                                            <label class="form-label">Garage Size</label>
                                            <input type="text" name="garage_size" class="form-control" value="{{ $property->garage_size ?? old('garage_size') }}">
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
{{--                                    <div class="col-sm-3">--}}
{{--                                        <div class="mb-3">--}}
{{--                                            <label class="form-label">Amenitis Name</label>--}}
{{--                                            <input type="text" name="amenitis_name" class="form-control" value="{{ $property->garage_size ?? old('garage_size') }}">--}}
{{--                                        </div>--}}
{{--                                    </div>--}}

                                    <div class="col-sm-3">
                                        <div class="mb-3">
                                            <label class="form-label">Address</label>
                                            <input type="text" name="address" class="form-control" value="{{ $property->address ?? old('address') }}">
                                        </div>
                                    </div>

                                    <div class="col-sm-3">
                                        <div class="mb-3">
                                            <label class="form-label">City</label>
                                            <input type="text" name="city" class="form-control" value="{{ $property->city ?? old('city') }}">
                                        </div>
                                    </div>

                                    <div class="col-sm-3">
                                        <div class="mb-3">
                                            <label class="form-label">State</label>
                                            <input type="text" name="state" class="form-control" value="{{ $property->state ?? old('state') }}">
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="mb-3">
                                            <label class="form-label">Postal Code</label>
                                            <input type="text" name="postal_code" class="form-control" value="{{ $property->postal_code ?? old('postal_code') }}">
                                        </div>
                                    </div>

                                </div>

                                <div class="row">
                                    <div class="col-sm-4">
                                        <div class="mb-3">
                                            <label class="form-label">>Property Size</label>
                                            <input type="text" name="property_size" class="form-control" value="{{ $property->property_size ?? old('property_size') }}">
                                        </div>
                                    </div>

                                    <div class="col-sm-4">
                                        <div class="mb-3">
                                            <label class="form-label">Property Video</label>
                                            <input type="text" name="property_video" class="form-control" value="{{ $property->property_video ?? old('property_video') }}">
                                        </div>
                                    </div>

                                    <div class="col-sm-4">
                                        <div class="mb-3">
                                            <label class="form-label">Agent</label>
                                            <input type="text" name="neighborhood" class="form-control" value="{{ $property->neighborhood ?? old('neighborhood') }}">
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="mb-3">
                                            <label class="form-label">Latitude</label>
                                            <input type="text" name="latitude" class="form-control" value="{{ $property->latitude ?? old('latitude') }}">
                                            <a href="https://www.latlong.net/convert-address-to-lat-long.html" target="_blank">Go here to get Latitude from address</a>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="mb-3">
                                            <label class="form-label">Longitude</label>
                                            <input type="text" name="longitude" class="form-control" value="{{ $property->longitude ?? old('longitude') }}">
                                            <a href="https://www.latlong.net/convert-address-to-lat-long.html" target="_blank">Go here to get Longitude from address</a>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-sm-4">
                                        <div class="mb-3">
                                            <label class="form-label">Property Type </label>
                                            <select name="ptype_id" class="form-select" id="exampleFormControlSelect1">
                                                <option selected="" disabled="">Select Type</option>
                                                @foreach($propertytype as $ptype)
                                                    <option value="{{ $ptype->id }}">{{ $ptype->type_name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-sm-4">
                                        <div class="mb-3">
                                            <label class="form-label">Property Amenities </label>
                                            <select name="amenities_id[]" class="js-example-basic-multiple form-select" multiple="multiple" data-width="100%">

                                                @foreach($amenities as $ameni)
                                                    <option value="{{ $ameni->id }}">{{ $ameni->amenitis_name }}</option>
                                                @endforeach

                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-sm-4">
                                        <div class="mb-3">
                                            <label class="form-label"> Agent </label>
                                            <select name="agent_id" class="form-select" id="exampleFormControlSelect1">
                                                <option selected="" disabled="">Select Agent</option>
                                                @foreach($activeAgent as $agent)
                                                    <option value="{{ $agent->id }}">{{ $agent->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <button type="submit" class="btn btn-primary">{{ isset($property) ? 'Update Property' : 'Add Property' }}</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>



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
            $('#multiImg').on('change', function(){ //on file input change
                if (window.File && window.FileReader && window.FileList && window.Blob) //check File API supported browser
                {
                    var data = $(this)[0].files; //this file data

                    $.each(data, function(index, file){ //loop though each file
                        if(/(\.|\/)(gif|jpe?g|png|webp)$/i.test(file.type)){ //check supported file type
                            var fRead = new FileReader(); //new filereader
                            fRead.onload = (function(file){ //trigger function on successful read
                                return function(e) {
                                    var img = $('<img/>').addClass('thumb').attr('src', e.target.result) .width(100)
                                        .height(80); //create image element
                                    $('#preview_img').append(img); //append image to output element
                                };
                            })(file);
                            fRead.readAsDataURL(file); //URL representing the file's data.
                        }
                    });

                }else{
                    alert("Your browser doesn't support File API!"); //if File API is absent
                }
            });
        });

    </script>

@endsection
