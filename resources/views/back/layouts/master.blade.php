<!doctype html>
<html lang="en">
@include('back.layouts.head')
<body data-sidebar="dark" data-layout-mode="light">
    <!-- Begin page -->
    <div id="layout-wrapper">
        @include('back.layouts.header')
        @include('back.layouts.nav')
        <!-- ============================================================== -->
        <!-- Start right Content here -->
        <!-- ============================================================== -->
        <div class="main-content">
            <div class="page-content">
                <div class="container-fluid">
        @yield('content')
                </div>
            </div>
            @include('back.layouts.footer')
        </div>
    </div>
    @include('back.layouts.script')
</body>
</html>
