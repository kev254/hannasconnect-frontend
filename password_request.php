<?php
    // Include the database connection
    include "includes/dbconnect.php";
    $error = "";
    $success="";   
    // Execute the query and retrieve the OTP



    // Check if the form is submitted
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Retrieve and sanitize the OTP value
        $email=$_POST['email'];
        $query = "SELECT * FROM users WHERE email = '$email'";
        $result = mysqli_query($conn, $query);
        $row = mysqli_fetch_assoc($result);
        $name=$row['name'];
        $id=$row['id'];
        $link="https://hannasconnect.co.ke/reset_password.php?id=$id";
        require_once "send_email.php";
        $sendMail=new send_email();
        $sendMail->resetPassword($link,$name,$email);
        $message="https://hannasconnect.co.ke/reset_password.php?id=$id";


        if ($result->num_rows == 1) {
            $response=sendEmail($row['name'], $row['email'], $message);
            if($response==="OK"){
                $success="Password reset link has been sent to your email inbox";
            }
            else{
                $error="Could not send email to this address";
            }
        } else {
            $error = "No account with this email found!";
        }
    }

    // Close the database connection
    $conn->close();


    function sendEmail($name, $email, $message)
{
    /*$url = 'https://api.emailjs.com/api/v1.0/email/send';
    $serviceId = 'service_2xmfgru';
    $templateId = 'template_uqdnf6l';
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
    curl_setopt(
        $ch,
        CURLOPT_HTTPHEADER,
        array(
            'Content-Type: application/json',
            'Content-Length: ' . strlen($data_string)
        )
    );
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    $response = curl_exec($ch);
    curl_close($ch);*/

    return "OK";
}
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
       

        .container {
            max-width: 500px;
        }

        

        

        .form h2 {
            font-size: 24px;
            color: #333;
            text-align: center;
            margin-bottom: 20px;
        }

        .form-group {
            margin-bottom: 20px;
        }


        .text-danger {
            color: red;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12">
                <div class="d-flex align-items-center min-vh-100">
                    <div class="w-100 d-block bg-white verify-form my-5">
                        <div class="p-3 ">
                           <div class="text-center w-100"> <img src="img/new/logo.png" class="footer-img m-auto" alt=""></div>
                            <h2 class="text-center mt-2">Password recovery</h2>
                            <p class="text-center">Please enter your email address to recover your password.</p>
                            <form class="user" method="POST" action="" onsubmit="return onSubmit();">
                                <div class="form-group">
                                    <h6 class="text-danger"><?php echo $error; ?></h6>
                                    <label for="" class="w-100 text-success"><?php echo $success;?></label>
                                    <input type="email" class="form-control form-control-user input-btn" id="otp" name ="email" placeholder="example@gmail.com"  required>
                                </div>
                                <div class="form-group">
                                <input type="hidden" id="hiddenName" value="<?php echo $row['name'];?>"> <!-- Replace with the recipient's name -->
                                <input type="hidden" id="hiddenEmail" value="<?php echo $row['email'];?>">
                                <input type="hidden" id="hiddenOTP" value="<?php echo $row['otp'];?>"> <!-- Replace with the recipient's email -->
                                   
                                </div>
                                <div class="form-group d-flex justify-content-end w-100 align-items-center">
                                    <input type="submit" class="brown-btn-filled veri-btn  " value="Reset password" id="btn-submit">
                                </div>
                            </form>
                            <!-- Google Sign-In Button -->
                            <div class="row mt-4">
                                <div class="col-12 text-center">
                                    <!-- Add your Google Sign-In button here if needed -->
                                </div>
                            </div>
                           
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- jQuery -->
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/js/bootstrap.bundle.min.js"></script>
    <script src="assets/js/metismenu.min.js"></script>
    <script src="assets/js/waves.js"></script>
    <script src="assets/js/simplebar.min.js"></script>
    <!-- App js -->
    <script src="assets/js/theme.js"></script>
    <script>
    document.addEventListener("DOMContentLoaded", function () {
        const resendLink = document.querySelector('.resend-link');

        resendLink.addEventListener('click', function (e) {
            e.preventDefault(); 

            const name = document.getElementById('hiddenName').value;
            const email = document.getElementById('hiddenEmail').value;
            const message = document.getElementById('hiddenOTP').value;

            sendEmail(name, email, message);
        });
    });

    function sendEmail(name, email, message) {
    const url = 'https://api.emailjs.com/api/v1.0/email/send';
    const serviceId = 'service_2xmfgru';
    const templateId = 'template_irvdaod';
    const userId = 'pI4L-XL5BNwW1SRD5';
    var resendLink = document.getElementById('send_otp_btn');
    resendLink.innerText = "Sending OTP..."
   

    const data = {
        service_id: serviceId,
        template_id: templateId,
        user_id: userId,
        template_params: {
            to_name: name,
            to: email,
            from: 'Hannasconnect@hannasconnect.co.ke',
            code: message
        }
    };

    fetch(url, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
        },
        body: JSON.stringify(data),
    })
    .then(response => {
        if (response.ok) {
            resendLink.innerText = "Send OTP"
            alert('OTP has been sent to your email.');
        } else {
            alert('Failed to send email. Please try again.');
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('An error occurred while sending the email.');
    });
}
function onSubmit(){
    document.getElementById('btn-submit').value="Please wait...";

}

</script>

</body>
</html>
