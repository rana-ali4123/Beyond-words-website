<?php
include("/xampp/htdocs/BeyondWords/assets/generalPHP/configureDB.php");
include("/xampp/htdocs/BeyondWords/assets/shared/header.php");
include("/xampp/htdocs/BeyondWords/assets/shared/nav.php");

if (isset($_POST['register'])) {
    $userName   = $_POST['userName'];
    $age        = $_POST['age'];
    $phone      = $_POST['phone'];
    $altPhone   = $_POST['altPhone'];
    $address    = $_POST['address'];
    $altAddress = $_POST['altAddress'];
    $email      = $_POST['email'];
    $password   = $_POST['password'];
    $cPassword  = $_POST['cPassword'];

    //Check if email is registered before
    $checkEmail = "SELECT * FROM `users` where email = '$email'";
    $emailQuery = mysqli_query($connect, $checkEmail);
    $emailRows  = mysqli_num_rows($emailQuery);

    if($emailRows > 0){
      echo ' <div class="alert alert-warning alert-dismissible fade show alert-danger container-sm col-5 " role="alert" >
      The email address is <strong>already used</strong> before. Please use another email address.
      <button type="button" class="close" aria-label="Close" data-dismiss="alert">
      <span aria-hidden="true">&times;</span>
      </button>
      </div> ';
    }else{
    
    if ($password !== $cPassword) {
        /*here is alert to password confirm error! */
        echo ' <div class="alert alert-warning alert-dismissible fade show alert-danger container-sm col-5 " role="alert" >
        <strong>NOT SAME PASSWORD!</strong> You should check in on some of password field below.
        <button type="button" class="close" aria-label="Close" data-dismiss="alert">
<span aria-hidden="true">&times;</span>
</button>
      </div> ';
    }
    else {
        $insert      = "INSERT INTO `users` VALUES (NULL,'$userName', '$age' ,'$phone','$altPhone','$address','$altAddress','$email','$password')";
        $insertQuery = mysqli_query($connect, $insert);
        header("location: login.php");
    }
  }
}
?> 
    <style>input:invalid {
  border: 2px solid red;
  background-color:#FFDBFF;  
    }

input:valid {
  border: 2px solid black;
  background-color:#CCE6E6;
} </style>

<link rel="stylesheet" href="style.css">

<div class="float-right col-6">
  
  <form method="post"  class="col-10" >
  <h1 class="text-center">Register</h1>
  
  <!-- form name field required-->
  <div class="form-group">
      <label for="userName">Full Name:</label>
      <input type="text" class="form-control" id="userName" aria-describedby="emailHelp" placeholder="Enter your full name" name="userName" required>
    </div>
  
  
  
  
    <!--age-->
     <label for="age">Age:</label> <br>
    <select class="custom-select custom-select-sm m-20" id="age" name="age" required> <!-- name of age-->
   <option value="" selected hidden disabled>Select your age</option>
    <?php
  for($a = 16; $a <= 99; $a++){ /* variable $a is age var. to get ages from 12 to 99 in short stat.*/?>
    <option value=" <?php echo $a; ?> "> <?php echo $a; ?> </option>
     <?php } //end of for loop ?>
  </select>
  
  <br>
  
  
  <!-- form email field-->
  <div class="form-group">
      <label for="email">Email Address:</label>
      <input type="email" class="form-control" id="email" aria-describedby="emailHelp" placeholder="Enter your e-mail address" name ="email" required >
     </div>
  
  
  
  <br>
  
  
  
  <!-- form phone field-->
  <div class="row">
      <div class="col">
      <label for="phone">Phone Number:</label>
        <input type="text" class="form-control" placeholder="Phone number" name="phone" required  minlength="11"><!-- form phone field *name phone-->
      </div>
    <!-- form  phone field *name phone2-->
      <div class="col">
      <label for="altPhone">Alternative Phone:</label>
        <input type="text" class="form-control" placeholder=" Alternative Phone" name="altPhone"   minlength="11">
      </div>
    </div>
  
  
  
   <!--Address  name=adress*-->
   <div class="form-group">
      <label for="address">Address:</label>
      <input type="text" class="form-control" id="address" placeholder="1234 Main St"  name="address" required>
      <small id="emailHelp" class="form-text text-muted">We'll never share your address with anyone else.</small>
    </div>
  <!-- alternative Address  name=adress2*-->
    <div class="form-group">
      <label for="altAddress">Alternative Address:</label>
      <input type="text" class="form-control" id="altAddress" placeholder="Enter alternative Address" name="altAddress">
    </div>
  
  
  <!--TODO**confirm pass==pass* validation of pass**-->
    <!--password-->
    <br>
    <div class="row">
      <div class="col">
      <label for="password">Password:</label>
        <input type="password" class="form-control" placeholder="Password" name="password" required  minlength="6">
        <small id="emailHelp"  style="color:red;" >At least 6 characters*.</small>
        <!-- form password field *name pass-->
  
      </div>
  
    <!--confirm password-->
      <div class="col">
      <label for="cPassword">Confirm Password:</label>
        <input type="password" class="form-control" placeholder=" Confirm Password " name="cPassword" required><!-- form  confirm password field *name cpass-->
      </div>
    </div>
  
  <br>
  
  <!--submit btn name=register**-->
   <button type="submit" class="btn btn-primary mb-5" name="register">Register</button>
  </form>
</div>

<?php
include("/xampp/htdocs/BeyondWords/assets/shared/footer.php");
?>