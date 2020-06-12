@extends('admin.layouts.structure')

@section('dashboard_content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Add Service') }}</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('service.store') }}" enctype="multipart/form-data">
                            @csrf

                            <div class="form-group row">
                                <label for="menu" class="col-md-4 col-form-label text-md-right">{{ __('Menu') }}</label>

                                <div class="col-md-6">
                                    <select id="menu" type="text" class="form-control @error('menu') is-invalid @enderror" name="menu" value="{{ old('menu') }}" required autocomplete="menu" autofocus>
                                        @if(count($menus) > 0)
                                            @foreach($menus as $menu)
                                                <option value={{ $menu->id }}>{{ $menu->main_menu }}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                    
                                    @error('menu')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="sub_menu" class="col-md-4 col-form-label text-md-right">{{ __('Sub Menu') }}</label>

                                <div class="col-md-6">
                                    <input id="sub_menu" type="text" class="form-control @error('sub_menu') is-invalid @enderror" name="sub_menu" value="{{ old('sub_menu') }}" required autocomplete="sub_menu" autofocus>
                                    
                                    @error('sub_menu')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="title" class="col-md-4 col-form-label text-md-right">{{ __('Title') }}</label>

                                <div class="col-md-6">
                                    <input id="title" type="text" class="form-control @error('title') is-invalid @enderror" name="title" value="{{ old('title') }}" required autocomplete="title" autofocus>

                                    @error('title')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="content" class="col-md-4 col-form-label text-md-right">{{ __('Content') }}</label>

                                <div class="col-md-6">
                                    <textarea id="content" type="text" class="form-control @error('content') is-invalid @enderror" name="content" autocomplete="content" required autofocus>{{ old('content') }}</textarea>

                                    @error('content')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="image" class="col-md-4 col-form-label text-md-right">{{ __('Image') }}</label>

                                <div class="col-md-6">
                                    <input id="image" type="file" class="form-control @error('image') is-invalid @enderror" name="image" value="{{ old('image') }}" required autocomplete="image" autofocus>

                                    @error('image')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="button_text" class="col-md-4 col-form-label text-md-right">{{ __('Button Text') }}</label>

                                <div class="col-md-6">
                                    <input id="button_text" type="text" class="form-control @error('button_text') is-invalid @enderror" name="button_text" value="{{ old('button_text') }}" autocomplete="button_text" autofocus>

                                    @error('button_text')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="button_link" class="col-md-4 col-form-label text-md-right">{{ __('Button Link') }}</label>

                                <div class="col-md-6">
                                    <input id="button_link" type="text" class="form-control @error('button_link') is-invalid @enderror" name="button_link" value="{{ old('button_link') }}" autocomplete="button_link">

                                    @error('button_link')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Add') }}
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
