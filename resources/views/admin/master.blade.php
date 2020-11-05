<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8"/>
    <title>Dashboard</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Premium Multipurpose Admin & Dashboard Template" name="description"/>
    <meta content="Themesbrand" name="author"/>
    <meta name="app_url" content="{{ url(('/')) }}">
    <!-- App favicon -->
    <link rel="shortcut icon" href="{{asset('assets/images/favicon.ico')}}">

    <!-- jquery.vectormap css -->
    <link href="{{asset('assets/libs/admin-resources/jquery.vectormap/jquery-jvectormap-1.2.2.css')}}" rel="stylesheet"
          type="text/css"/>

    <!-- Bootstrap Css -->
    <link href="{{asset('assets/css/bootstrap.min.css')}}" id="bootstrap-style" rel="stylesheet" type="text/css"/>
    <!-- Icons Css -->
    <link href="{{asset('assets/css/icons.min.css')}}" rel="stylesheet" type="text/css"/>
    <!-- App Css-->
    <link href="{{asset('assets/css/app-rtl.min.css')}}" id="app-style" rel="stylesheet" type="text/css"/>

    <link href="{{asset('css/admin.css')}}" id="app-style" rel="stylesheet" type="text/css"/>
    <link rel="stylesheet" type="text/css" href="{{asset('datatable/datatables.min.css')}}">
    @stack('css_lib')
</head>

<body data-layout="detached" data-topbar="colored">

<div class="container-fluid" id="app">
    <!-- Begin page -->
    <div id="layout-wrapper">

    @include('admin.layouts.header')
    <!-- ========== Left Sidebar Start ========== -->
    @include('admin.layouts.menu')
    <!-- Left Sidebar End -->

        <!-- ============================================================== -->
        <!-- Start right Content here -->
        <!-- ============================================================== -->
        <div class="main-content">

        @yield('content')
        <!-- End Page-content -->

            @include('admin.layouts.footer')

        </div>
        <!-- end main content-->
        @include('sweetalert::alert')
    </div>
    <!-- END layout-wrapper -->

</div>
<script src="{{ asset('js/store.js') }}"></script>
<!-- end container-fluid -->

<!-- Right Sidebar -->
@include('admin.layouts.right-sidebar')
<!-- /Right-bar -->

<!-- Right bar overlay-->
<div class="rightbar-overlay"></div>


<!-- JAVASCRIPT -->
<script src="{{asset('assets/libs/jquery/jquery.min.js')}}"></script>

<script src="{{asset('assets/libs/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<script src="{{asset('assets/libs/metismenu/metisMenu.min.js')}}"></script>
<script src="{{asset('assets/libs/simplebar/simplebar.min.js')}}"></script>
<script src="{{asset('assets/libs/node-waves/waves.min.js')}}"></script>

<!-- apexcharts -->
<script src="{{asset('assets/libs/apexcharts/apexcharts.min.js')}}"></script>

<!-- jquery.vectormap map -->
<script src="{{asset('assets/libs/admin-resources/jquery.vectormap/jquery-jvectormap-1.2.2.min.js')}}"></script>
<script src="{{asset('assets/libs/admin-resources/jquery.vectormap/maps/jquery-jvectormap-us-merc-en.js')}}"></script>

<script src="{{asset('assets/js/pages/dashboard.init.js')}}"></script>

<script src="{{asset('assets/js/app.js')}}"></script>
<script type="text/javascript" charset="utf8" src="{{asset('datatable/datatables.min.js')}}"></script>
<script>
    $(document).ready(function () {
        $('#datatable').DataTable({
            language: {
                "decimal":        "",
                "emptyTable":     "نتیجه ای یافت نشد",
                "info":           "نمایش _START_ تا _END_ از _TOTAL_ نتیجه",
                "infoEmpty":      "نمایش 0 تا 0 از 0 نتیجه",
                "infoFiltered":   "(filtered from _MAX_ total entries)",
                "infoPostFix":    "",
                "thousands":      ",",
                "lengthMenu":     "نمایش _MENU_ نتیجه",
                "loadingRecords": "در حال دریافت...",
                "processing":     "در حال پردازش...",
                "search":         "جستجو:",
                "zeroRecords":    "هیچ نتیجه ای یافت نشد",
                "paginate": {
                    "first":      "اولی",
                    "last":       "آخری",
                    "next":       "بعدی",
                    "previous":   "قبلی"
                },
                "aria": {
                    "sortAscending":  ": مرتب سازی صعودی",
                    "sortDescending": ":مرتب سازی نزولی"
                }
            }
        });
    });


    // $(document).ready(function () {
    //     // DataTable
    //     var table = $('#dataTable').DataTable();
    //
    //
    //     $('#dataTable tbody')
    //         .on('mouseenter', 'td', function () {
    //             var colIdx = table.cell(this).index().column;
    //
    //             $(table.cells().nodes()).removeClass('highlight');
    //             $(table.column(colIdx).nodes()).addClass('highlight');
    //         });
    //
    //     var table2 = $('.dataTable').DataTable();
    //     $('.dataTable tbody')
    //         .on('mouseenter', 'td', function () {
    //             var colIdx = table2.cell(this).index().column;
    //
    //             $(table2.cells().nodes()).removeClass('highlight');
    //             $(table2.column(colIdx).nodes()).addClass('highlight');
    //         });
    // });

    function hasDelete(deleteBtn) {
        swal.fire({
            title: '',
            text: "از حذف رکورد مطمعن هستید؟",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'بله ،حذف کن!',
            cancelButtonText: 'بیخیال',
        }).then((result) => {
            if (result.value) {
                $(deleteBtn).parents('form').submit()
            }
        })
    }
</script>
<script type="text/javascript" charset="utf8" src="{{asset('js/scripts.js')}}"></script>

@yield('script')
@stack('scripts_lib')
@stack('scripts')

</body>

</html>