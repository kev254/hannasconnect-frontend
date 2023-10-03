<nav class="navbar navbar-expand-lg bg-white navbar-light shadow-sm sticky-top p-0 landing-nav">
    <a href="index.php" class="navbar-brand d-flex align-items-center text-center py-0 px-4 px-lg-5">
        <img src="img/new/logo.png" alt="logo" class="logo"> 
       
        
    </a>

    <button type="button" class="navbar-toggler me-4" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse justify-content-end" id="navbarCollapse">
        <div class="navbar-nav ms-auto p-4 p-lg-0 align-items-center">
            <a href="#category" class="nav-item nav-link">About US</a>
            <?php
            if (session_status() == PHP_SESSION_NONE) {
                session_start();
            }
            if (isset($_SESSION['login_admin'])) {
                echo '<a href="adminAccount.php" class="btn btn-primary rounded-circle">
                    VIEW ACCOUNT <i class="fa fa-arrow-right"></i>
                </a>';
            } elseif (isset($_SESSION['user'])) {
                $myusername = $_SESSION['user']['name'];
                echo '<a><div class="hover-dropdown ">
                    <div class="brown-btn-filled text-white">
                        Hi, ' . $myusername . ' <i class="fa fa-user text-white"></i> 
                        <i class="fa fa-chevron-down text-white"></i>

                    </div>
                    <div class="dropdown-content dropdown-left">
                        <a class="dropdown-item" href="add_listing.php">Add listing</a>
                        <a class="dropdown-item" href="profile.php">My Profile</a>
                        <a class="dropdown-item" href="mylistings.php">My Listings</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="logout.php">Logout</a>
                    </div>
                </div></a>';
            } else {
                echo '<a href="login.php" class="nav-item nav-link">  Login </a>';
                echo '<a href="signup.php" class="nav-item nav-link">Register </a>';
            }
            ?>
        </div>
    </div>
</nav>
<style>
    .user-badge{
        padding-top: 25px !important;
    }
    .dropdown-content.dropdown-left {
        border-radius: 5px;
        background-color: #fff;
        left: auto; /* Reset left position */
        right: 0; /* Position the dropdown to the right */
        width: 150px; /* Set the width to 100px */
    }
</style>
