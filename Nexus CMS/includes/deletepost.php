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
if (isset($_GET['delete']) && !empty(trim($_GET["delete"]))) {
  $the_post_id = $_GET['delete'];
  $the_post_id = mysqli_real_escape_string($connection, trim($_GET['delete']));
  $the_post_id = filter_var($the_post_id, FILTER_SANITIZE_NUMBER_INT);
  /* Delete posts comments */
  $query = "DELETE FROM comments WHERE comment_post_id = {$the_post_id}";
  $delete_query = mysqli_query($connection, $query);
  /* Delete posts likes */
  $query = "DELETE FROM likes WHERE post_id = {$the_post_id}";
  $delete_query = mysqli_query($connection, $query);
  /* Delete posts */
  $query = "DELETE FROM posts WHERE post_id = {$the_post_id}";
  $delete_query = mysqli_query($connection, $query);
  header("Location: ../dist/posts.php");
  exit;
}
?>