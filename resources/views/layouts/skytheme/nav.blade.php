<nav class="navbar navbar-expand bg-secondary navbar-dark sticky-top px-4 py-0">
  <a class="navbar-brand d-flex align-items-center me-4" href="{{ route('frontend.dashboard.index') }}">
    <h5 class="text-primary mb-0"><i class="fa fa-plane-departure me-2"></i>{{ config('app.name') }}</h5>
  </a>

  <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarText">
    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
      @foreach($moduleSvc->getFrontendLinks($logged_in=false) as &$link)
        <li class="nav-item">
          <a class="nav-link" href="{{ url($link['url']) }}">
            <i class="{{ $link['icon'] }} me-1"></i>
            {{ ($link['title']) }}
          </a>
        </li>
      @endforeach

      @foreach($page_links as $page)
        <li class="nav-item">
          <a class="nav-link" href="{{ $page->url }}" target="{{ $page->new_window ? '_blank':'_self' }}">
            <i class="{{ $page['icon'] }} me-1"></i>
            {{ $page['name'] }}
          </a>
        </li>
      @endforeach
    </ul>

    <ul class="navbar-nav ms-auto mb-2 mb-lg-0 align-items-lg-center">
      @guest
        <li class="nav-item">
          <a class="nav-link" href="{{ url('/register') }}"><i class="far fa-id-card me-1"></i>@lang('common.register')</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{ url('/login') }}"><i class="fas fa-sign-in-alt me-1"></i>@lang('common.login')</a>
        </li>
      @endguest

      @auth
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">Operations</a>
          <ul class="dropdown-menu dropdown-menu-end">
            <li><a class="dropdown-item" href="{{ route('frontend.dashboard.index') }}"><i class="fas fa-tachometer-alt me-1"></i>@lang('common.dashboard')</a></li>
            <li><a class="dropdown-item" href="{{ route('frontend.livemap.index') }}"><i class="fas fa-globe me-1"></i>@lang('common.livemap')</a></li>
            <li><a class="dropdown-item" href="{{ route('frontend.flights.index') }}"><i class="bi bi-airplane-fill me-1"></i>{{ trans_choice('common.flight', 2) }}</a></li>
            <li><a class="dropdown-item" href="{{ route('frontend.flights.bids') }}"><i class="far fa-bookmark me-1"></i>{{ trans_choice('flights.mybid', 2) }}</a></li>
            <li><a class="dropdown-item" href="{{ route('frontend.pireps.index') }}"><i class="bi bi-journal me-1"></i>{{ trans_choice('common.pirep', 2) }}</a></li>
            @if(check_module('CHFreeFlight'))
              <li><a class="dropdown-item" href="{{ route('chfreeflight.create') }}"><i class="bi bi-send-fill me-1"></i>Free Flight</a></li>
            @endif
            @if(check_module('CHEvents') || check_module('CHEventsPro'))
              <li><a class="dropdown-item" href="{{ route('chevents.index') }}"><i class="bi bi-calendar-event me-1"></i>Events</a></li>
            @endif
            @if(check_module('DisposableSpecial'))
              <li><a class="dropdown-item" href="{{ route('DSpecial.tours') }}"><i class="bi bi-compass-fill me-1"></i>Tours</a></li>
            @endif
          </ul>
        </li>

        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="profileDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            @if (Auth::user()->avatar == null)
              <img src="{{ Auth::user()->gravatar(64) }}" class="rounded-circle" style="height: 32px; width: 32px;">
            @else
              <img src="{{ Auth::user()->avatar->url }}" class="rounded-circle" style="height: 32px; width: 32px;">
            @endif
          </a>
          <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="profileDropdown">
            <li><a class="dropdown-item" href="{{ route('frontend.profile.index') }}"><i class="far fa-user me-1"></i>@lang('common.profile')</a></li>
            @ability('admin', 'admin-access')
            <li><a class="dropdown-item" href="{{ url('/admin') }}"><i class="fas fa-circle-notch me-1"></i>@lang('common.administration')</a></li>
            @endability
            <li><a class="dropdown-item" href="{{ route('frontend.downloads.index') }}"><i class="bi bi-download me-1"></i>{{ trans_choice('common.download', 2) }}</a></li>
            <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item" href="{{ url('/logout') }}"><i class="fas fa-sign-out-alt me-1"></i>@lang('common.logout')</a></li>
          </ul>
        </li>
      @endauth

      <li class="nav-item dropdown">
        <button class="btn btn-link nav-link py-2 px-0 px-lg-2 dropdown-toggle d-flex align-items-center" id="bd-theme" type="button" data-bs-toggle="dropdown" data-bs-display="static" aria-label="Toggle theme">
          <i class="bi-sun-fill" id="theme-icon-active"></i>
          <span class="d-lg-none ms-2" id="bd-theme-text">Toggle Colors</span>
        </button>
        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="bd-theme-text" data-bs-popper="static">
          <li><button type="button" class="dropdown-item d-flex align-items-center active" data-bs-theme-value="light" aria-pressed="true"><i class="bi-sun-fill"></i>&nbsp;Light</button></li>
          <li><button type="button" class="dropdown-item d-flex align-items-center" data-bs-theme-value="dark" aria-pressed="false"><i class="bi-moon-stars-fill"></i>&nbsp;Dark</button></li>
          <li><button type="button" class="dropdown-item d-flex align-items-center" data-bs-theme-value="auto" aria-pressed="false"><i class="bi-circle-half"></i>&nbsp;Auto</button></li>
        </ul>
      </li>
    </ul>
  </div>
</nav>
