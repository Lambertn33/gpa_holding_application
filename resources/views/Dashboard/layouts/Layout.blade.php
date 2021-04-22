<!doctype html>
<html lang="en" dir="ltr">

<head>

    <!-- Meta data -->
    <meta charset="UTF-8">
    <meta http-equiv="x-ua-compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta content="mixo - Bootstrap Admin Panel Template" name="description">
    <meta content="Spruko Technologies Private Limited" name="author">
    <meta name="keywords" content="dashboard, admin, web app, template, admin template, dashboard template, bootstrap admin template, bootstrap dashboard, dashboard designs, admin panel template, bootstrap 4 admin template, sales dashboard, bootstrap admin, bootstrap dashboard template, bootstrap html template, admin dashboard template, bootstrap starter template">

    <!-- Favicon-->
    <link rel="icon" href="/Dashboard/images/brand/favicon.png" type="image/x-icon" />

    <!-- Title -->
    <title>GPA Holding Invoices</title>

    <!-- Bootstrap css -->
    <link href="/Dashboard/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" />

    <!-- Style css -->
    <link href="/Dashboard/css/style.css" rel="stylesheet" />
    <link href="/Dashboard/css/skins.css" rel="stylesheet" />

    <!-- Dark css -->
    <link href="/Dashboard/css/dark-style.css" rel="stylesheet" />

    <!-- P-scroll css -->
    <link href="/Dashboard/plugins/p-scroll/p-scroll.css" rel="stylesheet" type="text/css">

    <!-- Font-icons css -->
    <link href="/Dashboard/css/icons.css" rel="stylesheet">

    <!-- INTERNAL Data table css -->
    <link href="/Dashboard/plugins/datatable/datatables.min.css" rel="stylesheet" />
    <link href="/Dashboard/plugins/datatable/css/jquery.dataTables.min.css" rel="stylesheet" />
    <link href="/Dashboard/plugins/datatable/css/dataTables.bootstrap4.min.css" rel="stylesheet" />
    <link href="/Dashboard/plugins/datatable/css/buttons.bootstrap4.min.css" rel="stylesheet">
    <link href="/Dashboard/plugins/datatable/responsive.bootstrap4.min.css" rel="stylesheet" />


</head>

<body>

    <!-- Loader -->
    <div id="loading">
        <img src="/Dashboard/images/other/loader.svg" class="loader-img" alt="Loader">
    </div>

    <!-- PAGE -->
    <div class="page">
        <div class="page-main">

            <!-- Top-header opened -->
            <div class="hor-header header">
                <div class="container">
                    <div class="d-flex">
                        <a class="animated-arrow hor-toggle horizontal-navtoggle"><span></span></a>
                        <div class="d-flex header-right ml-auto">

                            <!-- Mobile-search -->
                            <div class="dropdown header-fullscreen">
                                <a class="nav-link icon full-screen-link" id="fullscreen-button">
                                    <i class="bx bx-expand"></i>
                                </a>
                            </div>
                            <!-- Fullscreen -->

                            <!-- Notification -->

                            <!-- Settings -->
                            <div class="dropdown drop-profile">
                                <a class="nav-link pr-1 pl-2 leading-none" href="#" data-toggle="dropdown" aria-expanded="false">
                                    <span class="mr-2 mb-0  fs-15 font-weight-semibold d-none d-xl-block">{{ Auth::user()->first_Name != "" ?Auth::user()->first_Name :"" }}  {{ Auth::user()->last_Name != "" ?Auth::user()->last_Name :"" }}<i class="fe fe-chevron-down"></i></span>
                                    <img class="avatar avatar-md brround" src="/Dashboard/images/users/2.jpg" alt="image">
                                </a>
                                <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow fadein p-0 border-0">
                                    <div class="user-profile bg-header-image border-bottom p-5">
                                        <div class="user-details text-center">
                                            <h4 class="mb-0">{{ Auth::user()->first_Name != "" ?Auth::user()->first_Name :"" }}  {{ Auth::user()->last_Name != "" ?Auth::user()->last_Name :"" }}</h4>
                                            <p class="mb-1 fs-13 text-white-50">{{ Auth::user()->email }}</p>
                                        </div>
                                    </div>
                                    <a class="dropdown-item" href="#">
                                        <i class="dropdown-icon bx bx-help-circle"></i> Need help?
                                    </a>
                                    <a class="dropdown-item border-bottom-0" href=""
                                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                        <i class="dropdown-icon bx bx-log-out"></i> Sign out
                                    </a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </div>
                            <!-- Profile -->
                        </div>
                    </div>
                </div>
            </div>
            <!-- Top-header closed -->

            <!-- Horizontal-menu -->
            <div class="sticky">
                <div class="horizontal-main hor-menu clearfix">
                    <div class="horizontal-mainwrapper container clearfix">
                        <nav class="horizontalMenu clearfix">
                            @switch(Auth::user()->role)
                                @case("Administrator")
                                <ul class="horizontalMenu-list">
                                    <li aria-haspopup="true">
                                        <a href="{{ route('home') }}"><i class="bx bx-home hor-icon"></i>Home</a>
                                    </li>
                                    <li aria-haspopup="true">
                                        <a  href="{{ route('getAllClients') }}"><i class="bx bx-happy hor-icon"></i>Clients</a>
                                    </li>
                                    <li aria-haspopup="true">
                                        <a href="#" class="sub-icon"><i class="bx bx-shopping-bag hor-icon"></i>Products</a>
                                        <div class="horizontal-megamenu clearfix">
                                            <div class="container">
                                                <div class="mega-menubg">
                                                    <div class="row">
                                                        <div class="col-lg-3 col-md-3 col-xs-3 link-list">
                                                            <ul>
                                                                <li aria-haspopup="true">
                                                                    <a  href="{{ route('getAllCategories') }}"><i class="bx bx-shopping-bag hor-icon"></i>Product Categories</a>
                                                                </li>
                                                                <li aria-haspopup="true">
                                                                    <a  href="{{ route('getAllProducts') }}"><i class="bx bx-shopping-bag hor-icon"></i>Products</a>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                    <li aria-haspopup="true">
                                        <a href="#" class="sub-icon"><i class="bx bx-shopping-bag hor-icon"></i>Invoices</a>
                                        <div class="horizontal-megamenu clearfix">
                                            <div class="container">
                                                <div class="mega-menubg">
                                                    <div class="row">
                                                        <div class="col-lg-3 col-md-3 col-xs-3 link-list">
                                                            <ul>
                                                                <li aria-haspopup="true">
                                                                    <a  href="{{ route('getAllInvoices') }}"><i class="bx bx-shopping-bag hor-icon"></i>Invoices</a>
                                                                </li>
                                                                <li aria-haspopup="true">
                                                                    <a  href="{{ route('getAllProformas') }}"><i class="bx bx-shopping-bag hor-icon"></i>Proforma</a>
                                                                </li>
                                                                <li aria-haspopup="true">
                                                                    <a  href="{{ route('getAllReceipts') }}"><i class="bx bx-shopping-bag hor-icon"></i>Receipts</a>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                    <li aria-haspopup="true">
                                        <a  href=""><i class="bx bx-book-open hor-icon"></i>Contracts</a>
                                    </li>
                                    <li aria-haspopup="true">
                                        <a href="#" class="sub-icon"><i class="bx bx-store hor-icon"></i>Stock</a>
                                        <div class="horizontal-megamenu clearfix">
                                            <div class="container">
                                                <div class="mega-menubg">
                                                    <div class="row">
                                                        <div class="col-lg-3 col-md-3 col-xs-3 link-list">
                                                            <ul>
                                                                <li aria-haspopup="true">
                                                                    <a  href="{{ route('getAllStock') }}"><i class="bx bx-store hor-icon"></i>Stock</a>
                                                                </li>
                                                                <li aria-haspopup="true">
                                                                    <a  href="{{ route('getAllSuppliers') }}"><i class="bx bx-cart hor-icon"></i>Suppliers</a>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                    <li aria-haspopup="true">
                                        <a  href="{{ route('getAllUsers') }}"><i class="bx bx-user hor-icon"></i>Users</a>
                                    </li>
                                    <li aria-haspopup="true">
                                        <a  href=""><i class="bx bx-customize hor-icon"></i>Settings</a>
                                    </li>
                                </ul>
                                    @break
                                @case("User")
                                <ul class="horizontalMenu-list">
                                    <li aria-haspopup="true">
                                        <a href="{{ route('home') }}"><i class="bx bx-home hor-icon"></i>Home</a>
                                    </li>
                                    <li aria-haspopup="true">
                                        <a href="#" class="sub-icon"><i class="bx bx-shopping-bag hor-icon"></i>Invoices</a>
                                        <div class="horizontal-megamenu clearfix">
                                            <div class="container">
                                                <div class="mega-menubg">
                                                    <div class="row">
                                                        <div class="col-lg-3 col-md-3 col-xs-3 link-list">
                                                            <ul>
                                                                <li aria-haspopup="true">
                                                                    <a  href="{{ route('getAllInvoices') }}"><i class="bx bx-shopping-bag hor-icon"></i>Invoices</a>
                                                                </li>
                                                                <li aria-haspopup="true">
                                                                    <a  href="{{ route('getAllProformas') }}"><i class="bx bx-shopping-bag hor-icon"></i>Proforma</a>
                                                                </li>
                                                                <li aria-haspopup="true">
                                                                    <a href="{{ route('getAllReceipts') }}"><i class="bx bx-shopping-bag hor-icon"></i>Receipts</a>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                    <li aria-haspopup="true">
                                        <a href="#" class="sub-icon"><i class="bx bx-store hor-icon"></i>Stock</a>
                                        <div class="horizontal-megamenu clearfix">
                                            <div class="container">
                                                <div class="mega-menubg">
                                                    <div class="row">
                                                        <div class="col-lg-3 col-md-3 col-xs-3 link-list">
                                                            <ul>
                                                                <li aria-haspopup="true">
                                                                    <a  href="{{ route('getAllStock') }}"><i class="bx bx-store hor-icon"></i>Stock</a>
                                                                </li>
                                                                <li aria-haspopup="true">
                                                                    <a  href="{{ route('getAllSuppliers') }}"><i class="bx bx-cart hor-icon"></i>Suppliers</a>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                                    @break
                                @default

                            @endswitch
                        </nav>
                        <!--Nav end -->
                    </div>
                </div>
            </div>
            <!-- Horizontal-menu end -->

            <!-- App-content opened -->
            <div class="main-content">
                <div class="container">

                    <!-- Page-header opened -->
                    <div class="page-header">
                        <div class="page-leftheader">
                            <h1 class="page-title mb-0">GPA Holding Invoices</h1>
                        </div>
                        <div class="page-rightheader">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="#" class="d-flex"><span class="breadcrumb-icon"> Home</span></a></li>
                                <li class="breadcrumb-item active" aria-current="page">GPA Holding Invoices</li>
                            </ol>
                        </div>
                    </div>
                    <!-- Page-header closed -->

                    <!-- row opened -->
                    @if(!Route::is('clientEditPage','getNewClientRegistrationPage','getNewReceiptRegistrationPage','getNewCategoryRegistrationPage','categoryEditPage',
                    'getNewProductRegistrationPage','getNewProformaRegistrationPage','productEditPage','getNewUserRegistrationPage','userEditPage',
                    'getNewStockRegistrationPage','stockEditPage','getNewSupplierRegistrationPage','supplierEditPage','getNewInvoiceRegistrationPage'))
                    <div class="row">
                        <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
                            <!-- row opened -->
                            <div class="row">
                                <div class="col-sm-12 col-md-12 col-xl-4 col-lg-4">
                                    <div class="card overflow-hidden">
                                        <div class="card-body">
                                            <div class="d-flex align-items-end justify-content-between">
                                                <div>
                                                    <p class="mb-1 h6">Clients</p>
                                                    <h2 class="mb-0"><span class="number-font1">{{ $numberOfClients }}</span></h2>
                                                </div>
                                                <div class="ml-auto mb-2">
                                                    <span class="dash1-iocns text-primary"><i class="fe fe-user"></i></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-12 col-md-12  col-xl-4 col-lg-4">
                                    <div class="card overflow-hidden">
                                        <div class="card-body">
                                            <div class="d-flex align-items-end justify-content-between">
                                                <div>
                                                    <p class="mb-1 h6">Products</p>
                                                    <h2 class="mb-0"><span class="number-font1">{{ $numberOfProducts }}</span></h2>
                                                </div>
                                                <div class="ml-auto mb-2">
                                                    <span class="dash1-iocns text-primary"><i class="las la-shopping-bag"></i></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-12 col-md-12 col-xl-4 col-lg-4">
                                    <div class="card overflow-hidden">
                                        <div class="card-body">
                                            <div class="d-flex align-items-end justify-content-between">
                                                <div>
                                                    <p class="mb-1 h6">Users</p>
                                                    <h2 class="mb-0"><span class="number-font1">{{ $numberOfUsers }}</span></h2>
                                                </div>
                                                <div class="ml-auto mb-2">
                                                    <span class="dash1-iocns text-primary"><i class="fe fe-user"></i></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- row closed -->
                        </div>
                    </div>
                    @endif

                  @yield('content')
                </div>
            </div>
            <!-- App-content closed -->
        </div>

        <!-- Footer opened -->
        <footer class="footer-main icon-footer">
            <div class="container">
                <div class="  mt-2 mb-2 text-center">
                    Copyright © <script>document.write(new Date().getFullYear())</script> All rights reserved.
                </div>
            </div>
        </footer>
        <!-- Footer closed -->
    </div>

    <!-- Back-to-top -->
    <a href="#top" id="back-to-top"><i class="fa fa-angle-double-up"></i></a>

    <!-- Jquery-scripts -->
    <script src="/Dashboard/js/jquery.min.js"></script>

    <!-- Moment js-->
    <script src="/Dashboard/plugins/moment/moment.min.js"></script>

    <!-- Bootstrap-scripts js -->
    <script src="/Dashboard/plugins/bootstrap/js/popper.min.js"></script>
    <script src="/Dashboard/plugins/bootstrap/js/bootstrap.min.js"></script>
     <!-- Sparkline JS-->
     <script src="/Dashboard/js/jquery.sparkline.min.js"></script>

     <!-- Chart-circle js -->
     <script src="/Dashboard/js/circle-progress.min.js"></script>

     <!-- P-scroll js -->
     <script src="/Dashboard/plugins/p-scroll/p-scroll.js"></script>

    <!-- Horizontal-menu js-->
    <script src="/Dashboard/plugins/horizontal-menu/horizontal-menu.js"></script>

    <!-- Sticky js-->
    <script src="/Dashboard/js/sticky.js"></script>
    	<!-- INTERNAL Select2 js -->
		<script src="/Dashboard/plugins/select2/select2.full.min.js"></script>

    <!-- INTERNAL Chart js-->
    <script src="/Dashboard/plugins/chart/chart.min.js"></script>
    <script src="/Dashboard/plugins/chart/rounded-barchart.js"></script>
        <!-- INTERNAL Data tables js-->
        <script src="/Dashboard/plugins/datatable/js/jquery.dataTables.min.js"></script>
        <script src="/Dashboard/plugins/datatable/js/dataTables.bootstrap4.js"></script>
        <script src="/Dashboard/plugins/datatable/js/dataTables.buttons.min.js"></script>
        <script src="/Dashboard/plugins/datatable/js/buttons.bootstrap4.min.js"></script>
        <script src="/Dashboard/plugins/datatable/js/jszip.min.js"></script>
        <script src="/Dashboard/plugins/datatable/pdfmake/pdfmake.min.js"></script>
        <script src="/Dashboard/plugins/datatable/pdfmake/vfs_fonts.js"></script>
        <script src="/Dashboard/plugins/datatable/js/buttons.html5.min.js"></script>
        <script src="/Dashboard/plugins/datatable/js/buttons.print.min.js"></script>
        <script src="/Dashboard/plugins/datatable/js/buttons.colVis.min.js"></script>
        <script src="/Dashboard/plugins/datatable/dataTables.responsive.min.js"></script>
        <script src="/Dashboard/plugins/datatable/responsive.bootstrap4.min.js"></script>
            <!-- INTERNAL Data table js -->
        <script src="/Dashboard/js/datatable.js"></script>

           <!-- INTERNAL Apexchart js-->
    <script src="/Dashboard/js/apexcharts.js"></script>

    <!-- INTERNAL Index js -->
    <script src="/Dashboard/js/index.js"></script>

    <!-- Custom js -->
    <script src="/Dashboard/js/custom.js"></script>


</body>

</html>
