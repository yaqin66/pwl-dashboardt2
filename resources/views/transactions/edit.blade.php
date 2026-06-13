@php
    use Illuminate\Support\Facades\Storage;
@endphp

@extends('layouts.app')

@section('title', 'Edit Transaksi')
@section('page-title', 'Edit Transaksi')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
    <li class="breadcrumb-item"><a href="{{ route('transactions.index') }}">Transaksi</a></li>
    <li class="breadcrumb-item active">Edit</li>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-8">
            <div class="card card-warning">
                <div class="card-header">
                    <h3 class="card-title">Form Edit Transaksi</h3>
                </div>
                <form action="{{ route('transactions.update', $transaction->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="card-body">
                        <div class="form-group">
                            <label for="tanggal">Tanggal <span class="text-danger">*</span></label>
                            <input type="date" class="form-control @error('tanggal') is-invalid @enderror" id="tanggal" name="tanggal" value="{{ old('tanggal', $transaction->tanggal) }}" required>
                            @error('tanggal')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="jenis">Jenis Transaksi <span class="text-danger">*</span></label>
                            <select class="form-control @error('jenis') is-invalid @enderror" id="jenis" name="jenis" required>
                                <option value="masuk" {{ old('jenis', $transaction->jenis) == 'masuk' ? 'selected' : '' }}>Pemasukan (Masuk)</option>
                                <option value="keluar" {{ old('jenis', $transaction->jenis) == 'keluar' ? 'selected' : '' }}>Pengeluaran (Keluar)</option>
                            </select>
                            @error('jenis')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="keterangan">Keterangan <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('keterangan') is-invalid @enderror" id="keterangan" name="keterangan" value="{{ old('keterangan', $transaction->keterangan) }}" placeholder="Masukkan keterangan / deskripsi transaksi" required>
                            @error('keterangan')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="nominal">Nominal (Rp) <span class="text-danger">*</span></label>
                            <input type="number" class="form-control @error('nominal') is-invalid @enderror" id="nominal" name="nominal" value="{{ old('nominal', $transaction->nominal) }}" min="0" required>
                            @error('nominal')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="status">Status <span class="text-danger">*</span></label>
                            <select class="form-control @error('status') is-invalid @enderror" id="status" name="status" required>
                                <option value="berhasil" {{ old('status', $transaction->status) == 'berhasil' ? 'selected' : '' }}>Berhasil</option>
                                <option value="pending" {{ old('status', $transaction->status) == 'pending' ? 'selected' : '' }}>Pending</option>
                                <option value="batal" {{ old('status', $transaction->status) == 'batal' ? 'selected' : '' }}>Batal</option>
                            </select>
                            @error('status')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="foto">Foto / Bukti Transaksi</label>
                            @if($transaction->foto && Storage::disk('public')->exists($transaction->foto))
                                <div class="mb-2">
                                    <img src="{{ Storage::url($transaction->foto) }}" alt="Foto Transaksi" style="max-height: 200px; border-radius: 5px;">
                                </div>
                            @endif
                            <div class="custom-file">
                                <input type="file" class="custom-file-input @error('foto') is-invalid @enderror" id="foto" name="foto" accept="image/*">
                                <label class="custom-file-label" for="foto">Pilih foto...</label>
                            </div>
                            @error('foto')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                            <small class="form-text text-muted">Format: JPEG, PNG, JPG, GIF | Ukuran maksimal: 2 MB (Kosongkan jika tidak ingin mengubah foto)</small>
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-warning">
                            <i class="fas fa-save mr-1"></i> Update
                        </button>
                        <a href="{{ route('transactions.index') }}" class="btn btn-secondary">
                            <i class="fas fa-arrow-left mr-1"></i> Kembali
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
<script>
    // Update file input label when file is selected
    document.getElementById('foto').addEventListener('change', function(e) {
        var fileName = e.target.files[0]?.name || 'Pilih foto...';
        document.querySelector('.custom-file-label').textContent = fileName;
    });
</script>
@endpush
