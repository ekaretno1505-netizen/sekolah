<?php
include "../koneksi.php";
$kode = $_GET['id'];

mysqli_query($koneksi,"delete from tb_jadwal where id_jadwal = '$kode'") or die (mysqli_error());

echo '<script>window.location="jadwal_lihat.php?id='.$kode.'page=jadwal&&remove=hapus-data"</script>';
?>
