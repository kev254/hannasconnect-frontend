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
    <title>Hannasconnect | Blogs</title>
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
    <link rel="shortcut icon" href="favicon.png">
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
    <section class="py-5">
      <div class="container">
        <div class="row gy-5">
          <!-- Latest Posts -->
          <main class="col-lg-8"> 
            <div class="container"><img class="img-fluid w-100 mb-4" src="img/blog-2.jpg" alt="...">
              <ul class="list-inline mb-3">
                <li class="list-inline-item"><a class="text-uppercase" href="#">Business</a></li>
                <li class="list-inline-item"><a class="text-uppercase" href="#">Technology</a></li>
              </ul>
              <h1 class="mb-4">How to build a thriving career<a href="#"><i class="fa fa-bookmark-o"></i></a></h1>
              <ul class="list-inline list-separated text-gray-500 mb-5">
                
                <li class="list-inline-item small"><i class="far fa-clock"></i> 2 months ago</li>
                <li class="list-inline-item small"><i class="far fa-comment"></i> 12</li>
              </ul>
              <div class="post-body">
                <p class="lead">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
                <p class="mb-4">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
                <p class="mb-4"><img class="img-fluid" src="img/featured-pic-3.jpeg" alt="..."></p>
                <h3>Lorem Ipsum Dolor</h3>
                <p class="mb-4">div Lorem ipsum dolor sit amet, consectetur adipisicing elit. Assumenda temporibus iusto voluptates deleniti similique rerum ducimus sint ex odio saepe. Sapiente quae pariatur ratione quis perspiciatis deleniti accusantium</p>
                <div class="border-start border-4 mb-3">
                  <figure class="border p-4">
                    <blockquote class="blockquote">
                      <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip.</p>
                    </blockquote>
                    <figcaption class="blockquote-footer mb-0">Someone famous in
                      <cite title="Source Title">Source Title</cite>
                    </figcaption>
                  </figure>
                </div>
                <p>quasi nam. Libero dicta eum recusandae, commodi, ad, autem at ea iusto numquam veritatis, officiis. Accusantium optio minus, voluptatem? Quia reprehenderit, veniam quibusdam provident, fugit iusto ullam voluptas neque soluta adipisci ad.</p>
              </div>
              <ul class="list-inline mb-5">
                <li class="list-inline-item"><a class="tag" href="#">#Business</a></li>
                <li class="list-inline-item"><a class="tag" href="#">#Tricks</a></li>
                <li class="list-inline-item"><a class="tag" href="#">#Financial</a></li>
                <li class="list-inline-item"><a class="tag" href="#">#Economy</a></li>
              </ul>
              <div class="posts-nav d-flex justify-content-between align-items-stretch flex-column flex-md-row mb-5"><a class="prev-post text-start d-flex align-items-center" href="#">
                  <div class="icon prev"><i class="fas fa-angle-left"></i></div>
                  <div class="text"><strong class="text-primary">Previous Post </strong>
                    <h6>Looking for a job?</h6>
                  </div></a><a class="next-post text-end d-flex align-items-center justify-content-end" href="#">
                  <div class="text"><strong class="text-primary">Next Post </strong>
                    <h6>Navigating the corporate world</h6>
                  </div>
                  <div class="icon next"><i class="fas fa-angle-right">   </i></div></a></div>
              <div class="mb-5">
                <header>
                  <h3 class="h6 mb-4">Post Comments<span class="fw-light text-gray-600 small ms-2">(3)</span></h3>
                </header>
                <div class="d-flex align-items-start"><img class="img-fluid rounded-circle flex-shrink-0" src="img/user.svg" alt="Jabi Hernandiz" width="50"/>
                  <div class="pb-4 ms-3 border-bottom mb-4"><strong>Jabi Hernandiz</strong>
                    <p class="small text-gray-500">May 2016</p>
                    <p class="mb-0 text-sm">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam.</p>
                  </div>
                </div>
                <div class="d-flex align-items-start"><img class="img-fluid rounded-circle flex-shrink-0" src="img/user.svg" alt="Nikolas" width="50"/>
                  <div class="pb-4 ms-3 border-bottom mb-4"><strong>Nikolas</strong>
                    <p class="small text-gray-500">May 2016</p>
                    <p class="mb-0 text-sm">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam.</p>
                  </div>
                </div>
                <div class="d-flex align-items-start"><img class="img-fluid rounded-circle flex-shrink-0" src="img/user.svg" alt="John Doe" width="50"/>
                  <div class="pb-4 ms-3 true"><strong>John Doe</strong>
                    <p class="small text-gray-500">May 2016</p>
                    <p class="mb-0 text-sm">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam.</p>
                  </div>
                </div>
              </div>
              <div class="mb-5">
                <header>
                  <h3 class="h6 mb-4">Leave a reply</h3>
                </header>
                <form action="#">
                  <div class="row gy-3">
                    <div class="col-md-6">
                      <div class="border-bottom">
                        <input class="form-control px-0 border-0 shadow-0" type="text" name="username" id="username" placeholder="Name">
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="border-bottom">
                        <input class="form-control px-0 border-0 shadow-0" type="email" name="username" id="useremail" placeholder="Email Address (will not be published)">
                      </div>
                    </div>
                    <div class="col-md-12">
                      <div class="border-bottom">
                        <textarea class="form-control px-0 border-0 shadow-0" rows="5" name="usercomment" id="usercomment" placeholder="Type your comment"></textarea>
                      </div>
                    </div>
                    <div class="col-md-12">
                      <button class="btn btn-secondary" type="submit">Submit Comment</button>
                    </div>
                  </div>
                </form>
              </div>
            </div>
          </main>
          <aside class="col-lg-4">
            <!-- Widget [Search Bar Widget]-->
            <div class="card mb-5">
              <div class="card-body">
                <h3 class="h6">Search the blog</h3>
                <form action="#">
                  <div class="input-group border-bottom">
                    <input class="form-control border-0 shadow-0 ps-0" type="search" placeholder="What are you looking for?">
                    <button class="btn btn-link btn-sm shadow-0 px-0" type="submit"><i class="fas fa-search"></i></button>
                  </div>
                </form>
              </div>
            </div>
            <!-- Widget [Latest Posts Widget]        -->
            <div class="card mb-5">
              <div class="card-body">
                <h3 class="h6 mb-3">Latest Posts</h3><a class="text-reset mb-3" href="#">
                  <div class="d-flex align-items-center"><img class="img-fluid flex-shrink-0" src="img/small-thumbnail-1.jpg" alt="..." width="55">
                    <div class="ms-3">
                      <p class="mb-2 fw-bold text-gray-700 lh-1">Alberto Savoia Can Teach You About</p>
                      <ul class="list-inline list-separated text-gray-500 d-flex align-items-center">
                        <li class="list-inline-item small"><i class="far fa-eye"></i> 500</li>
                        <li class="list-inline-item small"><i class="far fa-comment"></i> 12</li>
                      </ul>
                    </div>
                  </div></a><a class="text-reset mb-3" href="#">
                  <div class="d-flex align-items-center"><img class="img-fluid flex-shrink-0" src="img/small-thumbnail-2.jpg" alt="..." width="55">
                    <div class="ms-3">
                      <p class="mb-2 fw-bold text-gray-700 lh-1">Alberto Savoia Can Teach You About</p>
                      <ul class="list-inline list-separated text-gray-500 d-flex align-items-center">
                        <li class="list-inline-item small"><i class="far fa-eye"></i> 500</li>
                        <li class="list-inline-item small"><i class="far fa-comment"></i> 12</li>
                      </ul>
                    </div>
                  </div></a><a class="text-reset" href="#">
                  <div class="d-flex align-items-center"><img class="img-fluid flex-shrink-0" src="img/small-thumbnail-3.jpg" alt="..." width="55">
                    <div class="ms-3">
                      <p class="mb-2 fw-bold text-gray-700 lh-1">Alberto Savoia Can Teach You About</p>
                      <ul class="list-inline list-separated text-gray-500 d-flex align-items-center">
                        <li class="list-inline-item small"><i class="far fa-eye"></i> 500</li>
                        <li class="list-inline-item small"><i class="far fa-comment"></i> 12</li>
                      </ul>
                    </div>
                  </div></a>
              </div>
            </div>
           
            <!-- Widget [Tags Cloud Widget]-->
            <div class="card">
              <div class="card-body">     
                <h3 class="h6 mb-3">Tags</h3>
                <ul class="list-inline mb-0">
                  <li class="list-inline-item"><a class="tag" href="#">#Business </a></li>
                  <li class="list-inline-item"><a class="tag" href="#">#Fashion </a></li>
                  <li class="list-inline-item"><a class="tag" href="#">#Sports </a></li>
                  <li class="list-inline-item"><a class="tag" href="#">#Technology </a></li>
                  <li class="list-inline-item"><a class="tag" href="#">#Economy </a></li>
                </ul>
              </div>
            </div>
          </aside>
        </div>
      </div>
    </section>
    <!-- Page Footer-->
    <?php include 'mainFooter.php'; ?>



    <!-- JavaScript files-->
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="vendor/glightbox/glightbox.js"></script>
    <script src="js/theme.js"></script>
    <!-- FontAwesome CSS - loading as last, so it doesn't block rendering-->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
  </body>
</html>