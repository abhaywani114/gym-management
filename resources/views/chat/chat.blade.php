@extends('layout')
@section('title', "Chat")

@section('content')
<div class="chat-wrapper">
    <div class="contact-list">
        <div class="title">Contact List</div>
        <div class="data">
            @foreach($data as $u)
                <div class="search-result chat">
                    <div class="image">
                        <img src="{{!empty($u->dp) ? $u->dp:asset('assets/svgs/user.svg')}}"  />
                    </div>
                    <div class="text">
                        <a class="username" href="{{route('chat.chat', $u->id)}}">{{$u->name}}</a>
                        <p class="description muted" style="font-size: 13px;">Sogam Lolab</p>
                    </div>
                </div>
                @endforeach
        </div>
    </div>
    <div class="message-area">
        <div class="title">{{$selected_user->name ?? "Select a user"}}</div>
        <div class="data">
            @foreach($messages as $message)
                <div class="message-unit">
                   <a href="{{route('profile.profile', $message->fromUser->id)}}">{{$message->fromUser->name}}</a>
                    <p>{{$message->message}}</p>
                    <span class="muted">{{$message->created_at->diffForHumans()}}
                </div>
            @endforeach
        </div>
        <div class="sending-pad">
        <form class="form" autocomplete="off" method="POST" enctype="multipart/form-data" action="{{route('chat.send')}}">
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
                <textarea rows="4" placeholder="Write a message" min="5" style="flex-grow: 1;" name="message"></textarea>
                @if (!empty($selected_user))
                    <input type="hidden" name="selected_user" value="{{$selected_user->id}}" />
                @endif
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

