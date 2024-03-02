<?php
    // Include the database connection
    include "includes/dbconnect.php";
   // Check if the form is submitted
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $businessName = $_POST['businessname'];
        $totalFounders=$_POST["founders"];
        $years=$_POST["years"];
        $profit=$_POST["profit"];
        $amount=$_POST["amount"];
        $percentage=$_POST["percentage"];
        $reason=$_POST["reason"];
        $intention=$_POST["reason"];
        $link=$_POST["link"];
        $email=$_POST["email"];
        $phone=$_POST["phone"];

        // For simplicity, no hashing here
        
        $sql="CREATE TABLE IF NOT EXISTS Investors(Id INT(14) NOT NULL AUTO_INCREMENT PRIMARY KEY,businessName TEXT NOT NULL,founders INT(14) NOT NULL, years TEXT NOT NULL,profit TEXT NOT NULL ,amount DOUBLE NOT NULL, percentage FLOAT NOT NULL,intention LONGTEXT NOT NULL,reason LONGTEXT NOT NULL,link LONGTEXT NOT NULL ,email VARCHAR(100) NOT NULL,phone TEXT NOT NULL)";
        $conn->query($sql) or die($conn->error);
        // Check user credentials
        $sql="INSERT INTO Investors(businessName,founders,years,profit,amount,percentage,intention,reason,link,email,phone) VALUES (?,?,?,?,?,?,?,?,?,?,?)";
        $stmt=$conn->prepare($sql);
        $stmt->bind_param("sisssssssss",$businessName,$totalFounders,$years,$profit,$amount,$percentage,$intention,$reason,$link,$email,$phone);
        $stmt->execute();

        if ($stmt->affected_rows>0){
            $stmt->close();
            $conn->close();
            require_once "send_email.php";
            $sendMail=new send_email();
            $sendMail->sendInvestorEmail($businessName,$totalFounders,$years,$profit,$amount,$percentage,$intention,$reason,$link,$email,$phone);
            echo '<script>
alert("Request submitted. We will notify you when an investor is available");
window.location.href="index.php";
 </script>';
        }else{
            $stmt->close();
            $conn->close();
            header("Location","find_sponsor.php");
        }

    }

    // Close the database connection
    $conn->close();
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
        <link rel="shortcut icon" href="img/logo.png">

        <!-- App css -->
        <link href="assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <link href="assets/css/icons.min.css" rel="stylesheet" type="text/css" />
        <link href="mcss/style.css" rel="stylesheet" type="text/css" />
        <style>
        /* Style for links */
        a {
            color: black; /* Replace with your desired color code */
            text-decoration: none; /* Remove the underline, if desired */
        }

        /* Style for visited links (if needed) */
        a:visited {
            color: black; /* Replace with your desired visited link color */
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
                                                  <h3>  <i class="mdi mdi-alpha-S-circle"></i> <b>Find An Investor</b></h3>
                                                </a>
                                                </div>
                                            </div>

                                            <form class="user" method="POST" action="" onsubmit="return onSubmit()">
                                                <div class="form-group">
                                                    <input type="text" required class="form-control form-control-user input-btn" id="businessname" placeholder="Name of the Business/Company" name="businessname">
                                                </div>
                                                <div class="form-group">

                                                        <input type="number" required class="form-control form-control-user input-btn" id="founders" placeholder="Number Of Founders" name="founders">

                                                </div>
                                                <div class="form-group">

                                                        <select type="text" required class="form-control form-control-user input-btn" id="years" name="years">
                                                            <option selected value="0-1 years">How Many Years Have You Been Operating?</option>
                                                            <option  value="0-1 years">0-1 years</option>
                                                            <option  value="1-5 years">1-5 years</option>
                                                            <option  value="5+ years">5+ years</option>
                                                        </select>

                                                </div>

                                                <div class="form-group">

                                                    <select type="text" required class="form-control form-control-user input-btn" id="profit" name="profit">
                                                        <option selected value="Does this business/company generate profit?">Does this business/company generate profit?</option>
                                                        <option  value="Yes we generate profit">Yes we generate profit</option>
                                                        <option  value="No we are making losses">No we are making losses</option>
                                                        <option  value="We haven't started making any income yet">We haven't started making any income yet</option>
                                                    </select>

                                                </div>
                                                <div class="form-group">

                                                    <input type="text" required class="form-control form-control-user input-btn" id="amount" placeholder="How much do you need for the business?" name="amount">

                                                </div>
                                                <div class="form-group">

                                                    <input type="text" required class="form-control form-control-user input-btn" id="percentage" placeholder="What percentage are you willing to give out?" name="percentage">

                                                </div>

                                                <div class="form-group">

                                                    <textarea required rows="5"  class="form-control form-control-user" id="intention" placeholder="What do you intent to do with the funding?" name="intention"></textarea>

                                                </div>
                                                <div class="form-group">

                                                    <textarea required rows="5" class="form-control form-control-user" id="reason" placeholder="Why should an investor invest in you?.Keep it short and precise" name="reason"></textarea>

                                                </div>


                                                <div class="form-group">

                                                    <input required type="url" class="form-control form-control-user input-btn" id="link" placeholder="Your Hanna's Connect listing link" name="link">

                                                </div>
                                                <div class="form-group">

                                                    <input required type="email" class="form-control form-control-user input-btn" id="email" placeholder="Your Contact Email" name="email">

                                                </div>
                                                <div class="form-group">

                                                    <input required type="tel" class="form-control form-control-user input-btn" id="phone" placeholder="Contact Phone e.g (07xx or 01xx)" name="phone">

                                                </div>
                                                <div class="form-group d-flex text-end align-items-end justify-content-end align-content-end">
                                                    <button class="brown-btn-filled" type="submit">Find me an Investor</button>
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
            </div>
            <!-- end page -->
        
            <!-- jQuery  -->
            <script>
  function  onSubmit(){
return true;
    }
    </script>
            <script src="assets/js/jquery.min.js"></script>
            <script src="assets/js/bootstrap.bundle.min.js"></script>
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