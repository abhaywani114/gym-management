@extends('layout')

@section('content')
<div class="profile-wrapper">
        <img class="profile-picture" src="{{!empty($user->dp) ? $user->dp:asset('assets/svgs/user.svg')}}" alt="User {{$user->name}}" />
    <div class="profile-content">
        <div class="user-info">
            <h1 class="username">{{$user->name}}</h1>
            <p class="description">{{$user->bio}}</p>
            <p class="location">Following:
                    <a class="highlight" href="{{route('profile.following', $user->id)}}">{{$user->following->count()}}</a>
                        | Followers:
                    <a class="highlight" href="{{route('profile.followers', $user->id)}}">{{$user->followers->count()}}</a>
                | Sogam, Kupwara</p>
        </div>

        <div class="user-navbar">
            <ul>
                <li><a href="{{route('profile.profile', $user->id)}}" class="{{request()->route()->getName() == 'profile.profile' ? 'active':''}}">Timeline</a></li>
                <li><a href="{{route('profile.details', $user->id)}}" class="{{request()->route()->getName() == 'profile.details' ? 'active':''}}">Details</a></li>
                <li><a>Performance</a></li>
                <li><a href="{{route('profile.calendar', $user->id)}}" class="{{request()->route()->getName() == 'profile.calendar' ? 'active':''}}">Calender</a></li>
            </ul>
        </div>
            @yield('profile_content')
    </div>
</div>
@endsection
