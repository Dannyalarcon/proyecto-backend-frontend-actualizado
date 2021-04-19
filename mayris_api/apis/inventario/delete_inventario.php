<?php
// SET HEADER
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: DELETE");
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
    // YOU CAN REMOVE THIS QUERY AND PERFORM ONLY DELETE QUERY
    $check_post = "SELECT * FROM `inventario` WHERE id_inventario=:post_id_inventario";
    $check_post_stmt = $conn->prepare($check_post);
    $check_post_stmt->bindValue(':post_id_inventario', $post_id,PDO::PARAM_INT);
    $check_post_stmt->execute();
    
    //CHECK WHETHER THERE IS ANY POST IN OUR DATABASE
    if($check_post_stmt->rowCount() > 0){
        
        //DELETE POST BY ID FROM DATABASE
        $delete_post = "DELETE FROM `inventario` WHERE id_inventario=:post_id_inventario";
        $delete_post_stmt = $conn->prepare($delete_post);
        $delete_post_stmt->bindValue(':post_id_inventario', $post_id,PDO::PARAM_INT);
        
        if($delete_post_stmt->execute()){
            $msg['message'] = 'datos eliminados exitosamente';
        }else{
            $msg['message'] = 'datos no eliminados, intenta nuevamente';
        }
        
    }else{
        $msg['message'] = 'ID invalido';
    }
    // ECHO MESSAGE IN JSON FORMAT
    echo  json_encode($msg);
    
}
?>