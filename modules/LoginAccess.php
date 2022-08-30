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
  function updatePassword ($connection, $password, $passwordBaru, $idUser) {
    if(!$password || !$passwordBaru) {
      header('location: index.php?alertFailedChangePassword=true');
    }
    else {
      if($password == $passwordBaru) {
        session_start();
        session_destroy();
        header('location: index.php?alertFailedChangePassword=true');
      }
      else {
        mysqli_query($connection, "UPDATE `users` SET `password` = '$passwordBaru' WHERE `idUser` = '$idUser'");
        session_start();
        session_destroy();
        header('location: index.php?alertSuccessChangePassword=true');
      }
    }
  }
?>