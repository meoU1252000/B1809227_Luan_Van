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
                            <h4 class="page-title">Thêm Thương Hiệu Mới</h4>
                        </div>
                    </div>
                </div>
                <!-- end page title -->


                <div class="row">
                    <form action="{{ route('product.update', ['id' => $product->id]) }}" method="POST"
                        enctype="multipart/form-data" id="validator">
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
                                            <option value="{{ $product->brand_id }}" selected
                                                style="font-weight: bold;
                                                font-style: italic;">
                                                {{ $product->get_brand->brand_name }}</option>
                                            @foreach ($brands as $brand)
                                                <option value="{{ $brand->id }}">
                                                    {{ $brand->brand_name }}</option>
                                            @endforeach

                                        </select>
                                        <span class="form-group__message"></span>
                                    </div>

                                    <div class="mb-3">
                                        <label for="family-name" class="form-label">Nhóm Sản Phẩm<span
                                                class="text-danger">*</span></label>
                                        <select class="form-control" id="family-id" data-toggle="select2" data-width="100%"
                                            name="product_family_id">
                                            @if ($product->get_family)
                                                <option value="" selected>{{ $product->get_family->family_name }}
                                                </option>
                                            @else
                                                <option value="" selected>Choose</option>
                                            @endif
                                            @foreach ($families as $family)
                                                <option value="{{ $family->id }}"
                                                    style="font-weight: bold;
                                                        font-style: italic;">
                                                    {{ $family->family_name }}</option>
                                            @endforeach

                                        </select>
                                        <span class="form-group__message"></span>
                                    </div>

                                    <div class="mb-3">
                                        <label for="brand-name" class="form-label">Danh Mục<span
                                                class="text-danger">*</span></label>
                                        <select class="form-control" id="brand-id" data-toggle="select2" data-width="100%"
                                            name="brand_id">
                                            <option value="{{ $product->brand_id }}" selected
                                                style="font-weight: bold;
                                                font-style: italic;">
                                                {{ $product->get_category->category_name }}</option>
                                        </select>
                                        <span class="form-group__message"></span>
                                    </div>

                                    <div class="mb-3">
                                        <label for="product-name" class="form-label">Tên Sản Phẩm<span
                                                class="text-danger">*</span></label>
                                        <input type="text" id="product-name" name="product_name" class="form-control"
                                            placeholder="e.g : Apple iMac" value="{{ $product->product_name }}">
                                        <span class="form-group__message"></span>
                                    </div>

                                    <div class="mb-3">
                                        <label for="product-description" class="form-label">Miêu Tả Sản Phẩm<span
                                                class="text-danger">*</span></label>
                                        <textarea id="product-description" style="height: 150px;width:100%" name="product_description"
                                            value="{{ $product->product_description }}">{{ $product->product_description }}</textarea>
                                        <span class="form-group__message"></span>
                                        <!-- end Snow-editor-->
                                    </div>

                                    <div class="mb-3">
                                        <label class="mb-2">Tình Trạng <span class="text-danger">*</span></label>
                                        <br />
                                        <div class="radio form-check-inline">
                                            <input type="radio" id="inlineRadio3" value="{{ $product->product_status }}"
                                                name="product_status" checked="">
                                            <label for="inlineRadio3">{{ $statusProduct }}</label>
                                        </div>
                                        @foreach ($anotherStatus as $key => $value)
                                            <div class="radio form-check-inline">
                                                <input type="radio" id="inlineRadio1" value="{{ $key }}"
                                                    name="product_status">
                                                <label for="inlineRadio1">{{ $value }}</label>
                                            </div>
                                        @endforeach
                                        <span class="form-group__message"></span>
                                    </div>

                                    <div class="mb-3">
                                        <label for="product-image" class="form-label">Hình Ảnh Sản Phẩm Hiện Tại</label>
                                        <div class="form-control"
                                            style="width: 250px; height: 250px; object-fit: contain;">
                                            <img src="{{ url($product->main_image_src) }}" alt=""
                                                style="width: 230px;
                                            height: 230px;
                                            object-fit: contain;">
                                        </div>
                                        {{-- <input type="file" id="product-image" name="main_image_src_old"
                                            class="form-control" value="{{ $product->main_image_src }}" hidden> --}}
                                        <span class="form-group__message"></span>
                                    </div>

                                    <div class="mb-3">
                                        <label for="product-image" class="form-label">Thay Đổi Hình Ảnh Sản Phẩm<span
                                                class="text-danger">*</span></label>
                                        <input type="file" id="product-image" name="main_image_src_new"
                                            class="form-control">
                                        <span class="form-group__message"></span>
                                    </div>

                                    <h5 class="text-uppercase bg-light p-2 mt-0 mb-3">Thuộc Tính Sản Phẩm</h5>
                                    @if ($product->get_attribute)
                                        @foreach ($product->get_attribute as $key => $attribute)
                                            <div class="mb-3">
                                                <label for="product-image"
                                                    class="form-label">{{ $attribute->attribute_name }}</label>
                                                <input type="text" class="form-control" name="attribute_id_old[]"
                                                    data-id="{{ $attribute->id }}" placeholder="Enter Name"
                                                    value="{{ $attribute->id }}" hidden>
                                                <input type="text" id="product-image" name="attribute_value[]"
                                                    class="form-control"
                                                    value="{{ $attribute->get_param($attribute->id, $product->id)->param_value }}">
                                                <span class="form-group__message"></span>
                                            </div>
                                        @endforeach
                                    @endif
                                    @if ($attributeNews)
                                        <h4 class="card-body__heading" style="margin-top:36px">Các thuộc tính mới </h4>
                                        @foreach ($attributeNews as $key => $attributeNew)
                                            <div class="mb-3">
                                                <label for="product-image"
                                                    class="form-label">{{ $attributeNew->attribute_name }}</label>
                                                <input type="text" class="form-control" name="attribute_id_new[]"
                                                    data-id="{{ $attributeNew->id }}" placeholder="Enter Name"
                                                    value="{{ $attributeNew->id }}" hidden>
                                                <input type="text" id="product-image" name="attribute_value[]"
                                                    class="form-control">
                                                <span class="form-group__message"></span>
                                            </div>
                                        @endforeach
                                    @endif
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
@endsection
