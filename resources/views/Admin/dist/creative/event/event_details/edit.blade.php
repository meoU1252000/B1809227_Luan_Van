@extends('Admin.dist.creative.main')
@section('header')
    <!-- Plugins css-->
    <link href="{{ asset('assets/libs/select2/css/select2.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/libs/dropzone/min/dropzone.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/libs/quill/quill.core.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/libs/quill/quill.snow.css') }} " rel="stylesheet" type="text/css" />
    <script src="{{ asset('ckeditor/ckeditor.js') }}"></script>
    <style>
        .form-group__message {
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
                                    <li class="breadcrumb-item active">Event</li>
                                </ol>
                            </div>
                            <h4 class="page-title">Thêm Sự Kiện Mới</h4>
                        </div>
                    </div>
                </div>
                <!-- end page title -->


                <div class="row">
                    <form action="{{ route('event.store') }}" method="POST" enctype="multipart/form-data" id="validator">
                        @csrf
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="text-uppercase bg-light p-2 mt-0 mb-3">Thông Tin Sự Kiện</h5>

                                    <div class="mb-3">
                                        <label for="event-id" class="form-label">Sự Kiện<span
                                                class="text-danger">*</span></label>
                                        <select class="form-control" id="event-id" data-toggle="select2" data-width="100%"
                                            name="event_id">
                                            <option value="{{ $event_father->id }}" selected
                                                style="font-weight: bold;
                                                font-style: italic;">
                                                {{ $event_father->event_name }}</option>
                                        </select>
                                        <span class="form-group__message"></span>
                                    </div>


                                    <div class="mb-3">
                                        <label for="event-code" class="form-label">Mã Code<span
                                                class="text-danger">*</span></label>
                                        <textarea id="event-code" style="height: 150px;width:100%" name="code_name" value="{{$event_detal->code_name}}"></textarea>
                                        <span class="form-group__message"></span>
                                        <!-- end Snow-editor-->
                                    </div>

                                    <div class="mb-3">
                                        <label for="discount-unit" class="form-label">Giảm Theo<span
                                                class="text-danger">*</span></label>
                                        <select class="form-control" id="discount-unit" data-width="100%" name="discount_unit" onchange="unitDiscount()">
                                            <option value="" selected>Choose</option>
                                            <option value="0">Phần Trăm</option>
                                            <option value="1">Giá Tiền</option>
                                        </select>
                                    </div>

                                    <div class="card_more">

                                    </div>

                                    <button type="button" class="btn w-sm btn-light waves-effect">Cancel</button>
                                    <button type="submit"
                                        class="btn w-sm btn-success waves-effect waves-light">Save</button>
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
    <script src="{{ asset('assets/js/validator.js') }}"></script>

    <script>
        Validator({
            form: '#validator',
            formGroupSelector: '.mb-3',
            errorSelector: '.form-group__message',
            rules: [
                Validator.isRequired('#event-code'),
                Validator.isRequired('#discount-unit'),
            ]
        });
        CKEDITOR.replace('event-description');
    </script>
    <script>
        function unitDiscount() {
            var x = document.getElementById("discount-unit").value;
            var more = '';
            if (x == "0") {
                more +=
                `<div class="mb-3"><label for="category-name" class="form-label"> Giá Trị Giảm
                    <span class="text-danger">*</span></label>
                    <input type="text" name="discount_value" class="form-control test" min='0' max='100' placeholder="e.g : 10%">
                    <span class="form-group__message"></span>
                </div>`
            } else {
                more +=
                `<div class="mb-3"><label for="category-name" class="form-label"> Giá Trị Giảm
                    <span class="text-danger">*</span></label>
                    <input type="text" name="discount_value" class="form-control test" min='0'  placeholder="e.g : đơn vị VNĐ">
                    <span class="form-group__message"></span>
                </div>`
            }
            document.querySelector('.card_more').innerHTML = more;
        }
    </script>
@endsection
