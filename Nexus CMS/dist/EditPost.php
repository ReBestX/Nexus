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
    <title>Edit Post</title>
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
        <span class="text">Edit Post</span>
      </div>
      <!-- Edit Post -->
      <?php include "../includes/db.php";
      if(isset($_GET['edit']) && !empty(trim($_GET["edit"]))){
        $edit_id = $_GET['edit'];
        $edit_id = mysqli_real_escape_string($connection, trim($_GET['edit']));
        $edit_id = filter_var($edit_id, FILTER_SANITIZE_NUMBER_INT);
        $edit_query = "SELECT * FROM posts WHERE post_id = {$edit_id}";
        $edit_result = mysqli_query($connection, $edit_query);
        if(!$edit_result){
          header("Location: ../../dist/404page");
          exit;
        }
        while($row = mysqli_fetch_assoc($edit_result)){
          $edit_title = $row['post_title'];
          $edit_author = $row['post_author'];
          $edit_category = $row['post_category'];
          $edit_status = $row['post_status'];
          $edit_image = $row['post_image'];
          $edit_tags = $row['post_tags'];
          $edit_content = $row['post_content'];
        }
      }
      ?>
      <form action="../includes/PostUpdate.php" method="post" enctype="multipart/form-data">
        <div class="container">
          <div class="content">
            <div class="user-details">
              <input type='hidden' name='cat_id' value='<?php echo $edit_id?>'>
              <div class="input-box">
                <label class="details">Post Title</label>
                <input type="text" name="title" placeholder="Enter Post Title" value="<?php echo $edit_title?>" required>
              </div>
              <div class="input-box">
                <label class="details">Post Author</label>
                <?php include "../includes/db.php";
                  $sql = "SELECT * FROM users";
                  $ready = mysqli_query($connection,$sql);
                  echo "<select name='author' required class='cateEdit'>";
                  while($row = mysqli_fetch_assoc($ready)){
                    $user_id = $row['user_id'];
                    $user_username = $row['user_username'];
                    if($edit_author === $user_id){
                      echo "<option value='{$user_id}' selected>{$user_username}</option>";
                    }else{
                      echo "<option value='{$user_id}'>{$user_username}</option>";
                    }
                  }
                  echo "</select>";
                ?>
              </div>
              <div class="input-box">
                <label class="details">Post Category</label>
                <select name="category" required value="<?php echo $edit_category?>">
                  <?php include "../includes/db.php";
                    $sql = "SELECT * FROM categories";
                    $ready = mysqli_query($connection,$sql);
                    while($row = mysqli_fetch_assoc($ready)){
                      $cat_id = $row['cat_id'];
                      $cat_title = $row['cat_title'];
                      if($edit_category == $cat_id){
                        echo "<option value='{$cat_id}' selected>{$cat_title}</option>";
                      }else{
                        echo "<option value='{$cat_id}' >{$cat_title}</option>";
                      }
                    }
                  ?>
                </select>
              </div>
              <div class="input-box">
                <label class="details">Post Status</label>
                <select name="status" required>
                  <?php include "../includes/db.php";
                    if($edit_status == 'draft'){
                      echo "<option value='published'>Published</option>";
                      echo "<option value='draft' selected>Draft</option>";
                    }else{
                      echo "<option value='published' selected>Published</option>";
                      echo "<option value='draft'>Draft</option>";
                    }
                  ?>
                </select>
              </div>
              <div class="input-box">
                <label class="details">Post Image (Max Size 1MB)</label>
                <input type="file" name="my_image" placeholder="Enter Post Image">
              </div>
              <div class="input-box">
                <label class="details">Post Tags</label>
                <input type="text" name="tags" placeholder="Enter Post Tags" value="<?php echo $edit_tags?>" required>
              </div>
              <div class="input-box">
                <label class="details">Post Content</label>
                <textarea name="content" placeholder="Enter Post Content" required><?php echo $edit_content?></textarea>
              </div>
            </div>
            <div class="button">
              <input type="submit" name="submit" value="Update Post">
            </div>
          </div>
        </div>
      </form>
    </section>
    <script src="../js/main.js"></script>
  </body>
</html>
