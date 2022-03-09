 <?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
session_start();

    include("connection.php");
    include("functions.php");

 
    if($_SERVER['REQUEST_METHOD'] == "POST")
    {
        //something was posted
        $user_name = mysqli_real_escape_string($con, $_POST['user_name']);
        $password = mysqli_real_escape_string($con, $_POST['password']);

        if(!empty($user_name) && !empty($password) && !is_numeric($user_name))
        {

            //read from database 
            // fix OR clause
            $checkForEmail = mysqli_query($con, "SELECT user_id, user_name, password, email FROM users WHERE user_name = '".$user_name."' OR email = '".$user_name."'");

            if($checkForEmail){

                if(mysqli_num_rows($checkForEmail) > 0 ){

                    //$userFound = mysqli_fetch_assoc($checkForEmail); 
                    while($row = mysqli_fetch_assoc($checkForEmail)) {
                        $dbpass = $row['password'];
                        $u_id = $row['user_id'];
                      }
                    // echo $dbpass;
                    // echo $u_id;
                    
                        // verify hash against user typed password
                        if(password_verify($password, $dbpass)){ 
                            $_SESSION['user_id'] = $u_id;
                            header("Location: index.php");
                        }
                    
                }else{

                    $error = "Incorrect Username or Password";
                    
                }
            }

            // $query = "select user_name, password, email from users where user_name = '$user_name' limit 1";
            // $result = mysqli_query($con, $query);

            // if($result)
            // {
            //     if($result && mysqli_num_rows($result) > 0)
            //     {
            //         $user_data = mysqli_fetch_assoc($result);
                    
            //         if($user_data['password'] == $password)
            //         {
            //             $_SESSION['user_id'] = $user_data['user_id'];
            //             header("Location: index.php");
            //             die;
            //         }
            //     }
            // }
           
            // echo "Wrong username or password";
        }else{

            $error = "Username or password should not be left empty";

        }
    }

?>


 <!DOCTYPE html>
 <html lang="en">

 <head>
     <meta charset="UTF-8" />
     <meta http-equiv="X-UA-Compatible" content="IE=edge" />
     <meta name="viewport" content="width=device-width, initial-scale=1.0" />
     <link rel="preconnect" href="https://fonts.googleapis.com" />
     <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
     <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet" />

     <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
         integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
     <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
         integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
     </script>
     <script src="https://cdn.lordicon.com/lusqsztk.js"></script>
     <script src="https://cdn.lordicon.com/lusqsztk.js"></script>
     <link rel="stylesheet" href="Styles/style.css">

     <title>Login Page</title>
 </head>

 <body>
     <!-- <div id="h1t">
         <!-- <h2 align="center" >Welcome to the Farmer's Bank Please login to continue</h2> -->
     <!-- </div> -->
     <?php
                if(isset($error)){
                    
                    echo '<div class="alert alert-danger" role="alert">
                    '.$error.'
                  </div>';
                }else{
                    echo "";
                }
            ?>
     <main id="mainContainer">
         <section id="box">
             <h2>Welcome Back</h2>
             <p>Welcome Back! Please enter you details</p>

             <form method="post">
                 <!-- <label><img src="https://icon-library.com/images/user-icon-image/user-icon-image-20.jpg" width="20" height="20" /> Username </label>  -->
                 <!-- <lord-icon src="https://cdn.lordicon.com/pdpnqfoe.json" trigger="loop"
                     colors="primary:#f24c00,secondary:#66d7ee" style="width: 50px;height:50px"> -->
                 <!-- </lord-icon> -->
                 <label label for="user_name">Username/Email</label>
                 <input id="text" type="text" name="user_name" placeholder="Enter UserName" required><br>
                 <!-- <label><img src="https://www.maxpixel.net/static/photo/1x/Lock-Image-Security-Lock-Cyber-Security-Lock-Icon-1915628.png" width="26" height="25" /> Password</label>  -->
                 <!-- <lord-icon src="https://cdn.lordicon.com/xtrjgsiz.json" trigger="loop" style="width:50px;height:50px">
                 </lord-icon> -->
                 <label for="password">Password</label>
                 <input id="text" type="password" name="password" placeholder="Enter Password" required>
                 <br><br>

                 <button id="button" type="submit" align="center">Log In</button>
                 <br><br>

                 <span>Don't have an account?</span><a href="signup.php" id="suplink">Click to Signup</a><br><br>
             </form>
             </div>
             <div id="imgDiv">
                 <img id="logoImg" src="images/nate-johnston-MRh6Kb16afE-unsplash - Copy.jpg" />
             </div>
             </div>
             <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
                 integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3"
                 crossorigin="anonymous">
             <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
                 integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p"
                 crossorigin="anonymous">
             </script>
 </body>

 </html>