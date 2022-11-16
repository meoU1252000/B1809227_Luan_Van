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
                                    <li class="breadcrumb-item active">Imports</li>
                                </ol>
                            </div>
                            <h4 class="page-title">Trang Quản Lý Nhập Hàng</h4>
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
                                            @if ($products->isNotEmpty())
                                                <a href="{{ route('import.create') }}"
                                                    class="btn btn-danger waves-effect waves-light mb-2 me-2"><i
                                                        class="mdi mdi-tag me-1"></i>Thêm Thông Tin Nhập Hàng Mới</a>
                                            @else
                                                <a href="{{ route('import.create') }}"
                                                    class="btn btn-danger waves-effect waves-light mb-2 me-2 disabled"><i
                                                        class="mdi mdi-tag me-1"></i>Thêm Thông Tin Nhập Hàng Mới</a>
                                            @endif
                                                <button type="button"
                                                    class="btn btn-light waves-effect mb-2">Export</button>
                                        </div>
                                    </div><!-- end col-->
                                </div>

                                <div class="row">
                                    <div class="table">
                                        <table class="table table-centered table-nowrap mb-0" style="table-layout:fixed;" id="basic-datatable-import">
                                            <thead class="table-light">
                                                <tr>
                                                    <th style="width: 125px;">ID Nhập Hàng</th>
                                                    <th style="width: 125px;">ID Nhà Cung Cấp</th>
                                                    <th style="width: 125px;">Tên Nhà Cung Cấp</th>
                                                    <th style="width: 125px;">ID Nhân Viên</th>
                                                    <th style="width: 125px;">Tên Nhân Viên</th>
                                                    <th style="width: 125px;">Tương Tác</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($imports as $import)
                                                    <tr>
                                                        <td><a href="" class="text-body fw-bold">{{ $import->id }}</a>
                                                        </td>
                                                        <td><a href=""
                                                                class="text-body fw-bold">{{ $import->supplier_id }}</a>
                                                        </td>
                                                        <td
                                                            style="word-wrap: break-word;
                                                        white-space: normal;">
                                                            {{ $import->get_supplier->supplier_name }}
                                                        </td>
                                                        <td><a href=""
                                                                class="text-body fw-bold">{{ $import->staff_id }}</a>
                                                        </td>
                                                        <td
                                                            style="word-wrap: break-word;
                                                        white-space: normal;">
                                                            {{ $import->get_staff->staff_name }}
                                                        </td>

                                                        <td>
                                                            <div style="display:flex">
                                                                <a href="{{ route('import.details.index', ['id' => $import->id]) }}"
                                                                    class="action-icon"> <i class="mdi mdi-eye"></i></a>
                                                                <a href="{{ route('import.edit', $import->id) }}"
                                                                    class="action-icon">
                                                                    <i class="mdi mdi-pencil-outline me-1"></i></a>
                                                                <form action="{{ route('import.delete', $import->id) }}"
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
    <script>

        $(document).ready(function() {
            $('#basic-datatable-import').DataTable({
                order: [
                    [0, 'desc']
                ],
            });
        });

    </script>
@endsection
