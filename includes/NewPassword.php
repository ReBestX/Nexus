<?php
include "db.php";
session_start();
if (isset($_SESSION['username'])) {
  header("location: ../index");
  exit;
}
session_regenerate_id();
if (isset($_POST['submit'])) {
  $password = mysqli_real_escape_string($connection, trim($_POST['password']));
  $password = htmlspecialchars($password);

  $cPassword = mysqli_real_escape_string($connection, trim($_POST['cPassword']));
  $cPassword = htmlspecialchars($cPassword);

  $token = mysqli_real_escape_string($connection, trim($_POST['token']));
  $token = htmlspecialchars($token);

  if ($password !== $cPassword) {
    header("Location: ../dist/SetNewPassword/$token&error");
    exit;
  } else {
    $newPassword = password_hash($password, PASSWORD_BCRYPT);
    $sql = "UPDATE users SET user_password = '$newPassword' WHERE token = '$token'";
    $result = mysqli_query($connection, $sql);

    // Add the following code to delete the token from the user's record
    if ($result) {
      $deleteTokenSql = "UPDATE users SET token = NULL WHERE token = '$token'";
      mysqli_query($connection, $deleteTokenSql);

      header("Location: ../dist/sign-in/success2");
      exit;
    } else {
      header("Location: ../dist/sign-in/error4");
      exit;
    }
  }
}
?>