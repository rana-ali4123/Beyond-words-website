<?php
include("/xampp/htdocs/BeyondWords/assets/generalPHP/configureDB.php");

$select      = "SELECT * FROM `authors`";
$selectQuery = mysqli_query($connect, $select);

include("/xampp/htdocs/BeyondWords/assets/shared/header.php");
include("/xampp/htdocs/BeyondWords/assets/shared/nav.php");
?> 

<link rel="stylesheet" href="style.css">

<h1 class="text-center my-5">All Authors</h1>

<div class="container">
    <div class="displayedBooks row m-auto">
        <?php foreach($selectQuery as $selected){ ?>
            <div class = "col" >
                <div class="authorCard">
                    <div class="imageEdit"><a href="/BeyondWords/assets/author/author.php?author=<?php echo $selected["id"]; ?>"><img src="<?php echo $selected["authorImage"]; ?>" class="authorImage"></a></div>
                    <h3  class="text-center"><?php echo addSlashes($selected["authorName"]); ?></h3>
                </div>
            </div>
        <?php } ?>
    </div>
</div>

<?php 
include("/xampp/htdocs/BeyondWords/assets/shared/footer.php");
?>