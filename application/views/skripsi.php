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
            <table id="example" class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>id</th>
                        <th>Judul</th>
                        <th>Penulis</th>
                        <th>Tahun</th>
                        <th>Abstrak</th>
                        <th width='200px'>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                  <?php
                    $no = 0;
                    foreach ($skripsi as $dt):
                    $len = strlen($dt->abstrak);
                            $abstrak = $dt->abstrak;
                            if($len<100){
                                $len = $len;
                            }
                            else if ($len <= 100){
                                $len = $len/2;
                            }
                            else if($len >100 && $len<=300){
                                $len = $len/4;
                            }
                            else{
                                $len = $len/6;
                            }
                            $abstrak = substr($abstrak,0,$len);
                    $no++; 
                  ?>
                    <tr>
                      <td><?php echo $no ?></td>
                      <td><?php echo $dt->id ?></td>
                      <td><?php echo $dt->judul ?></td>
                      <td><?php echo $dt->penulis ?></td>
                      <td><?php echo $dt->tahun ?></td>
                      <td><?php echo $abstrak ?><a href="#detail<?php echo $dt->id ?>" data-toggle="collapse" role="button" aria-expanded="false" aria-controls="collapseExample">[... Lanjutkan Membaca]</a>
                        <div class="collapse" id="detail<?php echo $dt->id ?>">
                          <div class="card card-body">
                            <?php echo $dt->abstrak ?>
                          </div>
                    </div>
                      
                      
                      </td>
                      <!-- modal details -->
                      <div class="modal fade bd-example-modal-xl" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true" id="detail<?php echo $dt->id?>">
                        <div class="modal-dialog modal-xl" role="document">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h5 class="modal-tittle">Detail Abstrak</h5>
                              <button type="button" class="close" data-dismiss="modal">
                                <span>&times;</span>
                              </button>
                            </div>
                            <div class="modal-body">
                              <blockquote>
                                <?php echo $dt->abstrak ?>
                              </blockquote>
                            </div>
                            <div class="modal-footer">
                                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                  </div>
                          </div>
                        </div>
                      </div>
                      <!-- akhir modal details -->
                      <td valign="middle">
                              
                            <ul class="list-inline">
                              <li class="list-inline-item"><a href="<?php echo base_url() ?>upload/<?php echo $dt->file ?>" class="text-success" ><h4><i class="fa fa-download"></h4></i></a></li>
                              <li class="list-inline-item"><a href="#" class="text-primary" data-toggle="modal" data-target="#editData<?php echo $dt->id?>"><h4><i class="fa fa-edit"></h4></i></a></li>
                              <li class="list-inline-item"><a href="<?php echo base_url().'index.php/skripsi/hapusAksi/'.'?id='.$dt->id?>" class="text-danger"><h4><i class="fa fa-eraser"></h4></i></a></li>
                              <?php
                              // cek kondisi download
                              if ($dt->download == 0){
                                ?>
                                  <li class="list-inline-item"><a href="<?php echo base_url().'index.php/skripsi/lock/'.'?id='.$dt->id.'&status='.$dt->download?>" class="text-danger"><h4><i class="fa fa-lock"></h4></i></a></li>
                                  <?php
                                }
                              else if($dt->download == 1){
                                ?>
                                  <li class="list-inline-item"><a href="<?php echo base_url().'index.php/skripsi/lock/'.'?id='.$dt->id.'&status='.$dt->download?>" class="text-success"><h4><i class="fa fa-lock-open"></h4></i></a></li>
                                  <?php
                              }
                                
                              // cek kondisi show
                              if ($dt->show == 0){
                                ?>
                                  <li class="list-inline-item"><a href="<?php echo base_url().'index.php/skripsi/show/'.'?id='.$dt->id.'&status='.$dt->show?>" class="text-secondary"><h4><i class="fa fa-eye-slash"></h4></i></a></li>
                                  <?php
                              }
                              else if($dt->show == 1){
                                ?>
                                  <li class="list-inline-item"><a href="<?php echo base_url().'index.php/skripsi/show/'.'?id='.$dt->id.'&status='.$dt->show?>" class="text-secondary"><h4><i class="fa fa-eye"></h4></i></a></li>
                                  <?php
                              }
                              ?>
                            </ul>
                      </td>
                      <!-- Modal Edit Data-->
                        <div class="modal fade" id="editData<?php echo $dt->id?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Edit Data</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form action="updateAksi" method="POST">
                                    <div class="form-group">
                                        <label for="penulis">Penulis</label>
                                        <input type="text" name="penulis" placeholder="Penulis" class="form-control" value="<?php echo $dt->penulis ?>">
                                        <input type="hidden" name="id" value="<?php echo $dt->id?>">
                                    </div>
                                    <div class="form-group">
                                        <label for="tahun">Tahun</label>
                                        <input type="text" name="tahun" placeholder="Tahun" class="form-control" value="<?php echo $dt->tahun ?>">
                                    </div>
                                    <div class="form-group">
                                        <label for="judul">Judul</label>
                                        <input type="text" name="judul" placeholder="Judul" class="form-control" value="<?php echo $dt->judul ?>">
                                    </div>
                                    <div class="form-group">
                                        <label for="abstrak">Abstrak</label>
                                        <textarea name="abstrak" id="" cols="20" rows="10" placeholder="Abstrak" class="form-control"><?php echo $dt->abstrak ?></textarea>
                                    </div>
                                
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <input type="submit" name="update" value="Simpan" class="btn btn-primary">
                            </div>
                            </form>
                            </div>
                        </div>
                        </div>
                        <!-- akhir modal edit data -->
                    </tr>
                  <?php
                    endforeach;
                  ?>
                </tbody>
                <tfoot>
                    <tr>
                        <th>No.</th>
                        <th>id</th>
                        <th>Judul</th>
                        <th>Penulis</th>
                        <th>Tahun</th>
                        <th>Abstrak</th>
                        <th>Aksi</th>
                    </tr>
                </tfoot>
    </table>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
</div>


<!-- Modal -->
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


