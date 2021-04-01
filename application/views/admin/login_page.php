<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
<title>DNRepository Admin Login</title>
<style type="text/css">
	.login-form {
		width: 340px;
    	margin: 50px auto;
	}
    .login-form form {
    	margin-bottom: 15px;
        background: #f7f7f7;
        box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.3);
        padding: 30px;
    }
    .login-form h2 {
        margin: 0 0 15px;
    }
    .form-control, .btn {
        min-height: 38px;
        border-radius: 2px;
    }
    .btn {        
        font-size: 15px;
        font-weight: bold;
    }
</style>
</head>
<body>
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
            <a class="nav-link" href="<?php echo base_url()?>">Koleksi TA </a>
        </li>
        <li class="nav-item active">
            <a class="nav-link" href="<?php echo base_url('admin')?>">Administrator<span class="sr-only">(current)</span></a>
        </li>
        </ul>
    </div>
    </div>
</nav>
<!-- akhir navbar -->
<div class="login-form">
        <h2 class="text-center">Log in</h2>       

        <div class="alert" id="alert_login" role="alert">
            <p id="message_login"><b></b></p>
        </div>

        <div class="form-group">
            <input type="text" class="form-control" placeholder="Username" required="required" name="username" id="username">
        </div>
        <div class="form-group">
            <input type="password" class="form-control" placeholder="Password" required="required" name="password" id="password">
        </div>

        <div class="clearfix">
            <!-- <a href="#" class="pull-right">Forgot Password?</a> -->
        <div class="form-group">
            <button id='btnLogin' class="btn btn-primary btn-block" value="Login">Log in</button>
        </div>
            <label class="pull-left checkbox-inline"><input type="checkbox"> Remember me</label>
        </div>        
</div>
    <!-- <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script> -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
    <script type="text/javascript">
    $(document).ready(function(){
        $('#alert_login').hide();
        $('#btnLogin').on('click', function(){
            var username = $('#username').val();
            var password = $('#password').val();
            $.ajax({
                type: "POST",
                url: "<?php echo base_url('login/authorize') ?>",
                data: {username:username, password:password},
                success: function (response) {
                    // console.log(response);
                    if (response >= 1){
                        // $('#alert_login').removeClass('alert-danger');
                        // $('#alert_login').addClass('alert-success');
                        // $('#message_login').text('Berhasil Login!');
                        window.location.assign("<?php echo base_url('admin');?>");
                    }
                    else{
                        $('#alert_login').removeClass('alert-success');
                        $('#alert_login').addClass('alert-danger');
                        $('#message_login').text('Gagal Login!, Periksa Username dan Password!');
                    }
                }
            });
            $('#alert_login').show('slow',function(){});
        })
    })
</script>
</body>
</html>                                		                            