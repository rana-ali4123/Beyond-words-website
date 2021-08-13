<?php
include("/xampp/htdocs/BeyondWords/assets/generalPHP/configureDB.php");

//Getting orders from database
$select      = "SELECT * FROM `orders` LEFT JOIN `deliverycompanies` ON orders.deliveryCompany = deliverycompanies.id LEFT JOIN `users` ON orders.userID = users.id";
$selectQuery = mysqli_query($connect, $select);

//Delete orders from database
if (isset($_GET["delete"])) {
    $deletedID   = $_GET["delete"];
    $delete      = "DELETE `orders`, `ordersdetails` FROM orders  INNER JOIN ordersdetails WHERE orders.orderID = ordersdetails.orderID and orders.orderID = $deletedID";
    $deleteQuery = mysqli_query($connect, $delete);
    header("location: orders.php");
}
include("/xampp/htdocs/BeyondWords/assets/admin/shared/adminHeader.php");
include("/xampp/htdocs/BeyondWords/assets/admin/shared/adminNav.php");
?> 

<div class="container mt-5 col-8">
  <h1 class="text-center mb-5">On-going orders</h1>
  <table class="table table-striped table-dark">
    <thead>
      <tr>
        <th class="text-center">ID</th>
        <th class="text-center">Delivery Company</th>
        <th class="text-center">Date</th>
        <th class="text-center">Ordered By</th>
        <th class="text-center">Phone</th>
        <th class="text-center">Address</th>
        <th class="text-center">Total price</th>
        <th colspan="2" class="text-center">Actions</th>
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
          <?php echo $selected["userName"]; ?>
        </td>
        <td class="text-center">
          +20<?php echo $selected["phone"]; ?>
        </td>
        <td class="text-center">
          <?php echo $selected["address"]; ?>
        </td>
        <td class="text-center">
          <?php echo $selected["total"]; ?>
        </td>
        <td class="text-center"><a name="delete" href="/BeyondWords/assets/admin/order/orders.php?delete=<?php echo$selected["orderID"]; ?>"class="btn btn-danger" onclick="return confirm('Would you like to delete order number &rdquo;<?php echo $selected['id']; ?>&rdquo; by <?php echo $selected['userName']; ?>? (This action cannot be reversed)')">Delete</a></td>
        <td class="text-center"><a name="view" href="/BeyondWords/assets/admin/order/viewOrder.php?view=<?php echo$selected["orderID"]; ?>" class="btn btn-info">View</a></td>
      </tr>
      <?php } ?>
    </tbody>
  </table>
</div>

<?php
include("/xampp/htdocs/BeyondWords/assets/shared/footer.php");
?>