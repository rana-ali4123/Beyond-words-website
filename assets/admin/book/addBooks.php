<?php
include("/xampp/htdocs/BeyondWords/assets/generalPHP/configureDB.php");

//Select authors
$selectAuthors   = "SELECT * FROM `authors`";
$selectAuthQuery = mysqli_query($connect, $selectAuthors);

//Select categories
$selectCategories = "SELECT * FROM `categories`";
$selectCatQuery   = mysqli_query($connect, $selectCategories);

//Insert into database a new book
if (isset($_POST["add"])) {
    $ISBN        = $_POST["ISBN"];
    $bookName    = addSlashes($_POST["bookName"]);
    $price       = $_POST["price"];
    $stock       = $_POST["stock"];
    $author      = $_POST["author"];
    $category    = $_POST["category"];
    $image       = $_POST["image"];
    $bookDesc    = addSlashes($_POST["bookDesc"]);
    $insert      = "INSERT INTO `books` VALUES ($ISBN, '$bookName', $price, $stock, $author, $category, '$image', '$bookDesc', null, null, null, null, null)";
    $insertQuery = mysqli_query($connect, $insert);
    header("location: listBooks.php");
}

//Editing a book in database (setting inputs to empty value in case of adding a new book to evade bugs and errors)
$ISBN                    = "";
$bookName                = "";
$price                   = "";
$stock                   = "";
$author                  = "";
$category                = "";
$image                   = "";
$bookDesc                = "";
$authorRow["authID"]     = "";
$authorRow["authorName"] = "";
$catRow["catID"]         = "";
$catRow["catName"]       = "";
$editing                 = false;
if (isset($_GET["edit"])) {
    $editing               = true;
    $editedISBN            = $_GET["edit"];
    $selectedISBN          = "SELECT * FROM `books` WHERE ISBN = $editedISBN";
    $selectedQuery         = mysqli_query($connect, $selectedISBN);
    $selectedRow           = mysqli_fetch_assoc($selectedQuery);
    $selectedAuthor        = "SELECT authors.authorName, authors.id authID FROM authors INNER JOIN books on authors.id = books.author where books.ISBN = $editedISBN";
    $selectedAuthorQuery   = mysqli_query($connect, $selectedAuthor);
    $authorRow             = mysqli_fetch_assoc($selectedAuthorQuery);
    $selectedCategory      = "SELECT categories.catName, categories.id catID FROM categories INNER JOIN books on categories.id = books.category where books.ISBN = $editedISBN";
    $selectedCategoryQuery = mysqli_query($connect, $selectedCategory);
    $catRow                = mysqli_fetch_assoc($selectedCategoryQuery);
    $ISBN                  = $selectedRow["ISBN"];
    $bookName              = $selectedRow["bookName"];
    $price                 = $selectedRow["price"];
    $stock                 = $selectedRow["stock"];
    $author                = $selectedRow["author"];
    $category              = $selectedRow["category"];
    $image                 = $selectedRow["image"];
    $bookDesc              = $selectedRow["bookDesc"];
    //Updating values in database
    if (isset($_POST["update"])) {
        $ISBN        = $_POST["ISBN"];
        $bookName    = addSlashes($_POST["bookName"]);
        $price       = $_POST["price"];
        $stock       = $_POST["stock"];
        $author      = $_POST["author"];
        $category    = $_POST["category"];
        $image       = $_POST["image"];
        $bookDesc    = addSlashes($_POST["bookDesc"]);
        $update      = "UPDATE `books` SET ISBN = $ISBN, bookName = '$bookName', price = $price, stock = $stock, author = $author, category = $category, `image` = '$image', bookDesc = '$bookDesc' where ISBN = $editedISBN";
        $updateQuery = mysqli_query($connect, $update);
        header("location: listBooks.php");
    }
}
include("/xampp/htdocs/BeyondWords/assets/admin/shared/adminHeader.php");
include("/xampp/htdocs/BeyondWords/assets/admin/shared/adminNav.php");
?> 

<div class="container col-4 mt-5">
    <?php if($editing) : ?>
        <h1 class="text-center mb-5">Edit an existing book</h1>
    <?php else : ?>
        <h1 class="text-center mb-5">Add a new book</h1>
    <?php endif; ?>
  <form method="POST">
    <div class="form-group">
      <label for="ISBN">ISBN-13:</label>
      <input type="text" minlength="13" maxlength="13" class="form-control mt-2" value="<?php echo $ISBN;?>" name="ISBN" id="ISBN" required>
    </div>
    <div class="form-group">
      <label for="bookName">Book Name:</label>
      <input type="text" class="form-control mt-2" value="<?php echo $bookName;?>" name="bookName" id="bookName" required>
    </div>
    <div class="form-group">
      <label for="price">Price:</label>
      <input type="text" class="form-control mt-2" value="<?php echo $price;?>" name="price" id="price" required>
    </div>
    <div class="form-group">
      <label for="stock">Stock:</label>
      <input type="text" class="form-control mt-2" value="<?php echo $stock;?>" name="stock" id="stock" required>
    </div>
    <div class="form-group">
      <label for="author">Author:</label>
      <select name="author" id="author" class="form-control mt-2" required>
      <option selected="true" hidden value=<?php echo $authorRow["authID"]; ?>><?php echo $authorRow["authorName"];?></option>
          <?php foreach($selectAuthQuery as $selectedAuth){ ?>
          <option value="<?php echo $selectedAuth["id"]; ?>"><?php echo $selectedAuth["authorName"] ?></option>
          <?php } ?>
      </select>
    </div>
    <div class="form-group">
      <label for="category">Category:</label>
      <select name="category" id="category" class="form-control mt-2" required>
      <option selected="true" hidden value=<?php echo $catRow["catID"]; ?>><?php echo $catRow["catName"];?></option>
          <?php foreach($selectCatQuery as $selectedCat){ ?>
          <option value="<?php echo $selectedCat["id"]; ?>"><?php echo $selectedCat["catName"] ?></option>
          <?php } ?>
      </select>
    </div>
    <div class="form-group">
      <label for="image">Image Link:</label>
      <input type="text" class="form-control mt-2" value="<?php echo $image;?>" name="image" id="image" required>
    </div>
    <div class="form-group">
      <label for="bookDesc">Book Description:</label>
      <textarea class="form-control mt-2" id="bookDesc" name="bookDesc" cols="50" rows="10" required><?php echo $bookDesc;?></textarea>
    </div>
    <?php if($editing) : ?>
        <button type="submit" name="update" class="custom-button float-right col-3">Edit</button>
        <a href="/BeyondWords/assets/admin/book/listBooks.php" class="custom-button float-right col-3 text-center">Back</a>
    <?php else : ?>
        <button type="submit" name="add" class="custom-button float-right col-3">Add</button>
    <?php endif; ?>
  </form>
</div>


<?php 
include("/xampp/htdocs/BeyondWords/assets/shared/footer.php");
?>