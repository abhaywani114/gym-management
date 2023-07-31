@extends('layout')

@section('content')

<main class="main-content-wrapper">
  <div class="regular-content">
      <div class="d-flex login-wrapper">
        <form class="form" autocomplete="off" method="POST" action="{{route('user.signup.handle')}}">
          <h1 class="title">Signup</h1>
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
            <label>First Name</label>
            <input type="text" placeholder="Enter your firstname" name="first_name" required />
          </div>

          <div class="field">
            <label>Last Name</label>
            <input type="text" placeholder="Enter your lastname" name="last_name" required />
          </div>

          <div class="field">
            <label>Email</label>
            <input type="email" placeholder="example@example.com" name="email" required />
          </div>

         <div class="field">
            <label>Password</label>
            <input type="password" placeholder="Your secret password" name="password" autocomplete="off" required />
          </div>

         <div class="field">
            <label>Confirm Password</label>
            <input type="password" placeholder="Your secret password" name="password_confirmation" autocomplete="off" required />
          </div>
          <div class="button-wrapper">
            @csrf
            <button class="button">Submit</button>
            <a href="{{ route('google.login') }}" class="button google">Signup Using Google</a>
          </div>
        </form>
      </div>
  </div>
</main>
@endsection
