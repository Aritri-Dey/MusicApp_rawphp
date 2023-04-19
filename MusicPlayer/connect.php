<?php 

 /**
  * Class to create connection using php data objects (PDO).
  *
  *   @return $conn-
  *     returns the connection object.
  */
  class Connect {
    public function returnConn() {
      require "databaseInfo.php";
      $servername = SERVER;
      $username = USERNAME;
      $password = PASSWORD;
      $dbname = DBNAME;
      $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
      // set the PDO error mode to exception
      $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      return $conn;
    }
  }
?>
