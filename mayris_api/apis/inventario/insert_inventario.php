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
if(isset($data->producto)  && isset($data->precio) && isset($data->cantidad)  ){
    // CHECK DATA VALUE IS EMPTY OR NOT
    if(!empty($data->producto) && !empty($data->precio) && !empty($data->cantidad) ){
        
        $insert_query = "INSERT INTO `inventario`( producto, precio, cantidad) 
        VALUES(:producto, :precio, :cantidad)";
        
        $insert_stmt = $conn->prepare($insert_query);
        // DATA BINDING
        $insert_stmt->bindValue(':producto', htmlspecialchars(strip_tags($data->producto)),PDO::PARAM_STR);
        $insert_stmt->bindValue(':precio', htmlspecialchars(strip_tags($data->precio)),PDO::PARAM_STR);
        $insert_stmt->bindValue(':cantidad', htmlspecialchars(strip_tags($data->cantidad)),PDO::PARAM_STR);
        
        if($insert_stmt->execute()){
            $msg['message'] = 'datos insertados exitosamente';
        }else{
            $msg['message'] = 'Error! datos no ingresados';
        } 
        
    }else{
        $msg['message'] = 'Campo vacío detectado. Por favor llene todos los campos';
    }
}
else{
    $msg['message'] = 'favor de completar los siguientes campos | producto,  precio , cantidad';
}
//ECHO DATA IN JSON FORMAT
echo  json_encode($msg);
?>