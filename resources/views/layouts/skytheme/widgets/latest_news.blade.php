<div class="card">
  <div class="card-header">
    @lang('widgets.latestnews.news')
  </div>
  <div class="card-body" style="min-height: 0px">
    @if($news->count() === 0)
      <div class="text-center text-muted" style="padding: 30px;">
        @lang('widgets.latestnews.nonewsfound')
      </div>
    @endif
    <div class="list-group">
      @foreach($news as $item)
      <a href="{{route('chapex.news.show', $item)}}" class="list-group-item list-group-item-action" aria-current="true">
        <div class="d-flex w-100 justify-content-between">
          <h5 class="mb-1">{{$item->subject}}</h5>
          <small>{{ $item->user->name_private }} - {{ show_datetime($item->created_at) }}</small>
        </div>
        @php
          $fp = substr($item->body, strpos($item->body, "<p"), strpos($item->body, "</p>")+4);
        @endphp
        <p class="mb-1">{!! $fp !!}</p>
        <small>Read More</small>
      </a>
      @endforeach
    </div>

  </div>
</div>
