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
if(isset($_POST['submit'])){
    $id = $_POST['user_id'];
    $id = mysqli_real_escape_string($connection, trim($id));
    $id = filter_var($id, FILTER_SANITIZE_NUMBER_INT);

    $password = $_POST['Password'];
    $password = mysqli_real_escape_string($connection, trim($password));
    $password = htmlspecialchars($password);

    $password2 = $_POST['ConfirmPassword'];
    $password2 = mysqli_real_escape_string($connection, trim($password2));
    $password2 = htmlspecialchars($password2);

    if($password == $password2){
        $password = password_hash($password, PASSWORD_DEFAULT);
        $sql = "UPDATE users SET user_password = '$password' WHERE user_id = '$id'";
        $result = mysqli_query($connection, $sql);
        if($result){
            header("location: ../dist/users.php");
            exit;
        }else{
            header("location: ../dist/ChangePassword.php?error=Something went wrong");
            exit;
        }
    }else{
        header("location: ../dist/ChangePassword.php?error=Password not match");
        exit;
    }
}
?>