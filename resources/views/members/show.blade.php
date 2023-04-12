@extends('layout')
@section('content')
    <div class="container-fluid mt-4">
        <div class="row">
            <div class="col-lg-12">
                <div class="container mt-5 ">
                    <div class="row justify-content-center border rounded shadow p-3">
                        <div class="col-md-6">
                            <h1>{{ $member->name }}</h1>
                            <p>Number of Wins: {{ $wins }}</p>
                            <p>Number of Losses: {{ $losses }}</p>
                            <p>Average Score: {{ $avg_score }}</p>
                            <p>Highest Score: {{ $highest_score }} ({{ $highest_score_date }}) against
                                {{ $highest_score_opponent }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
