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
                {"data": "dt_penulis"},
                {"data": "tahun"},
                {"data": "title"},
                {"data": "timestamp"},
                {"data": "aksi"},
            ],
            // order menurut urutan kolom
            order: [[4, 'desc']],
            rowCallback: function(row, data, iDisplayIndex) {
                var info = this.fnPagingInfo();
                var page = info.iPage;
                var length = info.iLength;
                var index = page * length + (iDisplayIndex + 1);
                $('td:eq(0)', row).html(index);
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
            // console.log(id, penulis, tahun, judul, minat);
            // set modal edit
            $('#modal_edit').modal('show');
            $('[name = id]').val(id);
            $('[name = penulis]').val(penulis);
            $('[name = tahun]').val(tahun);
            $('[name = judul]').val(judul);
            $('[name = minat]').val(minat);
            $('[name = nim]').val(nim);
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
                    $('#modal_edit').modal('hide');
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
            $('#modal_hapus').modal('show');
            $('#div_hapus').html('<p>Yakin untuk menghapus dokumen dengan judul <b>'+judul+'</b>?</p>');
            $('[name = id_hapus]').val(id);
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

        // getCreate
        $('#btn_create').click(function (e) { 
            e.preventDefault();
            $('#modal_tambah').modal('show');
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