<?php
session_start();
if (!isset($_SESSION['username'])) {
  $_SESSION['msg'] = "You must log in first";
  header('location: register.php');
}
if (isset($_GET['logout'])) {
  session_destroy();
  unset($_SESSION['username']);
  header("location: register.php");
}
?>
<!DOCTYPE html>
<html>

<head>
  <title>Home</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
  <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
  <style>
    <?php include "style.css" ?>
  </style>
</head>

<body>
  <div class="box">
    <div class="header1">
      <h1>Home Page</h1>
    </div>
    <div class="content">
      <!-- notification message -->
      <?php if (isset($_SESSION['success'])) : ?>
        <div class="error success">
          <h3>
            <?php
            echo $_SESSION['success'];
            unset($_SESSION['success']);
            ?>
          </h3>
        </div>
      <?php endif ?>

      <!-- logged in user information -->
      <?php if (isset($_SESSION['username'])) : ?>
        <div class="logout">
          <h4>Welcome <strong><?php echo $_SESSION['username']; ?></strong></h4>
          <button class="btn1"><b><a href="index.php?logout='1'" style="color: black;">LogOut</a></b></button>
        </div>
      <?php endif ?>
      <h3 class="heading">IMPORT CSV FILE INTO MY-SQL DATABASE</a></h2>
        <hr>
        <form action="import.php" method="post" enctype='multipart/form-data' id="import_csv_form">
          <div class="form-group" align="center">
            <label>
              <h3>Please Select File(Only CSV Formate)</h3>
            </label>
            <div class="choosefile">
              <b><input type="file" name="file" id="exampleFormControlFile1"></b>
            </div>

          </div>
          <div class="form-group">
            <b><input type="submit" name="submit" value="submit" class="btn2"></b>
          </div>
        </form>
    </div>
  </div>

  <?php include('import.php') ?>
</body>
<script>
  $(document).ready(function() {
    $('#import_csv_form').on("submit", function(e) {
      e.preventDefault(); //form will not submitted  
      $.ajax({
        url: "import.php",
        method: "POST",
        data: new FormData(this),
        contentType: false, // The content type used when sending data to the server.  
        cache: false, // To unable request pages to be cached  
        processData: false, // To send DOMDocument or non processed data file it is set to false  
        success: function(data) {
          if (data == 'Error1') {
            alert("Invalid File");
          } else if (data == "Success") {
            alert("CSV file data has been Imported Sucessfully!");
            $('#import_csv_form')[0].reset();
          } else {
            alert("Please Select File");
          }

        }
      })
    });
  });
</script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

</html>