<?php
include("/xampp/htdocs/BeyondWords/assets/generalPHP/configureDB.php");

//Insert into database a new company
if (isset($_POST["add"])) {
    $companyName = addSlashes($_POST["compName"]);
    $insert      = "INSERT INTO `deliverycompanies` VALUES (null, '$companyName')";
    $insertQuery = mysqli_query($connect, $insert);
    header("location: listCompanies.php");
}

//Editing a company in database
$companyName = "";
$editing     = false;
if (isset($_GET["edit"])) {
    $editing     = true;
    $editedID    = $_GET["edit"];
    $selectedID  = "SELECT * FROM `deliverycompanies` WHERE id = $editedID";
    $selectQuery = mysqli_query($connect, $selectedID);
    $selectedRow = mysqli_fetch_assoc($selectQuery);
    $companyName = $selectedRow["companyName"];
    if (isset($_POST["update"])) {
        $companyName = addSlashes($_POST["compName"]);
        $update      = "UPDATE `deliverycompanies` SET companyName ='$companyName' WHERE id = $editedID";
        $updateQuery = mysqli_query($connect, $update);
        header("location: listCompanies.php");
    }
    
}
include("/xampp/htdocs/BeyondWords/assets/admin/shared/adminHeader.php");
include("/xampp/htdocs/BeyondWords/assets/admin/shared/adminNav.php");
?> 

<div class="container col-4 mt-5">
    <?php if($editing) : ?>
        <h1 class="text-center mb-5">Edit an existing delivery company</h1>
    <?php else : ?>
        <h1 class="text-center mb-5">Add a new delivery company</h1>
    <?php endif; ?>
  <form method="POST">
    <div class="form-group">
      <label for="compName">Company Name:</label>
      <input type="text" class="form-control mt-2" value="<?php echo $companyName;?>" name="compName" id="compName" required>
    </div>
    <?php if($editing) : ?>
        <button type="submit" name="update" class="custom-button float-right col-3">Edit</button>
        <a href="/BeyondWords/assets/admin/company/listCompanies.php" class="custom-button float-right col-3 text-center">Back</a>
    <?php else : ?>
        <button type="submit" name="add" class="custom-button float-right col-3">Add</button>
    <?php endif; ?>
  </form>
</div>

<?php 
include("/xampp/htdocs/BeyondWords/assets/shared/footer.php");
?>