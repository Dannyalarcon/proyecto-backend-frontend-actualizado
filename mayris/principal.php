<?php
include 'config\conn.php';

//creamos la sesión
session_start();
//validamos si se ha hecho o no el inicio de sesión correctamente
//si no se ha hecho la sesión nos regresará a login.php
if (!isset($_SESSION['user'])) {
  header('Location: index.php');
  exit();
}

?>
<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="icon" href="img\logs.png" type="image/x-icon">

  <title>INICIO</title>

  <!-- Bootstrap core CSS -->
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
  <!-- Custom styles for this template -->
  <link href="css\simple-sidebar.css" rel="stylesheet">
  <link rel="stylesheet" href="css\style_principal.css">
</head>

<body>

  <div class="d-flex" id="wrapper">

    <!-- Sidebar -->
    <div class="bg-light border-right" id="sidebar-wrapper">
      <div class=""><img style="max-width: 240px; background-color: rgba(255, 255, 255, 0.90)" src="img/logo1.png" alt=""> </div>
      <div class="list-group list-group-flush">
        <a href="principal.php" class="list-group-item list-group-item-action nav-item active">Inicio</a>
        <a href="agenda.php" class="list-group-item list-group-item-action bg-light">Agenda</a>
        <a href="inventario.php" class="list-group-item list-group-item-action bg-light">Inventario</a>
        <a href="empleado.php" class="list-group-item list-group-item-action bg-light">Empleados</a>
        <a href="deudas.php" class="list-group-item list-group-item-action bg-light">Deudores</a>
      </div>
    </div>
    <!-- /#sidebar-wrapper -->

    <!-- Page Content -->
    <div id="page-content-wrapper">

      <nav class="navbar navbar-expand-lg navbar-light bg-light border-bottom">
        <button class="btn btn-info" id="menu-toggle"><i class="fas fa-align-justify fa-1x"></i></button>

        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <!--  NAVBAR-COLLAPSE -->
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav ml-auto mt-2 mt-lg-0">

            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="text-transform: capitalize;">
                <?php echo $_SESSION['user'] ?>

              </a>
              <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                <a class="dropdown-item" href="detalles.php">Ver mas detalles</a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="config\salir.php" data-toggle="modal" data-target="#staticBackdrop">
                  <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>Logout</a>
              </div>
            </li>
          </ul>
        </div>

        <!--  DIV MODAL LOGOUT  -->
        <div class="modal fade" id="staticBackdrop" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">×</span>
                </button>
              </div>
              <div class="modal-body">
                <h5 class="modal-title" id="exampleModalLabel">¿Seguro que quieres salir?</h5>
              </div>
              <div class="modal-footer">
                <button class="btn btn-danger" type="button" data-dismiss="modal">Cancelar</button>
                <a class="btn btn-warning" href="config\salir.php">Salir</a>
              </div>
            </div>
          </div>
        </div>
      </nav>

      <br>


      <div class="container">
        <div class="row row-cols-2 row-cols-md-4">
          <!--  FIN - CARD - AGENDA -->
          <a style="text-decoration: none; color: #212529;" href="agenda.php">
            <div class="col mb-4">
              <?php
              /*se llama la conexion para la base de datos*/
              $consulta = "SELECT COUNT(*) AS contar FROM agenda WHERE estatus = 1";
              /*se crea una consulta para llamar la tabla requerida */
              $resultado = mysqli_query($conection, $consulta) or die("Algo ha ido mal en la consulta a la base de datos");
              /*se crea una validacion entre la conexion y la consulta*/
              while ($row = mysqli_fetch_array($resultado)) {
                /*mientras la variable $resultado este correcto los datos se mostraran en la variable $mostrar */
              ?>
                <div class="card">
                  <div class="card-header ">
                    <i id="fab" class="far fa-address-book " style="max-width: 540px; color: #17A2B8;"></i>

                    <br><br>
                    <center>
                      <h5 class="card-title">Agenda</h5>
                    </center>
                  </div>
                  <div class="card-header">
                    <?php echo $row['contar'] ?> Citas pendientes
                  </div>
                </div>
              <?php
              }
              ?>
            </div>
          </a>
          <!--FIN - CARD - AGENDA-->

          <!--INICIO - CARD - INVENTARIO-->
          <a style="text-decoration: none; color: #212529;" href="inventario.php">
            <div class="col mb-4 ">
              <?php
              /*se llama la conexion para la base de datos*/
              $consulta2 = "SELECT SUM(precio * cantidad) AS total FROM inventario";
              /*se crea una consulta para llamar la tabla requerida */
              $resultado2 = mysqli_query($conection, $consulta2) or die("Algo ha ido mal en la consulta a la base de datos");
              /*se crea una validacion entre la conexion y la consulta*/
              while ($row2 = mysqli_fetch_array($resultado2)) {
                /*mientras la variable $resultado este correcto los datos se mostraran en la variable $mostrar */
              ?>
                <div class="card ">
                  <div class="card-header">
                    <i id="fab" class="fas fa-boxes" style="color: #1CAC4C;"></i>

                    <br><br>
                    <center>

                      <h5 class="card-title">Inventario</h5>
                    </center>
                  </div>
                  <div class="card-header">
                    Q.<?php echo $row2['total'] ?>.00 De inventario
                  </div>
                </div>
              <?php
              }
              ?>
            </div>
          </a>
          <!--FIN - CARD - INVENTARIO-->

          <!--FIN - CARD - EMPLEADOS-->
          <a style="text-decoration: none; color: #212529;" href="empleado.php">
            <div class="col mb-4">
              <?php
              /*se llama la conexion para la base de datos*/
              $consulta3 = "SELECT COUNT(*) AS empleado FROM empleados WHERE estatus = 1";
              /*se crea una consulta para llamar la tabla requerida */
              $resultado3 = mysqli_query($conection, $consulta3) or die("Algo ha ido mal en la consulta a la base de datos");
              /*se crea una validacion entre la conexion y la consulta*/
              while ($row3 = mysqli_fetch_array($resultado3)) {
                /*mientras la variable $resultado este correcto los datos se mostraran en la variable $mostrar */
              ?>
                <div class="card">
                  <div class="card-header">
                    <i id="fab" class="far fa-address-card" style="color: #17A2B8;"></i>
                    <br><br>
                    <center>
                      <h5 class="card-title">Empleados</h5>
                    </center>
                  </div>
                  <div class="card-header">
                    <?php echo $row3['empleado'] ?> Empleados activos
                  </div>
                </div>
              <?php
              }
              ?>
            </div>
          </a>
          <!--FIN - CARD - INVENTARIO-->

          <!--INICIO - CARD - CLIENTES - DEUDAS-->
          <a style="text-decoration: none; color: #212529;" href="deudas.php">

            <div class="col mb-4">
              <?php
              /*se llama la conexion para la base de datos*/
              $consulta4 = "SELECT COUNT(*) AS deuda FROM deudas where estatus = 1";
              /*se crea una consulta para llamar la tabla requerida */
              $resultado4 = mysqli_query($conection, $consulta4) or die("Algo ha ido mal en la consulta a la base de datos");
              /*se crea una validacion entre la conexion y la consulta*/
              while ($row4 = mysqli_fetch_array($resultado4)) {
                /*mientras la variable $resultado este correcto los datos se mostraran en la variable $mostrar */
              ?>
                <div class="card">
                  <div class="card-header">
                    <i id="fab" class="fas fa-hand-holding-usd " style="color: #1CAC4C;"></i>
                    <br><br>
                    <center>
                      <h5 class="card-title">Deudas</h5>
                    </center>
                  </div>
                  <div class="card-header">
                    <?php echo $row4['deuda'] ?> Deudas por cobrar
                  </div>
                </div>
              <?php
              }
              ?>
            </div>
          </a>
          <!--FIN - CARD - CLIENTES - DEUDAS-->

        </div>
      </div>

      <div class="container">


        <?php
        include_once "modulos\agenda\index_principal.html";
        ?>







      </div>
    </div>
    <!-- /#page-content-wrapper -->

  </div>
  <!-- /#wrapper -->

  <!-- Bootstrap core JavaScript -->
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
  <!-- Menu Toggle Script -->
  <script>
    $("#menu-toggle").click(function(e) {
      e.preventDefault();
      $("#wrapper").toggleClass("toggled");
    });
  </script>

</body>

</html>