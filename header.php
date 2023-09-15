<?php
    $connect = mysqli_connect("localhost", "root", "", "hng.users");

    if ($connect) {
        echo "Connected";
    } else {
        echo "Not connected";
    }
?>