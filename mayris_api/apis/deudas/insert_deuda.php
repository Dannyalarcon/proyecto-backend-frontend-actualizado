<?php
// SET HEADER
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: POST");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
// INCLUDING DATABASE AND MAKING OBJECT
require '/wamp64/www/api_mayris/config/database.php';$db_connection = new Database();
$conn = $db_connection->dbConnection();
// GET DATA FORM REQUEST
$data = json_decode(file_get_contents("php://input"));
//CREATE MESSAGE ARRAY AND SET EMPTY
$msg['message'] = '';

// CHECK IF RECEIVED DATA FROM THE REQUEST
if(isset($data->dpi) && isset($data->nombre) && isset($data->direccion) && isset($data->telefono)&& isset($data->deuda)&& isset($data->precio)&& isset($data->fecha)){
    // CHECK DATA VALUE IS EMPTY OR NOT
    if(!empty($data->dpi) && !empty($data->nombre) && !empty($data->direccion) && !empty($data->telefono) && !empty($data->deuda) && !empty($data->precio) && !empty($data->fecha)){
        
        $insert_query = "INSERT INTO `deudas`( dpi, nombre, direccion, telefono, deuda, precio, fecha) 
                                       VALUES(:dpi, :nombre, :direccion, :telefono, :deuda, :precio, :fecha)";
        
        $insert_stmt = $conn->prepare($insert_query);
        // DATA BINDING
        $insert_stmt->bindValue(':dpi', htmlspecialchars(strip_tags($data->dpi)),PDO::PARAM_STR);
        $insert_stmt->bindValue(':nombre', htmlspecialchars(strip_tags($data->nombre)),PDO::PARAM_STR);
        $insert_stmt->bindValue(':direccion', htmlspecialchars(strip_tags($data->direccion)),PDO::PARAM_STR);
        $insert_stmt->bindValue(':telefono', htmlspecialchars(strip_tags($data->telefono)),PDO::PARAM_STR);
        $insert_stmt->bindValue(':deuda', htmlspecialchars(strip_tags($data->deuda)),PDO::PARAM_STR);
        $insert_stmt->bindValue(':precio', htmlspecialchars(strip_tags($data->precio)),PDO::PARAM_STR);
        $insert_stmt->bindValue(':fecha', htmlspecialchars(strip_tags($data->fecha)),PDO::PARAM_STR);
 
 
        if($insert_stmt->execute()){
            $msg['message'] = 'deuda creada exitosamente';
        }else{
            $msg['message'] = 'error! intentalo nuevamente';
        } 
        
    }else{
        $msg['message'] = 'Campo vacío detectado. Por favor llene todos los campos';
    }
}
else{
    $msg['message'] = 'favor de completar los siguientes campos | dpi , nombre, direccion, telefono, deuda, precio, fecha';
}
//ECHO DATA IN JSON FORMAT
echo  json_encode($msg);
?>