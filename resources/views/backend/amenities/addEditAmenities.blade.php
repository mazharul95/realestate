@extends('admin.admin_dashboard')
@section('admin')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>

    <div class="page-content">
        <div class="row profile-body">
            <div class="col-md-8 col-xl-8 middle-wrapper">
                <div class="row">
                    <div class="card">
                        <div class="card-body">

                            <h6 class="card-title">
                                {{ isset($amenities) ? 'Edit Property' : 'Add Property' }}
                            </h6>

                            <form method="POST"
                                  action="{{ isset($amenities) ? route('update.amenitie') : route('store.amenitie') }}"
                                  class="forms-sample">
                                @csrf

                                @if(isset($amenities))
                                    <input type="hidden" name="id" value="{{ $amenities->id }}">
                                @endif

                                <div class="form-group mb-3">
                                    <label for="exampleInputEmail1" class="form-label">Amenities Name</label>
                                    <input type="text"
                                           name="amenitis_name"
                                           class="form-control @error('amenitis_name') is-invalid @enderror"
                                           value="{{ isset($amenities) ? $amenities->amenitis_name : old('amenitis_name') }}">
                                    @error('amenitis_name')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <button type="submit" class="btn btn-primary me-2">
                                    {{ isset($amenities) ? 'Update Changes' : 'Save Changes' }}
                                </button>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
