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
  $user_firstName = $_POST["firstName"];
  $user_lastName = $_POST["lastName"];
  $user_Username = $_POST["Username"];
  $user_email = $_POST["email"];
  $user_password = $_POST["Password"];
  $user_role = $_POST["role"];
  $date = date("Y-m-d");

  $user_Username = strtolower($user_Username);
  $user_email = strtolower($user_email);
  function createUsernameWithoutSpaces($inputString) {
    // Replace spaces with an empty string
    $username = str_replace(' ', '', $inputString);
    return $username;
  }
  $user_Username = createUsernameWithoutSpaces($user_Username);
  // Escape values to prevent SQL injection

  $user_firstName = mysqli_real_escape_string($connection, trim($user_firstName));
  $user_firstName = htmlspecialchars($user_firstName);

  $user_lastName = mysqli_real_escape_string($connection, trim($user_lastName));
  $user_lastName = htmlspecialchars($user_lastName);

  $user_Username = mysqli_real_escape_string($connection, trim($user_Username));
  $user_Username = htmlspecialchars($user_Username);

  $user_email = mysqli_real_escape_string($connection, trim($user_email));
  $user_email = filter_var($user_email, FILTER_SANITIZE_EMAIL);

  $user_password = mysqli_real_escape_string($connection, trim($user_password));
  $user_password = htmlspecialchars($user_password);
  $user_password = password_hash($user_password, PASSWORD_DEFAULT);

  $user_role = mysqli_real_escape_string($connection, trim($user_role));
  $user_role = htmlspecialchars($user_role);

  $sql2 = "SELECT * FROM users";
  $result2 = mysqli_query($connection, $sql2);
  while ($row = mysqli_fetch_assoc($result2)) {
    $Username = $row['user_username'];
    if($user_Username == $Username){
      $em = 'Username already exists';
      header("Location: ../dist/UserAdd.php?error=$em");
      exit;
    }
  }
  $sql3 = "SELECT * FROM users";
  $result3 = mysqli_query($connection, $sql3);
  while ($row = mysqli_fetch_assoc($result3)) {
    $email = $row['user_email'];
    if($user_email == $email){
      $em = 'Email already exists';
      header("Location: ../dist/UserAdd.php?error=$em");
      exit;
    }
  }

  if(isset($_FILES["my_image"]) && $_FILES["my_image"]["error"] === 0){
    $user_image = $_FILES["my_image"]["name"];
    $user_image_size = $_FILES["my_image"]["size"];
    $user_image_temp = $_FILES["my_image"]["tmp_name"];

    if ($user_image_size > 1000000) {
      $em = 'Sorry, your file is too large.';
      header("Location: ../dist/UserAdd.php?error=$em");
      exit;
    }

    $img_ex = pathinfo($user_image, PATHINFO_EXTENSION);
    $img_ex_lc = strtolower($img_ex);
    $allowed_exs = array("jpg", "jpeg", "png");

    if (!in_array($img_ex_lc, $allowed_exs)) {
      $em = 'You can\'t upload files of this type';
      header("Location: ../dist/UserAdd.php?error=$em");
      exit;
    }

    $new_img_name = uniqid("IMG-", true) . '.' . $img_ex_lc;
    $img_upload_path = '../Uploaded_images/' . $new_img_name;
    move_uploaded_file($user_image_temp, $img_upload_path);
    $user_image = $new_img_name;
  } else {
    $user_image = "user.png"; // Set default image if no image is uploaded
  }

  $query = "INSERT INTO users (user_username, user_password, user_firstname, user_lastname, user_email, user_image, user_role, user_CreateDate)
            VALUES ('$user_Username', '$user_password', '$user_firstName', '$user_lastName', '$user_email', '$user_image', '$user_role', '$date')";

  $result = mysqli_query($connection, $query);
  if (!$result) {
    header("Location: ../../dist/404page");
    exit;
  }
  header("Location: ../dist/users.php");
  exit;
}
?>