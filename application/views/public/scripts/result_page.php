<script>
    $(document).ready(function () {
        $('#hide_spesifik').hide();
        $('#spesifik_form').hide();
        // console.log('halooo');
        $('#tabel_hasil_pencarian').DataTable({
            "ordering": false,
            "searching": false,
        });

        // munculkan pencarian spesifik
        $('#show_spesifik').click(function (e) { 
            e.preventDefault();
            $('#spesifik_form').slideDown();
            $('#show_spesifik').hide();
            $('#hide_spesifik').show();
        });
        $('#hide_spesifik').click(function (e) { 
            e.preventDefault();
            $('#spesifik_form').slideUp();
            $('#show_spesifik').show();
            $('#hide_spesifik').hide();
        });
    });
</script>