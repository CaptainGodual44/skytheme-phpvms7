@extends('app')
@section('title', __('auth.register'))

@section('content')
  <div class="row">
    <div class="col-sm-3"></div>
    <div class="col-sm-6">

      <form method="post" action="{{ url('/register') }}" class="form-signin">
      @csrf
      <div class="card periodic-login">
        <div class="card-body">
          <h2>@lang('common.register')</h2>
          <div class="mb-3 {{ $errors->has('name') ? 'is-invalid' : '' }}">
            <label for="name" class="form-label">@lang('auth.fullname')</label>
            <input name="name" id="name" class="form-control" placeholder="John Doe" value="{{ old('name') }}" />
            @if ($errors->has('name'))
              <div class="invalid-feedback">{{ $errors->first('name') }}</div>
            @endif
          </div>

          <div class="mb-3">
            <label for="email" class="form-label">@lang('auth.emailaddress')</label>
            <input type="email" name="email" id="email" class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}" value="{{ old('email') }}" />
            @if ($errors->has('email'))
              <div class="invalid-feedback">{{ $errors->first('email') }}</div>
            @endif
          </div>

          <div class="mb-3">
            <label for="airline" class="form-label">@lang('common.airline')</label>
            <select name="airline_id" id="airline_id" class="form-control select2 {{ $errors->has('airline') ? 'is-invalid' : '' }}">
              @foreach($airlines as $airline_id => $airline_label)
                <option value="{{ $airline_id }}" @if($airline_id === old('airline_id')) selected @endif>{{ $airline_label }}</option>
              @endforeach
            </select>
            @if ($errors->has('airline_id'))
              <div class="invalid-feedback">{{ $errors->first('airline_id') }}</div>
            @endif

          </div>
          <div class="mb-3">
            <label for="home_airport" class="form-label">@lang('airports.home')</label>
            <select name="home_airport_id" id="home_airport_id" class="form-control airport_search @if($hubs_only) hubs_only @endif">
              @foreach($airports as $airport_id => $airport_label)
                <option value="{{ $airport_id }}">{{ $airport_label }}</option>
              @endforeach
            </select>
            @if ($errors->has('home_airport_id'))
              <div class="invalid-feedback">{{ $errors->first('home_airport_id') }}</div>
            @endif
          </div>
          <div class="mb-3">
            <label for="country" class="form-label">@lang('common.country')</label>
            <select name="country" id="country" class="form-control select2 {{ $errors->has('country') ? 'is-invalid' : '' }}">
              @foreach($countries as $country_id => $country_label)
                <option value="{{ $country_id }}" @if($country_id === old('country')) selected @endif>{{ $country_label }}</option>
              @endforeach
                @if ($errors->has('country'))
                  <div class="invalid-feedback">{{ $errors->first('country') }}</div>
                @endif
            </select>

          </div>
          <div class="mb-3">
            <label for="timezone" class="form-label">@lang('common.timezone')</label>
            <select name="timezone" id="timezone" class="form-control select2 {{ $errors->has('timezone') ? 'is-invalid' : '' }}">
              @foreach($timezones as $group_name => $group_timezones)
                <optgroup label="{{ $group_name }}">
                  @foreach($group_timezones as $timezone_id => $timezone_label)
                    <option value="{{ $timezone_id }}" @if($timezone_id === old('timezone')) selected @endif>{{ $timezone_label }}</option>
                  @endforeach
                </optgroup>
              @endforeach
            </select>
            @if ($errors->has('timezone'))
              <p class="invalid-feedback">{{ $errors->first('timezone') }}</p>
            @endif

          </div>


          @if (setting('pilots.allow_transfer_hours') === true)
            <div class="mb-3">
              <label for="transfer_time" class="form-label">@lang('auth.transferhours')</label>
              <input type="number" name="transfer_time" id="transfer_time" class="form-control {{ $errors->has('transfer_time') ? 'is-invalid' : '' }}" value="{{ old('transfer_time') }}" />
              @if ($errors->has('transfer_time'))
                <div class="invalid-feedback">{{ $errors->first('transfer_time') }}</div>
              @endif
            </div>

          @endif
          <div class="mb-3">
            <label for="password" class="form-label">@lang('auth.password')</label>
            <input type="password" name="password" id="password" class="form-control {{ $errors->has('password') ? 'is-invalid' : '' }}" />
            @if ($errors->has('password'))
              <div class="invalid-feedback">{{ $errors->first('password') }}</div>
            @endif
          </div>
          <div class="mb-3">
            <label for="password_confirmation" class="form-label">@lang('passwords.confirm')</label>
            <input type="password" name="password_confirmation" id="password_confirmation" class="form-control {{ $errors->has('password_confirmation') ? 'is-invalid' : '' }}" />
            @if ($errors->has('password_confirmation'))
              <div class="invalid-feedback">{{ $errors->first('password_confirmation') }}</div>
            @endif
          </div>


          @if($userFields)
            @foreach($userFields as $field)
              <div class="mb-3">
                <label for="field_{{ $field->slug }}" class="form-label">{{ $field->name }}</label>
                <input type="text" name="field_{{ $field->slug }}" id="field_{{ $field->slug }}" class="form-control" value="{{ old('field_' .$field->slug) }}" />
                <div class="input-group form-group-no-border {{ $errors->has('field_'.$field->slug) ? 'is-invalid' : '' }}">

                </div>
                @if ($errors->has('field_'.$field->slug))
                  <p class="invalid-feedback">{{ $errors->first('field_'.$field->slug) }}</p>
                @endif
              </div>

            @endforeach
          @endif

          @if($captcha['enabled'] === true)
            <label for="h-captcha" class="control-label">@lang('auth.fillcaptcha')</label>
            <div class="h-captcha" data-sitekey="{{ $captcha['site_key'] }}"></div>
            @if ($errors->has('h-captcha-response'))
              <p class="invalid-feedback">{{ $errors->first('h-captcha-response') }}</p>
            @endif
          @endif

          @if($invite)
            <input type="hidden" name="invite" value="{{ $invite->id }}" />
            <input type="hidden" name="invite_token" value="{{ base64_encode($invite->token) }}" />
          @endif

          <div>
            @include('auth.toc')
            <br/>
          </div>

          <table>
            <tr>
              <td style="vertical-align: top; padding: 5px 10px 0 0">
                <div class="input-group form-group-no-border">
                  <input type="checkbox" name="toc_accepted" id="toc_accepted" />
                </div>
              </td>
              <td style="vertical-align: top;">
                <label for="toc_accepted" class="control-label">@lang('auth.tocaccept')</label>
                @if ($errors->has('toc_accepted'))
                  <p class="invalid-feedback">{{ $errors->first('toc_accepted') }}</p>
                @endif
              </td>
            </tr>
            <tr>
              <td>
                <div class="input-group form-group-no-border">
                  <input type="hidden" name="opt_in" value="0"/>
                  <input type="checkbox" name="opt_in" id="opt_in" value="1"/>
                </div>
              </td>
              <td>
                <label for="opt_in" class="control-label">@lang('profile.opt-in-descrip')</label>
              </td>
            </tr>
          </table>

          <div style="width: 100%; text-align: right; padding-top: 20px;">
              <button type="submit" class="btn btn-primary" id="register_button" disabled>
                @lang('auth.register')
              </button>
          </div>

        </div>
      </div>
      </form>
    </div>
    <div class="col-sm-4"></div>
  </div>
@endsection

@section('scripts')
  @if ($captcha['enabled'])
    <script src="https://hcaptcha.com/1/api.js" async defer></script>
  @endif

  <script>
    $('#toc_accepted').click(function () {
      if ($(this).is(':checked')) {
        $('#register_button').removeAttr('disabled');
      } else {
        $('#register_button').attr('disabled', 'true');
      }
    });
  </script>
@include('scripts.airport_search')
@endsection
