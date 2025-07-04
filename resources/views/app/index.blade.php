@extends('app.master')

@section('konten')

<div class="content-body b">
 
  <div class="container-fluid mt-3">

    <div class="row">
      <div class="col-lg-4 col-sm-12">
        <div class="card gradient-7">
          <div class="card-body">
            <h3 class="card-title text-white bg-bla">Pilih Session</h3>
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
            <div class="card gradient-7">
              <div class="card-body">
                <h3 class="card-title text-white">Pemasukan Hari Ini</h3>
                <div class="d-inline-block">
                  <h3 class="text-white">{{ "Rp. ".number_format($pemasukan_hari_ini->total)." ,-" }}</h3>
                  <p class="text-white mb-0">{{ date('d-m-Y') }}</p>
                </div>
              </div>
            </div>
          </div>
          <div class="col-lg-4 col-sm-12">
            <div class="card gradient-8">
              <div class="card-body">
                <h3 class="card-title text-white">Saldo Hari Ini</h3>
                <div class="d-inline-block">
                  <h3 class="text-white">{{ "Rp. ".number_format($pemasukan_hari_ini->total - $pengeluaran_hari_ini->total)." ,-" }}</h3>
                  <p class="text-white mb-0">Saldo</p>
                </div>
              </div>
            </div>
          </div>
          <?php
        }else if($_GET['session'] == "bulan"){
          ?>
          <div class="col-lg-4 col-sm-12">
            <div class="card gradient-2">
              <div class="card-body">
                <h3 class="card-title text-white">Pemasukan Bulan Ini</h3>
                <div class="d-inline-block">
                  <h3 class="text-white">{{ "Rp. ".number_format($pemasukan_bulan_ini->total)." ,-" }}</h3>
                  <p class="text-white mb-0">{{ date('M') }}</p>
                </div>
              </div>
            </div>
          </div>
          <div class="col-lg-4 col-sm-12">
            <div class="card gradient-8">
              <div class="card-body">
                <h3 class="card-title text-white">Saldo Bulan</h3>
                <div class="d-inline-block">
                  <h3 class="text-white">{{ "Rp. ".number_format($pemasukan_bulan_ini->total - $pengeluaran_bulan_ini->total)." ,-" }}</h3>
                  <p class="text-white mb-0">Saldo</p>
                </div>
              </div>
            </div>
          </div>
          <?php
        }else if($_GET['session'] == "tahun"){
          ?>
          <div class="col-lg-4 col-sm-12">
            <div class="card gradient-3">
              <div class="card-body">
                <h3 class="card-title text-white">Pemasukan Tahun Ini</h3>
                <div class="d-inline-block">
                  <h3 class="text-white">{{ "Rp. ".number_format($pemasukan_tahun_ini->total)." ,-" }}</h3>
                  <p class="text-white mb-0">{{ date('Y') }}</p>
                </div>
              </div>
            </div>
          </div>
          <div class="col-lg-4 col-sm-12">
            <div class="card gradient-8">
              <div class="card-body">
                <h3 class="card-title text-white">Saldo Tahun Ini</h3>
                <div class="d-inline-block">
                  <h3 class="text-white">{{ "Rp. ".number_format($pemasukan_tahun_ini->total - $pengeluaran_tahun_ini->total)." ,-" }}</h3>
                  <p class="text-white mb-0">Saldo</p>
                </div>
              </div>
            </div>
          </div>
          <?php
        }else if($_GET['session'] == "semua"){
          ?>
          <div class="col-lg-4 col-sm-12">
            <div class="card gradient-4">
              <div class="card-body">
                <h3 class="card-title text-white">Seluruh Pemasukan</h3>
                <div class="d-inline-block">
                  <h3 class="text-white">{{ "Rp. ".number_format($seluruh_pemasukan->total)." ,-" }}</h3>
                  <p class="text-white mb-0">Semua</p>
                </div>
              </div>
            </div>
          </div>

          <div class="col-lg-4 col-sm-12">
            <div class="card gradient-8">
              <div class="card-body">
                <h3 class="card-title text-white">Saldo Keseluruhan</h3>
                <div class="d-inline-block">
                  <h3 class="text-white">{{ "Rp. ".number_format($seluruh_pemasukan->total - $seluruh_pengeluaran->total)." ,-" }}</h3>
                  <p class="text-white mb-0">Saldo</p>
                </div>
              </div>
            </div>
          </div>

          <?php
        }
      }else{
        ?>
        <div class="col-lg-4 col-sm-12">
          <div class="card gradient-7">
            <div class="card-body">
              <h3 class="card-title text-white">Pemasukan Hari Ini</h3>
              <div class="d-inline-block">
                <h3 class="text-white">{{ "Rp. ".number_format($pemasukan_hari_ini->total)." ,-" }}</h3>
                <p class="text-white mb-0">{{ date('d-m-Y') }}</p>
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-4 col-sm-12">
          <div class="card gradient-8">
            <div class="card-body">
              <h3 class="card-title text-white">Saldo Hari Ini</h3>
              <div class="d-inline-block">
                <h3 class="text-white">{{ "Rp. ".number_format($pemasukan_hari_ini->total - $pengeluaran_hari_ini->total)." ,-" }}</h3>
                <p class="text-white mb-0">Saldo</p>
              </div>
            </div>
          </div>
        </div>
        <?php 
      }
      ?>



      


    </div>

    <div class="row">
      <div class="col-lg-4 col-sm-12">

      </div>
      <?php 
      if(isset($_GET['session'])){
        if($_GET['session'] == "hari"){
          ?>
          <div class="col-lg-4 col-sm-12">
            <div class="card gradient-1">
              <div class="card-body">
                <h3 class="card-title text-white">Pengeluaran Hari Ini</h3>
                <div class="d-inline-block">
                  <h3 class="text-white">{{ "Rp. ".number_format($pengeluaran_hari_ini->total)." ,-" }}</h3>
                  <p class="text-white mb-0">{{ date('d-m-Y') }}</p>
                </div>
              </div>
            </div>
          </div>
          <?php
        }else if($_GET['session'] == "bulan"){
          ?>
          <div class="col-lg-4 col-sm-12">
            <div class="card gradient-9">
              <div class="card-body">
                <h3 class="card-title text-white">Pengeluaran Bulan Ini</h3>
                <div class="d-inline-block">
                  <h3 class="text-white">{{ "Rp. ".number_format($pengeluaran_bulan_ini->total)." ,-" }}</h3>
                  <p class="text-white mb-0">{{ date('M') }}</p>
                </div>
              </div>
            </div>
          </div>
          <?php
        }else if($_GET['session'] == "tahun"){
          ?>
          <div class="col-lg-4 col-sm-12">
            <div class="card gradient-6">
              <div class="card-body">
                <h3 class="card-title text-white">Pengeluaran Tahun Ini</h3>
                <div class="d-inline-block">
                  <h3 class="text-white">{{ "Rp. ".number_format($pengeluaran_tahun_ini->total)." ,-" }}</h3>
                  <p class="text-white mb-0">{{ date('Y') }}</p>
                </div>
              </div>
            </div>
          </div>
          <?php
        }else if($_GET['session'] == "semua"){
          ?>
          <div class="col-lg-4 col-sm-12">
            <div class="card gradient-8">
              <div class="card-body">
                <h3 class="card-title text-white">Seluruh Pengeluaran</h3>
                <div class="d-inline-block">
                  <h3 class="text-white">{{ "Rp. ".number_format($seluruh_pengeluaran->total)." ,-" }}</h3>
                  <p class="text-white mb-0">Semua</p>
                </div>
              </div>
            </div>
          </div>
          <?php
        }
      }else{
        ?>
        <div class="col-lg-4 col-sm-12">
          <div class="card gradient-1">
            <div class="card-body">
              <h3 class="card-title text-white">Pengeluaran Hari Ini</h3>
              <div class="d-inline-block">
                <h3 class="text-white">{{ "Rp. ".number_format($pengeluaran_hari_ini->total)." ,-" }}</h3>
                <p class="text-white mb-0">{{ date('d-m-Y') }}</p>
              </div>
            </div>
          </div>
        </div>
        <?php 
      }
      ?>

    </div>


    <!-- Grafik Keuangan -->
    <div class="row justify-content-center">
      <!-- Grafik Keuangan Bulanan -->
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

      <!-- Grafik Keuangan Tahunan -->
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

   <div class="row mt-4">
     <div class="col-12">
       <div class="card shadow-sm border-0">
         <div class="card-header d-flex justify-content-between align-items-center">
           <h5 class="mb-0">Riwayat Pesanan</h5>
           <div>
             <a href="/laporan" class="btn btn-sm btn-primary" style="border-radius:6px; background-color:#2563eb;">Tanggal Laporan</a>
             <a href="/laporan" class="btn btn-sm btn-primary ms-2" style="border-radius:6px; background-color:#2563eb;">Lihat Laporan</a>
           </div>
         </div>
         <div class="card-body table-responsive">
           <table class="table table-striped mb-0">
             <thead class="table-light">
               <tr>
                 <th>Transaksi</th>
                 <th>ID</th>
                 <th>Jumlah</th>
                 <th>Tanggal Berangkat</th>
                 <th>Tanggal Pulang</th>
               </tr>
             </thead>
             <tbody>
               <tr>
                 <td><i class="fa fa-ship me-1 text-primary"></i> Kapal A</td>
                 <td>#7890328</td>
                 <td class="text-danger">-Rp 13.000</td>
                 <td>16 Jan 2:30pm</td>
                 <td>18 Jan 6:30pm</td>
               </tr>
               <tr>
                 <td><i class="fa fa-ship me-1 text-primary"></i> Kapal B</td>
                 <td>#3948509</td>
                 <td class="text-danger">-Rp 24.000</td>
                 <td>20 Jan 3:30pm</td>
                 <td>22 Jan 8:30pm</td>
               </tr>
               <tr>
                 <td><i class="fa fa-ship me-1 text-success"></i> Kapal C</td>
                 <td>#2980298</td>
                 <td class="text-success">+Rp 50.000</td>
                 <td>24 Jan 2:30pm</td>
                 <td>28 Jan 10:30pm</td>
               </tr>
             </tbody>
           </table>
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
  var randomScalingFactor = function(){ return Math.round(Math.random()*100)};

  var barChartData = {
    labels : ["Jan","Feb","Mar","Apr","Mei","Jun","Jul","Agu","Sep","Okt","Nov","Des"],
    datasets : [
    {
      label: 'Pemasukan',
      fillColor : "rgba(51, 240, 113, 0.61)",
      strokeColor : "rgba(11, 246, 88, 0.61)",
      highlightFill: "rgba(220,220,220,0.75)",
      highlightStroke: "rgba(220,220,220,1)",
      data : [
        <?php
        for($bulan=1;$bulan<=12;$bulan++){
          $tahun = date('Y');
          $pemasukan_perbulan = DB::table('transaksi')
          ->select(DB::raw('SUM(nominal) as total'))
          ->where('jenis','Pemasukan')
          ->whereMonth('tanggal',$bulan)
          ->whereYear('tanggal',$tahun)
          ->first();
          $total = $pemasukan_perbulan->total;
          if($pemasukan_perbulan->total == ""){
            echo "0,";
          }else{
            echo $total.",";
          }
        }
        ?>
        ]
    },
    {
      label: 'Pengeluaran',
      fillColor : "rgba(255, 51, 51, 0.8)",
      strokeColor : "rgba(248, 5, 5, 0.8)",
      highlightFill : "rgba(151,187,205,0.75)",
      highlightStroke : "rgba(151,187,205,1)",
      data : [
        <?php
        for($bulan=1;$bulan<=12;$bulan++){
          $tahun = date('Y');
          $pengeluaran_perbulan = DB::table('transaksi')
          ->select(DB::raw('SUM(nominal) as total'))
          ->where('jenis','Pengeluaran')
          ->whereMonth('tanggal',$bulan)
          ->whereYear('tanggal',$tahun)
          ->first();
          $total = $pengeluaran_perbulan->total;
          if($pengeluaran_perbulan->total == ""){
            echo "0,";
          }else{
            echo $total.",";
          }
        }
        ?>
        ]
    }
    ]

  }




  var barChartData2 = {
    labels : [
      <?php 
      $thn2 = DB::table('transaksi')
      ->select(DB::raw('year(tanggal) as tahun'))
      ->distinct()
      ->orderBy('tahun','asc')
      ->get();
      foreach($thn2 as $t){
        ?>
        "<?php echo $t->tahun; ?>",
        <?php 
      }
      ?>
      ],
    datasets : [
    {
      label: 'Pemasukan',
      fillColor : "rgba(51, 240, 113, 0.61)",
      strokeColor : "rgba(11, 246, 88, 0.61)",
      highlightFill: "rgba(220,220,220,0.75)",
      highlightStroke: "rgba(220,220,220,1)",
      data : [
        <?php
        foreach($thn2 as $t){
          $thn = $t->tahun;
          $tahun = DB::table('transaksi')
          ->select(DB::raw('SUM(nominal) as total'))
          ->where('jenis','Pemasukan')
          ->whereYear('tanggal',$thn)
          ->first();
          $total = $tahun->total;
          if($tahun->total == ""){
            echo "0,";
          }else{
            echo $total.",";
          }

        }
        ?>
        ]
    },
    {
      label: 'Pengeluaran',
      fillColor : "rgba(255, 51, 51, 0.8)",
      strokeColor : "rgba(248, 5, 5, 0.8)",
      highlightFill : "rgba(151,187,205,0.75)",
      highlightStroke : "rgba(254, 29, 29, 0)",
      data : [
        <?php
        foreach($thn2 as $t){
          $thn = $t->tahun;
          $tahun = DB::table('transaksi')
          ->select(DB::raw('SUM(nominal) as total'))
          ->where('jenis','Pengeluaran')
          ->whereYear('tanggal',$thn)
          ->first();
          $total = $tahun->total;
          if($tahun->total == ""){
            echo "0,";
          }else{
            echo $total.",";
          }

        }
        ?>
        ]
    }
    ]

  }

  var barChartData3 = {
    <?php
    $dateBegin = strtotime("first day of this month");  
    $dateEnd = strtotime("last day of this month");

    $awal = date("Y-m-d", $dateBegin);         
    $akhir = date("Y-m-d", $dateEnd);
    ?>
    labels : [
      <?php 
      for($a=$awal;$a<=$akhir;$a++){
        ?>
        "<?php echo date('d-m-Y',strtotime($a)) ?>",
        <?php 
      }
      ?>
      ],
    datasets : [
    {
      label: 'Pemasukan',
      fillColor : "rgba(51, 240, 113, 0.61)",
      strokeColor : "rgba(11, 246, 88, 0.61)",
      highlightFill: "rgba(220,220,220,0.75)",
      highlightStroke: "rgba(220,220,220,1)",
      data : [
        <?php 
        for($a=$awal;$a<=$akhir;$a++){
          $tgl = $a;
          $pemasukan_perhari = DB::table('transaksi')
          ->select(DB::raw('SUM(nominal) as total'))
          ->where('jenis','Pemasukan')
          ->whereDate('tanggal',$tgl)
          ->first();
          $total = $pemasukan_perhari->total;
          if($pemasukan_perhari->total == ""){
            echo "0,";
          }else{
            echo $total.",";
          }
        }
        ?>
        ]
    },{
      label: 'Pengeluaran',
      fillColor : "rgba(255, 51, 51, 0.8)",
      strokeColor : "rgba(248, 5, 5, 0.8)",
      highlightFill : "rgba(151,187,205,0.75)",
      highlightStroke : "rgba(254, 29, 29, 0)",
      data : [
        <?php 
        for($a=$awal;$a<=$akhir;$a++){
          $tgl = $a;
          $pemasukan_perhari = DB::table('transaksi')
          ->select(DB::raw('SUM(nominal) as total'))
          ->where('jenis','Pengeluaran')
          ->whereDate('tanggal',$tgl)        ->first();
          $total = $pemasukan_perhari->total;
          if($pemasukan_perhari->total == ""){
            echo "0,";
          }else{
            echo $total.",";
          }

        }
        ?>
        ]
    }
    ]

  }


  var barChartData4 = {
    labels : [
      @foreach($kategori as $k)
      "{{ $k->kategori }}",
      @endforeach
      ],
    datasets : [
    {
      label: 'Pemasukan',
      fillColor : "rgba(51, 240, 113, 0.61)",
      strokeColor : "rgba(11, 246, 88, 0.61)",
      highlightFill: "rgba(220,220,220,0.75)",
      highlightStroke: "rgba(220,220,220,1)",
      data : [
        @foreach($kategori as $k)
        <?php 
        $id_kategori = $k->id;
        $pemasukan_perkategori = DB::table('transaksi')
        ->select(DB::raw('SUM(nominal) as total'))
        ->where('jenis','Pemasukan')
        ->where('kategori_id',$id_kategori)
        ->first();
        $total = $pemasukan_perkategori->total;
        if($pemasukan_perkategori->total == ""){
          echo "0,";
        }else{
          echo $total.",";
        }
        ?>
        @endforeach
        ]
    },{
      label: 'Pengeluaran',
      fillColor : "rgba(255, 51, 51, 0.8)",
      strokeColor : "rgba(248, 5, 5, 0.8)",
      highlightFill: "rgba(151,187,205,0.75)",
      highlightStroke : "rgba(254, 29, 29, 0)", 
      data : [
        @foreach($kategori as $k)
        <?php 
        $bln = date('m');
        $id_kategori = $k->id;
        $pemasukan_perkategori = DB::table('transaksi')
        ->select(DB::raw('SUM(nominal) as total'))
        ->where('jenis','Pengeluaran')
        ->where('kategori_id',$id_kategori)
        ->whereMonth('tanggal',$bln)
        ->first();
        $total = $pemasukan_perkategori->total;
        if($pemasukan_perkategori->total == ""){
          echo "0,";
        }else{
          echo $total.",";
        }
        ?>
        @endforeach
        ]
    }
    ]

  }



  window.onload = function(){
    var ctx = document.getElementById("grafik2").getContext("2d");
    window.myBar = new Chart(ctx).Bar(barChartData2, {
     responsive : true,
     animation: true,
     barValueSpacing : 5,
     barDatasetSpacing : 1,
     tooltipFillColor: "rgba(0,0,0,0.8)",
     multiTooltipTemplate: "<%= datasetLabel %> - Rp.<%= value.toLocaleString() %>,-"
   });

    var ctx = document.getElementById("grafik4").getContext("2d");
    window.myBar = new Chart(ctx).Bar(barChartData4, {
     responsive : true,
     animation: true,
     barValueSpacing : 5,
     barDatasetSpacing : 1,
     tooltipFillColor: "rgba(0,0,0,0.8)",
     multiTooltipTemplate: "<%= datasetLabel %> - Rp.<%= value.toLocaleString() %>,-"
   });

  }

  // Dummy data for both charts
  const dummyLabels = ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'];
  const dummyData1 = [12000, 15000, 10000, 18000, 20000, 17000, 14000, 16000, 19000, 21000, 22000, 23000];
  const dummyData2 = [8000, 9000, 7000, 12000, 11000, 10000, 9500, 10500, 11500, 12500, 13000, 13500];

  const ctx2 = document.getElementById('grafik2').getContext('2d');
  const chart2 = new Chart(ctx2, {
    type: 'bar',
    data: {
      labels: dummyLabels,
      datasets: [
        {
          label: 'Pemasukan',
          backgroundColor: 'rgba(51, 240, 113, 0.61)',
          borderColor: 'rgba(11, 246, 88, 0.61)',
          data: dummyData1,
          borderWidth: 1
        },
        {
          label: 'Pengeluaran',
          backgroundColor: 'rgba(255, 51, 51, 0.8)',
          borderColor: 'rgba(248, 5, 5, 0.8)',
          data: dummyData2,
          borderWidth: 1
        }
      ]
    },
    options: {
      responsive: true,
      scales: {
        x: {
          title: {
            display: true,
            text: 'Bulan'
          }
        },
        y: {
          beginAtZero: true,
          title: {
            display: true,
            text: 'Nominal (Rp)'
          }
        }
      }
    }
  });

  const dummyLabelsYear = ['2021', '2022', '2023', '2024', '2025'];
  const dummyDataYear1 = [120000, 150000, 100000, 180000, 200000];
  const dummyDataYear2 = [80000, 90000, 70000, 120000, 110000];

  const ctx3 = document.getElementById('grafik3').getContext('2d');
  const chart3 = new Chart(ctx3, {
    type: 'bar',
    data: {
      labels: dummyLabelsYear,
      datasets: [
        {
          label: 'Pemasukan',
          backgroundColor: 'rgba(51, 240, 113, 0.61)',
          borderColor: 'rgba(11, 246, 88, 0.61)',
          data: dummyDataYear1,
          borderWidth: 1
        },
        {
          label: 'Pengeluaran',
          backgroundColor: 'rgba(255, 51, 51, 0.8)',
          borderColor: 'rgba(248, 5, 5, 0.8)',
          data: dummyDataYear2,
          borderWidth: 1
        }
      ]
    },
    options: {
      responsive: true,
      scales: {
        x: {
          title: {
            display: true,
            text: 'Tahun'
          }
        },
        y: {
          beginAtZero: true,
          title: {
            display: true,
            text: 'Nominal (Rp)'
          }
        }
      }
    }
  });
</script>

@endsection