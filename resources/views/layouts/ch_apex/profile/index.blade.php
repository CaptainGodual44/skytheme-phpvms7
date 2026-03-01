@extends('app')
@section('title', __('common.profile'))

@section('content')
  @php
  $banner_url = \Modules\CHApex\Models\ApexUser::find($user->id)->banner_url;
  @endphp
  <div class="card">
    <div style="height: 400px; background: url('{!! $banner_url !!}') center no-repeat; background-size: cover;"></div>
    <div class="mx-5" style="height: 80px;position: relative; display: flex; flex-direction: row;">
      <div style="width: 140px;">
        @if ($user->avatar == null)
          <img src="{{ $user->gravatar(512) }}" style="height: 140px; width: 140px; position: absolute; bottom: 0; border: 5px white solid;"/>
        @else
          <img src="{{ $user->avatar->url }}" style="height: 140px; width: 140px; position: absolute; bottom: 0; border: 5px white solid;"/>
        @endif
      </div>
      <div class="d-flex flex-column justify-content-center ms-2">
        <div class="fs-3 fw-bold">{{ $user->ident }} - {{ $user->name_private }}</div>
        <div class="fs-5">{{ $user->rank->name }}</div>
      </div>
    </div>
  </div>
  <div class="row mt-4">
    <div class="col">
      <div class="card">
        <div class="card-header">Statistics</div>
        <div class="card-body">
          <div class="row">
            <div class="col-sm-12">
              <div class="row g-2">
                <div class="col-lg-6">
                  <div class="card text-center">
                    <div class="card-body">
                      <h2 class="fs-3">{{ $user->flights}}</h2>
                      <p class="fs-5">Flights</p>
                    </div>
                  </div>
                </div>

                <div class="col-lg-6">
                  <div class="card text-center">
                    <div class="card-body">
                      <div class="social-description">
                        <h2 class="fs-3">@minutestotime($user->flight_time)</h2>
                        <p class="fs-5">@lang('flights.flighthours')</p>
                      </div>
                    </div>
                  </div>
                </div>
                @if($user->current_airport)
                  <div class="col-lg-6">
                    <div class="card text-center">
                      <div class="card-body">
                        <div class="social-description">
                          <h2 class="fs-3">{{ $user->current_airport->icao }}</h2>
                          <p class="fs-5">@lang('airports.current')</p>
                        </div>
                      </div>
                    </div>
                  </div>
                @endif

                @if(setting('pilots.allow_transfer_hours') === true)
                  <div class="col-lg-6">
                    <div class="card text-center">
                      <div class="card-body">
                        <div class="social-description">
                          <h2 class="fs-3">@minutestohours($user->transfer_time)h</h2>
                          <p class="fs-5">@lang('profile.transferhours')</p>
                        </div>
                      </div>
                    </div>
                  </div>
                @endif
              </div>


            </div>
          </div>
        </div>
      </div>
    </div>
  </div>


  {{-- Show the user's award if they have any --}}
  @if ($user->awards)
    <div class="row">
      <div class="col-sm-12">
        <h3>Awards</h3>
        @foreach($user->awards->chunk(3) as $awards)
          <div class="row">
            @foreach($awards as $award)
              <div class="col-md-4 col-sm-12">
                <div class="card">
                  <div class="header header-primary text-center">
                    <h4 class="title title-up">{{ $award->name }}</h4>
                    @if ($award->image_url)
                      <div class="photo-container">
                        <img src="{{ $award->image_url }}" alt="{{ $award->description }}" style="width: 123px;">
                      </div>
                    @endif
                  </div>
                  <div class="content content-center">
                    <div class="social-description text-center">
                      {{ $award->description }}
                    </div>
                  </div>
                  <div class="footer text-center">
                  </div>
                </div>
              </div>
            @endforeach
          </div>
        @endforeach
      </div>
    </div>

  @endif
  

  {{--
      show the details/edit fields only for the currently logged in user
  --}}
  @if(Auth::check() && Auth::user()->id === $user->id)
    <div class="clearfix" style="height: 50px;"></div>
    <div class="row">
      <div class="col-sm-12">
        <div class="text-right">
          @if (isset($acars) && $acars === true)
            <a href="{{ route('frontend.profile.acars') }}" class="btn btn-primary"
               onclick="alert('Copy or Save to \'My Documents/phpVMS\'')">ACARS Config</a>
            &nbsp;
          @endif

          @if(config('services.discord.enabled') && !$user->discord_id)
            <a href="{{ route('oauth.redirect', ['provider' => 'discord']) }}" class="btn" style="background-color:#738ADB;">Link Discord Account</a>
          @elseif(config('services.discord.enabled'))
            <a href="{{ route('oauth.logout', ['provider' => 'discord']) }}" class="btn" style="background-color:#738ADB;">Unlink Discord Account</a>
          @endif

          <a href="{{ route('frontend.profile.regen_apikey') }}" class="btn btn-warning"
             onclick="return confirm('Are you sure? This will reset your API key!')">@lang('profile.newapikey')</a>
          &nbsp;
          <a href="{{ route('frontend.profile.edit', [$user->id]) }}"
             class="btn btn-primary">@lang('common.edit')</a>
        </div>

        <h3 class="description">@lang('profile.your-profile')</h3>
        <table class="table table-full-width">
          <tr>
            <td>@lang('common.email')</td>
            <td>{{ $user->email }}</td>
          </tr>
          <tr>
            <td>@lang('profile.apikey')&nbsp;&nbsp;<span class="description">(@lang('profile.dontshare'))</span></td>
            <td><span id="apiKey_show" style="display: none">{{ $user->api_key }} <i class="fas fa-eye-slash" onclick="apiKeyHide()"></i></span><span id="apiKey_hide">@lang('profile.apikey-show') <i class="fas fa-eye" onclick="apiKeyShow()"></i></span></td>
          </tr>
          <tr>
            <td>Discord ID</td>
            <td>{{ $user->discord_id ?? '-' }}</td>
          </tr>
          <tr>
            <td>@lang('common.timezone')</td>
            <td>{{ $user->timezone }}</td>
          </tr>
          <tr>
            <td>@lang('profile.opt-in')</td>
            <td>{{ $user->opt_in ? __('common.yes') : __('common.no') }}</td>
          </tr>
        </table>
      </div>
    </div>
  @endif

  <div class="clearfix" style="height: 50px;"></div>
  <div class="row">
    <div class="col-sm-12">
      <table class="table table-full-width">
        @foreach($userFields as $field)
          @if(!$field->private)
            <tr>
              <td>{{ $field->name }}</td>
              <td>{{ $field->value ?? '-'}}</td>
            </tr>
          @endif
        @endforeach
      </table>
    </div>
  </div>
@endsection

@section('scripts')
  <script>

    function apiKeyShow(){
      document.getElementById("apiKey_show").style = "display:block";
      document.getElementById("apiKey_hide").style = "display:none";
    }
    function apiKeyHide(){
      document.getElementById("apiKey_show").style = "display:none";
      document.getElementById("apiKey_hide").style = "display:block";
    }
  </script>
@endsection
