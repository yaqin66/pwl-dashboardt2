@extends('layouts.app')

@section('title', 'Detail User')
@section('page-title', 'Detail User')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
    <li class="breadcrumb-item"><a href="{{ route('users.index') }}">User</a></li>
    <li class="breadcrumb-item active">Detail</li>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-4">
            <div class="card card-primary card-outline">
                <div class="card-body box-profile">
                    <div class="text-center">
                        <img class="profile-user-img img-fluid img-circle" src="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/img/user2-160x160.jpg" alt="User profile picture">
                    </div>
                    <h3 class="profile-username text-center">{{ $user->name }}</h3>
                    <p class="text-muted text-center">{{ $user->email }}</p>
                    <ul class="list-group list-group-unbordered mb-3">
                        <li class="list-group-item">
                            <b>ID</b> <a class="float-right">{{ $user->id }}</a>
                        </li>
                        <li class="list-group-item">
                            <b>Dibuat</b> <a class="float-right">{{ $user->created_at->format('d M Y H:i') }}</a>
                        </li>
                        <li class="list-group-item">
                            <b>Diperbarui</b> <a class="float-right">{{ $user->updated_at->format('d M Y H:i') }}</a>
                        </li>
                    </ul>
                    <a href="{{ route('users.edit', $user->id) }}" class="btn btn-warning btn-block"><i class="fas fa-edit mr-1"></i> Edit</a>
                    <a href="{{ route('users.index') }}" class="btn btn-secondary btn-block"><i class="fas fa-arrow-left mr-1"></i> Kembali</a>
                </div>
            </div>
        </div>
    </div>
@endsection
