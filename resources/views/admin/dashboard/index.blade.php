{{-- master layout add --}}
@extends('admin.layout.app')

@php
    $dashboard="Dashboard";
    $displayMasterName = "Home";
    $routeFrom="dashboard";
    $iconName="fa fa-home";
@endphp
{{-- css file  --}}
@section('stylesheet')
   <style>
        /* add Extra css file here......... */
   </style>
@endsection

{{-- javascript file --}}
@section('javascript')
    <script>
        console.log(" extra js File add here ....");
    </script>
@endsection


{{-- body content add here --}}
@section('content-header')
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Dashboard</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Dashboard </li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">

        Dashboard
      </div>
    </section>
    <!-- /.content -->
  </div>
@endsection

{{-- javascript file --}}
@section('js-footer')
    <script>
        console.log("add extra js code  here ....");
    </script>
@endsection
