<?php
include("/xampp/htdocs/BeyondWords/assets/generalPHP/configureDB.php");

//Select categories from database
$select      = "SELECT * FROM `feedbacks` LEFT JOIN `users` ON feedbacks.userID = users.id";
$selectQuery = mysqli_query($connect, $select);

include("/xampp/htdocs/BeyondWords/assets/admin/shared/adminHeader.php");
include("/xampp/htdocs/BeyondWords/assets/admin/shared/adminNav.php");
?> 


<div class="container mt-5 col-5">
  <h1 class="text-center mb-5">Feedbacks</h1>
  <table class="table table-striped table-dark">
    <thead>
      <tr>
        <th class="text-center">ID</th>
        <th class="text-center">Title</th>
        <th class="text-center">Feedback</th>
        <th class="text-center">Rating</th>
        <th class="text-center">By</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach($selectQuery as $selected){ ?>
      <tr>
        <td class="text-center">
          <?php echo $selected["id"]; ?>
        </td>
        <td class="text-center">
          <?php echo $selected["title"]; ?>
        </td>
        <td class="text-center">
          <?php echo $selected["feedback"]; ?>
        </td>
        <td class="text-center">
          <?php echo $selected["satisfactionRating"]; ?>
        </td>
        <td class="text-center">
          <?php echo $selected["userName"]; ?>
        </td>
      </tr>
      <?php } ?>
    </tbody>
  </table>
</div>

<?php
include("/xampp/htdocs/BeyondWords/assets/shared/footer.php");
?>