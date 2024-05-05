<?php 
	header("Access-Control-Allow-Origin: *"); 
	header("Content-Type: application/json; charset=UTF-8"); 
	header("Access-Control-Allow-Methods: OPTIONS,GET,POST,PUT,DELETE"); 
	header("Access-Control-Max-Age: 3600"); 
	header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
	include '../../db/connectDB.php';  
	$requestMethod = $_SERVER["REQUEST_METHOD"]; 
	if($requestMethod == 'DELETE'){  
		if(empty($_GET['id'])){ 
			http_response_code(400);
		    echo json_encode(
               [
                  "success" => false, 
                  "statusCode" => 400,
                  "message" => "Error not found"
               ]
           ); 
           exit();
		}  
		$id = $_GET['id']; 
		$sql = "DELETE FROM posts WHERE id = $id"; 
		$result = mysqli_query($conn, $sql); 
        if (!$result) { 
           http_response_code(404);
		   echo json_encode(
               [
                  "success" => false, 
                  "statusCode" => 404,
                  "message" => "Error: " . mysqli_error($conn)
               ]
           ); 
           exit();
           mysqli_close($conn);
        }
		   echo json_encode(
               [
                  "success" => true, 
                  "statusCode" => 200,
                  "message" => "Delete post id " . $id . " success"
               ],
               JSON_NUMERIC_CHECK
           ); 
        http_response_code(200); 
	}