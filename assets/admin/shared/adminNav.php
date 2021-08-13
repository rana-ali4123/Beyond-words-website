<?php 
session_start();
include("/xampp/htdocs/BeyondWords/assets/admin/shared/authentication.php");


//Logout
if(isset($_POST["logout"])){
  session_unset();
  session_destroy();
  header("location: /BeyondWords/");
}
?>

<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <a class="navbar-brand" href="/BeyondWords/assets/admin/adminHome.php">Admin Panel</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <?php if(isset($_SESSION["admin"])) { ?>
  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item">
        <a class="nav-link" href="/BeyondWords/assets/admin/adminHome.php">Home</a>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Books
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="/BeyondWords/assets/admin/book/addBooks.php">Add Books</a>
          <a class="dropdown-item" href="/BeyondWords/assets/admin/book/listBooks.php">List Books</a>
        </div>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Authors
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="/BeyondWords/assets/admin/author/addAuthors.php">Add Authors</a>
          <a class="dropdown-item" href="/BeyondWords/assets/admin/author/listAuthors.php">List Authors</a>
        </div>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Categories
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="/BeyondWords/assets/admin/category/addCategories.php">Add Categories</a>
          <a class="dropdown-item" href="/BeyondWords/assets/admin/category/listCategories.php">List Categories</a>
        </div>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Companies
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="/BeyondWords/assets/admin/company/addCompany.php">Add Delivery Companies</a>
          <a class="dropdown-item" href="/BeyondWords/assets/admin/company/listCompanies.php">List Delivery Companies </a>
        </div>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Admin
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="/BeyondWords/assets/admin/order/orders.php">View Orders </a>
          <a class="dropdown-item" href="/BeyondWords/assets/admin/feedback/viewFeedbacks.php">View Feedbacks </a>
          <a class="dropdown-item" href="/BeyondWords/assets/admin/addAdmin.php">Add Admin Account</a>
          <a class="dropdown-item" href="/BeyondWords/assets/admin/listAdmins.php">View Admin Accounts</a>
        </div>
      </li>
    </ul>
    <form class="form-inline my-2 my-lg-0" method="POST">
    <button class="btn btn-danger" name="logout">Log Out <i class="fas fa-sign-out-alt"></i></button>
    </form>
  </div>
  <?php } ?>
</nav>