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
    <title>Categories</title>
    <link rel="icon" href="../images/NexusLogo.png" />
    <link rel="stylesheet" href="../src/cate.css" />
    <link rel="stylesheet" href="output.css" />
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
              <li><a class="users.php" href="users.php">Users</a></li>
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
        <span class="text">Categories</span>
      </div>
      <div class="edit">
        <form action="../includes/CategoryAdd.php" method="post">
          <div class="catForm">
              <label for="CategoryName">Add Category</label>
              <input type="text" class="in" name="CategoryName">
              <input type="submit" class="sub" name="submit" value="Add Category">
          </div>
        </form>
        <?php include "../includes/db.php";
          if (isset($_GET["edit"]) && !empty(trim($_GET["edit"]))) {
            $cat_id = $_GET["edit"];
            $cat_id = mysqli_real_escape_string($connection, trim($_GET["edit"]));
            $cat_id = filter_var($cat_id, FILTER_SANITIZE_NUMBER_INT);
            $sql = "SELECT * FROM categories WHERE cat_id = $cat_id";
            $result = mysqli_query($connection, $sql);
            $resultCheck = mysqli_num_rows($result);
            if ($resultCheck > 0) {
              while ($row = mysqli_fetch_assoc($result)) {
                echo "<form action='../includes/CategoryEdit.php' method='post'>
                <div class='catForm'>
                    <label for='CategoryName'>Edit Category</label>
                    <input type='text' class='in' name='CategoryName' value='{$row["cat_title"]}'>
                    <input type='hidden' name='cat_id' value='{$row["cat_id"]}'>
                    <input type='submit' class='sub' name='submit' value='Edit Category'>
                </div>
              </form>";
              }
            }
          }
        ?>
      </div>
      <?php include "../includes/db.php";
        if(isset($_GET["error"]) && !empty(trim($_GET["error"]))){
          $error = mysqli_real_escape_string($connection, trim($_GET["error"]));
          $error = htmlspecialchars($error);
          echo "<h2 class='Error'>{$error}</h2>";
        }
      ?>
      <table>
        <thead>
          <td>Category ID</td>
          <td>Category Name</td>
          <td>Options</td>
        </thead>
        <?php include "../includes/db.php";
          $sql = "SELECT * FROM categories";
          $result = mysqli_query($connection, $sql);
          $resultCheck = mysqli_num_rows($result);
          if ($resultCheck > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
              echo "<tr><td>" . $row["cat_id"] . "</td><td>" . "<a href='../../dist/category/{$row["cat_id"]}'>{$row["cat_title"]}</a>" . "</td><td><button><a href='Categories.php?edit={$row["cat_id"]}'><i style='color:#30a945 !important; font-size:20px' class='bx bxs-edit' ></i></a><a class='delete' href='../includes/CategoryDelete.php?delete={$row["cat_id"]}'><i style='color:#ff0000 !important; font-size:20px' class='bx bxs-trash-alt'></i></a></button></td></tr>";
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
