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
    <title>Admin</title>
    <link rel="icon" href="../images/NexusLogo.png" />
    <link rel="stylesheet" href="output.css" />
    <link rel="stylesheet" href="../src/index.css" />
    <link rel="stylesheet" href="../src/all.min.css">
    <link
      href="https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css"
      rel="stylesheet"
    />
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script src="https://unpkg.com/scrollreveal@4"></script>
    <script>
      ScrollReveal({ duration: 1000 })
    </script>
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
        <span class="text">Dashboard</span>
      </div>
      <!-- cards -->
      <div class="cards">
        <div class="card" style="border : 2px solid #317bb4">
          <div class="details">
            <h3>Total Posts</h3>
            <?php include "../includes/db.php";
            $sql = "SELECT * FROM posts";
            $result = mysqli_query($connection,$sql);
            $count2 = mysqli_num_rows($result);
            echo "<h2>{$count2}</h2>";
            ?>
            <a href="Posts.php">View Details<i style="margin-left: 5px;" class="fa-solid fa-arrow-right fa-sm"></i></a>
          </div>
          <div class="icon"><i class='bx bx-book'></i></div>
        </div>
        <div class="card" style="border : 2px solid #f2ad54">
          <div class="details">
            <h3>Total Comments</h3>
            <?php include "../includes/db.php";
            $sql3 = "SELECT * FROM comments";
            $result3 = mysqli_query($connection,$sql3);
            $count3 = mysqli_num_rows($result3);
            echo "<h2>{$count3}</h2>";
            ?>
            <a href="comments.php">View Details<i style="margin-left: 5px;" class="fa-solid fa-arrow-right fa-sm"></i></a>
          </div>
          <div class="icon"><i class='bx bx-chat'></i></div>
        </div>
        <div class="card" style="border : 2px solid #5ab960">
          <div class="details">
            <h3>Total Categories</h3>
            <?php include "../includes/db.php";
            $sql2 = "SELECT * FROM categories";
            $result2 = mysqli_query($connection,$sql2);
            $count2 = mysqli_num_rows($result2);
            echo "<h2>{$count2}</h2>";
            ?>
            <a href="Categories.php">View Details<i style="margin-left: 5px;" class="fa-solid fa-arrow-right fa-sm"></i></a>
          </div>
          <div class="icon"><i class='bx bx-collection'></i></div>
        </div>
        <div class="card" style="border : 2px solid #dd5352">
          <div class="details">
            <h3>Total Users</h3>
            <?php include "../includes/db.php";
            $sql4 = "SELECT * FROM users";
            $result4 = mysqli_query($connection,$sql4);
            $count4 = mysqli_num_rows($result4);
            echo "<h2>{$count4}</h2>";
            ?>
            <a href="users.php">View Details<i style="margin-left: 5px;" class="fa-solid fa-arrow-right fa-sm"></i></a>
          </div>
          <div class="icon"><i class='bx bx-user'></i></div>
        </div>
      </div>
      <script type="text/javascript">
      google.charts.load('current', {'packages':['bar']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {
      var data = google.visualization.arrayToDataTable([
        ['Data', 'Count'],
        <?php include "../includes/db.php";
        
        $sql = "SELECT * FROM posts";
        $result = mysqli_query($connection,$sql);
        $AllPosts = mysqli_num_rows($result);

        $sql = "SELECT * FROM posts WHERE post_status = 'published'";
        $result = mysqli_query($connection,$sql);
        $publishedPosts = mysqli_num_rows($result);

        $sql = "SELECT * FROM posts WHERE post_status = 'draft'";
        $result = mysqli_query($connection,$sql);
        $DraftPosts = mysqli_num_rows($result);

        $sql = "SELECT * FROM comments";
        $result = mysqli_query($connection,$sql);
        $Comments = mysqli_num_rows($result);

        $sql = "SELECT * FROM comments WHERE comment_status = 'approved'";
        $result = mysqli_query($connection,$sql);
        $ApprovedComments = mysqli_num_rows($result);

        $sql = "SELECT * FROM comments WHERE comment_status = 'unapproved'";
        $result = mysqli_query($connection,$sql);
        $UnapprovedComments = mysqli_num_rows($result);

        $sql = "SELECT * FROM users";
        $result = mysqli_query($connection,$sql);
        $Users = mysqli_num_rows($result);

        $sql = "SELECT * FROM categories";
        $result = mysqli_query($connection,$sql);
        $Categories = mysqli_num_rows($result);

        $element_text = ['All Posts','Published Posts','Draft Posts','Comments','Approved Comments','Pending Comments','Users','Categories'];
        $element_count = [$AllPosts,$publishedPosts,$DraftPosts,$Comments,$ApprovedComments,$UnapprovedComments,$Users,$Categories];
        for($i=0;$i<8;$i++){
          echo "['{$element_text[$i]}'" . "," . "{$element_count[$i]}],";
        }
        ?>
      ]);

      var options = {
        chart: {
          title: '',
          subtitle: '',
          width: '100%',
          height: '500px',
          isResponsive: true,
        },
        colors: ['#818cf8']
      };

      var chart = new google.charts.Bar(document.getElementById('columnchart_material'));
      chart.draw(data, google.charts.Bar.convertOptions(options));

      }
    </script>
    <div class="con" style="padding:20px; background-color :#ffffff; margin:20px 20px 0 20px;border-radius:5px;border : 2px solid #11101d"><div id="columnchart_material" style="width: auto; height: 650px; margin:20px 20px 0 20px"></div></div>

    </section>
    <script src="../js/main.js"></script>
    <script src="../js/scroll.js"></script>
  </body>
</html>
