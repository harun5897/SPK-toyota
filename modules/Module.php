<?php
  function saveDataCustomer($connection, $namaDepan, $namaBelakang, $nomorPolisi, $nomorRangka, $merkKendaraan, $tipeKendaraan, $kontak, $alamat) {
    // echo $namaDepan; echo '<br>';
    // echo $namaBelakang; echo '<br>';
    // echo $nomorPolisi; echo '<br>';
    // echo $nomorRangka; echo '<br>';
    // echo $merkKendaraan; echo '<br>';
    // echo $tipeKendaraan; echo '<br>';
    // echo $kontak; echo '<br>';
    // echo $alamat; echo '<br>';

    if(!$namaDepan || !$namaBelakang || !$nomorPolisi || !$nomorRangka || !$merkKendaraan || !$tipeKendaraan || !$kontak || !$alamat) {
      header('location: InputDataCustomer.php?alertFieldRequired=true');
    }
    else {
      mysqli_query($connection, "INSERT INTO `customers` (`namaDepan`, `namaBelakang`, `nomorPolisi`, `nomorRangka`, `merkKendaraan`, `tipeKendaraan`, `kontak`, `alamat`) VALUES ('$namaDepan', '$namaBelakang', '$nomorPolisi', '$nomorRangka', '$merkKendaraan', '$tipeKendaraan', '$kontak', '$alamat')");
      header('location: DataCustomer.php?alertSuccessSaveData=true');
    }
  }
  function updateDataCustomer($connection, $namaDepan, $namaBelakang, $nomorPolisi, $nomorRangka, $merkKendaraan, $tipeKendaraan, $kontak, $alamat, $idCustomer) {
    if(!$namaDepan || !$namaBelakang || !$nomorPolisi || !$nomorRangka || !$merkKendaraan || !$tipeKendaraan || !$kontak || !$alamat) {
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
?>