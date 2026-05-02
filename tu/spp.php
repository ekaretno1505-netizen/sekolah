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
  <title>Tata Usaha</title>
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
            <?php if(isset($_GET['transaksi'])){?>
                            <div class="alert alert-success" role="alert">
                              <strong>Pembayaran Berhasil ! </strong>
                            </div>
                            <?php }?>
            <h1 class="m-0 text-dark"></h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="index.php">Home</a></li>
              <li class="breadcrumb-item active">Pembayaran Spp</li>
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
            <h3 class="card-title">Kelas</h3>

            <div class="card-tools">
              <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
              <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i></button>
            </div>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
            <div class="row">
               <div class="col-md-12">
                  <div class="card-header">
                    <div class="card-tools">
                      <form action="" method="get">
                      <div class="input-group input-group-sm" style="width: 300px;">
                        <input type="text" name="nis" class="form-control float-right" placeholder="Search">
                        <div class="input-group-append">
                        <button type="submit" name = "cari"class="btn btn-default"><i class="fas fa-search"></i></button>
                        </div>
                      </div>
                      </form>
                    </div>
                  </div>
                </div>
                  <?php
                      if(isset($_GET['nis']) && $_GET['nis']!=''){
                        $sqlSiswa = mysqli_query($koneksi, "SELECT * FROM tb_siswa WHERE nis='$_GET[nis]'");
                        $ds=mysqli_fetch_array($sqlSiswa);
                        $jumlah = mysqli_num_rows($sqlSiswa);
                        $nis = $ds['nis'];
                      ?>
              <div class="col-md-3">
                <div class="form-group">
                      <label>NIS</label>
                      <input class="form-control" value="<?php echo $ds['nis']; ?>" readonly="readonly">
                </div>
                <div class="form-group">
                      <label>Nama Siswa</label>
                      <input class="form-control" value="<?php echo $ds['nama_siswa']; ?>" readonly="readonly">
                </div>
              </div>
            <div class="col-md-9">
              <div class="card-body">
                    <table class="table table-bordered">
                      <thead>
                        <tr>
                          <th>No</th>
                          <th>Bulan</th>
                          <th>Jatuh Tempo</th>
                          <th>Tgl. Bayar</th>
                          <th>Jumlah</th>
                          <th>Keterangan</th>
                          <th>Bayar</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php
                          $sql = mysqli_query($koneksi, "SELECT * FROM tb_spp WHERE id_siswa='$ds[id_siswa]' ORDER BY jatuhtempo ASC");
                          $no=1;
                          if ($jumlah>0) {
                          while($d=mysqli_fetch_array($sql)){
                            echo "<tr>
                                  <td>$no</td>
                                  <td>$d[bulan]</td>
                                  <td>$d[jatuhtempo]</td>
                                  <td>$d[tglbayar]</td>
                                  <td>$d[jumlah]</td>
                                  <td>$d[ket]</td>
                                  <td align='center'>";
                                    if($d['ket']=='Belum Bayar'){
                                      echo "<a href='spp_proses.php?nis=$nis&act=bayar&id=$d[id_spp]'>Bayar</a>";
                                    }else{
                                      echo "-";
                                    }
                              echo "</td>
                            </tr>";
                            $no++;
                          }
                        }
                        else {    
                               echo "<script>alert('Tidak Ada Siswa');document.location.href='spp.php'</script>";
                            }
                          ?>

                        <?php
                        }
                        ?>
                      </tbody>
                    </table>
                  </div>
              </div>
            </div>
            <!-- /.row -->
          </div>
          <!-- /.card-body -->
        </div>
        <!-- /.card -->
        <div class="row">
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>

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
<script src="../dist/js/jfunc.js"></script>
</body>
</html>
<?php
}
else{
echo '<script language="javascript">alert("Anda Harus Login!"); document.location="../index.php";</script>';
}
?>