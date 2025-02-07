@extends('admin.layouts.structure', ['sidebar_title' => 'Edit service'])

@section('dashboard_content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Update Service') }}</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('menu.update', $menu->id) }}" enctype="multipart/form-data">
                            @csrf

                            <div class="form-group row">
                                <label for="main_menu" class="col-md-4 col-form-label text-md-right">{{ __('Main Menu') }}</label>

                                <div class="col-md-6">
                                    <input id="main_menu" type="text" class="form-control @error('main_menu') is-invalid @enderror" name="main_menu" value="{{ $menu->main_menu }}" required autocomplete="main_menu" autofocus>
                                    
                                    @error('main_menu')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="icon" class="col-md-4 col-form-label text-md-right">{{ __('Icon') }}</label>

                                <div class="col-md-6">
                                    <input id="icon" type="text" class="form-control @error('icon') is-invalid @enderror" name="icon" value="{{ $menu->icon }}" required autocomplete="icon" autofocus>
                                    <small>View font awesome icons <a target="_blank" href="https://fontawesome.com">here</a></small>

                                    @error('icon')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="content" class="col-md-4 col-form-label text-md-right">{{ __('Content') }}</label>

                                <div class="col-md-6">
                                    <textarea id="content" type="text" class="form-control @error('content') is-invalid @enderror" name="content" autocomplete="content" required autofocus>{{ $menu->content }}</textarea>

                                    @error('content')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary devugo-button">
                                        {{ __('Update`') }}
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
