@extends('layout')
@section('title', 'Profile Settings')

@section('content')

<div class="regular-content">
    <div class="d-flex login-wrapper">
    <form class="form" autocomplete="off" method="POST" action="{{route('user.login.handle')}}">
    <h1>Profile Settings</h1>
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
            <label>Old Password</label>
            <input type="password" placeholder="Enter your old password" name="oldpassword" min="4" required />
          </div>

          <div class="field">
            <label>New Password</label>
            <input type="password" placeholder="Enter your new password" name="password" min="4" required />
          </div>

          <div class="field">
            <label>Confirm New Password</label>
            <input type="password" placeholder="Enter your new password again" name="password_confirmation" min="4" required />
          </div>
          <br/>

      <div class="button-wrapper">
        @csrf
        <button class="button">Update</button>
      </div>
    </form>
    </div>
</div>
@endsection
