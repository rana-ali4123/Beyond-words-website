<?php
if (basename($_SERVER['PHP_SELF']) == "login.php" || basename($_SERVER['PHP_SELF']) == "register.php" || basename($_SERVER['PHP_SELF']) == "index.php")
    return;
if (!isset($_SESSION["user"]))
    header("location: /BeyondWords/assets/user/login.php");
    
?> 