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
  $comment_id = $_GET['delete'];
  $comment_id = mysqli_real_escape_string($connection, trim($_GET['delete']));
  $comment_id = filter_var($comment_id, FILTER_SANITIZE_NUMBER_INT);

  $query = "DELETE FROM comments WHERE comment_id = {$comment_id}";
  $result = mysqli_query($connection, $query);
  if(!$result){
    header("Location: ../../dist/404page");
    exit;
  }
  /* Remove 1 form post comment count */
  if(isset($_GET['post']) && !empty(trim($_GET["post"]))){
    $post_id = $_GET['post'];
    $post_id = mysqli_real_escape_string($connection, trim($_GET['post']));
    $post_id = filter_var($post_id, FILTER_SANITIZE_NUMBER_INT);
    $query2 = "UPDATE posts SET post_comment_count = post_comment_count - 1 ";
    $query2 .= "WHERE post_id = {$post_id}";
    $result2 = mysqli_query($connection, $query2);
    if(!$result2){
      header("Location: ../../dist/404page");
      exit;
    }
  }
  header("Location: ../dist/comments.php");
  exit;
}
?>