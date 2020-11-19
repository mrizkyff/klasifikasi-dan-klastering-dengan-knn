<!doctype html>
<html lang="en">
  <head>
  	<!-- custom style -->
  	<style>
  		.td_sidebar {
  			border-bottom: 1px dashed red;
  		}	
  	</style>

    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">

    <title>Hello, world!</title>
  </head>
  <body>

        <!-- awal navbar -->
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
          <div class="container">
            <a class="navbar-brand" href="#">Perpustakaan Udinus</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                <li class="nav-item active">
                    <a class="nav-link" href="<?php echo base_url()?>">Koleksi TA <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">About</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo base_url('admin')?>">Administrator</a>
                </li>
                </ul>
            </div>
          </div>
        </nav>
        <!-- akhir navbar -->

    <!-- kontainer utama -->
    <div class="container mt-2 mb-1">
        <div class="row mt-2" style="background-color: #ececec; padding-bottom: 20px;">
            <div class="col">
                <h1 class="text-center">LOGO PERPUSTAKAAN</h1>
                <div class="container">
                    <form action="<?php echo base_url().'search/index'?>" method='get'>
                        <table border="0" style="margin-left: auto; margin-right: auto; width: 80%;">
                            <tr>
                                <td>
                                    <input type="text" class="form-control form-control-sm" id="search" name='query' value='<?php echo isset($keyword)?$keyword:''?>' placeholder="Judul Dokumen">
                                </td>
                                <td >
                                    <button type="submit" class="btn btn-primary btn-sm">Cari</button>
                                </td>
                            </tr>                    
                        </table>
                    <form>
                </div>
            </div>
        </div>

        <!-- awal kontainer baris hasil pencarian -->
        <div class="row mt-2">
            <!-- awal kontainer kolom hasil pencarian -->
            <!-- warna kuning -->
            <div class="col" style="background-color: #ffefd8">
                <!-- awal kontainer item dokumen -->
                <div class="container mb-2 mt-2">
                    <div class="row">
                        <div class="table-responsive">
                            <table border='0' id='daftar_dokumen' width="100%">
                                <thead>
                                    <tr>
                                        <td>
                                            <?php
                                                if (isset($keyword)){
                                            ?>
                                                <p>Ditemukan <?= sizeof($koleksi_skripsi) ?> hasil pencarian untuk "<b><?= $keyword ?></b>" <?= $waktu_pencarian.' detik' ?>.</p>
                                            <?php 
                                                }
                                            ?>
                                        </td>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php
                                    if(isset($koleksi_skripsi)){
                                        foreach ($koleksi_skripsi as $data) {
                                ?>
                                    <tr>
                                        <td>
                                            <!-- warna orange -->
                                            <table border='0' width='100%' style="background-color: #fed9c9" class='mt-1'>
                                                <tr>
                                                    <td rowspan='5' width='100px'>
                                                        <!-- warna biru, sesuai fakultas -->
                                                        <div style="width: 80px; height: 120px; background-color: #ACDDDE">
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <a href="#"><?= $data->judul?></a>
                                                        <p class='text-gray'>(<?= ($data->cosim*100).'%'?>)</p class='text-gray'>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <h6><?= $data->penulis.' - '.$data->nim?></h5>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <!-- prodi sesuai pada db -->
                                                        <h6>Teknik Informatika - S1</h6>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <div class="row mr-0">
                                                            <div class="col">
                                                                <h6><?= $data->tahun?></h6>
                                                            </div>
                                                            <div class="col">
                                                                <a href="#" class="float-right">Download File</a>
                                                                <a class="float-right">&nbsp | &nbsp</a>
                                                                <a href="#" class="float-right">Meta</a>
                                                            </div>  
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                    
                                                    </td>
                                                </tr>
                                            </table>
                                        </td>
                                    </tr>
                                <?php        
                                        }
                                    }
                                ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <!-- akhir kontainer item dokumen -->
                
            </div>
            <!-- akhir kontainer kolom hasil pencarian -->

            <!-- awal kontainer sidebar kanan -->
            <div class="col-3" style="background-color: #caf1de">
                <!-- awal kontainer dalam sidebar -->
                <div class="container mb-2 mt-2" style="background-color: #ffdde4">
                    <!-- tabel tahun -->
                    <table border="0" width="100%">
                        <tr>
                            <th class="text-center">Tahun</th>
                        </tr>
                        <tr>
                            <td class="td_sidebar">
                                <a href="#">2020</a>
                            </td>
                        </tr>
                        <tr>
                            <td class="td_sidebar">
                                <a href="#">2019</a>
                            </td>
                        </tr>
                        <tr>
                            <td class="td_sidebar">
                                <a href="#">2018</a>
                            </td>
                        </tr>
                        <tr>
                            <td class="td_sidebar">
                                <a href="#">2017</a>
                            </td>
                        </tr>
                        <tr>
                            <td class="td_sidebar">
                                <a href="#">2016</a>
                            </td>
                        </tr>
                        <tr>
                            <td class="td_sidebar">
                                <a href="#">2015</a>
                            </td>
                        </tr>
                    </table>
                    <!-- akhir tabel tahun -->

                    <!-- tabel program studi -->
                    <table width="100%" border="0">
                        <tr>
                            <th class="text-center">Program Studi</th>
                        </tr>
                        <tr>
                            <th class="text-center">
                                Fakultas Ilmu Komputer
                            </th>
                        </tr>
                        <tr>
                            <td class="td_sidebar">
                                <a href="#">Teknik Informatika - S1</a>
                            </td>
                        </tr>
                        <tr>
                            <td class="td_sidebar">
                                <a href="#">Sistem Informasi - S1</a>
                            </td>
                        </tr>
                        <tr>
                            <td class="td_sidebar">
                                <a href="#">Desain Komunikasi Visual - S1</a>
                            </td>
                        </tr>
                        <tr>
                            <td class="td_sidebar">
                                <a href="#">Ilmu Komunikasi - S1</a>
                            </td>
                        </tr>
                        <tr>
                            <td class="td_sidebar">
                                <a href="#">Animasi - S1</a>
                            </td>
                        </tr>
                        <tr>
                            <td class="td_sidebar">
                                <a href="#">Film dan Televisi - D4</a>
                            </td>
                        </tr>
                        <tr>
                            <td class="td_sidebar">
                                <a href="#">Teknik Informatika - D3</a>
                            </td>
                        </tr>
                        <tr>
                            <td class="td_sidebar">
                                <a href="#">Broadcasting - D3</a>
                            </td>
                        </tr>
                        <tr>
                            <th class="text-center">
                                Fakultas Ekonomi dan Bisnis
                            </th>
                        </tr>
                        <tr>
                            <td class="td_sidebar">
                                <a href="#">Manajemen - S1</a>
                            </td>
                        </tr>
                        <tr>
                            <td class="td_sidebar">
                                <a href="#">Akuntansi - S1</a>
                            </td>
                        </tr>
                        <tr>
                            <th class="text-center">
                                Fakultas Ilmu Budaya
                            </th>
                        </tr>
                        <tr>
                            <td class="td_sidebar">
                                <a href="#">Sastra Inggris - S1</a>
                            </td>
                        </tr>
                        <tr>
                            <td class="td_sidebar">
                                <a href="#">Sastra Jepang - S1</a>
                            </td>
                        </tr>
                        <tr>
                            <td class="td_sidebar">
                                <a href="#">Manajemen Perhotelan - D4</a>
                            </td>
                        </tr>
                        <tr>
                            <th class="text-center">
                                Fakultas Kesehatan
                            </th>
                        </tr>
                        <tr>
                            <td class="td_sidebar">
                                <a href="#">Kesehatan Masyarakat - S1</a>
                            </td>
                        </tr>
                        <tr>
                            <td class="td_sidebar">
                                <a href="#">Kesehatan Lingkungan - S1</a>
                            </td>
                        </tr>
                        <tr>
                            <td class="td_sidebar">
                                <a href="#">Rek. Medik & Informasi Kesehatan - D3</a>
                            </td>
                        </tr>
                        <tr>
                            <th class="text-center">
                                Fakultas Teknik
                            </th>
                        </tr>
                        <tr>
                            <td class="td_sidebar">
                                <a href="#">Teknik Elektro - S1</a>
                            </td>
                        </tr>
                        <tr>
                            <td class="td_sidebar">
                                <a href="#">Teknik Industri - S1</a>
                            </td>
                        </tr>
                        <tr>
                            <td class="td_sidebar">
                                <a href="#">Teknik Biomedis - S1</a>
                            </td>
                        </tr>
                    </table>
                    <!-- akhir tabel program studi -->
                </div>
                <!-- akhir kontainer dalam sidebar -->
            </div>
            <!-- akhir kointainer sidebar kanan -->
        </div>
        <!-- akhir kontainer hasil pencarian -->

        <!-- awal kontainer footer -->
        <div class="row mt-2" style="background-color: #ececec;">
            <div class="col mt-2">
                <h6 class="text-center">Perpustakaan Universitas Dian Nuswantoro Semarang - 2020</h6>
            </div>
        </div>
        <!-- akhir kontainer footer -->
    </div>
    <!-- akhir kontainer utama -->


    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>

  </body>
</html>