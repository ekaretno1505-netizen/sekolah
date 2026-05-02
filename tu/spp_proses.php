<?php 
session_start();
if(isset($_SESSION['username'])){
	include "../koneksi.php";
	if($_GET['act']=='bayar'){

		$id_spp 	= $_GET['id'];
		$nis	= $_GET['nis'];

		//tanggal Bayar
		$tglBayar 	= date('Y-m-d');

		//id admin
		$id_pengguna = $_SESSION['id_pengguna'];

		mysqli_query($koneksi, "UPDATE tb_spp SET
											tglbayar='$tglBayar',
											ket='LUNAS',
											id_pengguna='$id_pengguna'
									WHERE id_spp='$id_spp'");

		header('location:spp.php?nis='.$nis);
	}
}
?>