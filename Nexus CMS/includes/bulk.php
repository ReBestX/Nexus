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
if (isset($_POST['checkBoxArray'])) {
  foreach ($_POST['checkBoxArray'] as $checkBoxValue) {
    $bulk_options = $_POST['bulk_options'];
    switch ($bulk_options) {
      case 'published':
        $sql = "UPDATE posts SET post_status = '{$bulk_options}' WHERE post_id = {$checkBoxValue}";
        $result = mysqli_query($connection, $sql);
        break;
      case 'draft':
        $sql = "UPDATE posts SET post_status = '{$bulk_options}' WHERE post_id = {$checkBoxValue}";
        $result = mysqli_query($connection, $sql);
        break;
      case 'delete':
        $query = "DELETE FROM comments WHERE comment_post_id = {$checkBoxValue}";
        $delete_query = mysqli_query($connection, $query);
        /* Delete posts likes */
        $query = "DELETE FROM likes WHERE post_id = {$checkBoxValue}";
        $delete_query = mysqli_query($connection, $query);
        /* Delete posts */
        $query = "DELETE FROM posts WHERE post_id = {$checkBoxValue}";
        $delete_query = mysqli_query($connection, $query);
        break;
      case 'clone':
        $sql = "SELECT * FROM posts WHERE post_id = {$checkBoxValue}";
        $result = mysqli_query($connection, $sql);
        while ($row = mysqli_fetch_assoc($result)) {
          $post_title = $row['post_title'];
          $post_category = $row['post_category'];
          $post_author = $row['post_author'];
          $post_date = $row['post_date'];
          $post_image = $row['post_image'];
          $post_content = $row['post_content'];
          $post_tags = $row['post_tags'];
          $post_status = $row['post_status'];
        }
        $sql = "INSERT INTO posts(post_category, post_title, post_author, post_date, post_image, post_content, post_tags, post_status) VALUES({$post_category}, '{$post_title}', '{$post_author}', now(), '{$post_image}', '{$post_content}', '{$post_tags}', '{$post_status}')";
        $result = mysqli_query($connection, $sql);
        break;
      default:
        break;
    }
  }
  header("Location: ../dist/Posts.php");
  exit;
}else{
  header("Location: ../dist/Posts.php");
  exit;
}
?>