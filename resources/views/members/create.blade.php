@extends('layout')
@section('content')
    <div class="container-fluid mt-4">
        <div class="row">
            <div class="col-lg-12">
                <form action="{{ route('members.store') }}" method="POST">
                    @csrf
                    <div class="container mt-5 bg-secondary w-50">
                        <div class="row justify-content-center border rounded shadow p-3">
                            <div class="col-md-6">
                                <form class="p-4 rounded shadow">
                                    <div class="form-group">
                                        <label for="name">Name</label>
                                        <input type="text" name="name" value="{{ old('name') }}"
                                            class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label for="email">Email address</label>
                                        <input type="email" name="email" value="{{ old('email') }}"
                                            class="form-control" id="email">
                                    </div>
                                    <div class="form-group">
                                        <label for="contact">Contact number</label>
                                        <input type="text" name="contact_number" value="{{ old('contact_number') }}"
                                            class="form-control" id="number">
                                    </div>
                                    <div class="form-group">
                                        <label for="contact">Date of Joining</label>
                                        <input type="date" name="date_joined" value="{{ old('date_joined') }}"
                                            class="form-control" id="date_joined">
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
