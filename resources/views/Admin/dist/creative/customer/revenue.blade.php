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

                            <h4 class="page-title">Thông tin tổng quát của khách hàng {{$customer->customer_name}}</h4>
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
                                            <i class="fe-package avatar-title font-22 text-danger"></i>
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
                                            <i class="fe-package avatar-title font-22 text-info"></i>
                                        </div>
                                    </div>
                                    <div class="col-9">
                                        <div class="text-end">
                                            <h3 class="text-dark my-1"><span
                                                    data-plugin="counterup">{{ number_format($percent_order_done, 2, '.', '') }}</span>%</h3>
                                            <p class="text-muted mb-1 text-truncate">Tỉ Lệ Giao Thành Công</p>
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
                                            <i class="fe-bar-chart-2 avatar-title font-22 text-info"></i>
                                        </div>
                                    </div>
                                    <div class="col-9">
                                        <div class="text-end">
                                            <h3 class="text-dark text-sm my-1"><span
                                                    data-plugin="counterup">{{ number_format($total_revenue) }}</span> VNĐ</h3>
                                            <p class="text-muted mb-1 text-truncate">Tổng Sức Mua</p>
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
                                                    data-plugin="counterup">{{ number_format($today_revenue) }}</span> VNĐ
                                            </h3>
                                            <p class="text-muted mb-1 text-truncate">Sức Mua Hôm Nay</p>
                                        </div>
                                    </div>
                                </div>
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
                                    <input type="text" class="form-control" id="customer-id" hidden value="{{$customer->id}}">
                                    <select class="form-control" id="revenue-id" data-width="100%" name="revenue">
                                        <option value="thisyear" selected>Năm hiện tại</option>
                                        <option value="thisweek">Tuần này</option>
                                        <option value="weekago">Tuần trước</option>
                                        <option value="thismonth">Tháng này</option>
                                        <option value="monthago">Tháng trước</option>
                                    </select>
                                </div>
                                <h4 class="header-title mb-0" id="revenue-title">Sức Mua Năm Hiện Tại</h4>

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
                            labelString: 'Sức Mua'
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
                var id = $('#customer-id').val();
                var request = $('#revenue-id').val();
                var titleChart = document.getElementById("revenue-title");
                $.ajax({
                    type: "GET",
                    url: "/admin/customer/dashboard/" + id,
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
                                titleChart.innerHTML = "Sức Mua Tuần Này"
                            } else if (request == 'thismonth') {
                                myLineChart1.data = {
                                        labels: [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11,
                                            12, 13, 14, 15, 16, 17, 18, 19, 20,
                                            21, 22, 23, 24, 25, 26, 27, 28, 29,
                                            30
                                        ],
                                        datasets: [{
                                            label: "Sức Mua",
                                            backgroundColor: "rgba(2,117,216,1)",
                                            borderColor: "rgba(2,117,216,1)",
                                            data: data.data.map(Number),
                                        }],
                                    },
                                    myLineChart1.options.scales.xAxes[0]['scaleLabel']
                                    .labelString = "Ngày trong tháng";
                                titleChart.innerHTML = "Sức Mua Tháng Này"
                                myLineChart1.update();
                            } else if (request == 'monthago') {
                                myLineChart1.data = {
                                        labels: [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11,
                                            12, 13, 14, 15, 16, 17, 18, 19, 20,
                                            21, 22, 23, 24, 25, 26, 27, 28, 29,
                                            30
                                        ],
                                        datasets: [{
                                            label: "Sức Mua",
                                            backgroundColor: "rgba(2,117,216,1)",
                                            borderColor: "rgba(2,117,216,1)",
                                            data: data.data.map(Number),
                                        }],
                                    },
                                    myLineChart1.options.scales.xAxes[0]['scaleLabel']
                                    .labelString = "Ngày trong tháng";
                                titleChart.innerHTML = "Sức Mua Tháng Trước"
                                myLineChart1.update();
                            } else if (request == 'weekago') {
                                myLineChart1.data = {
                                        labels: ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat',
                                            'Sun'
                                        ],
                                        datasets: [{
                                            label: "Sức Mua",
                                            backgroundColor: "rgba(2,117,216,1)",
                                            borderColor: "rgba(2,117,216,1)",
                                            data: data.data.map(Number),
                                        }],
                                    },
                                    myLineChart1.options.scales.xAxes[0]['scaleLabel']
                                    .labelString = "Ngày trong tuần";
                                titleChart.innerHTML = "Sức Mua Tuần Trước"
                                myLineChart1.update();
                            } else if (request == 'thisyear') {
                                myLineChart1.data = {
                                        labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun',
                                            'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'
                                        ],
                                        datasets: [{
                                            label: "Sức Mua",
                                            backgroundColor: "rgba(2,117,216,1)",
                                            borderColor: "rgba(2,117,216,1)",
                                            data: data.data,
                                        }],
                                    },
                                    myLineChart1.options.scales.xAxes[0]['scaleLabel']
                                    .labelString = "Tháng";
                                titleChart.innerHTML = "Sức Mua Năm Hiện Tại"
                                myLineChart1.update();
                            }

                        } else {
                            alert("Thất bại. Vui lòng thử lại");
                        }
                    }

                })

            })
        })
    </script>
@endsection
