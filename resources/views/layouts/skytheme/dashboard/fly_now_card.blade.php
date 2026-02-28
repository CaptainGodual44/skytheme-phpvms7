@include('helpers')
<div class="card">
  <div class="card-body">
    <div class="text-center">Welcome To</div>
    <div class="text-center fs-4">{{ \App\Models\Airport::find($current_airport)->name ?? "NA"}}</div>
    <div class="d-grid gap-2">
      @if(check_module('CHJumpSeat') || check_module('CHJumpSeatPro'))
        <a href="{{ route('chjumpseat.create') }}" class="btn btn-primary">
          Jumpseat
        </a>
      @endif
      <a href="{{ route('frontend.flights.bids') }}" class="btn btn-primary">
        {{ trans_choice('flights.mybid', 2) }} @if(apexGetBidCount()) <span class="badge text-bg-danger">{{apexGetBidCount()}}</span>@endif
      </a>
      <a href="{{ route('frontend.flights.search') }}" class="btn btn-primary">
        {{ trans_choice('common.flight', 2) }}
      </a>
    </div>
  </div>
</div>
