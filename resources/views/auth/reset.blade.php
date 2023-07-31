@extends('layout')

@section('content')

<main class="main-content-wrapper">
  <div class="regular-content">
        <form class="form" autocomplete="off" method="POST" action="{{route('user.reset')}}">
          <h1 class="title">Reset</h1>
          <div class="field">
            <label>Email</label>
            <input type="email" placeholder="example@example.com" name="email" required />
          </div>

          <div class="button-wrapper">
            @csrf
            <button class="button">Reset Password</button>
          </div>
        </form>
      </div>
      </div>
  </div>
</main>
@endsection
