<?php
include "db.php";

if (isset($_POST['check'])) {
  $id = $_POST['post_id'];
  $id = mysqli_real_escape_string($connection, trim($id));
  $id = filter_var($id, FILTER_SANITIZE_NUMBER_INT);

  $user_id = $_POST['user_id'];
  $user_id = mysqli_real_escape_string($connection, trim($user_id));
  $user_id = filter_var($user_id, FILTER_SANITIZE_NUMBER_INT);

  $check = $_POST['check'];
  $check = mysqli_real_escape_string($connection, trim($check));
  $check = htmlspecialchars($check);

  $likeQuery = "SELECT * FROM posts WHERE post_id = '{$id}'";
  $result = mysqli_query($connection, $likeQuery);
  $row = mysqli_fetch_array($result);
  $likes = $row['post_likes'];
  
  $UserQuery = "SELECT * FROM likes WHERE post_id = '{$id}' AND user_id = '{$user_id}'";
  $UserResult = mysqli_query($connection, $UserQuery);
  $UserCount = mysqli_num_rows($UserResult);
  
  // If the like button is clicked and there's no record of that click in DB then insert
  if ($check == "on" && $UserCount == 0) {
    mysqli_query($connection, "UPDATE posts SET post_likes = $likes + 1 WHERE post_id = $id");
    mysqli_query($connection, "INSERT INTO likes (user_id, post_id) VALUES ('{$user_id}', '{$id}')");
  } else if ($check == "off" && $UserCount > 0) {
    mysqli_query($connection, "UPDATE posts SET post_likes = $likes - 1 WHERE post_id = $id");
    mysqli_query($connection, "DELETE FROM likes WHERE user_id = '{$user_id}' AND post_id = '{$id}'");
  }
  $sql = "SELECT * FROM posts WHERE post_id = $id";
  $result = mysqli_query($connection, $sql);
  $row = mysqli_fetch_assoc($result);

  $likes = intval($row['post_likes']); // Convert to integer
  echo $likes;
}
?>