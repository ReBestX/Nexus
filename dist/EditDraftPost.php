<?php session_start();
if(!isset($_SESSION['username'])){
  header("Location: sign-in/");
  exit;
}
include "../includes/db.php";
if(isset($_GET['id']) && !empty(trim($_GET['id']))){
  $post_id = $_GET['id'];
  $post_id = mysqli_real_escape_string($connection, trim($post_id));
  $post_id = filter_var($post_id, FILTER_SANITIZE_NUMBER_INT);
  $query = "SELECT * FROM posts WHERE post_id = $post_id";
  $result = mysqli_query($connection, $query);
  if (!$result) {
    header("Location: ../404page.php");
    exit;
  }
  $row = mysqli_fetch_assoc($result);
  $post_author = $row['post_author'];
  if($post_author != $_SESSION['id']){
    header("Location: ../index.php");
    exit;
  }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Edit Post</title>
  <link rel="icon" href="../../images/NexusLogo.png">
  <link rel="stylesheet" href="../../src/all.min.css">
  <link rel="stylesheet" href="../output.css">
  <link rel="stylesheet" href="../../src/editprofile.css">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;800&display=swap" rel="stylesheet">
  <link href="https://api.fontshare.com/v2/css?f[]=satoshi@400&display=swap" rel="stylesheet">
  <script src="https://unpkg.com/scrollreveal@4"></script>
	<script>
		ScrollReveal({ duration: 1000 })
	</script>
</head>
<body>
  <div class="backimg">
    <img class="img1" src="../../images/Vector 1.png" alt="">
    <img class="img3" src="../../images/Vector 3.png" alt="">
  </div>
  <!-- Start Header -->
  <div class="header" id="header" >
    <div class="navbar container">
      <div class="brand">
        <a href="#"><img src="../../images/NexusLogo2 (5).png" alt=""></a>
      </div>
      <div class="burger" id="burger">
        <span class="burger-line"></span>
        <span class="burger-line"></span>
        <span class="burger-line"></span>
      </div>
      <span class="overlay"></span>
      <div class="menu" id="menu">
        <ul class="menu-inner">
          <li class="menu-item"><a class="menu-link" href="../index">Home</a></li>
          <li class="menu-item"><a class="menu-link" href="../about">About</a></li>
          <li class="menu-item"><a class="menu-link" href="../Service">Service</a></li>
          <li class="menu-item"><a class="menu-link" href="../Project">Project</a></li>
          <li class="menu-item"><a class="menu-link" href="../Support">Support</a></li>
          <?php
          if(isset($_SESSION['user_role'])){
            if($_SESSION['user_role'] == 'admin'){
              echo "<li class='menu-item'><a class='menu-link' href='../../Nexus CMS/dist/index.php'>Admin</a></li>";
            }
          }
          ?>
        </ul>
      </div>
      <span class="search2">
        <i class="fa-solid fa-magnifying-glass bx bx-search search-toggle"></i>
        <?php
        if(isset($_SESSION['username'])){
          echo "<img class='userImg' src='../../Nexus CMS/Uploaded_images/{$_SESSION['user_image']}' alt='' onclick='toggleMenu()'>
                <div class='sub-menu-wrap' id='subMenu'>
                  <div class='sub-menu'>
                    <div class='user-info'>
                      <img src='../../Nexus CMS/Uploaded_images/{$_SESSION['user_image']}' alt=''>
                      <div class='names'>
                        <h2>{$_SESSION['firstname']} {$_SESSION['lastname']}</h2>
                        <h3>{$_SESSION['username']}</h3>
                      </div>
                    </div>
                    <hr>
                    <a href='../Profile/{$_SESSION['id']}' class='sub-menu-link'>
                      <img src='../../images/profile.png' alt=''>
                      <p>Profile</p>
                      <span>></span>
                    </a>
                    <a href='../../includes/logout.php' class='sub-menu-link'>
                      <img src='../../images/logout.png' alt=''>
                      <p>Logout</p>
                      <span>></span>
                    </a>
                  </div>
                </div>";
        }else{
          echo "<ul>
                  <li class='menu-item'><a class='menu-link' href='../sign-in/'>login</a></li>
                </ul>";
        }
        ?>
      </span>
        <div class="search-block">
          <form class="search-form" action="../search" method="post">
            <span><i class="fa-solid fa-arrow-left bx bx-arrow-back search-cancel"></i></span>
            <input type="search" name="search" class="search-input" placeholder="Search here...">
            <button name="submit" type="submit"><i class="fa-solid fa-magnifying-glass fa-xl"></i></button>
          </form>
        </div>
    </div>
  </div>
  <!-- End Header -->
  <!-- Start Section -->
  <div class="container">
    <div class="home">
      <div class="posts">
        <div class="heading">
          <img src="../../images/Group 95.png" alt="">
          <h1>Profile</h1>
        </div>
        <div class="post userInfo">
        <?php include "../includes/db.php";
          if (isset($_SESSION['id']) && !empty(trim($_SESSION['id']))) {
            $user_id = $_SESSION['id'];
            $user_id = mysqli_real_escape_string($connection, trim($user_id));
            $user_id = filter_var($user_id, FILTER_SANITIZE_NUMBER_INT);
            $query = "SELECT * FROM users WHERE user_id = $user_id";
            $select_user_query = mysqli_query($connection, $query);
            while ($row = mysqli_fetch_assoc($select_user_query)) {
              $user_id = $row['user_id'];
              $user_firstname = $row['user_firstname'];
              $user_lastname = $row['user_lastname'];
              $user_username = $row['user_username'];
              $user_email = $row['user_email'];
              $user_image = $row['user_image'];
              $user_role = $row['user_role'];
              echo "<div class='userImg2'><img src='../../Nexus CMS/Uploaded_images/{$user_image}' alt=''></div>
                    <div class='userDetails'>
                      <h3>{$user_firstname} {$user_lastname}</h3>
                      <h4>{$user_username}</h4>
                    </div>";
            }
          }
          ?>
        </div>
      </div>
      <div class="sidebar">
        <div class="Categories">
          <h2>Edit Post</h2>
          <div class="category">
            <?php include "../includes/db.php";
              if(isset($_GET['id']) && !empty(trim($_GET['id']))){
                $post_id = $_GET['id'];
                $post_id = mysqli_real_escape_string($connection, trim($post_id));
                $post_id = filter_var($post_id, FILTER_SANITIZE_NUMBER_INT);
                $query = "SELECT * FROM posts WHERE post_id = $post_id AND post_status = 'draft'";
                $result = mysqli_query($connection, $query);
                if (!$result) {
                  header("Location: ../404page.php");
                  exit;
                }
                $row = mysqli_fetch_assoc($result);
                $edit_id = $row['post_id'];
                $edit_title = $row['post_title'];
                $edit_category = $row['post_category'];
                $edit_image = $row['post_image'];
                $edit_tags = $row['post_tags'];
                $edit_content = $row['post_content'];
              }
            ?>
            <form action="../../includes/UpdateDraftPost.php" method="post" enctype="multipart/form-data" class="userForm">
              <div class="content">
                <div class="user-details">
                  <input type='hidden' name='cat_id' value='<?php echo $edit_id?>'>
                  <div class="input-box">
                    <label class="details">Post Title</label>
                    <input type="text" name="title" placeholder="Enter Post Title" value="<?php echo $edit_title?>" required>
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
                    <label class="details">Post Image (Max Size 1MB)</label>
                    <input type="file" name="my_image" placeholder="Enter Post Image" id="imgup">
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
                <div class="UserButtons">
                  <input class="button" type="submit" name="submit" value="Update Post" style="width: -webkit-fill-available;">
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- End Section -->
  <!-- Start Footer -->
  <div class="footer">
    <div class="container">
      <div class="footer-inner">
        <div class="footer-left">
          <div class="footer-logo">
            <img src="../../images/NexusLogo2 (5).png" alt="">
          </div>
          <div class="footer-text">
            <p>Made by <a href="https://www.linkedin.com/in/aymanbismail/" target="_blank">ReBestX - Ayman Ismail</a></p>
          </div>
          <div class="footer-social">
            <ul class="wrapper">
              <li class="icon facebook">
                <span class="tooltip">Facebook</span>
                <span><i class="fab fa-facebook-f"></i></span>
              </li>
              <li class="icon twitter">
                <span class="tooltip">Twitter</span>
                <span><i class="fab fa-twitter"></i></span>
              </li>
              <li class="icon instagram">
                <span class="tooltip">Instagram</span>
                <span><i class="fab fa-instagram"></i></span>
              </li>
              <li class="icon github">
                <span class="tooltip">Github</span>
                <span><i class="fab fa-github"></i></span>
              </li>
              <li class="icon youtube">
                <span class="tooltip">Youtube</span>
                <span><i class="fab fa-youtube"></i></span>
              </li>
            </ul>
          </div>
        </div>
        <div class="footer-right">
          <div class="footer-contact">
            <h2>Contact</h2>
            <ul>
              <li><a href="#"><i class="fa-solid fa-map-marker-alt"></i><span>123 Street, New York, USA</span></a></li>
              <li><a href="tel:+0123456789"><i class="fa-solid fa-phone"></i><span>+012 345 6789</span></a></li>
              <li><a href="#"><i class="fa-solid fa-envelope"></i><a href = "mailto: test@nexus.com"><span>test@nexus.com</span></li>
              <li><a href="https://www.example.com"><i class="fa-solid fa-globe"></i><span>www.example.com</span></a></li>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- End Footer -->
  <script src="../js/index.js"></script>
  <script>
    let subMenu = document.getElementById("subMenu");
    function toggleMenu(){
      subMenu.classList.toggle("open-menu");
    }
  </script>
</body>
</html>