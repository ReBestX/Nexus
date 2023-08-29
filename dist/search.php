<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Search</title>
  <link rel="icon" href="../images/NexusLogo.png">
  <link rel="stylesheet" href="../src/all.min.css">
  <link rel="stylesheet" href="output.css">
  <link rel="stylesheet" href="../src/NexusHome.css">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;800&display=swap" rel="stylesheet">
  <link href="https://api.fontshare.com/v2/css?f[]=satoshi@400&display=swap" rel="stylesheet">
  <script src="https://unpkg.com/scrollreveal@4"></script>
	<script>
		ScrollReveal({ duration: 1000 })
	</script>
  <style>
    @media (max-width:1024px){
      .home .sidebar {
        margin-top: 0px;
      }
    }
  </style>
</head>
<body>
  <div class="backimg">
    <img class="img1" src="../images/Vector 1.png" alt="">
    <img class="img2" src="../images/Vector 2.png" alt="">
    <img class="img3" src="../images/Vector 3.png" alt="">
  </div>
  <!-- Start Header -->
  <div class="header" id="header" >
    <div class="navbar container">
      <div class="brand">
        <a href="#"><img src="../images/NexusLogo2 (5).png" alt=""></a>
      </div>
      <div class="burger" id="burger">
        <span class="burger-line"></span>
        <span class="burger-line"></span>
        <span class="burger-line"></span>
      </div>
      <span class="overlay"></span>
      <div class="menu" id="menu">
        <ul class="menu-inner">
          <li class="menu-item"><a class="menu-link" href="index.php">Home</a></li>
          <li class="menu-item"><a class="menu-link" href="about.php">About</a></li>
          <li class="menu-item"><a class="menu-link" href="Service.php">Service</a></li>
          <li class="menu-item"><a class="menu-link" href="Project.php">Project</a></li>
          <li class="menu-item"><a class="menu-link" href="Support.php">Support</a></li>
          <?php
          if(isset($_SESSION['user_role'])){
            if($_SESSION['user_role'] == 'admin'){
              echo "<li class='menu-item'><a class='menu-link' href='../Nexus CMS/dist/index.php'>Admin</a></li>";
            }
          }
          ?>
        </ul>
      </div>
      <span class="search2">
        <i class="fa-solid fa-magnifying-glass bx bx-search search-toggle"></i>
        <?php
        if(isset($_SESSION['username'])){
          echo "<img class='userImg' src='../Nexus CMS/Uploaded_images/{$_SESSION['user_image']}' alt='' onclick='toggleMenu()'>
                <div class='sub-menu-wrap' id='subMenu'>
                  <div class='sub-menu'>
                    <div class='user-info'>
                      <img src='../Nexus CMS/Uploaded_images/{$_SESSION['user_image']}' alt=''>
                      <div class='names'>
                        <h2>{$_SESSION['firstname']} {$_SESSION['lastname']}</h2>
                        <h3>{$_SESSION['username']}</h3>
                      </div>
                    </div>
                    <hr>
                    <a href='Profile.php?id={$_SESSION['id']}' class='sub-menu-link'>
                      <img src='../images/profile.png' alt=''>
                      <p>Profile</p>
                      <span>></span>
                    </a>
                    <a href='../includes/logout.php' class='sub-menu-link'>
                      <img src='../images/logout.png' alt=''>
                      <p>Logout</p>
                      <span>></span>
                    </a>
                  </div>
                </div>";
        }else{
          echo "<ul>
                  <li class='menu-item'><a class='menu-link' href='sign-in/'>login</a></li>
                </ul>";
        }
        ?>
      </span>
        <div class="search-block">
          <form class="search-form" action="search.php" method="post">
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
          <img src="../images/Group 95.png" alt="">
          <h1>About : <?php include "../includes/db.php";
          if(isset($_POST['submit'])){
            $title = $_POST['search'];
            $title = mysqli_real_escape_string($connection, trim($title));
            $title = htmlspecialchars($title);
            echo $_POST['search'];
          }
          ?></h1>
        </div>
        <?php include "../includes/db.php";
        if(isset($_POST['submit'])){
          $search = $_POST['search'];
          $search = mysqli_real_escape_string($connection, trim($search));
          $search = htmlspecialchars($search);
          $query = "SELECT * FROM posts WHERE post_tags LIKE '%$search%' AND post_status = 'published'";
          $search_query = mysqli_query($connection, $query);
          $count = mysqli_num_rows($search_query);
          if($count != 0){
            while($row = mysqli_fetch_assoc($search_query)){
              $postId = $row['post_id'];
              $postTitle = $row['post_title'];
                $postAuthor = $row['post_author'];
                $query3 = "SELECT * FROM users WHERE user_id = {$postAuthor}";
                $select_all_users_query = mysqli_query($connection, $query3);
                $row2 = mysqli_fetch_assoc($select_all_users_query);
                $user_id = $row2['user_id'];
                $user_firstname = $row2['user_firstname'];
                $user_lastname = $row2['user_lastname'];
              $postDate = $row['post_date'];
              $postImage = $row['post_image'];
              $postContent = $row['post_content'];
              $postContent = (strlen($postContent) > 100) ? substr($postContent, 0, 100) . "..." : $postContent;
              echo "<div class='post'>
                    <h2>{$postTitle}</h2>
                    <p class='lead'>
                      <span>by</span>
                      <a href='Profile/{$user_id}'>{$user_firstname} {$user_lastname}</a>
                    </p>
                    <p class='history'>
                      <i class='fa-solid fa-clock-rotate-left'></i>
                      <span>{$postDate}</span>
                    </p>
                    <div class='img skeleton'><img src='../Nexus CMS/Uploaded_images/{$postImage}' alt=''></div>
                    <div class='content skeleton'><p>{$postContent}</p></div>
                    <div class='buttonCon'><div class='button'><button><a href='post/$postId'><span>Read More </span><i class='fa-solid fa-chevron-right'></i></a></button></div></div>
                  </div>";
            }
          }else{
            echo "<h1 class='heading h1' style='font-size : 30px'>No Result</h1>";
          }
        }
        ?>
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
              echo "<a href='category/{$cat_id}'>{$cat_title}</a>";
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

            echo "<div class='sidePost skeleton'>
                    <div class='postDetails'>
                      <h3><a href='post/{$minimizedArray[$i]['post_id']}'>{$minimizedArray[$i]['post_title']}</a></h3>
                      <p class='lead'>
                        <span>by</span>
                          <a href='Profile/{$user_id}'>{$user_firstname} {$user_lastname}</a>
                        </a>
                      </p>
                    </div>
                    <div class='sideImg'><img src='../Nexus CMS/Uploaded_images/{$minimizedArray[$i]['post_image']}' alt=''></div>
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
            <img src="../images/NexusLogo2 (5).png" alt="">
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