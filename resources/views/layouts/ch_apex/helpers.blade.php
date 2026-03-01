@php
if (!function_exists('apexGetBidCount')) {
    function apexGetBidCount() {
        if(Auth::check()) {
            return \App\Models\Bid::where('user_id', Auth::user()->id)->count();
        }
        return 0;
    }
}

$current_bids = apexGetBidCount();
@endphp
