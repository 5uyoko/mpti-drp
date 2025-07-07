@extends('app.master')

@section('konten')

<div class="content-body b">
 
  <div class="container-fluid mt-3">
    <div class="row mb-4">
      <div class="col-lg-4 col-sm-12">
        <div class="card bg-white text-dark shadow-sm">
          <div class="card-body">
            <h3 class="card-title text-dark bg-bla">Pilih Session</h3>
            <form method="get" action="">
              <select class="form-control" name="session" onchange="this.form.submit()">
                <option <?php if(isset($_GET['session'])){ if($_GET['session'] == "hari"){ echo "selected='selected'"; } }else{ echo "selected='selected'"; } ?> value="hari">Hari Ini</option>
                <option <?php if(isset($_GET['session'])){ if($_GET['session'] == "bulan"){ echo "selected='selected'"; } } ?> value="bulan">Bulan Ini</option>
                <option <?php if(isset($_GET['session'])){ if($_GET['session'] == "tahun"){ echo "selected='selected'"; } } ?> value="tahun">Tahun Ini</option>
                <option <?php if(isset($_GET['session'])){ if($_GET['session'] == "semua"){ echo "selected='selected'"; } } ?> value="semua">Semua</option>
              </select>
            </form>
          </div>
        </div>
      </div>
      

      <?php 
      if(isset($_GET['session'])){
        if($_GET['session'] == "hari"){
          ?>
          <div class="col-lg-4 col-sm-12">
            <div class="card bg-white text-dark shadow-sm">
              <div class="card-body">
                <h3 class="card-title text-dark">Pemasukan Hari Ini</h3>
                <div class="d-inline-block">
                  <h3 class="text-dark">{{ "Rp. ".number_format($pemasukan_hari_ini->total)." ,-" }}</h3>
                  <p class="text-dark mb-0">{{ date('d-m-Y') }}</p>
                </div>
              </div>
            </div>
          </div>
          <div class="col-lg-4 col-sm-12">
            <div class="card bg-white text-dark shadow-sm">
              <div class="card-body">
                <h3 class="card-title text-dark">Pengeluaran Hari Ini</h3>
                <div class="d-inline-block">
                  <h3 class="text-dark">{{ "Rp. ".number_format($pengeluaran_hari_ini->total)." ,-" }}</h3>
                  <p class="text-dark mb-0">{{ date('d-m-Y') }}</p>
                </div>
              </div>
            </div>
          </div>
          <?php
        }else if($_GET['session'] == "bulan"){
          ?>
          <div class="col-lg-4 col-sm-12">
            <div class="card bg-white text-dark shadow-sm">
              <div class="card-body">
                <h3 class="card-title text-dark">Pemasukan Bulan Ini</h3>
                <div class="d-inline-block">
                  <h3 class="text-dark">{{ "Rp. ".number_format($pemasukan_bulan_ini->total)." ,-" }}</h3>
                  <p class="text-dark mb-0">{{ date('M') }}</p>
                </div>
              </div>
            </div>
          </div>
          <div class="col-lg-4 col-sm-12">
            <div class="card bg-white text-dark shadow-sm">
              <div class="card-body">
                <h3 class="card-title text-dark">Pengeluaran Bulan Ini</h3>
                <div class="d-inline-block">
                  <h3 class="text-dark">{{ "Rp. ".number_format($pengeluaran_bulan_ini->total)." ,-" }}</h3>
                  <p class="text-dark mb-0">{{ date('M') }}</p>
                </div>
              </div>
            </div>
          </div>
          <?php
        }else if($_GET['session'] == "tahun"){
          ?>
          <div class="col-lg-4 col-sm-12">
            <div class="card bg-white text-dark shadow-sm">
              <div class="card-body">
                <h3 class="card-title text-dark">Pemasukan Tahun Ini</h3>
                <div class="d-inline-block">
                  <h3 class="text-dark">{{ "Rp. ".number_format($pemasukan_tahun_ini->total)." ,-" }}</h3>
                  <p class="text-dark mb-0">{{ date('Y') }}</p>
                </div>
              </div>
            </div>
          </div>
          <div class="col-lg-4 col-sm-12">
            <div class="card bg-white text-dark shadow-sm">
              <div class="card-body">
                <h3 class="card-title text-dark">Pengeluaran Tahun Ini</h3>
                <div class="d-inline-block">
                  <h3 class="text-dark">{{ "Rp. ".number_format($pengeluaran_tahun_ini->total)." ,-" }}</h3>
                  <p class="text-dark mb-0">{{ date('Y') }}</p>
                </div>
              </div>
            </div>
          </div>
          <?php
        }else if($_GET['session'] == "semua"){
          ?>
          <div class="col-lg-4 col-sm-12">
            <div class="card bg-white text-dark shadow-sm">
              <div class="card-body">
                <h3 class="card-title text-dark">Seluruh Pemasukan</h3>
                <div class="d-inline-block">
                  <h3 class="text-dark">{{ "Rp. ".number_format($seluruh_pemasukan->total)." ,-" }}</h3>
                  <p class="text-dark mb-0">Semua</p>
                </div>
              </div>
            </div>
          </div>
          <div class="col-lg-4 col-sm-12">
            <div class="card bg-white text-dark shadow-sm">
              <div class="card-body">
                <h3 class="card-title text-dark">Seluruh Pengeluaran</h3>
                <div class="d-inline-block">
                  <h3 class="text-dark">{{ "Rp. ".number_format($seluruh_pengeluaran->total)." ,-" }}</h3>
                  <p class="text-dark mb-0">Semua</p>
                </div>
              </div>
            </div>
          </div>
          <?php
        }
      }else{
        ?>
        <div class="col-lg-4 col-sm-12">
          <div class="card bg-white text-dark shadow-sm">
            <div class="card-body">
              <h3 class="card-title text-dark">Pemasukan Hari Ini</h3>
              <div class="d-inline-block">
                <h3 class="text-dark">{{ "Rp. ".number_format($pemasukan_hari_ini->total)." ,-" }}</h3>
                <p class="text-dark mb-0">{{ date('d-m-Y') }}</p>
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-4 col-sm-12">
          <div class="card bg-white text-dark shadow-sm">
            <div class="card-body">
              <h3 class="card-title text-dark">Pengeluaran Hari Ini</h3>
              <div class="d-inline-block">
                <h3 class="text-dark">{{ "Rp. ".number_format($pengeluaran_hari_ini->total)." ,-" }}</h3>
                <p class="text-dark mb-0">{{ date('d-m-Y') }}</p>
              </div>
            </div>
          </div>
        </div>
        <?php 
      }
      ?>



      


    </div>

    <div class="row mb-4 justify-content-center">

      <div class="col-lg-6 mb-4">
        <div class="card shadow-sm rounded w-100 h-100">
          <div class="card-header bg-white">
            <h5 class="fw-bold">Grafik Keuangan Bulanan</h5>
          </div>
          <div class="card-body">
            <canvas id="grafik2" style="width:100%; height:300px;"></canvas>
          </div>
        </div>
      </div>

   
      <div class="col-lg-6 mb-4">
        <div class="card shadow-sm rounded w-100 h-100">
          <div class="card-header bg-white">
            <h5 class="fw-bold">Grafik Keuangan Tahunan</h5>
          </div>
          <div class="card-body">
            <canvas id="grafik3" style="width:100%; height:300px;"></canvas>
          </div>
        </div>
      </div>
    </div>

 </div>



</div>
<!-- #/ container -->
</div>



<style type="text/css">
        .card-grafik canvas{
          width: 100% !important;
          position: relative !important;
          height: auto !important;
        }
        .card-title {
          font-weight: 600;
          font-size: 17px;
        }
        .card {
          border-radius: 16px;
          box-shadow: 0 4px 12px rgba(0,0,0,0.05);
        }
        .table-striped > tbody > tr:nth-of-type(odd) {
          background-color: #f9f9f9;
        }
        .btn-outline-primary {
          border-radius: 6px;
        }
        .btn-primary {
          border-radius: 6px;
          background-color: #2563eb;
        }
      </style>


<script>
function formatRupiah(value) {
  return value.toLocaleString('id-ID');
}


const ctx2 = document.getElementById('grafik2').getContext('2d');

let dataBulan = [];
let dataBulanOut = [];
const bulanLabels = ["Jan", "Feb", "Mar", "Apr", "Mei", "Jun", "Jul", "Agu", "Sep", "Okt", "Nov", "Des"];

const chart2 = new Chart(ctx2, {
  type: 'bar',
  data: {
    labels: bulanLabels,
    datasets: [
      {
        label: 'Pemasukan',
        data: dataBulan,
        backgroundColor: 'rgba(75, 192, 192, 0.5)'
      },
      {
        label: 'Pengeluaran',
        data: dataBulanOut,
        backgroundColor: 'rgba(255, 99, 132, 0.5)'
      }
    ]
  },
  options: {
    responsive: true,
    plugins: {
      legend: { display: true },
      tooltip: { enabled: true }
    },
    scales: {
      x: {
        title: { display: true, text: 'Bulan' },
        grid: { display: true }
      },
      y: {
        title: { display: true, text: 'Nominal (Rp)' },
        min: 0,
        max: 10000000,
        ticks: {
          callback: function(value) { return formatRupiah(value); }
        },
        grid: { display: true }
      }
    }
  }
});



const ctx3 = document.getElementById('grafik3').getContext('2d');

let dataTahun = [];
let dataTahunOut = [];
const tahunLabels = ["2021", "2022", "2023", "2024", "2025"];

const chart3 = new Chart(ctx3, {
  type: 'bar',
  data: {
    labels: tahunLabels,
    datasets: [
      {
        label: 'Pemasukan',
        data: dataTahun,
        backgroundColor: 'rgba(75, 192, 192, 0.5)'
      },
      {
        label: 'Pengeluaran',
        data: dataTahunOut,
        backgroundColor: 'rgba(255, 99, 132, 0.5)'
      }
    ]
  },
  options: {
    responsive: true,
    plugins: {
      legend: { display: true },
      tooltip: { enabled: true }
    },
    scales: {
      x: {
        title: { display: true, text: 'Tahun' },
        grid: { display: true }
      },
      y: {
        title: { display: true, text: 'Nominal (Rp)' },
        min: 0,
        max: 10000000,
        ticks: {
          callback: function(value) { return formatRupiah(value); }
        },
        grid: { display: true }
      }
    }
  }
});
</script>

@endsection