<?php

@include '../Connection/config.php';

session_start();
session_unset();
session_destroy();

echo '<script> alert("You have logged out! (Session Ended)"); window.location.assign("../index.html");</script>';

?>