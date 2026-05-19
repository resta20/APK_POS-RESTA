@extends('layouts.app')

@section('title', 'login')

@section('content')

<div class="card text-center position-absolute top-50 start-50 translate-middle" style="width: 18rem;">
    <h5 class="card-header">Login POS</h5>
    <div class="card-body">
        <form action="{{ route('auth') }}" method="POST">
            @csrf


        <div class="mb-3">
            <label class="form-label">Email address</label>
            <input type="email" name="email" class="form-control">

            @error('email')
                <div class="badge text-bg-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label class="form-label">Password</label>
            <input type="password" name="password" class="form-control">

            @error('password')
                <div class="badge text-bg-danger">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>


</div>

@endsection
