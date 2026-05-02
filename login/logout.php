<?php
session_start();

if(isset($_SESSION['username'])){

echo '<script language="javascript">alert("Anda berhasil Logout!"); document.location="../index.php";</script>';
session_unset();
session_destroy();
}
else{
echo '<script language="javascript">alert("Anda Harus Login!"); document.location="../index.php";</script>';
}
?>