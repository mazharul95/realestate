@extends('admin.admin_dashboard')
@section('admin')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/jquery.validate.min.js"></script>

    <div class="page-content">
        <div class="row profile-body">
            <div class="col-md-8 col-xl-8 middle-wrapper">
                <div class="row">
                    <div class="card">
                        <div class="card-body">

                            {{-- Dynamic Title --}}
                            <h6 class="card-title">
                                {{ isset($allagent) ? 'Edit Agent' : 'Add Agent' }}
                            </h6>

                            {{-- Dynamic Action & Method --}}
                            <form id="myForm" method="POST"
                                  action="{{ isset($allagent) ? route('update.agent') : route('store.agent') }}"
                                  class="forms-sample">
                                @csrf

                                {{-- Hidden ID only for Edit --}}
                                @if(isset($allagent))
                                    <input type="hidden" name="id" value="{{ $allagent->id }}">
                                @endif

                                <div class="form-group mb-3">
                                    <label class="form-label">Agent Name</label>
                                    <input type="text" name="name" class="form-control"
                                           value="{{ $allagent->name ?? '' }}">
                                </div>

                                <div class="form-group mb-3">
                                    <label class="form-label">Agent Email</label>
                                    <input type="email" name="email" class="form-control"
                                           value="{{ $allagent->email ?? '' }}">
                                </div>

                                <div class="form-group mb-3">
                                    <label class="form-label">Agent Phone</label>
                                    <input type="text" name="phone" class="form-control"
                                           value="{{ $allagent->phone ?? '' }}">
                                </div>

                                <div class="form-group mb-3">
                                    <label class="form-label">Agent Address</label>
                                    <input type="text" name="address" class="form-control"
                                           value="{{ $allagent->address ?? '' }}">
                                </div>

                                {{-- Password only for Add --}}
                                @if(!isset($allagent))
                                    <div class="form-group mb-3" id="password-group">
                                        <label class="form-label">Agent Password</label>
                                        <input type="password" name="password" class="form-control">
                                    </div>
                                @endif

                                <button type="submit" class="btn btn-primary me-2">
                                    {{ isset($allagent) ? 'Update Agent' : 'Save Agent' }}
                                </button>

                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        var isEditMode = {{ isset($allagent) ? 'true' : 'false' }};

        $(document).ready(function () {
            var rules = {
                name:  { required: true },
                email: { required: true, email: true },
                phone: { required: true },
            };

            var messages = {
                name:  { required: 'Please Enter Name' },
                email: { required: 'Please Enter Email', email: 'Enter valid email' },
                phone: { required: 'Please Enter Phone' },
            };

            // Password required only in Add mode
            if (!isEditMode) {
                rules.password    = { required: true, minlength: 6 };
                messages.password = { required: 'Please Enter Password', minlength: 'Min 6 characters' };
            }

            $('#myForm').validate({
                rules: rules,
                messages: messages,
                errorElement: 'span',
                errorPlacement: function (error, element) {
                    error.addClass('invalid-feedback');
                    element.closest('.form-group').append(error);
                },
                highlight: function (element) {
                    $(element).addClass('is-invalid');
                },
                unhighlight: function (element) {
                    $(element).removeClass('is-invalid');
                },
            });
        });
    </script>
@endsection
