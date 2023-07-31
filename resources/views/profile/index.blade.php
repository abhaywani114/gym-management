@extends('layout')

@section('content')
<div class="profile-wrapper">
    <div class="profile-picture">
        <img src="{{asset('assets/svgs/user.svg')}}" alt="User {{$user->name}}" />
    </div>
    <div class="profile-content">
        <div class="user-info">
            <h1 class="username">{{$user->name}}</h1>
            <p class="description">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam sagittis efficitur leo, a facilisis ex eleifend a. Praesent lectus quam, pulvinar a lacus ac, consectetur aliquam lorem. Ut molestie varius facilisis. In hac habitasse platea dictumst. Sed quis lectus a tellus luctus luctus.</p>
            <p class="location">Following: <span class="highlight">10</span> | Followers: <span class="highlight">15</span> | Sogam, Kupwara</p>
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
