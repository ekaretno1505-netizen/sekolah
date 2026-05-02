<?php
include "koneksi.php";
$kode = @$_GET['id'];

mysqli_query($koneksi,"delete from tb_kelas where id_kelas = '$kode'") or die (mysql_error());
echo '<script>window.location="kelas.php?id='.$kode.'page=kelas&&remove=hapus-data"</script>';
?>