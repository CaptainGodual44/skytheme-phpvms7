<div class="d-grid gap-2">
  @foreach($pireps as $pirep)
      <div class="card">
        <div class="card-header d-flex flex-row justify-content-between">
          <div class="d-flex">
            <div>
              <img src="{{ $pirep->user->avatar == null ? $pirep->user->gravatar(120) : $pirep->user->avatar->url }}" style="height: 40px; width: 40px;"/>
            </div>
            <div class="my-auto ms-2" style="font-size: 24px">{{$pirep->user->name_private}}</div>
          </div>
          <div class="my-auto">
            {{$pirep->submitted_at}}
          </div>
        </div>
        <div class="card-body" style="min-height: 0">
          <div class="row">
            <div class="col-sm-12">
              <div class="d-flex flex-row">

              </div>
              <div class="row">
                <div class="col-sm-12">
                  <div class="flex-row justify-content-between d-none d-lg-flex">
                    <div class="">{{ $pirep->airline->name }}</div>
                    <div>{{$pirep->flight_type}} ({{\App\Models\Enums\FlightType::label($pirep->flight_type)}})</div>
                  </div>

                  <div style="font-size: 2rem; line-height: 2rem; font-weight: 600; text-align: center">
                    @if($pirep->airline->iata)
                      {{ $pirep->airline->icao }}{{$pirep->flight_number}} |
                    @endif
                    {{ $pirep->ident }}
                    @if(filled($pirep->callsign) && !setting('simbrief.callsign', true))
                      {{ '| '. $pirep->atc }}
                    @endif

                  </div>


                  <div class="text-center my-2 d-flex flex-row justify-content-center">
                    <div>
                      <div style="font-size: 3rem; line-height: 3rem; font-weight: 600">
                        {{$pirep->dpt_airport_id}}
                      </div>
                    </div>
                    <div class="mx-4 mt-0" style="font-size: 24px; line-height: 48px">to</div>
                    <div>
                      <div style="font-size: 3rem; line-height: 3rem; font-weight: 600">
                        {{$pirep->arr_airport_id}}
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-sm-3 align-top text-right">
              {{--
              !!! NOTE !!!
               Don't remove the "save_flight" class, or the x-id attribute.
               It will break the AJAX to save/delete

               "x-saved-class" is the class to add/remove if the bid exists or not
               If you change it, remember to change it in the in-array line as well
              --}}

            </div>
          </div>
          <div class="row">
            <div class="col-sm-12">
              {{ optional($pirep->aircraft)->ident }}
            </div>
          </div>
        </div>
      </div>
  @endforeach
</div>
