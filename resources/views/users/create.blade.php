@extends('layouts.app')

@section('title', 'Tambah User')

@section('content')
<h4>Tambah User</h4>

<from action="{{ route('admin.users.store') }}" method="POST">
    @include('users._from')
</from>
@endsection