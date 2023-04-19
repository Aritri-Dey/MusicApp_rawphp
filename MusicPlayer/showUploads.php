<?php 
session_start();
if (!$_SESSION['logged']) {
  header("Location: index.php");
}
include "class/Methods.php";
$obj = new Methods();
$stmt = $obj->selectData("uploads");
$stmt->execute();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="css/style.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <title>Uploads</title>
  <?php include 'header/header.php' ?>
</head>
<body>
  <div class="container">
    <div class="favItem">
      <?php 
         if ($stmt->rowCount() > 0) {
          while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
      ?>
      <div class="eachItem">
        <img src="image/test.jpg" alt="img" height="200px">
        <h2><?php echo $row['title']?></h2>
        <h3><?php echo $row['artist']?></h3>
        <audio controls>
          <source src="<?php echo $row['audioPath']?>">
        </audio>
      </div>
      <?php }
      }
      else {?>
        <div class="eachItem">No uploaded songs yet.</div>
      <?php  
      }?>
    </div>
  </div>
  <script src="./js/forms.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
</body>
</html>
