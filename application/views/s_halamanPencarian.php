<div class="main">
  
  <!-- Another variation with a button -->
  <table width=100%>
    <tr>
        <td><img src="<?php echo base_url() ?>asset/img/logoRepository.png" alt="DNRepository" class="img-fluid"></td>
        <br>
        <br>
        <br>
    </tr>
    <tr height='15px'>
        <td></td>
    </tr>
    <form action="<?php echo base_url().'index.php/search/cari'?>" method='get'>
    <tr>
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