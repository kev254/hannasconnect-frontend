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
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Hannasconnect | About Us</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="all,follow">
    <!-- Google fonts - Open Sans-->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,700">
    <!-- gLightbox-->
    <link rel="stylesheet" href="assets/vendor/glightbox/css/glightbox.css">
    <!-- Theme stylesheet-->
    <link rel="stylesheet" href="assets/css/style.default.css" id="theme-stylesheet">
    <!-- gLightbox-->
    <link rel="stylesheet" href="assets/vendor/glightbox/glightbox.css">
    <!-- Custom stylesheet - for your changes-->
    <link rel="stylesheet" href="assets/css/custom.css">
    <!-- Favicon-->
    <link rel="icon" href="img/new/Logo.png" type="image/x-icon">

    <!-- <link href="mcss/bootstrap.min.css" rel="stylesheet"> -->

    
    <!-- Template Stylesheet -->
    <!-- <link href="mcss/style.css" rel="stylesheet"> -->
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
  <body>

  <?php include 'mainNavbar.php'; ?>

    <div class="search-area">
      <div class="search-area-inner d-flex align-items-center justify-content-center position-relative">
        <div class="close-btn position-absolute p-4 top-0 end-0 cursor-pointer z-index-20"><i class="fas fa-times"></i></div>
        <div class="row d-flex justify-content-center w-100">
          <div class="col-md-8">
            <form action="#">
              <div class="input-group border-bottom">
                <input class="form-control form-control-lg border-0 shadow-0 ps-0 bg-none px-0" type="search" placeholder="What are you looking for?">
                <button class="btn btn-link btn-sm shadow-0 px-0 btn-lg text-dark" type="submit"><i class="fas fa-search"></i></button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
    <!-- Hero Section-->
    <section class="hero position-relative" style="background: url(img/new/slider/img.png); background-size: cover; background-position: center center">
      <div class="container text-white py-5">
        <div class="row py-lg-5">
          <div class="col-lg-7">
            <h1>About Hannasconnect</h1><a class="link-underline mt-3" href="#intro">Discover More</a>
          </div>
        </div><a class="continue text-gray-400 position-absolute bottom-0 mb-5 z-index-20 link-transition small text-uppercase" href="#intro"><i class="fas fa-long-arrow-alt-down"></i> Scroll Down</a>
      </div>
    </section>
    <!-- Intro Section-->
    <section id="intro">
      <div class="container">
        <div class="row">
          <div class="col-lg-10">
            <h2 class="h3">Who we are</h2>
            <p class="text-md fw-light lh-lg mb-0">
            We are a local company connecting businesses and service providers to their respective and potential customers in all counties. We do so by providing a platform that lists crucial and comprehensive business information thus providing services and solutions to the problem solvers in the market 24/7. 
            <br>
We are focused on four categories. 
    <ol class="text-md fw-medium">
      <li>
      Businesses and companies
      </li>
      <li>	Service providers</li>
      <li>	Job Seekers</li>
      <li>	Emergency service providers</li>

    </ol>
          </p>

          <p class="text-md fw-light">
          We are committed to building our communities through local business connections and that is why we intentionally created a platform that makes it easier for you and your loved ones to connect to local businesses and service providers at the County, Constituency and ward level respectively. 
          <br>
We empower locals by providing a platform that will help them with economic growth.
<br>
We are a local business, that lists local businesses, to all Locals, for all locals…!!!

          </p>
          </div>
        </div>
      </div>
    </section>
    <section class="pt-0 pb-0">
      <div class="container">
        <!-- Post-->
        <div class="row d-flex align-items-stretch g-0">
          <div class="col-lg-7">
            <div class="text-inner d-flex align-items-center h-100 bg-light">
              <div class="content px-4 px-lg-5">
                
                <h2 class="h4 mb-3"><a class="text-dark">Our Purpose</a></h2>
                <p class="text-sm">
                Ensure local Businesses and service providers thrive. 
                </p>
               
              </div>
            </div>
          </div>
          <div class="col-lg-5"><img class="img-fluid" src="img/new/slider/img-1.png" alt="..."></div>
        </div>
        <!-- Post        -->
        <div class="row d-flex align-items-stretch g-0">
          
          <div class="col-lg-5"><img class="img-fluid" src="img/new/slider/img-2.png" alt="..."></div>
        
        <div class="col-lg-7">
            <div class="text-inner d-flex align-items-center h-100 bg-light">
              <div class="content px-4 px-lg-5">
                
                <h2 class="h4 mb-3"><a class="text-dark">Mission</a></h2>
                <p class="text-sm">
                Provide a platform that creates and provides opportunities to help local businesses and service providers in all counties thrive, by listing clear, comprehensive and crucial business information, making it readily available to their respective and potential customers within their County, Constituency or Ward. 
                </p>
               
              </div>
            </div>
          </div>
        </div>
        <!-- Post                            -->
        <div class="row d-flex align-items-stretch g-0">
          <div class="col-lg-7">
            <div class="text-inner d-flex align-items-center h-100 bg-light">
              <div class="content px-4 px-lg-5">
                
                <h2 class="h4 mb-3"><a class="text-dark">Vision</a></h2>
                <p class="text-sm">
                To improve the livelihood of citizens, by making it easier for everyone in Kenya to make local business connections, from the national to the County, Constituency, and Ward level respectively.
                </p>
               
              </div>
            </div>
          </div>
          <div class="col-lg-5"><img class="img-fluid" src="img/new/slider/img-3.png" alt="..."></div>
        </div>

        
      </div>
      <div class="container mt-5">
      <div class="row d-flex align-items-stretch g-0">
        <h2 class="h4 mb-3"><a class="text-dark">Core values</a></h2>
        <p class="text-md fw-light lh-lg mb-0">
        At Hanna’s Connect our core values are;
            
    <ol class="text-md fw-medium">
      <li>
      Empowerment 
      </li>
      <li>	Inclusion </li>
      <li>	Collaboration </li>
      <li>	Customer focused</li>

    </ol>
          </p>
        </div>
      </div>
    </section>

    

    <?php include 'mainFooter.php'; ?>

    <!-- JavaScript files-->
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="vendor/glightbox/glightbox.js"></script>
    <script src="js/theme.js"></script>
    <!-- FontAwesome CSS - loading as last, so it doesn't block rendering-->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
  </body>
</html>