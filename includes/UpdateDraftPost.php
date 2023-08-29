<?php
include "db.php";
session_start();
if (!isset($_SESSION['username'])) {
  header("Location: ../dist/sign-in.php");
  exit;
}
if (isset($_POST["submit"])) {
  $cat_id = $_POST["cat_id"];
  $cat_id = mysqli_real_escape_string($connection, trim($cat_id));
  $cat_id = filter_var($cat_id, FILTER_SANITIZE_NUMBER_INT);
    $query = "SELECT * FROM posts WHERE post_id = $cat_id";
    $result = mysqli_query($connection, $query);
    if (!$result) {
      header("Location: ../dist/404page");
      exit;
    }
    $row2 = mysqli_fetch_assoc($result);
    $post_author = $row2['post_author'];
    if($post_author != $_SESSION['id']){
      header("Location: index");
      exit;
    }
  $title = $_POST["title"];
  $title = mysqli_real_escape_string($connection, trim($title));
  $title = htmlspecialchars($title);

  $category = $_POST["category"];
  $category = mysqli_real_escape_string($connection, trim($category));
  $category = htmlspecialchars($category);

  $tags = $_POST["tags"];
  $tags = mysqli_real_escape_string($connection, trim($tags));
  $tags = htmlspecialchars($tags);

  $content = $_POST["content"];
  $content = mysqli_real_escape_string($connection, trim($content));
  $content = htmlspecialchars($content);

  if(isset($_FILES["my_image"]) && $_FILES["my_image"]["error"] === 0){
    $post_image = $_FILES["my_image"]["name"];
    $post_image_size = $_FILES["my_image"]["size"];
    $post_image_temp = $_FILES["my_image"]["tmp_name"];

    if ($post_image_size > 1000000) {
      $em = 'Sorry, your file is too large.';
      header("Location: ../dist/ProfileDraftPosts/error1");
      exit;
    }

    $img_ex = pathinfo($post_image, PATHINFO_EXTENSION);
    $img_ex_lc = strtolower($img_ex);
    $allowed_exs = array("jpg", "jpeg", "png");

    if (!in_array($img_ex_lc, $allowed_exs)) {
      header("Location: ../dist/ProfileDraftPosts/error2");
      exit;
    }

    $new_img_name = uniqid("IMG-", true) . '.' . $img_ex_lc;
    $img_upload_path = '../Nexus CMS//Uploaded_images/' . $new_img_name;
    if (move_uploaded_file($post_image_temp, $img_upload_path)) {
      $post_image = $new_img_name;
    } else {
      $em = 'Failed to upload the file. Please try again.';
      header("Location: ../dist/ProfileDraftPosts/error3");
      exit;
    }
  } else {
    $sql = "SELECT * FROM posts WHERE post_id = $cat_id";
    $result = mysqli_query($connection, $sql);
    $row = mysqli_fetch_assoc($result);
    $post_image = $row["post_image"];
  }

  $query = "UPDATE posts SET post_title = '{$title}', post_category = '{$category}', post_tags = '{$tags}', post_image = '{$post_image}', post_content = '{$content}' WHERE post_id = $cat_id";

  $result = mysqli_query($connection, $query);
  if (!$result) {
    header("Location: ../dist/404page");
    exit;
  }
  header("Location: ../dist/ProfileDraftPosts/success");
  exit;
}
?>
