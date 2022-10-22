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

    <link rel="shortcut icon" href="{{ asset('assets/images/favicon.ico') }}">
    <link href="{{ asset('assets/css/icons.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('css/base.css') }}" rel="stylesheet" type="text/css" />

    <!-- Core theme CSS (includes Bootstrap)-->
    <link rel="stylesheet" href="{{ asset('css/bootstrap.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link href="{{ asset('css/client_styles.css') }}" rel="stylesheet" />
    @yield('css')
</head>

<body>
    <!-- Navigation-->
    <nav class="navbar navbar-expand-lg navbar-light bg-light" style="padding: 0;margin:0">
        <img src="https://lh3.googleusercontent.com/OYWBnvISVhrl746BT79tkXku1if6CXQ5bFlh2EaMjvy_f3EBr29Dd_FW8we_dWKYpQ40je6EJPZdfT2FMnqOGWKLL4Jt3Wc=w1920-rw"
            alt="">
    </nav>
    <nav class="navbar navbar-expand-lg navbar-light"
        style="height:42px;padding: 0;margin:0;background-color:rgb(20, 53, 195);">
        <div class="container px-4 px-lg-5 my-5">
            <div class="text-center text-white">
                <a href="" class="text-white" style="text-decoration:none"></a>
            </div>
        </div>
    </nav>
    <nav class="navbar navbar-expand-lg navbar-light bg-light" style="height:88px">
        <div class="container px-4 px-lg-5">
            <img src="{{ asset('assets/images/favicon.ico') }}" alt=""
                style="width:3em;height:3em;margin-right:1em">
            <a class="navbar-brand" href="{{ route('client.index') }}">Thành Đạt Store</a>
            <div class="input-group" style="width: 500px;margin-right:1em">
                <input type="text" class="form-control" placeholder="Nhập từ khóa cần tìm">
                <div class="input-group-append">
                    <button class="btn btn-primary" type="button">
                        <i class="fa fa-search"></i>
                    </button>
                </div>
            </div>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>

            <div
                style="margin-top: 0em;margin-block-end: 1em;margin-left: 1em;transform: translateY(0.5em);margin-right:1em;">
                <div class="login_content" data-content-region-name="headerBar" data-toggle="modal"
                    data-target="#exampleModal" data-track-content="true" style="display:flex;cursor:pointer">
                    <i class="far fa-user-circle"
                        style="font-size: 1.8em;
                        transform: translateY(0.4em);"></i>
                    {{-- <a href="" data-toggle="modal" data-target="#exampleModal" style="text-decoration:none">
                            Đăng Nhập
                            Đăng Ký
                        </a> --}}
                    <div class="text-left ml-6" style="margin-left:0.5em">
                        <div type="body" color="textSecondary" class="title css-1kkkgfn">Đăng nhập</div>
                        <div type="body" color="textSecondary" class="title css-1kkkgfn">Đăng ký</div>
                    </div>

                </div>
            </div>
            <form class="d-flex">
                <button class="btn btn-outline-dark" type="submit" style="transform: translateY(0.5em);">
                    <i class="bi-cart-fill me-1"></i>
                    Cart
                    <span class="badge bg-dark text-white ms-1 rounded-pill">0</span>
                </button>
            </form>
            <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content modal_position">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Đăng Nhập</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form action="./login.php" method="POST" enctype="multipart/form-data"
                                id="validator_signin">
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

    <div class="bg-dark">
        <div class="banner">
            <img src="https://lh3.googleusercontent.com/T4faNR7WOsWykeMJ9HLvjQqJ6NOCmedAY895DIhr9AphLCEuYzNNhoj8SfUgHtDSIUMD5K39aQFS_AJIEI5OQw-ldZiNu-k=rw-w1920"
                alt="" style="">
            
        </div>
        <nav class="category">
            <ul class="category-list">
                <li class="category-item">
                        <ul class="category-item_link--heading">
                            <li class="category-item_link--heading-title">
                                THƯƠNG HIỆU NGOẠI P1
                                <ul class="category-item_link--menu">
                                    <li class="category-item_link--menu-item">
                                        <a href="" class="menu-item">18.21 MAN MADE</a>
                                    </li>
                                    <li class="category-item_link--menu-item">
                                        <a href="" class="menu-item">APESTOMEN</a>
                                    </li>
                                    <li class="category-item_link--menu-item">
                                        <a href="" class="menu-item">ACRADIAN GROOMING</a>
                                    </li>
                                    <li class="category-item_link--menu-item">
                                        <a href="" class="menu-item">BY SIDE GROOMING</a>
                                    </li>
                                    <li class="category-item_link--menu-item">
                                        <a href="" class="menu-item">BATTLE BORN GROOMING</a>
                                    </li>
                                    <li class="category-item_link--menu-item">
                                        <a href="" class="menu-item">BULLDOG SKINCARE</a>
                                    </li>
                                  
                                </ul>
                            </li>

                            <li class="category-item_link--heading-title">
                                THƯƠNG HIỆU NGOẠI P2
                                <ul class="category-item_link--menu">
                                    <li class="category-item_link--menu-item">
                                        <a href="" class="menu-item">DUKE CANON</a>
                                    </li>
                                    <li class="category-item_link--menu-item">
                                        <a href="" class="menu-item">EARTH MADE CO.</a>
                                    </li>
                              
                                    <li class="category-item_link--menu-item">
                                        <a href="" class="menu-item">(SHEH•VOO)</a>
                                    </li>
                                    <li class="category-item_link--menu-item">
                                        <a href="" class="menu-item">SUAVECITO</a>
                                    </li>
                                    <li class="category-item_link--menu-item">
                                        <a href="" class="menu-item">STICKMORE</a>
                                    </li>
                                </ul>
                            </li>

                            <li class="category-item_link--heading-title">
                                THƯƠNG HIỆU NGOẠI P3
                                <ul class="category-item_link--menu">
                                    <li class="category-item_link--menu-item">
                                        <a href="" class="menu-item">TEMPLETON TONICS</a>
                                    </li>
                                    <li class="category-item_link--menu-item">
                                        <a href="" class="menu-item">M BRITISH</a>
                                    </li>
                                    <li class="category-item_link--menu-item">
                                        <a href="" class="menu-item">MORRIS MOTLEY</a>
                                    </li>
                           
                                    <li class="category-item_link--menu-item">
                                        <a href="" class="menu-item">RUMBLE59</a>
                                    </li>
                                </ul>
                            </li>

                            <li class="category-item_link--heading-title">
                                THƯƠNG HIỆU VIỆT
                                <ul class="category-item_link--menu">
                                    <li class="category-item_link--menu-item">
                                        <a href="" class="menu-item">HAIR ZONE GROOMING</a>
                                    </li>
                                    <li class="category-item_link--menu-item">
                                        <a href="" class="menu-item">THE GENTS BAY</a>
                                    </li>
                                    <li class="category-item_link--menu-item">
                                        <a href="" class="menu-item">STEPHEN NOLAN 603</a>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                  
                </li>
            </ul>
        </nav>
    </div>
