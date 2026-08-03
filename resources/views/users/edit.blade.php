@extends('layouts.app')

@section('title', 'Edit User')

@section('content')

<style>
    h4 {
        color: #4a3728;
        font-weight: 700;
    }

    label {
        color: #4a3728;
        font-weight: 600;
        font-size: 0.9rem;
    }

    .form-control,
    .form-select {
        border: 1px solid #e6dccb;
        border-radius: 8px;
        background-color: #fffdf9;
    }

    .form-control:focus,
    .form-select:focus {
        border-color: #a67c52;
        box-shadow: 0 0 0 0.2rem rgba(166, 124, 82, 0.2);
    }

    .btn-success {
        background-color: #a67c52;
        border-color: #a67c52;
    }
    .btn-success:hover {
        background-color: #8f6a45;
        border-color: #8f6a45;
    }

    .btn-secondary {
        background-color: #d8cdbb;
        border-color: #d8cdbb;
        color: #4a3728;
    }
    .btn-secondary:hover {
        background-color: #c9bca5;
        border-color: #c9bca5;
        color: #4a3728;
    }
</style>

<h4>Edit User</h4>

<form action="{{ route('admin.users.update', $user) }}" method="POST">
    @csrf
    @include('users._from')
</form>
@endsection