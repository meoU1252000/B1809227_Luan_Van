<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>{{ $title }}</title>
    <!-- Favicon-->
    <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
    <!-- Bootstrap icons-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/js/all.min.js" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"
        integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"
        integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"
        integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
        integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"
        integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"
        integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous">
    </script>
    <!-- Core theme CSS (includes Bootstrap)-->
    <link rel="stylesheet" href="{{asset('css/bootstrap.css') }}"/>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link href="{{ asset('css/client_styles.css') }}" rel="stylesheet" />
    @yield('css')
</head>

<body>
    <!-- Navigation-->
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container px-4 px-lg-5">
            <a class="navbar-brand" href="{{ route('client.index') }}">Thành Đạt Store</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0 ms-lg-4">
                    <li class="nav-item"><a class="nav-link active" aria-current="page" href="#!">Home</a></li>
                    <li class="nav-item"><a class="nav-link" href="#!">About</a></li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button"
                            data-bs-toggle="dropdown" aria-expanded="false">Shop</a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            @foreach ($categories as $category)
                                @if (count($category->childrenCategories))
                                    <li>
                                        <a class="dropdown-item" href="#">
                                            {{ $category->category_name }} &raquo;
                                        </a>
                                        @include('clients.treeCategory')
                                    </li>
                                @else
                                    <li><a class="dropdown-item" href="#">{{ $category->category_name }}</a>
                                    </li>
                                @endif
                            @endforeach

                        </ul>
                    </li>
                </ul>
                <form class="d-flex">
                    <button class="btn btn-outline-dark" type="submit">
                        <i class="bi-cart-fill me-1"></i>
                        Cart
                        <span class="badge bg-dark text-white ms-1 rounded-pill">0</span>
                    </button>
                </form>
                <div style="margin-top: 0em;margin-block-end: 1em;margin-left: 1em;">
                    <a class="btn btn-outline-dark" data-toggle="modal" data-target="#exampleModal">
                        Login
                    </a>
                </div>
                <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog"
                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content modal_position">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Đăng Nhập</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form action="./login.php" method="POST" enctype="multipart/form-data" id="validator_signin">
                                    <div class="form-group">
                                        <label for="username">Tên Đăng Nhập</label>
                                        <input type="text" class="form-control" id="username"
                                            name="username_login" />
                                        <span class="form__message"></span>
                                    </div>
                                    <div class="form-group">
                                        <label for="password">Password</label>
                                        <input type="password" class="form-control" id="password"
                                            name="password_login" />
                                        <span class="form__message"></span>
                                    </div>
                                    <div class="login-form__forget">
                                        <a href class="forget_link" data-dismiss="modal" data-toggle="modal"
                                            data-target="#exampleModalM"> Quên Mật Khẩu ? </a>
                                        <span class="login-form__forget-separate"></span>
                                        <a href class="signin_link" data-dismiss="modal" data-toggle="modal"
                                            data-target="#exampleModalS"> Đăng Ký</a>
                                    </div>

                                    <div class="modal_button">
                                        <button type="button" class="btn btn-secondary" style="width:120px"
                                            data-dismiss="modal">Trở Lại</button>
                                        <button type="submit" class="btn btn-primary"
                                            style="width:150px;color: white;background-color:#063547;">Đăng
                                            Nhập</button>
                                    </div>
                                </form>
                            </div>

                        </div>
                    </div>
                </div>

                <div class="modal fade" id="exampleModalS" tabindex="-1" role="dialog"
                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content modal_position_sign">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Đăng Ký</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form action="./registration.php" method="POST" enctype="multipart/form-data"
                                    id="validator_signup">
                                    <div class="form-group">
                                        <label for="username">Tên Đăng Nhập</label>
                                        <input type="text" class="form-control" id="new-username" placeholder=""
                                            name="new-username" />
                                        <span class="form__message"></span>
                                    </div>
                                    <div class="form-group">
                                        <label for="email">Email</label>
                                        <input type="email" class="form-control" id="new-email" placeholder=""
                                            name="new-email" />
                                        <span class="form__message"></span>
                                    </div>
                                    <div class="form-group">
                                        <label for="password">Mật Khẩu</label>
                                        <input type="password" class="form-control" id="new-password" placeholder=""
                                            name="new-password" />
                                        <small id="passwordHelpBlock" class="form-text text-muted">
                                            Mật Khẩu phải có tối thiểu tám ký tự, ít nhất một chữ cái viết hoa, một chữ
                                            cái viết thường, một số và một kí tự đặc biệt!
                                            <span class="form__message"></span>
                                    </div>
                                    <div class="form-group">
                                        <label for="new-repassword">Xác Nhận Mật Khẩu</label>
                                        <input type="password" class="form-control" id="new-repassword"
                                            placeholder="" />
                                        <span class="form__message"></span>
                                    </div>
                                    <div class="confirm_signup">
                                        Bằng việc đăng ký, bạn đã đồng ý với <span>Thành Đạt Store</span> về <a
                                            href="">Điều khoản dịch vụ</a> & <a href="">Chính sách bảo
                                            mật</a>
                                    </div>

                                    <div class="modal_button">
                                        <button type="button" class="btn btn-secondary" style="width:120px"
                                            data-dismiss="modal">Trở Lại</button>
                                        <button type="submit" class="btn btn-primary"
                                            style="width:150px; color: white;background-color:#063547;"
                                            name="registration_submit">Đăng Ký</button>
                                    </div>
                                </form>
                            </div>

                        </div>
                    </div>
                </div>

            </div>
        </div>
    </nav>
    <!-- Header-->
    <header class="bg-dark py-5">
        <div class="container px-4 px-lg-5 my-5">
            <div class="text-center text-white">
                <h1 class="display-4 fw-bolder">Thành Đạt Store</h1>
                <p class="lead fw-normal text-white-50 mb-0">Uy tín làm nên thương hiệu</p>
            </div>
        </div>
    </header>
