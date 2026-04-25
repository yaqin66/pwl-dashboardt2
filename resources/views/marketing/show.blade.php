@extends('layouts.app')

@section('title', 'Detail User Marketing')
@section('page-title', 'Detail User Marketing')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
    <li class="breadcrumb-item"><a href="{{ route('marketing.index') }}">User Marketing</a></li>
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
                    <h3 class="profile-username text-center">{{ $marketing->nama }}</h3>
                    <p class="text-muted text-center">{{ $marketing->posisi }}</p>

                    <ul class="list-group list-group-unbordered mb-3">
                        <li class="list-group-item">
                            <b>Email</b> <a class="float-right">{{ $marketing->email }}</a>
                        </li>
                        <li class="list-group-item">
                            <b>Phone</b> <a class="float-right">{{ $marketing->phone ?? '-' }}</a>
                        </li>
                        <li class="list-group-item">
                            <b>Area</b> <a class="float-right">{{ $marketing->area ?? '-' }}</a>
                        </li>
                        <li class="list-group-item">
                            <b>Status</b>
                            <span class="float-right">
                                @if($marketing->status === 'aktif')
                                    <span class="badge badge-success">Aktif</span>
                                @else
                                    <span class="badge badge-danger">Nonaktif</span>
                                @endif
                            </span>
                        </li>
                        <li class="list-group-item">
                            <b>Dibuat</b> <a class="float-right">{{ $marketing->created_at->format('d M Y H:i') }}</a>
                        </li>
                        <li class="list-group-item">
                            <b>Diperbarui</b> <a class="float-right">{{ $marketing->updated_at->format('d M Y H:i') }}</a>
                        </li>
                    </ul>

                    <a href="{{ route('marketing.edit', $marketing->id) }}" class="btn btn-warning btn-block">
                        <i class="fas fa-edit mr-1"></i> Edit
                    </a>
                    <a href="{{ route('marketing.index') }}" class="btn btn-secondary btn-block">
                        <i class="fas fa-arrow-left mr-1"></i> Kembali
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection
