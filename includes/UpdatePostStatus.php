<?php
include "db.php";
session_start();

if (!isset($_SESSION['username'])) {
  header("Location: ../dist/sign-in");
  exit;
}

if (isset($_GET['id']) && !empty(trim($_GET['id']))) {
  $post_id = $_GET['id'];
  $post_id = mysqli_real_escape_string($connection, trim($_GET['id']));
  $post_id = filter_var($post_id, FILTER_SANITIZE_NUMBER_INT);

  $query = "SELECT * FROM posts WHERE post_id = $post_id";
  $result2 = mysqli_query($connection, $query);

  if (!$result2) {
    header("Location: ../dist/404page");
    exit;
  }

  $row2 = mysqli_fetch_assoc($result2);
  $post_author = $row2['post_author'];

  if ($post_author != $_SESSION['id']) {
    header("Location: ../dist/index");
    exit;
  }

  $sql = "UPDATE posts SET post_status = 'published' WHERE post_id= '{$post_id}'";
  $result = mysqli_query($connection, $sql);

  if (!$result) {
    header("Location: ../dist/404page");
    exit;
  }

  header("Location: ../dist/Profile/{$_SESSION['id']}&success");
  exit;
}
?>
