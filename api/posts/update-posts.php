<?php 
	header("Access-Control-Allow-Origin: *"); 
	header("Content-Type: application/json; charset=UTF-8"); 
	header("Access-Control-Allow-Methods: OPTIONS,GET,POST,PUT,DELETE"); 
	header("Access-Control-Max-Age: 3600"); 
	header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
	include '../../db/connectDB.php';  
	$requestMethod = $_SERVER["REQUEST_METHOD"]; 
	if($requestMethod == 'PUT'){  
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
    	$data = file_get_contents("php://input"); 
		if(empty($data)){
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
		$result = json_decode($data,true);
	    $title = mysqli_real_escape_string($conn, $result['title']);
	    $userId = mysqli_real_escape_string($conn, $result['userId']);
	    $body = mysqli_real_escape_string($conn, $result['body']);
        $sql = "UPDATE posts SET title='$title', userId='$userId', body='$body' WHERE id=$id";  
		$data = mysqli_query($conn, $sql); 
        if (!$data) { 
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
		$sqlQuery = "SELECT * FROM posts WHERE id = '$id'";
		$resultItem = mysqli_query($conn, $sqlQuery);
		$resultList = mysqli_fetch_all($resultItem, MYSQLI_ASSOC);
        http_response_code(200); 
		echo json_encode(
               [
                  "success" => true, 
                  "statusCode" => 200,
				  "data" => $resultList[0],
                  "message" => "Update post id " . $id . " successfully"
               ]
           ); 
	}