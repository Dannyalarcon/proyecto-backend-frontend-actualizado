<?php
// SET HEADER
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: PUT");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

// INCLUDING DATABASE AND MAKING OBJECT
require '/wamp64/www/api_mayris/config/database.php';$db_connection = new Database();
$conn = $db_connection->dbConnection();

// GET DATA FORM REQUEST
$data = json_decode(file_get_contents("php://input"));

//CHECKING, IF ID AVAILABLE ON $data
if(isset($data->id_inventario)){
    
    $msg['message'] = '';
    $post_id = $data->id_inventario;
    
    //GET POST BY ID FROM DATABASE
    
    $get_post = "SELECT * FROM `inventario` WHERE id_inventario=:post_id_inventario";
    $get_stmt = $conn->prepare($get_post);
    $get_stmt->bindValue(':post_id_inventario', $post_id,PDO::PARAM_INT);
    $get_stmt->execute();
    
    
    //CHECK WHETHER THERE IS ANY POST IN OUR DATABASE
    if($get_stmt->rowCount() > 0){
        
        // FETCH POST FROM DATBASE 
        $row = $get_stmt->fetch(PDO::FETCH_ASSOC);
        
        // CHECK, IF NEW UPDATE REQUEST DATA IS AVAILABLE THEN SET IT OTHERWISE SET OLD DATA
        $post_producto = isset($data->producto) ? $data->producto : $row['producto'];
        $post_precio = isset($data->precio) ? $data->precio : $row['precio'];
        $post_cantidad = isset($data->cantidad) ? $data->cantidad: $row['cantidad'];




        $update_query = "UPDATE `inventario` SET estatus = 1 WHERE id_inventario = :id_inventario";

        
        $update_stmt = $conn->prepare($update_query);
        
        // DATA BINDING AND REMOVE SPECIAL CHARS AND REMOVE TAGS

        $update_stmt->bindValue(':id_inventario', $post_id,PDO::PARAM_INT);
        
        
        if($update_stmt->execute()){
            $msg['message'] = ' producto dado de alta exitosamente';
        }else{
            $msg['message'] = 'datos no actualizado';
        }   
        
    }
    else{
        $msg['message'] = 'ID invalido';
    }  
    
    echo  json_encode($msg);
    
}
?>