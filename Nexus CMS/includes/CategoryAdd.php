<?php include "db.php";
session_start();
if (!isset($_SESSION['username'])) {
  header("Location: ../../dist/sign-in/");
  exit;
}
if(isset($_SESSION['user_role'])){
  if($_SESSION['user_role'] != 'admin'){
    header("Location: ../../dist/index");
    exit;
  }
}
if(isset($_POST['submit'])){
    $CategoryName = $_POST['CategoryName'];
    $CategoryName = mysqli_real_escape_string($connection, trim($_POST['CategoryName']));
    $CategoryName = htmlspecialchars($CategoryName);
    $sql2 = "SELECT * From categories";
    $CategoryName = mysqli_real_escape_string($connection, trim($CategoryName));
    $result2 = mysqli_query($connection, $sql2);
    $arr = array();
    while($row = mysqli_fetch_assoc($result2)){
      array_push($arr,$row);
    }
    if($CategoryName != "" && !empty($CategoryName) && trim($CategoryName) != ""){
      for($i=0;$i<count($arr);$i++){
        if(strtolower($arr[$i]['cat_title']) == strtolower($CategoryName)){
          header("Location: ../dist/Categories.php?error=Category Already Exists");
          exit;
        }
      }
      $sql = "INSERT INTO categories (cat_title) VALUES ('$CategoryName')";
      $result = mysqli_query($connection, $sql);
    }
    header("Location: ../dist/Categories.php");
    exit;
}
?>