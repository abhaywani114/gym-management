@extends('profile.index')

@section('title', ucfirst($user->type). " Profile - $title")

@section('profile_content')
<div class="profile-content-wrapper ">
    <div class="profile-section" style="border:unset;">
        <h1>{{$title}}</h1>
        <br/>
<div style="display:flex;gap: 10px;flex-wrap: wrap;">
        @foreach($data as $u)
        <div class="search-result follow">
            <div class="image">
                <img src="{{!empty($u->dp) ? $u->dp:asset('assets/svgs/user.svg')}}"  />
            </div>
            <div class="text form">
                <a class="username" href="{{route('profile.profile', $u->id)}}">{{$u->name}}</a>
                <p class="description">{{$u->bio}}</p>
                <p class="description muted" style="font-size: 13px;">Sogam Lolab</p>
            </div>
        </div>
        <br/>
        @endforeach
        </div>
        <br/>
    </div>
</div>
@endsection
