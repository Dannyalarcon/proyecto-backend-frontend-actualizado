<?php
// SET HEADER
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Credentials: true");
header("Content-Type: application/json; charset=UTF-8");

// INCLUDING DATABASE AND MAKING OBJECT
require '/wamp64/www/api_mayris/config/database.php';$db_connection = new Database();
$conn = $db_connection->dbConnection();

// CHECK GET ID PARAMETER OR NOT
if(isset($_GET['id_empleados']))
{
    //IF HAS ID PARAMETER
    $post_id = filter_var($_GET['id_empleados'], FILTER_VALIDATE_INT,[
        'options' => [
            'default' => 'all_posts',
            'min_range' => 1
        ]
    ]);
}
else{
    $post_id = 'all_posts';
}

// MAKE SQL QUERY
// IF GET POSTS ID, THEN SHOW POSTS BY ID OTHERWISE SHOW ALL POSTS
$sql = is_numeric($post_id) ? "SELECT * FROM `empleados` WHERE id_empleados='$post_id'" : "SELECT * FROM empleados WHERE estatus = 1 "; 

$stmt = $conn->prepare($sql);

$stmt->execute();

//CHECK WHETHER THERE IS ANY POST IN OUR DATABASE
if($stmt->rowCount() > 0){
    // CREATE POSTS ARRAY
    $posts_array = [];
    
    while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        
        $post_data = [
            'id_empleados' => $row['id_empleados'],
            'dpi' => $row['dpi'],
            'nombre' => $row['nombre'],
            'direccion' => $row['direccion'],
            'telefono' => $row['telefono'],
            'fecha' => $row['fecha'],
            'correo' => $row['correo'],
            'salario' => $row['salario'],
            'estatus' => $row['estatus']

        ];
        // PUSH POST DATA IN OUR $posts_array ARRAY
        array_push($posts_array, $post_data);
    }
    //SHOW POST/POSTS IN JSON FORMAT
    echo json_encode($posts_array);
 

}
else{
    //IF THER IS NO POST IN OUR DATABASE
    echo json_encode(['message'=>'No post found']);
}
?>