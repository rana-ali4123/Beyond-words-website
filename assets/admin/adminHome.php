<?php
include("/xampp/htdocs/BeyondWords/assets/generalPHP/configureDB.php");

include("/xampp/htdocs/BeyondWords/assets/admin/shared/adminHeader.php");
include("/xampp/htdocs/BeyondWords/assets/admin/shared/adminNav.php");
?>
<h1 class="text-center">Admin Panel Home Page</h1>
<h2 class="text-center">Welcome, <?php $loggedAdmin = $_SESSION["admin"]; echo $loggedAdmin; ?></h2>
<?php
include("/xampp/htdocs/BeyondWords/assets/shared/footer.php");
?>