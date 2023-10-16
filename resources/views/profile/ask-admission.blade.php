@extends('layout')
@section('title', 'Ask Admission')

@section('content')

<main class="main-content-wrapper">
    <div class="regular-content">
        <div class="d-flex login-wrapper">
        <form class="form" autocomplete="off" method="POST" enctype="multipart/form-data" action="{{route('profile.ask-admission.handle', Auth::user()->id)}}">
        <h1>Ask Admission</h1>
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
        <table>
            <tbody>
                <tr>
                    <td class="field"></td>
                    <td class="data"></td>
                </tr>
            </tbody>
        </table>
        @endif
        </div>
    </div>
</main>
@endsection
