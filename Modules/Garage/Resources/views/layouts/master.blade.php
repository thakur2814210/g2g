<!DOCTYPE html>
<html>

<!-- meta contains meta taga, css and fontawesome icons etc -->
@include('garage.common.meta')
<!-- ./end of meta -->

<body class=" hold-transition skin-blue sidebar-mini">
<!-- wrapper -->
<div class="wrapper">

    <!-- header contains top navbar -->
    @include('garage.common.header')
    <!-- ./end of header -->

        <!-- left sidebar -->
    @include('garage.common.sidebar')
    <!-- ./end of left sidebar -->

        <!-- dynamic content -->
    @yield('content')
    <!-- ./end of dynamic content -->

        <!-- right sidebar -->
    @include('garage.common.controlsidebar')
    <!-- ./right sidebar -->
    @include('garage.common.footer')
</div>
<!-- ./wrapper -->

<!-- all js scripts including custom js -->
@include('garage.common.scripts')
<!-- ./end of js scripts -->
@yield('js')

</body>
</html>
