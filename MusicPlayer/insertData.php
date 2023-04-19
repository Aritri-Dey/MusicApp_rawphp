<?php 
session_start();
  include "class/Methods.php";
  $obj = new Methods();
  $res = $obj->insertUserInfo();
  echo $res;
?>
