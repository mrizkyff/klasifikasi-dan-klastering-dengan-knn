<!-- judul halaman -->
<div class="content-wrapper">


    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Analisa Metode</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Analisa Metode</li>
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
      <h3 class="card-title">Analisa</h3>
    </div>
      <!-- /.card-header -->

      <div class="card-body">
      <!-- form untuk melakukan pengujian -->
      <div class="container">
        <form id="formDokumen">
            <div class="form-group">
                <label for="query">Query</label>
                <input type="text" name='query' id='query' placeholder="Query Pencarian" class="form-control" value='semarang panas'>
            </div>
            <div class="form-group">
                <label for="doc1">Dokumen 1</label>
                <input type="text" name='doc1' id='doc1' placeholder="Teks Dokumen 1" class="form-control" value='salatiga dingin'>
            </div>
            <div class="form-group">
                <label for="doc2">Dokumen 2</label>
                <input type="text" name='doc2' id='doc2' placeholder="Teks Dokumen 2" class="form-control" value='solo sultan'>
            </div>
            <div class="kotakDokumen">
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <button class="btn btn-secondary float-right" id="btnProses">Proses</button>
                    <button class="btn btn-info float-right mr-3" id="btnAddDokumen"><i class="fas fa-plus"></i> Tambah Dokumen</button>
                </div>
            </div>
        </form> 
      </div>
      <!-- akhir form untuk melakukan pengujian -->

      <div class="container mt-5 mainContainerPerhitungan">
        <h3 class="text-center">Perhitungan Algoritma</h3>
        <div class="table-responsive">
            <h5>Langkah 1 Preprocessing</h5>
            <table id="tabel1" class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th width="50px">No.</th>
                        <th width="150px">Id Dokumen</th>
                        <th>Kata Baku</th>
                    </tr>
                </thead>
                <tbody id="showTabelPrep"> 
                </tbody>
            </table>
        </div>
      </div>

      <div class="container mt-5 mainContainerPerhitungan">
        <div class="table-responsive">
            <h5>Langkah 2.1 Perhitungan TF</h5>
            <table id="tabel1" class="table table-striped table-bordered">
                <thead id="headTabelTf">
                </thead>
                <tbody id="showTabelTf"> 
                </tbody>
            </table>
        </div>
      </div>

    </div>
      <!-- /.card-body -->
    </div>
    <!-- /.card -->
    </div>
  </div>
</div>
<!-- konten utama Dashboard -->






