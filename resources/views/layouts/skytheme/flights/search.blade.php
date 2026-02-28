<form method="get" action="{{ route('frontend.flights.search') }}">
  <div class="accordion" id="accordionFlushExample">
    <div class="accordion-item">
      <h2 class="accordion-header">
        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
          @lang('flights.search')
        </button>
      </h2>
      <div id="flush-collapseOne" class="accordion-collapse collapse" data-bs-parent="#accordionFlushExample">
        <div class="accordion-body">
          <div class="form-container">
            <div class="form-container-body">
              <div class="row">
                <div class="col-md-4">
                  <div class="form-group search-form">
                    @csrf
                    <div>
                      <div class="form-group">
                        <div>@lang('common.airline')</div>
                        <select name="airline_id" id="airline_id" class="form-control form-select">
                          @foreach($airlines as $airline_id => $airline_label)
                            <option value="{{ $airline_id }}" @if(request()->get('airline_id') == $airline_id) selected @endif>{{ $airline_label }}</option>
                          @endforeach
                        </select>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <div>@lang('flights.flighttype')</div>
                    <select name="flight_type" id="flight_type" class="form-control form-select">
                      @foreach($flight_types as $flight_type_id => $flight_type_label)
                        <option value="{{ $flight_type_id }}" @if(request()->get('flight_type') == $flight_type_id) selected @endif>{{ $flight_type_label }}</option>
                      @endforeach
                    </select>
                  </div>
                </div>
                <div class="col-md-2">
                  <div class="form-group">
                    <div>@lang('flights.flightnumber')</div>
                    <input type="text" name="flight_number" id="flight_number" class="form-control" value="{{ request()->get('flight_number') }}" />
                  </div>
                </div>
                <div class="col-md-2">
                  <div class="form-group">
                    <div>@lang('flights.code')</div>
                    <input type="text" name="route_code" id="route_code" class="form-control" value="{{ request()->get('route_code') }}" />
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-4">
                  <div class="form-group">
                    <div>@lang('airports.departure')</div>
                    <select name="dep_icao" id="dep_icao" class="form-control airport_search search_modal" style="width: 100%;">
                    </select>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <div>@lang('airports.arrival')</div>
                    <select name="arr_icao" id="arr_icao" class="form-control airport_search search_modal" style="width: 100%;">
                    </select>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <div>@lang('common.subfleet')</div>
                    <select name="subfleet_id" id="subfleet_id" class="form-select form-select-sm select2" style="width: 100%;">
                      @foreach($subfleets as $subfleet_id => $subfleet_label)
                        <option value="{{ $subfleet_id }}" @if(request()->get('subfleet_id') == $subfleet_id) selected @endif>{{ $subfleet_label }}</option>
                      @endforeach
                    </select>
                  </div>
                </div>
                @if(isset($type_ratings))
                  <div class="col-md-4">
                    <div class="form-group">
                      <div>Type Rating</div>
                      <select name="type_rating_id" id="type_rating_id" class="form-control select2 w-100"  style="width: 100%;">
                        <option value=""></option>
                        @foreach($type_ratings as $tr)
                          <option value="{{ $tr->id }}" @if(request()->get('type_rating_id') == $tr->id) selected @endif>{{ $tr->type.' | '.$tr->name }}</option>
                        @endforeach
                      </select>
                    </div>
                  </div>
                @endif
                @if(isset($icao_codes))
                  <div class="col-md-4">
                    <div class="form-group">
                      <div>ICAO Type</div>
                      <select name="icao_type" id="icao_type" class="form-control select2 w-100"  style="width: 100%;">
                        <option value=""></option>
                        @foreach($icao_codes as $icao)
                          <option value="{{ $icao }}" @if(request()->get('icao_type') == $icao) selected @endif>{{ $icao }}</option>
                        @endforeach
                      </select>
                    </div>
                  </div>
                @endif
              </div>
            </div>
          </div>
          <div class="mt-4">
            <button type="submit" class="btn btn-primary">@lang('common.find')</button>
            <a class="btn btn-secondary" href="{{ route('frontend.flights.index') }}">@lang('common.reset')</a>
          </div>
        </div>
      </div>
    </div>
  </div>
</form>

