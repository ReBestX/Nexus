<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>About</title>
  <link rel="icon" href="../images/NexusLogo.png">
  <link rel="stylesheet" href="../src/all.min.css">
  <link rel="stylesheet" href="output.css">
  <link rel="stylesheet" href="../src/others.css">
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
          <li class="menu-item"><a class="menu-link" href="index">Home</a></li>
          <li class="menu-item"><a class="menu-link" href="about">About</a></li>
          <li class="menu-item"><a class="menu-link" href="Service">Service</a></li>
          <li class="menu-item"><a class="menu-link" href="Project">Project</a></li>
          <li class="menu-item"><a class="menu-link" href="Support">Support</a></li>
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
                    <a href='Profile/{$_SESSION['id']}' class='sub-menu-link'>
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
          <form class="search-form" action="search" method="post">
            <span><i class="fa-solid fa-arrow-left bx bx-arrow-back search-cancel"></i></span>
            <input type="search" name="search" class="search-input" placeholder="Search here...">
            <button name="submit" type="submit"><i class="fa-solid fa-magnifying-glass fa-xl"></i></button>
          </form>
        </div>
    </div>
  </div>
  <!-- End Header -->
  <!-- End Section -->
  <!-- Start 404 -->
  <div class='under'>
    <header class='under__content'>
      <h1 class='under__title'>Page Under Construction :(</h1>
      <div class='under__text'>We're currently working on something awesome. Please bear with us!</div>
    </header>
  </div>
  <div class="waveWrapper waveAnimation">
    <div class="waveWrapperInner bgTop">
      <div class="wave waveTop" style="background-image: url('http://front-end-noobs.com/jecko/img/wave-top.png')"></div>
    </div>
    <div class="waveWrapperInner bgMiddle">
      <div class="wave waveMiddle" style="background-image: url('http://front-end-noobs.com/jecko/img/wave-mid.png')"></div>
    </div>
    <div class="waveWrapperInner bgBottom">
      <div class="wave waveBottom" style="background-image: url('http://front-end-noobs.com/jecko/img/wave-bot.png')"></div>
    </div>
  </div>
  <!-- End 404 -->
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
  <script src="../js/others.js"></script>
  <script>
    let subMenu = document.getElementById("subMenu");
    function toggleMenu(){
      subMenu.classList.toggle("open-menu");
    }
  </script>
</body>
</html>