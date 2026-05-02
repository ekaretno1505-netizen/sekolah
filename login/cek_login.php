<?php
include "../koneksi.php";
$username = $_POST['username'];
$password = $_POST['password'];
$cek      = mysqli_query($koneksi,"select * from tb_pengguna where username='$username'");
$result   = mysqli_num_rows($cek);
session_start();

if($result === 1){
    while ($data = mysqli_fetch_assoc($cek)) {
        if(password_verify($password, $data['password'])){
            if ($data['status'] == 'Admin') {
                $_SESSION['id_pengguna'] = $data['id_pengguna'];
                $_SESSION['username'] = $data['username'];
                echo '<script>window.location="../admin/index.php?page=index&&login=login"</script>';
            }
            elseif($data['status'] == 'TU'){
                $_SESSION['id_pengguna'] = $data['id_pengguna'];
                $_SESSION['username'] = $data['username'];
                echo '<script>window.location="../tu/index.php?page=index&&login=login"</script>';
            }
            elseif($data['status'] == 'Guru'){
                $_SESSION['id_pengguna'] = $data['id_pengguna'];
                $_SESSION['username'] = $data['username'];
                echo '<script>window.location="../guru/index.php?page=index&&login=login"</script>';
            }
        }
        else{
            echo "<script>alert('Password Salah');document.location.href='../index.php'</script>";
        }
    }
}
else {
    echo "<script>alert('Tidak Ada data');document.location.href='../index.php'</script>";
}

?>