@extends('app.master')

@section('konten')

<div class="content-body">

  <div class="row page-titles mx-0 mt-2">

    <h3 class="col p-md-0">Kategori</h3>

    <div class="col p-md-0">
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="javascript:void(0)">Dashboard</a></li>
        <li class="breadcrumb-item active"><a href="javascript:void(0)">Kategori</a></li>
      </ol>
    </div>

  </div>

  <div class="container-fluid">

    <div class="card">

      <div class="card-header pt-4">
        <button type="button" class="btn btn-primary float-right" data-toggle="modal" data-target="#exampleModal">
          <i class="fa fa-plus"></i> &nbsp TAMBAH KATEGORI
        </button>
        <h4>Data Kategori</h4>

      </div>
      <div class="card-body pt-0">

        <!-- Modal -->
        <form action="{{ route('kategori.aksi') }}" method="post">
          <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">Tambah Kategori</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">

                  @csrf
                  <div class="form-group">
                    <label>Nama Kategori</label>
                    <input type="text" name="nama" required="required" class="form-control" placeholder="Nama Kategori ..">
                  </div>

                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-default" data-dismiss="modal"><i class="ti-close m-r-5 f-s-12"></i> Tutup</button>
                  <button type="submit" class="btn btn-primary"><i class="fa fa-paper-plane m-r-5"></i> Simpan</button>
                </div>
              </div>
            </div>
          </div>
        </form>


        <div class="table-responsive">


          <table class="table table-bordered" id="table-datatable">
            <thead>
              <tr>
                <th width="1%">NO</th>
                <th>NAMA KATEGORI</th>
                <th class="text-center" width="10%">OPSI</th>
              </tr>
            </thead>
            <tbody>
              @php
              $no = 1;
              @endphp
              @foreach($kategori as $k)
              <tr>
                <td class="text-center">{{ $no++ }}</td>
                <td>{{ $k->kategori }}</td>
                <td>    

                  @if($k->id != 1)
                  <div class="text-center">
                    <button type="button" class="btn btn-default btn-sm" data-toggle="modal" data-target="#edit_kategori_{{ $k->id }}">
                      <i class="fa fa-cog"></i>
                    </button>

                    <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#hapus_kategori_{{ $k->id }}">
                      <i class="fa fa-trash"></i>
                    </button>
                  </div>
                  @endif

                  <form action="{{ route('kategori.update',['id' => $k->id]) }}" method="post">
                    <div class="modal fade" id="edit_kategori_{{$k->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                      <div class="modal-dialog" role="document">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Edit Kategori</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                          <div class="modal-body">

                            @csrf
                            {{ method_field('PUT') }}

                            <div class="form-group" style="width:100%">
                              <label>Nama Kategori</label>
                              <input type="hidden" name="id" value="{{ $k->id }}">
                              <input type="text" name="nama" required="required" class="form-control" placeholder="Nama Kategori .." value="{{ $k->kategori }}" style="width:100%">
                            </div>

                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal"><i class="ti-close m-r-5 f-s-12"></i> Tutup</button>
                            <button type="submit" class="btn btn-primary"><i class="fa fa-paper-plane m-r-5"></i> Simpan</button>
                          </div>
                        </div>
                      </div>
                    </div>
                  </form>

                  <!-- modal hapus -->
                  <form method="POST" action="{{ route('kategori.delete',['id' => $k->id]) }}">
                    <div class="modal fade" id="hapus_kategori_{{$k->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                      <div class="modal-dialog" role="document">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Peringatan!</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                          <div class="modal-body">

                            <p>Yakin ingin menghapus data ini ?</p>

                            @csrf
                            {{ method_field('DELETE') }}


                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal"><i class="ti-close m-r-5 f-s-12"></i> Batal</button>
                            <button type="submit" class="btn btn-primary"><i class="fa fa-paper-plane m-r-5"></i> Ya, Hapus</button>
                          </div>
                        </div>
                      </div>
                    </div>
                  </form>


                </td>
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>

    </div>

    <!-- Card Tambah Data Kapal -->
    <div class="card mt-4">
      <div class="card-header pt-4">
        <button type="button" class="btn btn-primary float-right" data-toggle="modal" data-target="#modalTambahKapal">
          <i class="fa fa-plus"></i> &nbsp TAMBAH KAPAL
        </button>
        <h4>Data Kapal</h4>
      </div>
      <div class="card-body pt-0">
        <!-- Modal Tambah Kapal -->
        <form action="{{ route('kapal.aksi') }}" method="post">
          <div class="modal fade" id="modalTambahKapal" tabindex="-1" role="dialog" aria-labelledby="modalTambahKapalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="modalTambahKapalLabel">Tambah Kapal</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                  @csrf
                  <div class="form-group">
                    <label>Nama Kapal</label>
                    <input type="text" name="shipname" required="required" class="form-control" placeholder="Nama Kapal ..">
                  </div>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-default" data-dismiss="modal"><i class="ti-close m-r-5 f-s-12"></i> Tutup</button>
                  <button type="submit" class="btn btn-primary"><i class="fa fa-paper-plane m-r-5"></i> Simpan</button>
                </div>
              </div>
            </div>
          </div>
        </form>
        <div class="table-responsive">
          <table class="table table-bordered" id="table-datatable-kapal">
            <thead>
              <tr>
                <th width="1%">NO</th>
                <th>NAMA KAPAL</th>
                <th class="text-center" width="10%">OPSI</th>
              </tr>
            </thead>
            <tbody>
              @php $no = 1; @endphp
              @foreach($ships as $ship)
              <tr>
                <td class="text-center">{{ $no++ }}</td>
                <td>{{ $ship->shipname }}</td>
                <td>
                  <div class="text-center">
                    <button type="button" class="btn btn-default btn-sm" data-toggle="modal" data-target="#edit_kapal_{{ $ship->ship_id }}">
                      <i class="fa fa-cog"></i>
                    </button>
                    <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#hapus_kapal_{{ $ship->ship_id }}">
                      <i class="fa fa-trash"></i>
                    </button>
                  </div>
                  <!-- Modal Edit Kapal -->
                  <form action="{{ route('kapal.update', ['id' => $ship->ship_id]) }}" method="post">
                    <div class="modal fade" id="edit_kapal_{{ $ship->ship_id }}" tabindex="-1" role="dialog" aria-labelledby="editKapalLabel_{{ $ship->ship_id }}" aria-hidden="true">
                      <div class="modal-dialog" role="document">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title" id="editKapalLabel_{{ $ship->ship_id }}">Edit Kapal</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                          <div class="modal-body">
                            @csrf
                            {{ method_field('PUT') }}
                            <div class="form-group">
                              <label>Nama Kapal</label>
                              <input type="hidden" name="id" value="{{ $ship->ship_id }}">
                              <input type="text" name="shipname" required="required" class="form-control" value="{{ $ship->shipname }}" placeholder="Nama Kapal ..">
                            </div>
                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal"><i class="ti-close m-r-5 f-s-12"></i> Tutup</button>
                            <button type="submit" class="btn btn-primary"><i class="fa fa-paper-plane m-r-5"></i> Simpan</button>
                          </div>
                        </div>
                      </div>
                    </div>
                  </form>
                  <!-- Modal Hapus Kapal -->
                  <form method="POST" action="{{ route('kapal.delete', ['id' => $ship->ship_id]) }}">
                    <div class="modal fade" id="hapus_kapal_{{ $ship->ship_id }}" tabindex="-1" role="dialog" aria-labelledby="hapusKapalLabel_{{ $ship->ship_id }}" aria-hidden="true">
                      <div class="modal-dialog" role="document">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title" id="hapusKapalLabel_{{ $ship->ship_id }}">Peringatan!</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                          <div class="modal-body">
                            <p>Yakin ingin menghapus data kapal ini?</p>
                            @csrf
                            {{ method_field('DELETE') }}
                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal"><i class="ti-close m-r-5 f-s-12"></i> Batal</button>
                            <button type="submit" class="btn btn-primary"><i class="fa fa-paper-plane m-r-5"></i> Ya, Hapus</button>
                          </div>
                        </div>
                      </div>
                    </div>
                  </form>
                </td>
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>

    <!-- Card Tambah Data Jenis Muatan -->
    <div class="card mt-4">
      <div class="card-header pt-4">
        <button type="button" class="btn btn-primary float-right" data-toggle="modal" data-target="#modalTambahMuatan">
          <i class="fa fa-plus"></i> &nbsp TAMBAH JENIS MUATAN
        </button>
        <h4>Data Jenis Muatan</h4>
      </div>
      <div class="card-body pt-0">
        <!-- Modal Tambah Muatan -->
        <form action="{{ route('muatan.aksi') }}" method="post">
          <div class="modal fade" id="modalTambahMuatan" tabindex="-1" role="dialog" aria-labelledby="modalTambahMuatanLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="modalTambahMuatanLabel">Tambah Jenis Muatan</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                  @csrf
                  <div class="form-group">
                    <label>Nama Jenis Muatan</label>
                    <input type="text" name="load_name" required="required" class="form-control" placeholder="Nama Jenis Muatan ..">
                  </div>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-default" data-dismiss="modal"><i class="ti-close m-r-5 f-s-12"></i> Tutup</button>
                  <button type="submit" class="btn btn-primary"><i class="fa fa-paper-plane m-r-5"></i> Simpan</button>
                </div>
              </div>
            </div>
          </div>
        </form>
        <div class="table-responsive">
          <table class="table table-bordered" id="table-datatable-muatan">
            <thead>
              <tr>
                <th width="1%">NO</th>
                <th>NAMA JENIS MUATAN</th>
                <th class="text-center" width="10%">OPSI</th>
              </tr>
            </thead>
            <tbody>
              @php $no = 1; @endphp
              @foreach($loads_category as $muatan)
              <tr>
                <td class="text-center">{{ $no++ }}</td>
                <td>{{ $muatan->load_name }}</td>
                <td>
                  <div class="text-center">
                    <button type="button" class="btn btn-default btn-sm" data-toggle="modal" data-target="#edit_muatan_{{ $muatan->load_category_id }}">
                      <i class="fa fa-cog"></i>
                    </button>
                    <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#hapus_muatan_{{ $muatan->load_category_id }}">
                      <i class="fa fa-trash"></i>
                    </button>
                  </div>
                  <!-- Modal Edit Muatan -->
                  <form action="{{ route('muatan.update', ['id' => $muatan->load_category_id]) }}" method="post">
                    <div class="modal fade" id="edit_muatan_{{ $muatan->load_category_id }}" tabindex="-1" role="dialog" aria-labelledby="editMuatanLabel_{{ $muatan->load_category_id }}" aria-hidden="true">
                      <div class="modal-dialog" role="document">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title" id="editMuatanLabel_{{ $muatan->load_category_id }}">Edit Jenis Muatan</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                          <div class="modal-body">
                            @csrf
                            {{ method_field('PUT') }}
                            <div class="form-group">
                              <label>Nama Jenis Muatan</label>
                              <input type="hidden" name="id" value="{{ $muatan->load_category_id }}">
                              <input type="text" name="load_name" required="required" class="form-control" value="{{ $muatan->load_name }}" placeholder="Nama Jenis Muatan ..">
                            </div>
                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal"><i class="ti-close m-r-5 f-s-12"></i> Tutup</button>
                            <button type="submit" class="btn btn-primary"><i class="fa fa-paper-plane m-r-5"></i> Simpan</button>
                          </div>
                        </div>
                      </div>
                    </div>
                  </form>
                  <!-- Modal Hapus Muatan -->
                  <form method="POST" action="{{ route('muatan.delete', ['id' => $muatan->load_category_id]) }}">
                    <div class="modal fade" id="hapus_muatan_{{ $muatan->load_category_id }}" tabindex="-1" role="dialog" aria-labelledby="hapusMuatanLabel_{{ $muatan->load_category_id }}" aria-hidden="true">
                      <div class="modal-dialog" role="document">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title" id="hapusMuatanLabel_{{ $muatan->load_category_id }}">Peringatan!</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                          <div class="modal-body">
                            <p>Yakin ingin menghapus data jenis muatan ini?</p>
                            @csrf
                            {{ method_field('DELETE') }}
                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal"><i class="ti-close m-r-5 f-s-12"></i> Batal</button>
                            <button type="submit" class="btn btn-primary"><i class="fa fa-paper-plane m-r-5"></i> Ya, Hapus</button>
                          </div>
                        </div>
                      </div>
                    </div>
                  </form>
                </td>
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>


    <!-- Card Tambah Data Rute -->
    <div class="card mt-4">
      <div class="card-header pt-4">
        <button type="button" class="btn btn-primary float-right" data-toggle="modal" data-target="#modalTambahRute">
          <i class="fa fa-plus"></i> &nbsp TAMBAH RUTE
        </button>
        <h4>Data Rute</h4>
      </div>
      <div class="card-body pt-0">
        <!-- Modal Tambah Rute -->
        <form action="{{ route('rute.aksi') }}" method="post">
          <div class="modal fade" id="modalTambahRute" tabindex="-1" role="dialog" aria-labelledby="modalTambahRuteLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="modalTambahRuteLabel">Tambah Rute</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                  @csrf
                  <div class="form-group">
                    <label>Nama Rute</label>
                    <input type="text" name="city_name" required="required" class="form-control" placeholder="Nama Rute ..">
                  </div>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-default" data-dismiss="modal"><i class="ti-close m-r-5 f-s-12"></i> Tutup</button>
                  <button type="submit" class="btn btn-primary"><i class="fa fa-paper-plane m-r-5"></i> Simpan</button>
                </div>
              </div>
            </div>
          </div>
        </form>
        <div class="table-responsive">
          <table class="table table-bordered" id="table-datatable-rute">
            <thead>
              <tr>
                <th width="1%">NO</th>
                <th>NAMA RUTE</th>
                <th class="text-center" width="10%">OPSI</th>
              </tr>
            </thead>
            <tbody>
              @php $no = 1; @endphp
              @foreach($cities as $rute)
              <tr>
                <td class="text-center">{{ $no++ }}</td>
                <td>{{ $rute->city_name }}</td>
                <td>
                  <div class="text-center">
                    <button type="button" class="btn btn-default btn-sm" data-toggle="modal" data-target="#edit_rute_{{ $rute->city_id }}">
                      <i class="fa fa-cog"></i>
                    </button>
                    <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#hapus_rute_{{ $rute->city_id }}">
                      <i class="fa fa-trash"></i>
                    </button>
                  </div>
                  <!-- Modal Edit Rute -->
                  <form action="{{ route('rute.update', ['id' => $rute->city_id]) }}" method="post">
                    <div class="modal fade" id="edit_rute_{{ $rute->city_id }}" tabindex="-1" role="dialog" aria-labelledby="editRuteLabel_{{ $rute->city_id }}" aria-hidden="true">
                      <div class="modal-dialog" role="document">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title" id="editRuteLabel_{{ $rute->city_id }}">Edit Rute</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                          <div class="modal-body">
                            @csrf
                            {{ method_field('PUT') }}
                            <div class="form-group">
                              <label>Nama Rute</label>
                              <input type="hidden" name="id" value="{{ $rute->city_id }}">
                              <input type="text" name="city_name" required="required" class="form-control" value="{{ $rute->city_name }}" placeholder="Nama Rute ..">
                            </div>
                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal"><i class="ti-close m-r-5 f-s-12"></i> Tutup</button>
                            <button type="submit" class="btn btn-primary"><i class="fa fa-paper-plane m-r-5"></i> Simpan</button>
                          </div>
                        </div>
                      </div>
                    </div>
                  </form>
                  <!-- Modal Hapus Rute -->
                  <form method="POST" action="{{ route('rute.delete', ['id' => $rute->city_id]) }}">
                    <div class="modal fade" id="hapus_rute_{{ $rute->city_id }}" tabindex="-1" role="dialog" aria-labelledby="hapusRuteLabel_{{ $rute->city_id }}" aria-hidden="true">
                      <div class="modal-dialog" role="document">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title" id="hapusRuteLabel_{{ $rute->city_id }}">Peringatan!</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                          <div class="modal-body">
                            <p>Yakin ingin menghapus data rute ini?</p>
                            @csrf
                            {{ method_field('DELETE') }}
                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal"><i class="ti-close m-r-5 f-s-12"></i> Batal</button>
                            <button type="submit" class="btn btn-primary"><i class="fa fa-paper-plane m-r-5"></i> Ya, Hapus</button>
                          </div>
                        </div>
                      </div>
                    </div>
                  </form>
                </td>
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>


  </div>
  <!-- #/ container -->
</div>

@endsection