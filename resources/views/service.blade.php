@extends('layouts.app')

@section('content')
    @if($menu->main_menu === 'Web Hosting' || $menu->main_menu === 'Web Design')
        {{-- @include('includes.domain-search') --}}
    @endif

    @include('includes.breadcrumb')

    <section class="home-abstract">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-12">
                    <div class="home-abstract__first section-title">
                        <h4 class="short-underline">{{ $service->title }}</h4>
                        <div>
                            {{ $service->content }}
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-12">
                    <div class="home-abstract__second">
                        <img src="{{ URL::asset('images/services/banner.jpg') }}" alt="banner" />
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="home-pricing">
        <div class="container">
            <div class="section-title">
                <h4 class="short-underline">
                    PRICING AND PLANS
                </h4>
            </div>
            <div class="sub-title text-center">
                <h5>
                    Below a list of our <span><strong>{{ $service->title }}</strong></span> packages
                </h5>
            </div>
            <div class="row">
                @if(count($products) > 0)
                    @foreach($products as $product)
                        <div class="col-lg-4 col-md-6 col-sm-12">
                            <div class="devugo-card price-card text-center">
                                <div class="price-card__icon">
                                    <i class="fa {{ $product->icon }}"></i>
                                </div>
                                <h4>{{ $product->title }}</h4>
                                <h5>{{ $product->sub_title }}</h5><br />
                                <div class="price-card__features">
                                    @if(count(json_decode($product->features)) > 0)
                                        @foreach(json_decode($product->features) as $feature)
                                            <p class="single-feature"><i>{{ $feature }}</i></p>
                                        @endforeach
                                    @endif
                                </div>
                                <div class="price-card__price">
                                    <p class="price-card__price-main"><strong>{{ currencyFormatter($product->slashed_cost) }}</strong></p>
                                    <p class="price-card__price-prev">{{ currencyFormatter($product->actual_cost) }}</p>
                                </div>
                                <div>
                                    <a class="btn btn-info order-btn" 
                                        onclick="event.preventDefault();
                                        document.getElementById('order-form-{{ $product->id }}').submit();"
                                    >
                                        <i class="fa fa-shopping-cart"></i> 
                                        <span>ORDER </span>
                                    </a>
                                    <form id="order-form-{{ $product->id }}" action="{{ route('order.product') }}" method="POST" style="display: none;">
                                        @csrf
                                        <input name="product_id" value={{ $product->id }} />
                                    </form>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @endif
            </div><br /><br />
        </div>
    </section>

@endsection