<?php include "db.php";
session_start();
if (!isset($_SESSION['username'])) {
  header("Location: ../dist/sign-in");
  exit;
}
session_regenerate_id();
if(isset($_POST['submit'])){
  $user_id = $_SESSION['id'];
  $CurrentPassword = $_POST['PrePassword'];
  $CurrentPassword = mysqli_real_escape_string($connection, $CurrentPassword);
  $query = "SELECT * FROM users WHERE user_id = $user_id";
  $result = mysqli_query($connection, $query);
  if (!$result) {
    header("Location: ../dist/404page");
    exit;
  }
  $row = mysqli_fetch_assoc($result);
  $Password = $row['user_password'];
  if(password_verify($CurrentPassword, $Password)){
    $Password = $_POST['Password'];
    $ConfirmPassword = $_POST['ConfirmPassword'];

    $Password = mysqli_real_escape_string($connection, trim($Password));
    $Password = htmlspecialchars($Password);

    $ConfirmPassword = mysqli_real_escape_string($connection, trim($ConfirmPassword));
    $ConfirmPassword = htmlspecialchars($ConfirmPassword);

    if($Password !== $ConfirmPassword){
      header("Location: ../dist/EditPassword/error1");
      exit;
    }
    $Password = password_hash($Password, PASSWORD_DEFAULT);
    $query = "UPDATE users SET user_password = '{$Password}' WHERE user_id = $user_id";
    $result = mysqli_query($connection, $query);
    if (!$result) {
      header("Location: ../dist/404page");
      exit;
    }
    header("Location: ../dist/Profile/{$_SESSION['id']}&success3");
    exit;
  }else{
    header("Location: ../dist/EditPassword/error2");
    exit;
  }
}
?>