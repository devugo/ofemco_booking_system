@extends('admin.layouts.structure', ['sidebar_title' => 'Settings'])

@section('dashboard_content')
    <div class="container">
        <div style="display: flex; justify-content: space-between;">
            <h3 class="short-underline">Settings</h3>
        </div><br /><br />
          <!-- Nav tabs -->
        <div class="devugo-card">
            <ul class="nav nav-tabs" role="tablist">
                <li class="nav-item">
                <a class="nav-link active" data-toggle="tab" href="#home">Home</a>
                </li>
                <li class="nav-item">
                <a class="nav-link" data-toggle="tab" href="#menu1">Menu 1</a>
                </li>
                <li class="nav-item">
                <a class="nav-link" data-toggle="tab" href="#menu2">Menu 2</a>
                </li>
            </ul>

            <!-- Tab panes -->
            <div class="tab-content">
                <div id="home" class="container tab-pane active"><br>
                <h3>HOME</h3>
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
                </div>
                <div id="menu1" class="container tab-pane fade"><br>
                <h3>Menu 1</h3>
                <p>Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
                </div>
                <div id="menu2" class="container tab-pane fade"><br>
                <h3>Menu 2</h3>
                <p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam.</p>
                </div>
            </div>
        </div>

        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Update Settings') }}</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('settings.update') }}" enctype="multipart/form-data">
                            @csrf

                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary devugo-button">
                                        {{ __('Update') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
