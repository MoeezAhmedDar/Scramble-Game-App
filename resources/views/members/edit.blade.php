@extends('layout')
@section('content')
    <div class="container-fluid mt-4">
        <div class="row">
            <div class="col-lg-12">
                <form action="{{ route('members.update', [$member->id]) }}" method="POST">
                    @csrf
                    @method('put')
                    <div class="container mt-5 bg-secondary w-50">
                        <div class="row justify-content-center border rounded shadow p-3">
                            <div class="col-md-6">
                                <form class="p-4 rounded shadow">
                                    <input type="hidden" name="member_id" value="{{ $member->id }}">
                                    <div class="form-group">
                                        <label for="name">Name</label>
                                        <input type="text" name="name" required
                                            value="{{ old('name', $member->name) }}" class="form-control">

                                    </div>
                                    <div class="form-group">
                                        <label for="email">Email address</label>
                                        <input type="email" required name="email"
                                            value="{{ old('email', $member->email) }}" class="form-control" id="email">
                                    </div>
                                    <div class="form-group">
                                        <label for="contact">Contact number</label>
                                        <input type="text" required name="contact_number"
                                            value="{{ old('contact_number', $member->contact_number) }}"
                                            class="form-control" id="number">
                                    </div>
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
