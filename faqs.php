
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Hanna's connect</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

    <!-- Favicon -->
    <link rel="icon" href="img/new/logo.png" type="image/x-icon">



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
<div class="container-fluid p-0">
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

    <section id="faq" class="faq m-3">
        <div class="container" data-aos="fade-up">
            <h2 class="section-title-large text-center">Frequently Asked Questions (FAQs)</h2>


            <!-- single faq -->
            <div class="accordion-list">
                <ul>
                    <li data-aos="fade-up">
                        <i class="fas fa-question-circle icon-help"></i> <a data-bs-toggle="collapse" class="collapse"
                                                                            data-bs-target="#accordion-list-1">

                            Do I pay a fee to get contacts on Hanna’s Connect?

                            <i class="bi bi-chevron-down icon-show"></i><i class="bi bi-chevron-up icon-close"></i></a>
                        <div id="accordion-list-1" class="collapse" data-bs-parent=".accordion-list">
                            No, using Hanna's Connect or perusing, saving contacts and sending to friends and family is
                            absolutely free.

                        </div>
                    </li>


                    <li data-aos="fade-up">
                        <i class="fas fa-question-circle icon-help"></i> <a data-bs-toggle="collapse" class="collapse"
                                                                            data-bs-target="#accordion-list-2">

                            Can I list for free on Hanna’s Connect?

                            <i class="bi bi-chevron-down icon-show"></i><i class="bi bi-chevron-up icon-close"></i></a>
                        <div id="accordion-list-2" class="collapse" data-bs-parent=".accordion-list">
                            Yes you can list yourself and your business for absolutely free, however, please note, paying
                            accounts are given more priority of visibility than free accounts

                        </div>
                    </li>


                    <li data-aos="fade-up">
                        <i class="fas fa-question-circle icon-help"></i> <a data-bs-toggle="collapse" class="collapse"
                                                                            data-bs-target="#accordion-list-3">

                            What if I don’t want to share my details?

                            <i class="bi bi-chevron-down icon-show"></i><i class="bi bi-chevron-up icon-close"></i></a>
                        <div id="accordion-list-3" class="collapse" data-bs-parent=".accordion-list">
                            The only details we share of you are the details you have shared with us willingly, i.e the details you
                            fill on your profile.

                        </div>
                    </li>


                    <li data-aos="fade-up">
                        <i class="fas fa-question-circle icon-help"></i> <a data-bs-toggle="collapse" class="collapse"
                                                                            data-bs-target="#accordion-list-4">

                            What if I have different branches does that mean different accounts?

                            <i class="bi bi-chevron-down icon-show"></i><i class="bi bi-chevron-up icon-close"></i></a>
                        <div id="accordion-list-4" class="collapse" data-bs-parent=".accordion-list">
                            No, just tick as many counties as your branch locations
                        </div>
                    </li>

                    <li data-aos="fade-up">
                        <i class="fas fa-question-circle icon-help"></i> <a data-bs-toggle="collapse" class="collapse"
                                                                            data-bs-target="#accordion-list-5">

                            Can I list on Hanna’s connect if I am a foreigner?

                            <i class="bi bi-chevron-down icon-show"></i><i class="bi bi-chevron-up icon-close"></i></a>
                        <div id="accordion-list-5" class="collapse" data-bs-parent=".accordion-list">
                            Yes, you absolutely can
                        </div>
                    </li>

                    <li data-aos="fade-up">
                        <i class="fas fa-question-circle icon-help"></i> <a data-bs-toggle="collapse" class="collapse"
                                                                            data-bs-target="#accordion-list-6">

                            Can I list on Hanna’s Connect if am online based?

                            <i class="bi bi-chevron-down icon-show"></i><i class="bi bi-chevron-up icon-close"></i></a>
                        <div id="accordion-list-6" class="collapse" data-bs-parent=".accordion-list">
                            Yes you absolutely can.
                        </div>
                    </li>

                    <li data-aos="fade-up">
                        <i class="fas fa-question-circle icon-help"></i> <a data-bs-toggle="collapse" class="collapse"
                                                                            data-bs-target="#accordion-list-7">

                            Can I list On Hanna’s Connect if my company is registered in a different country?

                            <i class="bi bi-chevron-down icon-show"></i><i class="bi bi-chevron-up icon-close"></i></a>
                        <div id="accordion-list-7" class="collapse" data-bs-parent=".accordion-list">
                            Yes, if you offer services or offer products in Kenya, you can list.
                        </div>
                    </li>

                </ul>
            </div>

        </div>
    </section>
    <?php include 'mainFooter.php'; ?>

</div>

<!-- JavaScript Libraries -->
<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="lib/wow/wow.min.js"></script>
<script src="lib/easing/easing.min.js"></script>
<script src="lib/waypoints/waypoints.min.js"></script>
<script src="lib/owlcarousel/owl.carousel.min.js"></script>
<script src="assets/vendor/swiper/swiper-bundle.min.js"></script>

<!-- Template Javascript -->
<script src="js/main.js"></script>
<script src="assets/js/theme.js"></script>
</body>
</html>
