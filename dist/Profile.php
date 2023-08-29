<?php session_start();?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Profile</title>
  <link rel="icon" href="../../images/NexusLogo.png">
  <link rel="stylesheet" href="../../src/all.min.css">
  <link rel="stylesheet" href="../output.css">
  <link rel="stylesheet" href="../../src/profile.css">
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
  <a href="#" id="scroll-top" style="display: none;"><span></span></a>
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
          if (isset($_GET['id']) && !empty(trim($_GET['id']))) {
            $user_id = mysqli_real_escape_string($connection, trim($_GET['id']));
            $user_id = filter_var($user_id, FILTER_SANITIZE_NUMBER_INT);
            $query = "SELECT * FROM users WHERE user_id = $user_id";
            $select_user_query = mysqli_query($connection, $query);
            $count = mysqli_num_rows($select_user_query);
            if ($count == 0) {
              echo "<p style='margin:20px; padding:20px 10px'>user not found</p>";
              exit;
            }else{
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
          } else if (isset($_SESSION['id'])) {
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
        <?php include "../includes/db.php";
        if(isset($_SESSION['id'])){
          if($user_id === $_SESSION['id']){
            echo '<div class="UserButtons">
                  <div class="button"><a href="../EditProfile/" style="width: max-content;">Edit Profile</a></div>
                  <div class="button"><a href="../ProfileDraftPosts/" style="width: max-content;">Draft Posts</a></div>
                </div>';
          }
        }
        ?>
      </div>
      <div class="sidebar">
        <?php
        if(isset($_GET['message']) && !empty(trim($_GET['message']))){
          $message = $_GET['message'];
          $message = mysqli_real_escape_string($connection, trim($message));
          $message = htmlspecialchars($message);
          if($message == "success"){
            $message = "Post Published Successfully";
            echo "<p class='post success' style='padding: 10px 20px; margin:0 0 15px 0; color:#198754; font-weight: 600; font-size:20px'>{$message}</p>";
          }else if($message == "success2"){
            $message = "Profile Updated Successfully";
            echo "<p class='post success' style='padding: 10px 20px; margin:0 0 15px 0; color:#198754; font-weight: 600; font-size:20px'>{$message}</p>";
          }else if($message == "success3"){
            $message = "Password Updated Successfully";
            echo "<p class='post success' style='padding: 10px 20px; margin:0 0 15px 0; color:#198754; font-weight: 600; font-size:20px'>{$message}</p>";
          }
        }
        ?>
        <div class="Categories">
          <h2>User Info</h2>
          <hr>
          <div class="category">
            <div class="category-item">
              <h3>Full Name</h3>
              <h3>Username</h3>
              <h3>Email</h3>
              <h3>Role</h3>
            </div>
            <div class="category-info">
              <p><?php echo $user_firstname; ?> <?php echo $user_lastname; ?></p>
              <p><?php echo $user_username; ?></p>
              <p><?php echo $user_email; ?></p>
              <p><?php echo $user_role; ?></p>
            </div>
          </div>
        </div>
          <?php include "../includes/db.php";
          $query2 = "SELECT * FROM posts WHERE post_author = '{$user_id}' AND post_status = 'published' ORDER BY post_id DESC";
          $select_all_posts_query = mysqli_query($connection, $query2);
          $postCount = mysqli_num_rows($select_all_posts_query);

          if($postCount > 0){
            echo "<div class='posts'>
                  <h1 class='post' style='padding: 20px; margin: 10px 0; font-size: 20px;'>Recent User Posts</h1>";
            while($row = mysqli_fetch_assoc($select_all_posts_query)){
              $query3 = "SELECT * FROM users WHERE user_id = {$row['post_author']}";
              $select_all_users_query = mysqli_query($connection, $query3);
              $row2 = mysqli_fetch_assoc($select_all_users_query);
              $user_id = $row2['user_id'];
              $user_firstname = $row2['user_firstname'];
              $user_lastname = $row2['user_lastname'];
              $postContent = $row['post_content'];
              $postContent = (strlen($postContent) > 100) ? substr($postContent, 0, 100) . "..." : $postContent;
              echo "<div class='post'>
                      <h2>{$row['post_title']}</h2>
                      <p class='lead'>
                        <span>by</span>
                        <a href='../Profile/{$user_id}'>{$user_firstname} {$user_lastname}</a>
                      </p>
                      <p class='history'>
                        <i class='fa-solid fa-clock-rotate-left'></i>
                        <span>{$row['post_date']}</span>
                      </p>
                      <div class='img skeleton'><img src='../../Nexus CMS/Uploaded_images/{$row['post_image']}' alt=''></div>
                      <div class='content skeleton'><p>{$postContent}</p></div>
                      <div class='buttonCon'><div class='button'><button><a href='../post/{$row['post_id']}'><span>Read More </span><i class='fa-solid fa-chevron-right'></i></a></button></div></div>
                    </div>";
            }
            echo "</div>";
          }
          ?>
      </div>
    </div>
  </div>
  <!-- End Section -->
  <!-- Start Footer -->
  <div class="footer" <?php if($postCount == 0){echo "style='margin-top: 120px;'";}?>>
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
    let btn = document.getElementById("scroll-top")

    window.onscroll = function () {
      if (window.scrollY >= 300) {
        btn.style.display = "block";
      } else {
        btn.style.display = "none";
      }
    };
  </script>
</body>
</html>