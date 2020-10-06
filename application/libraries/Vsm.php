<?php
/**
 * Kelas Helper untuk VSM
 */
class VSM
{

    /**
     * Memetakan term, Q, d1, d2, ..., df
     *
     * @param  array $query
     * @param  array $dokumen
     * @return array
     * menggabungkan antara query dan dokumen (hanya term saja)
    */
    public static function get_rank($query, $dokumen, $debug=false)
    {
        $term           = VSM::term($query, $dokumen, $debug);
        $dokumen_term   = VSM::dokumen_term($dokumen, $debug);
        $df             = VSM::df($term, $query, $dokumen_term, $debug);
        $idf            = VSM::idf($query, $dokumen_term, $df, $debug);
        $bobot          = VSM::bobot($query, $dokumen_term, $idf, $debug);
        $cos_similarity = VSM::cosine_similarity($bobot, $debug);

        return $cos_similarity;
        // return $dice_similarity;
    }

    /**
     * Mendapatkan term dengan mensortir kata2 yang berbeda
     *
     * @param  array $query
     * @param  array $dokumen
     * @return array
    */
    public static function term($query, $dokumen, $debug)
    {
        // query to string
        $query = implode(" ",  $query);

        // dokumen to array | remove nested array karna bentuk sebelumnya tu nested array
        $arrayTampung = [];
        foreach ($dokumen as $key => $value) {
            foreach ($value as $key1 => $value1) {
                if ($key1 == 'dokumen') {
                    array_push($arrayTampung, $value1);
                }
            }
        }

        // menggabungkan query pencarian ke term dokumen
        array_push($arrayTampung, $query);

        // semua value $arrayTampung jadi satu string
        $string_term = implode(" ", $arrayTampung);
        // semua string jadi array | untuk mendapatkan term
        $string_array = explode(" ", $string_term);

        // mendapatkan term
        $word       = str_word_count($string_term, 1); // auto string to array
        $term       = array_count_values($word);

        if ($debug){
            var_dump('--------term--------');
            print_r($term);
        }

        return $term;
    }

    /**
     * Mendapatkan term dari masing-masing dokumen
     *
     * @param  array $dokumen
     * @return array
    */
    public static function dokumen_term($dokumen, $debug)
    {
        $arrayTampung = [];
        foreach ($dokumen as $key => $value) {
            // semua string jadi array | untuk mendapatkan term
            $string_array = explode(" ", $value['dokumen']);
            // mendapatkan term
            $word       = str_word_count($value['dokumen'], 1); // auto string to array
            $term       = array_count_values($word);
            array_push($arrayTampung, ['id_doc' => $value['id_doc'], 'dokumen' => $term]);
        }
        if ($debug){
            var_dump('--------dokumen term--------');
            print_r($arrayTampung);
        }
        return $arrayTampung;
    }

    /**
     * Mendapatkan nilai df dari masing-masing dokumen & term & query
     *
     * @param  array $term
     * @param  array $query
     * @param  array $dokumen_term
     * @return array
    */
    public static function df($term, $query, $dokumen_term, $debug)
    {
        // start from 0 | start dari nol
        $arrayDf = [];
        foreach ($term as $key => $value) {
            $arrayDf[$key] = 0;
        }

        // pengisian df dari $query
        foreach ($term as $key => $value) {
            foreach ($query as $key1 => $value1) {
                if ($key == $value1) {
                    $arrayDf[$key] += 1;
                }
            }
        }

        // pengisian df dari dokumen
        foreach ($term as $key => $value) {
            foreach ($dokumen_term as $key1 => $value1) {
                foreach ($value1['dokumen'] as $key2 => $value2) {
                    if ($key == $key2) {
                        $arrayDf[$key] += 1;
                    }
                }
            }
        }
        if ($debug){
            var_dump('-------- df (seluruh term/leksikon) --------');
            print_r($arrayDf);
        }
        return $arrayDf;
    }

    /**
     * Mendapatkan nilai idf dari df
     *
     * @param  array $query
     * @param  array $dokumen_term
     * @param  array $df
     * @return array
    */
    public static function idf($query, $dokumen_term, $df, $debug)
    {
        // n = jumlah dokumen + query
        $N_count = count($dokumen_term) + 1;

        $arrayIdf =[];
        foreach ($df as $key => $value) {
            if($value <= 0.0){

            }
            else{
                $arrayIdf[$key] = log10( $N_count / $value);
            }
        }

        if ($debug){
            var_dump('-------- idf --------');
            print_r($arrayIdf);
        }
        return $arrayIdf;
    }

    /**
     * Melakukan pembobotan
     *
     * @param  array $query
     * @param  array $dokumen_term
     * @param  array $idf
     * @return array
    */
    public static function bobot($query, $dokumen_term, $idf, $debug)
    {
        // pembobotan query
        $bobotQuery =[];
        foreach ($idf as $key => $value) {
            foreach ($query as $key1 => $value1) {
                if ($key == $value1) {
                    $bobotQuery[$key] = (1*$value);
                }
            }
        }

        // pembobotan setiap dokumen
        $bobotDokumen = [];
        foreach ($dokumen_term as $index => $dokumen) {
            $arrayTampung = [];
            foreach ($idf as $key => $value) {
                foreach ($dokumen['dokumen'] as $key1 => $value1) {
                    if ($key == $key1) {
                        $arrayTampung += [$key => ($value*$value1),];
                    }
                }
            }
            array_push($bobotDokumen, array('id_doc' => $dokumen['id_doc'], "dokumen" => $arrayTampung));
        }

        // Array Bobot
        $arrayBobot = ["query" => $bobotQuery, "dokumen" => $bobotDokumen];

        if ($debug){
            var_dump('-------- weighting/pembobotan --------');
            print_r($arrayBobot);
        }
        return $arrayBobot;
    }

    /**
     * Melakukan perangking-an dengan cosine similarity
     * 
     * Ada Jaccard Juga
     * intinya perbedaannya dengan cosim adalah ini tu perkalian skalar / (jumlah vektor d1 + jml vektor query - perkalian skalar)
     * 
     * Ada Dice Juga
     * dice itu intinya hampir sama dengan jaccard, tapi dikali 2 dan tidak dikurangi perkalian skalar
     *
     * @param  array $bobot
     * @return array
    */
    public static function cosine_similarity($bobot, $debug)
    {
        // ====================================================================================
        // $bobot = [];
        // $bobot['query'] = [
        //     'x' => 1.5,
        //     'y' => 1.0,
        //     'z' => 0.0,
        // ];
        // $bobot['dokumen'] = [
        //     '0' => [
        //         'id_doc' => 'g1',
        //         'dokumen' => [
        //             'x' => 0.5,
        //             'y' => 0.8,
        //             'z' => 0.3,
        //         ],
        //     ],
        //     '1' => [
        //         'id_doc' => 'g2',
        //         'dokumen' => [
        //             'x' => 0.9,
        //             'y' => 0.4,
        //             'z' => 0.2,
        //         ],
        //     ],
        // ];
        // print_r($dis);
        // print_r($bobot);
        // ====================================================================================
        
        //edit ian
        // mendapatkan jumlah dan akar dari query @float
        $queryCosJumlah = 0;
        foreach ($bobot['query'] as $key => $value) {
            $queryCosJumlah += $value*$value;
        }
        $queryCosAkar = sqrt($queryCosJumlah);

        
        //edit ian
        // mendapatkan bobot dokumen
        // mendapatkan jumlah dan akar dari setiap dokumen @array
        // jadi sebelumnya itu pembobotan dokumen harus mencari term di query dan dokumen yang sama baru dijumlahkan, tapi aku ganti langsung aja jumlahin semua bobot yang ada di sebuah dokumen
        $dokumenCosJumlahAkar = [];
        foreach ($bobot['dokumen'] as $index => $dokumen) { // dokumen 1, 2, 3 ... n
            $arrayDoc[$index] = ["id_doc" => $dokumen['id_doc']];
            $bobotDoc[$index] = 0;
            // foreach ($bobot['query'] as $key => $value) {
                foreach ($dokumen['dokumen'] as $key1 => $value1) { // isi dr dokumen 1, 2, ..n
                    // var_dump($key1);
                    // if ($key == $key1) {
                        $value1 = ($value1*$value1);
                        // var_dump($value1);
                        $bobotDoc[$index] += ($value1);
                        // var_dump($bobotDoc);
                    // }
                }
            // }
            $arrayDoc[$index] += ["jumlah_bobot" => $bobotDoc[$index], "akar_bobot" => sqrt($bobotDoc[$index])];
            array_push($dokumenCosJumlahAkar,  $arrayDoc[$index]);   
        }
        
        

        // mendapatkan vektor
        // jadi ketika term pada query dan dokumen itu sama, dikalikan lalu dijumlahkan sehingga menghasilkan jumlah vektor pada masing2 dokumen
        $dokumenVektor = [];
        $dokumenVektorEuclidean = [];
        foreach ($bobot['dokumen'] as $index => $dokumen) { // dokumen 1, 2, 3 ... n
            // var_dump('=========== '.$index.' ===============');
            $arrayDoc[$index] = ["id_doc" => $dokumen['id_doc']];
            $vektorDoc[$index] = 0;

            // FLAG = EUCLIDEAN
            $vektorDocEuclidean[$index] = 0;
            // untuk cek apakah di dokumen apakah ada term yang sama dengan query, jika tidak ada, langsung aja nilai query dikadratkan
            foreach ($bobot['query'] as $kunci => $nilai) {
                if (!array_key_exists($kunci,$dokumen['dokumen'])){
                    $vektorDocEuclidean[$index] += pow($nilai,2);
                    // print_r(['Perhitungan query' => $kunci.' '.$nilai, 'hasilnya' => pow($nilai,2)]);
                }
            }
            // untuk cek apakah di query terdapat term yang ada pada dokumen jika tidak ada, langsung saja nilai di dokumen dikuadratkan
            foreach ($dokumen['dokumen'] as $key => $value) {
                if (!array_key_exists($key, $bobot['query'])){
                    $vektorDocEuclidean[$index] += pow($value,2);
                    // print_r(['Perhitungan dokumen' => $key.' '.$value, 'hasilnya' => pow($value,2)]);
                }
            }

            foreach ($bobot['query'] as $key => $value) {
                foreach ($dokumen['dokumen'] as $key1 => $value1) { // isi dr dokumen 1, 2, ..n
                    if ($key == $key1) {
                        $vektorDoc[$index] += ($value * $value1);

                        // FLAG = EUCLIDEAN
                        // untuk cek apakah term di query dan dokumen sama, jika sama langsung dihitung euclidean distance
                        $vektorDocEuclidean[$index] += pow(($value - $value1),2);
                        // print_r(['Perhitungan sama query' => $key1.' '.$value1, 'dokumen' => $key.' '.$value, 'hasilnya' => pow(($value - $value1),2)]);
                    }
                }
                
            }
            // print_r(['DOKUMEN' => $dokumen['id_doc'].' '.$vektorDocEuclidean[$index]]);
            $arrayDoc[$index] += ["jumlah_vektor" => $vektorDoc[$index]];
            array_push($dokumenVektor,  $arrayDoc[$index]);
            
            // khusus EUCLIDEAn langsung ketemu ranking, tanpa operasi lain
            array_push($dokumenVektorEuclidean,  ["id_doc" => $dokumen["id_doc"], "ranking" => sqrt($vektorDocEuclidean[$index])]);
        }


        // mendapatkan besar vektor
        $dokumenBesarVektor = [];
        $dokumenBesarVektorJaccard = [];
        foreach ($dokumenCosJumlahAkar as $index => $dokumen) {
            $arrayDoc[$index] = ["id_doc" => $dokumen['id_doc']];
            $besarVektorDoc[$index] = $dokumen['akar_bobot'];

            $arrayDoc[$index] += ["jumlah_besar_vektor" => ($besarVektorDoc[$index] * $queryCosAkar) ];
            
            // FLAG = JACCARD
            // menambahkan jumlah vektor dokumen dengan jumlah vektor query (dimasukkan ke arraydoc tapi ada array jaccard didalamnya)
            $arrayDoc[$index] += ["jumlah_besar_vektor_jaccard" => $dokumen['jumlah_bobot'] + $queryCosJumlah ];
            array_push($dokumenBesarVektor,  $arrayDoc[$index]);
        }
        // dd($dokumenVektor, $dokumenBesarVektor);
        

        // gabungkan array vektor dan besar vektor
        $dokumenCosine = [];
        foreach ($dokumenVektor as $index => $dokumen) {
            $arrayDoc[$index] = ["id_doc" => $dokumen['id_doc'], "jumlah_vektor" => $dokumen['jumlah_vektor'] ];
            $vectorCosine[$index] = 0;

            foreach ($dokumenBesarVektor as $index1 => $dokumen1) {
                if ($dokumen1['id_doc'] == $dokumen['id_doc']) {
                    $vectorCosine[$index] = $dokumen1["jumlah_besar_vektor"];
                    $arrayDoc[$index] += ["jumlah_besar_vektor" => $vectorCosine[$index] ];
                    
                    // FLAG = JACCARD
                    $vectorCosineJaccard[$index] = $dokumen1["jumlah_besar_vektor_jaccard"];
                    $arrayDoc[$index] += ["jumlah_besar_vektor_jaccard" => $vectorCosineJaccard[$index] ];
                    array_push($dokumenCosine,  $arrayDoc[$index]);
                }
            }
        }

        // membuat ranking
        $dokumenRanking = [];
        $dokumenRankingJaccard = [];
        $dokumenRankingDice = [];
        foreach ($dokumenCosine as $index => $dokumen) {
            $jumlah = 0;
            $jumlahJaccard = 0;
            $jumlahDice = 0;
            if ($dokumen["jumlah_vektor"] != 0 && $dokumen["jumlah_besar_vektor"] != 0) {
                $jumlah = $dokumen["jumlah_vektor"] / $dokumen["jumlah_besar_vektor"];

                // FLAG = JACCARD
                $jumlahJaccard = $dokumen['jumlah_vektor'] / ($dokumen['jumlah_besar_vektor_jaccard']-$dokumen['jumlah_vektor']);

                // FLAG = DICE
                $jumlahDice = 2*($dokumen['jumlah_vektor']) / ($dokumen['jumlah_besar_vektor_jaccard']);
            }
            $arrayDoc[$index] = ["id_doc" => $dokumen['id_doc'], "ranking" => $jumlah];
            $arrayDocJaccard[$index] = ["id_doc" => $dokumen['id_doc'], "ranking" => $jumlahJaccard];
            $arrayDocDice[$index] = ["id_doc" => $dokumen['id_doc'], "ranking" => $jumlahDice];
            array_push($dokumenRanking, $arrayDoc[$index]);
            array_push($dokumenRankingJaccard, $arrayDocJaccard[$index]);
            array_push($dokumenRankingDice, $arrayDocDice[$index]);
        }

        if ($debug){
            var_dump('============== COSINUS SIMILARITY  dan JACCARD ==============');
            var_dump('-------- jumlah dan akar query --------');
            print_r(['jumlah' => $queryCosJumlah, 'akar' => $queryCosAkar]);
            var_dump('/n-------- jumlah dan akar dokumen --------');
            print_r($dokumenCosJumlahAkar);
            var_dump('-------- vektor dokumen (perkalian)(pembilang)--------');
            print_r($dokumenVektor);
            var_dump('-------- besar vektor dokumen (penyebut) --------');
            print_r($dokumenBesarVektor);
            var_dump('-------- cosinus dokumen --------');
            print_r($dokumenCosine);
            var_dump('-------- rangking dokumen (hasil) --------');
            print_r($dokumenRanking);
            print_r($dokumenRankingJaccard);
            print_r($dokumenRankingDice);
        }

        return $allRanking = [
            'cosinus_similarity' => $dokumenRanking,
            'jaccard_similarity' => $dokumenRankingJaccard,
            'dice_similarity' => $dokumenRankingDice,
            'euclidean_similarity' => $dokumenVektorEuclidean,
        ];
    }
    


} // end class