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
if(isset($_GET['delete']) && !empty(trim($_GET["delete"]))){
  $id = $_GET['delete'];
  $id = mysqli_real_escape_string($connection, trim($_GET['delete']));
  $id = filter_var($id, FILTER_SANITIZE_NUMBER_INT);
  $query = "DELETE FROM categories WHERE cat_id = {$id}";
  $result = mysqli_query($connection, $query);
  if(!$result){
    header("Location: ../../dist/404page");
    exit;
  }
  header("Location: ../dist/Categories.php");
  exit;
}
?>