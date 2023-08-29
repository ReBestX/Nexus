<?php include "db.php";
session_start();
if(isset($_SESSION['username'])){
  header("location: ../dist/index");
  exit;
}
if(isset($_POST['submit'])){
  if (isset($_POST['checkbox'])) {
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    $username = strtolower($username);
    $email = strtolower($email);
    function createUsernameWithoutSpaces($inputString) {
      // Replace spaces with an empty string
      $username = str_replace(' ', '', $inputString);
      return $username;
    }
    $username = createUsernameWithoutSpaces($username);

    $firstname = mysqli_real_escape_string($connection, trim($firstname));
    $firstname = htmlspecialchars($firstname);

    $lastname = mysqli_real_escape_string($connection, trim($lastname));
    $lastname = htmlspecialchars($lastname);

    $username = mysqli_real_escape_string($connection, trim($username));
    $username = htmlspecialchars($username);

    $email = mysqli_real_escape_string($connection, trim($email));
    $email = filter_var($email, FILTER_SANITIZE_EMAIL);

    $password = mysqli_real_escape_string($connection, trim($password));
    $password = htmlspecialchars($password);

    $confirm_password = mysqli_real_escape_string($connection, trim($confirm_password));
    $confirm_password = htmlspecialchars($confirm_password);

    // Validate input data
    if(empty($firstname) || empty($lastname) || empty($username) || empty($email) || empty($password) || empty($confirm_password)){
      header("Location: ../dist/sign-up/error");
      exit;
    }
    if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
      header("Location: ../dist/sign-up/error2");
      exit;
    }
    if($password == $confirm_password){
      $query = "SELECT * FROM users WHERE user_username = '{$username}' ";
      $select_user_query = mysqli_query($connection, $query);
      if(mysqli_num_rows($select_user_query) > 0){
        header("Location: ../dist/sign-up/error3");
        exit;
      }
      $query2 = "SELECT * FROM users WHERE user_email = '{$email}' ";
      $select_user_query2 = mysqli_query($connection, $query2);
      if(mysqli_num_rows($select_user_query2) > 0){
        header("Location: ../dist/sign-up/error4");
        exit;
      }
      $password = password_hash($password, PASSWORD_DEFAULT);
      $date = date("Y-m-d");
      $query = "INSERT INTO users (user_firstname, user_lastname, user_username, user_email, user_password, user_role, user_CreateDate , user_image) ";
      $query .= "VALUES ('{$firstname}', '{$lastname}', '{$username}', '{$email}', '{$password}', 'user' , '{$date}' , 'user.png') ";
      $register_user_query = mysqli_query($connection, $query);
      if(!$register_user_query){
        header("Location: ../dist/404page");
        exit;
      }
      header("Location: ../dist/sign-in/success");
      exit;
    }else{
      header("Location: ../dist/sign-up/error5");
      exit;
    }
    }else {
      header("Location: ../dist/sign-up/error6");
      exit;
    }
  }
?>