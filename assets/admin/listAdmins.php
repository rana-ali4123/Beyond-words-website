<?php
include("/xampp/htdocs/BeyondWords/assets/generalPHP/configureDB.php");


include("/xampp/htdocs/BeyondWords/assets/admin/shared/adminHeader.php");
include("/xampp/htdocs/BeyondWords/assets/admin/shared/adminNav.php");

//Select categories from database
$select      = "SELECT * FROM `admins`";
$selectQuery = mysqli_query($connect, $select);
?> 


<div class="container mt-5 col-3">
  <h1 class="text-center mb-5">Admin Accounts</h1>
  <table class="table table-striped table-dark">
    <thead>
      <tr>
        <th class="text-center">ID</th>
        <th class="text-center">Name</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach($selectQuery as $selected){ ?>
      <tr>
        <td class="text-center">
          <?php echo $selected["id"]; ?>
        </td>
        <td class="text-center">
          <?php echo $selected["adminName"]; ?>
        </td>
      </tr>
      <?php } ?>
    </tbody>
  </table>
</div>

<?php 
include("/xampp/htdocs/BeyondWords/assets/shared/footer.php");
?>