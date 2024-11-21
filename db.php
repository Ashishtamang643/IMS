<?php
    $conn = mysqli_connect("localhost", "root", "", "original_ims");
    if (mysqli_connect_errno()) {
        echo '<script>console.log("Something went Wrong!");</script>';

    } else {
        echo '<script>console.log("Database connected successfully");</script>';
    }
?>
