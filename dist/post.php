<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Post</title>
  <link rel="icon" href="../../images/NexusLogo.png">
  <link rel="stylesheet" href="../../src/all.min.css">
  <link rel="stylesheet" href="../../src/output.css">
  <link rel="stylesheet" href="../../src/post.css">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;800&display=swap" rel="stylesheet">
  <link href="https://api.fontshare.com/v2/css?f[]=satoshi@400&display=swap" rel="stylesheet">
  <script src="https://unpkg.com/scrollreveal@4"></script>
  <script src="https://cdn.tailwindcss.com"></script>
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
      <?php
      include "../includes/db.php";

      if (isset($_GET['id']) && !empty(trim($_GET['id']))) {
        $id = mysqli_real_escape_string($connection, trim($_GET['id']));
        $id = filter_var($id, FILTER_SANITIZE_NUMBER_INT);
        $sql = "SELECT * FROM posts WHERE post_id = '$id'";
        $result = mysqli_query($connection, $sql);
        $row = mysqli_fetch_assoc($result);

        if ($row && $row["post_status"] == "published") {
          $title = $row['post_title'];
          $postAuthor = $row['post_author'];
          $query3 = "SELECT * FROM users WHERE user_id = {$postAuthor}";
          $select_all_users_query = mysqli_query($connection, $query3);
          $row2 = mysqli_fetch_assoc($select_all_users_query);
          $user_id = $row2['user_id'];
          $user_firstname = $row2['user_firstname'];
          $user_lastname = $row2['user_lastname'];
          $date = $row['post_date'];
          $content = $row['post_content'];
          $image = $row['post_image'];

          echo "<div class='post'>
                  <h2>$title</h2>
                  <p class='lead'>
                    <span>by</span>
                    <a href='../Profile/{$user_id}'>{$user_firstname} {$user_lastname}</a>
                  </p>
                  <p class='history'>
                    <i class='fa-solid fa-clock-rotate-left'></i>
                    <span>$date</span>
                  </p>
                  <div class='img skeleton'><img src='../../Nexus CMS/Uploaded_images/$image' alt=''></div>
                  <div class='skeleton'>
                    <div class='content'><p>$content</p></div>
                  </div>";

          $sql5 = "SELECT * FROM posts WHERE post_id = '$id'";
          $result5 = mysqli_query($connection, $sql5);
          $row5 = mysqli_fetch_assoc($result5);
          $likes = $row5['post_likes'];

          if (isset($_SESSION['id']) && !empty(trim($_SESSION['id']))) {
            $sessionId = mysqli_real_escape_string($connection, trim($_SESSION['id']));
            $sessionId = htmlspecialchars($_SESSION['id']);
            $sql4 = "SELECT * FROM likes WHERE post_id = '{$id}' AND user_id = '{$sessionId}'";
            $result4 = mysqli_query($connection, $sql4);
            $row4 = mysqli_num_rows($result4);

            if ($row4 > 0) {
              echo '<div class="like">
                      <input type="checkbox" id="checkbox" class="likeButton" checked />
                      <label for="checkbox">
                      <svg id="heart-svg" viewBox="467 392 58 57" xmlns="http://www.w3.org/2000/svg">
                          <g id="Group" fill="none" fill-rule="evenodd" transform="translate(467 392)">
                            <path d="M29.144 20.773c-.063-.13-4.227-8.67-11.44-2.59C7.63 28.795 28.94 43.256 29.143 43.394c.204-.138 21.513-14.6 11.44-25.213-7.214-6.08-11.377 2.46-11.44 2.59z" id="heart" fill="#AAB8C2"/>
                            <circle id="main-circ" fill="#E2264D" opacity="0" cx="29.5" cy="29.5" r="1.5"/>

                            <g id="grp7" opacity="0" transform="translate(7 6)">
                              <circle id="oval1" fill="#9CD8C3" cx="2" cy="6" r="2"/>
                              <circle id="oval2" fill="#8CE8C3" cx="5" cy="2" r="2"/>
                            </g>

                            <g id="grp6" opacity="0" transform="translate(0 28)">
                              <circle id="oval1" fill="#CC8EF5" cx="2" cy="7" r="2"/>
                              <circle id="oval2" fill="#91D2FA" cx="3" cy="2" r="2"/>
                            </g>

                            <g id="grp3" opacity="0" transform="translate(52 28)">
                              <circle id="oval2" fill="#9CD8C3" cx="2" cy="7" r="2"/>
                              <circle id="oval1" fill="#8CE8C3" cx="4" cy="2" r="2"/>
                            </g>

                            <g id="grp2" opacity="0" transform="translate(44 6)">
                              <circle id="oval2" fill="#CC8EF5" cx="5" cy="6" r="2"/>
                              <circle id="oval1" fill="#CC8EF5" cx="2" cy="2" r="2"/>
                            </g>

                            <g id="grp5" opacity="0" transform="translate(14 50)">
                              <circle id="oval1" fill="#91D2FA" cx="6" cy="5" r="2"/>
                              <circle id="oval2" fill="#91D2FA" cx="2" cy="2" r="2"/>
                            </g>

                            <g id="grp4" opacity="0" transform="translate(35 50)">
                              <circle id="oval1" fill="#F48EA7" cx="6" cy="5" r="2"/>
                              <circle id="oval2" fill="#F48EA7" cx="2" cy="2" r="2"/>
                            </g>

                            <g id="grp1" opacity="0" transform="translate(24)">
                              <circle id="oval1" fill="#9FC7FA" cx="2.5" cy="3" r="2"/>
                              <circle id="oval2" fill="#9FC7FA" cx="7.5" cy="2" r="2"/>
                            </g>
                          </g>
                        </svg>
                      </label>
                      <h1 id="likeCount">' . $likes . '</h1>
                      <h1 style="margin-left: 5px;">Likes</h1>
                    </div>';
            } else {
              echo '<div class="like">
                      <input type="checkbox" id="checkbox" class="likeButton" />
                      <label for="checkbox">
                      <svg id="heart-svg" viewBox="467 392 58 57" xmlns="http://www.w3.org/2000/svg">
                          <g id="Group" fill="none" fill-rule="evenodd" transform="translate(467 392)">
                            <path d="M29.144 20.773c-.063-.13-4.227-8.67-11.44-2.59C7.63 28.795 28.94 43.256 29.143 43.394c.204-.138 21.513-14.6 11.44-25.213-7.214-6.08-11.377 2.46-11.44 2.59z" id="heart" fill="#AAB8C2"/>
                            <circle id="main-circ" fill="#E2264D" opacity="0" cx="29.5" cy="29.5" r="1.5"/>

                            <g id="grp7" opacity="0" transform="translate(7 6)">
                              <circle id="oval1" fill="#9CD8C3" cx="2" cy="6" r="2"/>
                              <circle id="oval2" fill="#8CE8C3" cx="5" cy="2" r="2"/>
                            </g>

                            <g id="grp6" opacity="0" transform="translate(0 28)">
                              <circle id="oval1" fill="#CC8EF5" cx="2" cy="7" r="2"/>
                              <circle id="oval2" fill="#91D2FA" cx="3" cy="2" r="2"/>
                            </g>

                            <g id="grp3" opacity="0" transform="translate(52 28)">
                              <circle id="oval2" fill="#9CD8C3" cx="2" cy="7" r="2"/>
                              <circle id="oval1" fill="#8CE8C3" cx="4" cy="2" r="2"/>
                            </g>

                            <g id="grp2" opacity="0" transform="translate(44 6)">
                              <circle id="oval2" fill="#CC8EF5" cx="5" cy="6" r="2"/>
                              <circle id="oval1" fill="#CC8EF5" cx="2" cy="2" r="2"/>
                            </g>

                            <g id="grp5" opacity="0" transform="translate(14 50)">
                              <circle id="oval1" fill="#91D2FA" cx="6" cy="5" r="2"/>
                              <circle id="oval2" fill="#91D2FA" cx="2" cy="2" r="2"/>
                            </g>

                            <g id="grp4" opacity="0" transform="translate(35 50)">
                              <circle id="oval1" fill="#F48EA7" cx="6" cy="5" r="2"/>
                              <circle id="oval2" fill="#F48EA7" cx="2" cy="2" r="2"/>
                            </g>

                            <g id="grp1" opacity="0" transform="translate(24)">
                              <circle id="oval1" fill="#9FC7FA" cx="2.5" cy="3" r="2"/>
                              <circle id="oval2" fill="#9FC7FA" cx="7.5" cy="2" r="2"/>
                            </g>
                          </g>
                        </svg>
                      </label>
                      <h1 id="likeCount">' . $likes . '</h1>
                      <h1 style="margin-left: 5px;">Likes</h1>
                    </div>';
            }
          }else{
            echo '<div style="display:flex; margin-top:15px"><h1 id="likeCount">' . $likes . ' Likes ,</h1>' . "<a href = '../../dist/sign-in/' style='color:#0089b3'>Login </a><span style='margin-left:4px'>to like this post.<span></div>";
          }

          echo "</div>";

          if (isset($_SESSION['id'])) {
            echo "<div class='comment-form'>
                    <h3>Leave a comment</h3>
                    <form action='../../includes/commentpostlogin.php' method='post'>
                      <input type='hidden' name='post_id' value='$id'>
                      <div class='form-group'>
                        <label for='comment'>Comment:</label>
                        <textarea name='comment' cols='30' rows='10' class='form-control' placeholder='Enter your comment' required></textarea>
                      </div>
                      <input type='submit' class='btn' name='submit' class='form-control' value='Submit'>
                    </form>
                  </div>";
          } else {
            echo "<div class='comment-form'>
                    <h3>Leave a comment</h3>
                    <form action='../../includes/commentpost.php' method='post'>
                      <input type='hidden' name='post_id' value='$id'>
                      <div class='form-group'>
                        <label for='name'>Name:</label>
                        <input type='text' name='name' class='form-control' placeholder='Enter your name' required>
                      </div>
                      <div class='form-group'>
                        <label for='email'>Email:</label>
                        <input type='email' name='email' class='form-control' placeholder='Enter your email' required>
                      </div>
                      <div class='form-group'>
                        <label for='comment'>Comment:</label>
                        <textarea name='comment' cols='30' rows='10' class='form-control' placeholder='Enter your comment' required></textarea>
                      </div>
                      <input type='submit' class='btn' name='submit' class='form-control' value='Submit'>
                    </form>
                  </div>";
          }

          if (isset($_GET['message']) && !empty(trim($_GET['message']))) {
            $message = mysqli_real_escape_string($connection, trim($_GET['message']));
            $message = htmlspecialchars($message);
            if ($message == 'success') {
              echo "<div class='alert alert-success'>Your comment has been sent for review</div>";
            } else {
              echo "<div class='alert alert-danger'>Comment not added</div>";
            }
          }

          $sql2 = "SELECT * FROM comments WHERE comment_post_id = '$id' AND comment_status = 'approved' ORDER BY comment_id DESC";
          $result2 = mysqli_query($connection, $sql2);

          if (!$result2) {
            header("Location: ../../dist/404page");
            exit;
          }

          while ($row = mysqli_fetch_assoc($result2)) {
            $name2 = $row['comment_author'];
            $date2 = $row['comment_date'];
            $content2 = $row['comment_content'];

            echo "<div class='comments'>
                    <ul id='commentList'>
                      <li class='comment'>
                        <div class='comment-body'>
                          <h3 class='comment-name'>$name2</h3>
                          <div class='comment-date'>$date2</div>
                          <p class='comment-content'>$content2</p>
                        </div>
                      </li>
                    </ul>
                  </div>";
          }
        } else {
          echo "<div class='alert alert-danger'>Post not found</div>";
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
          $minimizedArray = array_slice($arr2, 0, 5);
          for($i = 0;$i<count($minimizedArray);$i++){
            $query3 = "SELECT * FROM users WHERE user_id = {$minimizedArray[$i]['post_author']}";
            $select_all_users_query = mysqli_query($connection, $query3);
            $row = mysqli_fetch_assoc($select_all_users_query);
            $user_id = $row['user_id'];
            $user_firstname = $row['user_firstname'];
            $user_lastname = $row['user_lastname'];

            echo "<div class='sidePost skeleton'>
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
  <script src="../../js/jquery-3.7.0.min.js"></script>
  <script src="../../js/post.js"></script>
  <script>
    let subMenu = document.getElementById("subMenu");
    function toggleMenu(){
      subMenu.classList.toggle("open-menu");
    }
    $(document).ready(function() {
      var checkbox = document.getElementById("checkbox");
      var check = checkbox.checked ? "on" : "off";

      checkbox.onchange = function() {
        if (checkbox.checked) {
          check = "on";
        } else {
          check = "off";
        }
      };

      $('.likeButton').click(function() {
        // Trigger the onchange event manually
        checkbox.onchange();

        // Send the AJAX request to update check value
        $.ajax({
          url: "../../includes/update_check_value.php",
          type: "POST",
          data: {
            'check': check,
            'post_id': <?php echo $id ?>,
            'user_id': <?php echo $_SESSION['id'] ?>,
          },
          success: function(response) {
              console.log("Update Likes Count Response:", response);
              var likeCount = parseInt(response);
              if (!isNaN(likeCount)) {
                $("#likeCount").text(likeCount);
              } else {
                console.log("Invalid like count:", response);
              }
          },
          error: function(xhr, status, error) {
            console.log("Update Check Value AJAX Error:", error);
          }
        });
      });
    });

  </script>
</body>
</html>