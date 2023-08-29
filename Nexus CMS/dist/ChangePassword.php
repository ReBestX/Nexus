<?php session_start();
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
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Change Password</title>
    <link rel="icon" href="../images/NexusLogo.png" />
    <link rel="stylesheet" href="output.css" />
    <link rel="stylesheet" href="../src/EditPost.css" />
    <link rel="stylesheet" href="../src/all.min.css">
    <link
      href="https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css"
      rel="stylesheet"
    />
  </head>
  <body>
    <div class="sidebar">
      <div class="logo-details">
        <img class="logo1" src="../images/NexusLogo.png" alt="">
        <img class="logo2" src="../images/NexusLogo2 (5).png" alt="">
      </div>
        <ul class="nav-links">
          <li>
            <a href="index.php">
              <i class='bx bx-grid-alt' ></i>
              <span class="link_name">Dashboard</span>
            </a>
            <ul class="sub-menu blank">
              <li><a class="link_name" href="index.php">Dashboard</a></li>
            </ul>
          </li>
          <li>
            <div class="iocn-link">
              <a href="Posts.php">
                <i class='bx bx-book-alt' ></i>
                <span class="link_name">Posts</span>
              </a>
              <i class='bx bxs-chevron-down arrow' ></i>
            </div>
            <ul class="sub-menu">
              <li><a class="link_name" href="Posts.php">Posts</a></li>
              <li><a href="Posts.php">View All Posts</a></li>
              <li><a href="PostAdd.php">Add Post</a></li>
            </ul>
          </li>
          <li>
            <div class="iocn-link">
              <a href="Categories.php">
                <i class='bx bx-collection' ></i>
                <span class="link_name">Categories</span>
              </a>
              <ul class="sub-menu blank">
                <li><a class="link_name" href="Categories.php">Categories</a></li>
              </ul>
            </div>
          </li>
          <li>
            <a href="comments.php">
              <i class='bx bx-chat'></i>
              <span class="link_name">Comments</span>
            </a>
            <ul class="sub-menu blank">
              <li><a class="link_name" href="comments.php">Comments</a></li>
            </ul>
          </li>
          <li>
            <div class="iocn-link">
              <a href="users.php">
                <i class='bx bx-user' ></i>
                <span class="link_name">Users</span>
              </a>
              <i class='bx bxs-chevron-down arrow' ></i>
            </div>
            <ul class="sub-menu">
              <li><a class="link_name" href="users.php">Users</a></li>
              <li><a href="users.php">All Users</a></li>
              <li><a href="UserAdd.php">Add Users</a></li>
            </ul>
          </li>
          <li>
            <a href="../../dist/index">
              <i class='bx bxs-home'></i>
              <span class="link_name">View Site</span>
            </a>
            <ul class="sub-menu blank">
              <li><a class="link_name" href="../../dist/index">View Site</a></li>
            </ul>
          </li>
          <?php
          if($_SESSION['username']){
            echo "<li>
                  <div class='profile-details'>
                    <div class='profile-content'>
                      <img src='../Uploaded_images/{$_SESSION['user_image']}' alt='profileImg'>
                    </div>
                    <div class='name-job'>
                      <div class='profile_name'>{$_SESSION['firstname']} {$_SESSION['lastname']}</div>
                      <div class='job'>{$_SESSION['username']}</div>
                    </div>
                    <a href='../../includes/logout.php'>
                    <i class='bx bx-log-out uptt' ></i>
                    </a>
                  </div>
                </li>";
          }
          ?>
        </ul>
    </div>
    <section class="home-section">
      <div class="home-content">
        <i class='bx bx-menu' ></i>
        <span class="text">Edit User</span>
      </div>
      <?php include "../includes/db.php";
      if(isset($_GET['edit']) && !empty(trim($_GET["edit"]))){
        $user_id = $_GET['edit'];
        $user_id = mysqli_real_escape_string($connection, trim($_GET['edit']));
        $user_id = filter_var($user_id, FILTER_SANITIZE_NUMBER_INT);
      }
      ?>
      <form action="../includes/ChangeUserPass.php" method="post" enctype="multipart/form-data">
        <div class="container">
          <div class="content">
            <div class="user-details">
              <input type='hidden' name='user_id' value="<?php echo $user_id ?>">
              <div class="input-box">
                <label class="details">Enter New Password</label>
                <input type="password" name="Password" placeholder="Enter Password" id="myInput" required minlength="8">
              </div>
              <div class="input-box">
                <label class="details">Confirm New Password</label>
                <input type="password" name="ConfirmPassword" placeholder="Confirm Password" id="myInput" required minlength="8">
              </div>
              <?php
              if(isset($_GET['error']) && !empty(trim($_GET["error"]))){
                $error = $_GET['error'];
                $error = mysqli_real_escape_string($connection, trim($_GET['error']));
                $error = htmlspecialchars($error);
                echo "<p class='error' style='margin-left:20px; font-weight:bold;'>{$error}</p>";
              }
              ?>
            <div class="button">
              <input type="submit" name="submit" value="Update Password">
            </div>
          </div>
        </div>
      </form>
    </section>
    <script src="../js/main.js"></script>
  </body>
</html>
