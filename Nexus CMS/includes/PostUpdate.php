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
if (isset($_POST["submit"])) {
  $cat_id = $_POST["cat_id"];
  $title = $_POST["title"];
  $author = $_POST["author"];
  $category = $_POST["category"];
  $status = $_POST["status"];
  $tags = $_POST["tags"];
  $content = $_POST["content"];

  // Escape values to prevent SQL injection
  $cat_id = mysqli_real_escape_string($connection, trim($cat_id));
  $cat_id = filter_var($cat_id, FILTER_SANITIZE_NUMBER_INT);

  $title = mysqli_real_escape_string($connection, trim($title));
  $title = htmlspecialchars($title);

  $author = mysqli_real_escape_string($connection, trim($author));
  $author = filter_var($author, FILTER_SANITIZE_NUMBER_INT);

  $category = mysqli_real_escape_string($connection, trim($category));
  $category = filter_var($category, FILTER_SANITIZE_NUMBER_INT);

  $status = mysqli_real_escape_string($connection, trim($status));
  $status = htmlspecialchars($status);

  $tags = mysqli_real_escape_string($connection, trim($tags));
  $tags = htmlspecialchars($tags);

  $content = mysqli_real_escape_string($connection, trim($content));
  $content = htmlspecialchars($content);

  if(isset($_FILES["my_image"]) && $_FILES["my_image"]["error"] === 0){
    $post_image = $_FILES["my_image"]["name"];
    $post_image_size = $_FILES["my_image"]["size"];
    $post_image_temp = $_FILES["my_image"]["tmp_name"];

    if ($post_image_size > 1000000) {
      $em = 'Sorry, your file is too large.';
      header("Location: ../dist/Posts.php?error=$em");
      exit;
    }

    $img_ex = pathinfo($post_image, PATHINFO_EXTENSION);
    $img_ex_lc = strtolower($img_ex);
    $allowed_exs = array("jpg", "jpeg", "png");

    if (!in_array($img_ex_lc, $allowed_exs)) {
      $em = 'You can\'t upload files of this type';
      header("Location: ../dist/Posts.php?error=$em");
      exit;
    }

    $new_img_name = uniqid("IMG-", true) . '.' . $img_ex_lc;
    $img_upload_path = '../Uploaded_images/' . $new_img_name;
    if (move_uploaded_file($post_image_temp, $img_upload_path)) {
      $post_image = $new_img_name;
    } else {
      $em = 'Failed to upload the file. Please try again.';
      header("Location: ../dist/Posts.php?error=$em");
      exit;
    }
  } else {
    $sql = "SELECT * FROM posts WHERE post_id = $cat_id";
    $result = mysqli_query($connection, $sql);
    $row = mysqli_fetch_assoc($result);
    $post_image = $row["post_image"];
  }

  $query = "UPDATE posts SET post_title = '{$title}', post_author = '{$author}', post_category = '{$category}', post_status = '{$status}', post_tags = '{$tags}', post_image = '{$post_image}', post_content = '{$content}' WHERE post_id = $cat_id";

  $result = mysqli_query($connection, $query);
  if (!$result) {
    header("Location: ../../dist/404page");
    exit;
  }
  header("Location: ../dist/Posts.php");
  exit;
}
?>
