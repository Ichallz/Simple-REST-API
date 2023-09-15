<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
    include "header.php";
    ?>
    <p>Welcome!</p>

    <?php
        $insert_data = mysqli_query($connect, "INSERT INTO students (firstname,lastname,gender,age)VALUES('Goldie','Daniel','Female','22')");

        if ($insert_data) {
            echo "Data saved successfully";
        }
    ?>
</body>
</html>