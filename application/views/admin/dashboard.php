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
            <h1 class="m-0 text-dark">Dashboard</h1>
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
                          <th>Penulis</th>
                          <th>Tahun</th>
                          <th>Judul</th>
                          <th>Waktu</th>
                          <th width='11%'>Aksi</th>
                      </tr>
                  </thead>


                  <tfoot>
                      <tr>
                          <th>No.</th>
                          <!-- <th>No</th> -->
                          <th>Penulis</th>
                          <th>Tahun</th>
                          <th>Judul</th>
                          <th>Waktu</th>
                          <th>Aksi</th>
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
                <label for="minat">Minat</label>
                <select name="minat" class="form-control">
                  <option value="">Pilih...</option>
                  <option value="sc">Sistem Cerdas</option>
                  <option value="rpl">Rekayasa Perangkat Lunak</option>
                </select>
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
                <label for="minat">Minat</label>
                <select name="minat" class="form-control">
                  <option value="">Pilih...</option>
                  <option value="sc">Sistem Cerdas</option>
                  <option value="rpl">Rekayasa Perangkat Lunak</option>
                </select>
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


