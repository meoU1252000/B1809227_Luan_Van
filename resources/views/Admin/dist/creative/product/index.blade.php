@extends('Admin.dist.creative.main')
@section('header')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <style>
        .switch {
            position: relative;
            display: inline-block;
            width: 60px;
            height: 34px;
        }

        .switch input {
            opacity: 0;
            width: 0;
            height: 0;
        }

        .slider {
            position: absolute;
            cursor: pointer;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: #ccc;
            -webkit-transition: .4s;
            transition: .4s;
        }

        .slider:before {
            position: absolute;
            content: "";
            height: 26px;
            width: 26px;
            left: 4px;
            bottom: 4px;
            background-color: white;
            -webkit-transition: .4s;
            transition: .4s;
        }

        input:checked+.slider {
            background-color: #2196F3;
        }

        input:focus+.slider {
            box-shadow: 0 0 1px #2196F3;
        }

        input:checked+.slider:before {
            -webkit-transform: translateX(26px);
            -ms-transform: translateX(26px);
            transform: translateX(26px);
        }

        /* Rounded sliders */
        .slider.round {
            border-radius: 34px;
        }

        .slider.round:before {
            border-radius: 50%;
        }
    </style>
@endsection
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
                                    <li class="breadcrumb-item active">Products</li>
                                </ol>
                            </div>
                            <h4 class="page-title">Trang Quản Lý Sản Phẩm</h4>
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
                                            <a href="{{ route('product.create') }}"
                                                class="btn btn-danger waves-effect waves-light mb-2 me-2"><i
                                                    class="mdi mdi-clipboard-list me-1"></i>Thêm Sản Phẩm</a>

                                        </div>
                                    </div><!-- end col-->
                                </div>
                                <div class="row">
                                    <div class="table">
                                        <table class="table table-centered table-nowrap mb-0" style="table-layout:fixed;" id="basic-datatable">
                                            <thead class="table-light">
                                                <tr>
                                                    <th style="width: 125px;">ID Sản Phẩm</th>
                                                    <th style="width: 150px;">Tên Sản Phẩm</th>
                                                    <th style="width: 150px;">Thương Hiệu</th>
                                                    <th style="width: 150px;">Tình Trạng</th>
                                                    <th style="width: 200px;">Hình Ảnh Sản Phẩm</th>
                                                    <th style="width: 125px;">Tương Tác</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($products as $product)
                                                    <tr>
                                                        <td><a href="" class="text-body fw-bold">{{ $product->id }}</a>
                                                        </td>
                                                        <td
                                                            style="word-wrap: break-word;
                                                        white-space: normal;">
                                                            {{ $product->product_name }}
                                                        </td>
                                                        <td>{{ $product->get_brand->brand_name }}</td>
                                                        <td>
                                                            <form action="{{route('product.activeSwitch')}}"  method="POST" enctype="multipart/form-data" class="formAction">
                                                                @csrf
                                                                @if($product->product_status == 1)
                                                                <label class="switch">
                                                                    <input type="checkbox" name="active" value="{{$product->product_status}}" checked class="activeButton" data-id='{{$product->id}}'>
                                                                    <span class="slider round"></span>
                                                                </label>

                                                                @else
                                                                <label class="switch">
                                                                    <input type="checkbox" name="active" value="{{$product->product_status}}" class="activeButton" data-id='{{$product->id}}'>
                                                                    <span class="slider round" ></span>
                                                                </label>

                                                                @endif
                                                            </form>
                                                        </td>

                                                        <td>
                                                            <img src="{{ url($product->main_image_src) }}" alt=""
                                                                style="width:150px;height:200px;object-fit: contain;">
                                                        </td>

                                                        <td>
                                                            <div style="display:flex">
                                                                <a href="{{ route('image.index', ['id'=>$product->id]) }}"
                                                                    class="action-icon">
                                                                    <i class="mdi mdi-eye me-1"></i></a>
                                                                <a href="{{ route('product.edit', $product->id) }}"
                                                                    class="action-icon">
                                                                    <i class="mdi mdi-pencil-outline me-1"></i></a>
                                                                {{-- <form action="{{ route('product.delete', $product->id) }}"
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
    $(document).ready(function(){
        $.ajaxSetup({
          headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
        });
        $(".activeButton").click(function(e) {
            var active = $(this).val();
            var parentElement = e.target.parentElement;
            var id = $(this).data('id');
            var that = $(this);
            // console.log(id);
            if(active == 1){
                $.ajax({
                    type: "GET",
                    url: "{{ route('product.activeSwitch')}}",
                    data: {id:id , product_status: 0},
                    success : function(data) {
                        if(data.code == 200){
                            that.attr("value",0);
                        }else{
                            alert("Thất bại. Vui lòng thử lại");
                        }
                    }

                })

            }else{
                $.ajax({
                    type: "GET",
                    url: "{{ route('product.activeSwitch')}}",
                    data: {id:id,product_status: 1},
                    success : function(data) {
                        if(data.code == 200){
                            that.attr("value",1);
                        }else{
                            alert("Thất bại. Vui lòng thử lại");
                        }
                    }

                })
            }
        })

    })

</script>

@endsection
