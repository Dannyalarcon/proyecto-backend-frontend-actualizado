<?php
include_once 'C:\wamp64\www\mayris_api\config\conexion.php';
$objeto = new Conexion();
$conexion = $objeto->Conectar();

$_POST = json_decode(file_get_contents("php://input"), true);
$opcion = (isset($_POST['opcion'])) ? $_POST['opcion'] : '';
$id_empleados = (isset($_POST['id_empleados'])) ? $_POST['id_empleados'] : '';
$dpi = (isset($_POST['dpi'])) ? $_POST['dpi'] : '';
$nombre = (isset($_POST['nombre'])) ? $_POST['nombre'] : '';
$direccion = (isset($_POST['direccion'])) ? $_POST['direccion'] : '';
$telefono = (isset($_POST['telefono'])) ? $_POST['telefono'] : '';
$fecha = (isset($_POST['fecha'])) ? $_POST['fecha'] : '';
$correo = (isset($_POST['correo'])) ? $_POST['correo'] : '';
$salario = (isset($_POST['salario'])) ? $_POST['salario'] : '';
$estatus = (isset($_POST['estatus'])) ? $_POST['estatus'] : '';


switch ($opcion) {
    case 1:
        $consulta = "INSERT INTO empleados (dpi, nombre, direccion, telefono, fecha, correo, salario, estatus) VALUES ('$dpi','$nombre','$direccion', '$telefono', '$fecha', '$correo', '$salario', 1)";

        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        break;
    case 2:
        $consulta = "UPDATE empleados SET dpi = '$dpi', nombre = '$nombre', salario = '$salario', telefono = '$telefono', fecha = '$fecha', correo = '$correo',direccion = '$direccion'WHERE id_empleados = $id_empleados ";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        $data = $resultado->fetchAll(PDO::FETCH_ASSOC);
        break;
    case 3:
        $consulta = "UPDATE empleados SET estatus = '0' WHERE id_empleados='$id_empleados' ";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        break;
    case 4:
        $consulta = "SELECT * FROM empleados WHERE estatus = 1";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        $data = $resultado->fetchAll(PDO::FETCH_ASSOC);
        break;
    case 5:
        $consulta = "SELECT * FROM empleados WHERE estatus = 0";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        $data = $resultado->fetchAll(PDO::FETCH_ASSOC);
        break;
    case 6:
        $consulta = "UPDATE empleados SET estatus = '1' WHERE id_empleados='$id_empleados' ";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        break;
}
print json_encode($data, JSON_UNESCAPED_UNICODE);
$conexion = NULL;
