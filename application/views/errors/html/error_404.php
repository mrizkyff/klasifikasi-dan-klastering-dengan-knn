<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<?php
$ci = new CI_Controller();
$ci =& get_instance();
$ci->load->helper('url');
?>

<!doctype html>
<html>
<head>
	<link rel="stylesheet" href="<?php echo base_url() ?>asset/css/notfoundstyle.css">
</head>
<body>
<div id="clouds">
            <div class="cloud x1"></div>
            <div class="cloud x1_5"></div>
            <div class="cloud x2"></div>
            <div class="cloud x3"></div>
            <div class="cloud x4"></div>
            <div class="cloud x5"></div>
        </div>
        <div class='c'>
            <div class='_404'>404</div>
            <hr>
            <div class='_1'>HALAMAN</div>
            <div class='_2'>TIDAK DITEMUKAN</div>
            <a class='btn' href='<?php echo base_url('search') ?>'>KEMBALI KE Katalog TA</a>
        </div>
</body>
</html>