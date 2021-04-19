<?php

$alert = '';
session_start();
//si la sesion esta activa se redirige a index1.php
if (!empty($_SESSION['active'])) {
  header('location:principal.php');
} else {
  //si no hay sesion iniciada se reciben los datos del formulario
  if (!empty($_POST)) {
    //se captura el usuario y contraseña enviados del formulario
    if (empty($_POST['user']) || empty($_POST['pass'])) {
      $alert = "Ingrese su usuario y su clave";
    } else {
      require_once "config\conn.php";
      //se almacenan los datos capturados en variables
      $user = mysqli_real_escape_string($conection, $_POST['user']);
      $pass = md5(mysqli_real_escape_string($conection, $_POST['pass']));
      /*se verifica si el usuario y contraseña
            * enviados coinciden con los registrados 
            * en la BD
            */
      $query = mysqli_query($conection, "SELECT * FROM usuario where user = '$user' and pass = '$pass'");
      mysqli_close($conection);
      $result = mysqli_num_rows($query);
      //se recorren los datos del usuario que se esta logueando
      if ($result > 0) {

        $data = mysqli_fetch_array($query);

        $_SESSION['active'] = true;
        $_SESSION['iduser'] = $data['id_usuario'];
        $_SESSION['nombre'] = $data['nombre'];
        $_SESSION['correo'] = $data['correo'];
        $_SESSION['user'] = $data['user'];
        $_SESSION['rol'] = $data['rol'];
        //si los datos son correctos se redirige a principal.php
        header('location: principal.php');
      } else {

        $alert = "El usuario o la clave son incorrectos";
        session_destroy();
      }
    }
  }
}

?>
<!doctype html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="icon" href="img/logs.png" type="image/x-icon">

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
  <link rel="stylesheet" href="css/style_index.css">
  <title>MAYRI'S SALON</title>
</head>

<body>
  <br>
  <div class="container">
    <div class="card card-container">
      <img id="profile-img" class="profile-img-card" src="img/logo1.png" />
      <br>
      <form class="form-signin"  method="post">
        <input type="text" name="user" autocomplete="off" class="form-control" placeholder="Usuario">
        <input type="password" name="pass" autocomplete="off" class="form-control" placeholder="Contraseña">
        <div>
          <input type="submit" name="" value="INGRESAR" class="btn btn-signin btn-block">
        </div>
      </form>
    </div>
  </div>

  <script language="JavaScript" type="text/javascript">
    function click() {
      //0 == click izquierdo
      //1 == click central-click scroll
      //2 == click derecho
      if (event.button == 2) {
        alert('No puedes usar este click');
      }
    }
    document.onmousedown = click
    //-->
  </script>
  
  <!-- Optional JavaScript -->
  <!-- jQuery first, then Popper.js, then Bootstrap JS -->
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
</body>

</html>