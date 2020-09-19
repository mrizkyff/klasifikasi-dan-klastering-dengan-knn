<?php 

include_once __DIR__."/engine/Preprocessing.php";
include_once __DIR__."/engine/VSM.php";

function pencarian($query)
{
    // == STEP 1 inisialisasi
    $preprocess = new Preprocessing();
    $vsm = new VSM();

    // == STEP 2 mendapatkan kata dasar
    // $queryku = 'daun kuning';
    $query = $preprocess::preprocess($query);

    // == STEP 3 medapatkan dokumen ke array
    $connect = mysqli_query(mysqli_connect('localhost', 'root', '', 'tasearchengine'), "SELECT * FROM daftarta");
    $arrayDokumen = [];
    while ($row = mysqli_fetch_assoc($connect)) {
        $arrayDoc = [
            'id_doc' => $row['id'],
            'dokumen' => implode(" ", $preprocess::preprocess($row['judul']))
        ];
        array_push($arrayDokumen, $arrayDoc);
    }
    
    // STEP 4 == mendapatkan ranking dengan VSM
    $rank = $vsm::get_rank($query, $arrayDokumen);
    // var_dump($rank[0]["ranking"]);

    // STEP 5 == memasukkan cos similarity ke database
    $jumlahDokumen = count($rank);
    // var_dump($jumlahDokumen);

    $koneksi = mysqli_connect("localhost","root","","tasearchengine");

    for ($i=0; $i<$jumlahDokumen; $i++){
        $id = $rank[$i]["id_doc"];
        $bobot = $rank[$i]["ranking"];
        $sql = "UPDATE daftarta SET bobot='$bobot' WHERE id='$id'";
        mysqli_query($koneksi, $sql);
    }

    // var_dump($rank);

}

// jalankan fungsi
// pencarian();

?>