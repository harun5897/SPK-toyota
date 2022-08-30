<?php
session_start();
include_once('../modules/Connection.php');
include_once('../modules/Module.php');

if($_SESSION['loginStatus'] != 1) {
  header('location: index.php');
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
            <a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#modalGantiKataSandi">Change Password</a>
            <a class="dropdown-item" href="daftarUser.php">Users</a>
            <a class="dropdown-item" href="logout.php">Logout</a>
          </ul>
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
            <h5 class="m-0">Tingkat Kepuasan Pelanggan</h5>
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
                  <!-- <a
                    href="LangkahPenilaian.php"
                    class="btn btn-primary rounded-0 me-3 shadow border border-3 border-light"
                    data-bs-toggle="modal" 
                    data-bs-target="#exampleModal"
                  >
                    Generete
                  </a> -->
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
                  <th>Total Nilai</th>
                  <th>Keterangan</th>
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
                    $id_no = 0;
                    $jumlah = [];
                    $dataPenilaian = mysqli_query($connection, "SELECT * FROM `penilaian` WHERE `idCustomer` = '$idCustomer' order by idPenilaian desc limit $rowcount ");
                    while($arrDataPenilaian = mysqli_fetch_array($dataPenilaian)):
                      $normalisasi = getNormalisasi($connection, $arrDataPenilaian['nilai'], $arrDataPenilaian['idKriteria']);
                      $matriksTertimbang = getMatriksTertimbang($connection, $arrDataPenilaian['idKriteria'], $normalisasi);
                      $nilaiElemen = perhitunganElemen($matriksTertimbang, $id_no);
                      array_push($jumlah, $nilaiElemen);
                    $id_no++;
                    endwhile;
                  ?>
                  <td><?php echo array_sum($jumlah); ?></td>
                
                  <?php
                    if(array_sum($jumlah) > 1) {
                      echo '<td> PUAS </td>';
                    }
                    else {
                      echo '<td class="bg-secondary text-white"> TIDAK PUAS </td>';
                    }
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