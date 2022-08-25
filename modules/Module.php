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
    header('location: DataService.php?alertSuccessDeleteData=true');
  }
?>