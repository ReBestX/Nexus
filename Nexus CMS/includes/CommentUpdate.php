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
if (isset($_POST['submit'])) {
  $comment_id = $_POST['comment_id'];
  $comment_author = $_POST['author'];
  $comment_email = $_POST['email'];
  $comment_content = $_POST['content'];

  $comment_id = mysqli_real_escape_string($connection, trim($comment_id));
  $comment_id = filter_var($comment_id, FILTER_SANITIZE_NUMBER_INT);

  $comment_author = mysqli_real_escape_string($connection, trim($comment_author));
  $comment_author = htmlspecialchars($comment_author);

  $comment_email = mysqli_real_escape_string($connection, trim($comment_email));
  $comment_email = filter_var($comment_email, FILTER_SANITIZE_EMAIL);

  $comment_content = mysqli_real_escape_string($connection, trim($comment_content));
  $comment_content = htmlspecialchars($comment_content);

  $query = "UPDATE comments SET ";
  $query .= "comment_author = '{$comment_author}', ";
  $query .= "comment_email = '{$comment_email}', ";
  $query .= "comment_content = '{$comment_content}' ";
  $query .= "WHERE comment_id = {$comment_id} ";
  $update_comment = mysqli_query($connection, $query);
  if (!$update_comment) {
    header("Location: ../../dist/404page");
    exit;
  }
  header("Location: ../dist/comments.php");
  exit;
}
?>