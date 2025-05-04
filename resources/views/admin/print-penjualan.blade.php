<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Rekap Penjualan</title>
    <style>
        body { font-family: sans-serif; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        table, th, td { border: 1px solid #aaa; padding: 8px; text-align: left; }
        h2 { text-align: center; margin-bottom: 10px; }
        .header-info {
            display: flex;
            justify-content: space-between;
            font-size: 14px;
            margin-bottom: 10px;
        }
        .total-row td {
            font-weight: bold;
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>

    <div class="header-info">
        <div>Tanggal Cetak: {{ \Carbon\Carbon::now()->format('d-m-Y') }}</div>
        <div>Bulan: {{ \Carbon\Carbon::now()->translatedFormat('F Y') }}</div>
    </div>

    <h2>Rekap Penjualan</h2>

    <table>
        <thead>
            <tr>
                <th>Tanggal</th>
                <th>Customer</th>
                <th>Total</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @php $totalKeseluruhan = 0; @endphp
            @foreach ($recapPenjualan as $r)
                <tr>
                    <td>{{ $r->created_at->format('d-m-Y') }}</td>
                    <td>{{ $r->user->name }}</td>
                    <td>Rp{{ number_format($r->total_harga) }}</td>
                    <td>{{ ucfirst($r->status) }}</td>
                </tr>
                @php $totalKeseluruhan += $r->total_harga; @endphp
            @endforeach
            <tr class="total-row">
                <td colspan="2">Total Keseluruhan</td>
                <td colspan="2">Rp{{ number_format($totalKeseluruhan) }}</td>
            </tr>
        </tbody>
    </table>
    
</body>
</html>
