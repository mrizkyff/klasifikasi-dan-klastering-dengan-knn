<!-- awal navbar -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
        <a class="navbar-brand" href="#">
            <table border="0">
                <tr>
                    <td rowspan="2" width="85px">
                        <img src="<?php echo base_url()?>asset/img/logo/logo_perpustakaan.png" class="rounded-circle" width="75px"> 
                    </td>
                    <td>
                        <h4>PERPUSTAKAAN</h4>
                    </td>
                </tr>
                <tr>
                    <td>
                        <h6>UNIVERSITAS DIAN NUSWANTORO</h6>
                    </td>
                </tr>
            </table>
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ml-auto">
            <li class="nav-item">
                <a class="nav-link" href="<?php echo base_url()?>">Koleksi TA <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="<?php echo base_url('admin')?>">Administrator</a>
            </li>
            </ul>
        </div>
        </div>
    </nav>
<!-- akhir navbar -->