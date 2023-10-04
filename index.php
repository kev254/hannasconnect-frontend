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

    <!-- Customized Bootstrap Stylesheet -->
    <link href="mcss/bootstrap.min.css" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="mcss/style.css" rel="stylesheet">
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

<body class="body">
    <div class="container-xxl p-0">
        <!-- Spinner Start -->
        <!-- <div id="spinner"
            class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
            <div class="spinner-border text-warning" style="width: 3rem; height: 3rem; color: #f36639!important;"
                role="status">
                <span class="sr-only">Loading...</span>
            </div>
        </div> -->
        <!-- Spinner End -->
        <?php include 'mainNavbar.php'; ?>
        <!-- Carousel Start -->
        <section id="about hero-section" class="container-xxl py-5">
            <div class="container">
                <div class="row g-5 align-items-center flex-wrap-reverse">
                    <div class="col-lg-6 wow fadeIn" data-wow-delay="0.5s">
                        <h1 class="mb-4">Discover Top Talent and Service Providers</h1>
                        <p class="mb-4">Say goodbye to intermediaries. Connect directly with potential talents or service providers and discuss at length with them</p>
                         <?php
                        if (isset($_SESSION['user'])) {
                            echo '<a href="add_listing.php" class="brown-btn-filled">Add Listing <img src="img/new/arrow-in-circle.svg"></a>';
                        }
                        else{
                            echo'<a href="login.php" class="brown-btn-filled">Get started <img src="img/new/arrow-in-circle.svg"></a>';
                        }

                        
                        ?>


                    </div>
                    <div class="col-lg-6 wow fadeIn" data-wow-delay="0.1s">
                        <div class="row g-0 about-bg rounded overflow-hidden">


                            <div class="col-12 text-end">
                                <img class="img-fluid"
                                    src="img/new/hero-img.svg"
                                    style="width: 85%;">
                            </div>

                        </div>
                    </div>

                </div>
                <div class="row mt-4">
                    <div class="col-lg-3 col-sm-4 wow fadeIn" data-wow-delay="0.8s">
                        <!-- Google Play button -->
                        <a href="#" target="_blank" class="market-btn google-btn" role="button">
                            <span class="market-button-subtitle">Download on the</span>
                            <span class="market-button-title">Google Play</span>
                        </a>
                    </div>
                    
                </div>

            </div>
        </section>
        <!-- Carousel End -->
        <!-- Category Start -->
        <section id="category2 " class="container-xxl py-5">
            <div class="container">
            <form class="search-form" action="" method="POST">
                    <p class="text-center text-italic">
                        "Let the search begin"
                    </p>
                    <div class="row">
                        <div class="col-6 col-sm-3">
                            <div class="page-title-box d-flex align-items-center justify-content-between">
                                <select class="form-control form-control-md mb-3 input-btn" id="county" name="county">
                                    <option>County 
                                         </option>
                                </select>
                                <i class="fa fa-chevron-down"></i>

                            </div>
                        </div>
                        <div class="col-6 col-sm-3">
                            <div class="page-title-box d-flex align-items-center justify-content-between">
                                <select class="form-control form-control-md mb-3 input-btn" id="constituency" name="constituency">
                                    <option>Constituency</option>
                                </select>
                                <i class="fa fa-chevron-down"></i>

                            </div>
                        </div>
                        <div class="col-6 col-sm-3">
                            <div class="page-title-box d-flex align-items-center justify-content-between">
                                <select class="form-control form-control-md mb-3 input-btn" id="ward" name="ward">
                                    <option>Ward</option>
                                </select>
                                <i class="fa fa-chevron-down"></i>

                            </div>
                        </div>
                        <div class="col-6 col-sm-3">
                            <div class="page-title-box d-flex align-items-center justify-content-between">
                                <select class="form-control form-control-md mb-3 input-btn" name="category">
                                    <option value="0">Category</option>
                                    <option value="1">individual</option>
                                    <option value="2">Business (Company)</option>
                                    <option value="3">Emergency services</option>
                                    <option value="4">Hire me (CV center)</option>
                                </select>
                                <i class="fa fa-chevron-down"></i>

                            </div>
                        </div>
                        <div class="col-6 col-sm-6"> <!-- Updated col-6 to col-12 col-sm-6 -->
                            <div class="form-group m-0">
                                <div class="input-group">
                                    <!-- Input field to trigger map picker -->
                                    <input type="text" class="form-control input-btn" id="locationInput"
                                        placeholder="Nearby" aria-label="Location" name="location">
                                    
                                    
                                </div>
                            </div>


                        </div>
                        <div class="col-6 col-sm-6"> <!-- Updated col-6 to col-12 col-sm-6 -->
                            <div class="form-group m-0">
                                <div class="input-group">
                                    <input type="text" class="form-control input-btn" placeholder="Looking for" name="keyword" 
                                        aria-label="keword">
                                    <div class="input-group-append ms-2">
                                        <button class="brown-btn-filled " type="submit"><i class="mdi mdi-magnify"></i> Search</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </section>

        <!-- Category End -->



        <!-- Category Start -->
        <section id="category" class="container-xxl py-5">
            <div class="container" id="providers">
                <h2 class="text-center mb-5 wow fadeInUp" data-wow-delay="0.1s">Featured service providers</h2>
                <div class="row g-4">

                    <?php
                    // Loop through the query result and generate subject cards
                    
                    
                    while ($row = $result->fetch_assoc()) {
                        $badge='<span class="badge bg-success">Open </span>';
                        $cat = "";
                        $image = "uploads/logo.png";
                        if ($row['image_url'] !== null && $row['image_url'] !== "") {
                            $image = 'uploads/' . $row['image_url'];
                        }
                        if ($row['category_id'] === "1") {
                            $cat = "Individual";
                            
                        } elseif ($row['category_id'] === "2") {
                            $cat = "Company";
                            
                        } elseif ($row['category_id'] === "3") {
                            $cat = "Emergency services";
                            
                        } else {
                            $cat = "Hire me";
                            
                        }
                        if($row['status']==="0"){
                            $badge='<span class="badge bg-danger">Closed</span>';
                        }
                        


                        echo '
                <div class="col-lg-3 col-md-6 col-sm-6 col-6 wow fadeInUp" data-wow-delay="0.1s">
                    <a href="user_details.php?id=' . $row["id"] . '"><div class="wsk-cp-product">
                    <!-- Badge -->
                        '.$badge.'
                        <div class="wsk-cp-img">
                        <img src="'.$image.'" alt="Product" class="img-responsive" />
                        </div>
                        <div class="wsk-cp-text">
                        
                            <div class="title-product">
                                <h5>' . $row["name"] .'</h5>
                            </div>
                            <div class="description-prod ">
                                <div class="d-flex align-items-center mb-2 pe-3 justify-content-between w-100">  
                                        <p class="cat-pill">'.$cat.'</p>
                                        
                                        <p class="price"> <img src="img/new/location.svg" class="social-icon"> ' . $row["county"] . '</p>
                                </div>
                                <p class="prof mb-2">' . $row["profession"] . '</p> 
                                <p class="desc-words"> ' . $row["slogan"] . ' </p>
                                 
                                <p class="mb-2">Contact: <b>' . $row["phone"] . '</b></p>
                            </div>      
                            <div class="d-flex  mb-2 pe-3 justify-content-between w-100 card-buttons">

                                <a href="#" class="review-pill"><i class="fa fa-star"></i>0 Reviews </a>
                            </div>
                        </div>
                    </div>
                    </a>
                </div>
';
        }
        if ($result->num_rows === 0) {
            echo '<div class="col-lg-12 col-md-12 col-sm-12 col-12 wow fadeInUp" data-wow-delay="0.1s">
            <div class="card text-center"> <!-- Added card class -->
                <div class="card-body justify-content-center"> <!-- Added card-body class -->
                    <h6>No data found</h6>
                </div>
            </div>
        </div>
        ';
        }
                    ?>


                </div>
            </div>
        </section>
        <!-- Category End -->

        <!-- About Start -->
        <section id="about" class="container-xxl py-5">
            <div class="container" id="blog">
                <div class="row g-5 align-items-center">
                    <div class="col-lg-6 wow fadeIn" data-wow-delay="0.1s">
                        <img src="img/new/login-img.svg" class="img-fluid" alt="">
                    </div>
                    <div class="col-lg-6 wow fadeIn" data-wow-delay="0.5s">
                        <h1 class="mb-4">We Help You Get The Best Talent and Service providers</h1>
                        <p class="mb-4">Say goodbye to intermediaries. Connect directly with potential talents or
                            service providers and discuss at length with them</p>
                        <p><i class="fa fa-check text-gray me-3"></i>Browse our providers list</p>
                        <p><i class="fa fa-check text-gray me-3"></i>Find the best Tallent for your business </p>
                        <p><i class="fa fa-check text-gray me-3"></i>Connect and hire </p>
                        <a class="brown-btn-filled mt-3" href="">Read More</a>
                    </div>
                </div>
            </div>
        </section>
        <!-- <div id="map" style="width: 100%; height: 400px; visibility: hidden;"></div> -->
        <!-- About End -->

        <!-- Testimonial Start -->

        <!-- Testimonial End -->
        <?php include 'mainFooter.php'; ?>

        <!-- Back to Top -->
        <a href="index.php" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="bi bi-arrow-up text-white"></i></a>
    </div>

    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="lib/wow/wow.min.js"></script>
    <script src="lib/easing/easing.min.js"></script>
    <script src="lib/waypoints/waypoints.min.js"></script>
    <script src="lib/owlcarousel/owl.carousel.min.js"></script>

    <!-- Template Javascript -->
    <script src="js/main.js"></script>
    <script src="assets/js/theme.js"></script>
    <script>

        var countySelect = document.getElementById('county');
        var countySelect2 = document.getElementById('county1')
        var constituencySelect = document.getElementById('constituency');
        var wardSelect = document.getElementById('ward');

        // Function to fetch JSON data from a file
        function fetchJsonData(url, callback) {
            var xhr = new XMLHttpRequest();
            xhr.onreadystatechange = function () {
                if (xhr.readyState === 4 && xhr.status === 200) {
                    var jsonData = JSON.parse(xhr.responseText);
                    callback(jsonData);
                }
            };
            xhr.open('GET', url, true);
            xhr.send();
        }

        // Populate counties in the county dropdown
        fetchJsonData('data.json', function (jsonData) {
            jsonData.forEach(function (county) {
                var option = document.createElement('option');
                option.value = county.name;
                option.text = county.name;
                countySelect.appendChild(option);

            });
        });
        fetchJsonData('data.json', function (jsonData) {
            jsonData.forEach(function (county) {
                var option = document.createElement('option');
                option.value = county.name;
                option.text = county.name;

                countySelect2.appendChild(option);
            });
        });

        // Populate constituencies based on selected county
        countySelect.addEventListener('change', function () {
            var selectedCounty = this.value;
            fetchJsonData('data.json', function (jsonData) {
                var selectedCountyData = jsonData.find(county => county.name === selectedCounty);

                // Clear previous options
                constituencySelect.innerHTML = "<option value=''></option>";
                wardSelect.innerHTML = "<option value=''></option>";

                selectedCountyData.constituencies.forEach(function (constituency) {
                    var option = document.createElement('option');
                    option.value = constituency.name;
                    option.text = constituency.name;
                    constituencySelect.appendChild(option);
                });
            });
        });

        // Populate wards based on selected constituency
        constituencySelect.addEventListener('change', function () {
            var selectedCounty = countySelect.value;
            var selectedConstituency = this.value;
            fetchJsonData('data.json', function (jsonData) {
                var selectedCountyData = jsonData.find(county => county.name === selectedCounty);
                var selectedConstituencyData = selectedCountyData.constituencies.find(constituency => constituency.name === selectedConstituency);

                // Clear previous options
                wardSelect.innerHTML = "<option value=''></option>";

                selectedConstituencyData.wards.forEach(function (ward) {
                    var option = document.createElement('option');
                    option.value = ward;
                    option.text = ward;
                    wardSelect.appendChild(option);
                });
            });
        });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/places.js@1.19.0"></script>
 <script>
  var placesAutocomplete = places({
    appId: "CVYQI5CORW",
    apiKey: "b96ac70d3e3334157b5ff8b2c7389f48",
    container: document.querySelector('#locationInput')
  });
</script>





</body>

</html>