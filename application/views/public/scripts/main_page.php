<script>
    // $(document).ready(function () {
    //     $('#daftar_dokumen').DataTable({
    //         "ordering": false,
    //         "searching": false,
    //         "lengthChange": false,
    //         "language": {
    //                 "url": "//cdn.datatables.net/plug-ins/1.10.19/i18n/Indonesian.json"
    //         }
    //     });
    // });
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
        var t = $("#daftar_dokumen").dataTable({
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
            language: {
                    "url": "//cdn.datatables.net/plug-ins/1.10.19/i18n/Indonesian.json"
            },
            oLanguage: {
                sProcessing: "loading..."
            },
            processing: true,
            serverSide: true,
            searching: false,
            lengthChange: false,
            ajax: {"url": "<?php echo base_url('search/json')?>", "type": "POST"},
            columns: [
                {"data": "id", "visible" : false},
                {"data": "koleksi_ta", "orderable": false},
                {"data": "cosim", "orderable": true, "visible": false},
            ],
            order: [[2, 'desc']],
            rowCallback: function(row, data, iDisplayIndex) {
                var info = this.fnPagingInfo();
                var page = info.iPage;
                var length = info.iLength;
                var index = page * length + (iDisplayIndex + 1);
            }
        });

        $(document).on('click', "#btnMeta", function(){
            var penulis = $(this).data('penulis');
            var tahun = $(this).data('tahun');
            var judul = $(this).data('judul');
            var nim = $(this).data('nim');
            var fakultas = $(this).data('prodi');
            var prodi = $(this).data('fak');
            var kodeFak = $(this).data('kdfak');
            $('#modalMeta').modal('show');
            console.log(penulis, tahun, judul, nim, kodeFak);
            $('#meta_judul').text(judul);
            $('#meta_penulis').text(penulis);
            $('#meta_tahun').text(tahun);
            $('#meta_nim').text(nim);
            $('#meta_fakultas').text(fakultas);
            $('#meta_prodi').text(prodi);
            $('#thumbnailSkripsiMeta').attr("src","http://localhost/ciLTE/asset/img/thumbnail_skripsi/"+kodeFak+".png");
        })
            
</script>