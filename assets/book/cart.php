<?php
include("/xampp/htdocs/BeyondWords/assets/generalPHP/configureDB.php");
include("/xampp/htdocs/BeyondWords/assets/shared/header.php");
include("/xampp/htdocs/BeyondWords/assets/shared/nav.php");


$totalPrice      = 0; //Setting total price to 0 when the page is first open if no items are in the cart
//Getting current logged in user info
$userEmail       = $_SESSION['user'];
$select          = "SELECT * FROM `users` WHERE email = '$userEmail'";
$selectQuery     = mysqli_query($connect, $select);
$selectedRow     = mysqli_fetch_assoc($selectQuery);
//Select current available delivery companies from database
$selectCompanies = "SELECT * FROM `deliverycompanies`";
$companiesQuery  = mysqli_query($connect, $selectCompanies);

//Purchase button functionality
if (isset($_POST['purchase'])) {
    
    $userID          = $selectedRow["id"];
    $address         = $_POST["address"];
    $deliveryCompany = $_POST["deliveryCompany"];
    $date            = date('Y-m-d h:i:s');
    $totalPrice      = $_POST["totalPrice"];
    if($totalPrice > 0){
    $query2    = "INSERT INTO `orders` VALUES(null, $deliveryCompany, '$date', $userID, '$address', $totalPrice)";
    $runQuery2 = mysqli_query($connect, $query2);
    //Looping in the cart items to fetch them
    foreach ($_SESSION['cart'] as $item) {
        
        $query3    = "SELECT @@IDENTITY"; //The "@@Identity" is used to get the last inserted ID in the database
        $runQuery3 = mysqli_query($connect, $query3);
        $result3   = mysqli_fetch_assoc($runQuery3);
        
        $temp      = $result3["@@IDENTITY"];
        //Inserting the order details to database
        $query4    = "INSERT INTO `ordersdetails` VALUES($temp, $item->ISBN, $item->quantity)";
        $runQuery4 = mysqli_query($connect, $query4);
        
        $query0      = "SELECT stock FROM books WHERE ISBN = $item->ISBN";
        $runQuery1   = mysqli_query($connect, $query0);
        $result0     = mysqli_fetch_assoc($runQuery1);
        $newQuantity = $result0["stock"] - $item->quantity;
        //Updating items stock with the new available quantity (current books - purchased books)
        $query       = "UPDATE books set stock = $newQuantity  where ISBN = $item->ISBN ";
        $runquery    = mysqli_query($connect, $query);
    }
    
    $_SESSION["cart"] = array();
    echo '<div class=" container alert alert-success alert-dismissible fade show" role="success">
        Purchase completed successfully.
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>';
    $totalPrice = 0;
  }
}
?> 

<div class="container mt-5">
    <table class="table">
      <thead>
        <tr>
          <th scope="col">#</th>
          <th scope="col">Image</th>
          <th scope="col">Book Name</th>
          <th scope="col">Quantity</th>
          <th scope="col">Unit Price</th>
        </tr>
      </thead>
      <tbody>
        <?php if(!empty($_SESSION["cart"])) foreach($_SESSION['cart'] as $key => $item ) { ?>
        <tr>
          <td scope="row"><?php echo $key+1; ?></td>
          <td><img style="height: 15vh; width: 5vw;" src="<?php echo $item->image; ?>"></td>
          <td><?php echo $item->bookName; ?></td>
          <td><?php echo $item->quantity; ?></td>
          <td><?php echo $item->price; ?></td>
          <?php $totalPrice +=$item->price * $item->quantity; ?>
        </tr>
         <?php
            }
         ?>
         <form method="post">
         <tr>
         <td>Total</td>
         <td></td>
         <td></td>
         <td></td>
         <td><strong><?php echo $totalPrice; ?> L.E</strong></td>
         </tr>
              
         <tr>
         <td>Address</td>
         <td><select class="col-8" name="address" id="address" required>
         <option value="" selected hidden disabled></option>
         <option value="<?php echo $selectedRow["address"] ?>"><?php echo $selectedRow["address"]; ?></option>
         <option value="<?php echo $selectedRow["altAddress"] ?>"><?php echo $selectedRow["altAddress"]; ?></option>
         </select></td> <!-- select address from database -->
         </tr>

         <tr>
         <td>Delivery</td>
         <td><select class="col-8" name="deliveryCompany" id="deliveryCompany" required>
         <option value="" selected hidden disabled></option>
         <?php foreach($companiesQuery as $company) { ?>
          <option value="<?php echo $company["id"]; ?>"><?php echo $company["companyName"] ?></option>
          <?php } ?>
         </select></td> <!-- select delivery company from database -->
         </tr>
      </tbody>
    </table>

    <input type="hidden" name="totalPrice" value="<?php echo $totalPrice; ?>">
    <button type='submit' class="float-right btn btn-success col-2" name='purchase'>Purchase</button>
    </form>
</div>




<?php 
include("/xampp/htdocs/BeyondWords/assets/shared/footer.php");
?>