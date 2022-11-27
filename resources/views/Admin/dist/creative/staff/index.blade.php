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
                                    <li class="breadcrumb-item active">Orders</li>
                                </ol>
                            </div>
                            <h4 class="page-title">Trang Quản Lý Nhân Viên</h4>
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
                                            <a href="{{ route('staff.create') }}"
                                                class="btn btn-danger waves-effect waves-light mb-2 me-2"><i
                                                    class="mdi mdi-tag me-1"></i>Thêm Nhân Viên Mới</a>
                                            <button type="button" class="btn btn-light waves-effect mb-2">Export</button>
                                        </div>
                                    </div><!-- end col-->
                                </div>

                                <div class="row">
                                    <div class="table">
                                        <table class="table table-centered table-nowrap mb-0" style="table-layout:fixed;" id="basic-datatable">
                                            <thead class="table-light">
                                                <tr>
                                                    <th style="width: 80px;">ID NV</th>
                                                    <th>Tên</th>
                                                    <th>Email</th>
                                                    <th>Địa chỉ </th>
                                                    <th>Chức vụ</th>
                                                    <th>SĐT</th>
                                                    <th>Tình Trạng</th>
                                                    <th>Tương Tác</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($staffs as $staff)
                                                    <tr>
                                                        <td><a href="" class="text-body fw-bold">{{ $staff->id }}</a>
                                                        </td>
                                                        <td
                                                            style="word-wrap: break-word;
                                                        white-space: normal;">
                                                            {{ $staff->name }}
                                                        </td>
                                                        <td
                                                            style="word-wrap: break-word;
                                                        white-space: normal;">
                                                            {{ $staff->email }}
                                                        </td>
                                                        <td
                                                            style="word-wrap: break-word;
                                                        white-space: normal;">
                                                            {!! $staff->address !!}
                                                        </td>
                                                        <td
                                                            style="word-wrap: break-word;
                                                        white-space: normal;">
                                                            {{ $staff->position }}
                                                        </td>
                                                        <td
                                                            style="word-wrap: break-word;
                                                        white-space: normal;">
                                                            {{ $staff->phone }}
                                                        </td>
                                                        <td>
                                                            <h5>
                                                                <span class="badge bg-info" style="font-size: 0.75em">
                                                                    @switch(true)
                                                                        @case($staff->status == 0)
                                                                            "Đã Nghỉ Làm"
                                                                        @break;
                                                                        @case($staff->status == 1)
                                                                            "Đang Làm Việc"
                                                                        @break;
                                                                    @endswitch
                                                                </span>
                                                            </h5>
                                                        </td>
                                                        <td>
                                                            <div style="display:flex">
                                                                {{-- <a href="javascript:void(0);" class="action-icon"> <i
                                                                    data-feather="eye"></i></a> --}}
                                                                <a href="{{ route('staff.edit', $staff->id) }}"
                                                                    class="action-icon">
                                                                    <i class="mdi mdi-pencil-outline me-1"></i></a>
                                                                {{-- <form action="{{ route('staff.delete', $staff->id) }}"
                                                                    method="POST" enctype="multipart/form-data">
                                                                    @csrf
                                                                    <button type="submit" class="action-icon"
                                                                        style="background: none!important;border: none;padding: 0!important; text-decoration: underline;cursor: pointer;"><i
                                                                            class="mdi mdi-delete me-1"
                                                                            onclick="deleteData(event);"></i></button>
                                                                </form> --}}
                                                                <a href="{{ route('role.view.assign.user', $staff->id) }}" class="assign_role action-icon">
                                                                    <i class="mdi mdi-format-list-bulleted me-1"></i>
                                                                </a>
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
    <div class="modal fade" id="view-assign-role" tabindex="-1">

    </div>
@endsection
