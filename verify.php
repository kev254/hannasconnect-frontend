<?php
    // Include the database connection
    include "includes/dbconnect.php";
    $error = "";
    $id=$_GET['id'];
    $query = "SELECT * FROM users WHERE id = '$id'";
    // Execute the query and retrieve the OTP
    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_assoc($result);

    // Check if the form is submitted
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Retrieve and sanitize the OTP value
        $otp = mysqli_real_escape_string($conn, $_POST['otp']);

        // Check if the user exists and is not already verified
        $sql = "SELECT * FROM users WHERE otp = '$otp' AND verified = '0'";
        $result = $conn->query($sql);

        if ($result->num_rows == 1) {
            // Update the user's verification status
            $updateSql = "UPDATE users SET verified = '1' WHERE otp = '$otp'";
            if ($conn->query($updateSql) === TRUE) {
                // Redirect to the login page
                header("Location: login.php");
                exit; // Stop script execution after redirection
            } else {
                $error = "Error updating user verification status: " . $conn->error;
            }
        } else {
            $error = "Invalid or OTP has been used !";
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
                            <h2 class="text-center mt-2">Verify Account</h2>
                            <p class="text-center">Kindly check your email account for an OTP Code</p>
                            <form class="user" method="POST" action="" onsubmit="return onSubmit();">
                                <div class="form-group">
                                    <label for="" class="w-100">Enter OTP Sent</label>
                                    <input type="number" class="form-control form-control-user input-btn" id="otp" placeholder="Enter OTP here.." name="otp" required>
                                </div>
                                <div class="form-group">
                                <input type="hidden" id="hiddenName" value="<?php echo $row['name'];?>"> <!-- Replace with the recipient's name -->
                                <input type="hidden" id="hiddenEmail" value="<?php echo $row['email'];?>">
                                <input type="hidden" id="hiddenOTP" value="<?php echo $row['otp'];?>"> <!-- Replace with the recipient's email -->
                                   
                                </div>
                                <div class="form-group d-flex justify-content-between w-100 align-items-center">
                                    <input type="submit" class="brown-btn-filled veri-btn  " value="Verify Account" id="btn-submit">
                                    <a href="#" class="resend-link review-pill rounded ms-2" id="send_otp_btn">Resend OTP</a>
                                </div>
                            </form>
                            <!-- Google Sign-In Button -->
                            <div class="row mt-4">
                                <div class="col-12 text-center">
                                    <!-- Add your Google Sign-In button here if needed -->
                                </div>
                            </div>
                            <h6 class="text-danger"><?php echo $error; ?></h6>
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
