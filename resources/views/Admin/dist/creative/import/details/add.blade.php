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
                                    <li class="breadcrumb-item active">Brand Edit</li>
                                </ol>
                            </div>
                            <h4 class="page-title">Thêm Thông Tin Nhập Hàng Mới</h4>
                        </div>
                    </div>
                </div>
                <!-- end page title -->


                <div class="row">
                    <form action="{{ route('import.details.store', ['id' => $import->id]) }}" method="POST"
                        enctype="multipart/form-data" id="validator">
                        @csrf
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="text-uppercase bg-light p-2 mt-0 mb-3">Thông Tin Nhập Hàng</h5>

                                    <div class="mb-3">
                                        <label for="supplier-name" class="form-label">Mã Nhập Hàng<span
                                                class="text-danger">*</span></label>
                                        <select class="form-control" id="import-id" data-toggle="select2" data-width="100%"
                                            name="import_id">
                                            <option value="{{ $import->id }}"
                                                style="font-weight: bold;
                                                        font-style: italic;">
                                                {{ $import->id }}</option>


                                        </select>
                                        <span class="form-group__message"></span>
                                    </div>



                                    <div class="mb-3">
                                        <label for="volume" class="form-label">Số Lượng Nhập<span
                                                class="text-danger">*</span></label>
                                        <input type="text" id="volume" name="volume" class="form-control"
                                            placeholder="e.g : Apple iMac">
                                        <span class="form-group__message"></span>
                                    </div>
                                    <div class="card_more">

                                    </div>
                                    <button type="button" class="btn w-sm btn-light waves-effect">Cancel</button>
                                    <button type="submit" class="btn w-sm btn-success waves-effect waves-light"
                                        onclick="showImportData();" id='submitForm'>Save</button>
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
                Validator.isRequired('#volume')
            ]
        });
    </script>
    <script>
        function showImportData() {
            const volumeImport = document.getElementById('volume').value;
            event.preventDefault();
            var data = '';
            if (volumeImport > 0) {
                for (let i = 0; i < volumeImport; i++) {
                    data += '<h4 class="card-body__heading" style="margin-top:36px">Sản Phẩm'+' ' +[i+1] +'</h4> <div class="form-group">'
                    +`<div class="mb-3">
                                        <label for="product-name" class="form-label">Sản Phẩm<span
                                                class="text-danger">*</span></label>
                                        <select class="form-control" id="product-id" data-toggle="select2" data-width="100%"
                                            name="product_id[]" required>
                                            <option value="" selected>Choose</option>
                                            @foreach ($products as $product)
                                                <option value="{{ $product->id }}"
                                                    style="font-weight: bold;
                                                        font-style: italic;">
                                                    {{ $product->product_name }}</option>
                                            @endforeach
                                        </select>
                                        <span class="form-group__message"></span>
                                    </div>
                     <div class="mb-3">
                                        <label for="import-price" class="form-label">Giá Nhập<span
                                                class="text-danger">*</span></label>
                                        <input type="number" id="import-price" name="import_price[]" class="form-control"
                                            placeholder="e.g : Apple iMac" data-type="currency" required>
                                        <span class="form-group__message"></span>
                                    </div>

                                    <div class="mb-3">
                                        <label for="product-quantity" class="form-label">Số Lượng<span
                                                class="text-danger">*</span></label>
                                        <input type="number" id="product-quantity" name="import_product_quantity[]" class="form-control"
                                            placeholder="e.g : 12" required>
                                        <span class="form-group__message"></span>
                                    </div>`

                }
                document.querySelector('.card_more').innerHTML = data;
                document.getElementById('submitForm').onclick = null;

            }
        };
    </script>
@endsection
