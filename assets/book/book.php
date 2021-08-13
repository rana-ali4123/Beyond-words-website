<?php
include("/xampp/htdocs/BeyondWords/assets/generalPHP/configureDB.php");
include("/xampp/htdocs/BeyondWords/assets/shared/header.php");
include("/xampp/htdocs/BeyondWords/assets/shared/nav.php");
//Getting the book ISBN
if (isset($_GET["ISBN"])) {
    $ISBN        = $_GET["ISBN"];
    $select      = "SELECT *, authors.id AS authID FROM `books` LEFT JOIN `authors` ON books.author = authors.id LEFT JOIN `categories` ON books.category = categories.id WHERE ISBN = $ISBN";
    $selectQuery = mysqli_query($connect, $select);
    $bookRow     = mysqli_fetch_assoc($selectQuery);
}

//Adding the item to the cart session
if (isset($_POST["addCart"])) {
    $ISBN     = $_GET["ISBN"];
    $cart     = $_SESSION["cart"];
    $quantity = $_POST["quantity"];
    $isFound  = false;
    foreach ($cart as $item) {
        if ($item->ISBN == $ISBN) {
            if ($item->quantity < $bookRow["stock"] - 1) {
                $item->quantity = $item->quantity + $quantity;
            } else {
                // NOTIFY USER HE CAN'T ORDER MORE THAN WHAT IS ALREADY IN STOCK
                echo '<div class=" container alert alert-danger alert-dismissible fade show" role="danger">
        You are trying to add items to your cart more than what is available in stock.
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>';
            }
            $isFound = true;
            break;
        }
    }
    //If item is in stock, push (add) it into the array session cart
    if (!$isFound) {
        if ($bookRow["stock"] > 0) {
            $newItem = new cartObject($bookRow["bookName"], $bookRow["ISBN"], $bookRow["price"], $bookRow["image"], $quantity);
            array_push($cart, $newItem);
            $_SESSION["cart"] = $cart;
            echo '<div class=" container alert alert-success alert-dismissible fade show" role="success">
        Added to your cart successfully.
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>';
        }
    }
    // print_r($_SESSION["cart"]);
    // echo '123';
}
?> 

<link rel="stylesheet" href="style.css">

<div class="container mt-3">
  <div class="row">

    <div class="col-3">
    <div class="coverContainer m-auto">
      <img class="bookPicture" src="<?php echo $bookRow["image"]; ?>" />
    </div>
      <div class="mt-2">
            <p class="text-center"> <span class="bolderInfo">Author:</span> <a href="/BeyondWords/assets/author/author.php?author=<?php echo $bookRow["authID"]; ?>"><?php echo $bookRow["authorName"]; ?></a></p>
            <p class="text-center"><span class="bolderInfo">Price:</span> <?php echo $bookRow["price"]; ?> L.E</p>
            <p class="text-center"><span class="bolderInfo">Stock:</span><?php if($bookRow["stock"] > 0) { ?> <span class="inStock"><?php echo $bookRow["stock"]; ?> </span> <?php } else echo " <span class='outOfStock'>Out of Stock</span>"; ?></p>
            <div class="mb-3">
            <?php if($bookRow["stock"] > 0) : ?>
              <form method="POST">
            <select class="m-auto text-center d-block" name="quantity" id="quantity" required>
              <option selected hidden disabled></option>
              <?php for($stock = 1; $stock <= $bookRow["stock"]; $stock++){ ?>
                <option value="<?php echo $stock; ?>"><?php echo $stock; ?></option>
                <?php } ?>
            </select>
            </div>
            <div class="addCartButton">
            <button class="m-auto d-flex btn btn-outline-success cartButton" name="addCart"><i class="fas fa-cart-plus m-auto"></i><span class="ml-2">Add to Cart</span></button></form>
            <?php else : ?>
            <button disabled="disabled" class="m-auto d-flex btn btn-danger cartButton"><i class="far fa-frown m-auto"></i><span class="ml-2">Out of Stock</span></button>
            <?php endif; ?>
          </div>
      </div>
    </div>
    <div class="col">
    <h1><?php echo $bookRow["bookName"]; ?></h1>
    <p class="bookDescription"><?php echo $bookRow["bookDesc"]; ?></p>

  <?php include("/xampp/htdocs/BeyondWords/assets/shared/footer.php"); ?>
