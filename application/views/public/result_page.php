<nav class="navbar navbar-primary bg-primary">
  <span class="navbar-text">
    Hasil Pencarian untuk '<?php echo $keyword.' - '.$tahun.' - '.$minat?>'
  </span>
</nav>
<div class="konten">
    <!-- form pencarian -->
    <div class="main">
        <table width=100%>
            <tr>
                <td colspan='3'><img src="<?php echo base_url() ?>asset/img/logoRepository.png" alt="DNRepository" class="img-fluid"></td>
            </tr>
            <tr height='15px'>
                <td></td>
            </tr>
            <form action="<?php echo base_url().'search/cari'?>" method='get'>
            <tr>
                <td width='140px'>
                    <div class="input-group">
                        <select name="tahun" id="tahun" class="form-control" selected='<?php echo $tahun ?>'>
                            <option value="" <?= ($tahun == '')?'selected':''?>>Semua Tahun</option>
                            <option value="2020" <?= ($tahun == '2020')?'selected':''?>>2020</option>
                            <option value="2019" <?= ($tahun == '2019')?'selected':''?>>2019</option>
                            <option value="2018" <?= ($tahun == '2018')?'selected':''?>>2018</option>
                            <option value="2017" <?= ($tahun == '2017')?'selected':''?>>2017</option>
                            <option value="2016" <?= ($tahun == '2016')?'selected':''?>>2016</option>
                            <option value="2015" <?= ($tahun == '2015')?'selected':''?>>2015</option>
                        </select>
                    </div>
                </td>
                <td width='140px'>
                    <div class="input-group">
                        <select name="minat" id="minat" class="form-control" selected='<?php echo $minat ?>'>
                            <option value="" <?= ($minat == '')?'selected':''?>>Semua Minat</option>
                            <option value="sc" <?= ($minat == 'sc')?'selected':''?>>SC</option>
                            <option value="rpl" <?= ($minat == 'rpl')?'selected':''?>>RPL</option>
                        </select>
                    </div>
                </td>
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