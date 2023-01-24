<?php
include '../koneksi_db.php';
session_start();
$id = $_GET['id'];
$query = mysqli_query($koneksi, "SELECT * FROM KELAS WHERE id_kelas = '$id'");
$jurusan = mysqli_query($koneksi, "SELECT nama_jurusan AS jurusan FROM JURUSAN");
$data = mysqli_fetch_array($query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no, shrink-to-fit=no" name="viewport">
  <title>SIPS &rsaquo; Edit Data Kelas</title>
  <link rel="stylesheet" href="../dist/modules/bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" href="../dist/modules/bootstrap/css/select2.min.css">
  <link rel="stylesheet" href="../dist/modules/bootstrap/css/select2-bootstrap.css">
  <link rel="stylesheet" href="../dist/modules/ionicons/css/ionicons.min.css">
  <link rel="stylesheet" href="../dist/modules/datatables/DataTables-1.10.16/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="../dist/modules/fontawesome/web-fonts-with-css/css/fontawesome-all.min.css">
  <link rel="stylesheet" href="../dist/modules/summernote/summernote-lite.css">
  <link rel="stylesheet" href="../dist/modules/flag-icon-css/css/flag-icon.min.css">
  <link rel="stylesheet" href="../dist/css/style.css">
</head>
<body>
  <div id="app">
    <div class="main-wrapper">
      <div class="navbar-bg"></div>
      <nav class="navbar navbar-expand-lg main-navbar">
        <form class="form-inline mr-auto">
          <ul class="navbar-nav mr-3">
            <li>
              <a href="#" data-toggle="sidebar" class="nav-link nav-link-lg">
                <i class="ion ion-navicon-round"></i>
              </a>
            </li>
          </ul>
        </form>
        <ul class="navbar-nav navbar-right">
          <li class="dropdown"><a href="#" data-toggle="dropdown" class="nav-link dropdown-toggle nav-link-lg">
            <i class="ion ion-android-person d-lg-none"></i>
            <div class="d-sm-none d-lg-inline-block">Halo, Admin</div></a>
            <div class="dropdown-menu dropdown-menu-right">
              <a href="proses/proses_logout.php" class="dropdown-item has-icon">
                <i class="ion ion-log-out"></i> Logout
              </a>
            </div>
          </li>
        </ul>
      </nav>
      <div class="main-sidebar">
        <aside id="sidebar-wrapper">
          <div class="sidebar-brand">
            <a href="index.html">SIPS</a>
          </div>
          <div class="sidebar-user">
            <div class="sidebar-user-picture">
              <img alt="image" src="../dist/img/avatar/avatar.png">
            </div>
            <div class="sidebar-user-details">
              <div class="user-name"><?php echo $_SESSION['nama_pengguna']; ?></div>
              <div class="user-role">
                Admin
              </div>
            </div>
          </div>
          <ul class="sidebar-menu">
            <li class="menu-header">Menu</li>
            <li data-toggle="tooltip" data-placement="right" title="" data-original-title="Halaman Utama">
              <a href="index.php"><i class="ion ion-speedometer"></i><span>Dashboard</span></a>
            </li>
            <li data-toggle="tooltip" data-placement="right" data-original-title="Data Siswa">
              <a href="data_siswa.php"><i class="ion ion-ios-people"></i> Data Siswa</a>
            </li>
            <li data-toggle="tooltip" data-placement="right" data-original-title="Data Jurusan">
              <a href="data_jurusan.php"><i class="ion ion-university"></i> Data Jurusan</a>
            </li>
            <li class="active" data-toggle="tooltip" data-placement="right" data-original-title="Data Kelas">
              <a href="data_kelas.php"><i class="ion ion-ios-book"></i> Data Kelas</a>
            </li>
            <li data-toggle="tooltip" data-placement="right" data-original-title="Data Jenis Pelanggaran">
              <a href="data_jenispelanggaran.php"><i class="ion ion-document-text"></i> Jenis Pelanggaran</a>
            </li>
            <li data-toggle="tooltip" data-placement="right" data-original-title="Data Akun Pengguna">
              <a href="data_akun.php"><i class="ion ion-key"></i> Manajemen Akun</a>
            </li>
          </ul>
        </aside>
      </div>
      <div class="main-content">
        <section class="section">
          <h1 class="section-header">
            <div>Tambah Data Kelas</div>
          </h1>
          <div class="card">
            <div class="card-primary">
              <div class="card-body">
                <form method="POST" class="needs-validation">
                  <div class="form-group">
                    <label>ID</label>
                    <h5><?php echo $data['id_kelas']?></h5>
                  </div>
                  <div class="form-group">
                    <label>Nama Kelas</label>
                    <input value="<?php echo $data['nama_kelas']?>" type="text" class="form-control" name="nama_kelas" tabindex="1" required>
                  </div>
                  <div class="form-group">
                    <label>Jurusan</label>
                    <select name="nama_jurusan" class="form-control">
                      <?php
                      $rows = mysqli_num_rows($jurusan);
                      if($rows > 0){
                        while($nama = mysqli_fetch_array($jurusan)){
                          echo "<option>".$nama['jurusan']."</option>";
                        }
                      }else{
                        echo "<option>".$data['nama_jurusan']."</option>";
                      }
                      ?>
                    </select>
                  </div>
                  <br>
                  <div class="form-group">
                    <button type="submit" name="submit" class="btn btn-blue" tabindex="1">
                      <i class="ion ion-android-checkbox-outline" style="margin-right: 10px"></i>
                      Simpan
                    </button>
                    <?php
                    include '../koneksi_db.php';
                    if(isset($_POST['submit'])){

                      $id_kelas = $data['id_kelas'];
                      $nama_kelas = $_POST['nama_kelas'];
                      $nama_jurusan = $_POST['nama_jurusan'];

                      $edit_data = mysqli_query($koneksi, "UPDATE KELAS SET nama_kelas='$nama_kelas', nama_jurusan='$nama_jurusan' WHERE id_kelas='$id_kelas'");
                      
                      if ($edit_data) {
                        echo "<script>window.alert('Data berhasil diperbarui!');
                        window.location.href='data_kelas.php';
                        </script>";
                      }
                      else {
                        echo "<script>window.alert('Data gagal diperbarui!');
                        </script>";
                      }
                    }
                    ?>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </section>
      </div>
      <footer class="main-footer">
        <div class="footer-left">Kelompok RPL SIPS</div>
      </footer>
    </div>
  </div>
  <script src="../dist/modules/jquery.min.js"></script>
  <script src="../dist/modules/popper.js"></script>
  <script src="../dist/modules/tooltip.js"></script>
  <script src="../dist/modules/bootstrap/js/bootstrap.min.js"></script>
  <script src="../dist/modules/bootstrap/js/select2.full.js"></script>
  <script src="../dist/modules/nicescroll/jquery.nicescroll.min.js"></script>
  <script src="../dist/modules/scroll-up-bar/dist/scroll-up-bar.min.js"></script>
  <script src="../dist/js/sa-functions.js"></script>
  <script src="../dist/modules/chart.min.js"></script> 
  <script src="../dist/js/jquery.dataTables.min.js"></script>
  <script src="../dist/js/dataTables.buttons.min.js"></script>
  <script src="../dist/js/buttons.colVis.min.js"></script>
  <script src="../dist/js/buttons.html5.min.js"></script>
  <script src="../dist/js/buttons.print.min.js"></script>
  <script src="../dist/js/dataTables.bootstrap.min.js"></script>
  <script src="../dist/js/buttons.bootstrap.min.js"></script>
  <script src="../dist/js/jszip.min.js"></script>
  <script src="../dist/js/vfs_fonts.js"></script>     
  <script src="../dist/js/pdfmake.min.js"></script>
  <script src="../dist/modules/summernote/summernote-lite.js"></script>
  <script src="../dist/js/scripts.js"></script>  
</body>
</html>