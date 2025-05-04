@extends('layout.aplikasi')

@section('konten')
<style>
        .dashboard-custom h2 {
        font-weight: bold;
        color: yellowgreen;
    }

    .dashboard-custom .card {
        border-radius: 12px;
        box-shadow: 0 0 10px rgba(0, 128, 0, 0.1);
        background-color: #606060;
    }

    .dashboard-custom .card-header {
        font-weight: bold;
    }

    .dashboard-custom .btn-primary {
        background-color: yellowgreen;
        border-color: yellowgreen;
    }

    .dashboard-custom .btn-primary:hover {
        background-color: #6ba93e;
        border-color: #6ba93e;
    }

    .dashboard-custom .form-select,
    .dashboard-custom .form-label {
        font-size: 14px;
    }

    .dashboard-custom .badge {
        font-size: 0.85rem;
    }

    .dashboard-custom table th {
        background-color: yellowgreen;
        color: white;
    }

    .dashboard-custom .table-hover tbody tr:hover {
        background-color: #f2fff0;
    }

    .dashboard-custom .btn-outline-secondary,
    .dashboard-custom .btn-outline-danger {
        border-radius: 20px;
        padding: 4px 12px;
        font-size: 0.85rem;
    }

    .dashboard-custom canvas {
        background-color: #f9fff5;
        padding: 10px;
        border-radius: 8px;
    }
</style>
<div class="container py-4 dashboard-custom">
    <h2 class="mb-4">📊 Dashboard Admin</h2>

    <form method="GET" action="{{ route('admin.dashboard') }}" class="row g-2 mb-4">
        <div class="col-md-3">
            <label for="bulan" class="form-label">Bulan</label>
            <select name="bulan" id="bulan" class="form-select">
                <option value="">Semua</option>
                @foreach(range(1,12) as $b)
                    <option value="{{ $b }}" {{ request('bulan') == $b ? 'selected' : '' }}>
                        {{ DateTime::createFromFormat('!m', $b)->format('F') }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="col-md-3">
            <label for="tahun" class="form-label">Tahun</label>
            <select name="tahun" id="tahun" class="form-select">
                <option value="">Semua</option>
                @foreach($tahunTersedia as $t)
                    <option value="{{ $t }}" {{ request('tahun') == $t ? 'selected' : '' }}>{{ $t }}</option>
                @endforeach
            </select>
        </div>
        <div class="col-md-3 d-flex align-items-end">
            <button type="submit" class="btn btn-primary">🔍 Filter</button>
        </div>
    </form>
    
    {{-- Grafik Penjualan Bulanan --}}
    <div class="card mb-4">
        <div class="card-header">Grafik Penjualan Bulanan</div>
        <div class="card-body">
            <canvas id="salesChart" height="100"></canvas>
        </div>
    </div>

    <div class="row">
        {{-- Card: Stok Menipis --}}
        <div class="col-md-6 mb-4">
            <div class="card border-warning">
                <div class="card-header bg-warning text-dark">Produk Stok Menipis</div>
                <ul class="list-group list-group-flush">
                    @forelse ($stokMenipis as $produk)
                        <li class="list-group-item d-flex justify-content-between">
                            {{ $produk->nama }} <span class="badge bg-danger">{{ $produk->stok }} item</span>
                        </li>
                    @empty
                        <li class="list-group-item text-muted">Semua stok aman</li>
                    @endforelse
                </ul>
            </div>
        </div>

        {{-- Card: Produk Terlaris --}}
        <div class="col-md-6 mb-4">
            <div class="card border-success">
                <div class="card-header bg-success text-white">5 Produk Terlaris</div>
                <ul class="list-group list-group-flush">
                    @foreach ($produkTerlaris as $item)
                        <li class="list-group-item d-flex justify-content-between">
                            {{ $item->nama }} <span class="badge bg-success">{{ $item->total_terjual }} terjual</span>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>

    {{-- Card: Customer Paling Aktif --}}
    <div class="card mb-4 border-info">
        <div class="card-header bg-info text-white">Customer Paling Aktif</div>
        <ul class="list-group list-group-flush">
            @foreach ($customerAktif as $cust)
                <li class="list-group-item d-flex justify-content-between">
                    {{ $cust->name }} <span class="badge bg-primary">{{ $cust->total_pesanan }} pesanan</span>
                </li>
            @endforeach
        </ul>
    </div>

    {{-- Tabel Recap Penjualan --}}
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <span>Rekap Penjualan</span>
            <div>
                <a href="{{ route('admin.penjualan.print', request()->query()) }}" class="btn btn-outline-secondary btn-sm">🖨️ Print</a>
                <a href="{{ route('admin.penjualan.pdf', request()->query()) }}" class="btn btn-outline-danger btn-sm">📥 PDF</a>
            </div>
        </div>
        <div class="card-body table-responsive">
            <table class="table table-bordered table-hover table-sm">
                <thead>
                    <tr>
                        <th>Tanggal</th>
                        <th>Customer</th>
                        <th>Total</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($recapPenjualan as $r)
                        <tr>
                            <td>{{ $r->created_at->format('d-m-Y') }}</td>
                            <td>{{ $r->user->name }}</td>
                            <td>Rp{{ number_format($r->total_harga) }}</td>
                            <td><span class="badge bg-success">{{ ucfirst($r->status) }}</span></td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
{{-- @endsection --}}

{{-- @section('scripts') --}}
{{-- Chart.js CDN --}}
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const ctx = document.getElementById('salesChart').getContext('2d');
    const salesChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: {!! json_encode($penjualanBulanan->pluck('bulan')) !!},
            datasets: [{
                label: 'Total Penjualan',
                data: {!! json_encode($penjualanBulanan->pluck('total')) !!},
                backgroundColor: 'rgba(54, 162, 235, 0.6)',
                borderColor: 'rgba(54, 162, 235, 1)',
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            scales: {
                y: { beginAtZero: true }
            }
        }
    });
</script>
@endsection
