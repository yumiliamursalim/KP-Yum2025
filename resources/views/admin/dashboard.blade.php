@extends('layout.aplikasi')

@section('konten')
<style>
    body {
        background-color: #121212;
        margin: 0;
        padding: 0;
        color: white
    }

    .dashboard-container {
        max-width: 1140px;
        margin: auto;
        padding: 2rem;
    }

    h2 {
        color: yellowgreen;
        font-weight: 600;
        margin-bottom: 2rem;
    }

    .filter-form {
        display: flex;
        flex-wrap: wrap;
        gap: 1rem;
        margin-bottom: 2rem;
    }

    .form-group {
        flex: 1;
        min-width: 200px;
    }

    label {
        font-weight: 500;
        margin-bottom: 0.5rem;
        display: block;
    }

    select,
    button {
        width: 100%;
        padding: 0.5rem;
        border: 1px solid #ccc;
        border-radius: 6px;
    }

    button[type="submit"] {
        background-color: yellowgreen;
        color: rgb(0, 0, 0);
        border: none;
        cursor: pointer;
    }

    .card {
        background: #fff;
        border: 1px solid #dee2e6;
        border-radius: 8px;
        margin-bottom: 1.5rem;
        box-shadow: 0 2px 4px rgba(0,0,0,0.05);
        color: black
    }

    .card-header {
        padding: 0.75rem 1.25rem;
        background-color: yellowgreen;
        color: white;
        font-weight: 600;
        border-bottom: 1px solid #ccc;
        border-radius: 8px 8px 0 0;
    }

    .card-body {
        padding: 1rem 1.25rem;
    }

    .list-group {
        list-style: none;
        padding: 0;
        margin: 0;
    }

    .list-group-item {
        padding: 0.75rem 1.25rem;
        border-top: 1px solid #e0e0e0;
        display: flex;
        justify-content: space-between;
    }

    .badge {
        padding: 0.3em 0.6em;
        border-radius: 12px;
        font-size: 0.85rem;
    }

    .bg-danger { background-color: #dc3545; color: white; }
    .bg-success { background-color: #28a745; color: white; }
    .bg-primary { background-color: #007bff; color: white; }
    .bg-info { background-color: #17a2b8; color: white; }

    .table {
        width: 100%;
        border-collapse: collapse;
    }

    .table th,
    .table td {
        border: 1px solid #dee2e6;
        padding: 0.75rem;
        text-align: left;
        font-size: 0.95rem;
    }

    .table th {
        background-color: #f0f0f0;
        font-weight: 600;
    }

    .table-hover tbody tr:hover {
        background-color: #f1f9f1;
    }

    .btn {
        padding: 0.4rem 0.8rem;
        border: 1px solid #ccc;
        border-radius: 5px;
        background-color: white;
        font-size: 0.875rem;
        cursor: pointer;
        transition: 0.2s;
    }

    .btn:hover {
        background-color: #e9fbe9;
    }

    .btn-outline-secondary {
        color: #6c757d;
        border-color: #6c757d;
    }

    .btn-outline-danger {
        color: #dc3545;
        border-color: #dc3545;
    }

    @media (max-width: 768px) {
        .filter-form {
            flex-direction: column;
        }
    }
</style>

<div class="dashboard-container">
    <h2>📊 Dashboard Admin</h2>

    <form action="{{ route('admin.dashboard') }}" method="GET" class="filter-form">
        <div class="form-group">
            <label for="bulan">Bulan</label>
            <select name="bulan" id="bulan">
                <option value="">-- Semua Bulan --</option>
                @for ($i = 1; $i <= 12; $i++)
                    <option value="{{ $i }}" {{ request('bulan') == $i ? 'selected' : '' }}>
                        {{ DateTime::createFromFormat('!m', $i)->format('F') }}
                    </option>
                @endfor
            </select>
        </div>
    
        <div class="form-group">
            <label for="tahun">Tahun</label>
            <select name="tahun" id="tahun">
                <option value="">-- Semua Tahun --</option>
                @foreach ($tahunTersedia as $tahun)
                    <option value="{{ $tahun }}" {{ request('tahun') == $tahun ? 'selected' : '' }}>
                        {{ $tahun }}
                    </option>
                @endforeach
            </select>
        </div>
    
        <div class="form-group" style="align-self: end;">
            <button type="submit">Filter</button>
        </div>
    </form>
    
    

    {{-- Grafik Penjualan Bulanan --}}
    <div class="card">
        <div class="card-header">Grafik Penjualan Bulanan</div>
        <div class="card-body">
            {{-- <canvas id="salesChart" height="100"></canvas> --}}
            <canvas id="penjualanChart"></canvas>

        </div>
    </div>

    <div class="row" style="display: flex; gap: 1.5rem; flex-wrap: wrap;">
        <div class="col-md-6" style="flex: 1; min-width: 280px;">
            <div class="card">
                <div class="card-header" style="background-color: orange;">Produk Stok Menipis</div>
                <ul class="list-group">
                    @forelse ($stokMenipis as $produk)
                        <li class="list-group-item">
                            {{ $produk->nama }} <span class="badge bg-danger">{{ $produk->stok }} item</span>
                        </li>
                    @empty
                        <li class="list-group-item text-muted">Semua stok aman</li>
                    @endforelse
                </ul>
            </div>
        </div>

        <div class="col-md-6" style="flex: 1; min-width: 280px;">
            <div class="card">
                <div class="card-header" style="background-color: seagreen;">5 Produk Terlaris</div>
                <ul class="list-group">
                    @foreach ($produkTerlaris as $item)
                        <li class="list-group-item">
                            {{ $item->nama }} <span class="badge bg-success">{{ $item->total_terjual }} terjual</span>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-header bg-info">Customer Paling Aktif</div>
        <ul class="list-group">
            @foreach ($customerAktif as $cust)
                <li class="list-group-item">
                    {{ $cust->name }} <span class="badge bg-primary">{{ $cust->total_pesanan }} pesanan</span>
                </li>
            @endforeach
        </ul>
    </div>

    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <span>Rekap Penjualan</span>
            <div>
                <a href="{{ route('admin.penjualan.print', request()->query()) }}" class="btn btn-outline-secondary">🖨️ Print</a>
                <a href="{{ route('admin.penjualan.pdf', request()->query()) }}" class="btn btn-outline-danger">📥 PDF</a>
            </div>
        </div>
        <div class="card-body table-responsive">
            <table class="table table-hover">
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
    const ctx = document.getElementById('penjualanChart').getContext('2d');
    const penjualanChart = new Chart(ctx, {
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
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
</script>

@endsection
