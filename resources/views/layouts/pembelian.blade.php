<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" href="{{ url('img/favicon.ico')}}">
    <title>{{ $title }}</title>

    <link rel="stylesheet" href="{{ url('srtdash/assets/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ url('srtdash/assets/css/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ url('srtdash/assets/css/themify-icons.css') }}">
    <link rel="stylesheet" href="{{ url('srtdash/assets/css/metisMenu.css') }}">
    <link rel="stylesheet" href="{{ url('srtdash/assets/css/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ url('srtdash/assets/css/slicknav.min.css') }}">
    
    @yield('css')
    
    <!-- others css -->
    <link rel="stylesheet" href="{{ url('srtdash/assets/css/typography.css') }}">
    <link rel="stylesheet" href="{{ url('srtdash/assets/css/default-css.css') }}">
    <link rel="stylesheet" href="{{ url('srtdash/assets/css/styles.css') }}">
    <link rel="stylesheet" href="{{ url('srtdash/assets/css/responsive.css') }}">
    <!-- modernizr css -->
    <script src="{{ url('srtdash/assets/js/vendor/modernizr-2.8.3.min.js') }}"></script>
</head>

<body class="body-bg">
    <!--[if lt IE 8]>
            <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->
    <!-- preloader area start -->
    <div id="preloader">
        <div class="loader"></div>
    </div>
    <!-- preloader area end -->
    <!-- main wrapper start -->
    <div class="horizontal-main-wrapper">
        <!-- main header area start -->
        <div class="mainheader-area">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-md-3 col-12">
                        <div class="logo ml-md-2 ml-6">
                            <a href="#"><img src="{{ url('srtdash/assets/images/icon/logo.png') }}" alt="logo"></a>
                        </div>
                    </div>
                    <!-- profile info & task notification -->
                    <div class="col-md-9 clearfix text-right">
                        <div class="d-md-inline-block d-block mr-md-4">
                            <ul class="notification-area">
                                <li id="full-view"><i class="ti-fullscreen"></i></li>
                                <li id="full-view-exit"><i class="ti-zoom-out"></i></li>
                            </ul>
                        </div>
                        <div class="clearfix d-md-inline-block d-block">
                            <div class="user-profile m-0">
                                <img class="avatar user-thumb" src="{{ url('srtdash/assets/images/author/avatar.png') }}" alt="avatar">
                                <h4 class="user-name dropdown-toggle" data-toggle="dropdown">{{ Session::get('name') }} <i class="fa fa-angle-down"></i></h4>
                                <div class="dropdown-menu">
                                    <a class="dropdown-item" href="#">Settings</a>
                                    <a class="dropdown-item" href="/logout">Log Out</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- main header area end -->
        <!-- header area start -->
            <div class="header-area header-bottom">
                @include('layouts.pembelian.header')
            </div>

        @yield('content')

        <footer>
            @include('layouts.partials.footer')
        </footer>
    </div>
    <!-- jquery latest version -->
    <script src="{{ url('srtdash/assets/js/vendor/jquery-2.2.4.min.js') }}"></script>
    <!-- bootstrap 4 js -->
    <script src="{{ url('srtdash/assets/js/popper.min.js') }}"></script>
    <script src="{{ url('srtdash/assets/js/bootstrap.min.js') }}"></script>
    <script src="{{ url('srtdash/assets/js/owl.carousel.min.js') }}"></script>
    <script src="{{ url('srtdash/assets/js/metisMenu.min.js') }}"></script>
    <script src="{{ url('srtdash/assets/js/jquery.slimscroll.min.js') }}"></script>
    <script src="{{ url('srtdash/assets/js/jquery.slicknav.min.js') }}"></script>
    
    @yield('js')

    <script>
        function sukses() {
            const Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 3000
                });
            Toast.fire({
                icon: 'success',
                title: 'Berhasil !'
            })
        }
        function sukseshapus() {
            const Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 3000
                });
            Toast.fire({
                icon: 'error',
                title: 'Data berhasil dihapus !'
            })
        }
    </script>

    <!-- others plugins -->
    <script src="{{ url('srtdash/assets/js/plugins.js') }}"></script>
    <script src="{{ url('srtdash/assets/js/scripts.js') }}"></script>


</body>

</html>