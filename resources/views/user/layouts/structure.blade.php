@extends('layouts.app')

@section('content')
{{-- <div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }} status
                        </div>
                    @endif

                    You are logged in!
                </div>
            </div>
        </div>
    </div>
</div> --}}
<section class="user-panel">
    <div class="row">
        <div class="col-md-2">
            @include('user.includes.sidebar')
        </div>
        <div class="col-md-10">
            @yield('dashboard_content')
        </div>
    </div>
</section>
@endsection
