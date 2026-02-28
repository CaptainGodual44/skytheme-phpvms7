<nav class="navbar navbar-expand-lg bg-body-tertiary">
  <div class="container-fluid">
    <a class="navbar-brand" href="{{ route('frontend.dashboard.index') }}">{{ config('app.name') }}</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarText">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        @if(Auth::check())

        @endif

        @foreach($moduleSvc->getFrontendLinks($logged_in=false) as &$link)
          <li class="nav-item">
            <a class="nav-link" href="{{ url($link['url']) }}">
              <i class="{{ $link['icon'] }}"></i>
              {{ ($link['title']) }}
            </a>
          </li>
        @endforeach

        @foreach($page_links as $page)
          <li class="nav-item">
            <a class="nav-link" href="{{ $page->url }}" target="{{ $page->new_window ? '_blank':'_self' }}">
              <i class="{{ $page['icon'] }}"></i>
              {{ $page['name'] }}
            </a>
          </li>
        @endforeach
      </ul>
      <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
        @guest
          <li class="nav-item">
            <a class="nav-link" href="{{ url('/register') }}">
              <i class="far fa-id-card"></i>
              @lang('common.register')
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{ url('/login') }}">
              <i class="fas fa-sign-in-alt"></i>
              @lang('common.login')
            </a>
          </li>
        @endguest
        @auth
          <li class="nav-item dropdown my-0 my-md-auto">
            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              Flight Operations
            </a>
            <ul class="dropdown-menu">
              <li>
                <a class="dropdown-item" href="{{ route('frontend.livemap.index') }}">
                  <i class="fas fa-globe"></i><span>&nbsp;@lang('common.livemap')</span>
                </a>
              </li>
              <li><a class="dropdown-item" href="{{ route('frontend.flights.index') }}"><i class="bi bi-airplane-fill"></i>
                  {{ trans_choice('common.flight', 2) }}</a></li>
              @if(check_module('CHFreeFlight'))
                <li><a class="dropdown-item" href="{{ route('chfreeflight.create') }}"><i class="bi bi-send-fill"></i>&nbsp;Free Flight</a></li>
              @endif
              @if(check_module('CHEvents') || check_module('CHEventsPro'))
                <li><a class="dropdown-item" href="{{ route('chevents.index') }}"><i class="bi bi-calendar-event"></i>&nbsp;Events</a></li>
              @endif
              @if(check_module('DisposableSpecial'))
                <li><a class="dropdown-item" href="{{ route('DSpecial.tours') }}"><i class="bi bi-compass-fill"></i>
                    <span>Tours</span></a></li>
              @endif
              <li><hr class="dropdown-divider"></li>
              @if(check_module('DisposableBasic'))
                <li>
                  <a class="dropdown-item" href="{{ route('DBasic.fleet') }}">
                    <i class="fas fa-plane"></i>
                    @lang('chapex::disposable.menu_fleet')
                  </a>
                </li>
                <li>
                  <a class="dropdown-item" href="{{ route('DBasic.hubs') }}">
                    <i class="bi bi-house"></i>
                    @lang('chapex::disposable.menu_hubs')
                  </a>
                </li>
                <li>
                  <a class="dropdown-item" href="{{ route('DBasic.pireps') }}">
                    <i class="bi bi-journal"></i>
                    @lang('chapex::disposable.menu_reports')
                  </a>
                </li>
                <li>
                  <a class="dropdown-item" href="{{ route('DBasic.livewx') }}">
                    <i class="bi bi-cloud-drizzle"></i>
                    @lang('chapex::disposable.menu_mapwx')
                  </a>
                </li>
              @endif
            </ul>
          </li>
          <li class="nav-item dropdown my-0 my-md-auto">
            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              Resources
            </a>
            <ul class="dropdown-menu">
              <li><a class="dropdown-item" href="{{ route('frontend.downloads.index') }}">{{ trans_choice('common.download', 2) }}</a></li>
              @if(check_module('DisposableBasic'))
                <li>
                  <a class="dropdown-item" href="{{ route('DBasic.airlines') }}">
                    <i class="fas fa-hotel"></i>
                    @lang('chapex::disposable.menu_airlines')
                  </a>
                </li>
                <li>
                  <a class="dropdown-item" href="{{ route('DBasic.ranks') }}">
                    <i class="fas fa-tags"></i>
                    @lang('chapex::disposable.menu_ranks')
                  </a>
                </li>
                <li>
                  <a class="dropdown-item" href="{{ route('DBasic.awards') }}">
                    <i class="fas fa-trophy"></i>
                    @lang('chapex::disposable.menu_awards')
                  </a>
                </li>
                <li>
                  <a class="dropdown-item" href="{{ route('DBasic.stats') }}">
                    <i class="fas fa-cogs"></i>
                    @lang('chapex::disposable.menu_stats')
                  </a>
                </li>
                @endif
              @if(check_module('DisposableSpecial'))
                <li>
                  <a class="dropdown-item" href="{{ route('DSpecial.notams') }}">
                    <i class="fas fa-sticky-note"></i>
                    @lang('chapex::disposable.menu_notams')
                  </a>
                </li>
                <li>
                  <a class="dropdown-item" href="{{ route('DSpecial.ops_manual') }}">
                    <i class="fas fa-book"></i>
                    @lang('chapex::disposable.menu_opsman')
                  </a>
                </li>
              @endif
            </ul>
          </li>

          {{-- Show the module links for being logged in
          @foreach($moduleSvc->getFrontendLinks($logged_in=true) as &$link)
            <li class="nav-item m-auto">
              <a class="nav-link" href="{{ url($link['url']) }}">
                <i class="{{ $link['icon'] }}"></i>
                <span>{{ ($link['title']) }}</span>
              </a>
            </li>
          @endforeach
          --}}
        @endauth
        <li class="nav-item dropdown my-0 my-md-auto">
          <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" data-boundary="viewport" aria-haspopup="true" aria-expanded="false">
            <span class="flag-icon flag-icon-{{ $languages[$locale]['flag-icon'] }}"></span>
          </a>
          <div class="dropdown-menu dropdown-menu-end">
            @foreach ($languages as $lang => $language)
              @if ($lang != $locale)
                <a class="dropdown-item" href="{{ route('frontend.lang.switch', $lang) }}">
                  <span class="flag-icon flag-icon-{{ $language['flag-icon'] }}"></span>&nbsp;&nbsp;{{ $language['display'] }}
                </a>
              @endif
            @endforeach
          </div>
        </li>
        @auth
          <li class="nav-item py-2 py-lg-1 col-12 col-lg-auto">
            <div class="vr d-none d-lg-flex h-100 mx-lg-2 text-body-secondary"></div>
            <hr class="d-lg-none my-2 text-body-secondary">
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button"
               data-bs-toggle="dropdown" data-boundary="viewport" aria-haspopup="true" aria-expanded="false">
              @if (Auth::user()->avatar == null)
                <img src="{{ Auth::user()->gravatar(128) }}" style="height: 38px; width: 38px;">
              @else
                <img src="{{ Auth::user()->avatar->url }}" style="height: 38px; width: 38px;">
              @endif
            </a>
            <div class="dropdown-menu dropdown-menu-end">
              <a class="dropdown-item" href="{{ route('frontend.dashboard.index') }}">
                <i class="fas fa-tachometer-alt"></i>
                <span>@lang('common.dashboard')</span>
              </a>
              @if(Theme::getSetting('legacy_theme'))
                <a class="dropdown-item bg-danger-subtle" href="/chapex/themeset?value={{Theme::getSetting('legacy_theme')}}">
                  <i class="bi bi-skip-backward-fill"></i>&nbsp;&nbsp;Back To Legacy Theme
                </a>
              @endif
              <a class="dropdown-item" href="{{ route('frontend.profile.index') }}">
                <i class="far fa-user"></i>&nbsp;&nbsp;@lang('common.profile')
              </a>
              <a class="dropdown-item" href="{{ route('frontend.flights.bids') }}">
                <i class="far fa-bookmark"></i>&nbsp;&nbsp;{{ trans_choice('flights.mybid', 2) }}
              </a>
              <a class="dropdown-item" href="{{ route('frontend.pireps.index') }}">
                <i class="bi bi-journal"></i>&nbsp;&nbsp;{{ trans_choice('common.pirep', 2) }}
              </a>
              @ability('admin', 'admin-access')
              <a class="dropdown-item" href="{{ url('/admin') }}">
                <i class="fas fa-circle-notch"></i>&nbsp;&nbsp;@lang('common.administration')
              </a>
              @endability
              <div class="dropdown-divider"></div>
              @if(check_module('DisposableBasic'))
                <a class="dropdown-item" href="{{ route('DBasic.myairline', [Auth::user()->airline_id]) }}">
                  <i class="bi bi-globe"></i>
                  @lang('chapex::disposable.menu_company')
                </a>
                <a class="dropdown-item" href="{{ route('DBasic.hub', [Auth::user()->home_airport_id ?? '']) }}">
                  <i class="bi bi-house"></i>
                  @lang('chapex::disposable.menu_base')
                </a>
              @endif
              <div class="dropdown-divider"></div>
              <a class="dropdown-item" href="{{ url('/logout') }}">
                <i class="fas fa-sign-out-alt"></i>&nbsp;&nbsp;@lang('common.logout')
              </a>
            </div>
          </li>
        @endauth
        <li class="nav-item py-2 py-lg-1 col-12 col-lg-auto">
          <div class="vr d-none d-lg-flex h-100 mx-lg-2 text-body-secondary"></div>
          <hr class="d-lg-none my-2 text-body-secondary">
        </li>
        <li class="nav-item dropdown my-0 my-md-auto">
          <button class="btn btn-link nav-link py-2 px-0 px-lg-2 dropdown-toggle d-flex align-items-center" id="bd-theme" type="button" aria-expanded="true" data-bs-toggle="dropdown" data-bs-display="static" aria-label="Toggle theme (light)">
            <i class="bi-sun-fill" id="theme-icon-active"></i>
            <span class="d-lg-none ms-2" id="bd-theme-text">Toggle Colors</span>
          </button>
          <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="bd-theme-text" data-bs-popper="static">
            <li>
              <button type="button" class="dropdown-item d-flex align-items-center active" data-bs-theme-value="light" aria-pressed="true">
                <i class="bi-sun-fill"></i>
                &nbsp;Light
              </button>
            </li>
            <li>
              <button type="button" class="dropdown-item d-flex align-items-center" data-bs-theme-value="dark" aria-pressed="false">
                <i class="bi-moon-stars-fill"></i>
                &nbsp;Dark
              </button>
            </li>
            <li>
              <button type="button" class="dropdown-item d-flex align-items-center" data-bs-theme-value="auto" aria-pressed="false">
                <i class="bi-circle-half"></i>
                &nbsp;Auto
              </button>
            </li>
          </ul>
        </li>
      </ul>
    </div>
  </div>
</nav>
