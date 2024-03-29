<!DOCTYPE html>
<html lang='en'>

<head>
    <meta charset="utf-8" />
    <title>Send Mail</title>
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
</head>

<body>
    <h3>{{ $mailData['greeting'] }}</h3>
    <h3>{{ $mailData['lastline'] }}</h3>
    <ul>Thông tin giao hàng:
        <li>Tên người nhận: {{$mailData['receiver_name'] }}</li>
        <li>Số điện thoại: {{$mailData['receiver_phone'] }}</li>
        <li>Địa chỉ nhận hàng: {{$mailData['receiver_address']}}</li>
    </ul>
    <ul>
        Thông tin đơn hàng:
        @foreach ($mailData['body'] as $product)
            <li>
                Sản phẩm: {{ $product['name'] }}
                <br>
                Số Lượng: {{ $product['quantity'] }}
                <br>
                Giá: {{ $product['price'] }}
            </li>
        @endforeach
    </ul>

    <h3>Tổng Giá Trị Đơn Hàng: {{ number_format($mailData['total_price']) }} VNĐ</h3>
    <h3>Hình thức thanh toán: {{$mailData['payment']}}</h3>
    <h3>{{ $mailData['actiontext'] }}</h3>
    <a href="{{ $mailData['actionurl'] }}">Đạt Lê Store</a>
</body>

</html>
