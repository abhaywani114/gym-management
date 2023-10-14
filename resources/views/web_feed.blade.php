@extends('layout')
@section('title', 'Web Feed')

@section('content')
<div class="webfeed-wrapper">
    <div class="regular-content">
   <form class="form" autocomplete="off" method="POST" enctype="multipart/form-data" action="{{route('timeline.add_handle')}}">
    <h1>New Post</h1>
    @if ($errors->any())
            <div class="alert alert-danger">
                <ul style="margin:3px;">
                    @foreach ($errors->all() as $error)
                        <li style="margin: 5px;">{!! $error !!}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <div class="field ">
            <textarea type="text" placeholder="What is on your mind?" name="text" rows="4" style="height: unset;min-height: 40px;" required></textarea>
        </div>
        <div class="button-wrapper">
          <input type="file" id="image_1" style="display: none;" name="image" accept="image/*"  onchange="fileSelected(this)" />
          <a class="button" onclick="selectFile('image_1')">
            <svg width="14" height="15" viewBox="0 0 14 15" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M14 8.5H8V14.5H6V8.5H0V6.5H6V0.5H8V6.5H14V8.5Z" fill="white"/></svg>
              Upload Image
          </a>
        </div>
        <br/>
        <div class="button-wrapper">
            @csrf
            <button class="button">Post</button>
        </div>
    </form>
</div>

<div class="timeline-wrapper webfeed">
    @if (!$timeline->isEmpty())
        <div class="timeline-line"></div>
    @endif
    @foreach($timeline as $post)
    <div class="post">
        <div class="icon">
            <div class="svgicon">
<svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path d="M15.7 4C18.87 4 21 6.98 21 9.76C21 15.39 12.16 20 12 20C11.84 20 3 15.39 3 9.76C3 6.98 5.13 4 8.3 4C10.12 4 11.31 4.91 12 5.71C12.69 4.91 13.88 4 15.7 4Z" stroke="#06607f" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path> </g></svg>
            </div>
        </div>
        <div class="content webfeed">
            @if ($post->image)
            <div class="image" style="padding-top:10px;">
                <img src="{{$post->image}}" />
            </div>
            @endif
            <div class='user-info'>
                <h4><a href="{{route('profile.profile', $post->author->id)}}" style="all:unset;cursor:pointer;">{{$post->author->first_name}} {{$post->author->last_name}}</a>, <span class="muted">{{$post->created_at->diffForHumans()}}</span></h4>
            </div>
            <div class="text">
                {{$post->text}}
            </div>
        </div>
    </div>
    @endforeach
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
