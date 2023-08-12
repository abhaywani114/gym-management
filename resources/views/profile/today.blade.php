@extends('profile.index')

@section('title', "Today - $day")

@section('profile_content')
<div class="profile-content-wrapper ">
    <div class="profile-section">
        <h1>Workout for {{ucfirst($day)}}</h1>
        <table>
            <tbody>
            @foreach($exercise as $d)
                <tr>
                    <td class="field">{{$loop->index + 1}}</td>
                    <td class="data">{{$d->exercise}}</td>
                    <td class="delete">
                        @if (!$d->done)
                            <a href="{{route('profile.exercise.handle.done', [$user->id, $d->id])}}">Done</a>
                        @endif
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
