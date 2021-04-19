<?php
include_once 'C:\wamp64\www\mayris_api\config\conexion.php';
$objeto = new Conexion();
$conexion = $objeto->Conectar();

$_POST = json_decode(file_get_contents("php://input"), true);
$opcion = (isset($_POST['opcion'])) ? $_POST['opcion'] : '';
$id_deuda = (isset($_POST['id_deuda'])) ? $_POST['id_deuda'] : '';

$dpi = (isset($_POST['dpi'])) ? $_POST['dpi'] : '';
$nombre = (isset($_POST['nombre'])) ? $_POST['nombre'] : '';
$direccion = (isset($_POST['direccion'])) ? $_POST['direccion'] : '';
$telefono = (isset($_POST['telefono'])) ? $_POST['telefono'] : '';
$deuda = (isset($_POST['deuda'])) ? $_POST['deuda'] : '';
$precio = (isset($_POST['precio'])) ? $_POST['precio'] : '';
$fecha = (isset($_POST['fecha'])) ? $_POST['fecha'] : '';

$estatus = (isset($_POST['estatus'])) ? $_POST['estatus'] : '';




switch ($opcion) {
    case 1:
        $consulta = "INSERT INTO deudas ( dpi, nombre, direccion, telefono, deuda, precio, fecha) 
        VALUES ('$dpi', '$nombre', '$direccion', '$telefono', '$deuda', '$precio', '$fecha')";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        break;
    case 2:
        $consulta = "UPDATE deudas SET dpi = '$dpi',nombre = '$nombre',direccion = '$direccion',telefono ='$telefono', deuda ='$deuda', precio ='$precio', fecha='$fecha' WHERE id_deuda = '$id_deuda'";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        $data = $resultado->fetchAll(PDO::FETCH_ASSOC);
        break;
    case 3:
        $consulta = "UPDATE deudas SET estatus = '0' WHERE id_deuda='$id_deuda' ";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        break;
    case 4:
        $consulta = "SELECT * FROM deudas WHERE estatus = 1 ORDER BY nombre ASC ";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        $data = $resultado->fetchAll(PDO::FETCH_ASSOC);
        break;
   
   
}
print json_encode($data, JSON_UNESCAPED_UNICODE);
$conexion = NULL;
