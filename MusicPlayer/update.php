<?php 
session_start();
if (!$_SESSION['logged']) {
  header("Location: index.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Upload</title>
  <?php include 'header/header.php' ?>
</head>
<body>
  <div class="container">
    <form method="post" id="updateForm" name="updateForm">
      <div>
        <label>Old email id:</label>
        <input type="email" name="oldEmail" id="oldEmail">
      </div>
      <div>
        <label>New email id:</label>
        <input type="email" name="newEmail" id="newEmail">
      </div>
      <div>
        <label>Contact number:</label>
        <input type="text" name="phone" id="phone">
      </div>
      <div>
        <label>Interest:</label>
        <input type="checkbox" value="Pop" name="genreUpdate[]">Pop
        <input type="checkbox" value="Folk" name="genreUpdate[]">Folk
        <input type="checkbox" value="Indie" name="genreUpdate[]">Indie
        <input type="checkbox" value="Romantic" name="genreUpdate[]">Romantic
      </div>
      <input type="button" name="updateBtn" id="updateBtn" value="Submit" class="buttons">
    </form>
    <div id="msg"></div>
  </div>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
  <script src="./js/forms.js"></script>
</body>
</html>
