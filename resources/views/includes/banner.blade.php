<section class="banner-carousel" id="banner-carousel">
    <div id="demo" style="margin: 0 !important; padding: 0 !important; width: 100% !important;" class="carousel slide" data-ride="carousel">
        <ul class="carousel-indicators">
            <li data-target="#demo" data-slide-to="0" class="active"></li>
            <li data-target="#demo" data-slide-to="1"></li>
            <li data-target="#demo" data-slide-to="2"></li>
        </ul>
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="/storage/images/settings/{{$settings->carousel_image_1}}" alt="Los Angeles">
            </div>
            <div class="carousel-item">
                <img src="/storage/images/settings/{{$settings->carousel_image_2}}" alt="Chicago">
            </div>
            <div class="carousel-item">
                <img src="/storage/images/settings/{{$settings->carousel_image_3}}" alt="New York">
            </div>
        </div>
        {{-- <a class="carousel-control-prev" href="#demo" data-slide="prev">
            <span class="carousel-control-prev-icon"></span>
        </a>
        <a class="carousel-control-next" href="#demo" data-slide="next">
            <span class="carousel-control-next-icon"></span>
        </a> --}}
    </div>
    <div class="banner-text">
        <div>
            <h1 class="animate__animated animate__fadeInDown animate__faster"><span class="primary-color">OFEMCO</span> SERVICES</h1><br />
            <p class="animate__animated animate__slideInUp animate__faster"><i>Put your investing ideas into action with a full range of
                investments.Enjoy real benefits and rewards on
                your accrue investing.</i>
            </p>
            <a id="get-quote-btn" href="mailto: ofemco@gmail.com" class="btn btn-info animate__animated animate__slideInUp animate__faster">GET A QUOTE</a>
        </div>
    </div>
    <div class="banner-below">
        <div class="banner-below__row text-center">
            <div class="first">
                <i class="fa fa-snowflake fa-2x"></i>
                <div>
                    <h4 class="underline-me">Reputation</h4>
                    <span>10Yrs+</span>
                </div>
            </div>
            <div class="second">
                <i class="fa fa-product-hunt fa-2x"></i>
                <div>
                    <h4 class="underline-me">Products</h4>
                    <span>65+</span>
                </div>
            </div>
            <div class="third">
                <i class="fa fa-network-wired fa-2x"></i>
                <div>
                    <h4 class="underline-me">Clients</h4>
                    <span>15+</span>
                </div>
            </div>
        </div>
    </div>
</section>