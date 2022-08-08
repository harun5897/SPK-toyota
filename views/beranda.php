<?php
if(isset($_GET['alertSuccessLogin'])) {
  ?>
  <script>var alertSuccessLogin = true;</script>
  <?php
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
  <h1>hello</h1>

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
</body>
</html>