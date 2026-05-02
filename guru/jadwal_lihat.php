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
  <title>Guru</title>
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
            <?php if(isset($_GET['login'])){?>
                            <div class="alert alert-success" role="alert" >
                                <strong>Selamat Datang <?php echo $row['nama_guru']; ?> !</strong> Selamat Melakukan Pekerjaan
                            </div>
                      <?php }?>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="index.php">Home</a></li>
              <li class="breadcrumb-item active">Dashboard</li>
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
        <div class="col-md-4">
            <h3 class="page-header" style="margin-top:0px;">
                Data Guru
            </h3>
            <?php
                $viow=mysqli_query($koneksi,"select tb_pengguna.username, tb_guru.nama_guru
                                        from tb_pengguna, tb_guru
                                        where tb_pengguna.id_pengguna='$id_pengguna' AND tb_pengguna.username=tb_guru.nip");
                $rew=mysqli_fetch_array($viow);

            ?>
            <div class="form-group">
                <label>Nama</label>
                <input class="form-control" value=" <?php echo $rew['nama_guru']; ?>" readonly="readonly">
            </div><br>

            <?php
                $view=mysqli_query($koneksi,"select tb_pengguna.username, tb_mengajar.id_mengajar, tb_mengajar.kode_mapel, tb_guru.kode_guru, tb_mapel.mapel
                                        from tb_pengguna, tb_mengajar, tb_guru, tb_mapel 
                                        where tb_pengguna.id_pengguna='$id_pengguna' AND tb_pengguna.username=tb_guru.nip AND tb_guru.kode_guru=tb_mengajar.kode_guru 
                                        AND tb_mengajar.kode_mapel=tb_mapel.kode_mapel") or die (mysql_error());
                $hitung=mysqli_num_rows($view);
            ?>
            <label>Jumlah Mata Pelajaran : <?php echo $hitung; ?></label><br>
            <?php
                while($row=mysqli_fetch_array($view)){
            ?>
            <div class="form-group">
                <label>Mata Pelajaran</label>
                <input class="form-control" value=" <?php echo $row['mapel']; ?>" readonly="readonly">
            </div>

            <div class="form-group">
                <label>Kode Mapel</label>
                <input class="form-control" value=" <?php echo $row['kode_mapel']; ?>" readonly="readonly">
            </div><br>
            <?php
                }
            ?>
        </div>


        
        <div class="col-lg-8" style="border-left: 1px solid #ccc;">
            <h3 class="page-header" style="margin-top:0px;">
                Jadwal Mengajar
            </h3>
            <div class="table-responsive">
                <div class="row">
                    <div class="col-lg-6">
                        <h4 class="page-header" style="margin-top:7px;" align="center">
                            SENIN
                        </h4>
                        <table class="table table-hover table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Kelas</th>
                                    <th>KM</th>
                                    <th>Waktu</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    $view1=mysqli_query($koneksi,"select tb_pengguna.username, tb_mengajar.id_mengajar, tb_guru.kode_guru, 
                                                        tb_jadwal.id_mengajar, tb_jadwal.hari, tb_jadwal.jam_mulai, tb_jadwal.jam_berakhir, tb_jadwal.id_kelas, 
                                                        tb_mengajar.kode_mapel, tb_kelas.kelas
                                                        from tb_pengguna, tb_mengajar, tb_guru, tb_jadwal, tb_kelas
                                                        where tb_pengguna.id_pengguna='$id_pengguna' AND tb_pengguna.username=tb_guru.nip AND tb_guru.kode_guru=tb_mengajar.kode_guru 
                                                        AND tb_mengajar.id_mengajar=tb_jadwal.id_mengajar AND tb_jadwal.id_kelas=tb_kelas.id_kelas AND tb_jadwal.hari='Senin'
                                                        order by jam_mulai asc");
                                    $no=1;
                                    while($raw1=mysqli_fetch_array($view1)){
                                ?>
                                <tr>
                                    <td><?php echo $no; ?></td>
                                    <td><?php echo $raw1['kelas']; ?></td>
                                    <td><?php echo $raw1['kode_mapel']; ?></td>
                                    <td><?php echo $raw1['jam_mulai']; ?> - <?php echo $raw1['jam_berakhir'] ?></td>
                                </tr>
                                <?php
                                    $no++;
                                    }
                                ?>
                            </tbody>
                        </table>
                    </div>
                    <div class="col-lg-6">
                        <h4 class="page-header" style="margin-top:7px;" align="center">
                            SELASA
                        </h4>
                        <table class="table table-hover table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Kelas</th>
                                    <th>KM</th>
                                    <th>Waktu</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    $view2=mysqli_query($koneksi,"select tb_pengguna.username, tb_mengajar.id_mengajar, tb_guru.kode_guru, 
                                                        tb_jadwal.id_mengajar, tb_jadwal.hari, tb_jadwal.jam_mulai, tb_jadwal.jam_berakhir, tb_jadwal.id_kelas, 
                                                        tb_mengajar.kode_mapel, tb_kelas.kelas
                                                        from tb_pengguna, tb_mengajar, tb_guru, tb_jadwal, tb_kelas
                                                        where tb_pengguna.id_pengguna='$id_pengguna' AND tb_pengguna.username=tb_guru.nip AND tb_guru.kode_guru=tb_mengajar.kode_guru 
                                                        AND tb_mengajar.id_mengajar=tb_jadwal.id_mengajar AND tb_jadwal.id_kelas=tb_kelas.id_kelas AND tb_jadwal.hari='Selasa'
                                                        order by jam_mulai asc");
                                    $no=1;
                                    while($raw2=mysqli_fetch_array($view2)){
                                ?>
                                <tr>
                                    <td><?php echo $no; ?></td>
                                    <td><?php echo $raw2['kelas']; ?></td>
                                    <td><?php echo $raw2['kode_mapel']; ?></td>
                                    <td><?php echo $raw2['jam_mulai']; ?> - <?php echo $raw2['jam_berakhir'] ?></td>
                                </tr>
                                <?php
                                    $no++;
                                    }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-6">
                        <h4 class="page-header" style="margin-top:7px;" align="center">
                            RABU
                        </h4>
                        <table class="table table-hover table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Kelas</th>
                                    <th>KM</th>
                                    <th>Waktu</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    $view3=mysqli_query($koneksi,"select tb_pengguna.username, tb_mengajar.id_mengajar, tb_guru.kode_guru, 
                                                        tb_jadwal.id_mengajar, tb_jadwal.hari, tb_jadwal.jam_mulai, tb_jadwal.jam_berakhir, tb_jadwal.id_kelas, 
                                                        tb_mengajar.kode_mapel, tb_kelas.kelas
                                                        from tb_pengguna, tb_mengajar, tb_guru, tb_jadwal, tb_kelas
                                                        where tb_pengguna.id_pengguna='$id_pengguna' AND tb_pengguna.username=tb_guru.nip AND tb_guru.kode_guru=tb_mengajar.kode_guru 
                                                        AND tb_mengajar.id_mengajar=tb_jadwal.id_mengajar AND tb_jadwal.id_kelas=tb_kelas.id_kelas AND tb_jadwal.hari='Rabu'
                                                        order by jam_mulai asc");
                                    $no=1;
                                    while($raw3=mysqli_fetch_array($view3)){
                                ?>
                                <tr>
                                    <td><?php echo $no; ?></td>
                                    <td><?php echo $raw3['kelas']; ?></td>
                                    <td><?php echo $raw3['kode_mapel']; ?></td>
                                    <td><?php echo $raw3['jam_mulai']; ?> - <?php echo $raw3['jam_berakhir'] ?></td>
                                </tr>
                                <?php
                                    $no++;
                                    }
                                ?>
                            </tbody>
                        </table>
                    </div>
                    <div class="col-lg-6">
                        <h4 class="page-header" style="margin-top:7px;" align="center">
                            KAMIS
                        </h4>
                        <table class="table table-hover table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Kelas</th>
                                    <th>KM</th>
                                    <th>Waktu</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    $view4=mysqli_query($koneksi,"select tb_pengguna.username, tb_mengajar.id_mengajar, tb_guru.kode_guru, 
                                                        tb_jadwal.id_mengajar, tb_jadwal.hari, tb_jadwal.jam_mulai, tb_jadwal.jam_berakhir, tb_jadwal.id_kelas, 
                                                        tb_mengajar.kode_mapel, tb_kelas.kelas
                                                        from tb_pengguna, tb_mengajar, tb_guru, tb_jadwal, tb_kelas
                                                        where tb_pengguna.id_pengguna='$id_pengguna' AND tb_pengguna.username=tb_guru.nip AND tb_guru.kode_guru=tb_mengajar.kode_guru 
                                                        AND tb_mengajar.id_mengajar=tb_jadwal.id_mengajar AND tb_jadwal.id_kelas=tb_kelas.id_kelas AND tb_jadwal.hari='Kamis'
                                                        order by jam_mulai asc");
                                    $no=1;
                                    while($raw4=mysqli_fetch_array($view4)){
                                ?>
                                <tr>
                                    <td><?php echo $no; ?></td>
                                    <td><?php echo $raw4['kelas']; ?></td>
                                    <td><?php echo $raw4['kode_mapel']; ?></td>
                                    <td><?php echo $raw4['jam_mulai']; ?> - <?php echo $raw4['jam_berakhir'] ?></td>
                                </tr>
                                <?php
                                    $no++;
                                    }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-6">
                        <h4 class="page-header" style="margin-top:7px;" align="center">
                            JUM'AT
                        </h4>
                        <table class="table table-hover table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Kelas</th>
                                    <th>KM</th>
                                    <th>Waktu</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    $view5=mysqli_query($koneksi,"select tb_pengguna.username, tb_mengajar.id_mengajar, tb_guru.kode_guru, 
                                                        tb_jadwal.id_mengajar, tb_jadwal.hari, tb_jadwal.jam_mulai, tb_jadwal.jam_berakhir, tb_jadwal.id_kelas, 
                                                        tb_mengajar.kode_mapel, tb_kelas.kelas
                                                        from tb_pengguna, tb_mengajar, tb_guru, tb_jadwal, tb_kelas
                                                        where tb_pengguna.id_pengguna='$id_pengguna' AND tb_pengguna.username=tb_guru.nip AND tb_guru.kode_guru=tb_mengajar.kode_guru 
                                                        AND tb_mengajar.id_mengajar=tb_jadwal.id_mengajar AND tb_jadwal.id_kelas=tb_kelas.id_kelas AND tb_jadwal.hari='Jumat'
                                                        order by jam_mulai asc");
                                    $no=1;
                                    while($raw5=mysqli_fetch_array($view5)){
                                ?>
                                <tr>
                                    <td><?php echo $no; ?></td>
                                    <td><?php echo $raw5['kelas']; ?></td>
                                    <td><?php echo $raw5['kode_mapel']; ?></td>
                                    <td><?php echo $raw5['jam_mulai']; ?> - <?php echo $raw5['jam_berakhir'] ?></td>
                                </tr>
                                <?php
                                    $no++;
                                    }
                                ?>
                            </tbody>
                        </table>
                    </div>
                    <div class="col-lg-6">
                        <h4 class="page-header" style="margin-top:7px;" align="center">
                            SABTU
                        </h4>
                        <table class="table table-hover table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Kelas</th>
                                    <th>KM</th>
                                    <th>Waktu</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    $view6=mysqli_query($koneksi,"select tb_pengguna.username, tb_mengajar.id_mengajar, tb_guru.kode_guru, 
                                                        tb_jadwal.id_mengajar, tb_jadwal.hari, tb_jadwal.jam_mulai, tb_jadwal.jam_berakhir, tb_jadwal.id_kelas, 
                                                        tb_mengajar.kode_mapel, tb_kelas.kelas
                                                        from tb_pengguna, tb_mengajar, tb_guru, tb_jadwal, tb_kelas
                                                        where tb_pengguna.id_pengguna='$id_pengguna' AND tb_pengguna.username=tb_guru.nip AND tb_guru.kode_guru=tb_mengajar.kode_guru 
                                                        AND tb_mengajar.id_mengajar=tb_jadwal.id_mengajar AND tb_jadwal.id_kelas=tb_kelas.id_kelas AND tb_jadwal.hari='Sabtu'
                                                        order by jam_mulai asc");
                                    $no=1;
                                    while($raw6=mysqli_fetch_array($view6)){
                                ?>
                                <tr>
                                    <td><?php echo $no; ?></td>
                                    <td><?php echo $raw6['kelas']; ?></td>
                                    <td><?php echo $raw6['kode_mapel']; ?></td>
                                    <td><?php echo $raw6['jam_mulai']; ?> - <?php echo $raw6['jam_berakhir'] ?></td>
                                </tr>
                                <?php
                                    $no++;
                                    }
                                ?>
                            </tbody>
                        </table>
                    </div>
                  </div>
                </div>
            </div>
        </div>
    </div>
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
<script src="../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- ChartJS -->
<script src="../plugins/chart.js/Chart.min.js"></script>
<!-- Sparkline -->
<script src="../plugins/sparklines/sparkline.js"></script>
<!-- JQVMap -->
<script src="../plugins/jqvmap/jquery.vmap.min.js"></script>
<script src="../plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
<!-- jQuery Knob Chart -->
<script src="../plugins/jquery-knob/jquery.knob.min.js"></script>
<!-- daterangepicker -->
<script src="../plugins/moment/moment.min.js"></script>
<script src="../plugins/daterangepicker/daterangepicker.js"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="../plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
<!-- Summernote -->
<script src="../plugins/summernote/summernote-bs4.min.js"></script>
<!-- overlayScrollbars -->
<script src="../plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE App -->
<script src="../dist/js/adminlte.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="../dist/js/pages/dashboard.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="../dist/js/demo.js"></script>
<!-- Morris Charts JavaScript -->
<script src="../dist/js/morris/raphael.min.js"></script>
<script src="../dist/js/morris/morris.min.js"></script>
<script src="../dist/js/morris/morris-data.js"></script>
<script src="../dist/js/responsive-tabs.js"></script>
<script src="../dist/js/jfunc.js"></script>
</body>
</html>
<?php
}
else{
echo '<script language="javascript">alert("Anda Harus Login!"); document.location="../index.php";</script>';
}
?>