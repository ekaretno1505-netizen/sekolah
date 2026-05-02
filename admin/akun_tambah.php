<?php 
                  include '../koneksi.php';
                  if (isset($_POST['simpan'])) {
                    $cekdulu= "select * from tb_pengguna where username='$_POST[username]'";
                    $prosescek= mysqli_query($koneksi, $cekdulu);
                    if (mysqli_num_rows($prosescek)>0) { //proses mengingatkan data sudah ada
                        echo "<script>alert('Username Sudah Digunakan');history.go(-1) </script>";
                    }
                    else {
                      $username = $_POST['username'];
                      $password = $_POST['password'];
                      $kpassword = $_POST['kpassword'];
                      $status = $_POST['status'];

                      if ($password == $kpassword) {
                        $password = password_hash($password, PASSWORD_DEFAULT);
                        $query = "SELECT username from tb_pengguna WHERE username = '$username'";
                        $result = mysqli_query($koneksi, $query);
                        if (mysqli_fetch_assoc($result)) {
                         echo "<script>alert('Username telah digunakan');document.location.href='akun.php'</script>";
                        }
                        else{
                          $query = "INSERT INTO tb_pengguna VALUES (NULL,'$username','$password','$status')";
                          $result = mysqli_query($koneksi, $query);

                          if(!$result){
                             die ("Query gagal dijalankan: ".mysqli_errno($koneksi).
                                   " - ".mysqli_error($koneksi));
                          }
                          echo '<script>window.location="akun.php?page=siswa&&success=tambah-data"</script>';
                        }
                      }
                      else{
                        echo "<script>alert('Password Tidak Cocok');document.location.href='akun.php'</script>";
                      }
                   }
                 }
?>