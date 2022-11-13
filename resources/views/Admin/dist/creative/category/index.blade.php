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
                                    <li class="breadcrumb-item active">Categories</li>
                                </ol>
                            </div>
                            <h4 class="page-title">Trang Quản Lý Danh Mục</h4>
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
                                            <a href="{{ route('category.create') }}"
                                                class="btn btn-danger waves-effect waves-light mb-2 me-2"><i
                                                    class="mdi mdi-clipboard-list me-1"></i>Thêm Danh Mục Mới</a>
                                        </div>
                                    </div><!-- end col-->
                                </div>
                                <div class="row">
                                    <div class="table">
                                        <table class="table table-centered table-nowrap mb-0" style="table-layout:fixed;" id="basic-datatable">
                                            <thead class="table-light">
                                                <tr>
                                                    <th style="width: 20px;">
                                                        <div class="form-check">
                                                            <input type="checkbox" class="form-check-input" id="customCheck1">
                                                            <label class="form-check-label" for="customCheck1">&nbsp;</label>
                                                        </div>
                                                    </th>
                                                    <th style="width: 125px;">ID Danh Mục</th>
                                                    <th style="width: 125px;">Danh Mục Cha</th>
                                                    <th style="width: 125px;">Tên Danh Mục</th>
                                                    <th>Miêu Tả Danh Mục</th>
                                                    <th style="width: 125px;">Tình Trạng</th>
                                                    <th style="width: 125px;">Tương Tác</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($categories as $category)
                                                    <tr>
                                                        <td>
                                                            <div class="form-check">
                                                                <input type="checkbox" class="form-check-input"
                                                                    id="customCheck2">
                                                                <label class="form-check-label"
                                                                    for="customCheck2">&nbsp;</label>
                                                            </div>
                                                        </td>
                                                        <td><a href="" class="text-body fw-bold">{{ $category->id }}</a>
                                                        </td>
                                                        @if ($category->category_parent == 0)
                                                            <td></td>
                                                        @else
                                                            <td style="word-wrap: break-word;
                                                            white-space: normal;">{{ $category->get_parent->category_name }}</td>
                                                        @endif
                                                        <td>
                                                            {{ $category->category_name }}
                                                        </td>
                                                        <td style="white-space: inherit;">
                                                            {!! $category->category_description !!}
                                                        </td>
                                                        <td>
                                                            <form action="{{route('category.activeSwitch')}}"  method="POST" enctype="multipart/form-data" class="formAction">
                                                                @csrf
                                                                @if($category->category_status == 1)
                                                                <label class="switch">
                                                                    <input type="checkbox" name="active" value="{{$category->category_status}}" checked class="activeButton" data-id='{{$category->id}}'>
                                                                    <span class="slider round"></span>
                                                                </label>

                                                                @else
                                                                <label class="switch">
                                                                    <input type="checkbox" name="active" value="{{$category->category_status}}" class="activeButton" data-id='{{$category->id}}'>
                                                                    <span class="slider round" ></span>
                                                                </label>

                                                                @endif
                                                            </form>
                                                        </td>
                                                    <td>
                                                        <div style="display:flex">
                                                            {{-- <a href="javascript:void(0);" class="action-icon"> <i
                                                                data-feather="eye"></i></a> --}}
                                                            <a href="{{ route('category.edit', $category->id) }}" class="action-icon">
                                                                <i class="mdi mdi-pencil-outline me-1"></i></a>
                                                            <form action="{{ route('category.delete', $category->id) }}"
                                                                method="POST" enctype="multipart/form-data">
                                                                @csrf
                                                                <button type="submit" class="action-icon"
                                                                    style="background: none!important;border: none;padding: 0!important; text-decoration: underline;cursor: pointer;"><i
                                                                    class="mdi mdi-delete me-1" onclick = "deleteData(event);"></i></button>
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
                    url: "{{ route('category.activeSwitch')}}",
                    data: {id:id , category_status: 0},
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
                    url: "{{ route('category.activeSwitch')}}",
                    data: {id:id,category_status: 1},
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
