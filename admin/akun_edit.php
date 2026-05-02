<?php
include '../koneksi.php';
session_start();
if(isset($_SESSION['username'])){
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Admin</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="../plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Tempusdominus Bbootstrap 4 -->
  <link rel="stylesheet" href="../plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="../plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- JQVMap -->
  <link rel="stylesheet" href="../plugins/jqvmap/jqvmap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../dist/css/adminlte.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="../plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="../plugins/daterangepicker/daterangepicker.css">
  <!-- summernote -->
  <link rel="stylesheet" href="../plugins/summernote/summernote-bs4.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

  <!-- Navbar -->
  <?php include 'tamplate/nav.php'; ?>
  <!-- /.navbar -->
  <?php include 'tamplate/sidebar.php'; ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <?php if(isset($_GET['success'])){?>
                            <div class="alert alert-success" role="alert">
                              <strong>Tambah Data Berhasil ! </strong>
                            </div>
                            <?php }?>
                            <?php if(isset($_GET['edit'])){?>
                            <div class="alert alert-success" role="alert">
                              <strong>Update Data Berhasil ! </strong>
                            </div>
                            <?php }?>
                          <?php if(isset($_GET['remove'])){?>
                            <div class="alert alert-danger" role = "alert">
                              <strong>Hapus Data Berhasil !</strong>
                            </div>
                          <?php }?>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="index.php">Home</a></li>
              <li class="breadcrumb-item active">Edit Akun</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- SELECT2 EXAMPLE -->
        <div class="card card-default">
          <div class="card-header">
            <h3 class="card-title">Pengguna</h3>

            <div class="card-tools">
              <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
              <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i></button>
            </div>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
            <div class="row">
              <div class="col-lg-5">
        <h3 class="page-header">
            Edit Account
        </h3>

        <!-- Sript ambil data -->
        <?php
            $id = @$_GET['id'];
            $qrykoreksi=mysqli_query($koneksi,"select * from tb_pengguna where id_pengguna='$id'");
            $data=mysqli_fetch_array($qrykoreksi);

            if($data['status']=='Guru'){
        ?>
        <form method="post">
            <div class="form-group">
                <label>Username</label>
                <input class="form-control" name="username" value="<?php echo $data['username']; ?>" readonly="readonly">
            </div>
            <div class="form-group">
                <label>Password</label>
                <input  type="password" class="form-control" name="password" value="<?php echo $data['password']; ?>" required>
            </div>
            <input type="submit" name="edit" class="btn btn-default" value="Input"/>
        </form>
        <?php
            } else {
        ?>

        <form method="post">
            <div class="form-group">
                <label>Username</label>
                <input class="form-control" name="username" value="<?php echo $data['username']; ?>">
            </div>
            <div class="form-group">
                <label>Password</label>
                <input type="password" class="form-control" name="password" value="<?php echo $data['password']; ?>" required>
            </div>
            <input type="submit" name="edit" class="btn btn-default" value="Input"/>
        </form>

        <!-- Sript Update Data -->
        <?php
        }
        if(@$_POST['edit']){
            $username=$_POST['username'];
            $password=$_POST['password'];
            $password = password_hash($password, PASSWORD_DEFAULT);

            $query=mysqli_query($koneksi,"UPDATE tb_pengguna SET username='$username', password='$password'  WHERE id_pengguna='$id'") or die (mysqli_error());
            
            if($query){
                echo '<script>window.location="akun.php?page=akun&&edit=edit-data"</script>';
            }else{
                ?>
                    <script type="text/javascript">
                    alert("Edit Data Gagal !")
                    window.location="?page=account";
                    </script>
                <?php
            } 
        }
?>
    </div>
            </div>
            <!-- /.row -->
          </div>
          <!-- /.card-body -->
          <div class="card-footer">
          </div>
        </div>
        <!-- /.card -->
        <div class="row">
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <?php include 'tamplate/footer.php'; ?>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="../plugins/jquery/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="../plugins/jquery-ui/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="../plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- Select2 -->
<script src="../plugins/select2/js/select2.full.min.js"></script>
<!-- Bootstrap4 Duallistbox -->
<script src="../plugins/bootstrap4-duallistbox/jquery.bootstrap-duallistbox.min.js"></script>
<!-- InputMask -->
<script src="../plugins/moment/moment.min.js"></script>
<script src="../plugins/inputmask/min/jquery.inputmask.bundle.min.js"></script>
<!-- date-range-picker -->
<script src="../plugins/daterangepicker/daterangepicker.js"></script>
<!-- bootstrap color picker -->
<script src="../plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.min.js"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="../plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
<!-- Bootstrap Switch -->
<script src="../plugins/bootstrap-switch/js/bootstrap-switch.min.js"></script>
<!-- AdminLTE App -->
<script src="../dist/js/adminlte.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="../dist/js/pages/dashboard.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="../dist/js/demo.js"></script>
<script src="../dist/js/jfunc.js"></script>
</body>
</html>
<?php
}
else{
echo '<script language="javascript">alert("Anda Harus Login!"); document.location="../index.php";</script>';
}
?>