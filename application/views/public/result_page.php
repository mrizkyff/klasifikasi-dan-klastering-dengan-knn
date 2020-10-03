<nav class="navbar navbar-primary bg-primary">
  <span class="navbar-text">
    Hasil Pencarian untuk '<?php echo $keyword?>'
  </span>
</nav>
<div class="konten">
    <!-- form pencarian -->
    <div class="main">
        <table width=100%>
            <tr>
                <td><img src="<?php echo base_url() ?>asset/img/logoRepository.png" alt="DNRepository" class="img-fluid"></td>
            </tr>
            <tr height='15px'>
                <td></td>
            </tr>
            <form action="<?php echo base_url().'index.php/search/cari'?>" method='get'>
            <tr>
                <td>
                    <div class="input-group">
                        <input type="text" class="form-control" placeholder="Cari Judul Tugas Akhir" name='query' value='<?php echo $keyword ?>'>
                        <div class="input-group-append">
                        <button class="btn btn-primary" type="submit">
                            <i class="fa fa-search"></i>
                        </button>
                        </div>
                    </div>
                </td>
            </tr>
            </form>
        </table>
    
    </div>
    <!-- akhir form pencarian -->


    <!-- datatables -->
    <table id="tabel_hasil_pencarian">
                <thead>
                    <tr>
                        <td><b> Hasil Pencarian </b> <i>(<?= $waktu_pencarian ?>) detik.</i></td>
                        
                    </tr>
                    </thead>
                <tbody>
                <?php
                    foreach ($koleksi_skripsi as $data){
                ?>
                    <tr>
                        <td>
                            <div class="card">
                                <div class="card-body">
                                        <div class="d-flex flex-column bd-highlight mb-3">
                                            <div class="p-0 bd-highlight">
                                                <a href="<?php echo base_url()?>upload/<?php echo $data->file?>" target="_blank" rel="noopener noreferrer">
                                                    <p style='color: blue;'><?php echo $data->judul ?> <span class="badge badge-secondary"><?= $data->minat ?></span></p><p class='text-secondary'><i>(Kemiripan Kata Kunci <?php echo $data->cosim*100 ?>%)</i></p>
                                                </a>
                                            </div>
                                            <div class="p-0 bd-highlight">
                                                <div class="d-flex flex-row-reverse bd-highlight">
                                                    <div class="p-2 bd-highlight"><?php echo $data->tahun ?></div>
                                                    <div class="p-2 bd-highlight"><?php echo $data->penulis ?> || <?= $data->nim ?></div>
                                                </div>
                                            </div>
                                        </div>
                                </div>
                            </div>
                        </td>
                    </tr>

                <?php
                    }
                ?>

                   
                </tbody>
                <tfoot>
                    <tr>    
                        <th>Hasil Pencarian. </th>
                       
                    </tr>
                </tfoot>
            </table>

        <!-- akhir datatables -->

</div>