@extends('layouts.app')

@section('content')
    @include('includes.banner')
    <br /><br /><br /><br /><br /><br />
    <section class="home-about" id="home-about">
        <div class="container">
            <div class="section-title">
                <h4 class="short-underline">ABOUT US</h4>
            </div><br /><br />
            <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-12">
                    <div class="home-about__first">
                        <div class="home-about__first-img">
                            <img id="about-illustration" class="animate__animated animate__fadeInLeft animate__faster" src="{{ URL::asset('storage/images/settings/about.png') }}" alt="banner" />
                        </div><br />
                    </div><br /><br /><br /><br />
                </div>
                <div class="col-lg-6 col-md-6 col-sm-12">
                    <div class="home-about__second animate__animated animate__fadeInRight animate__faster">
                        <h3>Lorem ipsum dolor sit amet, consectetur adipiscing elit,</h3>
                        <p><strong>Looking for</strong></p>
                        <ul>
                            <li>Lacinia quis vel eros donec ac odio tempor</li>
                            <li>Lacinia quis vel eros donec ac odio tempor</li>
                            <li>Lacinia quis vel eros donec ac odio tempor</li>
                        </ul>
                        <p>
                            Paramount Web can design, develop, execute and manage a full range of web services for your online business.
                        </p>
                        <p>
                            From simple personal sites to corporate complex sites, we begin each project with one basic principle: To ensure a successful, functional and search engine friendly website.
                        </p>
                        <p>
                            As pioneer Web Designers in Lagos, Nigeria, we  take pride in helping our clients grow their businesses online since our inception in 2015. 
                        </p>
                        <p>
                            Paramount Web specializes in state of the art Search Engine Optimization. Being first is the goal – as websites with top search engine rankings see dramatic increase in their traffic. Is your website search engine friendly
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="home-services" id="home-services">
        <div class="container">
            <div class="section-title home-services__title">
                <h4 class="short-underline">OUR SERVICES</h4>
            </div>
            <div class="row">
                <div class="col-lg-4 col-md-6 col-sm-12">
                    <div class="service-square-row">
                        <div class="service-square devugo-card text-center">
                            <div class="service-square__icon">
                                <i class="fa fa-users"></i>
                            </div>
                            <div class="service-square__main">
                                <h5>Domain Registration</h5>
                                <p>We innovate systematically, continuously and successfully</p>
                                <a href="/">View More</a>
                            </div>
                            <div class="service-square__curtain">
                                <h5>Domain Registration</h5>
                                <p>We innovate systematically, continuously and successfully</p>
                                <a href="/">View More</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-12">
                    <div class="service-square-row">
                        <div class="service-square devugo-card text-center">
                            <div class="service-square__icon">
                                <i class="fa fa-users"></i>
                            </div>
                            <div class="service-square__main">
                                <h5>Web Hosting</h5>
                                <p>We innovate systematically, continuously and successfully</p>
                                <a href="/">View More</a>
                            </div>
                            <div class="service-square__curtain">
                                <h5>Web Hosting</h5>
                                <p>We innovate systematically, continuously and successfully</p>
                                <a href="/">View More</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-12">
                    <div class="service-square-row">
                        <div class="service-square devugo-card text-center">
                            <div class="service-square__icon">
                                <i class="fa fa-users"></i>
                            </div>
                            <div class="service-square__main">
                                <h5>Corporate Web Design</h5>
                                <p>We innovate systematically, continuously and successfully</p>
                                <a href="/">View More</a>
                            </div>
                            <div class="service-square__curtain">
                                <h5>Corporate Web Design</h5>
                                <p>We innovate systematically, continuously and successfully</p>
                                <a href="/">View More</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-12">
                    <div class="service-square-row">
                        <div class="service-square devugo-card text-center">
                            <div class="service-square__icon">
                                <i class="fa fa-users"></i>
                            </div>
                            <div class="service-square__main">
                                <h5>E-Commerce Web Design</h5>
                                <p>We innovate systematically, continuously and successfully</p>
                                <a href="/">View More</a>
                            </div>
                            <div class="service-square__curtain">
                                <h5>E-Commerce Web Design</h5>
                                <p>We innovate systematically, continuously and successfully</p>
                                <a href="/">View More</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-12">
                    <div class="service-square-row">
                        <div class="service-square devugo-card text-center">
                            <div class="service-square__icon">
                                <i class="fa fa-users"></i>
                            </div>
                            <div class="service-square__main">
                                <h5>Mobile App Development</h5>
                                <p>We innovate systematically, continuously and successfully</p>
                                <a href="/">View More</a>
                            </div>
                            <div class="service-square__curtain">
                                <h5>Mobile App Development</h5>
                                <p>We innovate systematically, continuously and successfully</p>
                                <a href="/">View More</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-12">
                    <div class="service-square-row">
                        <div class="service-square devugo-card text-center">
                            <div class="service-square__icon">
                                <i class="fa fa-users"></i>
                            </div>
                            <div class="service-square__main">
                                <h5>Pay Per Click Advertising</h5>
                                <p>We innovate systematically, continuously and successfully</p>
                                <a href="/">View More</a>
                            </div>
                            <div class="service-square__curtain">
                                <h5>Pay Per Click Advertising</h5>
                                <p>We innovate systematically, continuously and successfully</p>
                                <a href="/">View More</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="home-why-choose">
        <div class="container">
            <div class="section-title">
                <h4>WHY CHOOSE US</h4>
            </div>
            <div class="row">
                <div class="col-lg-4 col-md-6 col-sm-12">
                    <div>
                        <i class="fa fa-tv fa-2x"></i>
                        <h5>Custom Design</h5>
                        <p>Your site will be created to suit your business. We will work with you towards your goal for your website</p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-12">
                    <div>
                        <i class="fa fa-money fa-2x"></i>
                        <h5>Affordable Prices</h5>
                        <p>Why pay more when you can get it for less. We offer competitive prices on all our products and services.</p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-12">
                    <div>
                        <i class="fa fa-users fa-2x"></i>
                        <h5>Custommer Support</h5>
                        <p>Our support staff are available by email, phone, live chat to meet your sales and after sales questions.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

