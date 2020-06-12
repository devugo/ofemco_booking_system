<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="#"><img class="site-logo" src="{{ getLogo() }}" alt="logo" /></a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
  
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav ml-auto">
        <li class="nav-item @if($pageTitle === 'Home')active @endif">
          <a class="nav-link @if($pageTitle === 'Home')active @endif" href="/">Home</a>
        </li>
        @if(count($menus) > 0)
          @foreach($menus as $menu)
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle @if($pageTitle === $menu->main_menu)active @endif" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                {{ $menu->main_menu }}
              </a>
              <div class="dropdown-menu animate__animated animate__flipInX animate__faster" aria-labelledby="navbarDropdown">
                @if(count($menu->services) > 0)
                  @foreach ($menu->services as $service)
                    <a class="dropdown-item" href="/{{ $menu->main_menu_slug }}/{{ $service->sub_menu_slug }}">{{ $service->sub_menu }}</a>
                  @endforeach
                @endif
                {{-- <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="/login">Login</a> --}}
              </div>
            </li>
          @endforeach
        @endif
        @if (Route::has('login'))
          @auth
            <li class="nav-item">
              <a class="nav-link btn" href="{{ Auth::user()->role_id === 2 ? route('user.dashboard') : route('admin.dashboard') }}">Dashboard</a>
            </li>
            <li class="nav-item">
              <a class="btn nav-link" href="{{ route('logout') }}"
                onclick="event.preventDefault();
                document.getElementById('logout-form').submit();"
                id="logout-btn"
              >
                {{ __('Logout') }}
              </a>
              <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                  @csrf
              </form>
            </li>
          @else
            <li class="nav-item">
              <a class="btn nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
            </li>

            @if (Route::has('register'))
              {{-- <li class="nav-item">
                <a class="btn nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
              </li> --}}
            @endif
          @endauth
        @endif
      </ul>
    </div>
  </nav>