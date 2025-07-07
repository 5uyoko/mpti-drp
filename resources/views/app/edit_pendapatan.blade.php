@extends('app.master')

@section('konten')

<div class="content-body">
    <div class="mb-3 d-flex justify-content-between align-items-center">
        <h4>Edit Data Pendapatan</h4>
        <a href="{{ route('data_pendapatan') }}" class="btn btn-secondary">Kembali</a>
    </div>

    <div class="container-fluid">
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @elseif(session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif

        <form action="{{ route('pendapatan.update', $income->income_id) }}" method="POST">
            @csrf
            @method('PUT')

            {{-- Hidden for reference --}}
            <input type="hidden" name="ship_id" value="{{ $ship->ship_id }}">
            <input type="hidden" name="load_id" value="{{ $load->load_id }}">

            <div class="form-group">
                <label>Nama Kapal</label>
                <input type="text" name="shipname" class="form-control" value="{{ $ship->shipname }}" required>
            </div>

            <div class="form-group">
                <label>Tanggal</label>
                <input type="date" name="date" class="form-control" value="{{ $income->date }}" required>
            </div>

            <div class="form-group">
                <label>Jenis Muatan</label>
                <input type="text" name="load_name" class="form-control" value="{{ $loadCategory->load_name }}" required>
                <input type="hidden" name="load_category_id" value="{{ $loadCategory->load_category_id }}">
            </div>

            <div class="form-group">
                <label>Jumlah Muatan (ton)</label>
                <input type="number" name="load_amount" class="form-control" value="{{ $load->load_amount }}" required>
            </div>

            <div class="form-group">
                <label>Harga per Ton (Rp)</label>
                <input type="number" name="rental_price" class="form-control" value="{{ $load->rental_price }}" required>
            </div>

            {{-- Pengeluaran --}}
            <div class="card mb-4">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <span>Pengeluaran</span>
                    <button type="button" class="btn btn-sm btn-outline-primary" onclick="addSpending()">+ Tambah Baris</button>
                </div>
                <div class="card-body" id="spending-list">
                    @foreach ($spendings as $s)
                        <div class="row spending-row mb-2">
                            <div class="col-md-6">
                                <input type="text" name="spending_name[]" class="form-control" placeholder="Nama Pengeluaran" value="{{ $s->spending_name }}" required>
                            </div>
                            <div class="col-md-4">
                                <input type="number" name="spending_amount[]" class="form-control spending-amount" placeholder="Jumlah (Rp)" value="{{ $s->spending_amount }}" required>
                            </div>
                            <div class="col-md-2">
                                <button type="button" class="btn btn-danger btn-block" onclick="removeSpending(this)">Hapus</button>
                            </div>
                        </div>
                    @endforeach
                </div>

                <div class="mt-3">
                    <label><strong>Total Pengeluaran (Rp)</strong></label>
                    <input type="text" id="total-spending" class="form-control-plaintext" readonly>
                </div>
            </div>


            <button type="submit" class="btn btn-success">Simpan Perubahan</button>
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
        total += parseInt(input.value) || 0;
    });
    document.getElementById('total-spending').value = 'Rp ' + total.toLocaleString('id-ID');
}

document.addEventListener('input', function (e) {
    if (e.target.classList.contains('spending-amount')) {
        updateTotal();
    }
});

document.addEventListener('DOMContentLoaded', updateTotal);
</script>

@endsection
