<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="author" content="DexignLab" />
    <meta name="robots" content="" />
    <meta name="keywords"
        content="school, school admin, education, academy, admin dashboard, college, college management, education management, institute, school management, school management system, student management, teacher management, university, university management" />
    <meta name="description"
        content="Discover Akademi - the ultimate admin dashboard and Bootstrap 5 template. Specially designed for professionals, and for business. Akademi provides advanced features and an easy-to-use interface for creating a top-quality website with School and Education Dashboard" />
    <meta property="og:title" content="Akademi : School and Education Management Admin Dashboard Template" />
    <meta property="og:description"
        content="Akademi - the ultimate admin dashboard and Bootstrap 5 template. Specially designed for professionals, and for business. Akademi provides advanced features and an easy-to-use interface for creating a top-quality website with School and Education Dashboard" />
    <meta property="og:image" content="social-image.html" />
    <meta name="format-detection" content="telephone=no" />

    <!-- Mobile Specific -->
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <!-- Page Title Here -->
    <title>
        {{ $data['title'] }}
    </title>

    <!-- FAVICONS ICON -->
    <link rel="shortcut icon" type="image/png" href="{{ asset('') }}templates/images/logo/Icon.png" />
    <link href="{{ asset('') }}templates/vendor/wow-master/css/libs/animate.css" rel="stylesheet" />
    <link href="{{ asset('') }}templates/vendor/bootstrap-select/dist/css/bootstrap-select.min.css"
        rel="stylesheet" />
    <link rel="stylesheet"
        href="{{ asset('') }}templates/vendor/bootstrap-select-country/css/bootstrap-select-country.min.css" />
    <link rel="stylesheet" href="{{ asset('') }}templates/vendor/jquery-nice-select/css/nice-select.css" />
    <link href="{{ asset('') }}templates/vendor/datepicker/css/bootstrap-datepicker.min.css" rel="stylesheet" />

    <link href="{{ asset('') }}templates/vendor/datatables/css/jquery.dataTables.min.css" rel="stylesheet" />
    <!--swiper-slider-->
    <link rel="stylesheet" href="{{ asset('') }}templates/vendor/swiper/css/swiper-bundle.min.css" />
    <link href="{{ asset('') }}templates/css/style.css" rel="stylesheet" />
    <!-- Style css -->
    <link href="https://fonts.googleapis.com/css2?family=Material+Icons" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body>
    <!--*******************
        Preloader start
    ********************-->
    <div id="preloader">
        <div class="loader">
            <div class="dots">
                <div class="dot mainDot"></div>
                <div class="dot"></div>
                <div class="dot"></div>
                <div class="dot"></div>
                <div class="dot"></div>
            </div>
        </div>
    </div>
    <!--*******************
        Preloader end
    ********************-->
    <!--**********************************
        Main wrapper start
    ***********************************-->
    <div id="main-wrapper" class="active">
        <!--**********************************
            Nav header start
        ***********************************-->
        @include('components.navbar')
        <!--**********************************
            Nav header end
        ***********************************-->
        <!--**********************************
            Header start
        ***********************************-->
        @include('components.header')
        <!--**********************************
            Header end ti-comment-alt
        ***********************************-->

        <!--**********************************
            Sidebar start
        ***********************************-->
        @include('components.sidebar')
        <!--**********************************
            Sidebar end
        ***********************************-->
        <!--**********************************
            Content body start
        ***********************************-->
        <!--**********************************
            Content body start
        ***********************************-->

        <!--**********************************
            Content body end
            ***********************************-->
        <!--**********************************
                Footer start
                ***********************************-->
        @include('components.footer')
    </div>
    <div class="content-body">
        <!-- row -->
        <div class="container-fluid">
            @yield('content')
        </div>
    </div>

    <!--**********************************
        Main wrapper end
    ***********************************-->

    <!--***********************************-->
    @yield('modal')
    <!--**********************************
  Modal
 ***********************************-->
    <!--**********************************
        Scripts
    ***********************************-->
    <!-- Required vendors -->
    <script src="{{ asset('') }}templates/vendor/global/global.min.js"></script>
    <script src="{{ asset('') }}templates/vendor/chart.js/Chart.bundle.min.js"></script>
    <script src="{{ asset('') }}templates/vendor/bootstrap-select/dist/js/bootstrap-select.min.js"></script>
    <!-- Apex Chart -->
    <script src="{{ asset('') }}templates/vendor/apexchart/apexchart.js"></script>
    <!-- Chart piety plugin files -->
    <script src="{{ asset('') }}templates/vendor/peity/jquery.peity.min.js"></script>
    <script src="{{ asset('') }}templates/vendor/jquery-nice-select/js/jquery.nice-select.min.js"></script>
    <!--swiper-slider-->
    <script src="{{ asset('') }}templates/vendor/swiper/js/swiper-bundle.min.js"></script>

    <!-- Datatable -->
    <script src="{{ asset('') }}templates/vendor/datatables/js/jquery.dataTables.min.js"></script>
    <script src="{{ asset('') }}templates/js/plugins-init/datatables.init.js"></script>

    <!-- Dashboard 1 -->
    <script src="{{ asset('') }}templates/js/dashboard/dashboard-1.js"></script>
    <script src="{{ asset('') }}templates/vendor/wow-master/dist/wow.min.js"></script>
    <script src="{{ asset('') }}templates/vendor/bootstrap-datetimepicker/js/moment.js"></script>
    <script src="{{ asset('') }}templates/vendor/datepicker/js/bootstrap-datepicker.min.js"></script>
    <script src="{{ asset('') }}templates/vendor/bootstrap-select-country/js/bootstrap-select-country.min.js"></script>

    <script src="{{ asset('') }}templates/js/dlabnav-init.js"></script>
    <script src="{{ asset('') }}templates/js/custom.min.js"></script>
    <script src="{{ asset('') }}templates/js/demo.js"></script>
    <script src="{{ asset('') }}templates/js/styleSwitcher.js"></script>
    @stack('scripts')
</body>

</html>
