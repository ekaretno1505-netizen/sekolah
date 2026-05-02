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
            <form action="absen2.php?page=absen2" method="post">
              <div class="card-body">
                <div class="row">
                  <div class="col-lg-5">
                      <h3 class="page-header">
                          Data Absensi
                      </h3> 
                          <div class="form-group">
                              <label>Tanggal</label>
                              <input class="form-control" value=" <?php echo tanggal("j M Y"); ?>" readonly="readonly">
                          </div>
                          
                          <div class="form-group">
                              <label>Hari</label>
                              <input class="form-control" value="<?php echo tanggal("D"); ?>" readonly="readonly">
                          </div>
                          <?php
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
                          <div class="form-group">
                              <label>Nama Guru</label>
                              <input class="form-control" value="<?php echo $row['nama_guru']; ?>" readonly="readonly">
                          </div>

                  </div>

                  <div class="col-lg-7">
                      <h3 class="page-header">
                          Pilih Jadwal Absensi
                      </h3>
                      <div class="table-respopnsive">
                          <?php
                              $jam=date("H:i");
                              $hari=tanggal("D");
                              $tanggal0=date('Y-m-d');
                              $view1=mysqli_query($koneksi,"select 
                                                      tb_pengguna.username, 
                                                      tb_mengajar.id_mengajar, 
                                                      tb_guru.kode_guru, 
                                                      tb_jadwal.id_jadwal,
                                                      tb_jadwal.id_kelas,  
                                                      tb_jadwal.hari, 
                                                      tb_jadwal.jam_mulai, 
                                                      tb_jadwal.jam_berakhir, 
                                                      tb_mapel.mapel,
                                                      tb_kelas.kelas
                                                  from 
                                                      tb_pengguna, 
                                                      tb_mengajar, 
                                                      tb_guru, 
                                                      tb_jadwal, 
                                                      tb_mapel,
                                                      tb_kelas 
                                                  where 
                                                      tb_pengguna.id_pengguna='$id_pengguna' 
                                                      AND tb_pengguna.username=tb_guru.nip 
                                                      AND tb_guru.kode_guru=tb_mengajar.kode_guru 
                                                      AND tb_mengajar.id_mengajar=tb_jadwal.id_mengajar 
                                                      AND tb_jadwal.hari='$hari' 
                                                      AND tb_mengajar.kode_mapel=tb_mapel.kode_mapel
                                                      AND tb_jadwal.id_kelas=tb_kelas.id_kelas
                                                      
                                                  order by 
                                                      tb_jadwal.jam_mulai asc")
                                      or die (mysqli_error());
                              
                          if(mysqli_num_rows($view1)>0){  
                          ?>
                          <table class="table table-bordered table-hover table-striped">
                              <thead>
                                  <tr>
                                      <th>Pilih</th>
                                      <th>Kelas</th>
                                      <th>Mata Pelajaran</th>
                                      <th>Waktu</th>
                                  </tr>
                              </thead>
                              <tbody>
                                  <?php
                                      while($row1=mysqli_fetch_array($view1)){
                                  ?>
                                  <tr>
                                      <td>
                                          <?php
                                              $ada=mysqli_query($koneksi,"select id_jadwal, tanggal from tb_absensi where tanggal='$tanggal0' and id_jadwal='$row1[id_jadwal]'");
                                              if(mysqli_num_rows($ada)>0){
                                                  ?><i class="fa fa-check"></i><?php
                                              } else {
                                                  ?><input name="id_jadwal" type="radio" value="<?php echo $row1['id_jadwal']; ?>"><?php
                                              }
                                          ?>
                                          
                                      </td>
                                      <td><?php echo $row1['kelas']; ?></td>
                                      <td><?php echo $row1['mapel'] ?></td>
                                      <td><?php echo $row1['jam_mulai']; ?> - <?php echo $row1['jam_berakhir']; ?></td>
                                  </tr>
                                  <?php
                                      }
                                ?>
                              </tbody>
                          </table>
                      </div>
                      <input type="submit" name="lanjut" class="btn btn-default" value="Ke Proses Absensi"/> 
                     
                      <?php
                    } else {
                      echo "Tidak ada jadwal hari ini<br><br>Silahkan lihat <a href='jadwal_lihat.php?page=lihatjadwal'>jadwal</a>";
                    }
                      ?>
                  </div>
              </div>
            </div>
            <form action="absen2.php?page=absen2" method="post">
          </div>
            <!-- /.row -->
          <!-- /.card-body -->

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