<?php 
session_start();
$limit = 3;
if (isset($_POST['pageNo'])) {
  $offset = $_POST['pageNo'];
}
else {
  $offset = 0;
}
include "class/Methods.php";
$obj = new Methods();
$stmt = $obj->pagination($offset, $limit);
$stmt->execute();
// Selecting id column from favourite tables to check whether song exists in favTable.
$stmt1 = $obj->selectFavId();
$stmt1->execute();
$res = $stmt1->fetchAll();
$arr = [];
foreach ($res as $item) {
  $arr[] = $item['id'];
}

$output= "";
  if ($stmt->rowCount() > 0) {
    $output .= "<div class='playList'>";
      while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $lastId = $row["id"]; 
        $output .=
        "<div class='music'>
          <div class='item'>
            <img src='{$row["imgPath"]}' alt='image' height='200px'>
            <p> {$row["title"]}</p>";
            if (in_array($row["id"],$arr) && $obj->checkUserIdFav($row["id"])) {
              $output .= "<a onclick='addFav({$row["id"]})' id='{$row["id"]}'>
                <i class='fa-solid fa-heart fill-red'></i>
              </a>";
            }
            else {
              $output .= "<a onclick='addFav({$row["id"]})' id='{$row["id"]}'>
                <i class='fa-solid fa-heart'></i>
              </a>";
            }
            $output .= "<audio controls>
              <source src='{$row["audioPath"]}' type='audio/mpeg'>
            </audio>
          </div>
        </div>";
      }
      $output .= "</div>";
    $output.= "<div class='btn'><button class='loadMoreBtn' data-id='{$lastId}'>Load more</button></div>";
    echo $output;
  }
  else {
    echo "No more record";
  }
?>
