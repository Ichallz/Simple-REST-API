<?php
require "header.php";
$request_body = file_get_contents("php://input");
$data = json_decode($request_body);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (
        !empty($data->firstname)
        && !empty($data->lastname)
        && !empty($data->gender)
        && !empty($data->age)
    ) {
        $firstname = filter_var($data->firstname, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $lastname = filter_var($data->lastname, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $gender = filter_var($data->gender, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $age = filter_var($data->age, FILTER_SANITIZE_NUMBER_INT);

        $sql = "INSERT INTO students (firstname, lastname, gender, age)
                VALUES ('$firstname', '$lastname', '$gender', '$age')";
        $query = mysqli_query($connect, $sql);

        if ($query) {
            $response = ["status" => "success", "message" => "Registration Success"];
            echo json_encode($response);
            return;
        } else {
            $response = ["status" => "error", "message" => "Registration Failed"];
            echo json_encode($response);
            return;
        }
    } else {
        $response = ["status" => "error", "message" => "Please fill all the required fields"];
        echo json_encode($response);
        return;
    }
} else {
    $response = ["status" => "error", "message" => "Invalid request method"];
    echo json_encode($response);
    return;
}
?>