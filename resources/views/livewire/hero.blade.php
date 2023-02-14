<div>
  <!-- Hero Section Begin -->
  <section @class(['hero', 'hero-normal' => ($home==0)])>
    <div class="container">
      <div class="row">
        <div class="col-lg-3">
          <div class="hero__categories">
            <div class="hero__categories__all">
              <i class="fa fa-bars"></i>
              <span>All departments</span>
            </div>
            <ul>
                @foreach ($nhomsanpham as $nsp )
                <li><a href="#">{{$nsp->ten}}</a></li>
                @endforeach
            </ul>
          </div>
        </div>
        <div class="col-lg-9">
          <div class="hero__search">
            <div class="hero__search__form">
              <form action="#">
                <div class="hero__search__categories">
                  All Categories
                  <span class="arrow_carrot-down"></span>
                </div>
                <input type="text" placeholder="What do yo u need?">
                <button type="submit" class="site-btn">SEARCH</button>
              </form>
            </div>
            <div class="hero__search__phone">
              <div class="hero__search__phone__icon">
                <i class="fa fa-phone"></i>
              </div>
              <div class="hero__search__phone__text">
                <h5>+84 969 888 666</h5>
                <span>support 24/7 time</span>
              </div>
            </div>
          </div>
          @if ($home==1)
          <div class="hero__item set-bg" data-setbg="{{url('site')}}/img/hero/banner.jpg">
            <div class="hero__text">
              <h2>Men's <br />CASUALS</h2>
              <p>A GENTLEMEN'S GUIDE TO URBANE DRESSING</p>
              <a href="#" class="primary-btn">SHOP NOW</a>
            </div>
          </div>
        </div>
        @endif

      </div>
    </div>
  </section>
  <!-- Hero Section End -->

</div>
