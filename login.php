<?php
    // Include the database connection
    include "includes/dbconnect.php";
    session_start();
    $error='';
    $success='';

    // Check if the form is submitted
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $email = $_POST['email'];
        $password = md5($_POST['password']); // For simplicity, no hashing here
        

        // Check user credentials
        $sql = "SELECT * FROM users WHERE (email='$email' OR phone='$email') AND password='$password'";
        
        $result = $conn->query($sql);

        if ($result->num_rows == 1) {
            $success= "Login successful!";
            $user = $result->fetch_assoc();
            $verified=$user['verified'];
            $error=$verified;
            if($verified==="1"){
                $_SESSION['user'] = $user;
                header("Location: index.php"); 

            }
            else{
                header("Location: verify.php"); 

            }
            
        
        // Redirect to a dashboard or profile page
        
        } else {
            $error= "Login failed. Invalid email or password.";
        }
    }

    // Close the database connection
    $conn->close();
    ?>
<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="utf-8" />
        <title>HanasConnect</title>
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta content="" name="description" />
        <meta content="MyraStudio" name="author" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />

        <!-- App favicon -->
        <link rel="shortcut icon" href="img/logo.png">

        <!-- App css -->
        <link href="assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <link href="assets/css/icons.min.css" rel="stylesheet" type="text/css" />
        <link href="mcss/style.css" rel="stylesheet" type="text/css" />
        <style>
            .form{
                /* width: 400px !important; */

            }
            </style>

    </head>

    <body class="signup-body">
 
            <div>
                
                    <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-12">
                            <div class="d-flex align-items-center min-vh-100">
                                <div class="w-100 d-block ">
                                    <div class="row align-items-center justify-content-around">
                                   
                                       
                                    <div class="col-lg-5 col-md-6">
                                        <div class="p-2">
                                        <div class="row mt-4">
                                                <div class="col-12 text-center">
                                                    <img src="img/new/logo.png" class="footer-logo" alt="">
                                                    
                                                    <a href="#" class="text-dark mt-3 font-size-22 font-family-secondary">
                                                  <h3>  <i class="mdi mdi-alpha-S-circle"></i> <b>Login</b></h3>
                                                </a>
                                                    <p class="text-muted mb-0">New here? <a href="signup.php" class="text-muted font-weight-bold ml-1"><b>Signup</b></a></p>
                                                </div>
                                            </div>
                                            <div class="text-center mb-2">
                                                
                                                <h6 class="text-danger"><?php echo $error;?></h6>
                                                <h6 class="text-success"><?php echo $success;?></h6>
                                            </div>
                                            <form class="user" method="POST" action="" onsubmit="return onSubmit()">
                                                <div class="form-group">
                                                    <input type="email" class="form-control form-control-user input-btn" id="exampleInputEmail" placeholder="Email or phone number" name="email">
                                                </div>
                                                <div class="form-group">
                                                    <div class="input-group">
                                                        <input type="password" class="form-control form-control-user input-btn" id="password" placeholder="Password" name="password">
                                                        <div class="input-group-append">
                                                            <span class="input-group-text toggle-password" toggle="#password"><i class="fas fa-eye"></i></span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <input type="submit" class="brown-btn-filled w-100 waves-effect waves-light" value="Login" id="login-button">
                                                </div>
                                            </form>


                                            <p class="or-divider">
                                         <span class="px-2">   OR</span>
                                           </p>

                                          <!-- Google Sign-In Button -->
                                          <div class="row mt-4">
                                                <div class="col-12 text-center">
                                                    <button class="brown-btn-outline w-100"> <img src="img/new/google.svg" class="social-icon me-1" alt=""> Continue with Google</button>
                                                </div>
                                            </div>
                                        </div> <!-- end .padding-5 -->
                                    </div>
 <!-- end col -->
                                    <div class="col-lg-5 col-md-6 d-none d-md-block ">
                                        <img src="img/new/login-img.svg" class="img-fluid" alt="">
                                            <h3 class="mt-3 text-center">
                                                Welcome back
                                            </h3>
                                            <p class="text-center">
                                                Feel free to:
                                            </p>
                                            <ul>
                                                <li>Create your job listing</li>
                                                <li>Browse our providers list</li>
                                                <li>Find the best Talent for your business</li>
                                                <li>Unlock many more possibilities</li>
                                            </ul>
                                    </div>
                                    </div> <!-- end row -->
                                </div> <!-- end .w-100 -->
                            </div> <!-- end .d-flex -->
                        </div> <!-- end col-->
                    </div> <!-- end row -->
                </div>
                
                <!-- end container -->
            </div>
            <!-- end page -->
        
            <!-- jQuery  -->
            <script>
        document.addEventListener("DOMContentLoaded", function () {
            const togglePassword = document.querySelectorAll('.toggle-password');

            togglePassword.forEach(function (toggle) {
                toggle.addEventListener('click', function () {
                    const passwordInput = document.querySelector(this.getAttribute('toggle'));
                    if (passwordInput.type === 'password') {
                        passwordInput.type = 'text';
                    } else {
                        passwordInput.type = 'password';
                    }
                });
            });
        });
    </script>
            <script src="assets/js/jquery.min.js"></script>
            <script src="assets/js/bootstrap.bundle.min.js"></script>
            <script src="assets/js/metismenu.min.js"></script>
            <script src="assets/js/waves.js"></script>
            <script src="assets/js/simplebar.min.js"></script>
        
            <!-- App js -->
            <script src="assets/js/theme.js"></script>

            <script>
    function onSubmit() {
        // Get the email and password input values
        var email = document.querySelector('#exampleInputEmail').value;
        var password = document.querySelector('#password').value;

        // Check if both fields are not empty
        if (email.trim() !== '' && password.trim() !== '') {
            // Change the button text to "Please wait..."
            document.querySelector('#login-button').value = "Please wait...";
            // Disable the button
            document.querySelector('#login-button').disabled = true;

            // You can also show a loading spinner or perform any other necessary actions here

            // Return true to submit the form
            return true;
        } else {
            // If fields are empty, prevent form submission
            return false;
        }
    }
</script>
        
        </body>
        
        </html>