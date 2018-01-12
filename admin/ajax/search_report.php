<?php
	//include
	include "../../connection/connect.php";

	//ambil parameter
	$q = $_GET['q'];

	//ambil data

	$result = $conn->query("SELECT transaksi.tanggal AS tanggal, pasien.nama_pasien AS nama_pasien, pasien.jenis_kelamin AS jenis_kelamin, pasien.alamat AS alamat, pasien.tanggal_lahir AS tanggal_lahir, pasien.no_rekam_medis AS no_rekam_medis, terapi.nama_terapi AS nama_terapi, detail_diagnosa.biaya, dokter.nama_dokter AS nama_dokter, perawat.nama_perawat AS nama_perawat from transaksi, pasien, detail_diagnosa, terapi, dokter, perawat WHERE transaksi.id_pasien = pasien.id_pasien AND transaksi.id_transaksi=detail_diagnosa.id_transaksi AND detail_diagnosa.id_terapi=terapi.id_terapi AND dokter.id_dokter=transaksi.id_dokter AND perawat.id_perawat=transaksi.id_perawat AND transaksi.tanggal = '$q'");

	$s = "";
	
	while($rep = $result->fetch_assoc()){
		$s = $s . "
                   <tr>
                      <td>
                        $rep[tanggal]
                      </td>
                      <td>
                        $rep[nama_pasien]
                      </td>
                      <td>
                        $rep[jenis_kelamin]
                      </td>
                      <td>
                        $rep[alamat]
                      </td>
                      <td>
                        $rep[tanggal_lahir]
                      </td>
					  <td>
						$rep[no_rekam_medis]
					  </td>
                      <td>
                        $rep[nama_terapi]
                      </td>
                      <td>
                        Rp " . number_format($rep['biaya'], 0 , ",", ".") . "
                      </td>
					  <td>
						$rep[nama_dokter] / $rep[nama_perawat]
					  </td>
                    </tr>
                  ";
	}

	echo $s;

	//Fungsi
	function GetData($conn, $sql){
	    $result = $conn -> query($sql);
	    //echo $result -> num_rows;
	    if($result -> num_rows > 0){
	      return $result -> fetch_assoc();
	    } else {
	      return false;
	    }
	}
?>