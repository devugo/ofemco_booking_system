@extends('layouts.app')

@section('content')
<section class="user-panel">
    <div class="row">
        <div class="col-md-2">
            @include('admin.includes.sidebar')
        </div>
        <div class="col-md-10">
            @include('admin.includes.breadcrumb')
            @yield('dashboard_content')
        </div>
    </div>
</section>
@endsection
