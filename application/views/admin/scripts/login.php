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