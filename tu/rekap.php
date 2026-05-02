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
  <!-- Morris Charts CSS -->
  <link href="../dist/css/morris.css" rel="stylesheet">
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
            <h1 class="m-0 text-dark"></h1>
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
            <h3 class="card-title">Jadwal</h3>

            <div class="card-tools">
              <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
              <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i></button>
            </div>
          </div>
          <!-- /.card-header -->
            <div class="card-body">
              <div class="row">
        <div class="col-lg-12">
            <h3 class="page-header" style="margin-top:0px;">
                Rekap Absensi Kelas
            </h3>

            <label>Pilih Range Tanggal :</label>

            <form method="post">
                <table class="table table-hover" style="margin-top:5px;">
                    <tr>
                        <th><label style="margin-top:5px;">Tanggal</label></th>
                        <th><input type="date" class="form-control" name="tanggal1" required=""></th>
                        <th><label style="margin-top:5px;"> s/d tanggal </label></th>
                        <th><input type="date" class="form-control" name="tanggal2" required=""></th>
                        <th><input type="submit" name="submit" class="btn btn-default" value="Rekap"/></th>
                    </tr>
                </table>
            </form>  

            <?php
            //Proses Cari
                if (isset($_POST['submit'])) { 
                    $tgl1=$_POST['tanggal1'];
                    $tgl2=$_POST['tanggal2'];

                    $tanggal1 = ($tgl1);
                    $tanggal2 = ($tgl2);

            ?>
            <center><label>Tanggal&nbsp <?php echo date("d-m-Y", strtotime($tanggal1)); ?> &nbsps/d&nbsp tanggal &nbsp<?php echo date("d-m-Y", strtotime($tanggal2)); ?></label></center>
        
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <?php
                        $kelas1 = mysqli_query($koneksi,"select * from tb_kelas");
                      ?>
                        <ul class="nav nav-tabs" id="myTab" style="margin-bottom:10px;" role="tablist">
                            <?php
                                while($row1=mysqli_fetch_array($kelas1)){
                            ?>
                            <li class="nav-item"><a class="nav-link active" href="#<?php echo $row1['kelas']; ?>" role="tab" > Kelas <?php echo $row1['kelas']; ?></a></li>
                            <?php
                                }
                            ?>
                      </ul>
        </div>
    </div>


    <div class="row">
        <div class="col-lg-12">
            <div class="tab-content responsive">
            <?php
                $kelas2 = mysqli_query($koneksi,"select * from tb_kelas");
                while($row2=mysqli_fetch_array($kelas2)){
                    $kelas=$row2['id_kelas'];
                    $kela=$row2['kelas'];
            ?>
            <div class="tab-pane active" id="<?php echo $row2['kelas']; ?>" style="margin-top:15px;">
                    <h4 class="page-header" style="margin-top:7px;" align="center">
                        Rekap Absensi Kelas <?php echo $kela; ?>
                    </h4>

                    <div class="col-lg-7" style="margin-top:15px;">
                        <table class="table table-hover table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>NIS</th>
                                    <th>Nama Siswa</th>
                                    <th>Hadir</th>
                                    <th>Sakit</th>
                                    <th>Izin</th>
                                    <th>Alfa</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    $view1=mysqli_query($koneksi,"select nis, nama_siswa
                                                        from tb_siswa
                                                        where id_kelas='$kelas'
                                                        order by nis asc");
                                    $no=1;
                                    while($raw1=mysqli_fetch_array($view1)){
                                    
                                ?>
                                <tr>
                                    <td><?php echo $no; ?></td>
                                    <td><?php echo $raw1['nis']; ?></td>
                                    <td><?php echo $raw1['nama_siswa']; ?></td>
                                    <td><?php echo mysqli_num_rows(mysqli_query($koneksi,"select * from tb_absensi where nis='$raw1[nis]' AND ket='H' AND tanggal between '$tanggal1' and '$tanggal2'")); ?></td>  
                                    <td><?php echo mysqli_num_rows(mysqli_query($koneksi,"select * from tb_absensi where nis='$raw1[nis]' AND ket='S' AND tanggal between '$tanggal1' and '$tanggal2'")); ?></td>
                                    <td><?php echo mysqli_num_rows(mysqli_query($koneksi,"select * from tb_absensi where nis='$raw1[nis]' AND ket='I' AND tanggal between '$tanggal1' and '$tanggal2'")); ?></td>
                                    <td><?php echo mysqli_num_rows(mysqli_query($koneksi,"select * from tb_absensi where nis='$raw1[nis]' AND ket='A' AND tanggal between '$tanggal1' and '$tanggal2'")); ?></td>   
                                </tr>
                                <?php
                                    $no++;
                                    }
                                ?>
                            </tbody>
                        </table>
                        <input type="button" class="btn btn-default" value="Print" onClick="#"/>
                                                
                    </div>
                </div>
            </div>
            <?php
                }
                }
            ?>
            </div>
        </div>
    </div>
              </div>
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