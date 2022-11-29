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
                                    <li class="breadcrumb-item active">Customers</li>
                                </ol>
                            </div>
                            <h4 class="page-title">Trang Quản Lý Khách Hàng</h4>
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
                                            <button type="button" class="btn btn-light waves-effect mb-2">Export</button>
                                        </div>
                                    </div><!-- end col-->
                                </div>

                                <div class="row">
                                    <div class="table">
                                        <table class="table table-centered table-nowrap mb-0" style="table-layout:fixed;"
                                            id="basic-datatable-customer">
                                            <thead class="table-light">
                                                <tr>
                                                    <th style="width: 80px;">ID KH</th>
                                                    <th>Tên</th>
                                                    <th>Email</th>
                                                    <th>SĐT</th>
                                                    <th style="width: 120px;">Địa chỉ</th>
                                                    <th style="width: 120px;">Doanh thu</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($customers as $customer)
                                                    <tr>
                                                        <td><a href=""
                                                                class="text-body fw-bold">{{ $customer->id }}</a>
                                                        </td>
                                                        <td
                                                            style="word-wrap: break-word;
                                                        white-space: normal;">
                                                            {{ $customer->customer_name }}
                                                        </td>
                                                        <td
                                                            style="word-wrap: break-word;
                                                        white-space: normal;">
                                                            {{ $customer->email }}
                                                        </td>

                                                        <td
                                                            style="word-wrap: break-word;
                                                        white-space: normal;">
                                                            {{ $customer->customer_phone }}
                                                        </td>
                                                        <td>
                                                            <div style="display:flex">
                                                                <a href="{{ route('customer.address', $customer->id) }}"
                                                                    class="action-icon">
                                                                    <i class="fe-external-link"></i></a>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div style="display:flex">
                                                                <a href="{{ route('customer.revenue', $customer->id) }}"
                                                                    class="action-icon">
                                                                    <i class="fe-dollar-sign"></i></a>

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
@section('footer')
<script>
    $(document).ready(function() {
        $('#basic-datatable-customer').DataTable({
            order: [
                [0, 'desc']
            ],
        });
    });
</script>
@endsection
