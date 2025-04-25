
<?php

    @include '../Connection/config.php';

    $name = $_POST["name"];
    $email = $_POST["email"];
    $subject = $_POST["subject"];
    $mssg = $_POST["message"];

    $mysql = "INSERT INTO contact_us (name, email, subject, message) VALUES ('$name', '$email', '$subject', '$mssg')";

    $status = mysqli_query($con, $mysql);

    if ($status) {
        echo '<script> alert("Message successfully sent. We will reply to you as soon as possible. Thank you! "); window.location.assign("./contact_page.html");</script>';
    } else {
        echo "Your data failed to enter the database";
    }
?> 

