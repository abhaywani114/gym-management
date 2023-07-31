@extends('profile.index')

@section('title', ucfirst(Auth::user()->type).' Profile > Timeline')

@section('profile_content')
<div class="timeline-wrapper">
    <div class="timeline-line"></div>

    <div class="post">
        <div class="icon">
            <div class="svgicon">
<svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path d="M15.7 4C18.87 4 21 6.98 21 9.76C21 15.39 12.16 20 12 20C11.84 20 3 15.39 3 9.76C3 6.98 5.13 4 8.3 4C10.12 4 11.31 4.91 12 5.71C12.69 4.91 13.88 4 15.7 4Z" stroke="#06607f" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path> </g></svg>
            </div>
        </div>
        <div class="content">
            <div class="image">
                <img src="https://placehold.co/600x400" />
            </div>
            <div class="text">
                SAML 2.0, OpenID and OAuth 2.0/OpenID Connect are protocols used for web single sign on and identity and access management that have been developed over the past 16 years.
            </div>
        </div>
    </div>

</div>
@endsection
