@extends('layout')
@section('title', "Search - $search_key")

@section('content')
<div class="webfeed-wrapper">
<div class="timeline-wrapper webfeed">
    @if($data->isEmpty())
        <h2>No user found for the key: {{$search_key}}</h2>
    @endif
    @foreach($data as $user)
        <div class="search-result">
            <div class="image">
                <img src="{{!empty($user->dp) ? $user->dp:asset('assets/svgs/user.svg')}}"  />
            </div>
            <div class="text form">
                <a class="username" href="{{route('profile.profile', $user->id)}}">{{$user->name}}</a>
                <p class="description">{{$user->bio}}</p>
                <div class="buttons button-wrapper">
                    @if(!$user->isFollowing)
                        <a class="button" href="{{route('toggle_follow', $user->id)}}">Follow</a>
                    @else
                        <a class="button" href="{{route('toggle_follow', $user->id)}}">Unfollow</a>
                    @endif
                    @if ($user->type == 'gym')
                        <a class="button">Request Admission</a>
                    @endif
                        <a class="button" href="{{route('chat.chat', $user->id)}}">Chat</a>
                </div>
            </div>
        </div>
    @endforeach
    </div>
</div>
</div>
<script>
function selectFile(id) {
  document.getElementById(id).click(); return false;
}
function fileSelected(e) {
  e.nextElementSibling.classList.add("selected")
}
</script>
@endsection
