<?php
session_start();
include("/xampp/htdocs/BeyondWords/assets/generalPHP/authentication.php");

//Clearing current sessions and logging out
if (isset($_POST["logout"])) {
    session_unset();
    session_destroy();
    header("location: /BeyondWords/assets/user/login.php");
}

//Creating a cart object which takes items in it
class cartObject
{
    public $bookName;
    public $ISBN;
    public $price;
    public $image;
    public $quantity;
    
    function __construct($bookName, $ISBN, $price, $image, $quantity)
    {
        $this->bookName = $bookName;
        $this->ISBN     = $ISBN;
        $this->price    = $price;
        $this->image    = $image;
        $this->quantity = $quantity;
    }
};

//Creating a search among books function
if (isset($_GET["search"])) {
    $searched = addSlashes($_GET["searched"]);
    header("location: /BeyondWords/assets/book/searchBooks.php?searched=" . $searched);
}

//Select all current categories
$selectCategories = "SELECT * FROM categories";
$selectCatsQuery = mysqli_query($connect, $selectCategories);

//Select all current authors
$selectAuthors = "SELECT * FROM authors";
$selectAuthorsQuery = mysqli_query($connect, $selectAuthors);
?> 

<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <div class="container-fluid">
    <a class="navbar-brand" href="/BeyondWords/"><img style="height:auto; width: auto; max-height: 70px; max-width: 150px;" src="/BeyondWords/assets/shared/logo.png" alt=""></a>
    <?php if(isset($_SESSION["user"])) : ?>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link" aria-current="page" href="/beyondwords/">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" aria-current="page" href="/BeyondWords/assets/book/availableBooks.php">Available Books</a>
        </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Categories
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
        <?php foreach($selectCatsQuery as $selected) { ?>
          <a class="dropdown-item" href="/BeyondWords/assets/category/categories.php?category=<?php echo $selected["id"]; ?>"><?php echo $selected["catName"]; ?></a>
          <?php } ?>
        </div>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Authors
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
        <?php $i = 0; $limit = 4; foreach($selectAuthorsQuery as $selected) { $i++; ?>
          <a class="dropdown-item" href="/BeyondWords/assets/author/author.php?author=<?php echo $selected["id"]; ?>"><?php echo $selected["authorName"]; ?></a>
          <?php if($i == $limit){break;} } ?>
          <a class="dropdown-item" href="/BeyondWords/assets/author/viewAuthors.php">View All Authors</a>
        </div>
      </li>
      <li class="nav-item">
          <a class="nav-link" aria-current="page" href="/beyondwords/assets/user/feedback.php">Feedback</a>
        </li>
      </ul>
      <form class="d-flex">
        <input class="form-control ml-2" type="search" name="searched" placeholder="Search available books" aria-label="Search">
        <button class="btn btn-outline-success customButton ml-2" name="search" style="border-color:black; color: black;" type="submit">Search</button>
      </form>
      <ul class="nav navbar-nav ml-auto">
      <li class="nav-item dropdown mr-3">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          My Account
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="/BeyondWords/assets/book/cart.php"><i class="fas fa-cart-arrow-down mr-2"></i>My Cart</a>
          <a class="dropdown-item" href="/BeyondWords/assets/user/orders.php"><i class="fas fa-clipboard-list mr-2"></i>My Orders</a>
        </div>
      </li>
               <form method="POST"> <li><button class="btn btn-danger" name="logout">Log Out <i class="fas fa-sign-out-alt"></i></button></li></form>
                <?php else : ?>
                <ul id="navbar-left" class="nav navbar-nav ml-auto">
                <li class="mx-3"><a href="/BeyondWords/assets/user/register.php">Register <i class="fa fa-user-plus"></i></a></li>
                <li><a href="/BeyondWords/assets/user/login.php">Log In <i class="far fa-user"></i></a></li>
                <?php endif; ?>
            </ul>
    </div>
  </div>
</nav>