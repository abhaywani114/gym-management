@extends('profile.index')

@section('title', ucfirst(Auth::user()->type).' Profile - Location')

@section('profile_content')
<div class="profile-content-wrapper ">
    <div class="profile-section">
        <h1>Gym Location</h1>
        <iframe src="{{Auth::user()->map}}" width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
    </div>
</div>
@endsection
