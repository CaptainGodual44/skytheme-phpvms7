@extends('app')
@section('title', __('flights.mybid'))

@section('content')
  <div class="row">
    @include('flash::message')
    <div class="col-md-12">
      <h2>{{ __('flights.mybid') }}</h2>
      @include('flights.flights_table')
    </div>
  </div>
  @if (setting('bids.block_aircraft', false))
    @include('flights.bids_aircraft')
  @endif
@endsection

@include('flights.scripts')

