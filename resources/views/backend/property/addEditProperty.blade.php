
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
                                            <input type="file" name="main_thumbnail" class="form-control" id="image">
                                            @if(isset($property) && $property->main_thumbnail)
                                                <img src="{{ asset($property->main_thumbnail) }}" style="width:100px; height:100px; margin-top:10px;">
                                            @endif
                                        </div>
                                    </div>

                                    <div class="col-sm-6">
                                        <div class="mb-3">
                                            <label class="form-label">Multiple Image</label>
                                            <input type="file" name="multi_img[]" class="form-control" multiple="">
                                            @if(isset($property) && $property->multi_img)
                                                <div style="margin-top:10px;">
                                                    @foreach(json_decode($property->multi_img) as $img)
                                                        <img src="{{ asset($img) }}" style="width:80px; height:80px; margin-right:5px;">
                                                    @endforeach
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-sm-4">
                                        <div class="mb-3">
                                            <label class="form-label">City</label>
                                            <input type="text" name="city" class="form-control" placeholder="Enter city" value="{{ $property->city ?? old('city') }}">
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="mb-3">
                                            <label class="form-label">State</label>
                                            <input type="text" name="state" class="form-control" placeholder="Enter state" value="{{ $property->state ?? old('state') }}">
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="mb-3">
                                            <label class="form-label">Zip</label>
                                            <input type="text" name="zip" class="form-control" placeholder="Enter zip code" value="{{ $property->zip ?? old('zip') }}">
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

@endsection
