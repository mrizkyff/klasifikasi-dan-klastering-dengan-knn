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
                        if(($data->bobot != 0) && ($data->show != 0)){
                            $len = strlen($data->abstrak);
                            $abstrak = $data->abstrak;
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
                            ?>

                            <tr>
                                <td>

                                    <div class="card">
                                        <div class="card-body">
                                        
                                                <div class="d-flex flex-column bd-highlight mb-3">
                                                    <div class="p-0 bd-highlight"><p style='color: blue;'><?php echo $data->judul ?> <span class="badge badge-secondary"><?= $data->label ?></span></p><p class='text-secondary'><i>(Kemiripan Kata Kunci <?php echo $data->bobot*100 ?>%)</i></p></div>
                                                <div class="p-0 bd-highlight"><p class='text-md-left'><?php echo $abstrak ?><a href="#" data-toggle='modal' data-target='#detail<?php echo $data->id?>'>[...Baca Abstrak]</a></p></div>
                                                <!-- modal details -->
                                                <div class="modal fade bd-example-modal-xl" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true" id="detail<?php echo $data->id?>">
                                                    <div class="modal-dialog modal-xl" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-tittle">Detail Abstrak</h5>
                                                            <button type="button" class="close" data-dismiss="modal">
                                                                <span>&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <p class="text-justify">
                                                                <?php echo $data->abstrak ?>
                                                            </p>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- akhir modal details -->
                                            <div class="p-0 bd-highlight">
                                                <div class="d-flex flex-row-reverse bd-highlight">
                                                    <?php
                                                        if($data->download != 0){
                                                            ?>
                                                                <div class="p-2 bd-highlight text-success"><a href="<?php echo base_url() ?>upload/<?php echo $data->file ?>" target="_blank" class="text-success"><u>Download File</u></a></div>
                                                                <?php
                                                        }
                                                        else if($data->download == 0){
                                                            ?>
                                                                <div class="p-2 bd-highlight text-success"><a href="#" class="text-secondary"><u>Download File Tidak Tersedia</u></a></div>
                                                            <?php
                                                        }
                                                    ?>
                                                    <div class="p-2 bd-highlight"><?php echo $data->tahun ?></div>
                                                    <div class="p-2 bd-highlight"><?php echo $data->penulis ?></div>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    </div>

                                </td>
                            </tr>

                            <?php
                            }
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