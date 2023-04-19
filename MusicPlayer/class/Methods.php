<?php 
/**
 * Class to implement addition, removal, modification to data. 
 */
class Methods {
  /**
   *  @var object $conn
   *    Stores connection object.
   */
  private $conn;

  /**
   * Constructor to call Connect class and create connection object.
   */
  function __construct() {
    include "connect.php";
    // Creating object of Connection class and storing conection object in $conn.
    $conn_obj = new Connect();
    $this->conn = $conn_obj->returnConn();
  }

  /**
   * Function to select data from from desired table.
   * 
   *  @param string $table
   *    Stores table name from where data is to be selected.
   * 
   *  @return object $stmt
   *    Returns prepared sql query.
   */
  function selectData($table) {
    $stmt = $this->conn->prepare("SELECT * from $table");
    return ($stmt);
  }

  /**
   * Function to verify data filled in login form with data in UserInfo table.
   * 
   *  @param string $userName
   *    Stores username entered by user.
   *  @param string $email
   *    Stores email id entered by user.
   *  @param string $password
   *    Stores password entered by user.
   * 
   *  @return object $stmt
   *    Returns prepared sql query.
   */
  function checkLoginData($userName, $email, $password ) {
    $stmt = $this->conn->prepare("SELECT userName FROM UserInfo WHERE userName = '$userName'  AND pword = '$password' AND email='$email'");
    return ($stmt);
  }

  /**
   * Function to return id and username of current user.
   * 
   *  @param string $email
   *    Stores email id of current user.
   * 
   *  @return object $stmt
   *    Returns prepared sql query.
   */
  function returnUser($email) {
    $stmt = $this->conn->prepare("SELECT userId,userName FROM UserInfo WHERE email = '$email'");
    return ($stmt);
  }

  /**
   * Function to upload an audio file to uploads folder.
   * 
   *  @return string
   *    Returns destination path of uploaded audio.
   */
  function uploadFile() {
    $fileName = $_FILES['audioFile']['name'];
    $fileTmp = $_FILES['audioFile']['tmp_name'];
    if (move_uploaded_file($fileTmp, "uploads/".$fileName)) {
      $dest="uploads/".$fileName;
      return $dest;
    }
    else {
      return "";
    }
  }

  /**
   * Function to insert data of uploaded songs in database.
   * 
   *  @param string $title
   *    Stores title of uploaded audio.
   *  @param string $artist
   *    Stores artist of uploaded audio.
   *  @param string $path
   *    Stores path of uploaded audio.
   */
  function insertUploads($title, $artist, $path) {
    $stmt = $this->conn->prepare("INSERT INTO uploads (title, artist, audioPath)
    VALUES (:title, :artist, :audioPath)");
    $stmt->bindParam(':title', $title);
    $stmt->bindParam(':artist', $artist);
    $stmt->bindParam(':audioPath', $path);
    $stmt->execute();
  }

  /**
   * Function to insert form data into UserInfo table.
   * 
   *  @return string
   *    Returns success message.
   */
  function insertUserInfo() {
    $userName = $_POST['userNameReg'];
    $email = $_POST['emailReg'];
    $phone = $_POST['numberReg'];
    $genre = implode(',', $_POST['genre']);
    $password = $_POST['passwordReg'];

    $stmt = $this->conn->prepare("INSERT INTO UserInfo (userName, email, phoneNumber, genre, pword)
    VALUES (:userName, :email, :phoneNumber, :genre, :pword)");
    $stmt->bindParam(':userName', $userName);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':phoneNumber', $phone);
    $stmt->bindParam(':genre', $genre);
    $stmt->bindParam(':pword', $password);
    $stmt->execute();
    $_SESSION['logged'] = TRUE;
    $conn = NULL;
    return "Registration successful!";
  }

  /**
   * Function to update data in UserInfo table.
   * 
   *  @param string $oldEmail
   *    Stores old email of user which is to be updated.
   *  @param string $newEmail
   *    Stores new email of user.
   *  @param string $phone
   *    Stores phone number of user.
   *  @param string $genre
   *    Stores interests of user.
   * 
   *  @return object $stmt
   *    Returns prepared sql query.
   */
  function updateData($oldEmail, $newEmail, $phone, $genre) {
    $stmt = $this->conn->prepare("UPDATE UserInfo SET email='$newEmail', phoneNumber='$phone', genre='$genre' WHERE email='$oldEmail'");
    return ($stmt);
  }
  
  /**
   * Function to select data corresponding to a particular id from a table.
   * 
   *  @param int $id
   *    Stores id of song to be selected.
   *  @param string $table
   *    Stores name of table from which data is to be selected.
   * 
   *  @return object $stmt
   *    Returns prepared sql query.
   */
  function selectDataWithId($id, $table) {
    $stmt = $this->conn->prepare("SELECT * from $table WHERE id='$id'");
    return ($stmt);
  }

  /**
   * Function to select data from favTable where user is the current user.
   * 
   *  @param int $user
   *    Stores current user.
   * 
   *  @return object $stmt
   *    Returns prepared sql query.
   */
  function showFav($user) {
    $stmt = $this->conn->prepare("SELECT * from favTable WHERE userId='$user'");
    return ($stmt);
  }

  /**
   * Function to delete data corresponding to a particular id from a table.
   * 
   *  @param int $id
   *    Stores id of song to be deleted.
   *  @param string $table
   *    Stores name of table from which data is to be deleted.
   * 
   *  @return object $stmt
   *    Returns prepared sql query.
   */
  function deleteFav($id, $user) {
    $stmt = $this->conn->prepare("DELETE from favTbale WHERE id='$id' AND userId='$user'");
    return ($stmt);
  }

  /**
   * Function insert data into the favorites table.
   * 
   *  @param int $id
   *    Stores id of song..
   *  @param string $title
   *    Stores title of song.
   *  @param string $audioPath
   *    Stores path of song.
   *  @param string $imgPath
   *    Stores path of image.
   * @param int $user
   *    Stores current user id.
   */
  function insertFavourites($id, $title, $audioPath, $imgPath, $user) {
    $stmt = $this->conn->prepare("INSERT INTO favTable (id, title, audioPath, imgPath, userId)
    VALUES (:id, :title, :audioPath, :imgPath, :userId)");
    $stmt->bindParam(':id', $id);
    $stmt->bindParam(':title', $title);
    $stmt->bindParam(':audioPath', $audioPath);
    $stmt->bindParam(':imgPath', $imgPath);
    $stmt->bindParam(':userId', $user);
    $stmt->execute();
  }

  /**
   * Function to implement pagination in the library page.
   * 
   *  @param int $offset
   *    Stores starting value from wich data is to be shown.
   *  @param int $limit
   *    Stores limit of data, uptil which data is to be shown.
   * 
   *  @return object $stmt
   *    Returns prepared sql query.
   */
  function pagination($offset, $limit) {
    $stmt = $this->conn->prepare("SELECT * from musicTable LIMIT {$offset}, $limit");
    return ($stmt);
  }

  /**
   * Function to select all id stored in the favTable.
   * 
   *  @return object $stmt
   *    Returns prepared sql query.
   */
  function selectFavId() {
    $stmt = $this->conn->prepare("SELECT id from favTable");
    return ($stmt);
  }

  /**
   * Function to return song where id=$id and user is the current user.
   * 
   *  @param int $id
   *    Stores id of song to be searched.
   * 
   *  @return bool
   *    Returns TRUE/FALSE depending on condition satisfaction.
   */
  function checkUserIdFav($id) {
    $userId = $_SESSION['user'];
    $stmt = $this->selectFavData($id,$userId);
    $stmt->execute();
    if ($stmt->rowCount() > 0) {
      return TRUE;
    }
    return FALSE;
  }

  /**
   * Function to select data from favTable where id=$id and user is the 
   * current user.
   * 
   *  @param int $id
   *    Stores id of song to be selected.
   *  @param int $user
   *    Stores current user.
   * 
   *  @return object $stmt
   *    Returns prepared sql query.
   */
  function selectFavData($id, $user) {
    $stmt = $this->conn->prepare("SELECT * from favTable WHERE id='$id' AND userId='$user'");
    return ($stmt);
  }

  /**
   * Function to update password in th UserInfo table.
   * 
   *  @param string $pass
   *    Stores new password.
   *  @param string $userName
   *    Stores username of user for whom password will be updated.
   * 
   *  @return string 
   *    Returns success message.
   */
  function updatePassword($pass, $userName) {
    $stmt = $this->conn->prepare("UPDATE UserInfo SET password='$pass' WHERE userName='$userName';");
    $stmt->execute();
    return "Password updated succesfully";
  }
}
?>
