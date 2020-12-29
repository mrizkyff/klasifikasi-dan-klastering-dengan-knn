<!-- judul halaman -->
<div class="content-wrapper">


    <!-- notifikasi -->
    <div class="alert alert-success" role="alert" id="dashboard_alert_sukses">
    </div>
    <div class="alert alert-danger" role="alert" id="dashboard_alert_gagal">
    </div>
    <!-- akhir notifikasi -->

    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Kelola Database</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Dashboard Kelola Dokumen Skripsi</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
<!-- akhir judul halaman -->

<!-- tabel utama Dashboard -->
<div class="container-fluid">
  <div class="card">
    <div class="card-header">
      <h3 class="card-title">Kelola Database Repository</h3>
      <button class="btn btn-primary" style="float: right;" id="btn_create"><i class="fa fa-plus"></i> Tambah Dokumen ke Repository</button>
    </div>
      <!-- /.card-header -->
      <div class="card-body">
            <div class="table-responsive">
              <table id="tabel_data_dashboard" class="table table-striped table-bordered">
                  <thead>
                      <tr>
                          <th>No.</th>
                          <!-- <th>No</th> -->
                          <th width="250px">Penulis</th>
                          <th>Tahun</th>
                          <th width="700px">Judul</th>
                          <th>Lokasi</th>
                          <th width="130px">Progdi</th>
                          <th width="120px">Fakultas</th>
                          <th>Waktu</th>
                          <th width='11%'>Aksi</th>
                          <th>Penulis</th>
                          <th>NIM</th>
                          <th>JUDUL</th>
                      </tr>
                  </thead>


                  <tfoot>
                      <tr>
                          <th>No.</th>
                          <!-- <th>No</th> -->
                          <th>Penulis</th>
                          <th>Tahun</th>
                          <th>Judul</th>
                          <th>Lokasi</th>
                          <th>Progdi</th>
                          <th>Fakultas</th>
                          <th>Waktu</th>
                          <th>Aksi</th>
                          <th>Penulis</th>
                          <th>NIM</th>
                          <th>JUDUL</th>
                      </tr>
                  </tfoot>

              </table>
          </div>
      </div>
      <!-- /.card-body -->
    </div>
    <!-- /.card -->
    </div>
  </div>
</div>
<!-- tabel utama Dashboard -->





<!-- Modal tambah data-->
<div class="modal fade" id="modal_tambah" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modal Tambah Data</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="form_create">
            <div class="form-group">
                <label for="penulis">Penulis</label>
                <input type="text" name="penulis" placeholder="Nama Mahasiswa (Penulis)" class="form-control">
            </div>
            <div class="form-group">
                <label for="nim">NIM</label>
                <input type="text" name="nim" placeholder="Nomor Induk Mahasiswa" class="form-control">
            </div>
            <div class="form-group">
                <label for="tahun">Tahun Tugas Akhir</label>
                <input type="text" name="tahun" placeholder="Tahun" class="form-control">
            </div>
            <div class="form-group">
                <label for="judul">Judul Tugas Akhir</label>
                <input type="text" name="judul" placeholder="Judul" class="form-control">
            </div>
            <div class="form-group">
                <label for="judul">Lokasi</label>
                <div class="row">
                  <div class="col">
                    <select name="lokasi_alpha" id="lokasi_alpha" class="custom-select">
                      <option value="arsip">Arsip</option>
                      <option value="a">A</option>
                      <option value="b">B</option>
                      <option value="c">C</option>
                      <option value="d">D</option>
                      <option value="e">E</option>
                      <option value="f">F</option>
                      <option value="g">G</option>
                      <option value="h">H</option>
                      <option value="i">I</option>
                    </select>
                    <div class="valid-feedback">
                      Lokasi dapat digunakan!
                    </div>
                    <div class="invalid-feedback">
                      Lokasi tidak dapat digunakan!
                    </div>
                  </div>
                  <div class="col">
                    <select name="lokasi_numeric" id="lokasi_numeric" class="custom-select">
                      <option value="">-</option>
                      <option value="1">1</option>
                      <option value="2">2</option>
                      <option value="3">3</option>
                      <option value="4">4</option>
                      <option value="5">5</option>
                      <option value="6">6</option>
                      <option value="7">7</option>
                      <option value="8">8</option>
                      <option value="9">9</option>
                      <option value="10">10</option>
                      <option value="11">11</option>
                      <option value="12">12</option>
                      <option value="13">13</option>
                      <option value="14">14</option>
                      <option value="15">15</option>
                      <option value="16">16</option>
                    </select>
                  </div>
                  <div class="col-2">
                    <button class="btn btn-info" id="btn_cek_lokasi">Cek</button>
                  </div>
                </div>
            </div>
            <label for="file">Upload File</label>
            <div class="custom-file">
                <input type="file" class="custom-file-input" name="file">
                <label for="file" class="custom-file-label">.pdf</label>
            </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <input type="submit" name="upload" value="Simpan" class="btn btn-primary">
      </div>
      </form>
    </div>
  </div>
</div>
</div>
<!-- akhir modal tambah data -->

<!-- Modal Edit Data-->
<div class="modal fade" id="modal_edit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
<div class="modal-dialog" role="document">
    <div class="modal-content">
    <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edit Data</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <div class="modal-body">
        <form id="form_update">
            <div class="form-group">
                <label for="penulis">Penulis</label>
                <input type="text" name="penulis" placeholder="Nama Mahasiswa (Penulis)" class="form-control">
                <input type="hidden" name="id" class="form-control">
            </div>
            <div class="form-group">
                <label for="nim">NIM</label>
                <input type="text" name="nim" placeholder="Nomor Induk Mahasiswa" class="form-control">
            </div>
            <div class="form-group">
                <label for="tahun">Tahun Tugas Akhir</label>
                <input type="text" name="tahun" placeholder="Tahun" class="form-control">
            </div>
            <div class="form-group">
                <label for="judul">Judul Tugas Akhir</label>
                <input type="text" name="judul" placeholder="Judul" class="form-control">
            </div>
            <div class="form-group">
                <label for="judul">Lokasi</label>
                <input type="hidden" id="lokasi_sekarang" name="lokasi_sekarang">
                <div class="row">
                  <div class="col">
                    <select name="lokasi_alpha_edit" id="lokasi_alpha_edit" class="custom-select">
                      <option value="arsip">Arsip</option>
                      <option value="a">A</option>
                      <option value="b">B</option>
                      <option value="c">C</option>
                      <option value="d">D</option>
                      <option value="e">E</option>
                      <option value="f">F</option>
                      <option value="g">G</option>
                      <option value="h">H</option>
                      <option value="i">I</option>
                    </select>
                    <div class="valid-feedback">
                      Lokasi dapat digunakan!
                    </div>
                    <div class="invalid-feedback">
                      Lokasi tidak dapat digunakan!
                    </div>
                  </div>
                  <div class="col">
                    <select name="lokasi_numeric_edit" id="lokasi_numeric_edit" class="custom-select">
                      <option value="">-</option>
                      <option value="1">1</option>
                      <option value="2">2</option>
                      <option value="3">3</option>
                      <option value="4">4</option>
                      <option value="5">5</option>
                      <option value="6">6</option>
                      <option value="7">7</option>
                      <option value="8">8</option>
                      <option value="9">9</option>
                      <option value="10">10</option>
                      <option value="11">11</option>
                      <option value="12">12</option>
                      <option value="13">13</option>
                      <option value="14">14</option>
                      <option value="15">15</option>
                      <option value="16">16</option>
                    </select>
                  </div>
                  <div class="col-2">
                    <button class="btn btn-info" id="btn_cek_lokasi_edit">Cek</button>
                  </div>
                </div>
            </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <input type="submit" id="btn_update" value="Simpan" class="btn btn-primary">
    </div>
    </form>
    </div>
</div>
</div>
<!-- akhir modal edit data -->

<!-- modal hapus data -->
<div class="modal fade" id="modal_hapus" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Hapus Dokumen?</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <form id="form_hapus">
        <input type="hidden" name="id_hapus" id="id_hapus">
        <input type="hidden" name="id_lokasi" id="id_lokasi">
        <div id="div_hapus"></div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" id="btn_hapus" class="btn btn-danger">Hapus</button>
      </form>
      </div>
    </div>
  </div>
</div>
<!-- akhir modal hapus data -->


