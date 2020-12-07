<script>
    var filterTahun = '';
    var filterProdi = '';
    var filterTextProdi = '';
    var filterTextTahun = '';
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
        var t = $("#daftar_dokumen").DataTable({
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
            sDom: 'lrtip',
            language: {
                    "url": "//cdn.datatables.net/plug-ins/1.10.19/i18n/Indonesian.json"
            },
            oLanguage: {
                sProcessing: "loading..."
            },
            processing: true,
            serverSide: true,
            searching: true,
            lengthChange: false,
            ajax: {"url": "<?php echo base_url('search/json')?>", "type": "POST"},
            columns: [
                {"data": "id", "visible" : false},
                {"data": "koleksi_ta", "orderable": false, "visible":true},
                {"data": "cosim", "orderable": true, "visible": false},
                {"data": "tahun", "orderable": true, "visible": false},
                {"data": "kode_prodi", "orderable": true, "visible": false},
                {"data": "tag", "orderable": true, "visible": false},
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
            var fakultas = '';
            var prodi = $(this).data('prodi');
            var kodeFak = $(this).data('kdfak');
            var lokasi = $(this).data('kdrak');
            if (kodeFak == 'fik'){
                fakultas = 'Fakultas Ilmu Komputer';
            }
            else if (kodeFak == 'fib'){
                fakultas = 'Fakultas Ilmu Budaya';
            }
            else if (kodeFak == 'feb'){
                fakultas = 'Fakultas Ekonomi dan Bisnis';
            }
            else if (kodeFak == 'fkes'){
                fakultas = 'Fakultas Kesehatan';
            }
            else if (kodeFak == 'ft'){
                fakultas = 'Fakultas Teknik';
            }
            $('#modalMeta').modal('show');
            console.log(penulis, tahun, judul, nim, kodeFak);
            $('#meta_judul').text(judul);
            $('#meta_penulis').text(penulis);
            $('#meta_tahun').text(tahun);
            $('#meta_nim').text(nim);
            $('#meta_fakultas').text(fakultas);
            $('#meta_prodi').text(prodi);
            $('#meta_lokasi').text(lokasi);
            $('#thumbnailSkripsiMeta').attr("src","http://localhost/ciLTE/asset/img/thumbnail_skripsi/"+kodeFak+".png");
        })

        // awal filtering
        function filter_(tahun, prodi, desc_prodi){
            filter = '';
            if (prodi == ''){
                filterTahun = tahun;
                filterTextTahun = "tahun "+filterTahun;
            }
            else if(tahun == ''){
                filterProdi = prodi;
                filterTextProdi = ", program studi "+desc_prodi;
            }
            filter = filterTahun+filterProdi;
            // filter = tahun+" "+prodi;
            t.search(filter, true, false, true).draw();
            // t.column(3).search(2015).draw();
            $("#show_filter").text("filter: "+filterTextTahun+filterTextProdi);
            $("#clearFilter").text(' reset filter');
            console.log(filter);
        }
        // akhir filtering

        // bersihkan filter
        $("#clearFilter").click(function (e) { 
            e.preventDefault();
            t.search("", true, false, true).draw();
            $("#show_filter").text("");
            $("#clearFilter").text("");
            filterTahun = '';
            filterProdi = '';
            filterTextProdi = '';
            filterTextTahun = '';
        });

        
            
</script>