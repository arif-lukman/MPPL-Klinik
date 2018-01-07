<?php
	//include
	include "../../connection/connect.php";

	//ambil parameter
	$q = $_GET['q'];

	//ambil data

	$result = $conn->query("SELECT * FROM obat, satuan WHERE obat.id_satuan = satuan.id_satuan and nama_obat LIKE '%$q%'");
	//echo "SELECT nama_pasien FROM pasien WHERE nama_pasien LIKE '%$q%'";
	//balikin
	$s = "";
	
	while($obat = $result->fetch_assoc()){
		$s = $s . "
                   <tr>
                      <td>
                        $obat[nama_obat]
                      </td>
                      <td>
                        $obat[nama_satuan]
                      </td>
                      <td>
                        $obat[stok]
                      </td>
                      <td>
                        $obat[harga]
                      </td>
					  <td align =\"right\">
						<a href=\"stokobat_tambah.php?id_obat=$obat[id_obat]\" class=\"btn btn-success btn-sm\" role=\"button\"><i class=\"fa fa-plus\"></i> Stok</a>
						<a href=\"stokobat_kurang.php?id_obat=$obat[id_obat]\" class=\"btn btn-warning btn-sm\" role=\"button\"><i class=\"fa fa-minus\"></i> Stok</a>
						</td>
                      <td align =\"right\">
                        <a href=\"edit_obat.php?id_obat=$obat[id_obat]\" class=\"btn btn-primary btn-xs\" role=\"button\"><i class=\"fa fa-pencil\"></i></a>
                        
                        <a href=\"act/hapus_obat.php?id_obat=$obat[id_obat]\" class=\"btn btn-danger btn-xs\" role=\"button\"><i class=\"fa fa-trash-o\"></i></a>
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