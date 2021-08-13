<?php
include("/xampp/htdocs/BeyondWords/assets/generalPHP/configureDB.php");

//Insert into database a new category
if (isset($_POST["add"])) {
    $adminName     = $_POST["adminName"];
    $adminPassword = addSlashes($_POST["adminPassword"]);
    $insert      = "INSERT INTO `admins` VALUES (null, '$adminName', '$adminPassword')";
    $insertQuery = mysqli_query($connect, $insert);
    header("location: listAdmins.php");
}
include("/xampp/htdocs/BeyondWords/assets/admin/shared/adminHeader.php");
include("/xampp/htdocs/BeyondWords/assets/admin/shared/adminNav.php");
?> 

<div class="container col-4 mt-5">
        <h1 class="text-center mb-5">Add a new admin account</h1>
  <form method="POST">
    <div class="form-group">
      <label for="adminName">New Admin Account Name:</label>
      <input type="text" class="form-control mt-2" name="adminName" id="adminName" required>
    </div>
    <div class="form-group">
      <label for="adminPassword">New Admin Account Password:</label>
      <input type="password" class="form-control mt-2" name="adminPassword" id="adminPassword" required>
    </div>
        <button type="submit" name="add" class="custom-button float-right col-3">Add</button>
  </form>
</div>

<?php 
include("/xampp/htdocs/BeyondWords/assets/shared/footer.php");
?>