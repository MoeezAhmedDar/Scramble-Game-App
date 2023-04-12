@extends('layout')
@section('content')
    <div class="container-fluid mt-4">
        <div class="row">
            <div class="col-lg-8 m-auto border rounded shadow p-3">
                <a href="{{ route('members.create') }}" class="btn btn-success mb-2 float-right">Add Member</a>
                <table class="table mx-auto">
                    <thead class="thead-dark">
                        <tr>
                            <th>Rank</th>
                            <th>Name</th>
                            <th>Average Score</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($topMembers as $key => $member)
                            <tr>
                                <td>{{ $key + 1 }}</td>
                                <td>{{ $member->name }}</td>
                                <td>{{ number_format($member->total_score / $member->games_played, 2) }}</td>
                                <td> <a href="{{ route('members.edit', $member->id) }}" class="btn btn-primary">Edit
                                        Member</a>
                                    <a href="{{ route('members.show', $member->id) }}" class="btn btn-primary">Show
                                        Profile</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
