<?php
// SET HEADER
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: PUT");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

// INCLUDING DATABASE AND MAKING OBJECT
require '/wamp64/www/api_mayris/config/database.php';
$db_connection = new Database();
$conn = $db_connection->dbConnection();

// GET DATA FORM REQUEST
$data = json_decode(file_get_contents("php://input"));

//CHECKING, IF ID AVAILABLE ON $data
if(isset($data->id_agenda)){
    
    $msg['message'] = '';
    $post_id = $data->id_agenda;
    
    //GET POST BY ID FROM DATABASE
    
    $get_post = "SELECT * FROM `agenda` WHERE id_agenda=:post_id_agenda";
    $get_stmt = $conn->prepare($get_post);
    $get_stmt->bindValue(':post_id_agenda', $post_id,PDO::PARAM_INT);
    $get_stmt->execute();
    
    
    //CHECK WHETHER THERE IS ANY POST IN OUR DATABASE
    if($get_stmt->rowCount() > 0){
        
        // FETCH POST FROM DATBASE 
        $row = $get_stmt->fetch(PDO::FETCH_ASSOC);
        
        // CHECK, IF NEW UPDATE REQUEST DATA IS AVAILABLE THEN SET IT OTHERWISE SET OLD DATA
        $post_nombre = isset($data->nombre) ? $data->nombre : $row['nombre'];
        $post_descripcion = isset($data->descripcion) ? $data->descripcion : $row['descripcion'];
        $post_precio = isset($data->precio) ? $data->precio: $row['precio'];
        $post_telefono = isset($data->telefono) ? $data->telefono : $row['telefono'];
        $post_fecha = isset($data->fecha) ? $data->fecha : $row['fecha'];
        $post_hora = isset($data->hora) ? $data->hora: $row['hora'];



        $update_query = "UPDATE `agenda` SET nombre = :nombre, descripcion = :descripcion, precio = :precio, telefono = :telefono, fecha = :fecha, hora = :hora   
        WHERE id_agenda = :id_agenda";
        
        $update_stmt = $conn->prepare($update_query);
        
        // DATA BINDING AND REMOVE SPECIAL CHARS AND REMOVE TAGS
        $update_stmt->bindValue(':nombre', htmlspecialchars(strip_tags($post_nombre)),PDO::PARAM_STR);
        $update_stmt->bindValue(':descripcion', htmlspecialchars(strip_tags($post_descripcion)),PDO::PARAM_STR);
        $update_stmt->bindValue(':precio', htmlspecialchars(strip_tags($post_precio)),PDO::PARAM_STR);
        $update_stmt->bindValue(':telefono', htmlspecialchars(strip_tags($post_telefono)),PDO::PARAM_STR);
        $update_stmt->bindValue(':fecha', htmlspecialchars(strip_tags($post_fecha)),PDO::PARAM_STR);
        $update_stmt->bindValue(':hora', htmlspecialchars(strip_tags($post_hora)),PDO::PARAM_STR);
        $update_stmt->bindValue(':id_agenda', $post_id,PDO::PARAM_INT);
        
        
        if($update_stmt->execute()){
            $msg['message'] = 'Cita actualizada exitosamente';
        }else{
            $msg['message'] = 'La cita no ha sido actualizada';
        }      
    }
    else{
        $msg['message'] = 'ID invalido';
    }  
    
    echo  json_encode($msg);
    
}
?>