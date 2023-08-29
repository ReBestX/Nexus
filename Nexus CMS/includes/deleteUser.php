<?php
include "db.php";
session_start();
if (!isset($_SESSION['username'])) {
  header("Location: ../../dist/sign-in/");
  exit;
}
if (isset($_SESSION['user_role']) && $_SESSION['user_role'] != 'admin') {
  header("Location: ../../dist/index");
  exit;
}
if (isset($_GET['delete']) && !empty(trim($_GET["delete"]))) {
  $id = $_GET['delete'];
  $id = mysqli_real_escape_string($connection, trim($id));
  $id = filter_var($id, FILTER_SANITIZE_NUMBER_INT);

  // Fetch the user's username using the user_id
  $query1 = "SELECT * FROM users WHERE user_id = {$id}";
  $result1 = mysqli_query($connection, $query1);
  if (!$result1) {
    // Handle query error if necessary
    header("Location: ../../dist/404page");
    exit;
  }
  $row1 = mysqli_fetch_assoc($result1);
  $user_username = $row1['user_username'];

  // Delete the user's posts comments
  $query5 = "SELECT * FROM posts WHERE post_author = {$id}";
  $delete_query5 = mysqli_query($connection, $query5);
  while ($row = mysqli_fetch_assoc($delete_query5)) {
    $post_id = $row['post_id'];
    $query6 = "DELETE FROM comments WHERE comment_post_id = {$post_id}";
    $delete_query6 = mysqli_query($connection, $query6);
  }

  // Delete the user's posts
  $query2 = "DELETE FROM posts WHERE post_author = {$id}";
  $delete_query2 = mysqli_query($connection, $query2);

  /* Delete the users likes */
  $query7 = "DELETE FROM likes WHERE user_id = {$id}";
  $delete_query7 = mysqli_query($connection, $query7);

  // Delete the user's comments
  $query3 = "DELETE FROM comments WHERE comment_author = '{$user_username}'";
  $delete_query3 = mysqli_query($connection, $query3);

  // Delete the user
  $query4 = "DELETE FROM users WHERE user_id = {$id}";
  $delete_query4 = mysqli_query($connection, $query4);

  header("Location: ../dist/users.php");
  exit;
}
?>
