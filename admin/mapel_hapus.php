<?php
include "koneksi.php";
$kode = @$_GET['id'];

mysqli_query($koneksi,"delete from tb_mapel where id_mapel = '$kode'") or die (mysqliw_error());
echo '<script>window.location="guru_lihat.php?id='.$kode.'page=guru&&remove=hapus-data"</script>';
?>