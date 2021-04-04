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
    <title>GPA_Holding_Application</title>

    <!-- Bootstrap css -->
    <link href="/Dashboard/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" />

    <!-- Style css -->
    <link href="/Dashboard/css/style.css" rel="stylesheet" />
    <link href="/Dashboard/css/skins.css" rel="stylesheet" />

    <!-- Dark css -->
    <link href="/Dashboard/css/dark-style.css" rel="stylesheet" />

    <!-- Sidemenu css -->
    <link rel="stylesheet" href="./css/sidemenu.css">

    <!-- P-scroll css -->
    <link href="/Dashboard/plugins/p-scroll/p-scroll.css" rel="stylesheet" type="text/css">

    <!--Font icons css-->
    <link href="/Dashboard/css/icons.css" rel="stylesheet">

</head>

<body>

    <!-- Loader -->
    <div id="loading">
        <img src="/Dashboard/images/other/loader.svg" class="loader-img" alt="Loader">
    </div>

    <!-- Page opened -->
    <div class="page">
        <div class="container">
            <div class="row">
                <div class="col-xl-8 col-lg-10 justify-content-center mx-auto text-center">
                    <div class="card">
                        <div class="row h-100">
                            <div class="col-md-12 col-xl-6 col-lg-6 pr-0">
                                <div class="custom-image">
                                    <div class="custom-text">
                                        <h4>GPA HOLDING APPLICATION</h4>
                                        <h4>Welcome</h4>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12 col-xl-6 col-lg-6 pl-0">
                                <form action="{{ route('login') }}" method="POST">
                                    @csrf
                                    <div class="card-body p-6 about-con pabout">
                                        <div class="card-title text-center  mb-4">LOGIN</div>
                                        @foreach (['danger', 'warning', 'success', 'info'] as $msg) @if(Session::has($msg))

                                        <div class="alert alert-{{ $msg }}  alert-dismissible fade show" role="alert">
                                            {{ Session::get($msg) }}
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                              <span aria-hidden="true">&times;</span>
                                                 </button>
                                        </div>
                                        @endif
                                       @endforeach
                                        <div class="form-group">
                                            <input type="email" name="email" id="email" class="form-control  @error('email') is-invalid @enderror" placeholder="Email" >
                                            @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                        </div>
                                        <div class="form-group">
                                            <input type="password" id="password" name="password" class="form-control @error('password') is-invalid @enderror" id="exampleInputPassword1" placeholder="Password">
                                            @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                        </div>
                                        <div class="form-footer mt-6">
                                            <button type="submit" id="btn" class="btn ripple btn-primary btn-block customspin">SignIn <i class="fa fa-spinner fa-spin ml-2"></i></button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Page closed -->

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

    <!--Moment js-->
    <script src="/Dashboard/plugins/moment/moment.min.js"></script>

    <!-- Custom Js-->
    <script src="/Dashboard/js/custom.js"></script>
       <!-- Internal Notifications js -->
       <script src="/Dashboard/plugins/notify/js/sample.js"></script>
       <script src="/Dashboard/plugins/notify/js/jquery.growl.js"></script>
       <script src="/Dashboard/plugins/notify/js/notifIt.js"></script>

</body>

</html>
