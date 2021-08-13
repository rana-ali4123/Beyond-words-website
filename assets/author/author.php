<?php
include("/xampp/htdocs/BeyondWords/assets/generalPHP/configureDB.php");
//Getting the book ISBN
if (isset($_GET["author"])) {
    $authorID        = $_GET["author"];
    $selectAuthor      = "SELECT * FROM `authors` WHERE id = $authorID";
    $selectAuthorQuery = mysqli_query($connect, $selectAuthor);
    $authorRow     = mysqli_fetch_assoc($selectAuthorQuery);
    $selectAuthorBooks = "SELECT * FROM `books` WHERE author = $authorID";
    $selectBooksQuery = mysqli_query($connect, $selectAuthorBooks);
    $authorBooksRow = mysqli_fetch_assoc($selectBooksQuery);
}

include("/xampp/htdocs/BeyondWords/assets/shared/header.php");
include("/xampp/htdocs/BeyondWords/assets/shared/nav.php");
?> 

<link rel="stylesheet" href="style.css">

<div class="container mt-3">
  <div class="row">

    <div class="col-3">
    <div class="coverContainer m-auto">
      <img class="bookPicture" src="<?php echo $authorRow["authorImage"]; ?>" />
    </div>
      <div class="mt-2">
            <p class="text-center"> <span class="bolderInfo">Location:</span> <?php echo $authorRow["location"]; ?></p>
            <p class="text-center"><span class="bolderInfo">Birthdate:</span> <?php echo $authorRow["birthdate"]; ?></p>
      </div>
    </div>
    <div class="col">
    <h1 class="main"><?php echo $authorRow["authorName"]; ?></h1>
    <p class="bookDescription"><?php echo $authorRow["authorDesc"]; ?></p>
    <div>
    <h2 class="authorBooks main2 mx-auto">Author Books</h2>
    <div class="list-group">
        <?php foreach($selectBooksQuery as $selected){ ?>
        <a href="/BeyondWords/assets/book/book.php?ISBN=<?php echo $selected["ISBN"]; ?>" class="list-group-item list-group-item-action"><img style="width: 12%" class="mr-2" src="<?php echo $selected["image"]; ?>"><?php echo $selected["bookName"]; ?></a>
        <?php } ?>
</div>
    </div>
    </div>
  </div>

  <?php 
  include("/xampp/htdocs/BeyondWords/assets/shared/footer.php"); 
  ?>
