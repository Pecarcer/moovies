@if(Auth::user()->avatar)    
    <img src="{{ route('user.avatar', ['filename'=>Auth::user()->avatar])  }}" class="avatar">
@endif

<!--<img src="{{ url('/user/avatar/' . Auth::user()->avatar) }}">-->