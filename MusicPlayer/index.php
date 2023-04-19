<?php 
session_start();
if(isset($_POST['submitLogin'])) {
  $userName = $_POST['userNameLogin'];
  $email = $_POST['emailLogin'];
  $password = $_POST['passwordLogin'];

  include "class/Methods.php";
  $obj = new Methods();
  $stmt = $obj->checkLoginData($userName, $email, $password);
  $stmt->execute();
  if($stmt->rowCount()) {
    $_SESSION['logged'] = TRUE;
    $stmt1 = $obj->returnUser($email);
    $stmt1->execute();
    $row = $stmt1->fetch(PDO::FETCH_ASSOC);
    $_SESSION['user'] = $row['userId'];
    $_SESSION['userName'] = $row['userName'];
    header("Location: musicLib.php");
  }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Welcome</title>
  <link rel="stylesheet" href="css/style.css">
  <?php include 'header/header.php' ?>
</head>
<body>
  <div class="container" id="blur">
    <div class="contents">
      <div class="top">
        <h1>Welcome to musicPlayer</h1>
        <div> <a class="buttons" id="loginBtn">Login</a> </div>
        <div>New User? <button id="regBtn">Register</button></div>
      </div>

      <!--Login form which gets displayed on button click-->
      <div class="loginPopup">
        <form method="post" name="loginForm">
          <div>
            <label>Username</label>
            <input type="text" name="userNameLogin" id="userNameLogin">
            <span id="err"></span>
          </div>
          <div>
            <label>Email</label>
            <input type="email" name="emailLogin" id="emailLogin">
            <span id="err"></span>
          </div>
          <div>
            <label>Password</label>
            <input type="password" name="passwordLogin" id="passwordLogin">
            <span id="err"></span>
          </div>
          <input type="submit" name="submitLogin" id="submitLogin" value="Submit" class="buttons" onclick="return checkValid()">
          <a href="resetPassword.php">Forgot password?</a>
        </form>
        <div> <a class="buttons" id="closeLogin">x</a> </div>
      </div>

      <!--Registrartion form which gets displayed on button click-->
      <div class="registerPopup">
        <form method="post" name="registerForm" id="registerForm">
          <div>
            <label>Username</label>
            <input type="text" name="userNameReg" id="userNameReg">
            <span id="err"></span>
          </div>
          <div>
            <label>Email</label>
            <input type="email" name="emailReg" id="emailReg">
            <span id="err"></span>
          </div>
          <div>
            <label>Contact Number</label>
            <input type="text" name="numberReg" id="numberReg">
            <span id="err"></span>
          </div>
          <div>
            <label>Interest</label>
            <input type="checkbox" value="Pop" name="genre[]">Pop
            <input type="checkbox" value="Folk" name="genre[]">Folk
            <input type="checkbox" value="Indie" name="genre[]">Indie
            <input type="checkbox" value="Romantic" name="genre[]">Romantic
          </div>
          <div>
            <label>Password</label>
            <input type="password" name="passwordReg" id="passwordReg">
            <span id="err"></span>
          </div>
          <input type="button" name="submitReg" id="submitReg" value="Submit" class="buttons" onclick="return checkValid()">
        </form>
        <div> <a class="buttons" id="closeReg">x</a> </div>
        <div class="msg"></div>
        <div id="response"></div>
      </div>
    </div>
  </div>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
  <script src="./js/forms.js"></script>
  <script src="./js/validation.js"></script>
</body>
</html>
