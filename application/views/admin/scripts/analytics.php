<script type="text/javascript">
    $(document).ready(function () {
        $('.mainContainerPerhitungan').hide();
        var no = 1;
        $('#btnAddDokumen').click(function (e) { 
            e.preventDefault();
            no += 1
            $('.kotakDokumen').before(
                '<div class="form-group">'+
                    '<div class="form-group">'+
                        '<label for="doc'+no+'">Dokumen '+no+'</label>'+
                        '<input type="text" name="doc'+no+'" id="doc'+no+'" placeholder="Teks Dokumen '+no+'" class="form-control">'+
                    '</div>'+
                '</div>'
            );
            $('#doc'+no+'').hide().fadeIn();
        });

        $('#btnProses').click(function (e) { 
            e.preventDefault();
            $('#showTabel1').empty();
            $('.mainContainerPerhitungan').fadeIn();
            $.ajax({
                type: "POST",
                url: "<?php echo base_url('analysis/proses_pencarian')?>",
                data: $('#formDokumen').serialize(),
                dataType: "JSON",
                success: function (response) {
                    console.log(response);
                    var nomer = 1;
                    $.each(response, function (indexInArray, valueOfElement) { 
                        // console.log(indexInArray+' = '+valueOfElement);
                        var html ="<tr>"+
                            "<td>"+nomer+"</td>"+
                            "<td>"+indexInArray+"</td>"+
                            "<td>"+valueOfElement+"</td>"+
                        "</tr>";
                        $('#showTabel1').append(html);
                        nomer += 1
                    });
                }
            });
        });
    });
</script>