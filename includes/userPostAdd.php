<?php include "db.php";
session_start();
if (!isset($_SESSION['username'])) {
  header("Location: ../dist/sign-in");
  exit;
}
if (isset($_POST["submit"]) && isset($_FILES["my_image"]) && isset($_SESSION['username'])) {
  $post_category = $_POST["category"];
  $post_title = $_POST["title"];
  $post_author_id = $_SESSION['id'];
  $date = date("Y-m-d");
  $post_content = $_POST["content"];
  $post_tags = $_POST["tags"];
  $post_status = $_POST["status"];

  // Handle file upload
  $post_image = $_FILES["my_image"]["name"];
  $post_image_size = $_FILES["my_image"]["size"];
  $post_image_temp = $_FILES["my_image"]["tmp_name"];
  $error = $_FILES["my_image"]["error"];

  if ($error === 0) {
    if ($post_image_size > 1000000) {
      header("Location: ../dist/create-post/error1");
      exit;
    } else {
      $img_ex = pathinfo($post_image, PATHINFO_EXTENSION);
      $img_ex_lc = strtolower($img_ex);
      $allowed_exs = array("jpg", "jpeg", "png");

      if (in_array($img_ex_lc, $allowed_exs)) {
        $new_img_name = uniqid("IMG-", true) . '.' . $img_ex_lc;
        $img_upload_path = '../Nexus CMS//Uploaded_images/' . $new_img_name;
        move_uploaded_file($post_image_temp, $img_upload_path);
        $post_image = $new_img_name;

        // Escape values to prevent SQL injection
        $post_category = mysqli_real_escape_string($connection, trim($post_category));
        $post_category = filter_var($post_category, FILTER_SANITIZE_NUMBER_INT);

        $post_title = mysqli_real_escape_string($connection, trim($post_title));
        $post_title = htmlspecialchars($post_title);

        $post_author_id = mysqli_real_escape_string($connection, trim($post_author_id));
        $post_author_id = filter_var($post_author_id, FILTER_SANITIZE_NUMBER_INT);

        $post_content = mysqli_real_escape_string($connection, trim($post_content));
        $post_content = htmlspecialchars($post_content);

        $post_tags = mysqli_real_escape_string($connection, trim($post_tags));
        $post_tags = htmlspecialchars($post_tags);

        $post_status = mysqli_real_escape_string($connection, trim($post_status));
        $post_status = htmlspecialchars($post_status);

        $query = "INSERT INTO posts (post_category, post_title, post_author, post_date, post_image, post_content, post_tags, post_comment_count, post_status)
                  VALUES ('$post_category', '$post_title', '$post_author_id', '$date', '$post_image', '$post_content', '$post_tags', '0', '$post_status')";

        $result = mysqli_query($connection, $query);
        if (!$result) {
          header("Location: ../dist/404page");
          exit;
        }
        header("Location: ../dist/create-post/success");
        exit;
      } else {
        header("Location: ../dist/create-post/error2");
        exit;
      }
    }
  } else {
    header("Location: ../dist/create-post/error3");
    exit;
  }
}
?>
