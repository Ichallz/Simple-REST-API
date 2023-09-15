<?php
require "header.php";

if ($_SERVER['REQUEST_METHOD'] === 'PUT') {


    $request_body = file_get_contents("php://input");
    $data = json_decode($request_body);

    if (empty($data)) {

        $response = ["status" => "error", "message" => "data field required"];

        echo json_encode($response);

        return;
    }

    if (!property_exists($data, 'id')) {

        $response = ["status" => "error", "message" => "id is required"];

        echo json_encode($response);

        return;
    }

    $query = "UPDATE students  SET";

    $updates = [];

    if (property_exists($data, 'firstname')) {
        $updates[]= " firstname = '" . $data->firstname."'";
    }

    if (property_exists($data, 'lastname')) {
        $updates[]= " lastname ='" . $data->lastname."'";
    }

    if (property_exists($data, 'gender')) {
        $updates[]= " gender = '" . $data->gender."'";
    }

    if (property_exists($data, 'age')) {
        $updates[]= " age = " . $data->age;
    }
    $query .= implode(", ", $updates);

    $query .= ' WHERE id = ' . $data->id;


    $req = mysqli_query($connect, $query);


    $sql = "SELECT * FROM students WHERE id = $data->id";

    $query = mysqli_query($connect, $sql);

    $row = mysqli_fetch_assoc($query);

    $response = ["status" => "success", "message" => $row];

    echo json_encode($response);

    return;
} else {

    $response = ["status" => "error", "message" => "Invalid request method"];

    echo json_encode($response);

    return;
}
