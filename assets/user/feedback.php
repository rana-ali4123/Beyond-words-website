<?php
include("/xampp/htdocs/BeyondWords/assets/generalPHP/configureDB.php");
include("/xampp/htdocs/BeyondWords/assets/shared/header.php");
include("/xampp/htdocs/BeyondWords/assets/shared/nav.php");

$select = " SELECT * FROM `feedbacks`"; //query
$s      = mysqli_query($connect, $select); //run query

$email       = $_SESSION["user"];
$select1     = " SELECT * FROM `users` WHERE email = '$email'";
$selectQuery = mysqli_query($connect, $select1);
$selectedRow = mysqli_fetch_assoc($selectQuery);
$userID      = $selectedRow["id"];
if (isset($_POST['send'])) {
    $title    = addSlashes($_POST['title']);
    $feedback = addSlashes($_POST['feedback']);
    $rate     = $_POST['rate'];
    $insert   = "INSERT INTO `feedbacks` values (null, '$title','$feedback', $rate, $userID)";
    $i        = mysqli_query($connect, $insert);
    $message  = "Thanks for your feedback!";
    echo '<div class="alert alert-success">'.$message.'</div>';
}
?> 

<style>
body{
background-image: url("https://puu.sh/HAeoC/e572dbf561");
background-repeat:repeat-x;
background-size:contain;}
</style>

<div class="container col-4">
  <div class="row">
    <div class="col-lg-8">      
      <hr> 
      <h1 class="text-center">Feedback</h2>
<form action="feedback.php" method="POST">
  <div class="form-group">
    <label for="title">Title *</label>
    <input type="text" id="title" name="title" class="form-control" required>
  </div>
<div>
<div class="form-group">
<label for="form_feedback">Your feedback *</label>
<textarea style="margin: 10px 0;" name="feedback" id="form_feedback" class="form-control" rows="5" required></textarea>
</div>
</div>
<div class="form-group">
<label for="rate">How satisfied are you with the service?</label>
<select name="rate" id="rate" class="custom-select my-1 mr-sm-2 col-4" required>
    <option selected hidden disabled>Rate *</option>
    <option value="1">Strongly Dissatisfied</option>
    <option value="2">Dissatisfied</option>
    <option value="3">Neutral</option>
    <option value="4">Satisfied</option>
    <option value="5">Strongly Satisfied</option>
  </select>
  </div>
<div style="margin-top: 10px;" class="form-group">
  <button type="submit" name="send" class="btn btn-primary">Send</button>
</div>
<div class="row">
  <div class="col-md-12">
    <p class="text-muted">*These fields are required.</p>
  </div>
</div>
</form>
    </div>
  </div>
</div>


<?php
include("/xampp/htdocs/BeyondWords/assets/shared/footer.php");
?>