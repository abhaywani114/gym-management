@extends('layout')
@section('title', 'Ask Admission')

@section('content')

<main class="main-content-wrapper">
    <div class="regular-content">
        <div class="d-flex login-wrapper">
        <form class="form" autocomplete="off" method="POST" enctype="multipart/form-data" action="{{route('profile.ask-admission.handle', $gym->id)}}">
        <h2>{{$gym->first_name}} {{$gym->last_name}}:<small>Ask Admission</small></h2>
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
                <label>Message</label>
                <textarea rows="4" placeholder="Write something about your goal and your timming " min="5" name="message" required></textarea>
              </div>
          <div class="button-wrapper">
            @csrf
            <button class="button">Ask</button>
          </div>
        </form>
        @if(!$data->isEmpty())
        <table class="tbl">
            <tbody>
                @foreach($data as $d)
                <tr>
                    <td class="field">{{$d->gym->first_name}} {{$d->gym->last_name}}</td>
                    <td class="data">{{ucfirst($d->status)}}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
        @endif
        </div>
    </div>
</main>
@endsection
