<!-- judul halaman -->
<div class="content-wrapper">


    <!-- notifiaksi -->
        <!-- tambah -->
          <?php if($this->session->flashdata('sukses_tambah') ==  TRUE){ ?>
              <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong><p><?php echo $this->session->flashdata('sukses_tambah') ?></p></strong>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
          <?php }
          else if($this->session->flashdata('gagal_tambah') ==  TRUE){
          ?>
          <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong><p><?php echo $this->session->flashdata('gagal_tambah') ?></p></strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <?php
          }
          ?>
        <!-- /.tambah -->

        <!-- edit -->
          <?php if($this->session->flashdata('sukses_edit') ==  TRUE){ ?>
                <div class="alert alert-info alert-dismissible fade show" role="alert">
                  <strong><p><?php echo $this->session->flashdata('sukses_edit') ?></p></strong>
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
            <?php }
            else if($this->session->flashdata('gagal_edit') ==  TRUE){
            ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
              <strong><p><?php echo $this->session->flashdata('gagal_edit') ?></p></strong>
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <?php
            }
            ?>
        <!-- /.edit -->

        <!-- hapus -->
          <?php if($this->session->flashdata('sukses_hapus') ==  TRUE){ ?>
                <div class="alert alert-info alert-dismissible fade show" role="alert">
                  <strong><p><?php echo $this->session->flashdata('sukses_hapus') ?></p></strong>
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
            <?php }
            else if($this->session->flashdata('gagal_hapus') ==  TRUE){
            ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
              <strong><p><?php echo $this->session->flashdata('gagal_hapus') ?></p></strong>
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <?php
            }
            ?>
        <!-- /.hapus -->

        <!-- lock -->
        <?php if($this->session->flashdata('sukses_lock') ==  TRUE){ ?>
                <div class="alert alert-info alert-dismissible fade show" role="alert">
                  <strong><p><?php echo $this->session->flashdata('sukses_lock') ?></p></strong>
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
            <?php }
            else if($this->session->flashdata('gagal_lock') ==  TRUE){
            ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
              <strong><p><?php echo $this->session->flashdata('gagal_lock') ?></p></strong>
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <?php
            }
            ?>
        <!-- /.lock -->

        <!-- show -->
          <?php if($this->session->flashdata('sukses_show') ==  TRUE){ ?>
                <div class="alert alert-info alert-dismissible fade show" role="alert">
                  <strong><p><?php echo $this->session->flashdata('sukses_show') ?></p></strong>
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
            <?php }
            else if($this->session->flashdata('gagal_show') ==  TRUE){
            ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
              <strong><p><?php echo $this->session->flashdata('gagal_show') ?></p></strong>
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <?php
            }
            ?>
        <!-- /.show -->
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


<div class="card">
  <div class="card-header">
    <h3 class="card-title">Kelola Database Repository</h3>
    <button class="btn btn-primary" data-toggle="modal" data-target="#tambahData" style="float: right;"><i class="fa fa-plus"></i>Tambah Dokumen ke Repository</button>
  </div>
    <!-- /.card-header -->
    <div class="card-body">
      <table id="tabel_data_dashboard" class="table table-striped table-bordered">

          <thead>
              <tr>
                  <th>No.</th>
                  <!-- <th>No</th> -->
                  <th>Penulis</th>
                  <th>Tahun</th>
                  <th>Judul</th>
                  <th>Jurusan</th>
                  <th>Abstrak</th>
                  <th width='200px'>Aksi</th>
              </tr>
          </thead>


          <tfoot>
              <tr>
                  <th>No.</th>
                  <!-- <th>No</th> -->
                  <th>Penulis</th>
                  <th>Tahun</th>
                  <th>Judul</th>
                  <th>Jurusan</th>
                  <th>Abstrak</th>
                  <th width='200px'>Aksi</th>
              </tr>
          </tfoot>

      </table>
    </div>
    <!-- /.card-body -->
  </div>
  <!-- /.card -->
  </div>
</div>





<!-- Modal tambah data-->
<div class="modal fade" id="tambahData" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modal Tambah Data</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <!-- <form action="<?php echo base_url().'skripsi/do_upload' ?>" method="POST" enctype="multipart/form-data"> -->
        	<?php echo form_open_multipart('skripsi/do_upload') ?>
            <div class="form-group">
                <label for="penulis">Penulis</label>
                <input type="text" name="penulis" placeholder="Penulis" class="form-control">
            </div>
            <div class="form-group">
                <label for="tahun">Tahun</label>
                <input type="text" name="tahun" placeholder="Tahun" class="form-control">
            </div>
            <div class="form-group">
                <label for="judul">Judul</label>
                <input type="text" name="judul" placeholder="Judul" class="form-control">
            </div>
            <div class="form-group">
                <label for="abstrak">Abstrak</label>
                <textarea name="abstrak" id="" cols="20" rows="10" placeholder="Abstrak" class="form-control"></textarea>
            </div>
            <div class="form-group">
                <label for="file">File (PDF) :</label>
                <input type="file" name="fileupload">
            </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <input type="submit" name="upload" value="Simpan" class="btn btn-primary">
      </div>
      <?php echo form_close() ?>
      <!-- </form> -->
    </div>
  </div>
</div>
</div>

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
                <input type="text" name="penulis" placeholder="Penulis" class="form-control">
                <input type="hidden" name="id" class="form-control">
            </div>
            <div class="form-group">
                <label for="tahun">Tahun</label>
                <input type="text" name="tahun" placeholder="Tahun" class="form-control">
            </div>
            <div class="form-group">
                <label for="judul">Judul</label>
                <input type="text" name="judul" placeholder="Judul" class="form-control">
            </div>
            <div class="form-group">
                <label for="abstrak">Abstrak</label>
                <textarea name="abstrak" id="" cols="20" rows="10" placeholder="Abstrak" class="form-control"></textarea>
            </div>
            <div class="form-group">
                <label for="jurusan">Penjurusan</label>
                <select name="jurusan" id="jurusan" class="form-control">
                  <option value="">Pilih...</option>
                  <option value="SC">Sistem Cerdas</option>
                  <option value="RPL">Rekayasa Perangkat Lunak</option>
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


