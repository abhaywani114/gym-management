@extends('layout')
@section('title', 'Profile Settings')

@section('content')

<main class="main-content-wrapper">
    <div class="regular-content">
        <div class="d-flex login-wrapper">
        <form class="form" autocomplete="off" method="POST" enctype="multipart/form-data" action="{{route('profile.settings.handle', Auth::user()->id)}}">
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
                <label>Bio</label>
                <textarea rows="4" placeholder="Write something about you" min="5" name="bio"></textarea>
              </div>

            <div class="field">
                <label>Profile Picture</label>
                <input type="file" min="4" name="dp"  />
              </div>
              <div class="field">
                <label>Profile Type</label>
                <select name="type">
                  <option value="user">User</option>
                  <option value="gym">Gym</option>
                </select>
              </div>
            <div class="field">
                <label>Old Password</label>
                <input type="password" placeholder="Enter your old password" name="oldpassword" min="4" />
              </div>

              <div class="field">
                <label>New Password</label>
                <input type="password" placeholder="Enter your new password" name="password" min="4" />
              </div>

              <div class="field">
                <label>Confirm New Password</label>
                <input type="password" placeholder="Enter your new password again" name="password_confirmation" min="4" />
              </div>
              <br/>

          <div class="button-wrapper">
            @csrf
            <button class="button">Update</button>
          </div>
        </form>
        </div>
    </div>
</main>
@endsection
