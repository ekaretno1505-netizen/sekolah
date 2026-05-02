 <?php 
 include '../koneksi.php';
    if(isset($_POST['simpan'])){

        $cekdulu= "select * from tb_siswa where nis='$_POST[nis]'";
        $prosescek= mysqli_query($koneksi, $cekdulu);
        if (mysqli_num_rows($prosescek)>0) { //proses mengingatkan data sudah ada
            echo "<script>alert('NIS Sudah Digunakan');history.go(-1) </script>";
        }
        else { //proses menambahkan data, tambahkan sesuai dengan yang kalian gunakan
            $nis=$_POST['nis'];
            $nama_siswa=strtoupper($_POST['nama_siswa']);
            $jenis_kelamin=strtoupper($_POST['jenis_kelamin']);
            $tempat_lahir=strtoupper($_POST['tempat_lahir']);
            $tanggal_lahir=$_POST['tanggal_lahir'];
            $alamat=strtoupper($_POST['alamat']);
            $agama=strtoupper($_POST['agama']);
            $nama_ortu=strtoupper($_POST['nama_ortu']);
            $no_ortu=strtoupper($_POST['no_ortu']);
            $biaya  = $_POST['biaya'];
            $awaltempo = $_POST['jatuhtempo'];
            $kelas=strtoupper($_POST['kelas']);
            $bulanIndo = array(
            '01' => 'Januari',
            '02' => 'Februari',
            '03' => 'Maret',
            '04' => 'April',
            '05' => 'Mei',
            '06' => 'Juni',
            '07' => 'Juli',
            '08' => 'Agustus',
            '09' => 'September',
            '10' => 'Oktober',
            '11' => 'November',
            '12' => 'Desember'
        );

            $query=mysqli_query($koneksi,"insert into tb_siswa(nis, nama_siswa, jenis_kelamin, tempat_lahir, tanggal_lahir, alamat, agama, nama_ortu, no_ortu, biaya, id_kelas) values('$nis','$nama_siswa', '$jenis_kelamin',  '$tempat_lahir', '$tanggal_lahir', '$alamat', '$agama', '$nama_ortu', '$no_ortu', '$biaya','$kelas')") or die (mysql_error());
            
            if($query){
                $ds=mysqli_fetch_array(mysqli_query($koneksi, "SELECT id_siswa FROM tb_siswa ORDER BY id_siswa DESC LIMIT 1"));
                $id_siswa = $ds['id_siswa'];
                $ket = 'Belum Bayar';

                //membuat tagihan (12 bulan dimulai dari Juli 2017 dan menyimpan tagihan di tabel spp
                for($i=0; $i<6; $i++){
                    //membuat tanggal jatuh tempo nya setiap tanggal 10
                    $jatuhtempo = date("Y-m-d", strtotime("+$i month", strtotime($awaltempo)));

                    $bulan = $bulanIndo[date('m', strtotime($jatuhtempo))]." ".date('Y',strtotime($jatuhtempo));

                    mysqli_query($koneksi, "INSERT INTO tb_spp (id_siswa,jatuhtempo,bulan,jumlah,ket)
                                values('$id_siswa','$jatuhtempo','$bulan','$biaya', '$ket')");
                }
                 echo '<script>window.location="siswa.php?page=siswa&&success=tambah-data"</script>';
            }else{
                 echo "<script>alert('Gagal tambah data');document.location.href='../index.php'</script>";
            }
            
        }
    }
    ?>