@extends('admin.layouts.structure')

@section('dashboard_content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Update Product') }}</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('product.update', $product->id) }}" enctype="multipart/form-data">
                            @csrf

                            <div class="form-group row">
                                <label for="menu" class="col-md-4 col-form-label text-md-right">{{ __('Service') }}</label>

                                <div class="col-md-6">
                                    <select id="service" value={{ $product->service_id }} type="text" class="form-control @error('service') is-invalid @enderror" name="service" required autocomplete="service" autofocus>
                                        @if(count($services) > 0)
                                            @foreach($services as $service)
                                                <option value={{ $service->id }}>{{ $service->sub_menu }}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                    
                                    @error('service')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="icon" class="col-md-4 col-form-label text-md-right">{{ __('Icon') }}</label>

                                <div class="col-md-6">
                                    <input id="icon" type="text" class="form-control @error('icon') is-invalid @enderror" name="icon" value="{{ $product->icon }}" required autocomplete="icon" autofocus>
                                    <small>View font awesome icons <a target="_blank" href="https://fontawesome.com">here</a></small>
                                    
                                    @error('icon')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="title" class="col-md-4 col-form-label text-md-right">{{ __('Title') }}</label>

                                <div class="col-md-6">
                                    <input id="title" type="text" class="form-control @error('title') is-invalid @enderror" name="title" value="{{ $product->title }}" required autocomplete="title" autofocus>

                                    @error('title')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="sub_title" class="col-md-4 col-form-label text-md-right">{{ __('Sub Title') }}</label>

                                <div class="col-md-6">
                                    <input id="sub_title" type="text" class="form-control @error('sub_title') is-invalid @enderror" value="{{ $product->sub_title }}" name="sub_title" autocomplete="sub_title" required autofocus>

                                    @error('sub_title')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="features" class="col-md-4 col-form-label text-md-right">{{ __('Features') }}</label>

                                <div class="col-md-6">
                                    <textarea id="features" type="text" class="form-control @error('features') is-invalid @enderror" name="features" required autocomplete="features" autofocus>{{ implode(',', json_decode($product->features)) }}</textarea>
                                    <small>eg. speed,domain,access</small>

                                    @error('features')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="slashed_cost" class="col-md-4 col-form-label text-md-right">{{ __('Slashed Cost') }}</label>

                                <div class="col-md-6">
                                    <input id="slashed_cost" type="text" class="form-control @error('slashed_cost') is-invalid @enderror" name="slashed_cost" value="{{ $product->slashed_cost }}" required autocomplete="slashed_cost" autofocus>

                                    @error('slashed_cost')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="actual_cost" class="col-md-4 col-form-label text-md-right">{{ __('Actual Cost') }}</label>

                                <div class="col-md-6">
                                    <input id="actual_cost" type="text" class="form-control @error('actual_cost') is-invalid @enderror" name="actual_cost" value="{{ $product->actual_cost }}" required autocomplete="actual_cost" autofocus>

                                    @error('actual_cost')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
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
