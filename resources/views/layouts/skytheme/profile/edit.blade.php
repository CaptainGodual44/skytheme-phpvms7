@extends('app')
@section('title', __('profile.editprofile'))

@section('content')
  @php
  $banner_url = \Modules\CHApex\Models\ApexUser::find($user->id)->banner_url ?? null;
  @endphp
  <div class="row">
    <div class="col-md-12">
      <h2>@lang('profile.edityourprofile')</h2>
      @include('flash::message')
      <form method="post" action="{{ route('frontend.profile.update', $user->id) }}" enctype="multipart/form-data">
        @csrf
        @method('PATCH')
        @include("profile.fields")
      </form>
      <h2>Apex Settings</h2>
      <div class="card">
        <div class="card-body">
          <form method="post" action="{{ route('chapex.profile.update', $user->id) }}">
            @csrf
            @method('PATCH')
            <div class="mb-3">
              <label for="banner_url" class="form-label">Profile Banner URL:</label>
              <input class="form-control" name="banner_url" value="{{$banner_url}}" id="banner_url">
              @if($banner_url)
                <img src="{{$banner_url}}" alt="Banner Image" style="display: block; width: 100%">
              @endif
            </div>
            <div style="width: 100%; text-align: right; padding-top: 20px;">
              <button type="submit" class="btn btn-primary">
                Update Apex Settings
              </button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
@endsection

@section('scripts')
@include('scripts.airport_search')
@endsection
