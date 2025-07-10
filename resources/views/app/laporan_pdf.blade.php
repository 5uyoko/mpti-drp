<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>Laporan Keuangan</title>
  <style>
    body { font-size: 11pt; }
    table { width: 100%; border-collapse: collapse; font-size: 11pt; }
    th, td { border: 1px solid #333; padding: 6px; text-align: left; }
    th { background: #eee; }
    .text-center { text-align: center; }
  </style>
</head>
<body>
  <center>
    <h4>LAPORAN KEUANGAN PT. RAMADHANI PERMAI SHIPPING</h4>
  </center>

  <table style="width: 60%; margin-bottom:20px">
    <tr>
      <td width="40%">Tahun</td>
      <td width="5%" class="text-center">:</td>
      <td>{{ $filters['year'] ?? '-' }}</td>
    </tr>
    <tr>
      <td>Bulan</td>
      <td class="text-center">:</td>
      <td>{{ $filters['month'] ?? '-' }}</td>
    </tr>
    <tr>
      <td>Nama Kapal</td>
      <td class="text-center">:</td>
      <td>{{ $filters['shipname'] ?? '-' }}</td>
    </tr>
    <tr>
      <td>Jenis Muatan</td>
      <td class="text-center">:</td>
      <td>{{ $filters['load_name'] ?? '-' }}</td>
    </tr>
  </table>

  <table>
    <thead>
      <tr>
        <th class="text-center">ID Laporan</th>
        <th class="text-center">Kapten</th>
        <th class="text-center">Kapal</th>
        <th class="text-center">Jenis Muatan</th>
        <th class="text-center">Tahun</th>
        <th class="text-center">Bulan</th>
        <th class="text-center">Total Pemasukan</th>
        <th class="text-center">Total Pengeluaran</th>
      </tr>
    </thead>
    <tbody>
      @forelse($laporan as $item)
      <tr>
        <td class="text-center">{{ $item->report_id }}</td>
        <td>{{ $item->name }}</td>
        <td>{{ $item->shipname }}</td>
        <td>{{ $item->load_name }}</td>
        <td class="text-center">{{ $item->year }}</td>
        <td class="text-center">{{ $item->month }}</td>
        <td class="text-center">Rp {{ number_format($item->total_income, 0, ',', '.') }}</td>
        <td class="text-center">Rp {{ number_format($item->total_spending, 0, ',', '.') }}</td>
      </tr>
      @empty
      <tr>
        <td colspan="8" class="text-center">Data tidak ditemukan.</td>
      </tr>
      @endforelse
    </tbody>
  </table>
</body>
</html>