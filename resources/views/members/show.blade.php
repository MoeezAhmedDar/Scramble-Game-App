@extends('layout')
@section('content')
    <div class="container-fluid mt-4">
        <div class="row">
            <div class="col-lg-12">
                <div class="container mt-5 ">
                    <div class="row justify-content-center border rounded shadow p-3">
                        <div class="col-md-6">
                            <h1>{{ $member->name }}</h1>
                            <p>Number of Wins: {{ $member_detail['wins'] }}</p>
                            <p>Number of Losses: {{ $member_detail['losses'] }}</p>
                            <p>Average Score: {{ $member_detail['avg_score'] }}</p>
                            <p>Highest Score: {{ $member_detail['highest_score'] }}
                                ({{ $member_detail['highest_score_date'] }}) against
                                {{ $member_detail['highest_score_opponent'] }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
