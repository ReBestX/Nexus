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
    <title>Register</title>
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
        right: 0%;
      }
      .img2 {
        position: fixed;
        left: 40%;
      }
      .img3 {
        position: fixed;
        top: 50%;
        right: 0;
      }
      @media (max-width:992px) {
        .img2 {
          left: 0;
        }
      }
      .res{
        flex-direction: row-reverse;
      }
      .bgkkk{ background-image: url("../../images/signup-cover.jpg") !important; }
      .opacity-60 {
        opacity: 0.6;
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
            <div class="flex flex-wrap -mx-3 res">
              <div
                class="flex flex-col w-full max-w-full px-3 mx-auto lg:mx-0 shrink-0 md:flex-0 md:w-7/12 lg:w-5/12 xl:w-4/12"
              >
              <div
                  class="p-6 mb-0 text-center border-b-0 rounded-t-2xl gg"
                >
                  <h5 style="color: white;">Register with</h5>
                </div>
                <div class="flex flex-wrap px-3 -mx-3 sm:px-6 xl:px-12">
                  <div class="w-3/12 max-w-full px-1 ml-auto flex-0 gg">
                    <a
                      class="inline-block w-full px-5 py-2.5 mb-4 font-bold text-center text-gray-200 uppercase align-middle transition-all bg-transparent border border-gray-200 border-solid rounded-lg shadow-none cursor-pointer hover:-translate-y-px leading-pro text-xs ease-in tracking-tight-rem bg-150 bg-x-25 hover:bg-transparent hover:opacity-75"
                      href="javascript:;"
                      style="background-color: aliceblue;"
                    >
                      <svg
                        width="24px"
                        height="32px"
                        viewBox="0 0 64 64"
                        version="1.1"
                        xmlns="http://www.w3.org/2000/svg"
                        xmlns:xlink="http://www.w3.org/1999/xlink32"
                      >
                        <g
                          stroke="none"
                          stroke-width="1"
                          fill="none"
                          fill-rule="evenodd"
                        >
                          <g
                            transform="translate(3.000000, 3.000000)"
                            fill-rule="nonzero"
                          >
                            <circle
                              fill="#3C5A9A"
                              cx="29.5091719"
                              cy="29.4927506"
                              r="29.4882047"
                            ></circle>
                            <path
                              d="M39.0974944,9.05587273 L32.5651312,9.05587273 C28.6886088,9.05587273 24.3768224,10.6862851 24.3768224,16.3054653 C24.395747,18.2634019 24.3768224,20.1385313 24.3768224,22.2488655 L19.8922122,22.2488655 L19.8922122,29.3852113 L24.5156022,29.3852113 L24.5156022,49.9295284 L33.0113092,49.9295284 L33.0113092,29.2496356 L38.6187742,29.2496356 L39.1261316,22.2288395 L32.8649196,22.2288395 C32.8649196,22.2288395 32.8789377,19.1056932 32.8649196,18.1987181 C32.8649196,15.9781412 35.1755132,16.1053059 35.3144932,16.1053059 C36.4140178,16.1053059 38.5518876,16.1085101 39.1006986,16.1053059 L39.1006986,9.05587273 L39.0974944,9.05587273 L39.0974944,9.05587273 Z"
                              fill="#FFFFFF"
                            ></path>
                          </g>
                        </g>
                      </svg>
                    </a>
                  </div>
                  <div class="w-3/12 max-w-full px-1 flex-0 gg">
                    <a
                      class="inline-block w-full px-5 py-2.5 mb-4 font-bold text-center text-gray-200 uppercase align-middle transition-all bg-transparent border border-gray-200 border-solid rounded-lg shadow-none cursor-pointer hover:-translate-y-px leading-pro text-xs ease-in tracking-tight-rem bg-150 bg-x-25 hover:bg-transparent hover:opacity-75"
                      href="javascript:;"
                      style="background-color: aliceblue;"
                    >
                      <svg
                        width="24px"
                        height="32px"
                        viewBox="0 0 64 64"
                        version="1.1"
                        xmlns="http://www.w3.org/2000/svg"
                        xmlns:xlink="http://www.w3.org/1999/xlink"
                      >
                        <g
                          stroke="none"
                          stroke-width="1"
                          fill="none"
                          fill-rule="evenodd"
                        >
                          <g
                            transform="translate(7.000000, 0.564551)"
                            fill="#000000"
                            fill-rule="nonzero"
                          >
                            <path
                              d="M40.9233048,32.8428307 C41.0078713,42.0741676 48.9124247,45.146088 49,45.1851909 C48.9331634,45.4017274 47.7369821,49.5628653 44.835501,53.8610269 C42.3271952,57.5771105 39.7241148,61.2793611 35.6233362,61.356042 C31.5939073,61.431307 30.2982233,58.9340578 25.6914424,58.9340578 C21.0860585,58.9340578 19.6464932,61.27947 15.8321878,61.4314159 C11.8738936,61.5833617 8.85958554,57.4131833 6.33064852,53.7107148 C1.16284874,46.1373849 -2.78641926,32.3103122 2.51645059,22.9768066 C5.15080028,18.3417501 9.85858819,15.4066355 14.9684701,15.3313705 C18.8554146,15.2562145 22.5241194,17.9820905 24.9003639,17.9820905 C27.275104,17.9820905 31.733383,14.7039812 36.4203248,15.1854154 C38.3824403,15.2681959 43.8902255,15.9888223 47.4267616,21.2362369 C47.1417927,21.4153043 40.8549638,25.1251794 40.9233048,32.8428307 M33.3504628,10.1750144 C35.4519466,7.59650964 36.8663676,4.00699306 36.4804992,0.435448578 C33.4513624,0.558856931 29.7884601,2.48154382 27.6157341,5.05863265 C25.6685547,7.34076135 23.9632549,10.9934525 24.4233742,14.4943068 C27.7996959,14.7590956 31.2488715,12.7551531 33.3504628,10.1750144"
                            ></path>
                          </g>
                        </g>
                      </svg>
                    </a>
                  </div>
                  <div class="w-3/12 max-w-full px-1 mr-auto flex-0 gg">
                    <a
                      class="inline-block w-full px-5 py-2.5 mb-4 font-bold text-center text-gray-200 uppercase align-middle transition-all bg-transparent border border-gray-200 border-solid rounded-lg shadow-none cursor-pointer hover:-translate-y-px leading-pro text-xs ease-in tracking-tight-rem bg-150 bg-x-25 hover:bg-transparent hover:opacity-75"
                      href="javascript:;"
                      style="background-color: aliceblue;"
                    >
                      <svg
                        width="24px"
                        height="32px"
                        viewBox="0 0 64 64"
                        version="1.1"
                        xmlns="http://www.w3.org/2000/svg"
                        xmlns:xlink="http://www.w3.org/1999/xlink"
                      >
                        <g
                          stroke="none"
                          stroke-width="1"
                          fill="none"
                          fill-rule="evenodd"
                        >
                          <g
                            transform="translate(3.000000, 2.000000)"
                            fill-rule="nonzero"
                          >
                            <path
                              d="M57.8123233,30.1515267 C57.8123233,27.7263183 57.6155321,25.9565533 57.1896408,24.1212666 L29.4960833,24.1212666 L29.4960833,35.0674653 L45.7515771,35.0674653 C45.4239683,37.7877475 43.6542033,41.8844383 39.7213169,44.6372555 L39.6661883,45.0037254 L48.4223791,51.7870338 L49.0290201,51.8475849 C54.6004021,46.7020943 57.8123233,39.1313952 57.8123233,30.1515267"
                              fill="#4285F4"
                            ></path>
                            <path
                              d="M29.4960833,58.9921667 C37.4599129,58.9921667 44.1456164,56.3701671 49.0290201,51.8475849 L39.7213169,44.6372555 C37.2305867,46.3742596 33.887622,47.5868638 29.4960833,47.5868638 C21.6960582,47.5868638 15.0758763,42.4415991 12.7159637,35.3297782 L12.3700541,35.3591501 L3.26524241,42.4054492 L3.14617358,42.736447 C7.9965904,52.3717589 17.959737,58.9921667 29.4960833,58.9921667"
                              fill="#34A853"
                            ></path>
                            <path
                              d="M12.7159637,35.3297782 C12.0932812,33.4944915 11.7329116,31.5279353 11.7329116,29.4960833 C11.7329116,27.4640054 12.0932812,25.4976752 12.6832029,23.6623884 L12.6667095,23.2715173 L3.44779955,16.1120237 L3.14617358,16.2554937 C1.14708246,20.2539019 0,24.7439491 0,29.4960833 C0,34.2482175 1.14708246,38.7380388 3.14617358,42.736447 L12.7159637,35.3297782"
                              fill="#FBBC05"
                            ></path>
                            <path
                              d="M29.4960833,11.4050769 C35.0347044,11.4050769 38.7707997,13.7975244 40.9011602,15.7968415 L49.2255853,7.66898166 C44.1130815,2.91684746 37.4599129,0 29.4960833,0 C17.959737,0 7.9965904,6.62018183 3.14617358,16.2554937 L12.6832029,23.6623884 C15.0758763,16.5505675 21.6960582,11.4050769 29.4960833,11.4050769"
                              fill="#EB4335"
                            ></path>
                          </g>
                        </g>
                      </svg>
                    </a>
                  </div>
                  <div
                    class="relative w-full max-w-full px-3 mt-2 text-center shrink-0"
                  >
                    <p
                      class="z-20 inline px-4 mb-2 font-semibold leading-normal bg-white text-sm text-slate-400 gg"
                      style="background: none;
                      color: white;"
                    >
                      or
                    </p>
                  </div>
                </div>
                <div class="flex-auto p-6">
                  <form action="../../includes/Register.php" method="post">
                  <div class="mb-4 gg">
                      <input
                        type="text"
                        class="focus:shadow-primary-outline dark:bg-gray-950 dark:placeholder:text-white/80 dark:text-white/80 text-sm leading-5.6 ease block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding p-3 font-normal text-gray-700 outline-none transition-all placeholder:text-gray-500 focus:border-fuchsia-300 focus:outline-none"
                        placeholder="First Name"
                        aria-label="First Name"
                        name="firstname"
                        required
                      />
                    </div>
                    <div class="mb-4 gg">
                      <input
                        type="text"
                        class="focus:shadow-primary-outline dark:bg-gray-950 dark:placeholder:text-white/80 dark:text-white/80 text-sm leading-5.6 ease block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding p-3 font-normal text-gray-700 outline-none transition-all placeholder:text-gray-500 focus:border-fuchsia-300 focus:outline-none"
                        placeholder="Last Name"
                        aria-label="Last Name"
                        name="lastname"
                        required
                      />
                    </div>
                    <div class="mb-4 gg">
                      <input
                        type="text"
                        class="focus:shadow-primary-outline dark:bg-gray-950 dark:placeholder:text-white/80 dark:text-white/80 text-sm leading-5.6 ease block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding p-3 font-normal text-gray-700 outline-none transition-all placeholder:text-gray-500 focus:border-fuchsia-300 focus:outline-none"
                        placeholder="Username"
                        aria-label="Username"
                        name="username"
                        required
                      />
                    </div>
                    <div class="mb-4 gg">
                      <input
                        type="email"
                        class="focus:shadow-primary-outline dark:bg-gray-950 dark:placeholder:text-white/80 dark:text-white/80 text-sm leading-5.6 ease block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding p-3 font-normal text-gray-700 outline-none transition-all placeholder:text-gray-500 focus:border-fuchsia-300 focus:outline-none"
                        placeholder="Email"
                        aria-label="Email"
                        aria-describedby="email-addon"
                        name="email"
                        required
                      />
                    </div>
                    <div class="mb-4 gg">
                      <input
                        type="password"
                        class="focus:shadow-primary-outline dark:bg-gray-950 dark:placeholder:text-white/80 dark:text-white/80 text-sm leading-5.6 ease block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding p-3 font-normal text-gray-700 outline-none transition-all placeholder:text-gray-500 focus:border-fuchsia-300 focus:outline-none"
                        placeholder="Password"
                        aria-label="Password"
                        aria-describedby="password-addon"
                        name="password"
                        minlength="8"
                        required
                      />
                    </div>
                    <div class="mb-4 gg">
                      <input
                        type="password"
                        class="focus:shadow-primary-outline dark:bg-gray-950 dark:placeholder:text-white/80 dark:text-white/80 text-sm leading-5.6 ease block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding p-3 font-normal text-gray-700 outline-none transition-all placeholder:text-gray-500 focus:border-fuchsia-300 focus:outline-none"
                        placeholder="Confirm Password"
                        aria-label="Password"
                        aria-describedby="password-addon"
                        name="confirm_password"
                        minlength="8"
                        required
                      />
                    </div>
                    <div class="min-h-6 pl-7 mb-0.5 block gg">
                      <input
                        class="w-4.8 h-4.8 ease -ml-7 rounded-1.4 checked:bg-gradient-to-tl checked:from-blue-500 checked:to-violet-500 after:text-xxs after:font-awesome after:duration-250 after:ease-in-out duration-250 relative float-left mt-1 cursor-pointer appearance-none border border-solid border-slate-200 bg-white bg-contain bg-center bg-no-repeat align-top transition-all after:absolute after:flex after:h-full after:w-full after:items-center after:justify-center after:text-white after:opacity-0 after:transition-all after:content-['\f00c'] checked:border-0 checked:border-transparent checked:bg-transparent checked:after:opacity-100"
                        type="checkbox"
                        value=""
                        id="flexCheckDefault"
                        name="checkbox"
                      />
                      <label
                        class="mb-2 ml-1 font-normal cursor-pointer text-sm text-slate-700"
                        for="flexCheckDefault"
                        style="color: white;"
                      >
                        I agree the
                        <a href="javascript:;" class="font-bold text-slate-700" style="color: white;"
                          >Terms and Conditions</a
                        >
                      </label>
                    </div>
                    <div class="text-center gg">
                      <button
                        type="submit"
                        name="submit"
                        class="inline-block w-full px-16 py-3.5 mt-6 mb-0 font-bold leading-normal text-center text-white align-middle transition-all bg-blue-500 border-0 rounded-lg cursor-pointer hover:-translate-y-px active:opacity-85 hover:shadow-xs text-sm ease-in tracking-tight-rem shadow-md bg-150 bg-x-25"
                      >
                        Sign up
                      </button>
                    </div>
                    <?php include "../includes/db.php";
                    if(isset($_GET['message'])  && !empty(trim($_GET['message']))){
                      $message = $_GET['message'];
                      $message = mysqli_real_escape_string($connection, trim($_GET['message']));
                      $message = htmlspecialchars($message);
                      if($message == "error"){
                        $message = "All fields are required";
                        echo "<p style='background-color: #d32121; text-align: center; padding: 10px 0; color : white; font-size:15px; border-radius: 10px;' class='mt-4 mb-0 leading-normal text-sm gg'>{$message}!</p>";
                      }else if($message == "error2"){
                        $message = "Invalid email format";
                        echo "<p style='background-color: #d32121; text-align: center; padding: 10px 0; color : white; font-size:15px; border-radius: 10px;' class='mt-4 mb-0 leading-normal text-sm gg'>{$message}!</p>";
                      }else if($message == "error3"){
                        $message = "Username already exists";
                        echo "<p style='background-color: #d32121; text-align: center; padding: 10px 0; color : white; font-size:15px; border-radius: 10px;' class='mt-4 mb-0 leading-normal text-sm gg'>{$message}!</p>";
                      }else if($message == "error4"){
                        $message = "Email already exists";
                        echo "<p style='background-color: #d32121; text-align: center; padding: 10px 0; color : white; font-size:15px; border-radius: 10px;' class='mt-4 mb-0 leading-normal text-sm gg'>{$message}!</p>";
                      }else if($message == "error5"){
                        $message = "Password does not match";
                        echo "<p style='background-color: #d32121; text-align: center; padding: 10px 0; color : white; font-size:15px; border-radius: 10px;' class='mt-4 mb-0 leading-normal text-sm gg'>{$message}!</p>";
                      }else if($message == "error6"){
                        $message = "Please agree to the terms and conditions";
                        echo "<p style='background-color: #d32121; text-align: center; padding: 10px 0; color : white; font-size:15px; border-radius: 10px;' class='mt-4 mb-0 leading-normal text-sm gg'>{$message}!</p>";
                      }
                    }
                    ?>
                    <p style="color: white; text-align: center;" class="mt-4 mb-0 leading-normal text-sm gg">
                      Already have an account?
                      <a
                        href="../sign-in/"
                        class="font-semibold text-transparent bg-clip-text bg-gradient-to-tl from-blue-500 to-violet-500"
                        >Sign in</a
                      >
                    </p>
                  </form>
                </div>
              </div>
              <div
                class="absolute top-0 right-0 flex-col justify-center hidden w-6/12 h-full max-w-full px-3 pr-0 my-auto text-center flex-0 lg:flex" style="left: 0;"
              >
                <div
                  class="relative flex flex-col justify-center h-full bg-cover px-24 m-4 overflow-hidden rounded-xl bgkkk"
                >
                  <span
                    class="absolute top-0 left-0 w-full h-full bg-center bg-cover bg-gradient-to-tl from-blue-500 to-violet-500 opacity-60" style="--tw-gradient-from: #000000 !important;"
                  ></span>
                  <h4 class="z-20 mt-12 font-bold text-white" style="font-size: 35px;">
                    "Keep it special"
                  </h4>
                  <p class="z-20 text-white" style="font-size: 19px;">
                    Capture your personal memory in unique way, anywhere.
                  </p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
    </main>
  </body>
  <script src="../../js/signup.js"></script>
  <!-- plugin for scrollbar  -->
  <script src="../../js/plugins/perfect-scrollbar.min.js" async></script>
  <!-- main script file  -->
  <script src="../../js/argon-dashboard-tailwind.js?v=1.0.1" async></script>
</html>
