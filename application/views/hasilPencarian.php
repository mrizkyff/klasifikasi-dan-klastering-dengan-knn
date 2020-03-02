<!-- judul halaman -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Hasil Pencarian '<?php echo $pencarian?>'</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Dashboard - Hasil Pencarian</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
<!-- akhir judul halaman -->


<!-- konten -->
	<section class="content">
		<button class="btn btn-primary" data-toggle="modal" data-target="#tambahData" style="float: right;"><i class="fa fa-plus"></i>Tambah Dokumen Skripsi</button>
		<table class="table" width="1150px">
			<tr align="center">
				<th>No</th>
				<th>Doc ID</th>
				<th>Judul</th>
				<th>Penulis</th>
				<th>Tahun</th>
				<th>Abstrak</th>
				<th colspan="3">Action</th>
                <th>Rank VSM</th>
			</tr>

			<?php
				$no = 1;
				foreach ($skripsi as $dt):
                    if ($dt->bobot!=0) {
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
				<td><?php echo $abstrak ?><a href="#" data-toggle="modal" data-target="#detail<?php echo $dt->id ?>">[... Lanjutkan Membaca]</a>
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
				</td>
				<td><a href="<?php echo base_url() ?>upload/<?php echo $dt->file ?>" class="btn btn-success" style="padding-left: 40px; padding-right: 40px;"><i class="fa fa-download"></i></a></td>
				<td><a href="" class="btn btn-primary" data-toggle="modal" data-target="#editData<?php echo $dt->id?>"><i class="fa fa-edit"></i></a></td>
				<td><a href="<?php echo base_url().'index.php/skripsi/hapusAksi/'.'?id='.$dt->id?>" class="btn btn-danger"><i class="fa fa-eraser"></i></a></td>
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
                <!-- tampilkan bobot -->
                <td>
                    <?php
                    $bobot = ($dt->bobot*100);
                    echo $bobot ?>%
                </td>
                <!-- akhir tampilkan bobot -->
			</tr>
			<?php
                }
				endforeach;
			?>
		</table>
	</section>
<!-- akhir konten -->


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


