<?php
session_start();
include_once('../modules/Connection.php');
include_once('../modules/Module.php');

if(isset($_POST['saveFeedback'])) {
  $idCustomer = $_GET['idCustomer'];
  $idService = $_GET['idService'];
  $no = 0;
  $dataKriteria = mysqli_query($connection, "SELECT * FROM kriteria");
  while($arrDataKriteria = mysqli_fetch_array($dataKriteria)) :
    $no++;
    $_SESSION['kriteria'.$no] = $_POST[$arrDataKriteria['idKriteria']];
  endwhile;
  saveFeedback($connection, $idCustomer, $idService);
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
  <div id="data-customer">
    <div class="data-customer container-md mt-5 w-50">
      <div class="card rounded-0">
        <div class="card-header bg-primary text-light rounded-0">
          <div class="py-2">
            <h5 class="m-0 me-3">Feedback Kepuasan Pelanggan</h5>
          </div>
        </div>
        <div class="card-body">

              <form action="" method="POST">
                <?php 
                  $no = 0;
                  $dataKriteria = mysqli_query($connection, "SELECT * FROM kriteria");
                  while($arrDataKriteria = mysqli_fetch_array($dataKriteria)) :
                    $no++;
                ?>
                  <label for="" class="mt-3"><?=$arrDataKriteria['pertanyaanKriteria']?></label>
                  <input 
                    type="text" 
                    class="form-control mt-1"
                    placeholder="Rentang Nilai (0 - 100)"
                    name="<?=$arrDataKriteria['idKriteria']?>"
                  >
                <?php
                  endwhile;
                ?>
                <div class="d-flex justify-content-end mt-3">
                  <button
                    type="submit" 
                    name="saveFeedback" 
                    class="btn btn-secondary border-0 rounded-0"
                  > 
                    Simpan
                  </button>
                </div>
              </form>
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