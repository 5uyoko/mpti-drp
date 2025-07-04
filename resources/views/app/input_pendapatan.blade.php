@extends('app.master')

<style>
    .form-title {
        margin-left: 32px;
        font-weight: 600;
        font-size: 20px;
    }

    .btn-back {
        margin-right: 32px;
    }

    .form-section {
        margin-top: 16px;
    }

    .form-group label {
        font-weight: 500;
        margin-bottom: 6px;
    }

    .form-control {
        border-radius: 10px;
        border: 1px solid #cbd5e1;
        box-shadow: 0 1px 2px rgba(0, 0, 0, 0.05);
        font-size: 14px;
    }

    .btn-primary {
        background-color: #2563eb !important;
        border: none;
        padding: 8px 20px;
        border-radius: 8px;
        font-size: 15px;
        color: #fff !important;
        transition: background 0.2s;
    }

    .btn-primary:hover {
        background-color: #1e40af !important;
        color: #fff !important;
    }

    .btn-danger {
        background-color: #dc2626 !important;
        border: none;
        padding: 8px 16px;
        border-radius: 8px;
        font-size: 14px;
        color: #fff !important;
        transition: background 0.2s;
    }

    .btn-danger:hover {
        background-color: #991b1b !important;
        color: #fff !important;
    }

    .btn-secondary {
        background: #e5e7eb;
        border-radius: 8px;
        color: #111827;
        padding: 6px 16px;
        font-size: 14px;
    }

    .btn-secondary.btn-back {
        background: #2563eb;
        color: #fff;
        border: none;
        border-radius: 8px;
        padding: 6px 16px;
        font-size: 14px;
        transition: background 0.2s;
    }

    .btn-secondary.btn-back:hover {
        background: #1e40af;
        color: #fff;
    }

    .card-header {
        font-weight: 600;
        font-size: 16px;
    }

    .card-body input::placeholder {
        font-size: 13px;
        color: #888;
    }
</style>

@section('konten')
<div class="content-body">

    
    <div class="mb-3 d-flex justify-content-between align-items-center">
        <h4 class="form-title">Input Data Pendapatan</h4>
        <a href="{{ url()->previous() }}" class="btn btn-secondary btn-back">Kembali</a>
    </div>

    <div class="container-fluid form-section">
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @elseif(session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif

 
        <form action="{{ route('pendapatan.store') }}" method="POST">
            @csrf

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label>Nama Kapal</label>
                    <select name="ship_id" class="form-control" required>
                        <option value="">-- Pilih Kapal --</option>
                        @foreach ($ships as $ship)
                            <option value="{{ $ship->ship_id }}">{{ $ship->shipname }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-6 mb-3">
                    <label>Tanggal</label>
                    <input type="date" name="date" class="form-control" required>
                </div>

                <div class="col-md-6 mb-3">
                    <label>Jenis Muatan</label>
                    <select name="load_category_id" class="form-control" required>
                        <option value="">-- Pilih Muatan --</option>
                        @foreach ($load_categories as $category)
                            <option value="{{ $category->load_category_id }}">{{ $category->load_name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-6 mb-3">
                    <label>Jumlah Muatan (ton)</label>
                    <input type="number" name="load_amount" class="form-control" placeholder="Contoh: 10" required>
                </div>
                <div class="col-md-6 mb-3">
                <label>Rute</label>
                <div class="row g-2">
            <div class="col-6">
            <select name="city_from_id" class="form-control" required>
                <option value="">-- From --</option>
                @foreach ($cities as $city)
                    <option value="{{ $city->city_id }}">{{ $city->city_name }}</option>
                @endforeach
            </select>
            </div>
            <div class="col-6">
            <select name="city_to_id" class="form-control" required>
                <option value="">-- To --</option>
                @foreach ($cities as $city)
                    <option value="{{ $city->city_id }}">{{ $city->city_name }}</option>
                @endforeach
            </select>
            </div>
            </div>
            </div>
                <div class="col-md-6 mb-4">
                    <label>Harga per Ton (Rp)</label>
                    <input type="number" name="rental_price" class="form-control" placeholder="Contoh: 1000000" required>
                </div>
            </div>

            <div class="card mb-4">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <span>Pengeluaran</span>
                    <button type="button" class="btn btn-sm btn-outline-primary" onclick="addSpending()">+ Tambah Baris</button>
                </div>
                <div class="card-body">
                    <div id="spending-list">
                        <div class="row spending-row mb-2">
                            <div class="col-md-6">
                                <input type="text" name="spending_name[]" class="form-control" placeholder="Nama Pengeluaran" required>
                            </div>
                            <div class="col-md-4">
                                <input type="number" name="spending_amount[]" class="form-control spending-amount" placeholder="Jumlah (Rp)" required>
                            </div>
                            <div class="col-md-2">
                                <button type="button" class="btn btn-danger btn-block" onclick="removeSpending(this)">Hapus</button>
                            </div>
                        </div>
                    </div>

                    <div class="mt-3">
                        <label><strong>Total Pengeluaran (Rp)</strong></label>
                        <input type="text" id="total-spending" class="form-control-plaintext" readonly value="Rp 0">
                    </div>
                </div>
            </div>

            <button type="submit" class="btn btn-primary">Simpan</button>
        </form>
    </div>
</div>

<script>
function addSpending() {
    const row = `
        <div class="row spending-row mb-2">
            <div class="col-md-6">
                <input type="text" name="spending_name[]" class="form-control" placeholder="Nama Pengeluaran" required>
            </div>
            <div class="col-md-4">
                <input type="number" name="spending_amount[]" class="form-control spending-amount" placeholder="Jumlah (Rp)" required>
            </div>
            <div class="col-md-2">
                <button type="button" class="btn btn-danger btn-block" onclick="removeSpending(this)">Hapus</button>
            </div>
        </div>
    `;
    document.getElementById('spending-list').insertAdjacentHTML('beforeend', row);
    updateTotal();
}

function removeSpending(button) {
    const row = button.closest('.spending-row');
    row.remove();
    updateTotal();
}

function updateTotal() {
    let total = 0;
    document.querySelectorAll('.spending-amount').forEach(input => {
        const value = parseInt(input.value) || 0;
        total += value;
    });
    document.getElementById('total-spending').value = 'Rp ' + total.toLocaleString('id-ID');
}

document.addEventListener('input', function (e) {
    if (e.target.classList.contains('spending-amount')) {
        updateTotal();
    }
});
</script>
@endsection
