<?php
    require "header.php";
    $request_body = file_get_contents("php://input");
    $data = json_encode($request_body);
    
    $id = $_GET['id'];
    
    if($_SERVER['REQUEST_METHOD'] ==='GET'){
    
    $sql = "SELECT * FROM students WHERE id = $id ";
    
    $query = mysqli_query($connect, $sql);
    
    if(mysqli_num_rows($query) > 0){
    
    while($row = mysqli_fetch_array($query)){
        $view_json["id"] = $row["id"];
      $view_json["firstname"] = $row["firstname"];
      $view_json["lastname"] = $row["lastname"];
      $view_json["gender"] = $row["gender"];
      $view_json["age"] = $row["age"];

      $response = ["status"=>"success","student_details"=>$std_details];
      echo json_encode($response);
      return;
    }
    }else{
    
        $response = ["message"=>"Cannot retrieve students details"];
        echo json_encode($response);
         return;
    }
    
    }else{
      $response = ["status"=>"error","message"=>"Invalid request method"];
      echo json_encode($response);
      return;
    }
?>