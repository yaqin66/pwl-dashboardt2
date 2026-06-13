@php
    use Illuminate\Support\Facades\Storage;
@endphp

@extends('layouts.app')

@section('title', 'Daftar Transaksi')
@section('page-title', 'Transaksi')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
    <li class="breadcrumb-item active">Transaksi</li>
@endsection

@push('styles')
<!-- DataTables -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.5.0/css/responsive.bootstrap4.min.css">
@endpush

@section('content')
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="fas fa-check-circle mr-1"></i>
            {{ session('success') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    <div class="card">
        <div class="card-header">
            <h3 class="card-title">
                <i class="fas fa-money-bill-wave mr-1"></i>
                Daftar Transaksi
            </h3>
            <div class="card-tools">
                <a href="{{ route('transactions.export-pdf') }}" class="btn btn-danger btn-sm mr-1" target="_blank">
                    <i class="fas fa-file-pdf mr-1"></i> Export PDF
                </a>
                <a href="{{ route('transactions.create') }}" class="btn btn-primary btn-sm">
                    <i class="fas fa-plus mr-1"></i> Tambah Transaksi
                </a>
            </div>
        </div>
        <div class="card-body">
            <table id="transactions-table" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th style="width: 10px">#</th>
                        <th>Tanggal</th>
                        <th>Keterangan</th>
                        <th>Jenis</th>
                        <th>Nominal</th>
                        <th>Status</th>
                        <th style="width: 80px">Foto</th>
                        <th style="width: 150px">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($transactions as $index => $trx)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ \Carbon\Carbon::parse($trx->tanggal)->format('d M Y') }}</td>
                            <td>{{ $trx->keterangan }}</td>
                            <td>
                                @if($trx->jenis === 'masuk')
                                    <span class="badge badge-success"><i class="fas fa-arrow-down mr-1"></i> Pemasukan</span>
                                @else
                                    <span class="badge badge-danger"><i class="fas fa-arrow-up mr-1"></i> Pengeluaran</span>
                                @endif
                            </td>
                            <td>Rp {{ number_format($trx->nominal, 0, ',', '.') }}</td>
                            <td>
                                @if($trx->status === 'berhasil')
                                    <span class="badge badge-success">Berhasil</span>
                                @elseif($trx->status === 'pending')
                                    <span class="badge badge-warning">Pending</span>
                                @else
                                    <span class="badge badge-danger">Batal</span>
                                @endif
                            </td>
                            <td style="text-align: center;">
                                @if($trx->foto && Storage::disk('public')->exists($trx->foto))
                                    <a href="{{ Storage::url($trx->foto) }}" target="_blank" title="Lihat Foto">
                                        <i class="fas fa-image text-success"></i>
                                    </a>
                                @else
                                    <span class="text-muted">-</span>
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('transactions.edit', $trx->id) }}" class="btn btn-warning btn-xs" title="Edit">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('transactions.destroy', $trx->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('Yakin ingin menghapus transaksi ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-xs" title="Hapus">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center">Belum ada data transaksi.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection

@push('scripts')
<!-- DataTables -->
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap4.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.5.0/js/dataTables.responsive.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.5.0/js/responsive.bootstrap4.min.js"></script>
<script>
$(function () {
    $('#transactions-table').DataTable({
        "responsive": true,
        "lengthChange": true,
        "autoWidth": false,
        "language": {
            "search": "Cari:",
            "lengthMenu": "Tampilkan _MENU_ data",
            "info": "Menampilkan _START_ - _END_ dari _TOTAL_ data",
            "infoEmpty": "Tidak ada data",
            "zeroRecords": "Data tidak ditemukan",
            "paginate": {
                "first": "Pertama",
                "last": "Terakhir",
                "next": "Berikutnya",
                "previous": "Sebelumnya"
            }
        }
    });
});
</script>
@endpush
