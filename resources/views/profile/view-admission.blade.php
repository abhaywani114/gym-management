@extends('layout')
@section('title', 'Ask Admission')

@section('content')

<main class="main-content-wrapper">
    <div class="regular-content">
        <div class="d-flex login-wrapper ">
        <div class="form">
            <h2>View Admissions</small></h2>
        </div>
        @if(!$data->isEmpty())
        <table class="tbl">
            <thead>
                <tr style="border-bottom: 1px solid #ccc;">
                    <td style="padding: 5px 12px;border-bottom: 1px solid #eee;">Name</td>
                    <td style="padding: 5px 12px;border-bottom: 1px solid #eee;">Message</td>
                    <td style="padding: 5px 12px;border-bottom: 1px solid #eee;">Status</td>
                    <td style="padding: 5px 12px;border-bottom: 1px solid #eee;">Action</td>
                </tr>
            </thead>
            <tbody>
                @foreach($data as $d)
                <tr>
                    <td class="field"><a style="unset: all; color: #06607f; cursor:pointer;" href="{{route('profile.profile', $d->user->id)}}">{{$d->user->first_name}} {{$d->user->last_name}}</a></td>
                    <td class="field">{{$d->message}}</td>
                    <td class="field">{{ucfirst($d->status)}}</td>
                    <td class="data" >
                        <div style="display: flex; gap:4px; flex-wrap: wrap;">
                            <a href="{{route('action-admissions', ['id' => $d->id, 'verb' => 'enrolled'])}}" class="mybutton">Approve</a>
                            <a href="{{route('action-admissions', ['id' => $d->id, 'verb' => 'cancelled'])}}" class="mybutton">Cancel</a>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        @endif
        </div>
    </div>
</main>
@endsection
