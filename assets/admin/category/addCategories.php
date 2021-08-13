<?php
include("/xampp/htdocs/BeyondWords/assets/generalPHP/configureDB.php");

//Insert into database a new category
if (isset($_POST["add"])) {
    $catName     = addSlashes($_POST["catName"]);
    $insert      = "INSERT INTO `categories` VALUES (null, '$catName')";
    $insertQuery = mysqli_query($connect, $insert);
    header("location: listCategories.php");
}

//Editing a category in database
$catName = "";
$editing = false;
if (isset($_GET["edit"])) {
    $editing     = true;
    $editedID    = $_GET["edit"];
    $selectedID  = "SELECT * FROM `categories` WHERE id = $editedID";
    $selectQuery = mysqli_query($connect, $selectedID);
    $selectedRow = mysqli_fetch_assoc($selectQuery);
    $catName     = $selectedRow["catName"];
    if (isset($_POST["update"])) {
        $catName     = addSlashes($_POST["catName"]);
        $update      = "UPDATE `categories` SET catName ='$catName' WHERE id = $editedID";
        $updateQuery = mysqli_query($connect, $update);
        header("location: listCategories.php");
    }
}
include("/xampp/htdocs/BeyondWords/assets/admin/shared/adminHeader.php");
include("/xampp/htdocs/BeyondWords/assets/admin/shared/adminNav.php");
?> 

<div class="container col-4 mt-5">
    <?php if($editing) : ?>
        <h1 class="text-center mb-5">Edit an existing category</h1>
    <?php else : ?>
        <h1 class="text-center mb-5">Add a new category</h1>
    <?php endif; ?>
  <form method="POST">
    <div class="form-group">
      <label for="catName">Category Name:</label>
      <input type="text" class="form-control mt-2" value="<?php echo $catName;?>" name="catName" id="catName" required>
    </div>
    <?php if($editing) : ?>
        <button type="submit" name="update" class="custom-button float-right col-3">Edit</button>
        <a href="/BeyondWords/assets/admin/category/listCategories.php" class="custom-button float-right col-3 text-center">Back</a>
    <?php else : ?>
        <button type="submit" name="add" class="custom-button float-right col-3">Add</button>
    <?php endif; ?>
  </form>
</div>

<?php 
include("/xampp/htdocs/BeyondWords/assets/shared/footer.php");
?>