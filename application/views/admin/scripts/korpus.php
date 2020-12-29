<script type="text/javascript">
    $(document).ready(function() {
        $('#dashboard_alert_sukses').hide();
        $('#dashboard_alert_gagal').hide();
        $.fn.dataTableExt.oApi.fnPagingInfo = function(oSettings)
        {
            return {
                "iStart": oSettings._iDisplayStart,
                "iEnd": oSettings.fnDisplayEnd(),
                "iLength": oSettings._iDisplayLength,
                "iTotal": oSettings.fnRecordsTotal(),
                "iFilteredTotal": oSettings.fnRecordsDisplay(),
                "iPage": Math.ceil(oSettings._iDisplayStart / oSettings._iDisplayLength),
                "iTotalPages": Math.ceil(oSettings.fnRecordsDisplay() / oSettings._iDisplayLength)
            };
        };
        var t = $("#tabel_data_dashboard").dataTable({
            // ganti bahasa datatable jadi bahasa indonesia
            "language": {
                    "url": "//cdn.datatables.net/plug-ins/1.10.19/i18n/Indonesian.json"
            },
            initComplete: function() {
                var api = this.api();
                $('#mytable_filter input')
                        .off('.DT')
                        .on('keyup.DT', function(e) {
                            if (e.keyCode == 13) {
                                api.search(this.value).draw();
                    }
                });
            },
            oLanguage: {
                sProcessing: "loading..."
            },
            processing: true,
            serverSide: true,
            ajax: {"url": "<?php echo base_url('admin/json')?>", "type": "POST"},
            columns: [
                {
                    "data": "id",
                    "orderable": false
                },
                {"data": "author", "seachable":false, "orderable":false},
                {"data": "tahun"},
                {"data": "title", "searchable":false, "orderable":false},
                {"data": "lokasi", "visible": true, "searchable":true},
                {"data": "desc_prodi"},
                {"data": "desc_fak"},
                {"data": "timestamp"},
                {"data": "aksi", "orderable": false},
                // dibikin off karena untuk search nya, kalau gadikasih ini gabisa cari dari nim dan nama dan judul soale satu kolom banyak data
                {"data": "penulis", "visible": false, "searchable":true},
                {"data": "nim", "visible": false, "searchable":true},
                {"data": "judul", "visible": false, "searchable":true},
            ],
            // order menurut urutan kolom
            order: [[7, 'desc']],
            rowCallback: function(row, data, iDisplayIndex) {
                var info = this.fnPagingInfo();
                var page = info.iPage;
                var length = info.iLength;
                var index = page * length + (iDisplayIndex + 1);
                $('td:eq(0)', row).html(index);
            }
        });

        // cekKetersediaan lokasi edit
        $('#btn_cek_lokasi_edit').click(function (e) { 
            e.preventDefault();
            var alpha = $('#lokasi_alpha_edit').val();
            var numeric = $('#lokasi_numeric_edit').val();
            if (alpha != 'arsip' && numeric == ""){
                $('#lokasi_alpha_edit').addClass('is-invalid');
                $('#lokasi_numeric_edit').addClass('is-invalid');

                $('#lokasi_alpha_edit').removeClass('is-valid');
                $('#lokasi_numeric_edit').removeClass('is-valid');
            }
            else if(alpha == 'arsip' && numeric != ""){
                $('#lokasi_alpha_edit').addClass('is-invalid');
                $('#lokasi_numeric_edit').addClass('is-invalid');

                $('#lokasi_alpha_edit').removeClass('is-valid');
                $('#lokasi_numeric_edit').removeClass('is-valid');
            }
            else{
                $.ajax({
                    type: "post",
                    url: "<?php echo base_url()?>admin/cek_lokasi",
                    data: {alpha: alpha, numeric:numeric},
                    dataType: "JSON",
                    success: function (response) {
                        if (parseInt(response[0]["tersedia"])>0){
                            $('#lokasi_alpha_edit').addClass('is-valid');
                            $('#lokasi_numeric_edit').addClass('is-valid');
    
                            $('#lokasi_alpha_edit').removeClass('is-invalid');
                            $('#lokasi_numeric_edit').removeClass('is-invalid');
                        }
                        else if(parseInt(response[0]["tersedia"]) == 0){
                            $('#lokasi_alpha_edit').addClass('is-invalid');
                            $('#lokasi_numeric_edit').addClass('is-invalid');
    
                            $('#lokasi_alpha_edit').removeClass('is-valid');
                            $('#lokasi_numeric_edit').removeClass('is-valid');
                        }
                    }
                });            
            }
        });

        // getEdit
        $('#tabel_data_dashboard').on('click','.edit_record',function(event){
            event.preventDefault();
            var id = $(this).data('id');
            var penulis = $(this).data('penulis');
            var tahun = $(this).data('tahun');
            var judul = $(this).data('judul');
            var minat = $(this).data('minat');
            var nim = $(this).data('nim');
            var lokasi = $(this).data('lokasi');
            $('[name = lokasi_sekarang]').val(lokasi);
            lokasi = lokasi.split(".");
            var alpha =  lokasi[0].toLowerCase();
            var numeric = lokasi[1];
            // console.log(id, penulis, tahun, judul, minat);
            // set modal edit
            console.log(alpha);
            console.log(numeric);
            $('#modal_edit').modal('show');
            $('[name = id]').val(id);
            $('[name = penulis]').val(penulis);
            $('[name = tahun]').val(tahun);
            $('[name = judul]').val(judul);
            $('[name = minat]').val(minat);
            $('[name = nim]').val(nim);
            $('#lokasi_alpha_edit').val(alpha);
            $('#lokasi_numeric_edit').val(numeric);
        })

        // aksi edit
        $('#btn_update').on('click',function(event){
            event.preventDefault();
            $.ajax({
                type: "POST",
                url: "<?php echo base_url('admin/update_data') ?>",
                data: $('#form_update').serialize(),
                dataType: "JSON",
                success: function (response) {
                    // alert('Record data berhasil diupdate!');
                    $('[name = id]').val();
                    $('[name = penulis]').val();
                    $('[name = tahun]').val();
                    $('[name = judul]').val();
                    $('[name = jurusan]').val();
                    $('[name = minat]').val();
                    $('[name = nim]').val();
                    $('#lokasi_alpha_edit').val();
                    $('#lokasi_numeric_edit').val();
                    $('#modal_edit').modal('hide');
                    $('#lokasi_alpha_edit').removeClass('is-valid');
                    $('#lokasi_numeric_edit').removeClass('is-valid');
                    $('#lokasi_alpha_edit').removeClass('is-invalid');
                    $('#lokasi_numeric_edit').removeClass('is-invalid');
                    $('#tabel_data_dashboard').DataTable().ajax.reload();

                    // munculkan alert di dashboard
                    if(response){
                        $('#dashboard_alert_sukses').html('<strong>Data berhasil diperbarui!</strong>');
                        $("#dashboard_alert_sukses").fadeTo(2000, 500).slideUp(500, function() {
                            $("#dashboard_alert_sukses").slideUp(500);
                        });
                    }
                    else{
                        $('#dashboard_alert_gagal').html('<strong>Data gagal diperbarui!</strong>');
                        $("#dashboard_alert_gagal").fadeTo(2000, 500).slideUp(500, function() {
                            $("#dashboard_alert_gagal").slideUp(500);
                        });
                    }
                },
                error: function(response){
                    $('#dashboard_alert_gagal').html('<strong>Data gagal diperbarui!</strong>');
                    $("#dashboard_alert_gagal").fadeTo(2000, 500).slideUp(500, function() {
                            $("#dashboard_alert_gagal").slideUp(500);
                        });
                }
            });
        })

        // getHapus
        $('#tabel_data_dashboard').on('click','.hapus_record', function(){
            var id = $(this).data('id');
            var judul = $(this).data('judul');
            var lokasi = $(this).data('lokasi').toLowerCase().split('.').join("");
            $('#modal_hapus').modal('show');
            $('#div_hapus').html('<p>Yakin untuk menghapus dokumen dengan judul <b>'+judul+'</b>?</p>');
            $('[name = id_hapus]').val(id);
            $('[name = id_lokasi]').val(lokasi);
        })

        // aksiHapus
        $('#btn_hapus').click(function (e) { 
            e.preventDefault();
            $.ajax({
                type: "POST",
                url: "<?php echo base_url('admin/hapus_data')?>",
                data: $('#form_hapus').serialize(),
                dataType: "JSON",
                success: function (response) {
                    // alert('Record data berhasil dihapus!');
                    $('#modal_hapus').modal('hide');
                    $('#tabel_data_dashboard').DataTable().ajax.reload();
                    // munculkan alert di dashboard
                    if(response){
                        $('#dashboard_alert_sukses').html('<strong>Data berhasil dihapus!</strong>');
                        $("#dashboard_alert_sukses").fadeTo(2000, 500).slideUp(500, function() {
                            $("#dashboard_alert_sukses").slideUp(500);
                        });
                    }
                    else{
                        $('#dashboard_alert_gagal').html('<strong>Data gagal dihapus!</strong>');
                        $("#dashboard_alert_gagal").fadeTo(2000, 500).slideUp(500, function() {
                            $("#dashboard_alert_gagal").slideUp(500);
                        });
                    }
                },
                error: function(response){
                    $('#dashboard_alert_gagal').html('<strong>Data gagal dihapus!</strong>');
                    $("#dashboard_alert_gagal").fadeTo(2000, 500).slideUp(500, function() {
                            $("#dashboard_alert_gagal").slideUp(500);
                        });
                }
            });
        });

        // cekKetersediaan lokasi tambah
        $('#btn_cek_lokasi').click(function (e) { 
            e.preventDefault();
            var alpha = $('#lokasi_alpha').val();
            var numeric = $('#lokasi_numeric').val();
            if (alpha != 'arsip' && numeric == ""){
                $('#lokasi_alpha').addClass('is-invalid');
                $('#lokasi_numeric').addClass('is-invalid');

                $('#lokasi_alpha').removeClass('is-valid');
                $('#lokasi_numeric').removeClass('is-valid');
            }
            else if(alpha == 'arsip' && numeric != ""){
                $('#lokasi_alpha').addClass('is-invalid');
                $('#lokasi_numeric').addClass('is-invalid');

                $('#lokasi_alpha').removeClass('is-valid');
                $('#lokasi_numeric').removeClass('is-valid');
            }
            else{
                $.ajax({
                    type: "post",
                    url: "<?php echo base_url()?>admin/cek_lokasi",
                    data: {alpha: alpha, numeric:numeric},
                    dataType: "JSON",
                    success: function (response) {
                        if (parseInt(response[0]["tersedia"])>0){
                            $('#lokasi_alpha').addClass('is-valid');
                            $('#lokasi_numeric').addClass('is-valid');
    
                            $('#lokasi_alpha').removeClass('is-invalid');
                            $('#lokasi_numeric').removeClass('is-invalid');
                        }
                        else if(parseInt(response[0]["tersedia"]) == 0){
                            $('#lokasi_alpha').addClass('is-invalid');
                            $('#lokasi_numeric').addClass('is-invalid');
    
                            $('#lokasi_alpha').removeClass('is-valid');
                            $('#lokasi_numeric').removeClass('is-valid');
                        }
                    },
                });            
            }
        });

        // getCreate
        $('#btn_create').click(function (e) { 
            e.preventDefault();
            $('#modal_tambah').modal('show');
            $('[name= penulis]').val("");
            $('[name= tahun]').val("");
            $('[name= judul]').val("");
            $('[name= minat]').val("");
            $('[name= file]').val("");
            $('[name= nim]').val("");
            $('[name= lokasi_alpha]').val("arsip");
            $('[name= lokasi_numeric]').val("");
        });

        // aksiCreate
        $('#form_create').submit(function(e){
            e.preventDefault();
            $.ajax({
                type: "POST",
                url: "<?php echo base_url('admin/do_upload')?>",
                data: new FormData(this),
                processData:false,
                contentType:false,
                success: function (response) {
                    // alert('Dokumen berhasil ditambahkan!');
                    $('#modal_tambah').modal('hide');
                    $('[name= penulis]').val("");
                    $('[name= tahun]').val("");
                    $('[name= judul]').val("");
                    $('[name= minat]').val("");
                    $('[name= file]').val("");
                    $('[name= nim]').val("");
                    $('[name= lokasi_alpha]').val("");
                    $('[name= lokasi_numeric]').val("");
                    $('#lokasi_alpha').removeClass('is-valid');
                    $('#lokasi_numeric').removeClass('is-valid');
                    $('#lokasi_alpha').removeClass('is-invalid');
                    $('#lokasi_numeric').removeClass('is-invalid');
                    $('#tabel_data_dashboard').DataTable().ajax.reload();

                    if(response){
                        $('#dashboard_alert_sukses').html('<strong>Data berhasil ditambahkan!</strong>');
                        $("#dashboard_alert_sukses").fadeTo(2000, 500).slideUp(500, function() {
                            $("#dashboard_alert_sukses").slideUp(500);
                        });
                    }
                    else{
                        $('#dashboard_alert_gagal').html('<strong>Data gagal ditambahkan!</strong>');
                        $("#dashboard_alert_gagal").fadeTo(2000, 500).slideUp(500, function() {
                            $("#dashboard_alert_gagal").slideUp(500);
                        });
                    }
                },
                error: function(response){
                    $('#dashboard_alert_gagal').html('<strong>Data gagal ditambahkan!</strong>');
                    $("#dashboard_alert_gagal").fadeTo(2000, 500).slideUp(500, function() {
                            $("#dashboard_alert_gagal").slideUp(500);
                        });
                }
            });
        })


    });


</script>