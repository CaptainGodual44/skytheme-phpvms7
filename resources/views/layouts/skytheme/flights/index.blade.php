@extends('app')
@section('title', trans_choice('common.flight', 2))

@section('content')
  <div class="row">
    @include('flash::message')
    <div class="col-md-12">
      <h2>{{ trans_choice('common.flight', 2) }}</h2>
      <div class="mb-4">
        @include('flights.search')
      </div>
      @include('flights.flights_table')
    </div>
  </div>
  <div class="row mt-4">
    <div class="col-12 text-center">
      {{ $flights->withQueryString()->links('pagination.default') }}
    </div>
  </div>
  @if (setting('bids.block_aircraft', false))
    @include('flights.bids_aircraft')
  @endif
@endsection

@include('flights.scripts')

