@extends('Admin.dist.creative.main')
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
                                    <li class="breadcrumb-item active">Product's Price</li>
                                </ol>
                            </div>
                            <h4 class="page-title">Trang Quản Lý Giá Bán</h4>
                        </div>
                    </div>
                </div>
                <!-- end page title -->

                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="row mb-2">
                                    <div class="col-12">
                                        <div class="text-lg-end">
                                            <a href="{{ route('price.create') }}"
                                                class="btn btn-danger waves-effect waves-light mb-2 me-2"><i
                                                    class="mdi mdi-tag me-1"></i>Thêm Thông Tin Giá Bán Mới</a>
                                        </div>
                                    </div><!-- end col-->
                                </div>
                                <div class="row">
                                    <div class="table">
                                        <table class="table table-centered table-nowrap mb-0" style="table-layout:fixed;"
                                            id="basic-datatable-price">
                                            <thead class="table-light">
                                                <tr>
                                                    <th style="width: 125px;">ID Nhập Hàng</th>
                                                    <th style="width: 125px;">ID Sản Phẩm</th>
                                                    <th style="width: 125px;">Tên Sản Phẩm</th>
                                                    <th style="width: 125px;">Giá Bán</th>
                                                    <th style="width: 125px;">Tương Tác</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($import_details as $import_detail)
                                                    <tr>
                                                        <td><a href=""
                                                                class="text-body fw-bold">{{ $import_detail->import_id }}</a>
                                                        </td>
                                                        <td><a href=""
                                                                class="text-body fw-bold">{{ $import_detail->product_id }}</a>
                                                        </td>
                                                        <td
                                                            style="word-wrap: break-word;
                                                        white-space: normal;">
                                                            {{ $import_detail->get_product($import_detail->product_id)->product_name }}
                                                        </td>

                                                        <td
                                                            style="word-wrap: break-word;
                                                    white-space: normal;">
                                                            @iF($import_detail->import_price_sell)
                                                            <td>{{ number_format($import_detail->import_price_sell) }} VND</td>

                                                            @else
                                                            <td>Chưa có giá bán</td>
                                                            @endif
                                                        </td>
                                                        <td>
                                                            <div style="display:flex">
                                                                @if ($import_detail->import_product_stock > 0)
                                                                    <a href="{{ route('price.edit', ['id' => $import_detail->import_id, 'product_id' => $import_detail->product_id]) }}"
                                                                        class="action-icon">
                                                                        <i class="mdi mdi-pencil-outline me-1"></i></a>
                                                                @else
                                                                    <a href="{{ route('price.edit', ['id' => $import_detail->import_id, 'product_id' => $import_detail->product_id]) }}"
                                                                        class="action-icon" style="pointer-events: none">
                                                                        <i class="mdi mdi-pencil-outline me-1"></i></a>
                                                                @endif
                                                            </div>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>

                            </div> <!-- end card-body-->
                        </div> <!-- end card-->
                    </div> <!-- end col -->
                </div>
                <!-- end row -->

            </div> <!-- container -->

        </div> <!-- content -->

        <!-- Footer Start -->
        <footer class="footer">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-6">
                        <script>
                            document.write(new Date().getFullYear())
                        </script> &copy; UBold theme by <a href="">Coderthemes</a>
                    </div>
                    <div class="col-md-6">
                        <div class="text-md-end footer-links d-none d-sm-block">
                            <a href="javascript:void(0);">About Us</a>
                            <a href="javascript:void(0);">Help</a>
                            <a href="javascript:void(0);">Contact Us</a>
                        </div>
                    </div>
                </div>
            </div>
        </footer>
        <!-- end Footer -->

    </div>
@endsection
@section('footer')
    <script>
        $(document).ready(function() {
            $('#basic-datatable-price').DataTable();
        });
    </script>
@endsection
