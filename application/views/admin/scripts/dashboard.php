<script>


    // ajax get semua data rak
    window.onload = function () {
        var dataPoints = [];
        var chart1 = new CanvasJS.Chart("chartRak",{
            title:{
                text:"Ketersediaan Rak Penyimpanan"
            },
            axisY: {
                title: "Tersedia",
            },
            data: [{
                color: "#3895d3",
                showInLegend: true,
                legendMarkerType: "none",
                type: "column",
                legendText: "Lokasi Rak",
                dataPoints : dataPoints,
            }]
        });
        $.getJSON("<?php echo base_url('admin/getDataRak')?>", function(data) {  
            $.each(data, function(key, value){
                if(value['lokasi'] != 'Arsip'){
                    dataPoints.push({label: value['lokasi'], y: parseInt(value['tersedia'])});
                }
            });	
            chart1.render();
        });

        // ajax get semua data prodi
        var dataPoints2 = [];
        var chart2 = new CanvasJS.Chart("chartProdi",
        {
            theme: "light2",
            title:{
                text: "Jumlah Koleksi per Prodi"
            },		
            data: [
            {       
                type: "pie",
                // showInLegend: true,
                toolTipContent: "{indexLabel} : {y}",
                yValueFormatString: "#### dokumen",
                // legendText: "{indexLabel}",
                dataPoints: dataPoints2,
            }
            ]
        });
        $.getJSON("<?php echo base_url('admin/getDataDocPerProdi')?>", function(data) {  
            $.each(data, function(key, value){
                dataPoints2.push({y: parseInt(value['jml']), indexLabel: value['desc_prodi']});
            });	
            chart2.render();
        });


        // ajax get semua data prodi
        var dataPoints3 = [];
        var chart3 = new CanvasJS.Chart("chartTahun",
        {
            theme: "light2",
            title:{
                text: "Jumlah Koleksi per Tahun"
            },		
            data: [
            {       
                type: "pie",
                // showInLegend: true,
                toolTipContent: "{indexLabel} : {y}",
                yValueFormatString: "#### dokumen",
                // legendText: "{indexLabel}",
                dataPoints: dataPoints3,
            }
            ]
        });
        $.getJSON("<?php echo base_url('admin/getDataDocPerTahun')?>", function(data) {  
            $.each(data, function(key, value){
                dataPoints3.push({y: parseInt(value), indexLabel: key});
            });	
            chart3.render();
        });
        
    }
</script>