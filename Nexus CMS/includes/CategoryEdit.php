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
if(isset($_POST["submit"])){
    $CategoryName = $_POST["CategoryName"];
    $cat_id = $_POST["cat_id"];

    $CategoryName = mysqli_real_escape_string($connection, trim($CategoryName));
    $CategoryName = htmlspecialchars($CategoryName);

    $cat_id = mysqli_real_escape_string($connection, trim($cat_id));
    $cat_id = filter_var($cat_id, FILTER_SANITIZE_NUMBER_INT);

    $sql2 = "SELECT * From categories";
    $result2 = mysqli_query($connection, $sql2);
    $arr = array();
    while($row = mysqli_fetch_assoc($result2)){
      array_push($arr,$row);
    }
    if($CategoryName != "" && !empty($CategoryName) && trim($CategoryName) != ""){
      for($i=0;$i<count($arr);$i++){
        if(strtolower($arr[$i]["cat_title"]) == strtolower($CategoryName)){
          header("Location: ../dist/Categories.php?error=Category Already Exists");
          exit;
        }
      }
      $sql = "UPDATE categories SET cat_title = '{$CategoryName}' WHERE cat_id = '{$cat_id}'";
      $result = mysqli_query($connection, $sql);
    }
    header("Location: ../dist/Categories.php");
    exit;
}
?>