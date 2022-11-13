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

                    <li class="d-none d-lg-block">
                        <form class="app-search">
                            <div class="app-search-box dropdown">
                                <div class="input-group">
                                    <input type="search" class="form-control" placeholder="Search..." id="top-search">
                                    <button class="btn input-group-text" type="submit">
                                        <i class="fe-search"></i>
                                    </button>
                                </div>
                                <div class="dropdown-menu dropdown-lg" id="search-dropdown">
                                    <!-- item-->
                                    <div class="dropdown-header noti-title">
                                        <h5 class="text-overflow mb-2">Found 22 results</h5>
                                    </div>

                                    <!-- item-->
                                    <a href="javascript:void(0);" class="dropdown-item notify-item">
                                        <i class="fe-home me-1"></i>
                                        <span>Analytics Report</span>
                                    </a>

                                    <!-- item-->
                                    <a href="javascript:void(0);" class="dropdown-item notify-item">
                                        <i class="fe-aperture me-1"></i>
                                        <span>How can I help you?</span>
                                    </a>

                                    <!-- item-->
                                    <a href="javascript:void(0);" class="dropdown-item notify-item">
                                        <i class="fe-settings me-1"></i>
                                        <span>User profile settings</span>
                                    </a>

                                    <!-- item-->
                                    <div class="dropdown-header noti-title">
                                        <h6 class="text-overflow mb-2 text-uppercase">Users</h6>
                                    </div>

                                    <div class="notification-list">
                                        <!-- item-->
                                        <a href="javascript:void(0);" class="dropdown-item notify-item">
                                            <div class="d-flex align-items-start">
                                                <img class="d-flex me-2 rounded-circle" src="../assets/images/users/user-2.jpg" alt="Generic placeholder image" height="32">
                                                <div class="w-100">
                                                    <h5 class="m-0 font-14">Erwin E. Brown</h5>
                                                    <span class="font-12 mb-0">UI Designer</span>
                                                </div>
                                            </div>
                                        </a>

                                        <!-- item-->
                                        <a href="javascript:void(0);" class="dropdown-item notify-item">
                                            <div class="d-flex align-items-start">
                                                <img class="d-flex me-2 rounded-circle" src="../assets/images/users/user-5.jpg" alt="Generic placeholder image" height="32">
                                                <div class="w-100">
                                                    <h5 class="m-0 font-14">Jacob Deo</h5>
                                                    <span class="font-12 mb-0">Developer</span>
                                                </div>
                                            </div>
                                        </a>
                                    </div>

                                </div>
                            </div>
                        </form>
                    </li>

                    <li class="dropdown d-inline-block d-lg-none">
                        <a class="nav-link dropdown-toggle arrow-none waves-effect waves-light" data-bs-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                            <i class="fe-search noti-icon"></i>
                        </a>
                        <div class="dropdown-menu dropdown-lg dropdown-menu-end p-0">
                            <form class="p-3">
                                <input type="text" class="form-control" placeholder="Search ..." aria-label="Recipient's username">
                            </form>
                        </div>
                    </li>

                    <li class="dropdown d-none d-lg-inline-block">
                        <a class="nav-link dropdown-toggle arrow-none waves-effect waves-light" data-toggle="fullscreen" href="#">
                            <i class="fe-maximize noti-icon"></i>
                        </a>
                    </li>

                    <li class="dropdown d-none d-lg-inline-block topbar-dropdown">
                        <a class="nav-link dropdown-toggle arrow-none waves-effect waves-light" data-bs-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                            <i class="fe-grid noti-icon"></i>
                        </a>
                        <div class="dropdown-menu dropdown-lg dropdown-menu-end">

                            <div class="p-lg-1">
                                <div class="row g-0">
                                    <div class="col">
                                        <a class="dropdown-icon-item" href="#">
                                            <img src="../assets/images/brands/slack.png" alt="slack">
                                            <span>Slack</span>
                                        </a>
                                    </div>
                                    <div class="col">
                                        <a class="dropdown-icon-item" href="#">
                                            <img src="../assets/images/brands/github.png" alt="Github">
                                            <span>GitHub</span>
                                        </a>
                                    </div>
                                    <div class="col">
                                        <a class="dropdown-icon-item" href="#">
                                            <img src="../assets/images/brands/dribbble.png" alt="dribbble">
                                            <span>Dribbble</span>
                                        </a>
                                    </div>
                                </div>

                                <div class="row g-0">
                                    <div class="col">
                                        <a class="dropdown-icon-item" href="#">
                                            <img src="../assets/images/brands/bitbucket.png" alt="bitbucket">
                                            <span>Bitbucket</span>
                                        </a>
                                    </div>
                                    <div class="col">
                                        <a class="dropdown-icon-item" href="#">
                                            <img src="../assets/images/brands/dropbox.png" alt="dropbox">
                                            <span>Dropbox</span>
                                        </a>
                                    </div>
                                    <div class="col">
                                        <a class="dropdown-icon-item" href="#">
                                            <img src="../assets/images/brands/g-suite.png" alt="G Suite">
                                            <span>G Suite</span>
                                        </a>
                                    </div>

                                </div>
                            </div>

                        </div>
                    </li>

                    <li class="dropdown d-none d-lg-inline-block topbar-dropdown">
                        <a class="nav-link dropdown-toggle arrow-none waves-effect waves-light" data-bs-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                            <img src="../assets/images/flags/us.jpg" alt="user-image" height="16">
                        </a>
                        <div class="dropdown-menu dropdown-menu-end">

                            <!-- item-->
                            <a href="javascript:void(0);" class="dropdown-item">
                                <img src="../assets/images/flags/germany.jpg" alt="user-image" class="me-1" height="12"> <span class="align-middle">German</span>
                            </a>

                            <!-- item-->
                            <a href="javascript:void(0);" class="dropdown-item">
                                <img src="../assets/images/flags/italy.jpg" alt="user-image" class="me-1" height="12"> <span class="align-middle">Italian</span>
                            </a>

                            <!-- item-->
                            <a href="javascript:void(0);" class="dropdown-item">
                                <img src="../assets/images/flags/spain.jpg" alt="user-image" class="me-1" height="12"> <span class="align-middle">Spanish</span>
                            </a>

                            <!-- item-->
                            <a href="javascript:void(0);" class="dropdown-item">
                                <img src="../assets/images/flags/russia.jpg" alt="user-image" class="me-1" height="12"> <span class="align-middle">Russian</span>
                            </a>

                        </div>
                    </li>

                    <li class="dropdown notification-list topbar-dropdown">
                        <a class="nav-link dropdown-toggle nav-user me-0 waves-effect waves-light" data-bs-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                            <img src="../assets/images/users/user-1.jpg" alt="user-image" class="rounded-circle">
                            <span class="pro-user-name ms-1">
                                {{ auth()->user()->name }} <i class="mdi mdi-chevron-down"></i>
                            </span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-end profile-dropdown ">
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

                        </div>
                    </li>

                    <li class="dropdown notification-list">
                        <a href="javascript:void(0);" class="nav-link right-bar-toggle waves-effect waves-light">
                            <i class="fe-settings noti-icon"></i>
                        </a>
                    </li>

                </ul>

                <!-- LOGO -->
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

                    <li class="dropdown d-none d-xl-block">
                        <a class="nav-link dropdown-toggle waves-effect waves-light" data-bs-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                            Create New
                            <i class="mdi mdi-chevron-down"></i>
                        </a>
                        <div class="dropdown-menu">
                            <!-- item-->
                            <a href="javascript:void(0);" class="dropdown-item">
                                <i class="fe-briefcase me-1"></i>
                                <span>New Projects</span>
                            </a>

                            <!-- item-->
                            <a href="javascript:void(0);" class="dropdown-item">
                                <i class="fe-user me-1"></i>
                                <span>Create Users</span>
                            </a>

                            <!-- item-->
                            <a href="javascript:void(0);" class="dropdown-item">
                                <i class="fe-bar-chart-line- me-1"></i>
                                <span>Revenue Report</span>
                            </a>

                            <!-- item-->
                            <a href="javascript:void(0);" class="dropdown-item">
                                <i class="fe-settings me-1"></i>
                                <span>Settings</span>
                            </a>

                            <div class="dropdown-divider"></div>

                            <!-- item-->
                            <a href="javascript:void(0);" class="dropdown-item">
                                <i class="fe-headphones me-1"></i>
                                <span>Help & Support</span>
                            </a>

                        </div>
                    </li>

                    <li class="dropdown dropdown-mega d-none d-xl-block">
                        <a class="nav-link dropdown-toggle waves-effect waves-light" data-bs-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                            Mega Menu
                            <i class="mdi mdi-chevron-down"></i>
                        </a>
                        <div class="dropdown-menu dropdown-megamenu">
                            <div class="row">
                                <div class="col-sm-8">

                                    <div class="row">
                                        <div class="col-md-4">
                                            <h5 class="text-dark mt-0">UI Components</h5>
                                            <ul class="list-unstyled megamenu-list">
                                                <li>
                                                    <a href="javascript:void(0);">Widgets</a>
                                                </li>
                                                <li>
                                                    <a href="javascript:void(0);">Nestable List</a>
                                                </li>
                                                <li>
                                                    <a href="javascript:void(0);">Range Sliders</a>
                                                </li>
                                                <li>
                                                    <a href="javascript:void(0);">Masonry Items</a>
                                                </li>
                                                <li>
                                                    <a href="javascript:void(0);">Sweet Alerts</a>
                                                </li>
                                                <li>
                                                    <a href="javascript:void(0);">Treeview Page</a>
                                                </li>
                                                <li>
                                                    <a href="javascript:void(0);">Tour Page</a>
                                                </li>
                                            </ul>
                                        </div>

                                        <div class="col-md-4">
                                            <h5 class="text-dark mt-0">Applications</h5>
                                            <ul class="list-unstyled megamenu-list">
                                                <li>
                                                    <a href="javascript:void(0);">eCommerce Pages</a>
                                                </li>
                                                <li>
                                                    <a href="javascript:void(0);">CRM Pages</a>
                                                </li>
                                                <li>
                                                    <a href="javascript:void(0);">Email</a>
                                                </li>
                                                <li>
                                                    <a href="javascript:void(0);">Calendar</a>
                                                </li>
                                                <li>
                                                    <a href="javascript:void(0);">Team Contacts</a>
                                                </li>
                                                <li>
                                                    <a href="javascript:void(0);">Task Board</a>
                                                </li>
                                                <li>
                                                    <a href="javascript:void(0);">Email Templates</a>
                                                </li>
                                            </ul>
                                        </div>

                                        <div class="col-md-4">
                                            <h5 class="text-dark mt-0">Extra Pages</h5>
                                            <ul class="list-unstyled megamenu-list">
                                                <li>
                                                    <a href="javascript:void(0);">Left Sidebar with User</a>
                                                </li>
                                                <li>
                                                    <a href="javascript:void(0);">Menu Collapsed</a>
                                                </li>
                                                <li>
                                                    <a href="javascript:void(0);">Small Left Sidebar</a>
                                                </li>
                                                <li>
                                                    <a href="javascript:void(0);">New Header Style</a>
                                                </li>
                                                <li>
                                                    <a href="javascript:void(0);">Search Result</a>
                                                </li>
                                                <li>
                                                    <a href="javascript:void(0);">Gallery Pages</a>
                                                </li>
                                                <li>
                                                    <a href="javascript:void(0);">Maintenance & Coming Soon</a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="text-center mt-3">
                                        <h3 class="text-dark">Special Discount Sale!</h3>
                                        <h4>Save up to 70% off.</h4>
                                        <button class="btn btn-primary btn-rounded mt-3">Download Now</button>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </li>
                </ul>
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

                        <li class="menu-title">Navigation</li>

                        <li>
                            <a href="{{route('admin.index')}}">
                                <i data-feather="airplay"></i>
                                {{-- <span class="badge bg-success rounded-pill float-end">4</span> --}}
                                <span> Trang Chủ </span>
                            </a>
                        </li>
                        <li class="menu-title mt-2">Apps</li>

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
                                    <li>
                                        <a href="{{ route('family.index') }}">Thông Tin Nhóm Sản Phẩm</a>
                                    </li>
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
