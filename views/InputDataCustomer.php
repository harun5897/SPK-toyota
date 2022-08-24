<?php
session_start();
include_once('../modules/Connection.php');
include_once('../modules/Module.php');

if($_SESSION['loginStatus'] != 1) {
  header('location: index.php');
}
if(isset($_GET['alertFieldRequired'])) {
  ?>
    <script>var alertFieldRequired = true;</script>
  <?php
}
if(isset($_POST['saveDataCustomer'])) {
  saveDataCustomer($connection, $_POST['namaDepan'],$_POST['namaBelakang'],$_POST['nomorPolisi'],$_POST['nomorRangka'],$_POST['merkKendaraan'],$_POST['tipeKendaraan'],$_POST['kontak'],$_POST['alamat']);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../assets/scss/main/main.css">
  <title>Document</title>
</head>
<body>
  <nav class="navbar navbar-light shadow">
    <div class="container-fluid container-md p-0 d-flex justify-content-between">
      <a 
        class="navbar-brand" 
        href="#"
      >
        <img src="../assets/icon/logo.png" alt="" width="200px">
      </a>
      <div class="d-flex justify-content-between">
        <img 
          src="../assets/icon/avatar.svg" 
          class="rounded-circle p-1"
        >
        <div class="dropdown p-1">
          <a class="dropdown-toggle" 
            data-bs-toggle="dropdown" 
            data-bs-display="static" 
            aria-expanded="false"
          >
            Admin
          </a>
          <ul class="dropdown-menu dropdown-menu-end">
            <a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#modalGantiKataSandi">Change Password</a>
            <a class="dropdown-item" href="daftarUser.php">Users</a>
            <a class="dropdown-item" href="logout.php">Logout</a>
          </ul>
        </div>
      </div>
    </div>
  </nav>
  <div id="data-customer">
    <div class="data-customer container-md mt-5">
      <div class="card rounded-0">
        <div class="card-header bg-primary text-light rounded-0">
          <div class="py-2">
            <!-- <span class="m-0 me-3">Data Customer</span> -->
          </div>
        </div>
        <div class="card-body">
          <div class="row">
            <div class="col-lg-8">
              <form action="" method="POST">
                <div class="d-flex justify-content-start row">
                  <div class="col-3">
                    <label for="">Nama Depan</label>
                  </div>
                  <div class="col-7 px-0">
                    <input type="text" class="form-control" name="namaDepan">
                  </div>
                </div>
                <div class="d-flex justify-content-start row mt-3">
                  <div class="col-3">
                    <label for="">Nama Belakang</label>
                  </div>
                  <div class="col-7 px-0">
                    <input type="text" class="form-control" name="namaBelakang">
                  </div>
                </div>
                <div class="d-flex justify-content-start row mt-3">
                  <div class="col-3">
                    <label for="">Nomor Polisi</label>
                  </div>
                  <div class="col-7 px-0">
                    <input type="text" class="form-control" name="nomorPolisi">
                  </div>
                </div>
                <div class="d-flex justify-content-start row mt-3">
                  <div class="col-3">
                    <label for="">Nomor Rangka</label>
                  </div>
                  <div class="col-7 px-0">
                    <input type="text" class="form-control" name="nomorRangka">
                  </div>
                </div>
                <div class="d-flex justify-content-start row mt-3">
                  <div class="col-3">
                    <label for="">Merk Kendaraan</label>
                  </div>
                  <div class="col-7 px-0">
                    <select name="merkKendaraan" id="" class="form-select">
                      <option value="Toyota">Toyota</option>
                      <option value="Honda">Honda</option>
                      <option value="Suzuki">Suzuki</option>
                      <option value="Mitsubishi">Mitsubishi</option>
                      <option value="Hino">Hino</option>
                      <option value="Daihatsu">Daihatsu</option>
                      <option value="Mazda">Mazda</option>
                    </select>
                  </div>
                </div>
                <div class="d-flex justify-content-start row mt-3">
                  <div class="col-3">
                    <label for="">Tipe Kendaraan</label>
                  </div>
                  <div class="col-7 px-0">
                    <input type="text" class="form-control" name="tipeKendaraan">
                  </div>
                </div>
                <div class="d-flex justify-content-start row mt-3">
                  <div class="col-3">
                    <label for="">Kontak</label>
                  </div>
                  <div class="col-7 px-0">
                    <input type="text" class="form-control" name="kontak">
                  </div>
                </div>
                <div class="d-flex justify-content-start row mt-3">
                  <div class="col-3">
                    <label for="">Alamat</label>
                  </div>
                  <div class="col-7 px-0">
                    <textarea type="text" class="form-control" name="alamat"></textarea>
                    <div class="d-flex justify-content-end mb-2"> 
                      <button type="submit" class="btn btn-secondary mt-3 border-0 rounded-0 px-4" name="saveDataCustomer">Save</button>
                    </div>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <script type="" src="../assets/@popperjs/core/dist/umd/popper.min.js"></script>
  <script type="" src="../assets/bootstrap/dist/js/bootstrap.min.js"></script>
  <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
  <script>
    if(alertFieldRequired) {
      swal({
        title: "Input Data Failed",
        text: "Field is Required",
        buttons: 'OK',
        icon: 'warning',
      });
    }
  </script>
</body>
</html>