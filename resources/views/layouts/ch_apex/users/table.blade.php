<table class="table table-hover" id="users-table">
  <thead>
  <th></th>
  <th>@sortablelink('name', __('common.name'))</th>
  <th style="text-align: center"></th>
  <th style="text-align: center">@sortablelink('airline_id', __('common.airline'))</th>
  <th style="text-align: center">@sortablelink('curr_airport_id', __('user.location'))</th>
  <th style="text-align: center">@sortablelink('flights', trans_choice('common.flight', 2))</th>
  <th style="text-align: center">@sortablelink('flight_time', trans_choice('common.hour', 2))</th>
  </thead>
</table>
<div class="row g-2">
  @foreach($users as $user)
    @php
      $banner_url = \Modules\CHApex\Models\ApexUser::find($user->id)->banner_url ?? "/assets/apex/default_profile_banner_bg.jpg";
    @endphp
    <div class="col-sm-12">
      <a class="text-decoration-none text-reset" href="{{route('frontend.users.show.public', ['id' => $user->id])}}">
      <div class="card mb-4 position-relative">
        <div class="position-absolute w-100 h-100" style="background: url('{{$banner_url}}') center no-repeat; background-size: cover;"></div>
        <div class="card-body z-3 bg-body-secondary bg-opacity-75 py-md-5 py-3">
          <div class="row gx-2">
            <div class="col-md-5 col-sm-12 d-flex flex-row mb-2 mb-md-0">
              <div class="my-auto">
                @if ($user->avatar == null)
                  <img src="{{ $user->gravatar(200) }}" style="height: 80px; width: 80px;"/>
                @else
                  <img src="{{ $user->avatar->url }}" style="height: 80px; width: 80px;"/>
                @endif
              </div>
              <div class="d-flex flex-column justify-content-center ms-2">
                <div style="font-size: 1.4rem; font-weight: bold">{{ $user->ident }} - {{ $user->name_private }}</div>
                <div style="font-size: 16px">{{ $user->rank->name }}</div>
              </div>
            </div>
            <div class="col-md col-sm-12 my-auto text-center">
              <div class="row g-2">
                <div class="col-lg-4 col-md-6">
                  <div class="card bg-primary text-light">
                    <div class="mx-auto my-2">
                      <div style="font-weight: bold; font-size: 1.4rem;">
                        {{$user->flights}}
                      </div>
                      <div>
                        {{ trans_choice('common.flight', $user->flights) }}
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-lg-4 col-md-6">
                  <div class="card bg-primary text-light">
                    <div class="mx-auto my-2">
                      <div style="font-weight: bold; font-size: 1.4rem;">
                        @minutestotime($user->flight_time)
                      </div>
                      <div>
                        @lang('dashboard.totalhours')
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-lg-4 col-md-6">
                  <div class="card bg-primary text-light">
                    <div class="mx-auto my-2">
                      <div style="font-weight: bold; font-size: 1.4rem;">
                        {{ $user->curr_airport_id }}
                      </div>
                      <div>
                        {{ __('user.location') }}
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      </a>
    </div>

  @endforeach
</div>
{{--
  @foreach($users as $user)
    <tr style="vertical-align: center">
      <td style="width: 80px;">
        <div class="photo-container">
          @if ($user->avatar == null)
            <img class="avatar-img"
                 src="{{ $user->gravatar(128) }}"/>
          @else
            <img class="avatar-img" src="{{ $user->avatar->url }}">
          @endif
        </div>
      </td>
      <td style="vertical-align: center">
        <a href="{{ route('frontend.users.show.public', [$user->id]) }}">
          {{$user->ident}}&nbsp;{{ $user->name_private }}
        </a>
      </td>
      <td align="center">
        @if(filled($user->country))
          <span class="flag-icon flag-icon-{{ $user->country }}"
                title="{{ $country->alpha2($user->country)['name'] }}"></span>
        @endif
      </td>
      <td class="text-center">{{ $user->airline->icao }}</td>
      <td class="text-center">
        @if($user->current_airport)
          {{ $user->curr_airport_id }}
        @else
          -
        @endif
      </td>
      <td align="center">{{ $user->flights }}</td>
      <td align="center">@minutestotime($user->flight_time)</td>
    </tr>
  @endforeach
  </tbody>
</table>
--}}
