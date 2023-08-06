@extends('profile.index')

@section('title', ucfirst(Auth::user()->type).' Profile - Calender')

@section('profile_content')
<div class="profile-content-wrapper ">
    <div class="profile-section">
    <form class="form" autocomplete="off" method="POST" action="{{route('profile.exercise.handle.add', $user->id)}}">
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
                <input type="text" placeholder="Biseps" name="exercise" required />
                <label>Day</label>
                <select id="days" name="day">
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
    @foreach($data as $key => $day)
    <div class="profile-section">
        <h1>{{ucfirst($key)}}</h1>
        <table>
            <tbody>
            @foreach($day as $d)
                <tr>
                    <td class="field">{{$loop->index + 1}}</td>
                    <td class="data">{{$d->exercise}}</td>
                    <td class="delete"><a href="{{route('profile.exercise.handle.delete', [$user->id, $d->id])}}">Delete</a></td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
    @endforeach
</div>
@endsection
