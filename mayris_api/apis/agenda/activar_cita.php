<?php
// SET HEADER
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: DELETE");
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
    // YOU CAN REMOVE THIS QUERY AND PERFORM ONLY DELETE QUERY
    $check_post = "SELECT * FROM `agenda` WHERE id_agenda=:post_id_agenda";

    $check_post_stmt = $conn->prepare($check_post);
    $check_post_stmt->bindValue(':post_id_agenda', $post_id,PDO::PARAM_INT);
    $check_post_stmt->execute();
    
    //CHECK WHETHER THERE IS ANY POST IN OUR DATABASE
    if($check_post_stmt->rowCount() > 0){
        
        //DELETE POST BY ID FROM DATABASE .......DELETE FROM `agenda` WHERE id_agenda=:post_id_agenda
        $delete_post = "UPDATE agenda SET asistencia='ausente', estatus = '1' WHERE id_agenda=:post_id_agenda";

        $delete_post_stmt = $conn->prepare($delete_post);
        $delete_post_stmt->bindValue(':post_id_agenda', $post_id,PDO::PARAM_INT);
        
        if($delete_post_stmt->execute()){
            $msg['message'] = 'Cita activada exitosamente';
        }else{
            $msg['message'] = 'Error no activo la cita intentalo nuevamente ';
        }
        
    }else{
        $msg['message'] = 'no reconoce ID intentalo nuevamente';
    }
    // ECHO MESSAGE IN JSON FORMAT
    echo  json_encode($msg);
    
}
?>