<?php
include "includes/dbconnect.php";
session_start();
$id = $_GET['id'];
$sql = "SELECT users.*, services.* FROM users INNER JOIN services ON users.id = services.user_id where services.id='$id' limit 1 ;";
$result = $conn->query($sql);
$row = $result->fetch_assoc();
$sql2 = "SELECT reviews.*, users.* FROM reviews INNER JOIN users ON reviews.review_by = users.id WHERE reviews.review_to='$id';";
$result2 = $conn->query($sql2);
// $row2 = $result2->fetch_assoc();
$image = "uploads/logo.png";
if ($row['image_url'] !== null) {
    $image = 'uploads/' . $row['image_url'];
}

if ($row['category_id'] === "1") {
    $cat = "Individual service provider";

} elseif ($row['category_id'] === "2") {
    $cat = "Company";
} elseif ($row['category_id'] === "3") {
    $cat = "Emergency service provider";
} else {
    $cat = "Hire me (CV center)";
}
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if (isset($_SESSION['user'])) {
        $rating = $_POST["rating"];
        $comment = $_POST["review"];
        $to = $row['id'];
        $by = $_SESSION['user']['id'];

        // Prepare and execute the SQL statement to insert the review
        $stmt = $conn->prepare("INSERT INTO reviews (stars, comment, review_by, review_to) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("isss", $rating, $comment, $by, $to);

        if ($stmt->execute()) {
            // Review inserted successfully
            // echo "Review submitted successfully!";
        } else {
            // Handle insertion error
            echo "Error: " . $conn->error;
        }
    } else {
        header("Location: login.php");
    }


    // Close the prepared statement and the database connection
    $stmt->close();
}
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
        .action_btn {
            background-color:#A75502 !important;
            border-radius: 30px;
            width: 150px;
            font-size: 13px;
            font-family: 'DM Sans', sans-serif;
            height: 50px;
            border-color: white;
        }

        .action_btn:hover {
            background-color: #A75502 !important;
            width: 130px;
            border-color: white;

        }

        .action_btn a {
            color: #E5E4E2 !important;
        }

        .location_btn {
            background-color: #E5E4E2 !important;
            border-radius: 30px;
            width: auto;
            font-size: 11px;
            text-align: center;
            font-family: 'DM Sans', sans-serif;
            color: black !important;
            height: 45px;
            border-color: white;
        }

        .location_btn:hover {
            background-color: #E5E4E2 !important;
            width: auto;
            border-color: white;

        }

        .nav-link.active {
            color: #f36639 !important;

        }

        .nav-link {
            color: black !important;

        }
        .review-card {
            margin-bottom: 20px; /* Add space between cards */
        }
        
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


                <!-- About Start -->
                <section id="about" class="container-xxl py-5">
            <div class="container">
                <div class="row g-5 align-items-center">
                    <div class="col-lg-6 wow fadeIn" data-wow-delay="0.1s">
                        <div class="row g-0 about-bg rounded overflow-hidden">
                            <div class="col-12 text-start">
                                <img class="img-fluid w-100" src="<?php echo $image; ?>">
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 wow fadeIn" data-wow-delay="0.5s">
                        <h1 class="mb-4">
                            <?php echo $row["name"]; ?>
                        </h1>


                        <!-- Nav tabs -->
                        <ul class="nav nav-tabs" id="productTabs" role="tablist">
                            <li class="nav-item" role="presentation">
                                <a class="nav-link active" id="reviews-tab" data-bs-toggle="tab" href="#reviews"
                                    role="tab" aria-controls="reviews" aria-selected="true">Details</a>
                            </li>
                            <li class="nav-item" role="presentation">
                                <a class="nav-link" id="details-tab" data-bs-toggle="tab" href="#details" role="tab"
                                    aria-controls="details" aria-selected="false">Reviews</a>
                            </li>
                        </ul>

                        <!-- Tab panes -->
                        <div class="tab-content" id="productTabContent">
                            <div class="tab-pane fade show active" id="reviews" role="tabpanel"
                                aria-labelledby="reviews-tab">
                                <!-- Reviews content goes here -->
                                <p class="mb-4">
                                    <?php echo $row["profession"]; ?>
                                </p>
                                <p class="mb-4">
                                    <button class="btn btn-secondary py-12 px-3 mt-1 me-3 location_btn"
                                        id="shareButton"> <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                            fill="currentColor" class="bi bi-database" viewBox="0 0 16 16">
                                            <path
                                                d="M4.318 2.687C5.234 2.271 6.536 2 8 2s2.766.27 3.682.687C12.644 3.125 13 3.627 13 4c0 .374-.356.875-1.318 1.313C10.766 5.729 9.464 6 8 6s-2.766-.27-3.682-.687C3.356 4.875 3 4.373 3 4c0-.374.356-.875 1.318-1.313ZM13 5.698V7c0 .374-.356.875-1.318 1.313C10.766 8.729 9.464 9 8 9s-2.766-.27-3.682-.687C3.356 7.875 3 7.373 3 7V5.698c.271.202.58.378.904.525C4.978 6.711 6.427 7 8 7s3.022-.289 4.096-.777A4.92 4.92 0 0 0 13 5.698ZM14 4c0-1.007-.875-1.755-1.904-2.223C11.022 1.289 9.573 1 8 1s-3.022.289-4.096.777C2.875 2.245 2 2.993 2 4v9c0 1.007.875 1.755 1.904 2.223C4.978 15.71 6.427 16 8 16s3.022-.289 4.096-.777C13.125 14.755 14 14.007 14 13V4Zm-1 4.698V10c0 .374-.356.875-1.318 1.313C10.766 11.729 9.464 12 8 12s-2.766-.27-3.682-.687C3.356 10.875 3 10.373 3 10V8.698c.271.202.58.378.904.525C4.978 9.71 6.427 10 8 10s3.022-.289 4.096-.777A4.92 4.92 0 0 0 13 8.698Zm0 3V13c0 .374-.356.875-1.318 1.313C10.766 14.729 9.464 15 8 15s-2.766-.27-3.682-.687C3.356 13.875 3 13.373 3 13v-1.302c.271.202.58.378.904.525C4.978 12.71 6.427 13 8 13s3.022-.289 4.096-.777c.324-.147.633-.323.904-.525Z" />
                                        </svg>
                                        <?php echo $cat; ?>
                                    </button>

                                </p>
                                <p class="mb-4">
                                    <?php echo $row["slogan"]; ?>
                                </p>
                                <button class="btn btn-secondary py-6 px-3 mt-1 me-3 location_btn" id="shareButton"> <i
                                        class="bi bi-geo-alt"></i>
                                    <?php echo $row['county']; ?>
                                </button>

                                <!-- Contact Seller button -->
                                <button class="btn btn-primary py-3 px-3 mt-1 location_btn" id="contactSellerButton"><i
                                        class="bi bi-geo-alt"></i>
                                    <?php echo $row['sub_counry']; ?>
                                </button>

                                <a class="btn btn-primary py-3 px-3 mt-1 location_btn" href="#"><i
                                        class="bi bi-geo-alt"></i>
                                    <?php echo $row['ward']; ?>
                                </a>
                            </div>
                            <div class="tab-pane fade" id="details" role="tabpanel" aria-labelledby="details-tab">
                                <!-- Product details content goes here -->
                                <div class="container mt-2">
                                    <div class="row">
                                        <?php
                                        while ($row2 = $result2->fetch_assoc()) {

                                        echo '<div class="col-md-12">
                                        <div class="review-card">
                                            <div class="card">

                                                <div class="card-body">
                                                    <h6 class="card-title">'.$row2['name'].'</h6>
                                                    <p class="card-text">'.$row2['comment'].'</p>
                                                    <div class="text-start">
                                                        <span class="text-muted">Rating:</span>
                                                        <span class="text-warning">&#9733; &#9733; &#9733; &#9733;
                                                            &#9734;</span>
                                                    </div>
                                                </div>
                                            </div>
                                            </div>
                                        </div>';
    }
    ?>
                                    

                                        

                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Share button -->
                        <button class="btn btn-secondary py-3 px-3 mt-3 me-3 action_btn" id="shareButton"> <i
                                class="bi bi-telephone"></i> <a href="tel:<?php echo $row['phone']; ?> ">Conatct</a>

                            <!-- Contact Seller button -->
                            <button class="btn btn-primary py-3 px-3 mt-3 action_btn" id="contactSellerButton"
                                data-bs-toggle="modal" data-bs-target="#exampleModal"><i class="fa fa-star"></i> Leave review</button>

                            <a class="btn btn-primary py-3 px-3 mt-3 action_btn" href="#"><i
                                    class="bi bi-share"></i>Share</a>
                    </div>
                </div>
            </div>
        </section>

        <?php include 'mainFooter.php'; ?>

        <!-- Back to Top -->
        <a href="index.php" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i
                class="bi bi-arrow-up text-white"></i></a>
    </div>
    <div class="modal fade " id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Review
                        <?php echo $row['name']; ?>
                    </h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="reviewForm" action="" method="post">
                        <div class="mb-3">
                            <label for="rating" class="form-label">Rating:</label>
                            <select class="form-select" id="rating" name="rating" required>
                                <option value="5">5 Stars</option>
                                <option value="4">4 Stars</option>
                                <option value="3">3 Stars</option>
                                <option value="2">2 Stars</option>
                                <option value="1">1 Star</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="review" class="form-label">Review:</label>
                            <textarea class="form-control" id="review" name="review" rows="4" required></textarea>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-primary" onclick="showLoader()">Submit Review</button>
                        </div>
                    </form>
                </div>

                <div class="modal-footer">
                </div>
            </div>
        </div>
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