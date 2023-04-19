<?php 
session_start();
  try {
    $oldEmail = $_POST['oldEmail'];
    $newEmail = $_POST['newEmail'];
    $phone = $_POST['phone'];
    $genre = implode(',', $_POST['genreUpdate']);
    include "class/Methods.php";
    $obj = new Methods();
    $stmt = $obj->updateData($oldEmail, $newEmail, $phone, $genre);
    if ($stmt->execute()) {
      echo "Profile updated successfully.";
    }
    else {
      echo "No";
    }
  }
  catch(PDOException $e)  {
    echo "Error: " . $e->getMessage();
  }
  $conn = NULL;
?>
