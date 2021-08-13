 <?php
include("/xampp/htdocs/BeyondWords/assets/generalPHP/configureDB.php");

//Insert into database a new author
if (isset($_POST["add"])) {
    $authorName  = addSlashes($_POST["authorName"]);
    $authorImage = $_POST["authorImage"];
    $location    = $_POST["location"];
    $birthdate   = $_POST["birthdate"];
    $authorDesc  = addSlashes($_POST["authorDesc"]);
    if($authorImage == null){$authorImage = 'https://s.gr-assets.com/assets/nophoto/user/m_200x266-d279b33f8eec0f27b7272477f09806be.png';}
    $insert      = "INSERT INTO `authors` VALUES (null, '$authorName', '$location', '$birthdate', '$authorImage', '$authorDesc')";
    $insertQuery = mysqli_query($connect, $insert);
    header("location: listAuthors.php");
}

//Editing an author in database
$authorName  = "";
$authorImage = "";
$location    = "";
$birthdate   = "";
$authorDesc  = "";
$editing     = false;
if (isset($_GET["edit"])) {
    $editing     = true;
    $editedID    = $_GET["edit"];
    $selectedID  = "SELECT * FROM `authors` WHERE id = $editedID";
    $selectQuery = mysqli_query($connect, $selectedID);
    $selectedRow = mysqli_fetch_assoc($selectQuery);
    $authorName  = $selectedRow["authorName"];
    $location    = $selectedRow["location"];
    $birthdate   = $selectedRow["birthdate"];
    $authorImage = $selectedRow["authorImage"];
    $authorDesc  = $selectedRow["authorDesc"];
    if (isset($_POST["update"])) {
        $authorName  = addSlashes($_POST["authorName"]);
        $authorImage = $_POST["authorImage"];
        $location    = $_POST["location"];
        $birthdate   = $_POST["birthdate"];
        $authorDesc  = addSlashes($_POST["authorDesc"]);
        $update      = "UPDATE `authors` SET authorName ='$authorName', location = '$location', birthdate = '$birthdate', authorImage = '$authorImage', authorDesc = '$authorDesc' WHERE id = $editedID";
        $updateQuery = mysqli_query($connect, $update);
        header("location: listAuthors.php");
    }
    
}
include("/xampp/htdocs/BeyondWords/assets/admin/shared/adminHeader.php");
include("/xampp/htdocs/BeyondWords/assets/admin/shared/adminNav.php");
?> 

<div class="container col-4 mt-5">
    <?php if($editing) : ?>
        <h1 class="text-center mb-5">Edit an existing author</h1>
    <?php else : ?>
        <h1 class="text-center mb-5">Add a new author</h1>
    <?php endif; ?>
  <form method="POST">
    <div class="form-group">
      <label for="authorName">Author Name:</label>
      <input type="text" class="form-control mt-2" value="<?php echo $authorName;?>" name="authorName" id="authorName" required>
    </div>
    <div class="form-group">
      <label for="location">Location:</label>
      <input type="text" class="form-control mt-2" value="<?php echo $location;?>" name="location" id="location">
    </div>
    <div class="form-group">
      <label for="birthdate">Birthdate:</label>
      <input type="text" class="form-control mt-2" value="<?php echo $birthdate;?>" name="birthdate" id="birthdate">
    </div>
    <div class="form-group">
      <label for="authorImage">Image Link:</label>
      <input type="text" class="form-control mt-2" value="<?php echo $authorImage;?>" name="authorImage" id="authorImage">
    </div>
    <div class="form-group">
      <label for="authorDesc">Author Description:</label>
      <textarea class="form-control mt-2" id="authorDesc" name="authorDesc" cols="50" rows="10" required><?php echo $authorDesc;?></textarea>
    </div>
    <?php if($editing) : ?>
        <button type="submit" name="update" class="custom-button float-right col-3">Edit</button>
        <a href="/BeyondWords/assets/admin/author/listAuthors.php" class="custom-button float-right col-3 text-center">Back</a>
    <?php else : ?>
        <button type="submit" name="add" class="custom-button float-right col-3">Add</button>
    <?php endif; ?>
  </form>
</div>


<?php 
include("/xampp/htdocs/BeyondWords/assets/shared/footer.php");
?>