<?php
session_start();
include_once('../modules/Connection.php');
include_once('../modules/Module.php');

if($_SESSION['loginStatus'] != 1) {
  header('location: index.php');
}
if(isset($_GET['alertSuccessLogin'])) {
  ?>
  <script>var alertSuccessLogin = true;</script>
  <?php
}
if(isset($_GET['alertSuccessSaveData'])) {
  ?>
    <script>var alertSuccessSaveData = true;</script>
  <?php
}
if(isset($_GET['alertSuccessUpdateData'])) {
  ?>
    <script>var alertSuccessUpdateData = true;</script>
  <?php
}
if(isset($_GET['alertSuccessDeleteData'])) {
  ?>
    <script>var alertSuccessDeleteData = true;</script>
  <?php
}
if(isset($_GET['dataCustomer'])){
  if($_GET['dataCustomer'] == 'delete') {
    $idCustomer = $_GET['idCustomer'];
    deleteCustomer($connection, $idCustomer);
  }
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
          <?php echo $_SESSION['username']; ?>
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
            <h5 class="m-0 me-3">Data Customer</h5>
          </div>
        </div>
        <div class="card-body">
          <div class="d-flex">
            <div>
              <a
                href="InputDataCustomer.php"
                class="btn btn-secondary 
                rounded-0 border-0 me-5" 
              >
                Add Data
              </a>
            </div>
            <div class="d-flex">
              <button class="btn btn-primary border-0 rounded-0 me-2"> Search </button>
              <input type="text" class="form-control rounded-0 w-100" placeholder="Search By Nopol">
            </div>
          </div>
          <hr>
          <div class="d-flex justify-content-center">
            <table 
              id="myTable" 
              class="table table-hover table-bordered mt-2"
              style="max-width: 800px;"
            >
              <tr class="bg-table">
                <th>No</th>
                <th>Nama</th>
                <th>Nopol</th>
                <th>Kendaraan</th>
                <th>No Telp</th>
                <th class="text-center">Action</th>
              </tr>
              <?php
                $no = 0;
                $dataCustomer = mysqli_query($connection, "SELECT * FROM customers");
                while($arrDataCustomer = mysqli_fetch_array($dataCustomer)) :
                  $no++;
              ?>
              <tr>
                <td><?php echo $no; ?></td>
                <td><?=$arrDataCustomer['namaDepan']?></td>
                <td><?=$arrDataCustomer['nomorPolisi']?></td>
                <td><?=$arrDataCustomer['merkKendaraan']?></td>
                <td><?=$arrDataCustomer['kontak']?></td>
                <td class="text-center"> 
                  <a href="updateDataCustomer.php?dataCustomer=update&idCustomer=<?=$arrDataCustomer['idCustomer']?>" class="btn btn-sm btn-primary border-0 rounded-0 fw-bold">Detail</a>
                  <a href="DataCustomer.php?dataCustomer=delete&idCustomer=<?=$arrDataCustomer['idCustomer']?>" class="btn btn-sm btn-secondary border-0 rounded-0 fw-bold">Delete</a>
                </td>
              </tr>
              <?php
                endwhile;
              ?>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
  <script type="" src="../assets/@popperjs/core/dist/umd/popper.min.js"></script>
  <script type="" src="../assets/bootstrap/dist/js/bootstrap.min.js"></script>
  <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
  <script>
    if(alertSuccessLogin) {
      swal({
        title: "Login Success",
        text: "Welcome to the Agung Toyota",
        buttons: false,
        icon: 'success',
        timer: 2000,
      });
    }
  </script>
  <script>
    if(alertSuccessSaveData) {
      swal({
        title: "Success",
        text: "Input Data Customer Success",
        buttons: false,
        icon: "success",
        timer: 2000,
      });
    }
  </script>
  <script>
    if(alertSuccessUpdateData) {
      swal({
        title: "Success",
        text: "Update Data Customer Success",
        buttons: false,
        icon: "success",
        timer: 2000,
      });
    }
  </script>
  <script>
    if(alertSuccessDeleteData) {
      swal({
        title: "Success",
        text: "Delete Data Customer Success",
        buttons: false,
        icon: "success",
        timer: 2000,
      });
    }
  </script>
</body>
</html>