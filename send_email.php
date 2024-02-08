<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

class send_email
{
    public function resetPassword($link,$name,$email)
    {
        $mail=new PHPMailer(true);

        try {
            $mail->setFrom('hannasconnect@hannasconnect.co.ke', 'Hannas Connect');
            $mail->addAddress($email, $name);     //Add a recipient
            $mail->isHTML(true);                                  //Set email format to HTML
            $mail->Subject = 'Password Reset';
            $mail->Body='<div>
    <div style="align-content: center;justify-content: center;display: flex">
        <img width="200" height="150" src="https://ci3.googleusercontent.com/meips/ADKq_Naw6exWMr7mU_384j_QKNOYLVAJaO58KLsH4HEwCxhyZOhswB8algfWakg4oo3OdaEbgfYhZFFzAP_ivBi_5SW3=s0-d-e1-ft#http://hannasconnect.co.ke/img/new/logo.png">
    </div>
    <div style="text-align: center;font-weight: bold;font-size: 22px;font-family: Verdana">
        Hello,'.$name .'. Click <a href="'.$link.'" style="font-weight: bold;color:#A75502 ">Here</a> to reset your password
    </div>
</div>';
            $mail->AltBody = 'If the link is not clickable, copy and paste this in your browser.'.$link;

            $mail->send();
        }catch (\Exception $e){
            error_log($e->getMessage(),3,"errors.log");
        }

    }

    public function sendInvestorEmail($businessName, $totalFounders, $years, $profit, $amount, $percentage, $intention, $reason, $link, $email, $phone)
    {
        $htmlToSend='<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>'.$businessName.'</title>
    <style>
        /* Add your inline styles here */
        body {
            font-family: Arial, sans-serif;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
        }

        th, td {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 8px;
        }

        th {
            background-color: #f2f2f2;
        }

        /* Responsive styles */
        @media only screen and (max-width: 600px) {
            table {
                width: 100%;
                margin-bottom: 20px;
            }

            th, td {
                display: block;
                width: 100%;
                box-sizing: border-box;
            }

            th, td {
                text-align: left;
                padding: 8px;
            }

            th {
                background-color: #f2f2f2;
            }
        }
    </style>
</head>
<body>
<h4 style="font-family: Verdana">Hello Hanna, Help me find an Investor</h4>
<table>
    <thead>
    <tr>
        <th>#</th>
        <th>Question</th>
        <th>Answer</th>
    </tr>
    </thead>
    <tbody>
    <tr>
        <td>1</td>
        <td>Business Name</td>
        <td>'.$businessName.'</td>
    </tr>
    <tr>
        <td>2</td>
        <td>Number Of Founders</td>
        <td>'.$totalFounders.'</td>
    </tr>
    <tr>
        <td>3</td>
        <td>How many years have you been operating?</td>
        <td>'.$years.'</td>
    </tr>
    <tr>
        <td>4</td>
        <td>Do you generate profit?</td>
        <td>'.$profit.'</td>
    </tr>
    <tr>
        <td>5</td>
        <td>How much do you need for the business?</td>
        <td>Ksh.'.$amount.'</td>
    </tr>
    <tr>
        <td>6</td>
        <td>What percentage are you willig to give out?</td>
        <td>'.$percentage.'%</td>
    </tr>
    <tr>
        <td>7</td>
        <td>What do you intent to do with the funding?</td>
        <td>'.$intention.'</td>
    </tr>
    <tr>
        <td>8</td>
        <td>Why should an investor invest in you?</td>
        <td>'.$reason.'</td>
    </tr>
    <tr>
        <td>9</td>
        <td>Hannas connect profile link</td>
        <td>'.$link.'</td>
    </tr>
    <tr>
        <td>10</td>
        <td>Contact Email</td>
        <td>'.$email.'</td>
    </tr>
    <tr>
        <td>11</td>
        <td>Contact Phone Number</td>
        <td>'.$phone.'</td>
    </tr>
    </tbody>
</table>

</body>
</html>
';
        $mail=new PHPMailer(true);
        $mail->setFrom('hannasconnect@hannasconnect.co.ke', 'Hannas Connect');
        $mail->addAddress('investors@hannasconnect.co.ke', 'Admin');     //Add a recipient
        $mail->isHTML(true);                                  //Set email format to HTML
        $mail->Subject = 'Find me an Investor';
        $mail->Body=$htmlToSend;
        $mail->send();
        $mail->clearAddresses();
        $mail->clearAllRecipients();

    }
}

