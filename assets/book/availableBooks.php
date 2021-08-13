<?php
include("/xampp/htdocs/BeyondWords/assets/generalPHP/configureDB.php");

$select= "SELECT * FROM `books` LEFT JOIN `authors` ON books.author = authors.id";
$selectQuery = mysqli_query($connect, $select);

include("/xampp/htdocs/BeyondWords/assets/shared/header.php");
include("/xampp/htdocs/BeyondWords/assets/shared/nav.php");
?> 

<h1 class="text-center my-5">Available Books</h1>

<div class="container">
    <div class="displayedBooks row m-auto">
    <?php foreach($selectQuery as $selected){ ?>
    <div class="bookImage mx-auto mt-5">
            <a href="/BeyondWords/assets/book/book.php?ISBN=<?php echo $selected["ISBN"]; ?>"><img class="bookCover" src="<?php echo $selected["image"];?>" alt=""></a>
            <p class="text-center bookInfo">Author: <?php echo $selected["authorName"] ?></p>
            <p class="text-center bookInfo">Price: <?php echo $selected["price"]; ?> L.E</p>
    </div>
    <?php } ?>
    </div>
</div>

<?php 
include("/xampp/htdocs/BeyondWords/assets/shared/footer.php");
?>