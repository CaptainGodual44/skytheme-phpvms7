@extends('app')
@section('title', trans_choice('common.flight', 2))

@section('css')
  @parent
  <link href="{{ public_asset('/assets/css/page-overlays.css') }}" rel="stylesheet">
  <style>
    .page-flights h2 {
      letter-spacing: .02em;
    }

    .page-flights .glass-footer {
      border-radius: .75rem;
      padding-top: .5rem;
      padding-bottom: .5rem;
    }

    .page-flights .card-header.bg-primary {
      color: #f1c75a !important;
      background: linear-gradient(145deg, rgba(20, 20, 20, 0.92), rgba(42, 42, 42, 0.78)) !important;
      border-bottom-color: rgba(163, 163, 163, 0.25);
    }
  </style>
@endsection

@section('content')
  <div class="page-flights">
    <div class="row">
      @include('flash::message')
      <div class="col-xl-9 col-md-12">
        <h2>{{ trans_choice('common.flight', 2) }}</h2>
        <div class="d-xl-none mb-3">
          <div class="accordion" id="searchAccordion">
            <div class="accordion-item">
              <h2 class="accordion-header" id="headingOne">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
                  @lang('flights.search')
                </button>
              </h2>
              <div id="collapseOne" class="accordion-collapse collapse" aria-labelledby="headingOne" data-bs-parent="#searchAccordion">
                <div class="accordion-body">
                  @include('flights.search')
                </div>
              </div>
            </div>
          </div>
        </div>
        @include('flights.table')
      </div>
      <div class="col-xl-3 d-none d-xl-block">
        <div class="card glass-panel data-module-flights-search">
          <div class="card-header bg-primary text-white">@lang('flights.search')</div>
          <div class="card-body">
            @include('flights.search')
          </div>
        </div>
      </div>
    </div>
    <div class="row glass-footer mt-2">
      <div class="col-xl-9 col-lg-12 text-center">
        {{ $flights->withQueryString()->links('pagination.bootstrap-5') }}
      </div>
    </div>
    @if (setting('bids.block_aircraft', false))
      @include('flights.bids_aircraft')
    @endif
  </div>
@endsection

@include('flights.scripts')
