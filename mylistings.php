<?php
include "includes/dbconnect.php";
session_start();
$user_id = ($_SESSION['user']['id']);
$sql = "SELECT users.*, services.* FROM users INNER JOIN services ON users.id = services.user_id WHERE user_id='$user_id'";


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

            color: white;
            /* Text color */
            font-size: 13px;
            /* Font size */
            padding: 5px 10px;
            /* Padding around the badge text */
            border-radius: 5px;
            /* Rounded corners */
            position: absolute;
            /* Position the badge */
            top: 10px;
            /* Adjust the top position as needed */
            left: 10px;
            /* Adjust the left position as needed */
            width: 80px;
        }

        /* Position the menu-container to the top-right */
        .menu-container {
            position: absolute;
            top: 10px;
            /* Adjust as needed */
            right: 10px;
            /* Adjust as needed */
        }

        /* Style the three-dots menu button */
        .menu-btn {
            background: none;
            border: none;
            font-size: 18px;
            cursor: pointer;
        }

        /* Style the popup menu */
        .popup-menu {
            position: absolute;
            top: 30px;
            /* Adjust as needed */
            right: 0;
            background-color: #fff;
            box-shadow: 0px 0px 5px rgba(0, 0, 0, 0.2);
            display: none;
            z-index: 1;
        }

        .popup-menu a {
            display: block;
            padding: 10px;
            text-decoration: none;
            color: #333;
        }

        .popup-menu a:hover {
            background-color: #f0f0f0;
        }
    </style>

</head>

<body class="body">
    <div class="container-xxl p-0">

        <?php include 'mainNavbar.php'; ?>
        <!-- Category Start -->
        <section id="category" class="container-xxl py-5">
            <div class="container ">
                <h2 class="text-left mb-5 wow fadeInUp" data-wow-delay="0.1s">My Listings</h2>
                <div class="row g-4">

                    <?php

                    while ($row = $result->fetch_assoc()) {
                        $badge = '<span class="badge bg-success">Open </span>';
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
                        if ($row['status'] === "0") {
                            $badge = '<span class="badge bg-danger">Closed</span>';
                        }



                        echo '<div class="col-lg-3 col-md-4 col-sm-6 col-12 wow fadeInUp" data-wow-delay="0.1s">
                        <div class="wsk-cp-product">
                            <div class="menu-container">
                                <div class="menu">
                                    <button class="menu-btn" onclick="toggleMenu(this)"><i class="bi bi-three-dots-vertical"></i></button>
                                    <div class="popup-menu" style="display: none;">
                                        <a href="user_details.php?id='.$row['id'].'" onclick="editBlock(this)">View</a>
                                        <a href="edit.php?id='.$row['id'].'" onclick="editBlock(this)">Edit</a>
                                        <a href="#" onclick="performAction(this, ' . $row['id'] . ', \'update\')">Close</a>
                                        <a href="#" onclick="performAction(this, ' . $row['id'] . ', \'delete\')">Delete</a>
                                    </div>
                                </div>
                            </div>
                    
                            <!-- Badge -->
                             '.$badge.'
                    
                            <div class="wsk-cp-img">
                                <img src="'.$image.'" alt="Product" class="img-responsive" />
                            </div>
                            <div class="wsk-cp-text">
                                <div class="title-product">
                                    <h5>'.$row['name'].'</h5>
                                </div>
                                <div class="description-prod">
                                    <div class="d-flex align-items-center mb-2 pe-3 justify-content-between w-100">
                                        <p class="cat-pill">'.$cat.'</p>
                                        <p class="price"><img src="img/new/location.svg" class="social-icon"> '.$row['county'].'</p>
                                    </div>
                                    <p class="prof mb-2">'.$row['profession'].'</p>
                                    <p class="desc-words">'.$row['slogan'].'</p>
                                    <p class="mb-2">Contact: <b>'.$row['phone'].'</b></p>
                                </div>
                                <div class="d-flex mb-2 pe-3 justify-content-between w-100 card-buttons">
                                    <a href="#" class="review-pill"><i class="fa fa-star"></i>0 Reviews</a>
                                </div>
                            </div>
                        </div>
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



        <?php include 'mainFooter.php'; ?>

        <!-- Back to Top -->
        <a href="index.php" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i
                class="bi bi-arrow-up text-white"></i></a>
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

    <script src="https://cdn.jsdelivr.net/npm/places.js@1.19.0"></script>
    <!-- JavaScript -->
    <script>
        function toggleMenu(btn) {
            var menu = btn.nextElementSibling;
            menu.style.display = (menu.style.display === "block") ? "none" : "block";
        }

        function editBlock(link) {
            // Implement the edit functionality here
            // You can redirect the user to an edit page or open a modal
            // Example: window.location.href = "edit_page.php?id=" + <?php echo $row["id"]; ?>;
        }

        function performAction(link, id, action) {
    var confirmation;
    if (action === 'update') {
        confirmation = confirm("Are you sure you want to close this listing?");
    } else if (action === 'delete') {
        confirmation = confirm("Are you sure you want to delete this listing?");
    }
    
    if (confirmation) {
        // Perform an AJAX request to update or delete the item
        var xhr = new XMLHttpRequest();
        xhr.open("POST", "update_status.php", true);
        xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xhr.onreadystatechange = function () {
            if (xhr.readyState === 4 && xhr.status === 200) {
                // Handle the response, if needed
                // You can reload the page or update the UI accordingly
                window.location.reload();
            }
        };
        xhr.send("id=" + id + "&action=" + action);
    }
}

    </script>





</body>

</html>