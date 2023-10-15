<?php
include "includes/dbconnect.php";
session_start();
$sql = "SELECT users.*, services.* FROM users INNER JOIN services ON users.id = services.user_id limit 8;";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $county=$conn->real_escape_string($_POST['county']);
    $constituency = $_POST["constituency"];
    $ward = $_POST["ward"];
    $category = $_POST["category"];
    $location = $_POST["location"];
    $keyword = $_POST["keyword"];

    $sql = "SELECT users.*, services.* FROM users INNER JOIN services ON users.id = services.user_id WHERE 1";


    if (!empty($county) && $county!=="County") {
        $sql .= " AND services.county = '$county'";
    }

    if (!empty($constituency) && $constituency!=="Constituency") {
        $sql .= " AND services.sub_counry = '$constituency'";
    }

    if (!empty($ward) && $ward !=="Ward") {
        $sql .= " AND services.ward = '$ward'";
    }

    if (!empty($category) && $category !=="0") {
        $sql .= " AND services.category_id = '$category'";
    }

    if (!empty($location)) {
        $sql .= " AND services.location_pin LIKE '%$location%'";
    }

    if (!empty($keyword)) {
        $sql .= " AND (";
        for ($i = 0; $i < 8; $i++) {
            $sql .= " JSON_UNQUOTE(JSON_EXTRACT(services.key_words, '$[$i]')) LIKE '%$keyword%' ";
            if ($i < 7) {
                $sql .= " OR ";
            }
        }
        $sql .= ")";
    }
}

$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Hannasconnect</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

    <!-- Favicon -->
    <link rel="icon" href="img/new/Logo.png" type="image/x-icon">



    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="lib/animate/animate.min.css" rel="stylesheet">
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
  <link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">


    <!-- Customized Bootstrap Stylesheet -->
    <link href="mcss/bootstrap.min.css" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="mcss/style.css" rel="stylesheet">

    

<link rel="stylesheet" type="text/css" href="assets/css/animate.css">

<link rel="stylesheet" type="text/css" href="assets/css/hamburgers.min.css">

<link rel="stylesheet" type="text/css" href="assets/css/select2.min.css">

<link rel="stylesheet" type="text/css" href="assets/css/util.css">
<link rel="stylesheet" type="text/css" href="assets/css/contact.css">
    <style>
        .user-card {
            border: 1px solid #ccc;
            border-radius: 6px !important;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            transition: transform 0.2s ease-in-out;
            margin-bottom: 20px;
            max-width: 100%;
            height: 370px;
            align-items: start !important;
            border-color: #fff;
        }

        .user-card:hover {
            transform: translateY(-5px);
        }

        .user-card img {
            max-width: 100%;
            height: auto;
            border-top-left-radius: 6px;
            border-top-right-radius: 6px;
        }

        .user-card .card-body {
            padding: 20px;
        }

        .user-card .card-title {
            font-size: 16px !important;
            margin-bottom: 5px;
        }

        .user-card .card-subtitle {
            font-size: 1rem;
            color: #777;
            margin-bottom: 10px;
        }

        .user-card .card-link {
            font-size: 1rem;
            color: #333;
            text-decoration: none;
        }

        .user-card .card-link i {
            margin-right: 5px;
        }

        .text-gray {
            color: #777;
        }

        .custom-badge {
            position: absolute;
            top: 10px;
            right: 10px;
            background-color: #f36639;
            /* Customize the background color */
            color: #fff;
            /* Customize the text color */
            padding: 5px 10px;
            /* Adjust padding as needed */
            border-radius: 5px;
            /* Customize the border radius */

        }

        .bottom-right-badge {
            bottom: 10px;
            right: 10px;
            width: 40px;
            border-radius: 5px;
            font-size: 13px;
            background-color: #FBFBFD;
            /* Customize the background color */
        }
        @media screen and (max-width: 768px) {
    .hidden-on-small {
        display: none;
    }
  
    }
    .badge {
        
        color: white; /* Text color */
        font-size: 13px; /* Font size */
        padding: 5px 10px; /* Padding around the badge text */
        border-radius: 5px; /* Rounded corners */
        position: absolute; /* Position the badge */
        top: 10px; /* Adjust the top position as needed */
        left: 10px; /* Adjust the left position as needed */
        width: 80px ;
    }
    /* Add this CSS to your stylesheet */


    </style>

</head>



<body class="bg-contact100" style="background-image: url('img/new/slider/img.png');">
<?php include 'mainNavbar.php'; ?>

<div class="container" >
<div class="row container-contact100">
<div class="wrap-contact100">
<div class="contact100-pic js-tilt" data-tilt>
<img src="img/new/contact.png" alt="IMG">
</div>
<form class="contact100-form validate-form">
<h2 class="mb-2">
Get in touch with us
</h2>
<label for="name" class="w-100 mt-1">Name</label>

<div class="wrap-input100 validate-input" data-validate="Name is required">

<input class="input100" type="text" name="name" placeholder="Enter name">
<span class="focus-input100"></span>
<span class="symbol-input100">
<i class="fa fa-user" aria-hidden="true"></i>
</span>
</div>
<label for="email" class="w-100 mt-1">Email address</label>

<div class="wrap-input100 validate-input" data-validate="Valid email is required: ex@abc.xyz">

<input class="input100" type="text" name="email" placeholder="Enter email">
<span class="focus-input100"></span>
<span class="symbol-input100">
<i class="fa fa-envelope" aria-hidden="true"></i>
</span>
</div>
<label for="message" class="w-100 mt-1">Message</label>

<div class="wrap-input100 validate-input" data-validate="Message is required">

<textarea class="input100" name="message" placeholder="Message"></textarea>
<span class="focus-input100"></span>
</div>
<div class="container-contact100-form-btn">
<button class="brown-btn-filled w-100">
Send
</button>
</div>
</form>
</div>
</div>
</div>
<?php include 'mainFooter.php'; ?>

<script src="assets/js/jquery-3.2.1.min.js"></script>

<script src="assets/js/popper.js"></script>
<script src="assets/vendor/bootstrap/js/bootstrap.min.js"></script>

<script src="assets/js/select2.min.js"></script>

<script src="assets/js/tilt.jquery.min.js"></script>
<script>
		$('.js-tilt').tilt({
			scale: 1.1
		})
	</script>

<script src="assets/js/contact.js"></script>

</body>
</html>
