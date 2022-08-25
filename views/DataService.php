<?php
session_start();
include_once('../modules/Connection.php');
include_once('../modules/Module.php');

if(isset($_GET['alertSuccessSaveData'])) {
  ?>
    <script>var alertSuccessSaveData = true;</script>
  <?php
}
if(isset($_GET['alertFieldRequired'])) {
  ?>
    <script>var alertFieldRequired = true;</script>
  <?php
}

if(isset($_POST['simpanService'])) {
  saveService($connection, $_POST['idCustomer'], $_POST['permasalahanKendaraan']);
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
            <h5 class="m-0">Data Service</h5>
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
              href="" 
              class="btn btn-secondary me-1 shadow border border-3 border-light" 
              style="width: 100px;"
            >
              Penilaian
            </a>
            <a 
              href="" 
              class="btn btn-secondary me-1 shadow border border-3 border-light" 
              style="width: 100px;"
            >
              Hitung
            </a>
          </div>
          <hr>
          <div class="d-flex justify-content-center">
            <div class="w-100">
              <div class="d-flex mb-2">
                <div>
                  <a
                    href="InputDataCustomer.php"
                    class="btn btn-primary rounded-0 me-3 shadow border border-3 border-light"
                    data-bs-toggle="modal" 
                    data-bs-target="#exampleModal"
                  >
                    Add Data
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
                  <th>Tanggal Service</th>
                  <th>Nama Pemilik</th>
                  <th>Nomor Polisi</th>
                  <th class="text-center">Action</th>
                </tr>
                <!-- <?php
                  $no = 0;
                  $dataKriteria = mysqli_query($connection, "SELECT * FROM kriteria");
                  while($arrDataKriteria = mysqli_fetch_array($dataKriteria)) :
                    $no++;
                ?>
                <tr>
                  <td class="text-center fw-bold"><?php echo $no; ?></td>
                  <td><?=$arrDataKriteria['namaKriteria']?></td>
                  <td><?=$arrDataKriteria['bobotKriteria']?></td>
                  <td><?=$arrDataKriteria['costBenefit']?></td>
                  <td class="text-center"> 
                    <a href="DataKriteria.php?dataKriteria=update&idKriteria=<?=$arrDataKriteria['idKriteria']?>" class="btn btn-sm btn-primary border-0 rounded-0">Detail</a>
                    <a href="DataKriteria.php?dataKriteria=delete&idKriteria=<?=$arrDataKriteria['idKriteria']?>" class="btn btn-sm btn-secondary border-0 rounded-0">Delete</a>
                  </td>
                </tr>
                <?php
                  endwhile;
                ?> -->
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Modal Tambah Data Service-->
  <div class="modal fade" 
    tabindex="-1"
    id="exampleModal"
    aria-labelledby="exampleModalLabel"
    aria-hidden="true"
  >
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header bg-primary text-white">
          <h5 class="modal-title">Masukan Data Service</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form action="" method="POST">
          <div class="modal-body">
            <select 
              class="form-select mt-3" 
              name="idCustomer"
            >
              <option value="" selected> Pilih Pemilik Kendaraan</option>
              <?php 
                $dataCustomer = mysqli_query($connection, "SELECT * FROM customers");
                while($arrDataCustomer = mysqli_fetch_array($dataCustomer)) :
              ?>
                <option value="<?=$arrDataCustomer['idCustomer']?>">
                  <?=$arrDataCustomer['namaDepan']?> <?=$arrDataCustomer['namaBelakang']?>
                </option>
              <?php
                endwhile;
              ?>
            </select>
            <label for="" class="mt-3 text-black-50">Masukan Permasalahan Kendaraan </label>
            <textarea
              type="text" 
              class="form-control mt-0" 
              name="permasalahanKendaraan"
            > </textarea>
          </div>
          <div class="modal-footer mt-3">
            <button 
              type="submit" 
              class="btn btn-primary border-0 rounded-0"
              name="simpanService"
            >
              Simpan
            </button>
          </div>
        </form>
      </div>
    </div>
  </div>

  <!-- Modal Update Data Kriteria-->
  <div class="modal fade" 
    tabindex="-1"
    id="exampleModal1"
    aria-labelledby="exampleModalLabel"
    aria-hidden="true"
  >
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header bg-primary text-white">
          <h5 class="modal-title">Update Data Kriteria</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form action="" method="POST">
          <div class="modal-body">
            <input 
              type="text" 
              class="form-control mt-3" 
              placeholder="Masukan Nama Kriteria"
              name="namaKriteria"
              value="<?=$arrDataKriteriaEdit['namaKriteria']?>"
            >
            <input 
              type="text" 
              class="form-control mt-3" 
              placeholder="Masukan Nilai Kriteria"
              name="bobotKriteria"
              value="<?=$arrDataKriteriaEdit['bobotKriteria']?>"
            >
            <label for="" class="mt-3 text-black-50">Masukan Bentuk Pertanyaan </label>
            <textarea
              type="text" 
              class="form-control mt-0" 
              name="pertanyaanKriteria"
            ><?=$arrDataKriteriaEdit['pertanyaanKriteria']?></textarea>
            <select 
              class="form-select mt-3" 
              name="costBenefit"
            >
              <option value="<?=$arrDataKriteriaEdit['costBenefit']?>"><?=$arrDataKriteriaEdit['costBenefit']?></option>
              <option value="cost">Cost</option>
              <option value="benefit">Benefit</option>
            </select>
          </div>
          <div class="modal-footer mt-3">
            <button 
              type="submit" 
              class="btn btn-secondary border-0 rounded-0"
              name="updateKriteria"
            >
              Simpan
            </button>
          </div>
        </form>
      </div>
    </div>
  </div>

  <script type="" src="../assets/@popperjs/core/dist/umd/popper.min.js"></script>
  <script type="" src="../assets/bootstrap/dist/js/bootstrap.min.js"></script>
  <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
  <script>
    if(alertSuccessSaveData) {
      swal({
        title: "Success",
        text: "Input Data Service Success",
        buttons: false,
        icon: "success",
        timer: 2000,
      });
    }
  </script>
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