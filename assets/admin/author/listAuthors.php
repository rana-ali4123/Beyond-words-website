<?php
include("/xampp/htdocs/BeyondWords/assets/generalPHP/configureDB.php");

//Select categories from database
$select      = "SELECT * FROM `authors`";
$selectQuery = mysqli_query($connect, $select);

//Delete categories from database
if (isset($_GET["delete"])) {
    $deletedID   = $_GET["delete"];
    $delete      = "DELETE FROM `authors` WHERE id = $deletedID";
    $deleteQuery = mysqli_query($connect, $delete);
    header("location: listAuthors.php");
}
include("/xampp/htdocs/BeyondWords/assets/admin/shared/adminHeader.php");
include("/xampp/htdocs/BeyondWords/assets/admin/shared/adminNav.php");
?> 


<div class="container mt-5 col-8">
  <h1 class="text-center mb-5">Authors</h1>
  <table class="table table-striped table-dark">
    <thead>
      <tr>
        <th class="text-center">ID</th>
        <th class="text-center">Name</th>
        <th class="text-center">Image</th>
        <th class="text-center">Location</th>
        <th class="text-center">Birthdate</th>
        <th class="text-center">Description</th>
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
          <?php echo $selected["authorName"]; ?>
        </td>
        <td class="text-center">
        <img style="width: 100%;" src="<?php echo $selected["authorImage"]; ?>">
        </td>
        <td class="text-center">
          <?php echo $selected["location"]; ?>
        </td>
        <td class="text-center">
          <?php echo $selected["birthdate"]; ?>
        </td>
        <td class="text-center">
          <?php echo substr($selected["authorDesc"],0,100); echo "...";?>
        </td>
        <td class="text-center"><a name="delete" href="/BeyondWords/assets/admin/author/listAuthors.php?delete=<?php echo$selected["id"]; ?>"class="btn btn-danger" onclick="return confirm('Would you like to delete author <?php echo addSlashes($selected['authorName']); ?> with ID &rdquo;<?php echo $selected['id']; ?>&rdquo; (This action cannot be reversed)')">Delete</a></td>
        <td class="text-center"><a name="edit" href="/BeyondWords/assets/admin/author/addAuthors.php?edit=<?php echo$selected["id"]; ?>" class="btn
            btn-info">Edit</a></td>
      </tr>
      <?php } ?>
    </tbody>
  </table>
</div>


<?php 
include("/xampp/htdocs/BeyondWords/assets/shared/footer.php");
?>