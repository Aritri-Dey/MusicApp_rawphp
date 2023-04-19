<?php 
session_start();
  try {
    $id = $_POST['id'];
    include "class/Methods.php";
    $obj = new Methods();
    $stmt = $obj->selectFavData($id, $_SESSION['user']);
    $stmt->execute();
    if ($stmt->rowCount() > 0) {
      $stmt = $obj->deleteFav($id, $_SESSION['user']);
      $stmt->execute(); 
      $response = "deleted";
    }
    else {
      $stmt = $obj->selectDataWithId($id, "musicTable");
      $stmt->execute(); 
      while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $obj->insertFavourites($id, $row["title"], $row["audioPath"], $row["imgPath"], $_SESSION['user']);
        $response = "added";
      }
    }
    header('Content-Type: application/json');
    echo json_encode($response);
  }
  catch(PDOException $e)  {
    echo "Error: " . $e->getMessage();
  }
  $conn = NULL;
?>
