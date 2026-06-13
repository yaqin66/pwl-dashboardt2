<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Transaksi</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            font-size: 12px;
            color: #333;
            padding: 30px;
        }
        .header {
            text-align: center;
            margin-bottom: 30px;
            border-bottom: 3px solid #007bff;
            padding-bottom: 15px;
        }
        .header h1 {
            font-size: 22px;
            color: #007bff;
            margin-bottom: 5px;
        }
        .header p {
            font-size: 12px;
            color: #666;
        }
        .summary {
            display: flex;
            justify-content: space-between;
            margin-bottom: 20px;
        }
        .summary-box {
            display: inline-block;
            width: 30%;
            padding: 10px 15px;
            border-radius: 5px;
            text-align: center;
        }
        .summary-box.pemasukan {
            background-color: #d4edda;
            border: 1px solid #c3e6cb;
        }
        .summary-box.pengeluaran {
            background-color: #f8d7da;
            border: 1px solid #f5c6cb;
        }
        .summary-box.saldo {
            background-color: #d1ecf1;
            border: 1px solid #bee5eb;
        }
        .summary-box .label {
            font-size: 11px;
            color: #666;
            margin-bottom: 3px;
        }
        .summary-box .value {
            font-size: 16px;
            font-weight: bold;
        }
        .summary-box.pemasukan .value { color: #28a745; }
        .summary-box.pengeluaran .value { color: #dc3545; }
        .summary-box.saldo .value { color: #17a2b8; }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }
        table thead th {
            background-color: #007bff;
            color: #fff;
            padding: 8px 10px;
            text-align: left;
            font-size: 11px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        table tbody td {
            padding: 7px 10px;
            border-bottom: 1px solid #e9ecef;
            font-size: 11px;
        }
        table tbody tr:nth-child(even) {
            background-color: #f8f9fa;
        }
        .badge {
            display: inline-block;
            padding: 2px 8px;
            border-radius: 3px;
            font-size: 10px;
            font-weight: bold;
            color: #fff;
        }
        .badge-success { background-color: #28a745; }
        .badge-danger { background-color: #dc3545; }
        .badge-warning { background-color: #ffc107; color: #333; }
        .text-success { color: #28a745; }
        .text-danger { color: #dc3545; }
        .text-right { text-align: right; }
        .text-center { text-align: center; }
        .footer {
            margin-top: 30px;
            text-align: center;
            font-size: 10px;
            color: #999;
            border-top: 1px solid #e9ecef;
            padding-top: 10px;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>Laporan Transaksi</h1>
        <p>Dicetak pada: {{ \Carbon\Carbon::now()->translatedFormat('d F Y, H:i') }} WIB</p>
    </div>

    <div class="summary">
        <div class="summary-box pemasukan">
            <div class="label">Total Pemasukan</div>
            <div class="value">Rp {{ number_format($totalPemasukan, 0, ',', '.') }}</div>
        </div>
        <div class="summary-box pengeluaran">
            <div class="label">Total Pengeluaran</div>
            <div class="value">Rp {{ number_format($totalPengeluaran, 0, ',', '.') }}</div>
        </div>
        <div class="summary-box saldo">
            <div class="label">Saldo</div>
            <div class="value">Rp {{ number_format($totalPemasukan - $totalPengeluaran, 0, ',', '.') }}</div>
        </div>
    </div>

    <table>
        <thead>
            <tr>
                <th style="width: 30px;">#</th>
                <th>Tanggal</th>
                <th>Keterangan</th>
                <th class="text-center">Jenis</th>
                <th class="text-right">Nominal</th>
                <th class="text-center">Status</th>
            </tr>
        </thead>
        <tbody>
            @forelse($transactions as $index => $trx)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ \Carbon\Carbon::parse($trx->tanggal)->format('d M Y') }}</td>
                    <td>{{ $trx->keterangan }}</td>
                    <td class="text-center">
                        @if($trx->jenis === 'masuk')
                            <span class="badge badge-success">Masuk</span>
                        @else
                            <span class="badge badge-danger">Keluar</span>
                        @endif
                    </td>
                    <td class="text-right">
                        @if($trx->jenis === 'masuk')
                            <span class="text-success">+ Rp {{ number_format($trx->nominal, 0, ',', '.') }}</span>
                        @else
                            <span class="text-danger">- Rp {{ number_format($trx->nominal, 0, ',', '.') }}</span>
                        @endif
                    </td>
                    <td class="text-center">
                        @if($trx->status === 'berhasil')
                            <span class="badge badge-success">Berhasil</span>
                        @elseif($trx->status === 'pending')
                            <span class="badge badge-warning">Pending</span>
                        @else
                            <span class="badge badge-danger">Batal</span>
                        @endif
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="text-center">Belum ada data transaksi.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <div class="footer">
        <p>Dashboard PWL &mdash; Laporan ini digenerate secara otomatis oleh sistem.</p>
    </div>
</body>
</html>
