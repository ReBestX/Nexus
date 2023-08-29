<?php session_start();
if(isset($_SESSION['username'])){
  header("location: ../index");
  exit;
}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link
      rel="apple-touch-icon"
      sizes="76x76"
      href="../../assets/img/apple-icon.png"
    />
    <link rel="icon" href="../../images/NexusLogo.png">
    <title>Reset Password</title>
    <!--     Fonts and icons     -->
    <link
      href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700"
      rel="stylesheet"
    />
    <!-- Font Awesome Icons -->
    <script
      src="https://kit.fontawesome.com/42d5adcbca.js"
      crossorigin="anonymous"
    ></script>
    <!-- Nucleo Icons -->
    <link href="../../src/nucleo-icons.css" rel="stylesheet" />
    <link href="../../src/nucleo-svg.css" rel="stylesheet" />
    <!-- Main Styling -->
    <link href="../../src/argon-dashboard-tailwind.css?v=1.0.1" rel="stylesheet" />
    <script src="https://unpkg.com/scrollreveal@4"></script>
    <style>
      body{
        background-color: #1f2125 !important;
      }
      .img{
        display: flex;
        justify-content: flex-start;
        align-items: center;
        padding: 1.5rem
      }
      .img img{
        max-width: 300px;
      }
      .backimg img {
        z-index: -100;
      }
      .img1 {
        position: fixed;
        right: 40%;
      }
      .img2 {
        position: fixed;
        top: 50%;
      }
      .img3 {
        position: fixed;
        left: -10%;
      }
      @media (max-width:992px) {
        .img1 {
          right: 0;
        }
      }
      .bkp{
        background-image: url("../../images/signin-ill.jpg");
      }
    </style>
    <script>
      ScrollReveal({ duration: 1000 });
    </script>
  </head>
  <body
    class="m-0 font-sans antialiased font-normal bg-white text-start text-base leading-default text-slate-500"
  >
  <div class="backimg">
    <img class="img1" src="../../images/Vector 1.png" alt="">
    <img class="img2" src="../../images/Vector 2.png" alt="">
    <img class="img3" src="../../images/Vector 3.png" alt="">
  </div>
    <main class="mt-0 transition-all duration-200 ease-in-out">
      <section>
        <div
          class="relative flex items-center min-h-screen p-0 overflow-hidden bg-center bg-cover"
        >
          <div class="container z-1">
            <div class="flex flex-wrap -mx-3">
              <div
                class="flex flex-col w-full max-w-full px-3 mx-auto lg:mx-0 shrink-0 md:flex-0 md:w-7/12 lg:w-5/12 xl:w-4/12"
              >
              <a href="../index" class="img"><img src="../../images/NexusLogo2 (5).png" alt=""></a>
              <?php include "../includes/db.php";
                  if(isset($_GET['message2']) && !empty(trim($_GET['message2']))){
                      $message2 = $_GET['message2'];
                      $message2 = mysqli_real_escape_string($connection, trim($_GET['message2']));
                      $message2 = htmlspecialchars($message2);
                      if($message2 == "error"){
                        $message2 = "passwords do not match";
                        echo "<p style='background-color: #d32121 ; text-align: center; padding: 10px 0; color : white; font-size:15px; border-radius: 10px;margin: 0 1.5rem;' class='mt-4 mb-0 leading-normal text-sm gg'>{$message2}!</p>";
                      }
                  }
                  ?>
                  <?php
                  include "../includes/db.php";
                  if (isset($_GET['token']) && !empty(trim($_GET['token']))) {
                      $token = $_GET['token'];
                      $token = mysqli_real_escape_string($connection, trim($token));
                      $token = htmlspecialchars($token);
                      $query = "SELECT * FROM users WHERE token = '$token'"; // Add single quotes around $token
                      $result = mysqli_query($connection, $query);
                      if (mysqli_num_rows($result) == 0) {
                          header("Location: ../../dist/sign-in/error5");
                          exit;
                      } else {
                          while ($row = mysqli_fetch_assoc($result)) {
                              $username = $row['user_username'];
                              $token = $row['token'];
                          }
                      }
                  }
                  ?>
                <div
                  class="relative flex flex-col min-w-0 break-words bg-transparent border-0 shadow-none lg:py4 dark:bg-gray-950 rounded-2xl bg-clip-border"
                >
                  <div class="p-6 pb-0 mb-0">
                    <h4 class="font-bold gg" style="color: white;">Set Your New Password</h4>
                    <p class="mb-0 gg" style="color: #f1f1f1;">Enter your New Password to sign in</p>
                  </div>
                  <div class="flex-auto p-6 ">
                    <form action="../../includes/NewPassword.php" method="post">
                      <input type="hidden" name="token" value="<?php echo $token; ?>">
                      <div class="mb-4 gg">
                        <input
                          type="password"
                          placeholder="new password"
                          class="focus:shadow-primary-outline dark:bg-gray-950 dark:placeholder:text-white/80 dark:text-white/80 text-sm leading-5.6 ease block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding p-3 font-normal text-gray-700 outline-none transition-all placeholder:text-gray-500 focus:border-fuchsia-300 focus:outline-none"
                          name="password"
                          minlength="8"
                          required
                        />
                      </div>
                      <div class="mb-4 gg">
                        <input
                          type="password"
                          placeholder="Confirm Password"
                          class="focus:shadow-primary-outline dark:bg-gray-950 dark:placeholder:text-white/80 dark:text-white/80 text-sm leading-5.6 ease block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding p-3 font-normal text-gray-700 outline-none transition-all placeholder:text-gray-500 focus:border-fuchsia-300 focus:outline-none"
                          name="cPassword"
                          minlength="8"
                          required
                        />
                      </div>
                      <div class="text-center gg">
                        <button
                        style="margin-top: 0;"
                          type="submit"
                          name="submit"
                          class="inline-block w-full px-16 py-3.5 mt-6 mb-0 font-bold leading-normal text-center text-white align-middle transition-all bg-blue-500 border-0 rounded-lg cursor-pointer hover:-translate-y-px active:opacity-85 hover:shadow-xs text-sm ease-in tracking-tight-rem shadow-md bg-150 bg-x-25"
                        >
                          Save
                        </button>
                      </div>
                    </form>
                    <?php include "../includes/db.php";
                    if(isset($_GET['message']) && !empty(trim($_GET['message']))){
                      $message = $_GET['message'];
                      $message = mysqli_real_escape_string($connection, trim($_GET['message']));
                      $message = htmlspecialchars($message);
                      if($message == "error"){
                        $message = "incorrect password";
                        echo "<p style='background-color: #d32121; text-align: center; padding: 10px 0; color : white; font-size:15px; border-radius: 10px;margin: 1.5rem 1.5rem 0 1.5rem;' class='mt-4 mb-0 leading-normal text-sm gg'>{$message}!</p>";
                      }else if($message == "error2"){
                        $message = "username not found";
                        echo "<p style='background-color: #d32121; text-align: center; padding: 10px 0; color : white; font-size:15px; border-radius: 10px;margin: 1.5rem 1.5rem 0 1.5rem;' class='mt-4 mb-0 leading-normal text-sm gg'>{$message}!</p>";
                      }
                    }
                    ?>
                  </div>
                  <div
                    class="border-black/12.5 rounded-b-2xl border-t-0 border-solid p-6 text-center pt-0 px-1 sm:px-6 gg"
                  >
                    <p class="mx-auto mb-6 leading-normal text-sm" style="color: white;">
                      Don't have an account?
                      <a
                        href="../sign-up/"
                        class="font-semibold text-transparent bg-clip-text bg-gradient-to-tl from-blue-500 to-violet-500"
                        >Sign up</a
                      >
                    </p>
                  </div>
                </div>
              </div>
              <div
                class="absolute top-0 right-0 flex-col justify-center hidden w-6/12 h-full max-w-full px-3 pr-0 my-auto text-center flex-0 lg:flex"
              >
                <div
                  class="relative flex flex-col justify-center h-full bg-cover px-24 m-4 overflow-hidden rounded-xl bkp"
                >
                  <span
                    class="absolute top-0 left-0 w-full h-full bg-center bg-cover bg-gradient-to-tl from-blue-500 to-violet-500 opacity-60" style="--tw-gradient-from: #000000 !important;"
                  ></span>
                  <h4 class="z-20 mt-12 font-bold text-white">
                    "Attention is the new currency"
                  </h4>
                  <p class="z-20 text-white">
                    The more effortless the writing looks, the more effort the
                    writer actually put into the process.
                  </p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
    </main>
  </body>
  <script src="../../js/login.js"></script>
  <!-- plugin for scrollbar  -->
  <script src="../../js/plugins/perfect-scrollbar.min.js" async></script>
  <!-- main script file  -->
  <script src="../../js/argon-dashboard-tailwind.js?v=1.0.1" async></script>
</html>
