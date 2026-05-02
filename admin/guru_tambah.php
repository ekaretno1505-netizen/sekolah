<?php 
include '../koneksi.php';
    if(isset($_POST['simpan'])){
        $username=$_POST['username'];
        $password=$_POST['password'];
        $status='Guru';
        $nip=$_POST['nip'];
        $nama_guru=strtoupper($_POST['nama_guru']);
        $kode_guru=strtoupper($_POST['kode_guru']);
        $jenis_kelamin=strtoupper($_POST['jenis_kelamin']);
        $tempat_lahir=strtoupper($_POST['tempat_lahir']);
        $tanggal_lahir=$_POST['tanggal_lahir'];
        $alamat=strtoupper($_POST['alamat']);
        $agama=strtoupper($_POST['agama']);

        if($username==$nip){
            $password = password_hash($password, PASSWORD_DEFAULT);
            $query1=mysqli_query($koneksi,"insert into tb_pengguna(username, password, status) values('$username','$password', '$status')") or die (mysqli_error()); 

            $query=mysqli_query($koneksi,"insert into tb_guru(nip, nama_guru, kode_guru, jenis_kelamin, tempat_lahir, tanggal_lahir, alamat, agama) 
                                values('$nip','$nama_guru', '$kode_guru', '$jenis_kelamin',  '$tempat_lahir', '$tanggal_lahir', '$alamat', '$agama')") 
                                or die (mysqli_error());
            
            if($query){
                echo '<script>window.location="guru_lihat.php?page=siswa&&success=tambah-data"</script>';
            }else{
                echo "<script>alert('Tambah data gagal!');document.location.href='guru.php'</script>";
            }
        } 
        else {
            echo "<script>alert('Username dan Nip Tidak Cocok');document.location.href='guru.php'</script>";
        }
    }
    ?>