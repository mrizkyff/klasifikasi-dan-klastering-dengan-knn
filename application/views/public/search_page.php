<div class="main">
  
  <!-- Another variation with a button -->
  <table width=100% border='0'>
    <tr>
        <td colspan=3><img src="<?php echo base_url() ?>asset/img/logoRepository.png" alt="DNRepository" class="img-fluid"></td>
        <br>
        <br>
        <br>
    </tr>
    <tr height='15px'>
        <td></td>
    </tr>
    <form action="<?php echo base_url().'search/cari'?>" method='get'>
    <tr>
        <td width='140px'>
            <div class="input-group">
                <select name="tahun" id="tahun" class="form-control">
                    <option value="">Semua Tahun</option>
                    <option value="2020">2020</option>
                    <option value="2019">2019</option>
                    <option value="2018">2018</option>
                    <option value="2017">2017</option>
                    <option value="2016">2016</option>
                    <option value="2015">2015</option>
                </select>
            </div>
        </td>
        <td width='140px'>
            <div class="input-group">
                <select name="minat" id="minat" class="form-control">
                    <option value="">Semua Minat</option>
                    <option value="sc">SC</option>
                    <option value="rpl">RPL</option>
                </select>
            </div>
        </td>
        <td>
            <div class="input-group">
                <input type="text" class="form-control" placeholder="Cari Judul Tugas Akhir" name='query'>
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
  <!-- akhir table -->


        
  <center>
  <br>
  <p><a href="http://eprints.dinus.ac.id">Main Udinus Repository</a></p>
  </center>
  
</div>