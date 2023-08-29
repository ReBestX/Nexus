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
    <title>Users</title>
    <link rel="icon" href="../images/NexusLogo.png" />
    <link rel="stylesheet" href="output.css" />
    <link rel="stylesheet" href="../src/Posts.css" />
    <link rel="stylesheet" href="../src/all.min.css">
    <link
      href="https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css"
      rel="stylesheet"
    />
    <script src="https://unpkg.com/scrollreveal@4"></script>
    <script>
      ScrollReveal({ duration: 1000 })
    </script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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
        <span class="text">Users</span>
      </div>
      <?php
        if(isset($_GET['error']) && !empty(trim($_GET["error"]))){
          $massage = $_GET['error'];
          $massage = mysqli_real_escape_string($connection, trim($_GET['error']));
          $massage = htmlspecialchars($massage);
          echo "<p class='error' style='padding: 20px; font-size:20px'>Error : {$massage}</p>";
        }
      ?>
      <table>
        <thead>
          <td>ID</td>
          <td>Username</td>
          <td>FirstName</td>
          <td>lastName</td>
          <td>Email</td>
          <td>Role</td>
          <td>Create Date</td>
          <td>Options</td>
        </thead>
        <tbody>
          <?php include "../includes/db.php";
          $sql = "SELECT * FROM users";
          $result = mysqli_query($connection,$sql);
          while($row = mysqli_fetch_assoc($result)){
            $user_id = $row['user_id'];
            $username = $row['user_username'];
            $user_firstname = $row['user_firstname'];
            $user_lastname = $row['user_lastname'];
            $user_email = $row['user_email'];
            $user_role = $row['user_role'];
            $user_date = $row['user_CreateDate'];
            echo "<tr>";
            echo "<td>$user_id</td>";
            echo "<td>$username</td>";
            echo "<td>$user_firstname</td>";
            echo "<td>$user_lastname</td>";
            echo "<td>$user_email</td>";
            echo "<td>$user_role</td>";
            echo "<td>$user_date</td>";
            echo "<td><button><a href='UserEdit.php?edit={$user_id}'><i style='color:#30a945 !important; font-size:20px' class='bx bxs-edit' ></i></a><a class='delete' href='../includes/deleteUser.php?delete={$user_id}'><i style='color:#ff0000 !important; font-size:20px' class='bx bxs-trash-alt'></i></a></button></td>";
            echo "</tr>";
          }
          ?>
        </tbody>
      </table>
    </section>
    <script src="../js/main.js"></script>
    <script src="../js/scroll.js"></script>
    <script>
      // Get all elements with the class "delete"
      let buttons = document.getElementsByClassName("delete");

      // Loop through each button and attach the event listener
      for (let i = 0; i < buttons.length; i++) {
        buttons[i].addEventListener("click", function (e) {
          e.preventDefault();
          const href = e.target.parentElement.href; // Get the href from the parent anchor element

          Swal.fire({
            title: 'Are you sure?',
            text: "If you delete this user, all posts and comments will be deleted too.",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#ff0000',
            cancelButtonColor: '#008000',
            confirmButtonText: 'Yes, delete it!'
          }).then((result) => {
            if (result.isConfirmed) {
              document.location.href = href;
            }
          });
        });
      }
    </script>
  </body>
</html>
