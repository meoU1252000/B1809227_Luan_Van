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
                            <h4 class="page-title">Trang Quản Lý Đơn Hàng</h4>
                        </div>
                    </div>
                </div>
                <!-- end page title -->

                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="table">
                                    <table class="table table-centered table-nowrap mb-0" style="table-layout:fixed;"
                                        id="basic-datatable-order">
                                        <thead class="table-light">
                                            <tr>
                                                <th style="width: 60px;">Mã ĐH</th>
                                                <th style="width: 60px;">Mã KH</th>
                                                <th style="width: 60px;">Mã ĐC</th>
                                                <th style="width: 60px;">Mã NV</th>
                                                <th style="width: 60px;">Mã SK</th>
                                                <th class="d-none">SĐT</th>
                                                <th style="width:180px">Ngày Đặt</th>
                                                <th style="width:180px">Ngày Giao</th>
                                                <th>Tình Trạng</th>
                                                <th>Tổng Giá Trị</th>
                                                <th>Tương Tác</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($orders as $order)
                                                <tr>
                                                    <td><a href="" class="text-body fw-bold">{{ $order->id }}</a>
                                                    <td><a href="" class="text-body fw-bold">{{ $order->get_customer($order->address_id)->id }}</a>
                                                    <td>
                                                        <a href="" class="text-body fw-bold">{{ $order->address_id }}
                                                    </td>
                                                    <td>
                                                        <a href="" class="text-body fw-bold">{{ $order->staff_id }}
                                                    </td>
                                                    <td>
                                                        <a href="" class="text-body fw-bold">{{ $order->event_id }}
                                                    </td>
                                                    <td class="d-none">
                                                        {{ $order->get_address->receiver_phone }}
                                                    </td>
                                                    <td>
                                                        {{ $order->created_at }}
                                                    </td>
                                                    <td>
                                                        {{ $order->receive_date }}
                                                    </td>
                                                    <td>
                                                        {{ $order->order_status }}
                                                    </td>
                                                    <td>
                                                        {{ number_format($order->total_price) }}
                                                    </td>
                                                    <td>
                                                        <div style="display:flex">
                                                            <a href="{{ route('order.edit', $order->id) }}"
                                                                class="action-icon">
                                                                <i class="mdi mdi-pencil-outline me-1"></i></a>
                                                            {{-- <form action="{{ route('order.delete', $order->id) }}"
                                                                method="POST" enctype="multipart/form-data">
                                                                @csrf
                                                                <button type="submit" class="action-icon"
                                                                    style="background: none!important;border: none;padding: 0!important; text-decoration: underline;cursor: pointer;"><i
                                                                        class="mdi mdi-delete me-1"
                                                                        onclick="deleteData(event);"></i></button>
                                                            </form> --}}
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>

                            </div> <!-- end card-body-->
                        </div> <!-- end card-->
                    </div> <!-- end col -->
                </div>
                <!-- end row -->

            </div> <!-- container -->

        </div> <!-- content -->
    </div>
    <script>
        $(document).ready(function() {
            $('#basic-datatable-order').DataTable({

                order: [
                    [0, 'desc']
                ],
            });
        });
    </script>
@endsection
