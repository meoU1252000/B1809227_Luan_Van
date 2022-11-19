@extends('Admin.dist.creative.main')
@section('header')
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endsection
@section('content')
    <!-- ============================================================== -->
    <!-- Start Page Content here -->
    <!-- ============================================================== -->

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
                                    <li class="breadcrumb-item"><a href="javascript: void(0);">Layouts</a></li>
                                    <li class="breadcrumb-item active">Vertical</li>
                                </ol>
                            </div>
                            <h4 class="page-title">Trang Chủ</h4>
                        </div>
                    </div>
                </div>
                <!-- end page title -->

                <div class="row">
                    <div class="col-md-6 col-xl-3">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-3">
                                        <div class="avatar-sm bg-soft-danger rounded">
                                            <i class="fe-aperture avatar-title font-22 text-danger"></i>
                                        </div>
                                    </div>
                                    <div class="col-9">
                                        <div class="text-end">
                                            <h3 class="text-dark my-1"><span
                                                    data-plugin="counterup">{{ $order_waiting }}</span></h3>
                                            <p class="text-muted mb-1 text-truncate">Đơn chưa xử lý</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div> <!-- end card-->
                    </div> <!-- end col -->

                    <div class="col-md-6 col-xl-3">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-3">
                                        <div class="avatar-sm bg-soft-info rounded">
                                            <i class="fe-shopping-cart avatar-title font-22 text-info"></i>
                                        </div>
                                    </div>
                                    <div class="col-9">
                                        <div class="text-end">
                                            <h3 class="text-dark my-1"><span
                                                    data-plugin="counterup">{{ $total_product }}</span></h3>
                                            <p class="text-muted mb-1 text-truncate">Tổng sản phẩm đang bán</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div> <!-- end card-->
                    </div> <!-- end col -->

                    <div class="col-md-6 col-xl-3">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-3">
                                        <div class="avatar-sm bg-soft-warning rounded">
                                            <i class="fe-bar-chart-2 avatar-title font-22 text-warning"></i>
                                        </div>
                                    </div>
                                    <div class="col-9">
                                        <div class="text-end">
                                            <h3 class="text-dark my-1"><span
                                                    data-plugin="counterup">{{ number_format($total_price_day) }}</span> VNĐ
                                            </h3>
                                            <p class="text-muted mb-1 text-truncate">Doanh thu hôm nay</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div> <!-- end card-->
                    </div> <!-- end col -->

                    <div class="col-md-6 col-xl-3">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-3">
                                        <div class="avatar-sm bg-soft-dark rounded">
                                            <i class="fe-user avatar-title font-22 text-dark"></i>
                                        </div>
                                    </div>
                                    <div class="col-9">
                                        <div class="text-end">
                                            <h3 class="text-dark my-1"><span
                                                    data-plugin="counterup">{{ $total_staff }}</span></h3>
                                            <p class="text-muted mb-1 text-truncate">Tổng nhân viên</p>
                                        </div>
                                    </div>
                                </div>
                                {{-- <div class="mt-3">
                                    <h6 class="text-uppercase">Target <span class="float-end">74%</span></h6>
                                    <div class="progress progress-sm m-0">
                                        <div class="progress-bar bg-dark" role="progressbar" aria-valuenow="74"
                                            aria-valuemin="0" aria-valuemax="100" style="width: 74%">
                                            <span class="visually-hidden">74% Complete</span>
                                        </div>
                                    </div>
                                </div> --}}
                            </div>
                        </div> <!-- end card-->
                    </div> <!-- end col -->
                </div>
                <!-- end row -->

                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="card-widgets">
                                    <select class="form-control" id="revenue-id" data-width="100%" name="revenue">
                                        <option value="thisyear" selected>Năm hiện tại</option>
                                        <option value="thisweek">Tuần này</option>
                                        <option value="weekago">Tuần trước</option>
                                        <option value="thismonth">Tháng này</option>
                                        <option value="monthago">Tháng trước</option>
                                    </select>
                                </div>
                                <h4 class="header-title mb-0" id="revenue-title">Doanh Thu Năm Hiện Tại</h4>

                                <div id="cardCollpase3" class="collapse pt-3 show">
                                    <div class="text-center">
                                        <canvas id="myBarChart" width="100%" height="40"></canvas>

                                    </div>
                                </div> <!-- collapsed end -->
                            </div> <!-- end card-body -->
                        </div> <!-- end card-->
                    </div> <!-- end col-->

                </div>
                <!-- end row -->

                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="card-widgets">
                                    {{-- <a href="javascript: void(0);" data-toggle="reload"><i class="mdi mdi-refresh"></i></a>
                                    <a data-bs-toggle="collapse" href="#cardCollpase5" role="button" aria-expanded="false"
                                        aria-controls="cardCollpase5"><i class="mdi mdi-minus"></i></a>
                                    <a href="javascript: void(0);" data-toggle="remove"><i class="mdi mdi-close"></i></a> --}}
                                    <select class="form-control" id="statistical-id" data-width="100%" name="statistical">
                                        <option value="" selected>Từ trước đến nay</option>
                                        <option value="thisyear">Năm nay</option>
                                        <option value="thisweek">Tuần này</option>
                                        <option value="weekago">Tuần trước</option>
                                        <option value="thismonth">Tháng này</option>
                                        <option value="monthago">Tháng trước</option>
                                    </select>
                                </div>
                                {{-- <div class="card-widgets" style="margin-right: 10px">
                                    <form method="POST" enctype="multipart/form-data" id="submitDashboard">
                                        <div class="input-group input-daterange">
                                            <input type="text" class="form-control" value="2012-04-05"
                                                style="margin-right:10px" readonly='true' name="date_start"
                                                id="start-date" placeholder="Từ ngày">
                                            <input type="text" class="form-control" value="2012-04-19"
                                                readonly='true' name="date_end" placeholder="Đến ngày" id="end-date"
                                                style="margin-right:10px">
                                            <button class="btn input-group-text" type="submit"
                                                style="background-color: black; color:white">
                                                Tìm kiếm
                                                <i class="fe-search"></i>
                                            </button>
                                        </div>
                                    </form>
                                </div> --}}
                                <h4 class="header-title mb-0">Top 10 Sản Phẩm Bán Chạy</h4>

                                <div id="cardCollpase5" class="collapse pt-3 show">
                                    <div class="table">
                                        <table class="table table-hover table-centered mb-0" id="product-filter">
                                            <thead>
                                                <tr>
                                                    <th>Tên Sản Phẩm</th>
                                                    <th>Số Lượng</th>
                                                    <th>Tổng Doanh Thu</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($product_statistical as $product)
                                                    <tr>
                                                        <td>{{ $product['product_name'] }}</td>
                                                        <td>{{ $product['product_quantity'] }}</td>
                                                        <td>{{ number_format($product['total_price']) }}</td>
                                                    </tr>
                                                @endforeach

                                            </tbody>
                                        </table>
                                    </div> <!-- end table responsive-->
                                </div> <!-- collapsed end -->
                            </div> <!-- end card-body -->
                        </div> <!-- end card-->
                    </div> <!-- end col -->
                </div>
                <!-- end row -->


                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="card-widgets">
                                    {{-- <a href="javascript: void(0);" data-toggle="reload"><i class="mdi mdi-refresh"></i></a>
                                    <a data-bs-toggle="collapse" href="#cardCollpase5" role="button" aria-expanded="false"
                                        aria-controls="cardCollpase5"><i class="mdi mdi-minus"></i></a>
                                    <a href="javascript: void(0);" data-toggle="remove"><i class="mdi mdi-close"></i></a> --}}

                                    <form class="app-search" method="POST" enctype="multipart/form-data"
                                        id="submitForm">
                                        <div class="app-search-box dropdown d-flex">
                                            <div class="input-group input-daterange">
                                                <input type="text" class="form-control" style="margin-right:10px"
                                                    readonly='true' name="date_start" id="start-date"
                                                    placeholder="Từ ngày">
                                                <input type="text" class="form-control" readonly='true'
                                                    name="date_end" placeholder="Đến ngày" id="end-date"
                                                    style="margin-right:10px">
                                            </div>
                                            <div class="input-group">
                                                <input type="search" class="form-control" placeholder="Search..."
                                                    id="top-search" name="search_product">
                                                <button class="btn input-group-text" type="submit"
                                                    style="background-color: black; color:white">
                                                    <i class="fe-search"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </form>

                                </div>

                                <h4 class="header-title mb-0">Kiểm tra doanh thu sản phẩm</h4>

                                <div id="cardCollpase5" class="collapse pt-3 show">
                                    <div class="table">
                                        <table class="table table-hover table-centered mb-0" id="one-product-filter">
                                            <thead>
                                                <tr>
                                                    <th>Tên Sản Phẩm</th>
                                                    <th>Mã Phiếu Nhập</th>
                                                    <th>Số Lượng Nhập</th>
                                                    <th>Đơn Giá Nhập</th>
                                                    <th>Tổng Vốn</th>
                                                    <th>SP Đã Bán</th>
                                                    <th>Đơn Giá Bán</th>
                                                    <th>Tổng Doanh Thu</th>
                                                    <th>Tổng Kết</th>
                                                </tr>
                                            </thead>
                                            <tbody>

                                            </tbody>
                                        </table>
                                    </div> <!-- end table responsive-->
                                </div> <!-- collapsed end -->
                            </div> <!-- end card-body -->
                        </div> <!-- end card-->
                    </div> <!-- end col -->
                </div>

            </div> <!-- container -->

        </div> <!-- content -->



    </div>

    <!-- ============================================================== -->
    <!-- End Page content -->
    <!-- ============================================================== -->
@endsection
@section('footer')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
    <script src="{{ asset('assets/libs/spectrum-colorpicker2/spectrum.min.js') }}"></script>
    <script src="{{ asset('assets/libs/clockpicker/bootstrap-clockpicker.min.js') }}"></script>
    <script src="{{ asset('assets/libs/flatpickr/flatpickr.min.js') }}"></script>
    <script src="{{ asset('assets/libs/bootstrap-datepicker/js/bootstrap-datepicker.min.js') }}"></script>
    <script src="{{ asset('assets/js/pages/form-pickers.init.js') }}"></script>
    {{-- <script src="{{ asset('assets/js/vendor.min.js')}}"></script> --}}
    {{-- <script src="{{ asset('assets/js/app.min.js')}}"></script> --}}
    <script type="text/javascript">
        $(function() {
            $("#start-date").datepicker({
                dateFormat: "yy-mm-dd"
            }).val()
            $("#end-date").datepicker({
                dateFormat: "yy-mm-dd"
            }).val()
        });
    </script>
    <script>
        Chart.defaults.global.defaultFontFamily =
            '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
        Chart.defaults.global.defaultFontColor = '#292b2c';

        // Bar Chart Example
        var ctx1 = document.getElementById("myBarChart");
        var myLineChart1 = new Chart(ctx1, {
            type: 'bar',
            data: {
                labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
                datasets: [{
                    label: "Doanh Thu Năm Hiện Tại",
                    backgroundColor: "rgba(2,117,216,1)",
                    borderColor: "rgba(2,117,216,1)",
                    data: [<?php echo join(',', $data); ?>],
                }],
            },
            options: {
                scales: {
                    xAxes: [{
                        time: {
                            unit: 'month'
                        },
                        gridLines: {
                            display: false
                        },
                        ticks: {
                            maxTicksLimit: 12
                        },
                        scaleLabel: {
                            display: true,
                            labelString: 'Tháng'
                        }
                    }],
                    yAxes: [{
                        autoSkip: false,
                        ticks: {
                            min: 0,
                            //   max: ({{ $sum }}).toLocaleString('it-IT', {style : 'currency', currency : 'VND'}),
                            callback: function(value, index, values) {
                                return value.toLocaleString('it-IT', {
                                    style: 'currency',
                                    currency: 'VND'
                                });
                            },
                            maxTicksLimit: 12
                        },
                        gridLines: {
                            display: true
                        },
                        scaleLabel: {
                            display: true,
                            labelString: 'Doanh Thu'
                        }
                    }],
                },
                legend: {
                    display: false
                }
            }
        })
        $(document).ready(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $("#revenue-id").change(function(e) {
                var request = $('#revenue-id').val();
                var titleChart = document.getElementById("revenue-title");
                $.ajax({
                    type: "POST",
                    url: "admin/filter",
                    data: {
                        "dashboard_value": request,
                        "_token": "{{ csrf_token() }}"
                    },
                    success: function(data) {
                        if (data.code == 200) {
                            if (request == 'thisweek') {
                                myLineChart1.data = {
                                        labels: ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat',
                                            'Sun'
                                        ],
                                        datasets: [{
                                            label: "Revenue",
                                            backgroundColor: "rgba(2,117,216,1)",
                                            borderColor: "rgba(2,117,216,1)",
                                            data: data.data.map(Number),
                                        }],
                                    },
                                    myLineChart1.options.scales.xAxes[0]['scaleLabel']
                                    .labelString = "Ngày trong tuần";
                                // myLineChart1.options.scales.xAxes.scaleLabel.labelString = 'Ngày trong tuần'
                                myLineChart1.update();
                                titleChart.innerHTML = "Doanh Thu Tuần Này"
                            } else if (request == 'thismonth') {
                                myLineChart1.data = {
                                        labels: [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11,
                                            12, 13, 14, 15, 16, 17, 18, 19, 20,
                                            21, 22, 23, 24, 25, 26, 27, 28, 29,
                                            30
                                        ],
                                        datasets: [{
                                            label: "Doanh Thu",
                                            backgroundColor: "rgba(2,117,216,1)",
                                            borderColor: "rgba(2,117,216,1)",
                                            data: data.data.map(Number),
                                        }],
                                    },
                                    myLineChart1.options.scales.xAxes[0]['scaleLabel']
                                    .labelString = "Ngày trong tháng";
                                titleChart.innerHTML = "Doanh Thu Tháng Này"
                                myLineChart1.update();
                            } else if (request == 'monthago') {
                                myLineChart1.data = {
                                        labels: [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11,
                                            12, 13, 14, 15, 16, 17, 18, 19, 20,
                                            21, 22, 23, 24, 25, 26, 27, 28, 29,
                                            30
                                        ],
                                        datasets: [{
                                            label: "Doanh Thu",
                                            backgroundColor: "rgba(2,117,216,1)",
                                            borderColor: "rgba(2,117,216,1)",
                                            data: data.data.map(Number),
                                        }],
                                    },
                                    myLineChart1.options.scales.xAxes[0]['scaleLabel']
                                    .labelString = "Ngày trong tháng";
                                titleChart.innerHTML = "Doanh Thu Tháng Trước"
                                myLineChart1.update();
                            } else if (request == 'weekago') {
                                myLineChart1.data = {
                                        labels: ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat',
                                            'Sun'
                                        ],
                                        datasets: [{
                                            label: "Doanh Thu",
                                            backgroundColor: "rgba(2,117,216,1)",
                                            borderColor: "rgba(2,117,216,1)",
                                            data: data.data.map(Number),
                                        }],
                                    },
                                    myLineChart1.options.scales.xAxes[0]['scaleLabel']
                                    .labelString = "Ngày trong tuần";
                                titleChart.innerHTML = "Doanh Thu Tuần Trước"
                                myLineChart1.update();
                            } else if (request == 'thisyear') {
                                myLineChart1.data = {
                                        labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun',
                                            'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'
                                        ],
                                        datasets: [{
                                            label: "Doanh Thu",
                                            backgroundColor: "rgba(2,117,216,1)",
                                            borderColor: "rgba(2,117,216,1)",
                                            data: data.data,
                                        }],
                                    },
                                    myLineChart1.options.scales.xAxes[0]['scaleLabel']
                                    .labelString = "Tháng";
                                titleChart.innerHTML = "Doanh Thu Năm Hiện Tại"
                                myLineChart1.update();
                            }

                        } else {
                            alert("Thất bại. Vui lòng thử lại");
                        }
                    }

                })

            })
        })

        var dataTable;
        $(document).ready(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            dataTable = $('#product-filter').DataTable({
                "ajax": {
                    type: "POST",
                    url: "{{ route('admin.product_filter') }}",
                    data: {
                        "filter_value": function() {
                            return $('#statistical-id').val()
                        },
                        "_token": "{{ csrf_token() }}"
                    },
                },
                "columns": [{
                        "data": "product_name"
                    },
                    {
                        "data": "product_quantity"
                    },
                    {
                        "data": "total_price",
                        render: $.fn.dataTable.render.number(',')
                    },
                ],
                order: [
                    [2, 'desc']
                ],
                "paging": false,
                "searching": false
            })
            $("#statistical-id").change(function(e) {
                // var request = $('#statistical-id').val();
                dataTable.ajax.reload();
            })
        });

        var dataTable1
        $(document).ready(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            dataTable1 = $('#one-product-filter').DataTable({
                "ajax": {
                    type: "POST",
                    url: "{{ route('admin.product_statistical') }}",
                    data: {
                        filter: function() {
                            return $('#submitForm').serialize();
                        },
                    },
                },
                "columns": [{
                        "data": "product_name"
                    },
                    {
                        "data": "import_id"
                    },
                    {
                        "data": "import_product_quantity",
                        render: $.fn.dataTable.render.number(',')
                    },
                    {
                        "data": "import_price",
                        render: $.fn.dataTable.render.number(',')
                    },
                    {
                        "data": "cost_price",
                        render: $.fn.dataTable.render.number(',')
                    },
                    {
                        "data": "product_sold"
                    },
                    {
                        "data": "sell_price",
                        render: $.fn.dataTable.render.number(',')
                    },
                    {
                        "data": "product_turnover",
                        render: $.fn.dataTable.render.number(',')
                    },
                    {
                        "data": "total_price",
                        render: $.fn.dataTable.render.number(',')
                    },
                ],
                "paging": true,
                "searching": false,
                order: [
                    [7, 'desc']
                ],
            })
            $("#submitForm").submit(function(e) {
                e.preventDefault();
                dataTable1.ajax.reload();

            });

        });
    </script>
@endsection
