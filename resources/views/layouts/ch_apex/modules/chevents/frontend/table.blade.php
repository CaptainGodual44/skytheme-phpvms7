<div class="row">
  @foreach($events as $event)
    <div class="col-md-6 col-sm-12">
      <div class="card border-blue-bottom">
        @if($event->banner_url)
          <img src="{{$event->banner_url}}" style="width: 100%" class="card-img-top" alt="{{$event->name}}"/>
        @endif
        <div class="card-body" style="min-height: 0">
          <h4 class="card-title">
            {{$event->name}}
          </h4>
          @if(now() > $event->starting_at && now() < $event->ending_at)
            <h5><span class="badge bg-info">In Progress</span></h5>
          @elseif(now() > $event->ending_at)
            <h5><span class="badge bg-success">Completed</span></h5>
          @else
            <h5><span class="badge bg-warning">{{ \Carbon\Carbon::parse($event->starting_at)->diffForHumans() }}</span></h5>
          @endif
          <div>{{$event->starting_at}} - {{$event->ending_at}}</div>
        </div>
        <div class="card-footer">
          <a class="btn btn-block btn-info mt-2" href="{{ route('chevents.show', [$event->id]) }}">
            Details
          </a>
          @if($event->can_join)
            @if(!$event->users->contains(Auth::user()->id))
              <a class="btn btn-block btn-success mt-2" href="" onclick="event.preventDefault();
                                    document.getElementById('join{{ $event->id }}').submit();">Join</a>
              <form id="join{{ $event->id }}" method="POST" action="{{ route('chevents.attach', [$event->id]) }}" accept-charset="UTF-8" hidden>
                @csrf
              </form>
            @else
              <a class="btn btn-block btn-danger mt-2" href="" onclick="event.preventDefault();
                                    document.getElementById('leave{{ $event->id }}').submit();">Leave</a>
              <form id="leave{{ $event->id }}" method="POST" action="{{ route('chevents.detach', [$event->id]) }}" accept-charset="UTF-8" hidden>
                {{ method_field('DELETE') }}
                @csrf
              </form>
            @endif
          @endif
        </div>
      </div>
    </div>
@endforeach
</div>
