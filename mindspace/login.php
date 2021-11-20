<?php
// Initialize the session
session_start();
 
// Check if the user is already logged in, if yes then redirect him to welcome page
if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
    echo "successfully logged in!";
    header("location: index1.html");
    exit;
}
 
// Include config file
require_once "config.php";
 
// Define variables and initialize with empty values
$username = $password = "";
$username_err = $password_err = $login_err = "";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    // Check if username is empty
    if(empty(trim($_POST["username"]))){
        $username_err = "Please enter username.";
    } else{
        $username = trim($_POST["username"]);
    }
    
    // Check if password is empty
    if(empty(trim($_POST["password"]))){
        $password_err = "Please enter your password.";
    } else{
        $password = trim($_POST["password"]);
    }
    
    // Validate credentials
    if(empty($username_err) && empty($password_err)){
        // Prepare a select statement
        $sql = "SELECT id, username, password FROM users WHERE username = ?";
        
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $param_username);
            
            // Set parameters
            $param_username = $username;
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Store result
                mysqli_stmt_store_result($stmt);
                
                // Check if username exists, if yes then verify password
                if(mysqli_stmt_num_rows($stmt) == 1){                    
                    // Bind result variables
                    mysqli_stmt_bind_result($stmt, $id, $username, $hashed_password);
                    if(mysqli_stmt_fetch($stmt)){
                        if(password_verify($password, $hashed_password)){
                            // Password is correct, so start a new session
                            session_start();
                            
                            // Store data in session variables
                            $_SESSION["loggedin"] = true;
                            $_SESSION["id"] = $id;
                            $_SESSION["username"] = $username;                            
                            
                            // Redirect user to welcome page
                            header("location: index1.html");
                        } else{
                            // Password is not valid, display a generic error message
                            $login_err = "Invalid username or password.";
                        }
                    }
                } else{
                    // Username doesn't exist, display a generic error message
                    $login_err = "Invalid username or password.";
                }
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
    <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/8.0.1/normalize.min.css" integrity="sha512-NhSC1YmyruXifcj/KFRWoC561YpHpc5Jtzgvbuzx5VozKpWvQ+4nXhPdFgmx8xqexRcpAglTj9sIBWINXa8x5w==" crossorigin="anonymous" /> -->
    <!-- styles -->
    <link rel="stylesheet" href="style.css" />
    <link rel="stylesheet" href="index.css"/>
    <!-- SmoothScroll -->
    <script src="https://cdn.jsdelivr.net/gh/cferdinandi/smooth-scroll/dist/smooth-scroll.polyfills.min.js"></script>
    <!-- Font awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.14.0/css/all.min.css" integrity="sha512-1PKOgIY59xJ8Co8+NE6FZ+LOAZKjy+KY8iq0G4B3CyeY6wYHN3yt9PW0XpSriVlkMXe40PTKnXrLnZ9+fkDaog==" crossorigin="anonymous"/>
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
          <li><a href="logout.php">LOGOUT</a></li>

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
            <li><a href="logout.php">LOGOUT</a></li>

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
        <h2>Login</h2>
        <p>Please fill in your credentials to login.</p>

        <?php 
        if(!empty($login_err)){
            echo '<div class="alert alert-danger">' . $login_err . '</div>';
        }        
        ?>

        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="form-group">
                <label>Username</label>
                <input type="text" name="username" class="form-control <?php echo (!empty($username_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $username; ?>">
                <span class="invalid-feedback"><?php echo $username_err; ?></span>
            </div>    
            <div class="form-group">
                <label>Password</label>
                <input type="password" name="password" class="form-control <?php echo (!empty($password_err)) ? 'is-invalid' : ''; ?>">
                <span class="invalid-feedback"><?php echo $password_err; ?></span>
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Login">
            </div>
            <p>Don't have an account? <a href="register.php">Sign up now</a>.</p>
        </form>
    </div>

    <section id="footer">
      <div class="desktop-view-footer">
        <div class="container footer-row">
          <hr />
          <div class="footer-left-col">
            <div class="footer-links">
            <div class="link-title">
                     <a href="index.html"><h4>Our App</h4></a>
                    </div>
                    <div class="link-title">
                      <a href="#about">About Us</h4></a>
                    </div>
                    <div class="link-title">
                      <a href="https://in.linkedin.com">Contact</h4></a>
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


   
    