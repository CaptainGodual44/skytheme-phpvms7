@extends('app')
@section('title', trans_choice('common.pirep', 2))

@section('css')
  @parent
  <link href="{{ public_asset('/assets/css/page-overlays.css') }}?v=20260227" rel="stylesheet">
  <style>
    .page-pireps h2 {
      letter-spacing: .03em;
    }

    .page-pireps .btn-info {
      box-shadow: 0 8px 18px rgba(6, 126, 193, 0.22);
    }
  </style>
@endsection

@section('content')
  <div class="page-pireps">
    <div class="row">
      <div class="col-md-12">
        <div class="float-end">
          <a class="btn btn-info pull-end"
             href="{{ route('frontend.pireps.create') }}">@lang('pireps.filenewpirep')</a>
        </div>
        <h2>{{ trans_choice('pireps.pilotreport', 2) }}</h2>
        @include('flash::message')
        @include('pireps.table')
      </div>
    </div>
  </div>
@endsection
