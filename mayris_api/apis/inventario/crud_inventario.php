<?php
include_once 'C:\wamp64\www\mayris_api\config\conexion.php';
$objeto = new Conexion();
$conexion = $objeto->Conectar();

$_POST = json_decode(file_get_contents("php://input"), true);
$opcion = (isset($_POST['opcion'])) ? $_POST['opcion'] : '';
$id_inventario = (isset($_POST['id_inventario'])) ? $_POST['id_inventario'] : '';
$producto = (isset($_POST['producto'])) ? $_POST['producto'] : '';
$precio = (isset($_POST['precio'])) ? $_POST['precio'] : '';
$cantidad = (isset($_POST['cantidad'])) ? $_POST['cantidad'] : '';


switch($opcion){
    case 1:
        $consulta = "INSERT INTO inventario (producto, precio, cantidad) VALUES ('$producto','$precio','$cantidad')";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();                
        break;
    case 2:
        $consulta = "UPDATE inventario SET producto = '$producto',precio = '$precio',cantidad = '$cantidad' WHERE id_inventario = '$id_inventario'";		
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();                        
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
        break;        
    case 3:
        $consulta = "UPDATE inventario SET estatus = 0 WHERE id_inventario='$id_inventario' ";		
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();                           
        break;         
    case 4:
        $consulta = "SELECT * , (precio * cantidad) AS total FROM inventario WHERE estatus = 1 ORDER BY producto ASC";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
        break;
    case 5:
        $consulta = "SELECT * , (precio * cantidad) AS total FROM inventario WHERE estatus = 0";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
        break;
    case 6:
        $consulta = "UPDATE inventario SET estatus = 1 WHERE id_inventario='$id_inventario'";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
        break;

}
print json_encode($data, JSON_UNESCAPED_UNICODE);
$conexion = NULL;

