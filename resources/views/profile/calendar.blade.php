@extends('profile.index')

@section('title', ucfirst(Auth::user()->type).' Profile - Calender')

@section('profile_content')
<div class="profile-content-wrapper ">
    <div class="profile-section">
    <form class="form" autocomplete="off" method="POST" action="{{route('user.login.handle')}}">
    <h1>Add Exercise</h1>
    @if ($errors->any())
            <div class="alert alert-danger">
                <ul style="margin:3px;">
                    @foreach ($errors->all() as $error)
                        <li style="margin: 5px;">{!! $error !!}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <div class="field radio">
            <div class="radio">
                <label>Exercise</label>
                <input type="text" placeholder="Biseps" name="email" required />
                <label>Day</label>
                <select id="days">
                    <option value="monday">Monday</option>
                    <option value="tuesday">Tuesday</option>
                    <option value="wednesday">Wednesday</option>
                    <option value="thursday">Thursday</option>
                    <option value="friday">Friday</option>
                    <option value="saturday">Saturday</option>
                    <option value="sunday">Sunday</option>
                </select>

                <div class="button-wrapper">
                    @csrf
                    <button class="button">Add</button>
                </div>
          </div>
        </div>
    </form>

    </div>
    <div class="profile-section">
        <h1>Day</h1>
        <table>
            <tbody>
                <tr>
                    <td class="field">1</td>
                    <td class="data">{{$user->name}}</td>
                    <td class="delete">Delete</td>
                </tr>
                <tr>
                    <td class="field">2</td>
                    <td class="data">{{$user->email}}</td>
                    <td class="delete">Delete</td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
@endsection
