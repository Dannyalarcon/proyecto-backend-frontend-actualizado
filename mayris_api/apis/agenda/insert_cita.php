<?php
// SET HEADER
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: POST");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
// INCLUDING DATABASE AND MAKING OBJECT
require '/wamp64/www/api_mayris/config/database.php';
$db_connection = new Database();
$conn = $db_connection->dbConnection();
// GET DATA FORM REQUEST
$data = json_decode(file_get_contents("php://input"));
//CREATE MESSAGE ARRAY AND SET EMPTY
$msg['message'] = '';

// CHECK IF RECEIVED DATA FROM THE REQUEST
if(isset($data->nombre) && isset($data->descripcion) && isset($data->precio) && isset($data->telefono) && isset($data->fecha) && isset($data->hora) ){
    // CHECK DATA VALUE IS EMPTY OR NOT
    if(!empty($data->nombre) && !empty($data->descripcion) && !empty($data->precio) &&!empty($data->telefono) && !empty($data->fecha) && !empty($data->hora) ){
        
        $insert_query = "INSERT INTO `agenda`( nombre, descripcion, precio, telefono, fecha, hora) 
                                       VALUES(:nombre, :descripcion, :precio, :telefono, :fecha, :hora)";
        
        $insert_stmt = $conn->prepare($insert_query);
        // DATA BINDING
        $insert_stmt->bindValue(':nombre', htmlspecialchars(strip_tags($data->nombre)),PDO::PARAM_STR);
        $insert_stmt->bindValue(':descripcion', htmlspecialchars(strip_tags($data->descripcion)),PDO::PARAM_STR);
        $insert_stmt->bindValue(':precio', htmlspecialchars(strip_tags($data->precio)),PDO::PARAM_STR);
        $insert_stmt->bindValue(':telefono', htmlspecialchars(strip_tags($data->telefono)),PDO::PARAM_STR);
        $insert_stmt->bindValue(':fecha', htmlspecialchars(strip_tags($data->fecha)),PDO::PARAM_STR);
        $insert_stmt->bindValue(':hora', htmlspecialchars(strip_tags($data->hora)),PDO::PARAM_STR);
 
        if($insert_stmt->execute()){
            $msg['message'] = 'Cita creada exitosamente';
        }else{
            $msg['message'] = 'ERROR! no se creo la cita';
        } 
        
    }else{
        $msg['message'] = 'Campo vacío detectado. Por favor llene todos los campos';
    }
}
else{
    $msg['message'] = 'Campo vacío detectado. Por favor llene todos los campos';
}
//ECHO DATA IN JSON FORMAT
echo  json_encode($msg);
?>