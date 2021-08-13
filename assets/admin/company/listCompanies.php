<?php
include("/xampp/htdocs/BeyondWords/assets/generalPHP/configureDB.php");

//Select categories from database
$select      = "SELECT * FROM `deliverycompanies`";
$selectQuery = mysqli_query($connect, $select);

//Delete categories from database
if (isset($_GET["delete"])) {
    $deletedID   = $_GET["delete"];
    $delete      = "DELETE FROM `deliverycompanies` WHERE id = $deletedID";
    $deleteQuery = mysqli_query($connect, $delete);
    header("location: listCompanies.php");
}
include("/xampp/htdocs/BeyondWords/assets/admin/shared/adminHeader.php");
include("/xampp/htdocs/BeyondWords/assets/admin/shared/adminNav.php");
?> 


<div class="container mt-5 col-4">
  <h1 class="text-center mb-5">Delivery Companies</h1>
  <table class="table table-striped table-dark">
    <thead>
      <tr>
        <th class="text-center">ID</th>
        <th class="text-center">Company Name</th>
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
          <?php echo $selected["companyName"]; ?>
        </td>
        <td class="text-center"><a name="delete" href="/BeyondWords/assets/admin/company/listCompanies.php?delete=<?php echo$selected["id"]; ?>"class="btn btn-danger" onclick="return confirm('Would you like to delete company <?php echo addSlashes($selected['companyName']); ?> with ID &rdquo;<?php echo $selected['id']; ?>&rdquo;? (This action cannot be reversed)')">Delete</a></td>
        <td class="text-center"><a name="edit" href="/BeyondWords/assets/admin/company/addCompany.php?edit=<?php echo$selected["id"]; ?>" class="btn
            btn-info">Edit</a></td>
      </tr>
      <?php } ?>
    </tbody>
  </table>
</div>

<?php 
include("/xampp/htdocs/BeyondWords/assets/shared/footer.php");
?>