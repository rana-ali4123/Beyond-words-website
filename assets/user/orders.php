<?php
include("/xampp/htdocs/BeyondWords/assets/generalPHP/configureDB.php");
include("/xampp/htdocs/BeyondWords/assets/shared/header.php");
include("/xampp/htdocs/BeyondWords/assets/shared/nav.php");

//Getting orders from database
$email       = $_SESSION["user"];
$selectUser  = "SELECT * FROM `users` WHERE email = '$email'";
$userQuery   = mysqli_query($connect, $selectUser);
$userRow     = mysqli_fetch_assoc($userQuery);
$userID      = $userRow["id"];
$select      = "SELECT * FROM `orders` LEFT JOIN `deliverycompanies` ON orders.deliveryCompany = deliverycompanies.id LEFT JOIN `users` ON orders.userID = users.id WHERE userID = $userID";
$selectQuery = mysqli_query($connect, $select);
?> 

<div class="container mt-5 col-7">
  <h1 class="text-center mb-5">My Orders</h1>
  <table class="table table-striped table-dark">
    <thead>
      <tr>
        <th class="text-center">ID</th>
        <th class="text-center">Delivery Company</th>
        <th class="text-center">Date</th>
        <th class="text-center">Address</th>
        <th class="text-center">Total price</th>
        <th class="text-center">Actions</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach($selectQuery as $selected){ ?>
      <tr>
        <td class="text-center">
          <?php echo $selected["orderID"]; ?>
        </td>
        <td class="text-center">
          <?php echo $selected["companyName"]; ?>
        </td>
        <td class="text-center">
          <?php echo $selected["date"]; ?>
        </td>
        <td class="text-center">
          <?php echo $selected["address"]; ?>
        </td>
        <td class="text-center">
          <?php echo $selected["total"]; ?>
        </td>
        <td class="text-center"><a name="view" href="/BeyondWords/assets/user/viewOrder.php?view=<?php echo $selected["orderID"]; ?>" class="btn btn-info">View</a></td>
      </tr>
      <?php } ?>
    </tbody>
  </table>
</div>  

<?php
include("/xampp/htdocs/BeyondWords/assets/shared/footer.php");
?>