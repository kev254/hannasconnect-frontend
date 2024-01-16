<?php
    // Include the database connection
    include "includes/dbconnect.php";
    session_start();
    $error="";
    

    // Check if the form is submitted
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $email = $_POST['email'];
        $user_id=$_GET['id'];
        $password = $_POST['password']; // No longer using md5
        $phone = $_POST['phone'];
        $name = $_POST['name'];
        $pass=md5($password);
        $api_key = "2029bfa7c1d943a49f15cef0c00c1969";
        $sender_id = "Easytext";
        $otp = rand(1000, 9999);
        $c_password=$_POST['c_password'];
        $message = "Hello ". $name. " your OTP is ". $otp. " follow https://hannasconnect.co.ke to verify your account";
        

        if($password!==$c_password){
            $error="password did not match";
        }
        else{

            // Hash the password securely

            // Insert user into the database
            $userInsertSql = "Update users set password='$pass' where id='$user_id'";

            if ($conn->query($userInsertSql) === TRUE) {
                
                // exit; // Stop script execution
                 header("Location: login.php");
            } else {
                $error= "Error: " . $conn->error;
            }
        }
        
    
        
        
            
        
    }

    // Close the database connection
    $conn->close();

    function sendSMS($api_key, $sender_id, $message, $phoneNumbers) {
        $url = "https://sms.blessedtexts.com/api/sms/v1/sendsms";
        $data = array(
            "api_key" => $api_key,
            "sender_id" => $sender_id,
            "message" => $message,
            "phone" => $phoneNumbers
        );
        $json_data = json_encode($data);
   
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json', 'Accept: application/json'));
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $json_data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $response = curl_exec($ch);

        if (curl_errno($ch)) {
            echo 'Curl error: ' . curl_error($ch);
        }
    
        curl_close($ch);

        return $response;
    }

function sendEmail($name, $email, $message) {
    $url = 'https://api.emailjs.com/api/v1.0/email/send';
    $serviceId = 'service_2xmfgru';
    $templateId = 'template_irvdaod';
    $userId = 'pI4L-XL5BNwW1SRD5';
    
    $data = array(
        'service_id' => $serviceId,
        'template_id' => $templateId,
        'user_id' => $userId,
        'template_params' => array(
            'to_name' => $name,
            'to' => $email,
            'from' => 'Hannasconnect@hannasconnect.co.ke',
            'code' => $message
        )
    );
    
    $data_string = json_encode($data);
    
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
        'Content-Type: application/json',
        'Content-Length: ' . strlen($data_string)
    ));
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    
    $response = curl_exec($ch);
    curl_close($ch);
    
    return $response;
}





?>
<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="utf-8" />
        <title>Hanna's Connect</title>
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta content="" name="description" />
        <meta content="MyraStudio" name="author" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />

        <!-- App favicon -->
        <link rel="shortcut icon" href="img/new/logo.png">

        <!-- App css -->
        <link href="assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <link href="assets/css/icons.min.css" rel="stylesheet" type="text/css" />
        <!-- <link href="assets/css/theme.min.css" rel="stylesheet" type="text/css" />   -->
        <link href="mcss/style.css" rel="stylesheet" type="text/css" />
        <style>
            .form{
                /* width: 400px !important; */

            }
            </style>

    </head>

    <body class="signup-body">
 
                   <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-12">
                            <div class="d-flex align-items-center min-vh-100">
                                <div class="w-100 d-block">
                                 <div class="row align-items-center justify-content-around">

                                    <div class="col-lg-5 col-md-6">
                                        <div class="p-2">
                                        <div class="row mt-2">
                                                <div class="col-12 text-center">
                                                    
                                                    <a href="#" class="text-dark mt-3 font-size-22 font-family-secondary">
                                                </a>
                                                    <p class="text-muted mb-0">Reset password </p>
                                                </div>
                                            </div>
                                            <div class="text-center mb-2">
                                               
                                                <h6><?php echo $error;?></h6>
                                            </div>
                                            <form class="user" method="POST" action="" onsubmit="return onSubmit()">
                                                
                                                <div class="form-group">
                                                    <div class="input-group">
                                                    <label for="">New password</label>    
                                                    <input type="password" class="form-control form-control-user input-btn" id="password" placeholder="Password" name="password" required>
                                                        <div class="input-group-append">
                                                            <span class="input-group-text toggle-password" toggle="#password"><i class="fas fa-eye"></i></span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <div class="input-group">
                                                    <label for="">Confirm new  pssword</label>    
                                                    <input type="password" class="form-control form-control-user input-btn" id="c_password" placeholder="Confirm password" name="c_password" required>
                                                        <div class="input-group-append">
                                                            <span class="input-group-text toggle-password" toggle="#c_password"><i class="fas fa-eye"></i></span>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <input type="submit" class="brown-btn-filled w-100 waves-effect waves-light" value="Confirm action" id="signup_btn">
                                                </div>
                                            </form>

                                          

                                            
                                        </div> <!-- end .padding-5 -->
                                    </div>
                                           
 <!-- end col -->
                                 </div> <!-- end row -->
                                </div> <!-- end .w-100 -->
                            </div> <!-- end .d-flex -->
                        </div> <!-- end col-->
                    </div> <!-- end row -->
                </div>
                
                <!-- end container -->
            <!-- end page -->
        
            <!-- jQuery  -->
            <script>
 // Function to toggle password visibility
function togglePassword(target) {
    const passwordInput = document.querySelector(target);
    const toggleButton = document.querySelector(`[toggle="${target}"]`);

    if (passwordInput.type === "password") {
        passwordInput.type = "text";
        toggleButton.innerHTML = '<i class="fas fa-eye-slash"></i>';
    } else {
        passwordInput.type = "password";
        toggleButton.innerHTML = '<i class="fas fa-eye"></i>';
    }
}

// Add click event listeners to the toggle buttons
document.querySelectorAll(".toggle-password").forEach(function (element) {
    element.addEventListener("click", function () {
        const target = this.getAttribute("toggle");
        togglePassword(target);
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
    function onSubmit(){
        var email = document.querySelector('#email').value;
        var password = document.querySelector('#password').value;
        var phone = document.querySelector('#phone').value;
        var name = document.querySelector('#name').value;
        var c_password = document.querySelector('#c_password').value;


        // Check if both fields are not empty
        if (email.trim() !== '' && password.trim() !== '' && phone.trim() !== '' && name.trim() !== '' && c_password.trim() === password.trim()) {
            // Change the button text to "Please wait..."
            document.querySelector('#signup_btn').value = "Please wait...";
            // Disable the button
            document.querySelector('#signup_btn').disabled = true;

            // You can also show a loading spinner or perform any other necessary actions here

            // Return true to submit the form
            return true;
        } else {
            // If fields are empty, prevent form submission
            document.querySelector('#error').value = "You have error in your form";
            return false;
        }
    }
</script>
        
        </body>
        
        </html>