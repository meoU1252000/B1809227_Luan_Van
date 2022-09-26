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
    <meta name="csrf-token" content="{{ csrf_token() }}">
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
                                    <li class="breadcrumb-item active">Product Edit</li>
                                </ol>
                            </div>
                            <h4 class="page-title">Thêm Giá Bán Mới</h4>
                        </div>
                    </div>
                </div>
                <!-- end page title -->


                <div class="row">
                    <form action="{{ route('price.store') }}" method="POST" enctype="multipart/form-data" id="validator">
                        @csrf
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="text-uppercase bg-light p-2 mt-0 mb-3">Thông Tin Giá Bán</h5>

                                    <div class="mb-3">
                                        <label for="import-id" class="form-label">Mã Nhập Hàng<span
                                                class="text-danger">*</span></label>
                                        <select class="form-control" id="import-id" data-width="100%" name="import_id">
                                            <option value="" selected>Choose</option>
                                            @if (count($imports) > 0)
                                                @foreach ($imports as $import)
                                                    <option value="{{ $import->id }}"
                                                        style="font-weight: bold;
                                                font-style: italic;">
                                                        {{ $import->id }}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                        <span class="form-group__message"></span>
                                    </div>

                                    <div class="card_more">

                                    </div>

                                    <button type="button" class="btn w-sm btn-light waves-effect">Cancel</button>
                                    <button type="submit" class="btn w-sm btn-success waves-effect waves-light"
                                        id="submitForm">Save</button>
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

    <!-- Init js-->
    <script src="{{ asset('assets/js/pages/form-fileuploads.init.js') }}"></script>

    <!-- Init js -->
    <script src="{{ asset('assets/js/pages/add-product.init.js') }}"></script>

    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="{{ asset('assets/js/validator.js') }}"></script>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
        integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"
        integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous">
    </script>
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"
        integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
    <script>
        Validator({
            form: '#validator',
            formGroupSelector: '.mb-3',
            errorSelector: '.form-group__message',
            rules: [
                Validator.isRequired('#import-id'),
            ]
        });
    </script>

    <script>
        $(document).ready(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $("#import-id").change(function(e) {
                var id = $('#import-id').val();
                console.log(id);
                var more = '';
                var i = 0;
                $.ajax({
                    type: "POST",
                    url: "getImport/" + id,
                    data: {
                        "id": id,
                        "_token": "{{ csrf_token() }}"
                    },
                    success: function(data) {
                        if (data.code == 200) {
                            more += `<div class="mb-3">
                                    <label for="product-name" class="form-label">Sản Phẩm<span
                                            class="text-danger">*</span></label>
                                    <select class="form-control" id="product-id" data-width="100%" name="product_id" onchange="getImportPrice();">
                                        <option value="" selected>Choose</option>`
                            $(data.data).each(function(key, value) {
                                $.ajax({
                                    async: false,
                                    type: "POST",
                                    url: "getProduct/" + value.product_id,
                                    data: {
                                        "id": value.product_id,
                                        "_token": "{{ csrf_token() }}"
                                    },
                                    success: function(data) {
                                        more +=
                                            `<option value="${data.data.id}"
                                    style = "font-weight: bold;font-style: italic;">${data.data.product_name}</option>`
                                    }
                                })
                            })
                            more += `
                                    </select>
                                    <span class="form-group__message"></span>
                            </div>`
                            more += `
                                <div class="mb-3">
                                    <label for="import-price" class="form-label">Giá Nhập (VNĐ)<span
                                            class="text-danger">*</span></label>
                                    <input type="number" id="import-price" name="import_price" class="form-control"
                                        placeholder="e.g : Apple iMac">
                                    <span class="form-group__message"></span>
                                </div>
                                <div class="mb-3">
                                    <label for="product-price" class="form-label">Giá Bán (VNĐ)<span
                                            class="text-danger">*</span></label>
                                    <input type="number" id="product-price" name="product_price" class="form-control"
                                        placeholder="e.g : Apple iMac">
                                    <span class="form-group__message"></span>
                                </div>`
                                

                            document.querySelector('.card_more').innerHTML =
                                more;
                            document.getElementById('submitForm').onclick = null;
                        } else {
                            alert("Thất bại. Vui lòng thử lại");
                        }
                    }

                })

            })

        })
    </script>

    <script>
        $(document).ready(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $("#submitForm").submit(function(e) {
                e.preventDefault();

                $.ajax({
                    type: "POST",
                    url: "{{ route('price.store') }}",
                    data: {
                        "form": $('#submitForm').serialize(),
                        "_token": "{{ csrf_token() }}"
                    },

                    success: function(data) {
                        if (data.code == 200) {
                            alert("Thành công");
                        } else {
                            alert("Thất bại. Vui lòng thử lại");
                        }
                    }

                });
            });
        });
    </script>
    <script>
        function getImportPrice() {
            product_id = $('#product-id').val();
            var id = $('#import-id').val();
            $.ajax({
                type: "POST",
                url: "getImportProductPrice",
                data: {
                    "id": id,
                    "product_id": product_id,
                    "_token": "{{ csrf_token() }}"
                },
                success: function(data){
                    if(data.code == 200){
                        document.getElementById("import-price").setAttribute("value", data.data.import_price);
                    }
                }
            })
        }
    </script>
@endsection
