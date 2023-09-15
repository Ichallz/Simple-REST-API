<?php
require "header.php";

if ($_SERVER['REQUEST_METHOD'] === 'DELETE') {

    $request_body = file_get_contents("php://input");

    $data = json_decode($request_body);

    $id = array_key_exists('id', $_GET) ? $_GET['id'] : "";
    //$id = $data->id;

    if (empty($id)) {
        $response = ["status" => "error", "message" => "id is required"];

        echo json_encode($response);

        return;
    }

    $sql = " DELETE FROM students WHERE id = '$id' ";
    $query = mysqli_query($connect, $sql);

    if ($query) {

        $response = ["status" => "success", "message" => "Deleted Sucessfully"];

        echo json_encode($response);

        return;
    } else {

        $response = ["status" => "error", "message" => "Cannot delete student"];

        echo json_encode($response);

        return;
    }
} else {

    $response = ["status" => "error", "message" => "Invalid request method"];

    echo json_encode($response);

    return;
}
