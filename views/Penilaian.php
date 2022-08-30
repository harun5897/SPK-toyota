<?php
session_start();
include_once('../modules/Connection.php');
include_once('../modules/Module.php');
include_once('../modules/LoginAccess.php');

if($_SESSION['loginStatus'] != 1) {
  header('location: index.php');
}
if(isset($_POST['updatePassword'])){
  updatePassword($connection, $_POST['password'], $_POST['passwordBaru'], $_SESSION['idUser']);
}
$rowcountKriteria = mysqli_query($connection, "SELECT * FROM kriteria");
$rowcount = mysqli_num_rows($rowcountKriteria);
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
  <!-- NAVBAR -->
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
            <a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#exampleModalupdatePassword">Change Password</a>
            <!-- <a class="dropdown-item" href="daftarUser.php">Users</a> -->
            <a class="dropdown-item" href="logout.php">Logout</a>
          </ul>
        </div>
      </div>
    </div>
    <!-- Modal Ganti Kata Sandi-->
    <div class="modal fade" 
      tabindex="-1"
      id="exampleModalupdatePassword"
      aria-labelledby="exampleModalLabel"
      aria-hidden="true"
    >
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header bg-primary text-white">
            <h5 class="modal-title">Change Password</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <form action="" method="POST">
            <div class="modal-body">
              <input 
                type="text" 
                class="form-control mt-3" 
                placeholder="Masukan Password"
                name="password"
              >
              <input 
                type="text" 
                class="form-control mt-3" 
                placeholder="Masukan Password Baru"
                name="passwordBaru"
              >
            <div class="modal-footer mt-3">
              <button 
                type="submit" 
                class="btn btn-primary border-0 rounded-0"
                name="updatePassword"
              >
                Simpan
              </button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </nav>

  <!-- CONTENT -->
  <div id="data-customer">
    <div class="data-customer container-md mt-4">
      <div class="card rounded-0">
        <div class="card-header bg-primary text-light rounded-0">
          <div class="d-flex">
            <h5 class="m-0">Data Penilaian</h5>
          </div>
        </div>
        <div class="card-body">
          <div class="d-flex justify-content-center text-white">
          <a 
              href="DataCustomer.php" 
              class="btn btn-secondary me-1 shadow border border-3 border-light" 
              style="width: 100px;"
            >
              Customer
            </a>
            <a 
              href="DataService.php" 
              class="btn btn-secondary me-1 shadow border border-3 border-light" 
              style="width: 100px;"
            >
              Service
            </a>
            <a 
              href="DataKriteria.php" 
              class="btn btn-secondary me-1 shadow border border-3 border-light" 
              style="width: 100px;"
            >
              Kriteria
            </a>
            <a 
              href="Penilaian.php" 
              class="btn btn-secondary me-1 shadow border border-3 border-light" 
              style="width: 100px;"
            >
              Penilaian
            </a>
          </div>
          <hr>
          <div class="d-flex justify-content-center">
            <div class="w-100">
              <div class="d-flex mb-2">
                <div>
                  <a
                    href="LangkahPenilaian.php"
                    class="btn btn-primary rounded-0 me-3 shadow border border-3 border-light"
                  >
                    Generete
                  </a>
                </div>
                <!-- <div class="d-flex">
                  <button class="btn btn-secondary border-0 rounded-0 me-2"> Search </button>
                  <input type="text" class="form-control rounded-0 w-100" placeholder="Search By Nopol">
                </div> -->
              </div>
              <table 
                id="myTable" 
                class="table table-hover table-bordered px-5" 
              >
                <tr class="bg-table">
                  <th style="width: 20px;">No</th>
                  <th>Nama Pemilik</th>
                  <?php
                    $no = 0;
                    $dataKriteria = mysqli_query($connection, "SELECT * FROM kriteria order by idKriteria desc");
                    while($arrDataKriteria = mysqli_fetch_array($dataKriteria)) :
                      $no++;
                  ?>
                    <th><?=$arrDataKriteria['namaKriteria']?></th>
                  <?php
                    endwhile;
                  ?>
                </tr>
                  

                <?php
                  $no = 0;
                  $dataCustomer = mysqli_query($connection, "SELECT * FROM customers");
                  while($arrDataCustomer = mysqli_fetch_array($dataCustomer)) :
                    $no++;
                    $idCustomer = $arrDataCustomer['idCustomer'];
                    $dataPenilaian = mysqli_query($connection, "SELECT * FROM `penilaian` WHERE `idCustomer` = '$idCustomer' ");
                    $arrDataPenilaian = mysqli_fetch_array($dataPenilaian);
                    if(isset($arrDataPenilaian['idCustomer'])){
                ?>
                <tr>
                  <td class="text-center fw-bold"><?php echo $no; ?></td>
                  <td><?=$arrDataCustomer['namaDepan']?></td>
                  <?php
                    $dataPenilaian = mysqli_query($connection, "SELECT * FROM `penilaian` WHERE `idCustomer` = '$idCustomer' order by idPenilaian desc limit $rowcount");
                    while($arrDataPenilaian = mysqli_fetch_array($dataPenilaian)):
                  ?>
                    <td>
                      <?php
                      if(isset($arrDataPenilaian['nilai'])){
                        echo $arrDataPenilaian['nilai'];
                      }
                    ?>
                    </td>
                  <?php
                    endwhile;
                  ?>
                </tr>
                <?php
                    }
                  endwhile;
                ?>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <script type="" src="../assets/@popperjs/core/dist/umd/popper.min.js"></script>
  <script type="" src="../assets/bootstrap/dist/js/bootstrap.min.js"></script>
  <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
</body>
</html>