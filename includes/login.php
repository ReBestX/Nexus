<?php include "db.php";
session_start();
if(isset($_SESSION['username'])){
  header("location: ../dist/index");
  exit;
}
if(isset($_POST['submit'])){
  $username = $_POST['username'];
  $password = $_POST['password'];
  $username = strtolower($username);
  $username = mysqli_real_escape_string($connection, trim($username));
  $username = htmlspecialchars($username);
  $password = mysqli_real_escape_string($connection, trim($password));
  $password = htmlspecialchars($password);
  $query = "SELECT * FROM users WHERE user_username = '{$username}'";
  $select_user_query = mysqli_query($connection, $query);
  if(!$select_user_query){
    header("Location: ../dist/404page");
    exit;
  }
  if(mysqli_num_rows($select_user_query) > 0){
    while($row = mysqli_fetch_array($select_user_query)){
      $db_user_id = $row['user_id'];
      $db_username = $row['user_username'];
      $db_user_password = $row['user_password'];
      $db_user_firstname = $row['user_firstname'];
      $db_user_lastname = $row['user_lastname'];
      $db_user_email = $row['user_email'];
      $db_user_role = $row['user_role'];
      $db_user_image = $row['user_image'];
    }
    if(!password_verify($password,$db_user_password)){
      header("Location: ../dist/sign-in/error");
      exit;
    } else if($username == $db_username && password_verify($password,$db_user_password)){
      $_SESSION['id'] = $db_user_id;
      $_SESSION['username'] = $db_username;
      $_SESSION['firstname'] = $db_user_firstname;
      $_SESSION['lastname'] = $db_user_lastname;
      $_SESSION['email'] = $db_user_email;
      $_SESSION['user_role'] = $db_user_role;
      $_SESSION['user_image'] = $db_user_image;
      header("Location: ../dist/index");
      exit;
    }
  }else{
    header("Location: ../dist/sign-in/error2");
    exit;
  }
}
?>