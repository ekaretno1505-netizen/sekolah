<?php
include "../koneksi.php";
$kode = @$_GET['id'];

mysqli_query($koneksi,"delete from tb_pengguna where id_pengguna = '$kode'") or die (mysql_error());

echo '<script>window.location="akun.php?id='.$kode.'page=akun&&remove=hapus-data"</script>';
?>
