<!DOCTYPE html>
<html lang="en">
@include('Admin.dist.creative.header')

<body class="loading" data-layout='{"mode": "light", "width": "fluid", "menuPosition": "fixed", "topbar": {"color": "dark"}, "showRightSidebarOnPageLoad": true}'>
    <!-- Begin page -->
    <div id="wrapper">

        <!-- Topbar Start -->
        <div class="navbar-custom">
            <div class="container-fluid">
                <ul class="list-unstyled topnav-menu float-end mb-0">

                    <li class="dropdown notification-list topbar-dropdown">
                        <a class="nav-link dropdown-toggle nav-user me-0 waves-effect waves-light" data-bs-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                            <img src="../assets/images/users/user-1.jpg" alt="user-image" class="rounded-circle">
                            <span class="pro-user-name ms-1">
                                {{ auth()->user()->name }}
                               {{-- <i class="mdi mdi-chevron-down"></i> --}}
                            </span>
                        </a>
                        {{-- <div class="dropdown-menu dropdown-menu-end profile-dropdown ">
                            <!-- item-->
                            <div class="dropdown-header noti-title">
                                <h6 class="text-overflow m-0">Welcome !</h6>
                            </div>

                            <!-- item-->
                            <a href="javascript:void(0);" class="dropdown-item notify-item">
                                <i class="fe-user"></i>
                                <span>My Account</span>
                            </a>

                            <!-- item-->
                            <a href="javascript:void(0);" class="dropdown-item notify-item">
                                <i class="fe-settings"></i>
                                <span>Settings</span>
                            </a>

                            <!-- item-->
                            <a href="javascript:void(0);" class="dropdown-item notify-item">
                                <i class="fe-lock"></i>
                                <span>Lock Screen</span>
                            </a>

                            <div class="dropdown-divider"></div>

                            <!-- item-->
                            <form action="{{ route('logout') }}" method="POST">
                                <a href="#" class="dropdown-item notify-item">
                                    <i class="fe-log-out"></i>
                                    <span>Logout</span>
                                </a>

                            </form>

                        </div> --}}
                    </li>

                    <li class="dropdown notification-list">
                        <a href="javascript:void(0);" class="nav-link right-bar-toggle waves-effect waves-light">
                            <i class="fe-settings noti-icon"></i>
                        </a>
                    </li>

                </ul>

                <!-- LOGO -->
                <ul class="list-unstyled topnav-menu topnav-menu-left m-0">
                    <li>
                        <button class="button-menu-mobile waves-effect waves-light">
                            <i class="fe-menu"></i>
                        </button>
                    </li>

                    <li>
                        <!-- Mobile menu toggle (Horizontal Layout)-->
                        <a class="navbar-toggle nav-link" data-bs-toggle="collapse" data-bs-target="#topnav-menu-content">
                            <div class="lines">
                                <span></span>
                                <span></span>
                                <span></span>
                            </div>
                        </a>
                        <!-- End mobile menu toggle-->
                    </li>

                </ul>
                <div class="logo-box">
                    <a href="{{route('admin.index')}}" class="logo logo-dark text-center">
                        <span class="logo-sm">
                            <img src="{{ asset('assets/images/logo-sm.png') }}" alt="" height="22">
                            <!-- <span class="logo-lg-text-light">UBold</span> -->
                        </span>
                        <span class="logo-lg">
                            <img src="{{ asset('assets/images/logo-dark.png') }}" alt="" height="20">
                            <!-- <span class="logo-lg-text-light">U</span> -->
                        </span>
                    </a>

                    <a href="{{route('admin.index')}}" class="logo logo-light text-center">
                        <span class="logo-sm">
                            <img src="{{ asset('assets/images/logo-sm.png') }}" alt="" height="22">
                        </span>
                        <span class="logo-lg">
                            <img src="{{ asset('assets/images/logo-light.png') }}" alt="" height="20">
                        </span>
                    </a>
                </div>
                <div class="clearfix"></div>
            </div>
        </div>
        <!-- end Topbar -->

        <!-- ========== Left Sidebar Start ========== -->
        <div class="left-side-menu">

            <div class="h-100" data-simplebar>

                <!--- Sidemenu -->
                <div id="sidebar-menu">

                    <ul id="side-menu">

                        <li class="menu-title">Chính</li>

                        <li>
                            <a href="{{route('admin.index')}}">
                                <i data-feather="airplay"></i>
                                {{-- <span class="badge bg-success rounded-pill float-end">4</span> --}}
                                <span> Trang Chủ </span>
                            </a>
                        </li>
                        <li>
                            <a href="{{route('admin.account')}}">
                                <i data-feather="user"></i>
                                {{-- <span class="badge bg-success rounded-pill float-end">4</span> --}}
                                <span>Tài Khoản</span>
                            </a>
                        </li>
                        <li class="menu-title mt-2">Quản Lý</li>

                        {{-- <li>
                            <a href="{{ route('staff.index') }}">
                        <i class="mdi mdi-account"></i>
                        <span> Quản Lý Nhân Viên </span>
                        </a>
                        </li> --}}
                        @role('Super Admin')
                        {{-- <li>
                            <a href="#sidebarStaff" data-bs-toggle="collapse">
                                <i class="mdi mdi-account"></i>
                                <span> Quản Lý Nhân Viên </span>
                                <span class="menu-arrow"></span>
                            </a>
                            <div class="collapse" id="sidebarStaff">
                                <ul class="nav-second-level">
                                    <li>
                                        <a href="{{ route('staff.index') }}"> Nhân Viên</a>
                                    </li>
                                </ul>
                            </div>
                        </li> --}}
                        <li>
                            <a href="{{ route('staff.index') }}">
                                <i class="mdi mdi-package"></i>
                                <span> Quản Lý Nhân Viên </span>
                            </a>
                        </li>
                        <li>
                            <a href="#sidebarRole" data-bs-toggle="collapse">
                                <i class="mdi mdi-account-star"></i>
                                <span> Quản Lý Vai Trò </span>
                                <span class="menu-arrow"></span>
                            </a>
                            <div class="collapse" id="sidebarRole">
                                <ul class="nav-second-level">
                                    <li>
                                        <a href="{{ route('role.create') }}">Thêm vai trò</a>
                                    </li>
                                    <li>
                                        <a href="{{ route('role.index') }}">Danh sách vai trò</a>
                                    </li>
                                </ul>
                            </div>
                        </li>

                        <li>
                            <a href="#sidebarPermission" data-bs-toggle="collapse">
                                <i class="mdi mdi-police-badge"></i>
                                <span> Quản Lý Quyền </span>
                                <span class="menu-arrow"></span>
                            </a>
                            <div class="collapse" id="sidebarPermission">
                                <ul class="nav-second-level">
                                    <li>
                                        <a href="{{ route('permission.create') }}">Thêm quyền</a>
                                    </li>
                                    <li>
                                        <a href="{{ route('permission.index') }}">Danh sách quyền</a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                        @endrole
                        {{-- <li>
                            <a href="#sidebarStaff" data-bs-toggle="collapse">
                                <i class="mdi mdi-key"></i>
                                <span> Quản Lý Phân Quyền </span>
                                <span class="menu-arrow"></span>
                            </a>
                            <div class="collapse" id="sidebarStaff">
                                <ul class="nav-second-level">
                                    <li>
                                        <a href="{{ route('staff.index') }}">Phân quyền</a>
                                    </li>
                                </ul>
                            </div>
                        </li> --}}
                        @role('Super Admin|Manage Category')
                        <li>
                            <a href="#sidebarList" data-bs-toggle="collapse">
                                <i class="mdi mdi-clipboard-list"></i>
                                <span> Quản Lý Danh Mục </span>
                                <span class="menu-arrow"></span>
                            </a>
                            <div class="collapse" id="sidebarList">
                                <ul class="nav-second-level">
                                    <li>
                                        <a href="{{ route('category.index') }}">Thông Tin Danh Mục</a>
                                    </li>
                                    <li>
                                        <a href="{{ route('attribute.index') }}">Thuộc Tính Danh Mục</a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                        @endrole
                        @role('Super Admin')
                        <li>
                            <a href="{{ route('supplier.index') }}">
                                <i class="mdi mdi-package"></i>
                                <span> Quản Lý Nhà Cung Cấp </span>
                            </a>
                        </li>
                        @endrole
                        @role('Super Admin|Manage Comment')
                        <li>
                            <a href="{{ route('comment.index') }}">
                                <i class="mdi mdi-package"></i>
                                <span> Quản Lý Bình Luận </span>
                            </a>
                        </li>
                        @endrole
                        {{-- <li>
                            <a href="{{ route('brand.index') }}">
                        <i class="mdi mdi-tag"></i>
                        <span> Quản Lý Thương Hiệu </span>
                        </a>
                        </li> --}}

                        {{-- <li>
                            <a href="{{ route('category.index') }}">
                        <i class="mdi mdi-clipboard-list"></i>
                        <span> Quản Lý Danh Mục </span>
                        </a>
                        </li>

                        <li>
                            <a href="{{ route('attribute.index') }}">
                                <i class="mdi mdi-clipboard-list"></i>
                                <span> Quản Lý Thuộc Tính Danh Mục </span>
                            </a>
                        </li> --}}
                        @role('Super Admin|Manage Product')
                        <li>
                            <a href="#sidebarProduct" data-bs-toggle="collapse">
                                <i data-feather="shopping-cart"></i>
                                <span> Quản Lý Sản Phẩm </span>
                                <span class="menu-arrow"></span>
                            </a>
                            <div class="collapse" id="sidebarProduct">
                                <ul class="nav-second-level">
                                    {{-- <li>
                                        <a href="{{ route('family.index') }}">Thông Tin Nhóm Sản Phẩm</a>
                                    </li> --}}
                                    <li>
                                        <a href="{{ route('brand.index') }}">Thông Tin Thương Hiệu</a>
                                    </li>
                                    <li>
                                        <a href="{{ route('product.index') }}">Thông Tin Sản Phẩm</a>
                                    </li>
                                    <li>
                                        <a href="{{ route('price.index') }}">Quản Lý Giá Bán</a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                        @endrole
                        @role('Super Admin|Manage Import Goods')
                        <li>
                            <a href="{{ route('import.index') }}">
                                <i class="mdi mdi-truck"></i>
                                <span> Quản Lý Nhập Hàng </span>
                            </a>
                        </li>
                        @endrole
                        @role('Super Admin|Manage Customer')
                        <li>
                            <a href="{{ route('customer.index') }}">
                                <i class="mdi mdi-account-group"></i>
                                <span> Quản Lý Khách Hàng </span>
                            </a>
                        </li>
                        @endrole('Super Admin|Manage Customer')
                        @role('Super Admin|Manage Order')
                        <li>
                            <a href="{{ route('order.index') }}">
                                <i class="mdi mdi-package"></i>
                                <span> Quản Lý Đơn Hàng </span>
                            </a>
                        </li>
                        @endrole
                        @role('Super Admin|Manage Event')
                        <li>
                            <a href="{{ route('event.index') }}">
                                <i class="mdi mdi-gift"></i>
                                <span> Quản Lý Sự Kiện </span>
                            </a>
                        </li>
                        @endrole

                        <form action="{{route('logout')}}"  method="POST" enctype="multipart/form-data">
                            @csrf
                            <li class="d-flex justify-content-center">
                                <button type="submit" class="btn btn-primary waves-effect waves-light mb-2">
                                    <span> Đăng Xuất </span>
                                </button>
                            </li>
                        </form>
                    </ul>

                </div>
                <!-- End Sidebar -->

                <div class="clearfix"></div>

            </div>
            <!-- Sidebar -left -->

        </div>
        <!-- Left Sidebar End -->
        <!-- ============================================================== -->
        <!-- Start Page Content here -->
        @yield('content')
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- End Page content -->
        <!-- ============================================================== -->
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
    <!-- END wrapper -->
    @include('Admin.dist.creative.slidebar')
    @include('Admin.dist.creative.footer')
</body>

</html>
