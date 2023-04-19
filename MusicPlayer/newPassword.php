<?php 
if (isset($_POST['resetBtn'])) {
  if ($_POST['conPassword'] != $_POST['password']) {
    $_SESSION['passErrr'] = "Password field and confirm password field does not match.";
  }
  else {
    include "class/Methods.php";
    $obj = new Methods();
    $msg = $obj->updatePassword($_POST['password'], $_POST['userName']);
    echo $msg;
  }
}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset password</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <?php include 'header/header.php' ?>
  </head>
  <body>
    <div class="container">
      <form name="resetPasswordForm" id="resetPasswordForm" class="resetPasswordForm" method="POST">
        <div class="form-group">
          <label>Username</label>
          <input type="text" class="form-control" id="userName" name="userName" placeholder="Password">
        </div>
        <div class="form-group">
          <label>Password</label>
          <input type="password" class="form-control" id="password" name="password" placeholder="Password">
        </div>
        <div class="form-group">
          <label>Confirm Password</label>
          <input type="password" class="form-control" id="conPassword" name="conPassword" placeholder="Password">
        </div>
        <button type="submit" name="resetBtn" class="btn btn-primary">Submit</button>
      </form>
      <span> <?php echo isset($_SESSION['passErrr'])? "*" . $_SESSION['passErrr']: ""; ?> </span>
    </div>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  </body>
</html>
