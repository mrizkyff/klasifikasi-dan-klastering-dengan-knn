<script type="text/javascript">
    $(document).ready(function () {
        $('.mainContainerPerhitungan').hide();
        var jmlDokumen = 2;
        $('#btnAddDokumen').click(function (e) { 
            e.preventDefault();
            jmlDokumen += 2
            $('.kotakDokumen').before(
                '<div class="form-group">'+
                    '<div class="form-group">'+
                        '<label for="doc'+jmlDokumen+'">Dokumen '+jmlDokumen+'</label>'+
                        '<input type="text" name="doc'+jmlDokumen+'" id="doc'+jmlDokumen+'" placeholder="Teks Dokumen '+jmlDokumen+'" class="form-control">'+
                    '</div>'+
                '</div>'
            );
            $('#doc'+jmlDokumen+'').hide().fadeIn();
        });

        // tombol proses 
        $('#btnProses').click(function (e) { 
            e.preventDefault();
            // reset tabel
            $('#showTabelPrep').empty();
            $('#headTabelTf').empty();
            $('#showTabelTf').empty();


            $('.mainContainerPerhitungan').fadeIn();

            // mengirim data di form ke controller
            $.ajax({
                type: "POST",
                url: "<?php echo base_url('analysis/proses_pencarian')?>",
                data: $('#formDokumen').serialize(),
                dataType: "JSON",
                success: function (response) {

                    // menampilkan respon data
                    console.log(response);
                    var nomer = 1;

                    // menampilkan di tabel preprocessing
                    $.each(response['korpus'], function (indexInArray, valueOfElement) { 
                        // console.log(indexInArray+' = '+valueOfElement);
                        var html ="<tr>"+
                            "<td>"+nomer+"</td>"+
                            "<td>"+indexInArray+"</td>"+
                            "<td>"+valueOfElement+"</td>"+
                        "</tr>";
                        $('#showTabelPrep').append(html);
                        nomer += 1
                    });

                    // menampilkan di tabel tfidf
                    // head
                    var html0 = '<tr id="subHeadTabelTf">'+
                                    '<th>No.</th>'+
                                    '<th>Term</th>'+
                                '</tr>';
                    $('#headTabelTf').append(html0);
                    // subhead
                    // menghitung jml korpus
                    jml = 0
                    for (var i in response['korpus']){
                        jml++
                    }
                    for (let index = 1; index < jml; index++) {
                        var html =
                            "<th>"+'Doc'+index+''+"</th>"
                        $('#subHeadTabelTf').append(html);
                    }
                    $('#subHeadTabelTf').append('<th>Query</th>');
                    console.log(jml);

                    // body
                    // looping membuat 0 di seluruh cell tabel
                    var htmlBody = ''
                    $.each(response['koleksi_term'], function (indeks, term) { 
                        htmlBody += '<tr><td>'+indeks+'</td>'+
                                        '<td>'+term+'</td>'
                        for (let i = 0; i < jml; i++) {
                            htmlBody += '<td id=rowke'+indeks+'_'+i+'>0</td>'
                        }
                        });
                    $('#showTabelTf').append(htmlBody)
                        
                        // mengupdate nilai 0 pada cell table TF sesuai dengan nilai tfnya
                    $.each(response['koleksi_term'], function (indeks, term) { 
                        $.each(response['dokumen_term'], function (indexInArray, valueOfElement) { // dokumen ke 0, 1, 2 ..
                                $.each(valueOfElement, function (termnya, nilainya  ) {  //isi dari dokumen ke 0, 1, 2, 3...
                                    if(termnya == term){
                                        $('#rowke'+indeks+'_'+indexInArray).html(nilainya);
                                    } 
                                });
                            });
                    });

                }
            });
        });


    });
</script>