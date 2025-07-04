@extends('app.master')

@section('konten')
<div class="content-body">

  <div class="container-fluid">
    <div class="card mt-4">
      <div class="card-header">
        <h4>Input Laporan Keuangan</h4>
      </div>

      <div class="card-body">
        <form method="POST" action="{{ route('laporan.create') }}">
          @csrf

          <div class="form-group">
            <label for="income_id">Pilih Income</label>
            <select class="form-control" id="income_id" name="income_id" required>
              <option value="">-- Pilih Income --</option>
              @foreach($incomes as $income)
                <option value="{{ $income->income_id }}">
                  {{ $income->income_id }} - {{ $income->date }}
                </option>
              @endforeach
            </select>
          </div>
          <div id="fetchError" class="alert alert-danger" style="display: none;"></div>
          <div id="autoFields" style="display: none;">
            <div class="form-group">
              <label>Tanggal</label>
              <input type="text" class="form-control" id="date" readonly>
            </div>

            <div class="form-group">
              <label>Kota Asal</label>
              <input type="text" class="form-control" id="city_from" readonly>
            </div>

            <div class="form-group">
              <label>Kota Tujuan</label>
              <input type="text" class="form-control" id="city_to" readonly>
            </div>

            <div class="form-group">
              <label>Daftar Pengeluaran</label>
              <ul class="list-group" id="spending_list"></ul>
            </div>

            <div class="form-group">
              <label>Total Pengeluaran</label>
              <input type="text" class="form-control" id="total_spending" readonly>
            </div>

            <div class="form-group">
              <label>Total Pemasukan</label>
              <input type="text" class="form-control" id="total_income" readonly>
            </div>
          </div>

          <button type="submit" class="btn btn-success mt-3">Simpan Laporan</button>
        </form>
      </div>
    </div>
  </div>
</div>

<script>
document.getElementById('income_id').addEventListener('change', function () {
  const incomeId = this.value;
  const autoFields = document.getElementById('autoFields');
  const fetchError = document.getElementById('fetchError');

  // Reset tampilan
  autoFields.style.display = 'none';
  fetchError.style.display = 'none';
  fetchError.innerText = '';

  if (!incomeId) return;

  fetch(`/laporan/income/${incomeId}`)
    .then(response => {
      if (!response.ok) {
        throw new Error('Gagal mengambil data. Mungkin data income tidak ditemukan.');
      }
      return response.json();
    })
    .then(data => {
      autoFields.style.display = 'block';
      document.getElementById('date').value = data.date;
      document.getElementById('city_from').value = data.city_from;
      document.getElementById('city_to').value = data.city_to;
      document.getElementById('total_spending').value = data.total_spending;
      document.getElementById('total_income').value = data.total_income;

      const spendingList = document.getElementById('spending_list');
      spendingList.innerHTML = '';
      data.spendings.forEach(s => {
        spendingList.innerHTML += `<li class="list-group-item">${s.spending_name} - Rp ${Number(s.spending_amount).toLocaleString()}</li>`;
      });
    })
    .catch(error => {
      autoFields.style.display = 'none';
      fetchError.innerText = error.message;
      fetchError.style.display = 'block';
    });
});
</script>

@endsection
