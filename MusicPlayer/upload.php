<?php 
session_start();
if (!$_SESSION['logged']) {
  header("Location: index.php");
}
if (isset($_POST['uploadBtn'])) {
  include "class/Methods.php";
  $obj = new Methods();
  $audioPath = $obj->uploadFile();
  $title = $_POST['title'];
  $artist = $_POST['artist'];
  $obj->insertUploads($title, $artist, $audioPath);
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
    <form method="post" enctype="multipart/form-data" id="uploadForm" name="uploadForm">
      <div>
        <label>Title:</label>
        <input type="text" name="title" id="title">
      </div>
      <div>
        <label>Artist:</label>
        <input type="text" name="artist" id="artist">
      </div>
      <div>
        <label>Audio file:</label>
        <input type="file" name="audioFile" id="audioFile">
      </div>
      <input type="submit" name="uploadBtn" id="uploadBtn" value="Submit" class="buttons" onclick="">
    </form>
    <?php echo isset($_SESSION['uploadErr'])? "*" . $_SESSION['uploadErr']: ""; ?> 
  </div>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
  <script src="./js/forms.js"></script>
</body>
</html>
