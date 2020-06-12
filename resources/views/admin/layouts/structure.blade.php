@extends('layouts.app')

@section('content')
<section class="user-panel">
    <div class="row">
        <div class="col-md-5 offset-md-2 col-lg-5 offset-md-2">
            @include('admin.includes.breadcrumb')
        </div>
    </div>
    
    <div class="row">
        <div class="col-md-2">
            @include('admin.includes.sidebar')
        </div>
        <div class="col-md-10">
            @yield('dashboard_content')
        </div>
    </div>
</section>
@endsection
