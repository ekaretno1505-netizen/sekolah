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
              <li class="breadcrumb-item active">Atur Jadwal</li>
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
          <form method="post" action="">
            <div class="card-body">
              <div class="row">
                <?php
                    $id = @$_GET['id'];
                    $qrykoreksi=mysqli_query($koneksi,"select * from tb_jadwal where id_jadwal='$id'");
                    $data=mysqli_fetch_array($qrykoreksi);
                ?>
                <div class="col-lg-7">
                   <div class="form-group">
                      <label>Hari</label>
                      <select name="hari" class="form-control" required>
                          <option value="" selected="selected">Pilih Hari</option>
                          <option value="Senin" <?php if($data['hari'] == 'Senin'){ echo 'selected'; }?>>Senin</option>
                          <option value="Selasa"<?php if($data['hari'] == 'Selasa'){ echo 'selected'; }?>>Selasa</option>
                          <option value="Rabu" <?php if($data['hari'] == 'Rabu'){ echo 'selected'; }?>>Rabu</option>
                          <option value="Kamis" <?php if($data['hari'] == 'Kamis'){ echo 'selected'; }?>>Kamis</option>
                          <option value="Jumat" <?php if($data['hari'] == 'Jumat'){ echo 'selected'; }?>>Jum'at</option>
                      </select>
                  </div>
                  <div class="form-group">
                      <label>Kelas</label>
                      <select name="kelas" class="form-control" required>
                          <option value="" selected="selected">Pilih Kelas</option>
                          <?php 
                              $query=mysqli_query($koneksi,"select * from tb_kelas order by id_kelas asc");
                              while($row=mysqli_fetch_array($query))
                              {
                          ?>
                              <option value="<?php  echo $row['id_kelas']; ?>"><?php  echo $row['kelas']; ?></option>
                          <?php 
                              }
                      ?>
                      </select>
                  </div>
                  <div class="form-group">
                      <label>Guru -- Mapel</label>
                      <select name="id_mengajar" class="form-control" required>
                          <option value="" selected="selected">Guru -- Mapel</option>
                          <?php 
                              $query=mysqli_query($koneksi,"select tb_guru.nama_guru, tb_mengajar.id_mengajar, tb_mapel.mapel from tb_guru, tb_mengajar, tb_mapel 
                                                  where tb_mengajar.kode_guru=tb_guru.kode_guru AND tb_mengajar.kode_mapel=tb_mapel.kode_mapel
                                                  order by tb_mengajar.kode_guru asc");
                              while($row=mysqli_fetch_array($query))
                              {
                          ?>
                              <option value="<?php  echo $row['id_mengajar']; ?>"><?php  echo $row['nama_guru']; ?> -- <?php  echo $row['mapel']; ?></option>
                          <?php 
                              }
                      ?>
                      </select>
                  </div>
              </div>

              <div class="col-lg-5">
                  <div class="form-group">
                      <label>Jam Mulai</label>
                      <input type="time" class="form-control" name="jam_mulai" value="<?php echo $data['jam_mulai']; ?>" required>
                  </div>
                  <div class="form-group">
                      <label>Jam Selesai</label>
                      <input type="time" class="form-control" name="jam_berakhir" value="<?php echo $data['jam_berakhir']; ?>" required>
                  </div>
                   <input type="submit" name="edit" class="btn btn-default" value="Edit"/>
              </div>
                
              </div>
              <!-- /.row -->
            </div>
          </form>
          <?php
        if(@$_POST['edit']){
            $id_mengajar=$_POST['id_mengajar'];
            $hari=$_POST['hari'];
            $jam_mulai=$_POST['jam_mulai'];
            $jam_berakhir=$_POST['jam_berakhir'];
            $kelas=$_POST['kelas'];

            $query=mysqli_query($koneksi,"UPDATE tb_jadwal SET id_mengajar='$id_mengajar', hari='$hari', jam_mulai='$jam_mulai',
                            jam_berakhir='$jam_berakhir', id_kelas='$kelas' WHERE id_jadwal='$id'") or die (mysql_error());

            if($query){
              echo '<script>window.location="jadwal_lihat.php?page=jadwal&&edit=edit-data"</script>';
            }else{
            ?>
                <script type="text/javascript">
                alert("Edit Data Gagal !")
                window.location="?page=jadwal_lihat";
                </script>
            <?php
            } 
        }
    ?>
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