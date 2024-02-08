<?php
require_once "includes/dbconnect.php";
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
    <section>
      <div class="container">
        <h1 class="text-center">
          Our Blog posts
        </h1>
        <div class="row gy-5 mt-3">
          <!-- Latest Posts -->
          <main class="col-lg-8"> 
            <div class="container">
              <div class="row gy-4 mb-5">

                  <?php
                  function time_elapsed_string($datetime, $full = false) {
                      $now = new DateTime;
                      $ago = new DateTime($datetime);
                      $diff = $now->diff($ago);

                      $diff->w = floor($diff->d / 7);
                      $diff->d -= $diff->w * 7;

                      $string = array(
                          'y' => 'year',
                          'm' => 'month',
                          'w' => 'week',
                          'd' => 'day',
                          'h' => 'hour',
                          'i' => 'minute',
                          's' => 'second',
                      );
                      foreach ($string as $k => &$v) {
                          if ($diff->$k) {
                              $v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? 's' : '');
                          } else {
                              unset($string[$k]);
                          }
                      }

                      if (!$full) $string = array_slice($string, 0, 1);
                      return $string ? implode(', ', $string) . ' ago' : 'just now';
                  }

$query="SELECT * FROM Blog_Posts ORDER BY date_created DESC";
$stmt=$conn->prepare($query);
$stmt->bind_result($id,$previewImage,$category,$viewCount,$commentsCount,$title,$shortDescription,$content,$dateCreated,$userId);
$stmt->execute();

while ($stmt->fetch()){
?>

                <!-- post -->
                <div class="col-xl-6"><a class="mb-3" href="<?php echo $previewImage;?>"><img class="img-fluid" src="<?php echo $previewImage;?>" alt="<?php echo $previewImage;?>"/></a>
                  <div class="d-flex align-items-center justify-content-between mb-2"><small class="text-gray-500"><?php echo date('d M Y',strtotime($dateCreated)) ?></small><a class="small fw-bold text-uppercase small" href="#"><?php echo $category;?></a></div>
                  <h3 class="h4"><a class="text-dark" href="post.php?blog=<?php echo $id?>"><?php echo $title;?></a></h3>
                  <p class="text-muted text-sm"><?php echo $shortDescription; ?>.</p>
                  <ul class="list-inline list-separated text-gray-500 mb-0">
                    
                    <li class="list-inline-item small"><i class="far fa-clock"></i><?php echo time_elapsed_string($dateCreated);?></li>
                    <li class="list-inline-item small"><i class="far fa-comment"></i> <?php echo $commentsCount;?></li>
                  </ul>
                </div>
                  <?php
}
$stmt->close();
                  ?>

              </div>
              <!-- Pagination -->
              <nav aria-label="Page navigation example">
                <ul class="pagination justify-content-center">
                  <li class="page-item"><a class="page-link" href="#"><i class="fas fa-angle-left"></i></a></li>
                  <li class="page-item active"><a class="page-link" href="#">1</a></li>
                  <li class="page-item"><a class="page-link" href="#">2</a></li>
                  <li class="page-item"><a class="page-link" href="#">3</a></li>
                  <li class="page-item"><a class="page-link" href="#"><i class="fas fa-angle-right"></i></a></li>
                </ul>
              </nav>
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
                <h3 class="h6 mb-3">Latest Posts</h3><a class="text-reset mb-3" href="post.php">

                      <?php
                      $query="SELECT Id,preview,title,viewCount,commentsCount FROM Blog_Posts ORDER BY date_created DESC LIMIT 10";
                      $stmt=$conn->prepare($query);
                      $stmt->bind_result($pId,$pImage,$pTitle,$vCount,$pComments);
                      $stmt->execute();
                      while ($stmt->fetch()){
                      ?>
                  <div class="d-flex align-items-center"><img class="img-fluid flex-shrink-0" src="<?php echo $pImage;?>" alt="..." width="55">
                    <div class="ms-3">
                      <p class="mb-2 fw-bold text-gray-700 lh-1"><?php echo $pTitle;?></p>
                      <ul class="list-inline list-separated text-gray-500 d-flex align-items-center">
                        <li class="list-inline-item small"><i class="far fa-eye"></i> <?php echo $vCount;?></li>
                        <li class="list-inline-item small"><i class="far fa-comment"></i> <?php echo $pComments;?></li>
                      </ul>
                    </div>
                  </div></a><a class="text-reset mb-3" href="post.php?blog=<?php echo $pId;?>">
                      <?php
                      }
                      $stmt->close();
                      ?>
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