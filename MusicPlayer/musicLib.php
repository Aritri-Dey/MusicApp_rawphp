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
    <title>Library</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <?php include 'header/header.php' ?>
  </head>
  <body>
    <div class="container">
      <div class="content">
        <div class="row">
          
        </div>
      </div>
    </div>
  </body>
  <script src="./js/forms.js"></script>
</html>
