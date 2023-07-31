@extends('layout')
@section('title', 'Login')

@section('content')

<div class="regular-content">
    <div class="d-flex login-wrapper">
    <form class="form" autocomplete="off" method="POST" action="{{route('user.login.handle')}}">
    <h1>Login</h1>
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
        <label>Email</label>
        <input type="email" placeholder="example@example.com" name="email" required />
      </div>

     <div class="field">
        <label>Password</label>
        <input type="password" placeholder="Your secret password" name="password" required />
      </div>
      <div class="button-wrapper">
        @csrf
        <button class="button">Submit</button>
        <a href="{{route('user.reset')}}" class="button">Forget Password</a>
        <a href="{{ route('google.login') }}" class="button google">Login Using Google</a>
      </div>
    </form>
    </div>
</div>
@endsection
