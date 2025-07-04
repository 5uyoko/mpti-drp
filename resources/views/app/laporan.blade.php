@extends('app.master')

@section('konten')
<div class="content-body">

  <div class="row page-titles mx-0 mt-2">
    <h3 class="col p-md-0">Laporan Keuangan</h3>

    <div class="col p-md-0">
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
        <li class="breadcrumb-item active"><a href="#">Laporan</a></li>
      </ol>
    </div>
  </div>

  <div class="container-fluid">
    <div class="card">
      <a href="{{ route('input_laporan') }}" class="btn btn-add">+ Tambah Data</a>
      <div class="card-header pt-4">
        <h4 class="card-title">Filter Laporan</h4>
      </div>

      <div class="card-body">
        <form method="GET" action="{{ route('laporan') }}">
          <div class="row mb-4">
            <div class="col-md-3">
              <label>Tahun</label>
              <input type="number" name="year" class="form-control" value="{{ $filters['year'] ?? '' }}">
            </div>
            <div class="col-md-3">
              <label>Bulan</label>
              <input type="number" name="month" class="form-control" value="{{ $filters['month'] ?? '' }}" min="1" max="12">
            </div>
            <div class="col-md-3">
              <label>Nama Kapal</label>
              <input type="text" name="shipname" class="form-control" value="{{ $filters['shipname'] ?? '' }}">
            </div>
            <div class="col-md-3">
              <label>Jenis Muatan</label>
              <input type="text" name="load_name" class="form-control" value="{{ $filters['load_name'] ?? '' }}">
            </div>
          </div>
          <button type="submit" class="btn btn-primary">Terapkan Filter</button>
          <a href="{{ route('laporan') }}" class="btn btn-secondary">Reset</a>
        </form>
      </div>

      <div class="card-body">
        <div class="table-responsive mt-4">
          <table class="table table-bordered table-striped">
            <thead class="thead-dark">
              <tr>
                <th>ID Laporan</th>
                <th>Kapten</th>
                <th>Kapal</th>
                <th>Jenis Muatan</th>
                <th>Tahun</th>
                <th>Bulan</th>
                <th>Total Pemasukan</th>
                <th>Total Pengeluaran</th>
                <th>Action</th>

              </tr>
            </thead>
            <tbody>
              @forelse($laporan as $item)
                <tr>
                  <td>{{ $item->report_id }}</td>
                  <td>{{ $item->name }}</td>
                  <td>{{ $item->shipname }}</td>
                  <td>{{ $item->load_name }}</td>
                  <td>{{ $item->year }}</td>
                  <td>{{ $item->month }}</td>
                  <td>Rp {{ number_format($item->total_income, 0, ',', '.') }}</td>
                  <td>Rp {{ number_format($item->total_spending, 0, ',', '.') }}</td>
                  <td class="text-center">
                    <a href="{{ route('laporan.update', $item->report_id) }}" class="btn btn-sm btn-warning" title="Edit">
                      <i class="fa fa-edit"></i>
                    </a>
                    <form action="{{ route('laporan.destroy', $item->report_id) }}" method="POST" style="display: inline;">
                      @csrf
                      @method('DELETE')
                      <button type="submit" class="btn btn-sm btn-danger" title="Hapus" onclick="return confirm('Yakin ingin menghapus laporan ini?')">
                        <i class="fa fa-trash"></i>
                      </button>
                    </form>
                  </td>
                </tr>
              @empty
                <tr>
                  <td colspan="8" class="text-center">Data tidak ditemukan.</td>
                </tr>
              @endforelse
            </tbody>
          </table>
        </div>
      </div>

    </div>
  </div>
</div>
@endsection
