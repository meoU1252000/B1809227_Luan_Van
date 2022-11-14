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

        .address-content {
            padding: 1.5em;
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
                                    <li class="breadcrumb-item active">Edit Order</li>
                                </ol>
                            </div>
                            <h4 class="page-title">Cập nhật thông tin đơn hàng</h4>
                        </div>
                    </div>
                </div>
                <!-- end page title -->


                <div class="row">
                    <form action="{{ route('order.update', ['id' => $order->id]) }}" method="POST"
                        enctype="multipart/form-data" id="validator">
                        @csrf
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="text-uppercase bg-light p-2 mt-0 mb-3">Trạng Thái Đơn Hàng</h5>

                                    <div class="mb-3">
                                        <select class="form-control" id="order-status" data-toggle="select2"
                                            data-width="100%" name="order_status">
                                            @if ($order->order_status == 'Chưa Xử Lý')
                                                <option value="{{ $order->order_status }}" selected
                                                    style="font-weight: bold;
                                            font-style: italic;">
                                                    {{ $order->order_status }}</option>
                                                <option value="Chờ Giao Hàng">Chờ Giao Hàng</option>
                                                <option value="Đang Giao">Đang Giao</option>
                                                <option value="Đã Giao">Đã Giao</option>
                                                <option value="Đã Hủy">Đã Hủy</option>
                                                <option value="Trả Hàng">Trả Hàng</option>
                                            @elseif($order->order_status == 'Chờ Giao Hàng')
                                                <option value="{{ $order->order_status }}" selected
                                                    style="font-weight: bold;
                                            font-style: italic;">
                                                    {{ $order->order_status }}</option>
                                                <option value="Đang Giao">Đang Giao</option>
                                                <option value="Đã Giao">Đã Giao</option>
                                                <option value="Đã Hủy">Đã Hủy</option>
                                                <option value="Trả Hàng">Trả Hàng</option>
                                            @elseif($order->order_status == 'Đang Giao')
                                                <option value="{{ $order->order_status }}" selected
                                                    style="font-weight: bold;
                                                font-style: italic;">
                                                    {{ $order->order_status }}</option>
                                                <option value="Đã Giao">Đã Giao</option>
                                                <option value="Đã Hủy">Đã Hủy</option>
                                                <option value="Trả Hàng">Trả Hàng</option>
                                            @elseif($order->order_status == 'Đã Giao')
                                                <option value="{{ $order->order_status }}" selected
                                                    style="font-weight: bold;
                                                    font-style: italic;">
                                                    {{ $order->order_status }}</option>
                                            @elseif($order->order_status == 'Đã Hủy')
                                                <option value="{{ $order->order_status }}" selected
                                                    style="font-weight: bold;
                                                        font-style: italic;">
                                                    {{ $order->order_status }}</option>
                                            @elseif($order->order_status == 'Trả Hàng')
                                                <option value="{{ $order->order_status }}" selected
                                                    style="font-weight: bold;
                                                        font-style: italic;">
                                                    {{ $order->order_status }}</option>
                                            @endif
                                        </select>
                                        <span class="form-group__message"></span>
                                    </div>
                                    <div class="mb-3">
                                        <h5 class="text-uppercase bg-light p-2 mt-0 mb-3">Địa chỉ giao hàng</h5>
                                        <div class="border">
                                            <div class="address-content">
                                                <div class="row">
                                                    <div class="d-flex">
                                                        <span>Tên người nhận: </span>
                                                        <span style="margin-left:0.5em">{{$order->get_address->receiver_name}} </span>
                                                    </div>
                                                    <div class="d-flex">
                                                        <span>Số điện thoại: </span>
                                                        <span style="margin-left:0.5em">{{$order->get_address->receiver_phone}} </span>
                                                    </div>
                                                    <div class="d-flex">
                                                        <span>Địa chỉ: </span>
                                                        <span style="margin-left:0.5em">{{$order->get_address->receiver_address}} </span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="mb-3">
                                        <h5 class="text-uppercase bg-light p-2 mt-0 mb-3">Chi tiết đơn hàng</h5>
                                        <table class="table table-striped">
                                            <thead>
                                              <tr>
                                                <th scope="col">#</th>
                                                <th scope="col">Sản Phẩm</th>
                                                <th scope="col">Số Lượng</th>
                                                <th scope="col">Đơn Giá</th>
                                                <th scope="col">Thành Tiền</th>
                                              </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($order_details as $key => $value)
                                              <tr>
                                                <th scope="row">{{$key+1}}</th>
                                                <td>{{$value->get_product->product_name}}</td>
                                                <td>{{$value->product_number}}</td>
                                                <td>{{number_format($value->product_price)}}</td>
                                                <td>{{number_format(($value->product_price)*($value->product_number))}}</td>
                                              </tr>
                                            @endforeach
                                            </tbody>
                                            <tfoot>
                                                <th scope="col" colspan="4">Tổng Giá Trị Đơn Hàng</th>
                                                <th>{{number_format($order->total_price)}}</th>
                                            </tfoot>
                                          </table>
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
@endsection
