
       

    <!-- kontainer utama -->
    <div class="container mt-2 mb-1">
        <div class="row mt-2" style="background-color: #ececec; padding-bottom: 20px;">
            <div class="col">
                <h1 class="text-center">Katalog Koleksi Tugas Akhir</h1>
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
                            <?php if(isset($keyword)){
                            ?>
                                <tr>
                                    <td rowspan=2>
                                        <input type="text" value="<?php echo isset($keyword_term)?"Katadasar: ".implode(' ',$keyword_term):'';?>" id="keyword_term" style="background-color:transparent; border:0; font-size: 0.9em; width:100%;" readonly>
                                    </td>
                                </tr>         
                            <?php
                            }
                            ?>           

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
                                        <th>Custom</th>
                                        <td id="header_daftar_dokumen">
                                            <?php
                                                if (isset($keyword)){
                                            ?>
                                                Ditemukan <?= sizeof($koleksi_skripsi) ?> hasil pencarian untuk "<b><?= $keyword ?></b>" <?= $waktu_pencarian.' detik' ?>. <h6 style="display: inline-block;" id="show_filter"></h6><a id ="clearFilter" href="javascript:void(0)"></a>
                                            <?php 
                                                }
                                                else{
                                            ?>
                                                 Koleksi Tugas Akhir <h6 style="display: inline-block;" id="show_filter"></h6><a id ="clearFilter" href="javascript:void(0)"></a>
                                            <?php
                                                }
                                            ?>
                                            <br>
                                            <div class="form-group row" style="float:right; margin-bottom:0;">
                                                <label for="nimNama" class="col-sm-2 col-form-label">Cari</label>
                                                <div class="col-sm-10">
                                                    <input type="text" placeholder="Cari NIM atau Nama" id="nimNama" size="20" class="form-control form-control-sm">
                                                </div>
                                            </div> 
                                        </td>
                                        <th>Cosim</th>
                                        <th>Tahun</th>
                                        <th>Prodi</th>
                                        <th>Filter</th>
                                        <th>Nim</th>
                                        <th>Nama</th>
                                    </tr>
                                </thead>
                                    
                                <tbody>
                                
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <!-- akhir kontainer item dokumen -->
                
                <!-- awal modal meta -->
                <!-- Button trigger modal -->
                <!-- Modal -->
                <div class="modal fade" id="modalMeta" tabindex="-1" role="dialog" aria-labelledby="modalMeta" aria-hidden="true">
                    <div class="modal-dialog modal-lg" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Meta Data Dokumen</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                            </div>
                            <div class="modal-body">
                                <table width="100%">
                                    <tr style="border-bottom:1px solid #a9a9a9; border-top: 1px solid #a9a9a9">
                                        <td rowspan="7" style="width:120px; height:135px;">
                                            <img src="" alt="" id="thumbnailSkripsiMeta">
                                        </td>
                                        <td class="align-text-bottom" rowspan="7" width="7px"></td>
                                        <td class="align-text-bottom" width="120px"><h6>Judul</h6></td>
                                        <td class="align-text-bottom">:</td>
                                        <td class="align-text-bottom"><h6 id="meta_judul"></h6></td>
                                    </tr>
                                    <tr style="border-bottom:1px solid #a9a9a9">
                                        <td class="align-text-bottom"><h6>Fakultas</h6></td>
                                        <td class="align-text-bottom">:</td>
                                        <td class="align-text-bottom"><h6 id="meta_fakultas"></h6></td>
                                    </tr>
                                    <tr style="border-bottom:1px solid #a9a9a9">
                                        <td class="align-text-bottom"><h6>Program Studi</h6></td>
                                        <td class="align-text-bottom">:</td>
                                        <td class="align-text-bottom"><h6 id="meta_prodi"></h6></td>
                                    </tr>
                                    <tr style="border-bottom:1px solid #a9a9a9">
                                        <td class="align-text-bottom"><h6>Penulis</h6></td>
                                        <td class="align-text-bottom">:</td>
                                        <td class="align-text-bottom"><h6 id="meta_penulis"></h6></td>
                                    </tr>
                                    <tr style="border-bottom:1px solid #a9a9a9">
                                        <td class="align-text-bottom"><h6>No. Induk Mhs</h6></td>
                                        <td class="align-text-bottom">:</td>
                                        <td class="align-text-bottom"><h6 id="meta_nim"></h6></td>
                                    </tr>
                                    <tr style="border-bottom:1px solid #a9a9a9">
                                        <td class="align-text-bottom"><h6>Tahun Terbit</h6></td>
                                        <td class="align-text-bottom">:</td>
                                        <td class="align-text-bottom"><h6 id="meta_tahun"></h6></td>
                                    </tr>
                                    <tr style="border-bottom:1px solid #a9a9a9">
                                        <td class="align-text-bottom"><h6>Lokasi Rak</h6></td>
                                        <td class="align-text-bottom">:</td>
                                        <td class="align-text-bottom"><h6 id="meta_lokasi">G.4</h6></td>
                                    </tr>
                                </table>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- akhir modal meta -->

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
                        <?php 
                            for ($tahun=2020; $tahun >= 2015; $tahun--) { 
                        ?>
                        <tr>
                            <td class="td_sidebar">
                                <a href="javascript:void(0);" onclick="filter_(<?= $tahun ?>,'','')" ><?= $tahun ?> (<?= $numTahun[$tahun] ?>)</a>
                            </td>
                        </tr>
                        <?php
                            }
                        ?>
                    </table>
                    <!-- akhir tabel tahun -->

                    <!-- tabel program studi -->
                    <table width="100%" border="0">
                        <tr>
                            <th class="text-center">Program Studi</th>
                        </tr>
                        <?php 
                            foreach ($fakultas as $fak) {
                        ?>
                            <th class="text-center">
                                <?= $fak["desc_fak"] ?>
                            </th>
                        <?php
                                foreach ($prodi[$fak["kode_fak"]] as $pro) {
                        ?>
                                    <tr>
                                        <td class="td_sidebar">
                                            <a href="javascript:void(0);" onclick="filter_('','<?= $pro['kode_prodi'] ?>','<?= $pro['desc_prodi'] ?>')"><?= $pro['desc_prodi'] ?> (<?= $numProdi[$pro['kode_prodi']]?>)</a>
                                        </td>
                                    </tr>
                        <?php
                                }
                            }
                        ?>
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