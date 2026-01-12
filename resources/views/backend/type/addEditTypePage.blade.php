
@extends('admin.admin_dashboard')
@section('admin')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>

    <div class="page-content">

        <div class="row profile-body">
            <!-- middle wrapper start -->
            <div class="col-md-8 col-xl-8 middle-wrapper">
                <div class="row">
                    <div class="card">
                        <div class="card-body">

                            {{-- Condition দিয়ে Title change করুন --}}
                            <h6 class="card-title">
                                {{ isset($types) ? 'Edit Property Type' : 'Add Property Type' }}
                            </h6>

                            {{-- Condition দিয়ে Form Action change করুন --}}
                            <form method="POST"
                                  action="{{ isset($types) ? route('update.type') : route('store.type') }}"
                                  class="forms-sample">
                                @csrf

                                {{-- Edit এর জন্য hidden ID field --}}
                                @if(isset($types))
                                    <input type="hidden" name="id" value="{{ $types->id }}">
                                @endif

                                <div class="mb-3">
                                    <label for="type_name" class="form-label">Type Name</label>
                                    <input type="text"
                                           name="type_name"
                                           id="type_name"
                                           class="form-control @error('type_name') is-invalid @enderror"
                                           value="{{ old('type_name', isset($types) ? $types->type_name : '') }}">
                                    @error('type_name')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="type_icon" class="form-label">Type Icon</label>
                                    <input type="readonly"
                                           name="type_icon"
                                           id="type_icon"
                                           class="form-control @error('type_icon') is-invalid @enderror"
                                           value="{{ old('type_icon', isset($types) ? $types->type_icon : $nextTypeIcon) }}">
                                    @error('type_icon')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                {{-- Condition দিয়ে Button Text change করুন --}}
                                <button type="submit" class="btn btn-primary me-2">
                                    {{ isset($types) ? 'Update Changes' : 'Save Changes' }}
                                </button>

                            </form>

                        </div>
                    </div>

                </div>
            </div>
            <!-- middle wrapper end -->
        </div>

    </div>

@endsection


