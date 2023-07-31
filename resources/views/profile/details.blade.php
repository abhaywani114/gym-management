@extends('profile.index')

@section('title', ucfirst(Auth::user()->type).' Profile > Details')

@section('profile_content')
<div class="profile-content-wrapper ">
    <div class="profile-section">
        <h1>Basic Infomation</h1>
        <table>
            <tbody>
                <tr>
                    <td class="field">Name</td>
                    <td class="data">{{$user->name}}</td>
                </tr>
                <tr>
                    <td class="field">Email</td>
                    <td class="data">{{$user->email}}</td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
@endsection
