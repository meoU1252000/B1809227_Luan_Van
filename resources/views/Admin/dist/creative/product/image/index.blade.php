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
                                    <li class="breadcrumb-item active">Images</li>
                                </ol>
                            </div>
                            <h4 class="page-title">Trang Quản Lý Hình Ảnh</h4>
                        </div>
                    </div>
                </div>
                <!-- end page title -->

                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="row mb-2">
                                    <div class="col-lg-8">
                                        <form class="d-flex flex-wrap align-items-center">
                                            <label for="inputPassword2" class="visually-hidden">Search</label>
                                            <div class="me-3">
                                                <input type="search" class="form-control my-1 my-lg-0" id="inputPassword2"
                                                    placeholder="Search...">
                                            </div>
                                            <label for="status-select" class="me-2">Status</label>
                                            <div class="me-sm-3">
                                                <select class="form-select form-select my-1 my-lg-0" id="status-select">
                                                    <option selected>Choose...</option>
                                                    <option value="0">Sắp Ra Mắt</option>
                                                    <option value="1">Đang Bán</option>
                                                    <option value="2">Ngưng Nhập Hàng</option>
                                                    <option value="3">Tạm Hết Hàng</option>
                                                </select>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="text-lg-end">
                                            <a href="{{ route('image.create', ['id' => $product->id]) }}"
                                                class="btn btn-danger waves-effect waves-light mb-2 me-2"><i
                                                    class="mdi mdi-tag me-1"></i>Thêm Hình Ảnh Mới</a>
                                            <button type="button" class="btn btn-light waves-effect mb-2">Export</button>
                                        </div>
                                    </div><!-- end col-->
                                </div>

                                <div class="table-responsive">
                                    <table class="table table-centered table-nowrap mb-0" style="table-layout:fixed;">
                                        <thead class="table-light">
                                            <tr>
                                                <th style="width: 20px;">
                                                    <div class="form-check">
                                                        <input type="checkbox" class="form-check-input" id="customCheck1">
                                                        <label class="form-check-label" for="customCheck1">&nbsp;</label>
                                                    </div>
                                                </th>
                                                <th style="width: 125px;">ID Hình Ảnh</th>
                                                <th>Tên Sản Phẩm</th>
                                                <th>Hình Ảnh Sản Phẩm</th>
                                                <th style="width: 125px;">Tương Tác</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($product->get_images as $image)
                                                <tr>
                                                    <td>
                                                        <div class="form-check">
                                                            <input type="checkbox" class="form-check-input"
                                                                id="customCheck2">
                                                            <label class="form-check-label"
                                                                for="customCheck2">&nbsp;</label>
                                                        </div>
                                                    </td>
                                                    <td><a href="" class="text-body fw-bold">{{ $image->id }}</a>
                                                    </td>
                                                    <td
                                                        style="word-wrap: break-word;
                                                    white-space: normal;">
                                                        {{ $product->product_name }}
                                                    </td>
                                                    <td>
                                                        <img src="{{ url($image->product_src) }}" alt=""
                                                            style="width:150px;height:200px;object-fit: contain;">
                                                    </td>


                                                    <td>
                                                        <div style="display:flex">
                                                           
                                                            <a href="{{ route('image.edit', ['id' => $product->id, 'image' => $image->id]) }}"
                                                                class="action-icon">
                                                                <i class="mdi mdi-pencil-outline me-1"></i></a>
                                                            <form
                                                                action="{{ route('image.delete', ['id' => $product->id, 'image' => $image->id]) }}"
                                                                method="POST" enctype="multipart/form-data">
                                                                @csrf
                                                                <button type="submit" class="action-icon"
                                                                    style="background: none!important;border: none;padding: 0!important; text-decoration: underline;cursor: pointer;"><i
                                                                        class="mdi mdi-delete me-1"
                                                                        onclick="deleteData(event);"></i></button>
                                                            </form>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>

                                <ul class="pagination pagination-rounded justify-content-end my-2">
                                    <li class="page-item">
                                        <a class="page-link" href="javascript: void(0);" aria-label="Previous">
                                            <span aria-hidden="true">«</span>
                                            <span class="visually-hidden">Previous</span>
                                        </a>
                                    </li>
                                    <li class="page-item active"><a class="page-link" href="javascript: void(0);">1</a>
                                    </li>
                                    <li class="page-item"><a class="page-link" href="javascript: void(0);">2</a></li>
                                    <li class="page-item"><a class="page-link" href="javascript: void(0);">3</a></li>
                                    <li class="page-item"><a class="page-link" href="javascript: void(0);">4</a></li>
                                    <li class="page-item"><a class="page-link" href="javascript: void(0);">5</a></li>
                                    <li class="page-item">
                                        <a class="page-link" href="javascript: void(0);" aria-label="Next">
                                            <span aria-hidden="true">»</span>
                                            <span class="visually-hidden">Next</span>
                                        </a>
                                    </li>
                                </ul>
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
