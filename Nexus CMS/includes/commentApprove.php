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
if (isset($_GET['id']) && !empty(trim($_GET["id"]))) {
    $the_comment_id = $_GET['id'];
    $the_comment_id = mysqli_real_escape_string($connection, trim($_GET['id']));
    $the_comment_id = filter_var($the_comment_id, FILTER_SANITIZE_NUMBER_INT);
    $query = "UPDATE comments SET comment_status = 'approved' WHERE comment_id = $the_comment_id";
    $approve_comment_query = mysqli_query($connection, $query);
    header("Location: ../dist/comments.php");
    exit;
}
?>