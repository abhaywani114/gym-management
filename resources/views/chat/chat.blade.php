@extends('layout')
@section('title', "Chat")

@section('content')
<div class="chat-wrapper">
    <div class="contact-list">
        <div class="title">Contact List</div>
        <div class="data">
            @for($i = 0; $i < 10; $i++)
            @foreach($data as $u)
                <div class="search-result chat">
                    <div class="image">
                        <img src="{{!empty($u->dp) ? $u->dp:asset('assets/svgs/user.svg')}}"  />
                    </div>
                    <div class="text">
                        <a class="username" href="{{route('profile.profile', $u->id)}}">{{$u->name}}</a>
                        <p class="description muted" style="font-size: 13px;">Sogam Lolab</p>
                    </div>
                </div>
                @endforeach
                @endfor
        </div>
    </div>
    <div class="message-area">
        <div class="title">Contact List</div>
        <div class="data">
        </div>
        <div class="sending-pad">
        <form class="form" autocomplete="off" method="POST" enctype="multipart/form-data" action="{{route('profile.settings.handle', Auth::user()->id)}}">
        @if ($errors->any())
                <div class="alert alert-danger">
                    <ul style="margin:3px;">
                        @foreach ($errors->all() as $error)
                            <li style="margin: 5px;">{!! $error !!}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="field">
                <div class="radio">
                <textarea rows="4" placeholder="Write a message" min="5" name="text" style="flex-grow: 1;"></textarea>
                  <div class="button-wrapper">
                    @csrf
                    <button class="button">Send</button>
                  </div>
                </div>
              </div>
        </form>
        </div>
    </div>
</div>
@endsection

