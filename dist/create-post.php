<?php session_start();
if(!isset($_SESSION['username'])){
  header("location: ../index");
  exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Create Post</title>
  <link rel="icon" href="../../images/NexusLogo.png">
  <link rel="stylesheet" href="../../src/all.min.css">
  <link rel="stylesheet" href="../output.css">
  <link rel="stylesheet" href="../../src/NexusHome.css">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;800&display=swap" rel="stylesheet">
  <link href="https://api.fontshare.com/v2/css?f[]=satoshi@400&display=swap" rel="stylesheet">
  <script src="https://unpkg.com/scrollreveal@4"></script>
  <link rel="stylesheet" href="../Nexus CMS//Uploaded_images/">
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
          <h1>Create Post</h1>
        </div>
        <?php include "../includes/db.php";
          if(isset($_GET['message']) && !empty(trim($_GET['message']))){
            $message = $_GET['message'];
            $message = mysqli_real_escape_string($connection, trim($message));
            $message = htmlspecialchars($message);
            if($message == "success"){
              $message = 'Post added successfully!';
              echo "<p class='post success' style='padding: 10px 20px; margin:15px 0; color:#198754; font-weight: 600; font-size:20px'>{$message}</p>";
            }else if($message == "error1"){
              $message = 'Sorry, your file is too large.';
              echo "<p class='post error' style='padding: 10px 20px; margin:15px 0; color:#ee4238; font-weight: 600; font-size:20px'>{$message}</p>";
            }else if($message == "error2"){
              $message = 'You can\'t upload files of this type';
              echo "<p class='post error' style='padding: 10px 20px; margin:15px 0; color:#ee4238; font-weight: 600; font-size:20px'>{$message}</p>";
            }else if($message == "error3"){
              $message = 'Unknown error occurred!';
              echo "<p class='post error' style='padding: 10px 20px; margin:15px 0; color:#ee4238; font-weight: 600; font-size:20px'>{$message}</p>";
            }
          }
          if(isset($_GET['success']) && !empty(trim($_GET['success'])) ){
            $message = $_GET['success'];
            $message = mysqli_real_escape_string($connection, trim($message));
            $message = htmlspecialchars($message);
            echo "<p class='post success' style='padding: 10px 20px; margin:15px 0; color:#198754; font-weight: 600; font-size:20px'>{$message}</p>";
          }
        ?>
        <div class="post">
          <form action="../../includes/userPostAdd.php" method="post" enctype="multipart/form-data">
            <div class="container">
              <div class="content3">
                <div class="user-details">
                  <div class="input-box">
                    <label class="details">Post Title</label>
                    <input type="text" name="title" placeholder="Enter Post Title" required>
                  </div>
                  <div class="input-box">
                    <label class="details">Post Category</label>
                    <select name="category" required class="cateEdit">
                      <?php include "../includes/db.php";
                        $sql = "SELECT * FROM categories";
                        $ready = mysqli_query($connection,$sql);
                        while($row = mysqli_fetch_assoc($ready)){
                          $cat_id = $row['cat_id'];
                          $cat_title = $row['cat_title'];
                          echo "<option value='{$cat_id}'>{$cat_title}</option>";
                        }
                      ?>
                    </select>
                  </div>
                  <div class="input-box">
                    <label class="details">Post Status</label>
                    <select name="status" required>
                      <option value="published">Published</option>
                      <option value="draft">Draft</option>
                    </select>
                  </div>
                  <div class="input-box">
                    <label class="details">Post Image (Max Size 1MB)</label>
                    <input type="file" id="imgup" name="my_image" placeholder="Enter Post Image" required>
                  </div>
                  <div class="input-box">
                    <label class="details">Post Tags</label>
                    <input type="text" name="tags" placeholder="Enter Post Tags"required>
                  </div>
                  <div class="input-box">
                    <label for="summernote" class="details">Post Content</label>
                    <textarea name="content" id="summernote" placeholder="Enter Post Content" required></textarea>
                  </div>
                </div>
                <div class="button">
                  <input type="submit" name="submit" value="Add Post">
                </div>
              </div>
            </div>
          </form>
        </div>
      </div>
      <div class="sidebar">
        <div class="Categories">
          <h2>Categories</h2>
          <div class="Categorie">
            <?php include "../includes/db.php";
            $query = "SELECT * FROM categories";
            $select_all_categories_query = mysqli_query($connection, $query);
            while ($row = mysqli_fetch_assoc($select_all_categories_query)) {
              $cat_title = $row['cat_title'];
              $cat_id = $row['cat_id'];
              echo "<a href='../category/{$cat_id}'>{$cat_title}</a>";
            }
            ?>
          </div>
        </div>
        <div class="recentPosts">
          <h2>Recent Posts</h2>
          <?php include "../includes/db.php";
          $query2 = "SELECT * FROM posts WHERE post_status = 'published'";
          $select_all_posts_query = mysqli_query($connection, $query2);
          $arr = array();
          while($row = mysqli_fetch_assoc($select_all_posts_query)){
            array_push($arr,$row);
          }
          $arr2 = array_reverse($arr);
          $minimizedArray = array_slice($arr2, 0, 10);

          for($i = 0;$i<count($minimizedArray);$i++){
            $query3 = "SELECT * FROM users WHERE user_id = {$minimizedArray[$i]['post_author']}";
            $select_all_users_query = mysqli_query($connection, $query3);
            $row = mysqli_fetch_assoc($select_all_users_query);
            $user_id = $row['user_id'];
            $user_firstname = $row['user_firstname'];
            $user_lastname = $row['user_lastname'];

            echo "<div class='sidePost'>
                    <div class='postDetails'>
                      <h3><a href='../post/{$minimizedArray[$i]['post_id']}'>{$minimizedArray[$i]['post_title']}</a></h3>
                      <p class='lead'>
                        <span>by</span>
                          <a href='../Profile/{$user_id}'>{$user_firstname} {$user_lastname}</a>
                        </a>
                      </p>
                    </div>
                    <div class='sideImg'><img src='../../Nexus CMS/Uploaded_images/{$minimizedArray[$i]['post_image']}' alt=''></div>
                  </div>";
          }
          ?>
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
  <script src="../../js/index.js"></script>
  <script>
    let subMenu = document.getElementById("subMenu");
    function toggleMenu(){
      subMenu.classList.toggle("open-menu");
    }
  </script>
</body>
</html>