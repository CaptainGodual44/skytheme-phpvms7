@extends('app')
@section('title', __('common.dashboard'))


@section('content')
  @php
    $banner_url = \Modules\CHApex\Models\ApexUser::find($user->id)->banner_url ?? "/assets/apex/default_profile_banner_bg.jpg";
  @endphp
  <div class="row">
    @if(Auth::user()->state === \App\Models\Enums\UserState::ON_LEAVE)
      <div class="col-sm-12">
        <div class="row">
          <div class="col-sm-12">
            <div class="alert alert-warning" role="alert">
              You are on leave! File a PIREP to set your status to active!
            </div>
          </div>
        </div>
      </div>
    @endif
    <div class="col-sm-12">
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
                <div style="font-size: 1.4rem; font-weight: bold">{{ $user->ident }} - {{ $user->name }}</div>
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
                        {{ optional($user->journal)->balance ?? 0 }}
                      </div>
                      <div>
                        @lang('dashboard.yourbalance')
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          @widget('CHApex::NextRank')
        </div>
      </div>
      <div class="d-md-none d-block mb-4">
        @include('dashboard.fly_now_card')
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-md-8 col-sm-12">
      <div class="mb-4">
        {{ Widget::latestNews(['count' => 5]) }}
      </div>
      <div class="card">
        <div class="card-header">@lang('dashboard.recentreports')</div>
        <div class="card-body">
          {{ Widget::latestPireps(['count' => 5]) }}
        </div>
      </div>

    </div>

    {{-- Sidebar --}}
    <div class="col-sm-12 col-md-4">
      <div class="d-md-block d-none">
        @include('dashboard.fly_now_card')
      </div>
      <div class="card mt-4">
        <div class="card-header" role="tablist">
          @lang('dashboard.yourlastreport')
        </div>
        <div class="card-body">
          <!-- Tab panes -->
          <div class="tab-content">
            @if($last_pirep === null)
              <div class="card-body" style="text-align:center;">
                @lang('dashboard.noreportsyet') <a
                  href="{{ route('frontend.pireps.create') }}">@lang('dashboard.fileonenow')</a>
              </div>
            @else
              @include('dashboard.pirep_card', ['pirep' => $last_pirep])
            @endif
          </div>
        </div>
      </div>
      @if(check_module('DisposableSpecial'))
        @widget('DSpecial::Assignments')
        @widget('DSpecial::TourProgress')
      @endif
    </div>
  </div>
@endsection
