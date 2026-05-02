<?php
include "../koneksi.php";
$kode = @$_GET['id'];
$a=mysqli_query($koneksi,"select nip from tb_guru where id_guru = '$kode'") or die (mysqli_error());
$b=mysqli_fetch_array($a);

mysqli_query($koneksi,"delete from tb_pengguna where username=$b[nip]") or die (mysqli_error());

mysqli_query($koneksi,"delete from tb_guru where id_guru = '$kode'") or die (mysqli_error());

echo '<script>window.location="guru_lihat.php?id='.$kode.'page=guru&&remove=hapus-data"</script>';
?>