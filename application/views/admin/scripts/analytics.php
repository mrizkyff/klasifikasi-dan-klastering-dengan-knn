<script type="text/javascript">
    $(document).ready(function () {
        $('.mainContainerPerhitungan').hide();
        var jmlDokumen = 3;
        $('#btnAddDokumen').click(function (e) { 
            e.preventDefault();
            jmlDokumen += 1
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
            
            $('#headTabelBobot').empty();
            $('#showTabelBobot').empty();

            $('#headTabelPanjangVektor').empty();
            $('#showTabelPanjangVektor').empty();



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

                    // menampilkan di tabel tfidf dan pembobotan
                    // head tabel tf
                    var html0 = '<tr id="subHeadTabelTf">'+
                                    '<th>No.</th>'+
                                    '<th>Term</th>'+
                                '</tr>';
                    $('#headTabelTf').append(html0);

                    // head tabel pembobotan
                    var html1 = '<tr id="subHeadTabelBobot">'+
                                    '<th>No.</th>'+
                                    '<th>Term</th>'+
                                '</tr>';
                    $('#headTabelBobot').append(html1);

                    // head tabel panjang vektor
                    var html2 = '<tr id="subHeadTabelPanjangVektor">'+
                                    '<th>No.</th>'+
                                    '<th>Term</th>'+
                                '</tr>';
                    $('#headTabelPanjangVektor').append(html2);

                    

                    // subhead
                    // menghitung jml korpus
                    jml = 0
                    for (var i in response['korpus']){
                        jml++
                    }
                    for (let index = 1; index < jml; index++) {
                        var html =
                            "<th>"+'Doc'+index+''+"</th>"
                        
                        // membuat dynamic subhead tabel tfidf
                        $('#subHeadTabelTf').append(html);

                        // membuat dynamic subhead tabel pembobotan
                        $('#subHeadTabelBobot').append(html);

                        // membuat dynamic subhead tabel panjang vektor
                        $('#subHeadTabelPanjangVektor').append(html);

                    }
                    // subhead query dan IDF pada tabel tfidf
                    $('#subHeadTabelTf').append('<th>Query</th><th width="200px">IDF</th>');
                    // subhead query pada tabel pembobotan
                    $('#subHeadTabelBobot').append('<th>Query</th>');
                    // subhead query pada tabel panjang vektor
                    $('#subHeadTabelPanjangVektor').append('<th>Query</th>');
                    console.log(jml);

                    // body
                    // mengisi cell nomer + term + dilanjutkan tabel 0 dynamic
                    var htmlBodyTf = ''
                    var htmlBodyBobot = ''
                    var htmlBodyPanjangVektor = ''
                    var no = 0
                    var jmlTerm = 0
                    $.each(response['koleksi_term'], function (indeks, term) { 
                        jmlTerm += 1
                        no += 1
                        htmlBodyTf += '<tr><td width="50px">'+(no)+'</td>'+
                                        '<td>'+term+'</td>'             
                        // looping membuat 0 di seluruh cell tabel tf-idf
                        for (let i = 0; i <= jml; i++) {
                            htmlBodyTf += '<td id=rowke'+indeks+'_'+i+'>0</td>'
                        }
                                        
                        htmlBodyBobot += '<tr><td width="50px">'+(no)+'</td>'+
                                        '<td>'+term+'</td>'
                        // looping membuat 0 di seluruh cell tabel pembobotan
                        for (let i = 0; i < jml; i++) {
                            htmlBodyBobot += '<td id=bobotke'+indeks+'_'+i+'>0</td>'
                        }

                        htmlBodyPanjangVektor += '<tr><td width="50px">'+(no)+'</td>'+
                                        '<td>'+term+'</td>'
                        // looping membuat 0 di seluruh cell tabel panjang vektor
                        for (let i = 0; i < jml; i++) {
                            htmlBodyPanjangVektor += '<td id=pvektorke'+indeks+'_'+i+'>0</td>'
                        }
                    });
                    //  menampilkan di tabel Tfidf
                    $('#showTabelTf').append(htmlBodyTf)
                    // menampilkan di tabel pembobotan
                    $('#showTabelBobot').append(htmlBodyBobot)

                    // menampilkan di tabel panjang vektor (isinya sama dengan tabel pembobotan)
                    // menambahkan row jumlah dan akar pada tabel panjang vektor
                    var elemenJumlah = ''
                    htmlBodyPanjangVektor +=    '<tr id="jumlahPvektor">'+
                                                    '<td colspan ="2" >Jumlah</td>'+
                                                '</tr>'+
                                                '<tr id="akarPvektor">'+
                                                    '<td colspan ="2">Akar</td>'+
                                                '</tr>'
                    $('#showTabelPanjangVektor').append(htmlBodyPanjangVektor)
                    for (let i = 0; i < jml; i++) {
                        $('#jumlahPvektor').append('<td id=jmlke'+i+'>0</td>');
                    }
                    for (let i = 0; i < jml; i++) {
                        $('#akarPvektor').append('<td id=akarke'+i+'>0</td>');
                    }
                        
                    // mengupdate nilai 0 pada cell table TF sesuai dengan nilai tfnya
                    $.each(response['koleksi_term'], function (indeks, term) { 
                        // mengisi tabel tfidf
                        var idf = 0;
                        var dokumenFrekuensi = 0;
                        $.each(response['dokumen_term'], function (indexInArray, valueOfElement) { // dokumen ke 0, 1, 2 ..
                            $.each(valueOfElement, function (termnya, nilainya  ) {  //isi dari dokumen ke 0, 1, 2, 3...
                                if(termnya == term){
                                    // set nilai tfidf
                                    $('#rowke'+indeks+'_'+indexInArray).html(nilainya);
                                    $('#rowke'+indeks+'_'+indexInArray).addClass('bg-secondary');
                                    dokumenFrekuensi += nilainya;
                                } 
                            });
                        });
                        // menampilkan idf di tabel tfidf
                        idf = Math.log10(jml/dokumenFrekuensi);
                        $('#rowke'+indeks+'_'+jml).html(idf.toFixed(6));

                        // mengisi tabel pembobotan dan juga panjang vektor
                        $.each(response['dokumen_term'], function (indexInArray, valueOfElement) { // dokumen ke 0, 1, 2 ..
                            $.each(valueOfElement, function (termnya, nilainya  ) {  //isi dari dokumen ke 0, 1, 2, 3...
                                if(termnya == term){
                                    // set nilai pembobotan
                                    $('#bobotke'+indeks+'_'+indexInArray).html((nilainya * idf).toFixed(6));
                                    $('#bobotke'+indeks+'_'+indexInArray).addClass('bg-secondary');
                                    
                                    // set nilai panjangvektor
                                    $('#pvektorke'+indeks+'_'+indexInArray).html((nilainya * Math.pow(idf,2)).toFixed(6));
                                    $('#pvektorke'+indeks+'_'+indexInArray).addClass('bg-secondary');
                                } 
                            });
                        });
                    });
                    
                    // menjumlahkan panjang vektor setiap dokumen dan mencari akarnya
                    for (let i = 0; i < jml; i++) {
                        var jumlahVektor = 0
                        var akarVektor = 0
                        for (let j = 0; j < jmlTerm; j++){
                            // console.log('koordinat'+j+','+i);
                            jumlahVektor += Number($('#pvektorke'+j+'_'+i).html());
                        }
                        console.log('jumlahke'+i+'='+jumlahVektor);
                        $('#jmlke'+i).html(jumlahVektor.toFixed(6));
                        $('#akarke'+i).html(Math.sqrt(jumlahVektor).toFixed(6));
                    }
                }
            });
        });


    });
</script>