<div class="wrapper">
    @include('admin.layout.header')

    <!-- Sidebar -->
    @include('admin.layout.sidebar')

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
       
        <section class="content">
            @yield('content')
        </section><!-- /.content -->
    </div><!-- /.content-wrapper -->

    @include('admin.layout.footer')

</div>