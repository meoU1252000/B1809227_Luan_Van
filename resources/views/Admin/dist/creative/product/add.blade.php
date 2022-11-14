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
                            <h4 class="page-title">Thêm Sản Phẩm Mới</h4>
                        </div>
                    </div>
                </div>
                <!-- end page title -->


                <div class="row">
                    <form action="{{ route('product.store') }}" method="POST" enctype="multipart/form-data" id="validator">
                        @csrf
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="text-uppercase bg-light p-2 mt-0 mb-3">Thông Tin Sản Phẩm</h5>

                                    <div class="mb-3">
                                        <label for="brand-name" class="form-label">Thương Hiệu<span
                                                class="text-danger">*</span></label>
                                        <select class="form-control" id="brand-id" data-toggle="select2" data-width="100%"
                                            name="brand_id">
                                            <option value="" selected>Choose</option>
                                            @foreach ($brands as $brand)
                                                <option value="{{ $brand->id }}"
                                                    style="font-weight: bold;
                                                        font-style: italic;">
                                                    {{ $brand->brand_name }}</option>
                                            @endforeach

                                        </select>
                                        <span class="form-group__message"></span>
                                    </div>

                                    {{-- <div class="mb-3">
                                        <label for="family-name" class="form-label">Nhóm Sản Phẩm<span
                                                class="text-danger">*</span></label>
                                        <select class="form-control" id="family-id" data-toggle="select2" data-width="100%"
                                            name="product_family_id">
                                            <option value="" selected>Choose</option>
                                            @foreach ($families as $family)
                                                <option value="{{ $family->id }}"
                                                    style="font-weight: bold;
                                                        font-style: italic;">
                                                    {{ $family->family_name }}</option>
                                            @endforeach

                                        </select>
                                        <span class="form-group__message"></span>
                                    </div> --}}

                                    <div class="mb-3">
                                        <label for="brand-name" class="form-label">Danh Mục<span
                                                class="text-danger">*</span></label>
                                        <select class="form-control" id="category-id" data-width="100%" name="category_id">
                                            <option value="" selected>Choose</option>
                                            @if (count($categories) > 0)
                                                @foreach ($categories as $category)
                                                    <option value="{{ $category->id }}"
                                                        style="font-weight: bold;
                                                font-style: italic;">
                                                        {{ $category->category_name }}</option>
                                                    @include('Admin.dist.creative.category.treeCategory', [
                                                        'count' => $count + 2,
                                                    ])
                                                @endforeach
                                            @endif
                                        </select>
                                        <span class="form-group__message"></span>
                                    </div>

                                    <div class="mb-3">
                                        <label for="product-name" class="form-label">Tên Sản Phẩm<span
                                                class="text-danger">*</span></label>
                                        <input type="text" id="product-name" name="product_name" class="form-control"
                                            placeholder="e.g : Apple iMac">
                                        <span class="form-group__message"></span>
                                    </div>

                                    <div class="mb-3">
                                        <label for="product-description" class="form-label">Miêu Tả Sản Phẩm<span
                                                class="text-danger">*</span></label>
                                        <textarea id="product-description" style="height: 150px;width:100%" name="product_description"></textarea>
                                        <span class="form-group__message"></span>
                                        <!-- end Snow-editor-->
                                    </div>

                                    <div class="mb-3">
                                        <label class="mb-2">Tình Trạng <span class="text-danger">*</span></label>
                                        <br />
                                        <div class="radio form-check-inline">
                                            <input type="radio" id="inlineRadio3" value="0"
                                                name="product_status">
                                            <label for="inlineRadio3">Tạm Ẩn</label>
                                        </div>
                                        <div class="radio form-check-inline">
                                            <input type="radio" id="inlineRadio1" value="1" name="product_status"
                                                checked="">
                                            <label for="inlineRadio1">Đang Bán</label>
                                        </div>
                                        <span class="form-group__message"></span>
                                    </div>

                                    <div class="mb-3">
                                        <label for="product-image" class="form-label">Hình Ảnh Sản Phẩm<span
                                                class="text-danger">*</span></label>
                                        <input type="file" id="product-image" name="main_image_src"
                                            class="form-control">
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
                                    <img data-dz-thumbnail src="#" class="avatar-sm rounded bg-light"
                                        alt="">
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
    {{-- <script src="{{ asset('assets/libs/select2/js/select2.min.js') }}"></script> --}}
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
                Validator.isRequired('#product-name'),
            ]
        });
        CKEDITOR.replace('product-description');
    </script>

    <script>
        $(document).ready(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $("#category-id").change(function(e) {
                var id = $('#category-id').val();
                console.log(id);
                var more = '';
                var i = 0;
                $.ajax({
                    type: "POST",
                    url: "getAttribute/" + id,
                    data: {
                        "id": id,
                        "_token": "{{ csrf_token() }}"
                    },
                    success: function(data) {
                        if (data.code == 200) {
                            $(data.data).each(function(key, value) {
                                i++;
                                more +=
                                    `<div class="mb-3"><label for="category-name" class="form-label"> ${value.attribute_name}
                            <span class="text-danger">*</span></label>
                            <input type="text" name="attribute_id[]" class="form-control test" data-id="${value.id}" value="${value.id}" placeholder="e.g : CPU" hidden>
                            <input type="text" name="attribute_value[]" class="form-control test" placeholder="e.g : CPU">
                            <span class="form-group__message"></span></div>`


                            })
                            document.querySelector('.card_more').innerHTML = more;
                            CKEDITOR.replace('product_description');
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
                    url: "{{ route('product.store') }}",
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
@endsection
