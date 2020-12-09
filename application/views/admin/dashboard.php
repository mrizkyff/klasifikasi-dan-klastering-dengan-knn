<!-- judul halaman -->
<div class="content-wrapper">


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
              <li class="breadcrumb-item active">Dashboard</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
<!-- akhir judul halaman -->

<!-- konten utama Dashboard -->
<div class="container-fluid">

    <div class="row">
      <div class="col">
              <!-- PIE CHART -->
              <div class="card card">
                <div class="card-header">
                  <h3 class="card-title">Jumlah Keseluruhan Dokumen</h3>
                  <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                    </button>
                    <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i></button>
                  </div>
                </div>
                <div class="card-body">
                  <h1>Total: <?= $total_doc ?> dokumen</h1>
                </div>
                <!-- /.card-body -->
              </div>
              <!-- /.card -->
          </div>
      </div>

    <!-- awal row -->
    <div class="row">
        <!-- col per prodi -->
        <div class="col">
            <!-- PIE CHART -->
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Grafik Dokumen setiap Prodi</h3>
                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                  </button>
                  <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i></button>
                </div>
              </div>
              <div class="card-body">
                <div id="chartProdi" style="height: 500px; width: 100%;"></div>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>

        <!-- col per fakultas -->
        <div class="col">
            <!-- PIE CHART -->
            <div class="card card">
              <div class="card-header">
                <h3 class="card-title">Grafik Dokumen setiap Tahun</h3>
                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                  </button>
                  <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i></button>
                </div>
              </div>
              <div class="card-body">
                <div id="chartTahun" style="height: 500px; width: 100%;"></div>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>
    </div>
    <!-- akhir row -->


    <div class="row">
        <div class="col">
            <!-- PIE CHART -->
            <div class="card card">
              <div class="card-header">
                <h3 class="card-title">Ketersediaan Rak</h3>
                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                  </button>
                  <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i></button>
                </div>
              </div>
              <div class="card-body">
                  <div id="chartRak" style="height: 450px; width: 100%;"></div>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>
    </div>
</div>
    
    
<!-- konten utama Dashboard -->

