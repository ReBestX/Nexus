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
    <title>Comments</title>
    <link rel="icon" href="../images/NexusLogo.png" />
    <link rel="stylesheet" href="output.css" />
    <link rel="stylesheet" href="../src/comments.css" />
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
        <span class="text">Comments</span>
      </div>
      <table>
        <thead>
          <td>ID</td>
          <td>Author</td>
          <td>Email</td>
          <td>Content</td>
          <td>Status</td>
          <td>In Response to</td>
          <td>Date</td>
          <td>Options</td>
        </thead>
        <?php include "../includes/db.php";
        if(isset($_GET['id']) && !empty(trim($_GET["id"]))){
          $id = $_GET['id'];
          $id = mysqli_real_escape_string($connection,trim($id));
          $id = filter_var($id, FILTER_SANITIZE_NUMBER_INT);
          $sql = "SELECT * FROM comments WHERE comment_post_id = {$id}";
          $result = mysqli_query($connection, $sql);
          $resultCheck = mysqli_num_rows($result);
          if ($resultCheck > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
              $comment_id = $row['comment_id'];
              $comment_post_id = $row['comment_post_id'];
              $comment_author = $row['comment_author'];
              $comment_email = $row['comment_email'];
              $comment_content = $row['comment_content'];
              $comment_status = $row['comment_status'];
              $comment_date = $row['comment_date'];
              echo "<tr>";
              echo "<td>$comment_id</td>";
              echo "<td>$comment_author</td>";
              echo "<td>$comment_email</td>";
              echo "<td>$comment_content</td>";
              echo "<td>$comment_status</td>";
              $query2 = "SELECT * FROM posts WHERE post_id = {$comment_post_id}";
              $result2 = mysqli_query($connection, $query2);
              while ($row2 = mysqli_fetch_assoc($result2)) {
                $post_id = $row2['post_id'];
                $post_title = $row2['post_title'];
                echo "<td><a href='../../dist/post.php?id=$post_id'>$post_title</a></td>";
              }
              echo "<td>$comment_date</td>";
              echo "<td class='optionsP'><button class='options'>
                      <a href='../includes/commentApprove.php?id=$comment_id' ><i class='bx bx-message-alt-check' style='color:#30a945 !important; font-size:20px'></i></a>
                      <a href='../includes/commentUnapprove.php?id=$comment_id'><i class='bx bx-message-alt-x' style='color:#ff0000 !important; font-size:20px' ></i></a>
                      <a href='EditComment.php?edit=$comment_id'><i style='color:#30a945 !important; font-size:20px' class='bx bxs-edit' ></i></a>
                      <a href='../includes/commentDelete.php?delete=$comment_id&post=$comment_post_id'><i style='color:#ff0000 !important; font-size:20px' class='bx bxs-trash-alt'></i></a>
                    </button></td>";
              echo "</tr>";
            }
          }
        }else{
          $sql = "SELECT * FROM comments";
          $result = mysqli_query($connection, $sql);
          $resultCheck = mysqli_num_rows($result);
          if ($resultCheck > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
              $comment_id = $row['comment_id'];
              $comment_post_id = $row['comment_post_id'];
              $comment_author = $row['comment_author'];
              $comment_email = $row['comment_email'];
              $comment_content = $row['comment_content'];
              $comment_status = $row['comment_status'];
              $comment_date = $row['comment_date'];
              echo "<tr>";
              echo "<td>$comment_id</td>";
              echo "<td>$comment_author</td>";
              echo "<td>$comment_email</td>";
              echo "<td>$comment_content</td>";
              echo "<td>$comment_status</td>";
              $query2 = "SELECT * FROM posts WHERE post_id = {$comment_post_id}";
              $result2 = mysqli_query($connection, $query2);
              while ($row2 = mysqli_fetch_assoc($result2)) {
                $post_id = $row2['post_id'];
                $post_title = $row2['post_title'];
                echo "<td><a href='../../dist/post/$post_id'>$post_title</a></td>";
              }
              echo "<td>$comment_date</td>";
              echo "<td class='optionsP'><button class='options'>
                      <a href='../includes/commentApprove.php?id=$comment_id' ><i class='bx bx-message-alt-check' style='color:#30a945 !important; font-size:20px'></i></a>
                      <a href='../includes/commentUnapprove.php?id=$comment_id'><i class='bx bx-message-alt-x' style='color:#ff0000 !important; font-size:20px' ></i></a>
                      <a href='EditComment.php?edit=$comment_id'><i style='color:#30a945 !important; font-size:20px' class='bx bxs-edit' ></i></a>
                      <a class='delete' href='../includes/commentDelete.php?delete=$comment_id&post=$comment_post_id'><i style='color:#ff0000 !important; font-size:20px' class='bx bxs-trash-alt'></i></a>
                    </button></td>";
              echo "</tr>";
            }
          }
        }
        ?>
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
