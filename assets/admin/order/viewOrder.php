<?php
include("/xampp/htdocs/BeyondWords/assets/generalPHP/configureDB.php");

//Getting order details from database
if (isset($_GET["view"])) {
    $viewID      = $_GET["view"];
    $select      = "SELECT * FROM `ordersdetails` LEFT JOIN `books` on ordersdetails.ISBN = books.ISBN WHERE orderID = $viewID ";
    $selectQuery = mysqli_query($connect, $select);
}
include("/xampp/htdocs/BeyondWords/assets/admin/shared/adminHeader.php");
include("/xampp/htdocs/BeyondWords/assets/admin/shared/adminNav.php");
?> 

<div class="container mt-5 col-4">
  <h1 class="text-center mb-5">Order <?php echo $viewID; ?></h1>
  <table class="table table-striped table-dark">
    <thead>
      <tr>
        <th class="text-center">Book Name</th>
        <th class="text-center">Quantity</th>
        <th class="text-center">Unit Price</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach($selectQuery as $selected){ ?>
      <tr>
        <td class="text-center">
          <?php echo $selected["bookName"]; ?>
        </td>
        <td class="text-center">
          <?php echo $selected["quantity"]; ?>
        </td>
        <td class="text-center">
          <?php echo $selected["price"]; ?>
        </td>
      </tr>
      <?php } ?>
    </tbody>
  </table>
  <a href="/BeyondWords/assets/admin/order/orders.php" class="custom-button float-right col-3 text-center">Back</a>
</div>


<?php 
include("/xampp/htdocs/BeyondWords/assets/shared/footer.php");
?>