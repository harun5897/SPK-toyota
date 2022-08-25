<?php
  function getLogin($connection, $email, $password) {
    if(!$email || !$password) {
      header('location: index.php?alertFailureLogin=true');
    }
    else {
      $dataUser = mysqli_query($connection, " SELECT * FROM `users` WHERE `email` = '$email' AND `password` = '$password'");
      $arrDataUser = mysqli_fetch_array($dataUser);
      if ($arrDataUser['email'] == $email && $arrDataUser['password'] == $password) {
        $_SESSION['idUser'] = $arrDataUser['idUser'];
        $_SESSION['username'] = $arrDataUser['username'];
        $_SESSION['role'] = $arrDataUser['role'];
        $_SESSION['loginStatus'] = true;

        header('location: DataCustomer.php?alertSuccessLogin=true');
      }
      else {
        header('location: index.php?alertFailureLogin=true');
      }
    }
  }
?>