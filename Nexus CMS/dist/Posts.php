<?php include "../includes/db.php";
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
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Posts</title>
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
      ScrollReveal({ duration: 500 })
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
              <a href="#">
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
                <li><a class="link_name" href="#">Categories</a></li>
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
        <span class="text">Posts</span>
      </div>
      <?php
        if(isset($_GET['error']) && !empty(trim($_GET["error"]))){
          $massage = $_GET['error'];
          $massage = mysqli_real_escape_string($connection, trim($_GET['error']));
          $massage = htmlspecialchars($massage);
          echo "<p class='error' style='padding: 20px; font-size:20px'>Error : {$massage}</p>";
        }
      ?>
      <form action="../includes/bulk.php" method="post">
        <div class="bulkContainer">
          <select name="bulk_options" id="">
            <option value="Select">Select Option</option>
            <option value="published">Publish</option>
            <option value="draft">Draft</option>
            <option value="delete">Delete</option>
            <option value="clone">Clone</option>
          </select>
          <div class="buttons">
          <input type="submit" name="submit" value="Apply" class="apply">
          <a href="PostAdd.php" class="add">Add New</a>
          </div>
        </div>
      <table>
        <thead>
          <td><input id="selectAllBoxes" type="checkbox"></td>
          <td>ID</td>
          <td>Author</td>
          <td>Title</td>
          <td>Category</td>
          <td>Status</td>
          <td>Image</td>
          <td>Tags</td>
          <td>Likes</td>
          <td>Comments</td>
          <td>Date</td>
          <td>Options</td>
        </thead>
        <?php include "../includes/db.php";
          $sql = "SELECT * FROM posts";
          $result = mysqli_query($connection, $sql);
          $resultCheck = mysqli_num_rows($result);
          if ($resultCheck > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
              $post_id = $row['post_id'];
              $post_title = $row['post_title'];
              $post_category = $row['post_category'];
                $post_author = $row['post_author'];
                $query3 = "SELECT * FROM users WHERE user_id = {$post_author}";
                $select_all_users_query = mysqli_query($connection, $query3);
                $row2 = mysqli_fetch_assoc($select_all_users_query);
                $user_id = $row2['user_id'];
                $user_username = $row2['user_username'];
              $post_date = $row['post_date'];
              $post_image = $row['post_image'];
              $post_content = $row['post_content'];
              $post_tags = $row['post_tags'];
              $post_likes = $row['post_likes'];
              $CommentQuery = "SELECT * FROM comments WHERE comment_post_id = $post_id";
              $CommentResult = mysqli_query($connection, $CommentQuery);
              $post_comment_count = mysqli_num_rows($CommentResult);
              $post_status = $row['post_status'];
              echo "<tr>";
              echo "<td><input class='checkBoxes' type='checkbox' name='checkBoxArray[]' value='{$post_id}'></td>";
              echo "<td>$post_id</td>";
              echo "<td><a href='../../dist/Profile/{$user_id}'>{$user_username}</a></td>";
              echo "<td>$post_title</td>";
              echo "<td>";
              $selector = "SELECT * FROM categories";
              $result2 = mysqli_query($connection, $selector);
              while ($row2 = mysqli_fetch_assoc($result2)) {
                $cat_id = $row2['cat_id'];
                $cat_title = $row2['cat_title'];
                if ($post_category == $cat_id) {
                  echo $cat_title;
                }
              }
              echo "</td>";
              echo "<td>$post_status</td>";
              echo "<td style='display: flex;justify-content: center;align-items: center;'><img style='max-width: 200px;' src='../Uploaded_images/$post_image' alt=''></td>";
              echo "<td>$post_tags</td>";
              echo "<td>$post_likes</td>";
              echo "<td><a href='comments.php?id={$post_id}'>$post_comment_count</a></td>";
              echo "<td>$post_date</td>";
              echo "<td>
                      <a href='../../dist/post/{$post_id}' target='_blank' ><i style='color:#0cac9a !important; font-size:20px' class='bx bx-window-open'></i></a>
                      <a href='EditPost.php?edit={$post_id}'><i style='color:#30a945 !important; font-size:20px' class='bx bxs-edit' ></i></a>
                      <a class='delete' href='../includes/deletePost.php?delete={$post_id}'><i style='color:#ff0000 !important; font-size:20px' class='bx bxs-trash-alt'></i></a>
                    </td>";
              echo "</tr>";
            }
          }
        ?>
      </table>
      </form>
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
            text: "You won't be able to revert this!",
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
