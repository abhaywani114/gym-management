@extends('profile.index')

@section('title', ucfirst(Auth::user()->type).' Profile - Track')

@section('profile_content')
<div class="profile-content-wrapper ">
    <div class="profile-section">
    <form class="form" autocomplete="off" method="POST" action="{{route('profile.exercise.handle.add', $user->id)}}">
    <h1>Track</h1>
    </form>
    <canvas id="exercise-line-chart"></canvas>

    </div>

</div>
@endsection
@section('js')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        var exerciseData = @json($exerciseData);

        var labels = exerciseData.map(function(entry) {
            return entry.exercise;
        });

        var data = exerciseData.map(function(entry) {
            return entry.count;
        });

        var ctx = document.getElementById('exercise-line-chart').getContext('2d');
        var myChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: labels,
                datasets: [{
                    label: 'Exercise Done',
                    data: data,
                    borderColor: 'blue',
                    fill: false,
                }]
            },
            options: {
                // Chart options
            }
        });
    });
</script>
@endsection
