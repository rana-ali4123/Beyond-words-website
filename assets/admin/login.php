<?php
include("/xampp/htdocs/BeyondWords/assets/generalPHP/configureDB.php");
include("/xampp/htdocs/BeyondWords/assets/admin/shared/adminNav.php");

//Admin login
if (isset($_POST['login'])) {
    $adminName    = $_POST["adminName"];
    $password     = addSlashes($_POST["password"]);
    $select       = "SELECT * FROM `admins` WHERE adminName = '$adminName' and password = '$password'";
    $selectQuery  = mysqli_query($connect, $select);
    $numberOfRows = mysqli_num_rows($selectQuery);
    if ($numberOfRows > 0) {
        $_SESSION["admin"] = $adminName;
        print_r($_SESSION);
        $dir = isset($_GET['dir']) ? $_GET['dir'] : "/BeyondWords/assets/admin/adminHome.php"; //redirecting to the latest page if found
        header("location: $dir");
    } else {
        echo "<div class='container alert alert-danger col-6 text-center font-weight-bolder'>
        Wrong username or password
      </div>";
    }
}
include("/xampp/htdocs/BeyondWords/assets/admin/shared/adminHeader.php");
?>

<div class="container col-5 mt-5">
    <h1 class="text-center mb-5">Admin Login</h1>
  <form method="POST">
    <div class="form-group">
      <label for="adminName">Username:</label>
      <input type="text" class="form-control" name="adminName" id="adminName" required>
    </div>
    <div class="form-group">
      <label for="password">Password:</label>
      <input type="password" class="form-control" name="password" id="password" required>
    </div>
        <button type="submit" name="login" class="custom-button float-right col-3">Login</button>
  </form>
</div>


<?php 
include("/xampp/htdocs/BeyondWords/assets/shared/footer.php");
?>