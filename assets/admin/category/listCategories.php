<?php
include("/xampp/htdocs/BeyondWords/assets/generalPHP/configureDB.php");
//Select categories from database
$select      = "SELECT * FROM `categories`";
$selectQuery = mysqli_query($connect, $select);

//Delete categories from database
if (isset($_GET["delete"])) {
    $deletedID   = $_GET["delete"];
    $delete      = "DELETE FROM `categories` WHERE id = $deletedID";
    $deleteQuery = mysqli_query($connect, $delete);
    header("location: listCategories.php");
}
include("/xampp/htdocs/BeyondWords/assets/admin/shared/adminHeader.php");
include("/xampp/htdocs/BeyondWords/assets/admin/shared/adminNav.php");

?> 


<div class="container mt-5 col-4">
  <h1 class="text-center mb-5">Categories</h1>
  <table class="table table-striped table-dark">
    <thead>
      <tr>
        <th class="text-center">ID</th>
        <th class="text-center">Name</th>
        <th colspan="2" class="text-center">Actions</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach($selectQuery as $selected){ ?>
      <tr>
        <td class="text-center">
          <?php echo $selected["id"]; ?>
        </td>
        <td class="text-center">
          <?php echo $selected["catName"]; ?>
        </td>
        <td class="text-center"><a name="delete" href="/BeyondWords/assets/admin/category/listCategories.php?delete=<?php echo$selected["id"]; ?>" class="btn btn-danger" onclick="return confirm('Would you like to delete category <?php echo addSlashes($selected['catName']); ?> with ID &rdquo;<?php echo $selected['id']; ?>&rdquo; (This action cannot be reversed)')">Delete</a></td>
        <td class="text-center"><a name="edit" href="/BeyondWords/assets/admin/category/addCategories.php?edit=<?php echo$selected["id"]; ?>" class="btn
            btn-info">Edit</a></td>
      </tr>
      <?php } ?>
    </tbody>
  </table>
</div>

<?php 
include("/xampp/htdocs/BeyondWords/assets/shared/footer.php");
?>