<!-- judul halaman -->
<div class="content-wrapper">


    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Kelola Rak</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Kelola Rak</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
<!-- akhir judul halaman -->

<!-- konten utama Dashboard -->
<div class="container-fluid">
  <div class="card">
    <div class="card-header">
      <h3 class="card-title">Lokasi Rak<i class="fas fa-rocketchat    "></i></h3>
    </div>
        <!-- /.card-header -->
        <div class="card-body">
        <table id="tabel_rak" class="table">
            <thead >
                <tr>
                    <td>Lokasi Rak</td>
                    <td>Kapasitas</td>
                    <td width="200px">Tersedia</td>
                </tr>
            </thead>
            <tbody>
                <?php
                    foreach ($rak as $r) {
                ?>
                    <tr>
                        <td>
                            <?= $r->lokasi?>
                        </td>
                        <td>
                            <?= $r->kapasitas?>
                        </td>
                        <td>
                        <div class="progress">
                            <div class="progress-bar progress-bar-striped <?php if($r->tersedia/$r->kapasitas >= 0.67){echo "bg-success";} else if($r->tersedia/$r->kapasitas < 0.67 and $r->tersedia/$r->kapasitas >=0.33){echo "bg-warning";} else if($r->tersedia/$r->kapasitas < 0.33 or $r->tersedia == 0){echo "bg-danger";}  ?>" role="progressbar" style="width: <?php if($r->tersedia != 0){echo $r->tersedia/$r->kapasitas*50;}else{echo 2;}?>%" aria-valuenow="<?= $r->tersedia/$r->kapasitas*100 ?>" aria-valuemin="0" aria-valuemax="100">
                                <?= $r->tersedia."/".$r->kapasitas ?>
                            </div>
                        </div>
                        </td>
                    </tr>
                <?php
                    }
                ?>
            </tbody>
        </table>

      



        </div>
        <!-- /.card-body -->
    </div>
    <!-- /.card -->
    </div>
  </div>
</div>
<!-- konten utama Dashboard -->






