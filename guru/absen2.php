<?php
include '../koneksi.php';
session_start();
if(isset($_SESSION['username'])){
  $id_pengguna=$_SESSION['id_pengguna'];
    $view=mysqli_query($koneksi,"select 
                                        tb_pengguna.username, 
                                        tb_guru.nama_guru
                                    from 
                                        tb_pengguna, 
                                        tb_guru
                                    where 
                                        tb_pengguna.id_pengguna='$id_pengguna' 
                                        AND tb_pengguna.username=tb_guru.nip");
    $row=mysqli_fetch_array($view);
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
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="index.php">Home</a></li>
              <li class="breadcrumb-item active">Absensi</li>
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
            <h3 class="card-title">Absen</h3>

            <div class="card-tools">
              <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
              <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i></button>
            </div>
          </div>
          <div class="card-body">
            <div class="row">
               <div class="col-lg-12">

<!-- Script ambil data dari halaman sebelumnya -->
<?php
    if(@$_POST['lanjut']){
        $tanggal1=date('Y-m-d');
        $id_jadwal=$_POST['id_jadwal'];

    $view2=mysqli_query($koneksi,"select tb_jadwal.id_kelas, tb_kelas.kelas from tb_jadwal, tb_kelas 
                        where id_jadwal='$id_jadwal' AND tb_jadwal.id_kelas=tb_kelas.id_kelas") or die (mysqli_error());
    $row2=mysqli_fetch_array($view2);

    $kelas=$row2['kelas'];
    $kelasid=$row2['id_kelas'];

    $view4=mysqli_query($koneksi,"select 
                            tb_absensi.tanggal, 
                            tb_absensi.nis,
                            tb_siswa.id_kelas
                        from 
                            tb_absensi,
                            tb_siswa
                        where
                            tb_absensi.nis=tb_siswa.nis
                            AND tb_absensi.tanggal='$tanggal1'
                            AND tb_siswa.id_kelas='$kelasid'");
    $cek=mysqli_num_rows($view4);
?>

<!-- ISI -->
<div class="row">
    <div class="col-lg-8">
        <h3 class="page-header">
            Absen Kelas <?php echo $kelas; ?>
        </h3> 

        <form method="post">
            <div class="table-responsive">
                <?php
                    $view3=mysqli_query($koneksi,"select * from tb_siswa where id_kelas='$kelasid'");
                    $no=0;
                ?>
                <input type="hidden" value="<?php echo $tanggal1; ?>" name="tanggal">
                <input type="hidden" value="<?php echo $id_jadwal; ?>" name="id_jadwal">
                <input type="hidden" value="<?php echo $cek; ?>" name="cek">
                <table class="table table-bordered table-hover table-striped">
                    <thead>
                        <tr>
                            <th class="col-md-2">NIS</th>
                            <th class="col-md-6">Nama</th>
                            <th class="col-md-1">Hadir</th>
                            <th class="col-md-1">Sakit</th>
                            <th class="col-md-1">Ijin</th>
                            <th class="col-md-1">Alfa</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            while($row3=mysqli_fetch_array($view3)){
                        ?>
                        <tr>
                            <td style="text-align: left;"><?php echo $row3['nis']; ?></td>
                            <td style="text-align: left;"><?php echo $row3['nama_siswa']; ?></td>
                            <td><input name="ket<?php echo $no; ?>" type="radio" value="H"></td>
                            <td><input name="ket<?php echo $no; ?>" type="radio" value="S"></td>
                            <td><input name="ket<?php echo $no; ?>" type="radio" value="I"></td>
                            <td><input name="ket<?php echo $no; ?>" type="radio" value="A"></td>
                        </tr>
                        
                        <input type="hidden" name="nis<?php echo $no; ?>" value="<?php echo $row3['nis']; ?>">

                        <?php
                            $no++;
                            }
                        ?>
                        <input type="hidden" value="<?php echo $no; ?>" name="no">
                    </tbody>
                    </table>
            </div>
            <input type="submit" name="input" class="btn btn-default" value="Selesai"/>
        </form>        
    </div>

<?php
}
?>
    
    <!-- Script Input Data -->
    <?php
        if (@$_POST['input']){
            $no=$_POST['no'];
            $tanggal=$_POST['tanggal'];
            $id_jadwal=$_POST['id_jadwal'];
            $cek=$_POST['cek'];

            if($cek==0){
                for($a=0;$a<$no;$a++){
                    $ket = $_POST['ket'.$a];
                    $nis = $_POST['nis'.$a];

                    $query=mysqli_query($koneksi,"insert into tb_absensi(id_jadwal, tanggal, nis, ket) values('$id_jadwal','$tanggal','$nis','$ket')") or die (mysqli_error());
                }
            }


            if($query){
            ?>
                <script type="text/javascript">
                alert("Input Data Sukses !")
                window.location="absen.php?page=absensi";
                </script>
            <?php
            }else{
            ?>
                <script type="text/javascript">
                alert("Input Data Gagal !")
                window.location="absen.php?page=absensi";
                </script>
            <?php
            } 
        }
    ?>

    <div class="col-lg-4">
    
    Keterangan
    </div>
</div>
            </div>
          </div>
            <!-- /.row -->
          <!-- /.card-body -->
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