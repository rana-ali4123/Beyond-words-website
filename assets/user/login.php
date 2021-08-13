<?php
include("/xampp/htdocs/BeyondWords/assets/generalPHP/configureDB.php");
include("/xampp/htdocs/BeyondWords/assets/shared/nav.php");

if (isset($_POST['login'])) {
    $email        = $_POST["email"];
    $password     = $_POST["password"];
    $select       = "SELECT * FROM `users` WHERE email = '$email' and password = '$password'";
    $selectQuery  = mysqli_query($connect, $select);
    $numberOfRows = mysqli_num_rows($selectQuery);
    if ($numberOfRows > 0) {
        $_SESSION["user"] = $email;
        $_SESSION["cart"] = array();
        header("location: /BeyondWords/");
    } else {
        echo "<div class='container alert alert-danger col-6 text-center font-weight-bolder'>
        Wrong email or password
      </div>";
    }
}

include("/xampp/htdocs/BeyondWords/assets/shared/header.php");
?> 

<link rel="stylesheet" href="style.css">

<style> 
html,
body {
  color:#013a63;
	background-image: url("https://puu.sh/HAeoC/e572dbf561");

	background-repeat: repeat-x;
	background-size:contain;

}

button:hover {background:#022c3a !important;
}
form input { 
	border-radius: 500px !important;
}
form { /*new*/
	background: white;
	margin: 30px;
	border: 1px solid black;
	outline: 1px solid black;
	outline-offset: 15px;
	
	
}
</style>

<div class="float-right col-6">
  <div class="col-8 mt-5">
    <form method="POST" class="col-12">
      <div class="form-group">
      <br>
      <h1 class="text-center mb-5">Login</h1>
        <label for="email">Email:</label>
        <input type="text" class="form-control" name="email" id="email" required>
      </div>
      <div class="form-group">
        <label for="password">Password:</label>
        <input type="password" class="form-control" name="password" id="password" required><br>
        <button type="submit" name="login" class="float-right col-3">Login</button>
        <br><br>
      </div>
    </form>
  </div>
</div>



<!-- <div class ="container col-4 mt-5" > 
<form method="POST">
 
  <div class="form-group">
    <label  for="email">E-mail: </label>
    <input name="email" type="Email" class="form-control" id="email" aria-describedby="emailHelp" required>
  </div>
  
  <div class="form-group">
    <label for="password">Password:</label>
    <input  type="password" name="password" class="form-control" id="password" required>
  </div>
<div class ="container col-4 mt-2">
  <button type="submit" name="login" class="btn btn-light">log in</button>
</div>

</form>
</div> -->

<?php
include("/xampp/htdocs/BeyondWords/assets/shared/footer.php");
?>