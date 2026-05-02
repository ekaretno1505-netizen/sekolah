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
              <li class="breadcrumb-item active">Input Guru</li>
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
            <h3 class="card-title">Guru & Akun</h3>

            <div class="card-tools">
              <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
              <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i></button>
            </div>
          </div>
          <!-- /.card-header -->
          <?php
              $id = @$_GET['id'];
              $qrykoreksi=mysqli_query($koneksi,"select * from tb_guru where id_guru='$id'");
              $data=mysqli_fetch_object($qrykoreksi);
          ?>
          <form method="post">
          <div class="card-body">
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                    <label>NIP</label>
                    <input type="number" class="form-control" value="<?php echo $data->nip;?>" name="nip" placeholder="NIP">
                    <?php
                       $a=mysqli_query($koneksi,"select * from tb_pengguna where username='$data->nip'"); 
                       $b=mysqli_fetch_object($a);
                    ?>
                </div>
                
                <div class="form-group">
                    <label>Nama</label>
                    <input class="form-control" name="nama_guru" placeholder="Nama Guru" value="<?php echo $data->nama_guru;?>" required>
                </div>
                <div class="form-group">
                    <label>Jenis Kelamin</label>
                    <select name="jenis_kelamin" class="form-control" required>
                        <option value="">Jenis Kelamin</option>
                        <option value="Laki-laki" <?php if($data->jenis_kelamin == 'LAKI-LAKI'){ echo 'selected'; } ?>>Laki-laki</option>
                        <option value="Perempuan" <?php if($data->jenis_kelamin == 'PEREMPUAN'){ echo 'selected'; } ?>>Perempuan</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Tempat Lahir</label>
                    <input class="form-control" name="tempat_lahir" placeholder="Tempat Lahir" value="<?php echo $data->tempat_lahir;?>" required>
                </div>
              </div>
               <div class="col-md-6">
                <div class="form-group">
                    <label>Tanggal Lahir</label>
                    <input type="date" class="form-control" name="tanggal_lahir" id="from" value="<?php echo $data->tanggal_lahir;?>">
                </div>
                <div class="form-group">
                    <label>Alamat</label>
                    <input class="form-control" name="alamat" placeholder="Alamat" value="<?php echo $data->alamat;?>" required>
                </div>
                <div class="form-group">
                    <label>Agama</label>
                    <input class="form-control" name="agama" placeholder="Agama" value="<?php echo $data->agama;?>" required>
                </div>
                <div class="form-group">
                    <label>Kode Guru</label>
                    <input class="form-control" name="kode_guru" value="<?php echo $data->kode_guru;?>" placeholder="Kode Guru" required>
                </div>
                          <!-- /.form-group -->
                  <input type="submit" name="edit" class="btn btn-default" value="Input"/>
              </div>
            </div>
        </div>
        </form>
        <?php 
          if(isset($_POST['edit'])){
              $nip=$_POST['nip'];
              $nama_guru=strtoupper($_POST['nama_guru']);
              $kode_guru=strtoupper($_POST['kode_guru']);
              $jenis_kelamin=strtoupper($_POST['jenis_kelamin']);
              $tempat_lahir=strtoupper($_POST['tempat_lahir']);
              $tanggal_lahir=$_POST['tanggal_lahir'];
              $alamat=strtoupper($_POST['alamat']);
              $agama=strtoupper($_POST['agama']);
              
              $query=mysqli_query($koneksi,"UPDATE tb_guru SET nip='$nip', nama_guru='$nama_guru', kode_guru='$kode_guru', jenis_kelamin='$jenis_kelamin', tempat_lahir='$tempat_lahir',
                                  tanggal_lahir='$tanggal_lahir', alamat='$alamat', agama='$agama' WHERE id_guru='$id'") 
                                  or die (mysql_error());
              $query1=mysqli_query($koneksi,"UPDATE tb_pengguna SET username='$nip' where id_pengguna='$b->id_pengguna'");
              if($query){
                echo '<script>window.location="guru_lihat.php?id='.$id_guru.'page=guru&edit=edit-data"</script>';
              }else{
              ?>
                  <script type="text/javascript">
                  alert("Input Data Gagal !")
                  window.location="guru_lihat.php?page=lihatguru";
                  </script>
              <?php
              } 
          }
    ?>
            <!-- /.row -->
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