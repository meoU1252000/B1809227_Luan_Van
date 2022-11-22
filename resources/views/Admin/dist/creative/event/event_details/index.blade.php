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
                                    <li class="breadcrumb-item active">Event</li>
                                </ol>
                            </div>
                            <h4 class="page-title">Trang Quản Lý Sự Kiện</h4>
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
                                            <a href="{{ route('event.details.create',['id' => $event->id]) }}"
                                                class="btn btn-danger waves-effect waves-light mb-2 me-2"><i
                                                    class="mdi mdi-tag me-1"></i>Thêm Mã Giảm Giá</a>
                                            <button type="button" class="btn btn-light waves-effect mb-2">Export</button>
                                        </div>
                                    </div><!-- end col-->
                                </div>

                                <div class="row">
                                    <div class="table">
                                        <table class="table table-centered table-nowrap mb-0" style="table-layout:fixed;" id="basic-datatable">
                                            <thead class="table-light">
                                                <tr>
                                                    <th style="width: 125px;">ID Mã</th>
                                                    <th style="width: 125px;">ID Sự Kiện</th>
                                                    <th style="width: 150px;">Mã Code</th>
                                                    <th style="width: 150px;">Giá Trị Giảm</th>
                                                    <th style="width: 150px;">Đơn Vị Giảm</th>
                                                    <th style="width: 200px;">Ngày Bắt Đầu</th>
                                                    <th style="width: 200px;">Ngày Kết Thúc</th>
                                                    <th style="width: 125px;">Tương Tác</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($event->get_details as $event_detail)
                                                    <tr>
                                                        <td><a href="" class="text-body fw-bold">{{ $event_detail->id }}</a>
                                                        </td>
                                                        <td><a href="" class="text-body fw-bold">{{ $event_detail->event_id }}</a>
                                                        </td>
                                                        <td
                                                            style="word-wrap: break-word;
                                                        white-space: normal;">
                                                            {{ $event_detail->code_name }}
                                                        </td>
                                                        <td style="white-space: inherit;">
                                                            {{ number_format($event_detail->discount_value) }}
                                                        </td>
                                                        <td style="white-space: inherit;">
                                                            @if ($event_detail->discount_unit == '0')
                                                                Giảm theo phần trăm
                                                            @else
                                                               Giảm theo giá tiền
                                                            @endif

                                                        </td>
                                                        <td>
                                                          {{$event_detail->event_start}}
                                                        </td>

                                                        <td>
                                                            {{$event_detail->event_end}}
                                                        </td>

                                                        <td>
                                                            <div style="display:flex">
                                                                {{-- <a href="javascript:void(0);" class="action-icon"> <i
                                                                    data-feather="eye"></i></a> --}}
                                                                <a href="{{ route('event.details.edit', ['id' => $event->id,'event' =>$event_detail->id]) }}"
                                                                    class="action-icon">
                                                                    <i class="mdi mdi-pencil-outline me-1"></i></a>
                                                                <form action="{{ route('event.details.delete', ['id' => $event->id,'event' =>$event_detail->id]) }}"
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
