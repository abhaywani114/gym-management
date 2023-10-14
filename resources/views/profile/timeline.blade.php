@extends('profile.index')

@section('title', ucfirst($user->type).' Profile - Timeline')

@section('profile_content')
<div class="timeline-wrapper">
    @if (!$user->posts->isEmpty())
        <div class="timeline-line"></div>
    @endif

    @foreach($user->posts as $post)
    <div class="post">
        <div class="icon">
            <div class="svgicon">
<svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path d="M15.7 4C18.87 4 21 6.98 21 9.76C21 15.39 12.16 20 12 20C11.84 20 3 15.39 3 9.76C3 6.98 5.13 4 8.3 4C10.12 4 11.31 4.91 12 5.71C12.69 4.91 13.88 4 15.7 4Z" stroke="#06607f" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path> </g></svg>
            </div>
        </div>
        <div class="content">
            @if(!empty($post->image))
            <div class="image">
                <img src="{{$post->image}}" />
            </div>
            @endif
            <div class='user-info'>
                <h4>{{$post->author->first_name}} {{$post->author->last_name}}, <span class="muted">{{$post->created_at->diffForHumans()}}</span></h4>
            </div>
            <div class="text">
                {{ $post->text }}
            </div>
        </div>
    </div>
    @endforeach

</div>
@endsection
