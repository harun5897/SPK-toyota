<?php
  // ALTERNATIF
  function saveDataCustomer($connection, $namaDepan, $namaBelakang, $nomorPolisi, $nomorRangka, $merkKendaraan, $tipeKendaraan, $kontak, $alamat) {

    if(!$namaDepan || !$namaBelakang || !$nomorPolisi || !$nomorRangka || !$merkKendaraan || !$tipeKendaraan || !$kontak || trim($alamat) == '') {
      header('location: InputDataCustomer.php?alertFieldRequired=true');
    }
    else {
      mysqli_query($connection, "INSERT INTO `customers` (`namaDepan`, `namaBelakang`, `nomorPolisi`, `nomorRangka`, `merkKendaraan`, `tipeKendaraan`, `kontak`, `alamat`) VALUES ('$namaDepan', '$namaBelakang', '$nomorPolisi', '$nomorRangka', '$merkKendaraan', '$tipeKendaraan', '$kontak', '$alamat')");
      header('location: DataCustomer.php?alertSuccessSaveData=true');
    }
  }
  function updateDataCustomer($connection, $namaDepan, $namaBelakang, $nomorPolisi, $nomorRangka, $merkKendaraan, $tipeKendaraan, $kontak, $alamat, $idCustomer) {
    if(!$namaDepan || !$namaBelakang || !$nomorPolisi || !$nomorRangka || !$merkKendaraan || !$tipeKendaraan || !$kontak || trim($alamat) == '') {
      header('location: UpdateDataCustomer.php?alertFieldRequired=true&idCustomer='.$idCustomer);
    }
    else {   
      mysqli_query($connection, "UPDATE `customers` SET `namaDepan` = '$namaDepan', `namaBelakang` = '$namaBelakang', `nomorPolisi` = '$nomorPolisi', `nomorRangka` = '$nomorRangka', `merkKendaraan` = '$merkKendaraan', `tipeKendaraan` = '$tipeKendaraan', `kontak` = '$kontak', `alamat` = '$alamat' WHERE `customers`.`idCustomer` = $idCustomer");
      $_SESSION['cek'] = 'cek';
      header('location: DataCustomer.php?alertSuccessUpdateData=true');
    }
  }
  function deleteCustomer($connection, $idCustomer) {
    mysqli_query($connection, "DELETE FROM `customers` WHERE `idCustomer` = '$idCustomer'");
    mysqli_query($connection, "DELETE FROM `service` WHERE `idCustomer` = '$idCustomer'");
    header('location: DataCustomer.php?alertSuccessDeleteData=true');
  }


  function saveKriteria($connection, $namaKriteria, $bobotKriteria, $pertanyaanKriteria, $costBenefit) {
    if($bobotKriteria > 100 ) {
      header('location: DataKriteria.php?alertValueMaximum=true');
    } else {
      if(!$namaKriteria || !$bobotKriteria || trim($pertanyaanKriteria) == '' || !$costBenefit) {
        header('location: DataKriteria.php?alertFieldRequired=true');
      } else {
        mysqli_query($connection, "INSERT INTO `kriteria` (`namaKriteria`, `bobotKriteria`, `pertanyaanKriteria`, `costBenefit`) VALUES ('$namaKriteria', '$bobotKriteria', '$pertanyaanKriteria', '$costBenefit')");
        header('location: DataKriteria.php?alertSuccessSaveData=true');
      }
    }
  }

  function updateKriteria($connection, $namaKriteria, $bobotKriteria, $pertanyaanKriteria, $costBenefit, $idKriteria){
    if($bobotKriteria > 100 ) {
      header('location: DataKriteria.php?alertValueMaximum=true');
    } else {
      if(!$namaKriteria || !$bobotKriteria || trim($pertanyaanKriteria) == '' || !$costBenefit) {
        header('location: DataKriteria.php?alertFieldRequired=true');
      } else {
        mysqli_query($connection, "UPDATE `kriteria` SET `namaKriteria` = '$namaKriteria', `bobotKriteria` = '$bobotKriteria', `pertanyaanKriteria` = '$pertanyaanKriteria', `costBenefit` = '$costBenefit' WHERE `kriteria`.`idKriteria` = $idKriteria");
        header('location: DataKriteria.php?alertSuccessSaveData=true');
      }
    }
  }

  function deleteKriteria($connection, $idKriteria) {
    mysqli_query($connection, "DELETE FROM `kriteria` WHERE `idKriteria` = '$idKriteria'");
    mysqli_query($connection, "DELETE FROM `penilaian` WHERE `idKriteria` = '$idKriteria'");
    header('location: DataKriteria.php?alertSuccessDeleteData=true');
  }

  function saveService($connection, $idCustomer, $permasalahanKendaraan) {
    if(!$idCustomer || trim($permasalahanKendaraan) == '') {
      header('location: DataService.php?alertFieldRequired=true');
    }
    else {
      date_default_timezone_set('Asia/Jakarta');
      $tanggalService = date('d-m-Y');
      mysqli_query($connection, "INSERT INTO `service` (`idCustomer`, `permasalahanKendaraan`, `tanggalService`) VALUES ('$idCustomer', '$permasalahanKendaraan', '$tanggalService')");
      header('location: DataService.php?alertSuccessSaveData=true');
    }
  }

  function updateService($connection, $tanggalService, $permasalahanKendaraan, $idService) {
    if(!$tanggalService || trim($permasalahanKendaraan) == '') {
      header('location: DataService.php?alertFieldRequired=true');
    }
    else {
      $tanggalService = date('d-m-Y', strtotime($tanggalService));
      mysqli_query($connection, "UPDATE `service` SET `permasalahanKendaraan` = '$permasalahanKendaraan', `tanggalService` = '$tanggalService' WHERE `service`.`idService` = $idService");
      header('location: DataService.php?alertSuccessSaveData=true');
    }
  }

  function deleteService ($connection, $idService) {
    mysqli_query($connection, "DELETE FROM `service` WHERE `idService` = '$idService'");
    mysqli_query($connection, "DELETE FROM `penilaian` WHERE `idService` = '$idService'");
    header('location: DataService.php?alertSuccessDeleteData=true');
  }
  
  function saveFeedback($connection, $idCustomer, $idService) {
    $no = 0;
    $dataKriteria = mysqli_query($connection, "SELECT * FROM kriteria");
    while($arrDataKriteria = mysqli_fetch_array($dataKriteria)) :
      $no++;
      $idKriteria = $arrDataKriteria['idKriteria'];
      $nilai = $_SESSION['kriteria'.$no];
      $_SESSION['kriteria'.$no] = $arrDataKriteria['idKriteria'];
      mysqli_query($connection, "INSERT INTO `penilaian` (`idCustomer`, `idService` ,`idKriteria`, `nilai`) VALUES ('$idCustomer', '$idService', '$idKriteria', '$nilai')");
    endwhile;
    header('location: ThankYou.php');
  }


  // RUMUS MABAC
  function getNormalisasi($connection, $nilai, $idKriteria) {
    $dataKriteria = mysqli_query($connection, "SELECT * FROM `kriteria` WHERE `idKriteria` = '$idKriteria'");
    $arrDataKriteria = mysqli_fetch_array($dataKriteria);

    $arrMinMax = [];
    $dataPenilaian = mysqli_query($connection, "SELECT * FROM `penilaian` WHERE `idKriteria` = '$idKriteria'");
    while($arrDataPenilaian = mysqli_fetch_array($dataPenilaian)):
      array_push($arrMinMax, $arrDataPenilaian['nilai']);
    endwhile;
    $normalisasi = 0;
    if($arrDataKriteria['costBenefit'] == 'benefit') {
      $max = max($arrMinMax);
      $min = min($arrMinMax);
      $first = $nilai - $min;
      $second = $max - $min;
      $normalisasi = (int)$first / (int)$second;
    } else {
      $max = max($arrMinMax);
      $min = min($arrMinMax);
      $first = $nilai - $max;
      $second = $min - $max;
      $normalisasi = (int)$first / (int)$second ;
    
    }
    return $normalisasi;
  }

  function getMatriksTertimbang($connection, $idKriteria, $normalisasi) {
    $dataKriteria = mysqli_query($connection, "SELECT * FROM `kriteria` WHERE `idKriteria` = '$idKriteria'");
    $arrDataKriteria = mysqli_fetch_array($dataKriteria);

    $arrBobot = $arrDataKriteria['bobotKriteria'];
    $bobot = $arrBobot / 100;
    $matriksTertimbang = ($bobot * $normalisasi) + $bobot;
    
    return $matriksTertimbang;
  }

  function getAreaPerbatasan($connection, $areaPerbatasan, $no) {
    $_SESSION['areaPerbatasan'.$no] = $areaPerbatasan;
  }

  function getReverseAreaPerbatasan ($connection) {
    $indexCreate = 0;
      $dataKriteria = mysqli_query($connection, "SELECT * FROM kriteria");
      while($arrDataKriteria = mysqli_fetch_array($dataKriteria)):
        $_SESSION['x'.$indexCreate] = [];
        $indexCreate++;
      endwhile;

    $name = 0;
    $dataCustomer =  mysqli_query($connection, "SELECT * FROM customers");
    while($arrDataCustomer = mysqli_fetch_array($dataCustomer)):
      $name++;
      $index = 0;
      $idCustomer = $arrDataCustomer['idCustomer'];
      $dataPenilaian = mysqli_query($connection, "SELECT * FROM `penilaian` WHERE `idCustomer` = '$idCustomer' ");
      $arrDataPenilaian = mysqli_fetch_array($dataPenilaian);
      if(isset($arrDataPenilaian['idCustomer'])){
        $dataKriteria = mysqli_query($connection, "SELECT * FROM kriteria");
        while($arrDataKriteria = mysqli_fetch_array($dataKriteria)):
          array_push($_SESSION['x'.$index], $_SESSION['areaPerbatasan'.$name][$index]);
          $index++;
        endwhile;
      }
    endwhile;
  }

  function perhitunganElemen($matriksTertimbang, $no){
    $temp = $_SESSION['x'.$no];
    $batasan = 0;
    
    for($i = 0; $i < count($temp); $i++){
      if($batasan == 0) {
        $batasan = $temp[$i];
      } else {
        $batasan = $batasan * $temp[$i];
      }
    }
    // return number_format(pow($batasan, 0.25), 3);
    
    return $matriksTertimbang - pow($batasan, 0.25);
    // return $batasan;

  }
?>