<?php
// Include config file
require_once "config.php";
 
// Define variables and initialize with empty values
$username = $password = $confirm_password = "";
$username_err = $password_err = $confirm_password_err = "";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
  {
    // Validate username
    if(empty(trim($_POST["username"]))){
        $username_err = "Please enter a username.";
    }  else{
                    $username = trim($_POST["username"]);
                } 

            // Close statement
        }
    
    // Validate password
    if(empty(trim($_POST["password"]))){
        $password_err = "Please enter a password.";     
    } elseif(strlen(trim($_POST["password"])) < 6){
        $password_err = "Password must have atleast 6 characters.";
    } else{
        $password = trim($_POST["password"]);
    }
    
    // Validate confirm password
    if(empty(trim($_POST["confirm_password"]))){
        $confirm_password_err = "Please confirm password.";     
    } else{
        $confirm_password = trim($_POST["confirm_password"]);
        if(empty($password_err) && ($password != $confirm_password)){
            $confirm_password_err = "Password did not match.";
        }
    }
    
    // Check input errors before inserting in database
    if(empty($username_err) && empty($password_err) && empty($confirm_password_err)){
        
        // Prepare an insert statement
        $sql = "INSERT INTO users (username, password) VALUES (?, ?)";
         
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "ss", $param_username, $param_password);
            
            // Set parameters
            $param_username = $username;
            $param_password = password_hash($password, PASSWORD_DEFAULT); // Creates a password hash
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Redirect to login page
                // header("location: login.php");
                echo "success";
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }

            // Close statement
            mysqli_stmt_close($stmt);
        }
    }
    
    // Close connection
    mysqli_close($link);
  }
?>
 
 <!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta
      http-equiv="Cache-Control"
      content="no-cache, no-store, must-revalidate"
    />
    <meta http-equiv="Pragma" content="no-cache" />
    <meta http-equiv="Expires" content="0" />
    <title>Mind Space</title>
     <!-- CSS Reset -->
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/8.0.1/normalize.min.css" integrity="sha512-NhSC1YmyruXifcj/KFRWoC561YpHpc5Jtzgvbuzx5VozKpWvQ+4nXhPdFgmx8xqexRcpAglTj9sIBWINXa8x5w==" crossorigin="anonymous" />
    <!-- styles -->
    <link rel="stylesheet" href="style.css" />
    <link rel="stylesheet" href="index.css"/>
    <!-- SmoothScroll -->
    <script src="https://cdn.jsdelivr.net/gh/cferdinandi/smooth-scroll/dist/smooth-scroll.polyfills.min.js"></script>
    <!-- Font awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.14.0/css/all.min.css" integrity="sha512-1PKOgIY59xJ8Co8+NE6FZ+LOAZKjy+KY8iq0G4B3CyeY6wYHN3yt9PW0XpSriVlkMXe40PTKnXrLnZ9+fkDaog==" crossorigin="anonymous"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- bootstrap -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css"
    />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-migrate/3.3.1/jquery-migrate.min.js" integrity="sha512-wDH73bv6rW6O6ev5DGYexNboWMzBoY+1TEAx5Q/sdbqN2MB2cNTG9Ge/qv3c1QNvuiAuETsKJnnHH2UDJGmmAQ==" crossorigin="anonymous" ></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <!-- Link Swiper's CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Swiper/5.4.5/css/swiper.css" integrity="sha512-uMIpMpgk4n6esmgdfJtATLLezuZNRb96YEgJXVeo4diHFOF/gqlgu4Y5fg+56qVYZfZYdiqnAQZlnu4j9501ZQ==" crossorigin="anonymous" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/tilt.js/1.2.1/tilt.jquery.min.js" integrity="sha512-u1L7Dp3BKUP3gijgSRoMTNxmDl/5o+XOHupwwa7jsI1rMzHrllSLKsGOfqjYl8vrEG+8ghnRPNA/SCltmJCZpQ=="  crossorigin="anonymous"></script>
    <link href="https://fonts.googleapis.com/css2?family=Libre+Baskerville:wght@700&display=swap" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Ubuntu&display=swap" rel="stylesheet"/>
    <link href="//db.onlinewebfonts.com/c/0f7a67e55701367f6f5602bf32c3bf5c?family=Yoxall" rel="stylesheet" type="text/css"/>
    <!--aos-->
    <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />

    <script src="https://unpkg.com/aos@next/dist/aos.js"></script>
  </head>
  </head>

  <body id="body" class="light-mode">
    <div class="landing-page-bar" id="landingbar">
      <div class="desktop-page-bar">
        <div>
          <img
            src="./images/logo.png"
            style="
              width: 70px;
              height: 50px;
              transition: 1s;
              margin-top: -10px;
            "
          />
        </div>
        <ul>
          <li><a href="index.html">HOME</a></li>
          <li><a href="#about">ABOUT</a></li>
        </ul>
      </div>
    </div>
    <header id="header">
      <div class="preloader">
        <img src="./images/pandagif.gif" style="border-radius: 50%;"alt="spinner" />
      </div>

      <div class="nav-div">
        <nav id="sideNav">
          <ul>
            <li><a href="index.html">HOME</a></li>
            <li><a href="#about">ABOUT US</a></li>
            <li><a href="login.php">LOGIN</a></li>
          </ul>
          <div class="mode-div">
            <i class="fas fa-sun"></i>
            <input type="checkbox" id="switch" onclick="toggleDarkLight()" />
            <label class="mode" for="switch"></label>
            <i class="fas fa-moon"></i>
          </div>
        </nav>
        <i class="fas fa-bars" id="menuBtn" onclick="openNav()"></i>
      </div>
    </header>
    
      <div class="wrapper">
        <h2>Sign Up</h2>
        <p>Please fill this form to create an account.</p>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="form-group">
                <label>Username</label>
                <input type="text" name="username" class="form-control <?php echo (!empty($username_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $username; ?>">
                <span class="invalid-feedback"><?php echo $username_err; ?></span>
            </div>    
            <div class="form-group">
                <label>Password</label>
                <input type="password" name="password" class="form-control <?php echo (!empty($password_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $password; ?>">
                <span class="invalid-feedback"><?php echo $password_err; ?></span>
            </div>
            <div class="form-group">
                <label>Confirm Password</label>
                <input type="password" name="confirm_password" class="form-control <?php echo (!empty($confirm_password_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $confirm_password; ?>">
                <span class="invalid-feedback"><?php echo $confirm_password_err; ?></span>
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Submit">
                <input type="reset" class="btn btn-secondary ml-2" value="Reset">
            </div>
            <p>Already have an account? <a href="login.php">Login here</a>.</p>
        </form>
    </div>    


    <section id="footer">
      <div class="desktop-view-footer">
        <div class="container footer-row">
          <hr />
          <div class="footer-left-col">
            <div class="footer-links">
            <div class="link-title">
                      <h4 href="index.html">Our App</h4>
                    </div>
                    <div class="link-title">
                      <h4 href="#about">About Us</h4>
                    </div>
                    <div class="link-title">
                      <h4 href="https://in.linkedin.com">Contact</h4>
                    </div>
              <div class="link-title">
                <h4>Follow Us</h4>
                <div class="footer-social">
                <a href="https://www.facebook.com/"><i class="fab fa-facebook-square"></i></a>
                  <a href="https://twitter.com/?lang=en-in"><i class="fab fa-twitter-square"></i></a>
                  <a href="https://www.instagram.com"><i class="fab fa-instagram-square"></i></a>
                  <a href="https://in.linkedin.com"><i class="fab fa-linkedin"></i></a>
                </div>
              </div>
            </div>
          </div>
          <div class="footer-right-col">
            <div class="footer-info">
              <div class="footer-logo">
                <img class="footer_logo" src="./images/panda2.jpg" />
              </div>
            </div>
          </div>
        </div>
      </div>
     
    </section>

    <!-- Comment Script -->
  
    <script src='https://cdnjs.cloudflare.com/ajax/libs/vue/2.6.14/vue.min.js'></script>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js'></script>

    <!-- External Script -->
    <script src="script.js"></script>
    <script>
      AOS.init({
        once: true,
      });
    </script>
  </body>
</html>


   