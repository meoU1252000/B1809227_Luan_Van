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
                                    <li class="breadcrumb-item active">Attributes</li>
                                </ol>
                            </div>
                            <h4 class="page-title">Trang Quản Lý Thuộc Tính</h4>
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
                                            <a href="{{ route('attribute.create') }}"
                                                class="btn btn-danger waves-effect waves-light mb-2 me-2"><i
                                                    class="mdi mdi-clipboard-list me-1"></i>Thêm Thuộc Tính Cho Danh Mục</a>
                                            <button type="button" class="btn btn-light waves-effect mb-2">Export</button>
                                        </div>
                                    </div><!-- end col-->
                                </div>

                                <div class="row">
                                    <div class="table">
                                        <table class="table table-centered table-nowrap mb-0" style="table-layout:fixed;" id="basic-datatable">
                                            <thead class="table-light">
                                                <tr>
                                                    <th style="width: 125px;">ID Danh Mục</th>
                                                    <th
                                                        style="width: 250px;word-wrap: break-word;
                                                    white-space: normal;">
                                                        Tên Danh Mục</th>
                                                    <th>Thuộc Tính Danh Mục</th>
                                                    <th style="width: 125px;">Tương Tác</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($categories as $category)
                                                    <tr>
                                                        <td><a href="" class="text-body fw-bold">{{ $category->id }}</a>
                                                        </td>
                                                        <td
                                                            style="word-wrap: break-word;
                                                        white-space: normal;">
                                                            {{ $category->category_name }}
                                                        </td>
                                                        <td style="white-space: inherit;">
                                                            @foreach ($category->get_attribute as $attribute)
                                                                <li>
                                                                    {{ $attribute->attribute_name }}
                                                                </li>
                                                            @endforeach
                                                        </td>


                                                        <td>
                                                            <div style="display:flex">
                                                                {{-- <a href="javascript:void(0);" class="action-icon"> <i
                                                                data-feather="eye"></i></a> --}}
                                                                <a href="{{ route('attribute.edit', $category->id) }}"
                                                                    class="action-icon">
                                                                    <i class="mdi mdi-pencil-outline me-1"></i></a>
                                                                <form action="{{ route('attribute.delete', $category->id) }}"
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
