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
if(isset($data->id_empleados)){
    
    $msg['message'] = '';
    $post_id = $data->id_empleados;
    
    //GET POST BY ID FROM DATABASE
    
    $get_post = "SELECT * FROM `empleados` WHERE id_empleados=:post_id_empleados";
    $get_stmt = $conn->prepare($get_post);
    $get_stmt->bindValue(':post_id_empleados', $post_id,PDO::PARAM_INT);
    $get_stmt->execute();
    
    
    //CHECK WHETHER THERE IS ANY POST IN OUR DATABASE
    if($get_stmt->rowCount() > 0){
        
        // FETCH POST FROM DATBASE 
        $row = $get_stmt->fetch(PDO::FETCH_ASSOC);
        
        // CHECK, IF NEW UPDATE REQUEST DATA IS AVAILABLE THEN SET IT OTHERWISE SET OLD DATA
        $post_dpi = isset($data->dpi) ? $data->dpi : $row['dpi'];
        $post_nombre = isset($data->nombre) ? $data->nombre : $row['nombre'];
        $post_direccion = isset($data->direccion) ? $data->direccion: $row['direccion'];
        $post_telefono = isset($data->telefono) ? $data->telefono : $row['telefono'];
        $post_fecha = isset($data->fecha) ? $data->fecha : $row['fecha'];
        $post_correo = isset($data->correo) ? $data->correo: $row['correo'];
        $post_salario = isset($data->salario) ? $data->salario: $row['salario'];




        $update_query = "UPDATE `empleados` SET dpi = :dpi, nombre = :nombre, direccion = :direccion, telefono = :telefono, fecha = :fecha, correo = :correo, salario = :salario   
        WHERE id_empleados = :id_empleados";
        
        $update_stmt = $conn->prepare($update_query);
        
        // DATA BINDING AND REMOVE SPECIAL CHARS AND REMOVE TAGS
        $update_stmt->bindValue(':dpi', htmlspecialchars(strip_tags($post_dpi)),PDO::PARAM_STR);
        $update_stmt->bindValue(':nombre', htmlspecialchars(strip_tags($post_nombre)),PDO::PARAM_STR);
        $update_stmt->bindValue(':direccion', htmlspecialchars(strip_tags($post_direccion)),PDO::PARAM_STR);
        $update_stmt->bindValue(':telefono', htmlspecialchars(strip_tags($post_telefono)),PDO::PARAM_STR);
        $update_stmt->bindValue(':fecha', htmlspecialchars(strip_tags($post_fecha)),PDO::PARAM_STR);
        $update_stmt->bindValue(':correo', htmlspecialchars(strip_tags($post_correo)),PDO::PARAM_STR);
        $update_stmt->bindValue(':salario', htmlspecialchars(strip_tags($post_salario)),PDO::PARAM_STR);
        
        $update_stmt->bindValue(':id_empleados', $post_id,PDO::PARAM_INT);
        
        
        if($update_stmt->execute()){
            $msg['message'] = ' datos del empleado actualizados exitosamente';
        }else{
            $msg['message'] = 'Error! datos no actualizados';
        }   
        
    }
    else{
        $msg['message'] = 'ID invalido';
    }  
    
    echo  json_encode($msg);
    
}
?>