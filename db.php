<?php
    $conn = mysqli_connect("localhost", "root", "", "ims");
    if (mysqli_connect_errno()) {
        echo '<script>console.log("Something went Wrong!");</script>';

    } else {
        echo '<script>console.log("Database connected successfully");</script>';
    }
?>
