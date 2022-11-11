<!DOCTYPE html>
<html lang='en'>

<head>
    <meta charset="utf-8" />
    <title>{{ $title }}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="A fully featured admin theme which can be used to build CRM, CMS, etc." name="description" />
    <meta content="Coderthemes" name="author" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <!-- App favicon -->
    <link rel="shortcut icon" href="{{ asset('assets/images/favicon.ico') }}">

    <!-- plugin css -->
    <link href="{{ asset('assets/libs/admin-resources/jquery.vectormap/jquery-jvectormap-1.2.2.css') }}"
        rel="stylesheet" type="text/css" />
    <!-- App css -->
    <link href="{{ asset('assets/css/config/creative/bootstrap.min.css') }}" rel="stylesheet" type="text/css"
        id="bs-default-stylesheet" />
    <link href="{{ asset('assets/css/config/creative/app.min.css') }}" rel="stylesheet" type="text/css"
        id="app-default-stylesheet" />

    <link href="{{ asset('assets/css/config/creative/bootstrap-dark.min.css') }}" rel="stylesheet" type="text/css"
        id="bs-dark-stylesheet" />
    <link href="{{ asset('assets/css/config/creative/app-dark.min.css') }}" rel="stylesheet" type="text/css"
        id="app-dark-stylesheet" />

    <!-- icons -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js"
        integrity="sha512-aVKKRRi/Q/YV+4mjoKBsE4x3H+BkegoM/em46NNlCqNTmUYADjBbeNefNxYV7giUp0VxICtqdrbqU7iVaeZNXA=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <link href="{{ asset('assets/css/icons.min.css') }}" rel="stylesheet" type="text/css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <link rel="stylesheet" type="text/css"
        href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    @yield('header')

</head>
<body>
    <h3>Đặt hàng thành công</h3>
    <table class="table table-centered table-nowrap mb-0" style="table-layout:fixed;">
        <thead class="table-light">
            <tr>
                <th style="width: 20px;">
                    <div class="form-check">
                        <input type="checkbox" class="form-check-input" id="customCheck1">
                        <label class="form-check-label" for="customCheck1">&nbsp;</label>
                    </div>
                </th>
                <th style="width: 125px;">Mã Đơn</th>
                <th style="width: 150px;">Sản Phẩm</th>
                <th style="width: 150px;">Số Lượng</th>
                <th style="width: 150px;">Giá Tiền</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($mailData as $product)
                <tr>
                    <td>
                        <div class="form-check">
                            <input type="checkbox" class="form-check-input"
                                id="customCheck2">
                            <label class="form-check-label"
                                for="customCheck2">&nbsp;</label>
                        </div>
                    </td>
                    <td><a href="" class="text-body fw-bold">{{ $supplier->id }}</a>
                    </td>
                    <td
                        style="word-wrap: break-word;
                    white-space: normal;">
                        {{ $supplier->supplier_name }}
                    </td>
                    <td
                        style="word-wrap: break-word;
                    white-space: normal;">
                        {{ $supplier->supplier_address }}
                    </td>
                    <td
                        style="word-wrap: break-word;
                    white-space: normal;">
                        {{ $supplier->supplier_email }}
                    </td>
                    <td
                        style="word-wrap: break-word;
                    white-space: normal;">
                        {{ $supplier->supplier_phone }}
                    </td>
                    <td>
                        <h5>
                            <span class="badge bg-info" style="font-size: 1em">
                                @switch(true)
                                    @case($supplier->supplier_status == 0)
                                        "Không Nhập Hàng"
                                    @break;
                                    @case($supplier->supplier_status == 1)
                                        "Đang nhập hàng"
                                    @break;
                                    @case($supplier->supplier_status == 2)
                                        "Tạm Ngưng Nhập Hàng"
                                    @break;
                                @endswitch
                            </span>
                        </h5>
                    </td>
                    <td>
                        <div style="display:flex">
                            {{-- <a href="javascript:void(0);" class="action-icon"> <i
                                data-feather="eye"></i></a> --}}
                            <a href="{{ route('supplier.edit', $supplier->id) }}"
                                class="action-icon">
                                <i class="mdi mdi-pencil-outline me-1"></i></a>
                            <form action="{{ route('supplier.delete', $supplier->id) }}"
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
</body>
</html>
