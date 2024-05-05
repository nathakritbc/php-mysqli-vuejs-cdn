<?php 
	header("Access-Control-Allow-Origin: *"); 
	header("Content-Type: application/json; charset=UTF-8"); 
	header("Access-Control-Allow-Methods: OPTIONS,GET,POST,PUT,DELETE"); 
	header("Access-Control-Max-Age: 3600"); 
	header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
	include '../../db/connectDB.php';  
	$requestMethod = $_SERVER["REQUEST_METHOD"]; 
	if($requestMethod == 'GET'){ 
        $sql = "SELECT * FROM posts ORDER BY id DESC";
		if(isset($_GET['id'])){ 
			$id = $_GET['id']; 
			$sql = "SELECT * FROM posts WHERE id = $id"; 
		}  
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
		$listData =[];
		while ($item = mysqli_fetch_assoc($result)) { 
			 $listData[] = $item;
		} 
        http_response_code(200);
		echo json_encode($listData,JSON_NUMERIC_CHECK);
	}