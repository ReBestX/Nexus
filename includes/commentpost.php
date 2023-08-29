<?php include "../includes/db.php";
  if(isset($_POST['submit'])){
    $id = $_POST['post_id'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $comment = $_POST['comment'];

    $id = mysqli_real_escape_string($connection, trim($id));
    $id = filter_var($id, FILTER_SANITIZE_NUMBER_INT);

    $name = mysqli_real_escape_string($connection, trim($name));
    $name = htmlspecialchars($name);

    $email = mysqli_real_escape_string($connection, trim($email));
    $email = filter_var($email, FILTER_SANITIZE_EMAIL);

    $comment = mysqli_real_escape_string($connection, trim($comment));
    $comment = htmlspecialchars($comment);

    $sql = "INSERT INTO comments (comment_post_id, comment_author, comment_email, comment_content, comment_status, comment_date) VALUES ('$id', '$name', '$email', '$comment', 'unapproved', now())";
    $result = mysqli_query($connection, $sql);
    if(!$result){
      header("Location: ../dist/404page");
      exit;
    }
    $sql = "UPDATE posts SET post_comment_count = post_comment_count + 1 WHERE post_id = '$id'";
    $result = mysqli_query($connection, $sql);
    if(!$result){
      header("Location: ../dist/404page");
      exit;
    }
    header("Location: ../dist/post/{$id}&success");
    exit;
  }
?>