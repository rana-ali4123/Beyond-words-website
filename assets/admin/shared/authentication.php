<?php

$direction = $_SERVER['PHP_SELF']; //Getting latest direction the user was in/trying to access
if (basename($_SERVER['PHP_SELF']) == "login.php")
    return;
if (!isset($_SESSION["admin"])) //Checking if the user is logged in as an admin or not
    header("location: /BeyondWords/assets/admin/login.php?dir=$direction");

?> 