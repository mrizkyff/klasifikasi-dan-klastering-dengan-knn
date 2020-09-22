<script type="text/javascript">
    $(document).ready(function() {
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
                {"data": "penulis"},
                {"data": "tahun"},
                {"data": "judul"},
                {"data": "label"},
                {"data": "abstrak"},
                {"data": "aksi"}
            ],
            // order menurut urutan kolom
            order: [[2, 'desc']],
            rowCallback: function(row, data, iDisplayIndex) {
                var info = this.fnPagingInfo();
                var page = info.iPage;
                var length = info.iLength;
                var index = page * length + (iDisplayIndex + 1);
                $('td:eq(0)', row).html(index);
            }
        });


        // getEdit
        $('#tabel_data_dashboard').on('click','.edit_record',function(){
            var id = $(this).data('id');
            var penulis = $(this).data('penulis');
            var tahun = $(this).data('tahun');
            var judul = $(this).data('judul');
            var abstrak = $(this).data('abstrak');
            var label = $(this).data('label');
            // console.log(id, penulis, tahun, judul, abstrak, label);
            // set modal edit
            $('#modal_edit').modal('show');
            $('[name = id]').val(id);
            $('[name = penulis]').val(penulis);
            $('[name = tahun]').val(tahun);
            $('[name = judul]').val(judul);
            $('[name = abstrak]').val(abstrak);
            $('[name = jurusan]').val(label);
        })

        // aksi edit
        $('#btn_update').on('click',function(event){
            $.ajax({
                type: "POST",
                url: "<?php echo base_url('admin/update_data') ?>",
                data: $('#form_update').serialize(),
                dataType: "JSON",
                success: function (response) {
                    alert('Record data berhasil diupdate!');
                }
            });
        })

        // getHapus
        // $('#tabel_data_dashboard').on('click','.hapus_record', function(){
        //     var id = $(this).data('id');
        //     var judul = $(this).data('judul');
        //     $('#modal_hapus').modal('show');
        //     $('#hapus_judul').text('Yakin untuk menghapus dokumen dengan judul '+judul+'?');
        //     $('[name = id_hapus]').val(id);
        // })



    });


</script>