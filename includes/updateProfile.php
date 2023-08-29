<?php include "db.php";
session_start();
if (!isset($_SESSION['username'])) {
  header("Location: ../dist/sign-in.php");
  exit;
}
session_regenerate_id();
if (isset($_POST["submit"])) {
  $user_id = $_POST["user_id"];
  if($user_id === $_SESSION['id']){
    $user_firstName = $_POST["firstName"];
    $user_lastName = $_POST["lastName"];
    $user_Username = $_POST["Username"];
    $user_email = $_POST["email"];

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

    $sql2 = "SELECT * FROM users";
    $result2 = mysqli_query($connection, $sql2);
    while ($row = mysqli_fetch_assoc($result2)) {
      $Username = $row['user_username'];
      $id = $row['user_id'];
      if($user_id == $id){
        continue;
      }
      if($user_Username == $Username){
        header("Location: ../dist/EditProfile/error1");
        exit;
      }
    }
    $sql3 = "SELECT * FROM users";
    $result3 = mysqli_query($connection, $sql3);
    while ($row = mysqli_fetch_assoc($result3)) {
      $email = $row['user_email'];
      $id = $row['user_id'];
      if($user_id == $id){
        continue;
      }
      if($user_email == $email){
        $em = 'Email already exists';
        header("Location: ../dist/EditProfile/error2");
        exit;
      }
    }

    if(isset($_FILES["my_image"]) && $_FILES["my_image"]["error"] === 0){
      $user_image = $_FILES["my_image"]["name"];
      $user_image_size = $_FILES["my_image"]["size"];
      $user_image_temp = $_FILES["my_image"]["tmp_name"];

      if ($user_image_size > 1000000) {
        header("Location: ../dist/EditProfile/error3");
        exit;
      }

      $img_ex = pathinfo($user_image, PATHINFO_EXTENSION);
      $img_ex_lc = strtolower($img_ex);
      $allowed_exs = array("jpg", "jpeg", "png");

      if (!in_array($img_ex_lc, $allowed_exs)) {
        header("Location: ../dist/EditProfile/error4");
        exit;
      }
      list($width,$height) = getimagesize($user_image_temp);
      if($width !== $height){
        header("Location: ../dist/EditProfile/error6");
        exit;
      }
      $new_img_name = uniqid("IMG-", true) . '.' . $img_ex_lc;
      $img_upload_path = '../Nexus CMS//Uploaded_images/' . $new_img_name;
      move_uploaded_file($user_image_temp, $img_upload_path);
      $user_image = $new_img_name;
    } else {
      $sql = "SELECT * From users WHERE user_id = $user_id";
      $result = mysqli_query($connection, $sql);
      $row = mysqli_fetch_assoc($result);
      $user_image = $row["user_image"];
    }

    $query = "UPDATE users SET user_firstname = '{$user_firstName}', user_lastname = '{$user_lastName}', user_username = '{$user_Username}', user_email = '{$user_email}', user_image = '{$user_image}' WHERE user_id = $user_id";

    $result = mysqli_query($connection, $query);
    if (!$result) {
      header("Location: ../dist/404page.php");
      exit;
    }
    $_SESSION['firstname'] = $user_firstName;
    $_SESSION['lastname'] = $user_lastName;
    $_SESSION['username'] = $user_Username;
    $_SESSION['email'] = $user_email;
    $_SESSION['user_image'] = $user_image;

    header("Location: ../dist/Profile/{$_SESSION['id']}&success2");
    exit;
  }else{
    header("Location: ../dist/EditProfile/error5");
    exit;
  }
}
?>