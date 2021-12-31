@if(Auth::user())
    @if(Auth::user()->type == 0)
        @include('admin-navigation')
    @elseif(Auth::user()->type == 1)
        @include('manager-navigation')
    @endif
@else
    <script>window.location = "/";</script>
@endif

