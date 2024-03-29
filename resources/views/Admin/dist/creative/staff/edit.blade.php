@extends('Admin.dist.creative.main')
@section('header')
    <!-- Plugins css-->
    <link href="{{ asset('assets/libs/select2/css/select2.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/libs/dropzone/min/dropzone.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/libs/quill/quill.core.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/libs/quill/quill.snow.css') }} " rel="stylesheet" type="text/css" />
    <script src="{{ asset ('ckeditor/ckeditor.js')}}"></script>
    <style>
        .form-group__message{
          display: block;
          margin-top: 12px;
          font-size: 16px;
          color: red;
          word-break: break-word;
        }
    </style>
@endsection
@section('content')
    <div class="content-page">
        <div class="content">

            <!-- Start Content-->
            <div class="container-fluid">

                <!-- start page title -->
                <div class="row">
                    <div class="col-12">
                        <div class="page-title-box">
                            <div class="page-title-right">
                                <ol class="breadcrumb m-0">
                                    <li class="breadcrumb-item"><a href="javascript: void(0);">UBold</a></li>
                                    <li class="breadcrumb-item"><a href="javascript: void(0);">eCommerce</a></li>
                                    <li class="breadcrumb-item active">Staff Edit</li>
                                </ol>
                            </div>
                            <h4 class="page-title">Thêm Nhân Viên Mới</h4>
                        </div>
                    </div>
                </div>
                <!-- end page title -->


                <div class="row">
                    <form action="{{route('staff.update',['id' => $staff->id])}}" method="POST" enctype="multipart/form-data" id = "validator" >
                        @csrf
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="text-uppercase bg-light p-2 mt-0 mb-3">Thông Tin Nhân Viên</h5>

                                    <div class="mb-3">
                                        <label for="staff-name" class="form-label">Tên Nhân Viên<span
                                                class="text-danger">*</span></label>
                                        <input type="text" id="staff-name" name="name" class="form-control"
                                            placeholder="e.g : Apple iMac" value="{{$staff->name}}">
                                        <span class="form-group__message"></span>
                                    </div>

                                    <div class="mb-3">
                                        <label for="staff-address" class="form-label">Địa chỉ Nhân Viên<span
                                                class="text-danger">*</span></label>
                                        <input type="text" id="staff-address" name="address" class="form-control"
                                            placeholder="e.g : Apple iMac" value="{{$staff->address}}">
                                        <span class="form-group__message"></span>
                                    </div>

                                    <div class="mb-3">
                                        <label for="staff-position" class="form-label">Chức vụ Nhân Viên<span
                                                class="text-danger">*</span></label>
                                        <input type="text" id="staff-position" name="position" class="form-control"
                                            placeholder="e.g : Apple iMac" value="{{$staff->position}}">
                                        <span class="form-group__message"></span>
                                    </div>

                                    <div class="mb-3">
                                        <label for="staff-email" class="form-label">Email Nhân Viên<span
                                                class="text-danger">*</span></label>
                                        <input type="text" id="staff-email" name="email" class="form-control"
                                            placeholder="e.g : Apple iMac" value="{{$staff->email}}">
                                        <span class="form-group__message"></span>
                                    </div>

                                    {{-- <div class="mb-3">
                                        <label for="staff-password" class="form-label">Password Nhân Viên<span
                                                class="text-danger">*</span></label>
                                        <input type="password" id="staff-password" name="password" class="form-control"
                                            placeholder="e.g : Apple iMac">
                                        <span class="form-group__message"></span>
                                    </div> --}}


                                    <div class="mb-3">
                                        <label for="staff-phone" class="form-label">Số Điện Thoại Nhân Viên<span
                                                class="text-danger">*</span></label>
                                        <input type="text" id="staff-phone" name="phone" class="form-control"
                                            placeholder="e.g : Apple iMac" value="{{$staff->phone}}">
                                        <span class="form-group__message"></span>
                                    </div>



                                    <div class="mb-3">
                                        <label class="mb-2">Tình Trạng <span class="text-danger">*</span></label>
                                        <br />
                                        <div class="radio form-check-inline">
                                            <input type="radio" id="inlineRadio3" value="{{ $staff->status }}"
                                                name="status" checked="">
                                            <label for="inlineRadio3">{{ $statusStaff }}</label>
                                        </div>
                                        @foreach ($anotherStatus as $key => $value)
                                            <div class="radio form-check-inline">
                                                <input type="radio" id="inlineRadio1" value="{{ $key }}"
                                                    name="status">
                                                <label for="inlineRadio1">{{ $value }}</label>
                                            </div>
                                        @endforeach
                                        <span class="form-group__message"></span>
                                    </div>
                                    <button type="button" class="btn w-sm btn-light waves-effect">Cancel</button>
                                    <button type="submit" class="btn w-sm btn-success waves-effect waves-light">Save</button>
                                </div>
                            </div> <!-- end card -->
                        </div> <!-- end col -->
                    </form>
                </div>
                <!-- end row -->

                <!-- file preview template -->
                <div class="d-none" id="uploadPreviewTemplate">
                    <div class="card mt-1 mb-0 shadow-none border">
                        <div class="p-2">
                            <div class="row align-items-center">
                                <div class="col-auto">
                                    <img data-dz-thumbnail src="#" class="avatar-sm rounded bg-light" alt="">
                                </div>
                                <div class="col ps-0">
                                    <a href="javascript:void(0);" class="text-muted fw-bold" data-dz-name></a>
                                    <p class="mb-0" data-dz-size></p>
                                </div>
                                <div class="col-auto">
                                    <!-- Button -->
                                    <a href="" class="btn btn-link btn-lg text-muted" data-dz-remove>
                                        <i class="dripicons-cross"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


            </div> <!-- container -->

        </div> <!-- content -->


    </div>
@endsection
@section('footer')
    <!-- App js -->
    <script src="{{ asset('assets/js/vendor.min.js') }}"></script>

    <!-- Select2 js-->
    <script src="{{ asset('assets/libs/select2/js/select2.min.js') }}"></script>
    <!-- Dropzone file uploads-->
    <script src="{{ asset('assets/libs/dropzone/min/dropzone.min.js') }}"></script>

    <!-- Quill js -->
    <script src="{{ asset('assets/libs/quill/quill.min.js') }}"></script>

    <!-- Init js-->
    <script src="{{ asset('assets/js/pages/form-fileuploads.init.js') }}"></script>

    <!-- Init js -->
    <script src="{{ asset('assets/js/pages/add-product.init.js') }}"></script>

    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="{{ asset('assets/js/validator.js')}}"></script>

    <script>
        Validator({
            form: '#validator',
            formGroupSelector: '.mb-3',
            errorSelector: '.form-group__message',
            rules: [
                Validator.isEmail('#staff-email'),
               Validator.isRequired('#staff-name'),
               Validator.isRequired('#staff-address'),
               Validator.isRequired('#staff-position'),
               Validator.isRequired('#staff-phone'),
            ]
        });
    </script>
@endsection
