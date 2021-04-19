<?php

include_once 'C:\wamp64\www\mayris_api\config\conexion.php';
$objeto = new Conexion();
$conexion = $objeto->Conectar();

$_POST = json_decode(file_get_contents("php://input"), true);
$opcion = (isset($_POST['opcion'])) ? $_POST['opcion'] : '';
$id_agenda = (isset($_POST['id_agenda'])) ? $_POST['id_agenda'] : '';
$nombre = (isset($_POST['nombre'])) ? $_POST['nombre'] : '';
$descripcion = (isset($_POST['descripcion'])) ? $_POST['descripcion'] : '';

$precio = (isset($_POST['precio'])) ? $_POST['precio'] : '';
$telefono = (isset($_POST['telefono'])) ? $_POST['telefono'] : '';
$fecha = (isset($_POST['fecha'])) ? $_POST['fecha'] : '';

$hora = (isset($_POST['hora'])) ? $_POST['hora'] : '';
$asistencia = (isset($_POST['asistencia'])) ? $_POST['asistencia'] : '';
$estatus = (isset($_POST['estatus'])) ? $_POST['estatus'] : '';

switch ($opcion) {
    case 1:
        $consulta = "INSERT INTO agenda( nombre, descripcion, precio, telefono, fecha, hora, asistencia, estatus ) 
        VALUES ('$nombre','$descripcion','$precio','$telefono','$fecha','$hora','ausente',1)";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        break;
    case 2:
        $consulta = "UPDATE agenda SET nombre='$nombre', descripcion='$descripcion', precio='$precio', telefono='$telefono', fecha='$fecha', hora='$hora' WHERE id_agenda='$id_agenda' ";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        $data = $resultado->fetchAll(PDO::FETCH_ASSOC);
        break;
    case 3:
        $consulta = "UPDATE agenda SET asistencia='finalizado', estatus = '0' WHERE id_agenda=$id_agenda";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        break;
        //para ordenar los datos ausentes
        //SELECT * FROM agenda WHERE estatus = 1 ORDER BY fecha ASC, hora ASC
    case 4:
        $consulta = "SELECT * FROM agenda WHERE estatus = 1 ORDER BY fecha ASC, hora ASC";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        $data = $resultado->fetchAll(PDO::FETCH_ASSOC);
        break;
        //para ordenar los datos finalizados
    case 5:
        $consulta = "SELECT * FROM agenda WHERE estatus = 0 ORDER BY fecha ASC, hora ASC";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        $data = $resultado->fetchAll(PDO::FETCH_ASSOC);
        break;
        //para mostrar los datos cancelados
    case 6:
        $consulta = "SELECT * FROM agenda WHERE estatus = 2 ORDER BY fecha ASC, hora ASC";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        $data = $resultado->fetchAll(PDO::FETCH_ASSOC);
        break;
        //para update de cancelar datos
    case 7:
        $consulta = "UPDATE agenda SET asistencia='cancelado', estatus = '2' WHERE id_agenda=$id_agenda";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        break;
}
print json_encode($data, JSON_UNESCAPED_UNICODE);
$conexion = NULL;
