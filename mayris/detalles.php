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
    <title>Detalles</title>
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
                <a href="principal.php" class="list-group-item list-group-item-action bg-light">Inicio</a>
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
                <button class="btn btn-info" id="menu-toggle"><i class="fas fa-align-justify"></i></button>

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
                                <a class="dropdown-item" href="config\salir.php" data-toggle="modal" data-target="#staticBackdrop">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>Logout
                                </a>
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

            <!-- AGENDA - INICIO -->
            <div class="container">

                <div class="card" style="background-color: rgba(255, 255, 255, 0.17);">
                    <div class="card-header">
                        <h3>Agenda</h3>
                    </div>
                    <div class="card-body">
                        <div class="row row-cols-2 row-cols-md-4">

                            <!--  INICIO - CARD - AGENDA ACTIVOS -->
                            <a style="text-decoration: none; color: #212529;" href="agenda_pendiente.php">
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
                                                <i class="fas fa-calendar-alt" style="font-size: 50px; color: #17A2B8;"></i>
                                                <br><br>
                                                <center>
                                                    <h6>Pendientes</h6>
                                                </center>
                                            </div>
                                            <div class="card-header">
                                                <?php echo $row['contar'] ?> citas
                                            </div>
                                        </div>
                                    <?php
                                    }
                                    ?>
                                </div>
                            </a>
                            <!--FIN - CARD - AGENDA - ACTIVOS-->

                            <!--  INICIO - CARD - AGENDA FINALIZADOS -->
                            <a style="text-decoration: none; color: #212529;" href="agenda_finalizadas.php">
                                <div class="col mb-4">
                                    <?php
                                    /*se llama la conexion para la base de datos*/
                                    $consulta = "SELECT COUNT(*) AS contar FROM agenda WHERE estatus = 0";
                                    /*se crea una consulta para llamar la tabla requerida */
                                    $resultado = mysqli_query($conection, $consulta) or die("Algo ha ido mal en la consulta a la base de datos");
                                    /*se crea una validacion entre la conexion y la consulta*/
                                    while ($row = mysqli_fetch_array($resultado)) {
                                        /*mientras la variable $resultado este correcto los datos se mostraran en la variable $mostrar */
                                    ?>
                                        <div class="card">
                                            <div class="card-header ">
                                                <i class="fas fa-check " style="font-size: 50px; color: #28A745;"></i>

                                                <br><br>
                                                <center>
                                                    <h6>Finalizadas</h6>
                                                </center>
                                            </div>
                                            <div class="card-header">
                                                <?php echo $row['contar'] ?> Citas
                                            </div>
                                        </div>
                                    <?php
                                    }
                                    ?>
                                </div>
                            </a>
                            <!--FIN - CARD - AGENDA - FINALIZADOS-->

                            <!--  INICIO - CARD - AGENDA CANCELADOS -->
                            <a style="text-decoration: none; color: #212529;" href="agenda_cancelados.php">
                                <div class="col mb-4">
                                    <?php
                                    /*se llama la conexion para la base de datos*/
                                    $consulta = "SELECT COUNT(*) AS contar FROM agenda WHERE estatus = 2";
                                    /*se crea una consulta para llamar la tabla requerida */
                                    $resultado = mysqli_query($conection, $consulta) or die("Algo ha ido mal en la consulta a la base de datos");
                                    /*se crea una validacion entre la conexion y la consulta*/
                                    while ($row = mysqli_fetch_array($resultado)) {
                                        /*mientras la variable $resultado este correcto los datos se mostraran en la variable $mostrar */
                                    ?>
                                        <div class="card">
                                            <div class="card-header ">
                                                <i class="fas fa-ban " style="font-size: 50px; color: #DC3545;"></i>

                                                <br><br>
                                                <center>
                                                    <h6>Canceladas</h6>
                                                </center>
                                            </div>
                                            <div class="card-header">
                                                <?php echo $row['contar'] ?> Citas
                                            </div>
                                        </div>
                                    <?php
                                    }
                                    ?>
                                </div>
                            </a>
                            <!--FIN - CARD - AGENDA - CANCELADOS-->

                            <!--FIN - CARD - AGENDA - GANANCIA-->
                            <div class="col mb-4">
                                <?php
                                /*se llama la conexion para la base de datos*/
                                $consulta = "SELECT SUM(precio) AS sumas FROM agenda WHERE estatus = 0";
                                /*se crea una consulta para llamar la tabla requerida */
                                $resultado = mysqli_query($conection, $consulta) or die("Algo ha ido mal en la consulta a la base de datos");
                                /*se crea una validacion entre la conexion y la consulta*/
                                while ($row = mysqli_fetch_array($resultado)) {
                                    /*mientras la variable $resultado este correcto los datos se mostraran en la variable $mostrar */
                                ?>
                                    <div class="card">
                                        <div class="card-header ">
                                            <i class="fas fa-dollar-sign " style="font-size: 50px; color: #28A745;"></i>

                                            <br><br>
                                            <center>
                                                <h6>Ganancias</h6>
                                            </center>
                                        </div>
                                        <div class="card-header">
                                            Q.<?php echo $row['sumas'] ?>.00
                                        </div>
                                    </div>
                                <?php
                                }
                                ?>
                            </div>
                            <!--FIN - CARD - AGENDA - GANANCIA-->
                        </div>
                    </div>
                </div>
            </div>
            <!-- AGENDA - FINAL -->
            <br>

            <!-- EMPLEADOS - INICIO -->
            <div class="container">
                <div class="card" style="background-color: rgba(255, 255, 255, 0.17);">
                    <div class="card-header">
                        <h3>Empleados</h3>
                    </div>
                    <div class="card-body">
                        <div class="row row-cols-2 row-cols-md-2">
                            <a style="text-decoration: none; color: #212529;" href="empleados_activa.php">

                                <!--  INICIO - CARD - EMPLEADOS ACTIVOS-->
                                <div class="col mb-4">
                                    <?php
                                    /*se llama la conexion para la base de datos*/
                                    $consulta = "SELECT COUNT(*) AS contar FROM empleados WHERE estatus = 1";
                                    /*se crea una consulta para llamar la tabla requerida */
                                    $resultado = mysqli_query($conection, $consulta) or die("Algo ha ido mal en la consulta a la base de datos");
                                    /*se crea una validacion entre la conexion y la consulta*/
                                    while ($row = mysqli_fetch_array($resultado)) {
                                        /*mientras la variable $resultado este correcto los datos se mostraran en la variable $mostrar */
                                    ?>
                                        <div class="card">
                                            <div class="card-header ">
                                                <i class="fas fa-user-friends" style="font-size: 50px; color: #17A2B8;"></i>
                                                <br><br>
                                                <center>
                                                    <h6>Empleados activos</h6>
                                                </center>
                                            </div>
                                            <div class="card-header">
                                                <?php echo $row['contar'] ?> Activos
                                            </div>
                                        </div>
                                    <?php
                                    }
                                    ?>
                                </div>
                            </a>
                            <!--FIN - CARD - EMPLEADOS - ACTIVOS-->

                            <!--INICIO - CARD - EMPLEADOS DESACTIVADOS-->
                            <a style="text-decoration: none; color: #212529;" href="empleados_cancelado.php">

                                <div class="col mb-4">
                                    <?php
                                    /*se llama la conexion para la base de datos*/
                                    $consulta = "SELECT COUNT(*) AS contar1 FROM empleados WHERE estatus = 0";
                                    /*se crea una consulta para llamar la tabla requerida */
                                    $resultado = mysqli_query($conection, $consulta) or die("Algo ha ido mal en la consulta a la base de datos");
                                    /*se crea una validacion entre la conexion y la consulta*/
                                    while ($row = mysqli_fetch_array($resultado)) {
                                        /*mientras la variable $resultado este correcto los datos se mostraran en la variable $mostrar */
                                    ?>
                                        <div class="card">
                                            <div class="card-header ">
                                                <i class="fas fa-user-slash" style="font-size: 50px; color: #DC3545;"></i>

                                                <br><br>
                                                <center>
                                                    <h6>Empleados inactivos</h6>
                                                </center>
                                            </div>
                                            <div class="card-header">
                                                <?php echo $row['contar1'] ?> Inactivos
                                            </div>
                                        </div>
                                    <?php
                                    }
                                    ?>
                                </div>
                            </a>
                            <!--FIN - EMPLEADOS - DESCATIVADOS-->
                        </div>
                    </div>
                </div>
            </div>
            <!-- EMPLEADOS - FIN -->
            <br>

            <!-- DEUDAS - INICIO -->
            <div class="container">
                <div class="card" style="background-color: rgba(255, 255, 255, 0.17);">
                    <div class="card-header">
                        <h3>Deudas</h3>
                    </div>
                    <div class="card-body">
                        <div class="row row-cols-2 row-cols-md-3">
                            <a style="text-decoration: none; color: #212529;" href="deudas_cobrar.php">

                                <!--  FIN - CARD - DEUDAS ACTIVOS -->
                                <div class="col mb-4">
                                    <?php
                                    /*se llama la conexion para la base de datos*/
                                    $consulta = "SELECT COUNT(*) AS contar FROM deudas WHERE estatus = 1";
                                    /*se crea una consulta para llamar la tabla requerida */
                                    $resultado = mysqli_query($conection, $consulta) or die("Algo ha ido mal en la consulta a la base de datos");
                                    /*se crea una validacion entre la conexion y la consulta*/
                                    while ($row = mysqli_fetch_array($resultado)) {
                                        /*mientras la variable $resultado este correcto los datos se mostraran en la variable $mostrar */
                                    ?>
                                        <div class="card">
                                            <div class="card-header ">
                                                <i class="fas fa-hand-holding-usd" style="font-size: 50px; color: #28A745;"></i>
                                                <br><br>
                                                <center>
                                                    <h6>Deudas por cobrar</h6>
                                                </center>
                                            </div>
                                            <div class="card-header">
                                                <?php echo $row['contar'] ?> Por cobrar
                                            </div>
                                        </div>
                                    <?php
                                    }
                                    ?>
                                </div>
                            </a>
                            <!--FIN - CARD - DEUDAS - ACTIVOS-->

                            <!--  FIN - CARD - DEUDA CANCELADAS  -->
                            <a style="text-decoration: none; color: #212529;" href="deudas_cancelada.php">
                                <div class="col mb-4">
                                    <?php
                                    /*se llama la conexion para la base de datos*/
                                    $consulta = "SELECT COUNT(*) AS contar1 FROM deudas WHERE estatus = 0";
                                    /*se crea una consulta para llamar la tabla requerida */
                                    $resultado = mysqli_query($conection, $consulta) or die("Algo ha ido mal en la consulta a la base de datos");
                                    /*se crea una validacion entre la conexion y la consulta*/
                                    while ($row = mysqli_fetch_array($resultado)) {
                                        /*mientras la variable $resultado este correcto los datos se mostraran en la variable $mostrar */
                                    ?>
                                        <div class="card">
                                            <div class="card-header ">
                                                <i class="fas fa-receipt" style="font-size: 50px; color: #17A2B8;"></i>
                                                <br><br>
                                                <center>
                                                    <h6>Deudas canceladas</h6>
                                                </center>
                                            </div>
                                            <div class="card-header">
                                                <?php echo $row['contar1'] ?> Canceladas
                                            </div>
                                        </div>
                                    <?php
                                    }
                                    ?>
                                </div>
                            </a>
                            <!--FIN - CARD - DEUDAS - CANCELADAS-->

                            <!--FIN - CARD - DEUDAS - TOTAL CANCELADA-->
                            <div class="col mb-4">
                                <?php
                                /*se llama la conexion para la base de datos*/
                                $consulta = "SELECT SUM(precio) AS pre FROM deudas WHERE estatus = 0";
                                /*se crea una consulta para llamar la tabla requerida */
                                $resultado = mysqli_query($conection, $consulta) or die("Algo ha ido mal en la consulta a la base de datos");
                                /*se crea una validacion entre la conexion y la consulta*/
                                while ($row = mysqli_fetch_array($resultado)) {
                                    /*mientras la variable $resultado este correcto los datos se mostraran en la variable $mostrar */
                                ?>
                                    <div class="card">
                                        <div class="card-header ">
                                            <i class="fas fa-dollar-sign" style="font-size: 50px; color: #28A745;"></i>
                                            <br><br>
                                            <center>
                                                <h6>Total cancelada</h6>
                                            </center>
                                        </div>
                                        <div class="card-header">
                                            Q.<?php echo $row['pre'] ?>.00 ganancia
                                        </div>
                                    </div>
                                <?php
                                }
                                ?>
                            </div>
                            <!-- FIN - CARD - DEUDAS - TOTAL CANCELADA -->
                        </div>
                    </div>
                </div>
            </div>
            <!-- DEUDAS - FIN -->
            <br>

            <!-- INVENTARIO - INICIO -->
            <div class="container">
                <div class="card" style="background-color: rgba(255, 255, 255, 0.17);">
                    <div class="card-header">
                        <h3>Inventario</h3>
                    </div>
                    <div class="card-body">
                        <div class="row row-cols-2 row-cols-md-3">
                            <!--  INICIO - CARD - INVENTARIO - CON STOCK -->
                            <a style="text-decoration: none; color: #212529;" href="alta_inventario.php">

                            <div class="col mb-4">
                                <?php
                                /*se llama la conexion para la base de datos*/
                                $consulta = "SELECT SUM(cantidad) AS producto FROM `inventario` WHERE estatus =1";
                                /*se crea una consulta para llamar la tabla requerida */
                                $resultado = mysqli_query($conection, $consulta) or die("Algo ha ido mal en la consulta a la base de datos");
                                /*se crea una validacion entre la conexion y la consulta*/
                                while ($row = mysqli_fetch_array($resultado)) {
                                    /*mientras la variable $resultado este correcto los datos se mostraran en la variable $mostrar */
                                ?>
                                    <div class="card">
                                        <div class="card-header ">
                                            <i class="fas fa-boxes" style="font-size: 50px; color: #28A745;"></i>
                                            <br><br>
                                            <center>
                                                <h6>Nivel de stock</h6>
                                            </center>
                                        </div>
                                        <div class="card-header">
                                            <?php echo $row['producto'] ?> En stock
                                        </div>
                                    </div>
                                <?php
                                }
                                ?>
                            </div>
                            </a>
                            <!--  FIN - CARD - INVENTAIRO - CON STOCK -->

                            <!-- INICIO -CARD - INVENTARIO - SIN STOCK -->
                            <a style="text-decoration: none; color: #212529;" href="baja_inventario.php">

                                <div class="col mb-4">
                                    <?php
                                    /*se llama la conexion para la base de datos*/
                                    $consulta = "SELECT count(id_inventario) AS stock FROM inventario WHERE estatus =0";
                                    /*se crea una consulta para llamar la tabla requerida */
                                    $resultado = mysqli_query($conection, $consulta) or die("Algo ha ido mal en la consulta a la base de datos");
                                    /*se crea una validacion entre la conexion y la consulta*/
                                    while ($row = mysqli_fetch_array($resultado)) {
                                        /*mientras la variable $resultado este correcto los datos se mostraran en la variable $mostrar */
                                    ?>
                                        <div class="card">
                                            <div class="card-header ">
                                                <i class="fas fa-indent" style="font-size: 50px; color: #DC3545;"></i>
                                                <br><br>
                                                <center>
                                                    <h6>Productos sin stock</h6>
                                                </center>
                                            </div>
                                            <div class="card-header">
                                                <?php echo $row['stock'] ?> productos sin stock
                                            </div>
                                        </div>
                                    <?php
                                    }
                                    ?>
                                </div>
                            </a>
                            <!--FIN - CARD - INVENTARIO - SIN STOCK -->

                            <!--FIN - CARD - INVENTARIO - TOTAL DE INVENTARIO -->
                            <div class="col mb-4">
                                <?php
                                /*se llama la conexion para la base de datos*/
                                $consulta = "SELECT SUM(cantidad*precio) AS producto FROM `inventario` WHERE estatus =1";
                                /*se crea una consulta para llamar la tabla requerida */
                                $resultado = mysqli_query($conection, $consulta) or die("Algo ha ido mal en la consulta a la base de datos");
                                /*se crea una validacion entre la conexion y la consulta*/
                                while ($row = mysqli_fetch_array($resultado)) {
                                    /*mientras la variable $resultado este correcto los datos se mostraran en la variable $mostrar */
                                ?>
                                    <div class="card">
                                        <div class="card-header ">
                                            <i class="far fa-list-alt" style="font-size: 50px; color: #28A745;"></i>

                                            <br><br>
                                            <center>
                                                <h6>Total de inventario</h6>
                                            </center>
                                        </div>
                                        <div class="card-header">
                                            Q.<?php echo $row['producto'] ?>.00 en existencia
                                        </div>
                                    </div>
                                <?php
                                }
                                ?>
                            </div>
                            <!--FIN - CARD - INVENTARIO - TOTAL DE INVENTARIO -->
                        </div>
                    </div>
                </div>
            </div>
            <!-- INVENTARIO FIN -->
            <br>

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