@extends('layouts.admin_app')

@section('app_content')
    @includeIf('admin.includes.navbar')
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    @includeIf('admin.includes.sidebar')


    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">

                @yield('master_content')
            </div><!-- /.container-fluid -->
        </section>


        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

    @includeIf('admin.includes.footer')
    <!-- /.control-sidebar -->

@stop
