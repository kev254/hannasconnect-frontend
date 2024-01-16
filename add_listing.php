<?php
// Include the database connection
// Include the database connection
session_start();
include "includes/dbconnect.php";
if (!isset($_SESSION['user'])) {
    header('Location: login.php');
}
$keys = array();
// Check if the form is submitted
if (isset($_POST['send'])) {
    $category = $_POST['category'];
    $name = $_POST['name'];
    $slogan = $_POST['slogan'];
    $county = $conn->real_escape_string($_POST['county']);
    $sub_county = $conn->real_escape_string($_POST['sub_county']);
    $ward = $conn->real_escape_string($_POST['ward']);
    $email = $_POST['email'];
    $phone = $_POST['phone']; // Using MD5 for password hashing
    $password = md5($_POST['password']);
    $ibfk = $conn->real_escape_string($_POST['ibfk']);
    $i_physical_address = $_POST['i_physical_address'];
    $i_location_pin = $_POST['i_location_pin'];
    $i_website = $_POST['i_website'];
    $i_working_day = $conn->real_escape_string($_POST['i_working_days']);
    $i_start_time = $_POST['i_start_time'];
    $i_end_time = $_POST['i_end_time'];
    $i_social_links = $_POST['i_social_links'];
    $i_price = $_POST['i_price'];
    $i_price_negotiable = $_POST['i_price_negotiable'];
    $plan = "0";
    $profession = $_POST['profession'];
    $logged_user = $_SESSION['user'];
    $fileName = $_FILES['logo']['name'];
    $target = "uploads/";
    $fileTarget = $target . $fileName;
    $tempFileName = $_FILES["logo"]["tmp_name"];

    $key1 = $_POST['key1'];
    $key2 = $_POST['key2'];
    $key3 = $_POST['key3'];
    $key4 = $_POST['key4'];
    $key5 = $_POST['key5'];
    $key6 = $_POST['key6'];
    $key7 = $_POST['key7'];
    $key8 = $_POST['key8'];
    $key9 = $_POST['key9'];
    $key10 = $_POST['key10'];


    $bkey1 = $_POST['bkey1'];
    $bkey2 = $_POST['bkey2'];
    $bkey3 = $_POST['bkey3'];
    $bkey4 = $_POST['bkey4'];
    $bkey5 = $_POST['bkey5'];
    $bkey6 = $_POST['bkey6'];
    $bkey7 = $_POST['bkey7'];
    $bkey8 = $_POST['bkey8'];
    $bkey9 = $_POST['bkey9'];
    $bkey10 = $_POST['bkey10'];

    if (!empty($key1)) {
        array_push($keys, $key1);
    }
    if (!empty($key2)) {
        array_push($keys, $key2);
    }
    if (!empty($key3)) {
        array_push($keys, $key3);
    }
    if (!empty($key4)) {
        array_push($keys, $key4);
    }
    if (!empty($key5)) {
        array_push($keys, $key5);
    }
    if (!empty($key6)) {
        array_push($keys, $key6);
    }
    if (!empty($key7)) {
        array_push($keys, $key7);
    }
    if (!empty($key8)) {
        array_push($keys, $key8);
    }

    if (!empty($key9)) {
        array_push($keys, $key9);
    }
    if (!empty($key10)) {
        array_push($keys, $key10);
    }

    // business keywords
    if (!empty($bkey1)) {
        array_push($keys, $bkey1);
    }
    if (!empty($bkey2)) {
        array_push($keys, $bkey2);
    }
    if (!empty($bkey3)) {
        array_push($keys, $bkey3);
    }
    if (!empty($bkey4)) {
        array_push($keys, $bkey4);
    }
    if (!empty($bkey5)) {
        array_push($keys, $bkey5);
    }
    if (!empty($bkey6)) {
        array_push($keys, $bkey6);
    }
    if (!empty($bkey7)) {
        array_push($keys, $bkey7);
    }
    if (!empty($bkey8)) {
        array_push($keys, $bkey8);
    }

    if (!empty($bkey9)) {
        array_push($keys, $bkey9);
    }
    if (!empty($bkey10)) {
        array_push($keys, $bkey10);
    }



    $jsonkeywords = json_encode($keys);




    $bbfk = $conn->real_escape_string($_POST['bbfk']);
    $b_branches = $_POST['b_branches'];
    $b_location_pin = $_POST['b_location_pin'];
    $b_website = $_POST['b_website'];
    $b_working_day = $conn->real_escape_string($_POST['b_working_days']);
    $b_start_time = $_POST['b_start_time'];
    $b_end_time = $_POST['b_end_time'];
    $b_social_links = $_POST['b_social_links'];
    $b_message = $_POST['b_message'];
    $b_price_negotiable = $_POST['b_price_negotiable'];
    $b_price=$_POST['b_price'];



    //Hire values
    $hbfk = $conn->real_escape_string($_POST['hbfk']);
    $h_looking_for = $_POST['h_looking_for'];
    $h_profession = $_POST['h_profession'];
    $h_facility_level = $_POST['h_facility_level'];
    $h_skill = $_POST['h_skill'];
    $h_salary_expectation = $_POST['h_salary_expectation'];
    $h_image_url = $_POST['h_image_url'];



    //emergency
    $e_service = $_POST['e_service'];
    $e_price = $_POST['e_price'];
    $e_price_negotiable = $_POST['e_price_negotiable'];




    $lastInsertedUserId = $_SESSION['user']['id']; // Get the last inserted user ID
    $result = move_uploaded_file($tempFileName, $fileTarget);

    // Insert data into the 'individual' table using the last inserted user ID
    if ($category === "1") {
       

        $individualInsertSql = "INSERT INTO services (profession,name, user_id, slogan, county, sub_counry, ward, email, bkf, physical_address, location_pin, website, working_days, open_at, clsoing_at, social_links, price, key_words, plan, price_negotiable, category_id, image_url)
            VALUES ('$profession','$name', '$lastInsertedUserId', '$slogan', '$county', '$sub_county', '$ward', '$email', '$ibfk', '$i_physical_address', '$i_location_pin', '$i_website', '$i_working_day', '$i_start_time', '$i_end_time', '$i_social_links', '$i_price', '$jsonkeywords ', '$plan', '$i_price_negotiable', '$category', '$fileName')";

    } else if ($category === "2") {
        $individualInsertSql = "INSERT INTO services (name, user_id, slogan, county, sub_counry, ward, email, bkf, branches, location_pin, website, working_days, open_at, clsoing_at, social_links, key_words, plan, price_negotiable, category_id, message, image_url, price)
            VALUES ('$name', '$lastInsertedUserId', '$slogan', '$county', '$sub_county', '$ward', '$email', '$bbfk', '$b_ranches', '$i_location_pin', '$b_website', '$b_working_day', '$b_start_time','$i_end_time', '$b_social_links', '$jsonkeywords ', '$plan', '$b_price_negotiable', '$category', '$b_message', '$fileName', '$b_price')";
    } else if ($category === "3") {



        $individualInsertSql = "INSERT INTO services (name, user_id, slogan, county, sub_counry, ward, email,   plan, price,price_negotiable, category_id, service, image_url)
            VALUES ('$name', '$lastInsertedUserId', '$slogan', '$county', '$sub_county', '$ward', '$email',  '$plan', $e_price, '$e_price_negotiable', '$category', '$e_service', '$fileName')";
        //echo "Query: $individualInsertSql";
    } else if ($category === "4") {
        $cvfileName = $_FILES['cv_file']['name'];
        $cvtarget = "uploads/";
        $cvfileTarget = $cvtarget . $cvfileName;
        $cvtempFileName = $_FILES["cv_file"]["tmp_name"];
        $cvresult = move_uploaded_file($cvtempFileName, $cvfileTarget);


        $individualInsertSql = "INSERT INTO services (name, user_id, slogan, county, sub_counry, ward, email,   plan, bkf,looking_for, profession,education_level,skill,salary_expectation,image_url,category_id, cv_url)
            VALUES ('$name', '$lastInsertedUserId', '$slogan', '$county', '$sub_county', '$ward', '$email',  '$plan', '$hbkf', '$h_looking_for', '$h_profession', '$h_facility_level', '$h_skill', '$h_salary_expectation', '$fileName', '$category', '$cvfileName')";


    }
    if ($conn->query($individualInsertSql) === TRUE) {

        header("Location: index.php");
    } else {
        echo "Error: " . $individualInsertSql . "<br>" . $conn->error;
    }


}
// ...


// Close the database connection
$conn->close();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>Hanna's Connect</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta content="" name="description" />
    <meta content="MyraStudio" name="author" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />

    <!-- App favicon -->
    <link rel="shortcut icon" href="img/new/logo.png">

    <!-- App css -->
    <link href="assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="assets/css/icons.min.css" rel="stylesheet" type="text/css" />
    <link href="mcss/style.css" rel="stylesheet" type="text/css" />
    <link href="mcss/listing.css" rel="stylesheet" type="text/css" />
    <link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">


</head>
<?php include 'mainNavbar.php'; ?>

<body class="body listing-page">

    <div>
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-11">
                    <div class="d-flex align-items-center min-vh-100">
                        <div class="w-100 d-block bg-white box-shadow rounded-24 my-5">
                            <div class="row">

                                <div class="col-lg-12">
                                    <div class="p-3 p-md-5">
                                        <div class="text-center mb-5">
                                            <h2>Add new Listing</h2>
                                        </div>

                                        <!-- progressbar -->
                                        <div class="d-flex w-100 justify-content-center">
                                            <ul id="progressbar" class="p-0">
                                                <li class="loc" id="loc">Location Details</li>
                                                <li id="pro">Professional Details & Availability</li>
                                                <li id="submit">Submit Listing</li>

                                            </ul>
                                        </div>
                                        <form class="user" method="POST" action="" enctype="multipart/form-data">
                                            <!-- location dets part 1 -->
                                            <div class="form-part-1" id="form-part-1">

                                                <!-- choose category -->
                                                <div class="form-group row ">
                                                    <div class="col-sm-4 mb-3 mb-sm-0">
                                                        <label for="name" class="w-100">Name</label>
                                                        <input type="text"
                                                            class="form-control form-control-user input-btn" id="name"
                                                            name="name" placeholder="Name"
                                                            value="<?php echo $_SESSION['user']['name']; ?>">
                                                    </div>
                                                    <div class="col-sm-4">
                                                        <label for="category" class="w-100">Category <small>
                                                                (required)</small></label>
                                                        <select class="form-control form-control-user input-btn rounded"
                                                            id="category" name="category" required>
                                                            <option value="0">Choose category</option>
                                                            <option value="1">individual </option>
                                                            <option value="2">Business (Company)</option>
                                                            <option value="3">Emergency services</option>
                                                            <option value="4">Hire me (CV center)</option>
                                                        </select>
                                                    </div>
                                                    <div class="col-sm-4">
                                                        <label for="slogan" class="w-100"> Slogan <small>
                                                                (required)</small></label>
                                                        <input type="text"
                                                            class="form-control form-control-user input-btn" id="slogan"
                                                            name="slogan" placeholder="Slogan (Profession)">
                                                    </div>


                                                </div>

                                                <!-- location dets -->
                                                <div class="form-group row">
                                                    <div class="col-sm-4 mb-3 mb-sm-0">
                                                        <label for="county">County <small> (required)</small></label>
                                                        <select class="form-control form-control-user input-btn rounded"
                                                            id="county" placeholder="Select County" name="county">
                                                            <option value=""></option>
                                                            <!-- Populate options dynamically using JavaScript -->
                                                        </select>
                                                    </div>
                                                    <div class="col-sm-4">
                                                        <label for="constituency">Constituency <small>
                                                                (required)</small></label>
                                                        <select class="form-control form-control-user input-btn rounded"
                                                            id="constituency" name="sub_county">
                                                            <option value=""></option>
                                                            <!-- Populate options dynamically using JavaScript -->
                                                        </select>
                                                    </div>

                                                    <div class="col-sm-4">
                                                        <label for="ward">Ward <small> (required)</small></label>
                                                        <select class="form-control form-control-user input-btn rounded"
                                                            id="ward" name="ward">
                                                            <option value=""></option>
                                                            <!-- Populate options dynamically using JavaScript -->
                                                        </select>
                                                    </div>

                                                </div>

                                                <!-- email dets -->
                                                <div class="form-group row">
                                                    <div class="col-sm-4 mb-3 mb-sm-0">
                                                        <label for="ward">Email </label>
                                                        <input type="email"
                                                            class="form-control form-control-user input-btn"
                                                            name="email" id="email" placeholder="Email"
                                                            value="<?php echo $_SESSION['user']['email']; ?>" required
                                                            readonly>
                                                    </div>

                                                    <div class="col-sm-4">
                                                        <label for="ward">Phone number </label>

                                                        <input type="text"
                                                            class="form-control form-control-user input-btn"
                                                            name="phone" placeholder="Phone number" required
                                                            value="<?php echo $_SESSION['user']['phone']; ?>" readonly
                                                            required id="phone">
                                                    </div>
                                                    <div class="col-sm-4">
                                                        <label for="ward">Profile image (Logo) <small> (required)</small></label>

                                                        <input type="file"
                                                            class="form-control form-control-user input-btn" name="logo" 
                                                            placeholder="Logo (Profile image)" id="logo">
                                                    </div>
                                                </div>




                                                <div class="row mt-4">
                                                    <div class="col-sm-12 d-flex justify-content-end">
                                                        <div class="brown-btn-filled ml-3  px-5 waves-effect waves-light"
                                                            id="next-btn"> Next <img src="img/new/arrow-in-circle.svg">
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>

                                            <div class="form-part-2">
                                                <!-- individual -->

                                                <div class="form-group row" id="individualFields">

                                                    <div class="col-md-12 col-sm-12 mb-3 mb-sm-0">
                                                        <label for="best_known_for">We are best known for. <span
                                                                id="ibkfcount" style="font-size: 11px;">50</span> words
                                                            required</label>
                                                        <textarea class="form-control form-control-user input-btn"
                                                            name="ibfk" placeholder="Optional" rows="4"
                                                            id="ibkf"></textarea>
                                                    </div>
                                                    <div class="col-md-6 col-sm-12">
                                                        <label for="best_known_for">What is your profession</label>
                                                        <select class="form-control form-control-user input-btn rounded others-input"
                                                            id="profession" name="profession"
                                                            placeholder="Select Profession">
                                                            <option value="Accountant">Accountant</option>
                                                            <option value="Auditor">Auditor</option>
                                                            <option value="Actor/Actress">Actor/Actress</option>
                                                            <option value="Architect">Architect</option>
                                                            <option value="Author">Author</option>
                                                            <option value="Advocate">Advocate</option>
                                                            <option value="Baker">Baker</option>
                                                            <option value="Beauty guru">Beauty guru</option>
                                                            <option value="Bricklayer">Bricklayer</option>
                                                            <option value="Bus driver">Bus driver</option>
                                                            <option value="Business analyst">Business analyst</option>
                                                            <option value="Butcher">Butcher</option>
                                                            <option value="Caregiver">Caregiver</option>
                                                            <option value="Carpenter">Carpenter</option>
                                                            <option value="Cashier">Cashier</option>
                                                            <option value="Chauffeur/Driver">Chauffeur/Driver</option>
                                                            <option value="Chef/Cook">Chef/Cook</option>
                                                            <option value="Child care worker">Child care worker</option>
                                                            <option value="Cleaner/Mama fua">Cleaner/Mama fua</option>
                                                            <option value="Dancer">Dancer</option>
                                                            <option value="Data Analyst">Data Analyst</option>
                                                            <option value="Disk Jockey (Deejay/DJ)">Disk Jockey
                                                                (Deejay/DJ)</option>
                                                            <option value="Dentist">Dentist</option>
                                                            <option value="Designer">Designer</option>
                                                            <option value="Director">Director</option>
                                                            <option value="Doctor">Doctor</option>
                                                            <option value="Dustman/Refuse collector">Dustman/Refuse
                                                                collector</option>
                                                            <option value="Electrician">Electrician</option>
                                                            <option value="Engineer">Engineer</option>
                                                            <option value="Event planner">Event planner</option>
                                                            <option value="Fashion Designer">Fashion Designer</option>
                                                            <option value="Fitness trainer">Fitness trainer</option>
                                                            <option value="Fireman/Fire fighter">Fireman/Fire fighter
                                                            </option>
                                                            <option value="Fisherman">Fisherman</option>
                                                            <option value="Florist">Florist</option>
                                                            <option value="Gardener">Gardener</option>
                                                            <option value="Hairdresser/Hairstylists">
                                                                Hairdresser/Hairstylists</option>
                                                            <option value="Interior Designer">Interior Designer</option>
                                                            <option value="Journalist">Journalist</option>
                                                            <option value="Lawyer">Lawyer</option>
                                                            <option value="Lecturer">Lecturer</option>
                                                            <option value="Librarian">Librarian</option>
                                                            <option value="Lifeguard/Swimming tutor">Lifeguard/Swimming
                                                                tutor</option>
                                                            <option value="Make-up-artist">Make-up-artist</option>
                                                            <option value="Marketer">Marketer</option>
                                                            <option value="Marketing analyst">Marketing analyst</option>
                                                            <option value="Mechanic">Mechanic</option>
                                                            <option value="Master of ceremony (M.C)/Hype man">Master of
                                                                ceremony (M.C)/Hype man</option>
                                                            <option value="Model">Model</option>
                                                            <option value="Midwife">Midwife</option>
                                                            <option value="Nurse">Nurse</option>
                                                            <option value="Optician">Optician</option>
                                                            <option value="Painter">Painter</option>
                                                            <option value="Pharmacist">Pharmacist</option>
                                                            <option value="Photographer">Photographer</option>
                                                            <option value="Plumber">Plumber</option>
                                                            <option value="Project manager">Project manager</option>
                                                            <option value="Public Relations manager">Public Relations
                                                                manager</option>
                                                            <option value="Real estate agent">Real estate agent</option>
                                                            <option value="Receptionist">Receptionist</option>
                                                            <option value="Scientist">Scientist</option>
                                                            <option value="Sailor">Sailor</option>
                                                            <option value="Sales and marketer">Sales and marketer
                                                            </option>
                                                            <option value="Scientist">Scientist</option>
                                                            <option value="Script writer">Script writer</option>
                                                            <option value="Sculptor">Sculptor</option>
                                                            <option value="Seamstress">Seamstress</option>
                                                            <option value="Secretary">Secretary</option>
                                                            <option value="Software Developer">Software Developer
                                                            </option>
                                                            <option value="Shop assistant">Shop assistant</option>
                                                            <option value="Surveyor">Surveyor</option>
                                                            <option value="Tailor">Tailor</option>
                                                            <option value="Taxi driver">Taxi driver</option>
                                                            <option value="Teacher/Tutor">Teacher/Tutor</option>
                                                            <option value="Translator">Translator</option>
                                                            <option value="Travel agent">Travel agent</option>
                                                            <option value="Travel tour guide">Travel tour guide</option>
                                                            <option value="Language translator">Language translator
                                                            </option>
                                                            <option value="Veterinary doctor (Vet)">Veterinary doctor
                                                                (Vet)</option>
                                                            <option value="Videographer">Videographer</option>
                                                            <option value="Video editor">Video editor</option>
                                                            <option value="Waiter/Waitress">Waiter/Waitress</option>
                                                            <option value="Writer">Writer</option>
                                                            <option value="Web Developer">Web Developer</option>
                                                            <option value="Other">Other</option>
                                                        </select>
                                                    </div>
                                                    <div class="col-md-6 col-sm-12 mb-3 mb-sm-0 hide-profession" id="show-other-prof">
                                                        <label for="other_prof">Enter your profession</label>
                                                        <input type="text"
                                                            class="form-control form-control-user input-btn"
                                                            name="other_profession" placeholder="Profession">
                                                    </div>
                                                    <div class="col-md-6 col-sm-12">
                                                        <label for="">Do you have a physical
                                                            address</label>
                                                        <select class="form-control form-control-user input-btn rounded"
                                                            name="i_physical_address">
                                                            <option value="1">Yes</option>
                                                            <option value="2">No</option>
                                                        </select>
                                                    </div>
                                                    <div class="col-md-6 col-sm-12">
                                                        <label for="office_location">Location</label>
                                                        <input type="text"
                                                            class="form-control form-control-user input-btn"
                                                            name="i_location_pin" placeholder="Location (pin)" id="i_location_pin">
                                                    </div>
                                                    <div class="col-md-6 col-sm-12 mb-3 mb-sm-0">
                                                        <label for="best_known_for">Website (optional)</label>
                                                        <input type="text"
                                                            class="form-control form-control-user input-btn"
                                                            name="i_website" placeholder="website">
                                                    </div>
                                                    <div class="col-md-6 col-sm-12 mb-3 mb-sm-0">
                                                        <label for="social_media">Social media links (Optional)</label>
                                                        <input type="text"
                                                            class="form-control form-control-user input-btn"
                                                            name="i_social_links" placeholder="social">
                                                    </div>


                                                    <div class="col-sm-12 mb-3 mb-sm-0">
                                                        <label for="working_hours">Working hours</label>
                                                        <div class="time-range">
                                                            <div class="form-group">
                                                                <label for="days_select">Select Days</label>
                                                                <select id="days_select" class="form-control"
                                                                    multiple="multiple" name="i_working_days">
                                                                    <option value="Monday">Monday</option>
                                                                    <option value="Tuesday">Tuesday</option>
                                                                    <option value="Wednesday">Wednesday</option>
                                                                    <option value="Thursday">Thursday</option>
                                                                    <option value="Friday">Friday</option>
                                                                    <option value="Saturday">Saturday</option>
                                                                    <option value="Sunday">Sunday</option>
                                                                </select>
                                                            </div>
                                                            <div class="row mt-3">
                                                                <div class="col-md-6">
                                                                    <div class="form-group">
                                                                        <label for="start_time">Start Time</label>
                                                                        <input type="time" class="form-control"
                                                                            id="start_time" name="i_start_time">
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <div class="form-group">
                                                                        <label for="end_time">End Time</label>
                                                                        <input type="time" class="form-control"
                                                                            id="end_time" name="i_end_time">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-6 col-sm-12 mb-3 mb-sm-0">
                                                        <label for="price_type">My cheapest price</label>
                                                        <input type="number"
                                                            class="form-control form-control-user input-btn"
                                                            name="i_price" placeholder="Price" value="0">
                                                    </div>
                                                    <div class="col-md-6 col-sm-12 mb-3 mb-sm-0">
                                                        <label for="price_type">Price is fixed or Negotiable</label>
                                                        <select class="form-control form-control-user input-btn rounded"
                                                            name="i_price_negotiable">
                                                            <option value="N">My Prices are fixed</option>
                                                            <option value="Y">My fixed are negotiable
</option>
                                                        </select>
                                                    </div>

                                                    <div class="col-sm-3 mb-3 mb-sm-0">
                                                        <label for="ward">What id your first keyword term? </label>
                                                        <input type="text"
                                                            class="form-control form-control-user input-btn" name="key1"
                                                            id="key1" placeholder="">
                                                    </div>

                                                    <div class="col-sm-3">
                                                        <label for="ward">What id your second keyword term?</label>

                                                        <input type="text"
                                                            class="form-control form-control-user input-btn" name="key2"
                                                            placeholder="" id="key2">
                                                    </div>
                                                    <div class="col-sm-3">
                                                        <label for="ward">What id your third keyword term? </label>

                                                        <input type="text"
                                                            class="form-control form-control-user input-btn" name="key3"
                                                            placeholder="" id="key3">
                                                    </div>

                                                    <div class="col-sm-3">
                                                        <label for="ward">What id your fourth keyword term? </label>

                                                        <input type="text"
                                                            class="form-control form-control-user input-btn" name="key4"
                                                            placeholder="" id="key4">
                                                    </div>


                                                    <div class="col-sm-3 mb-3 mb-sm-0">
                                                        <label for="ward">What id your fifth keyword term? </label>
                                                        <input type="text"
                                                            class="form-control form-control-user input-btn" name="key5"
                                                            id="key5" placeholder="" id="key5">
                                                    </div>

                                                    <div class="col-sm-3">
                                                        <label for="ward">What id your sixth keyword term? </label>

                                                        <input type="text"
                                                            class="form-control form-control-user input-btn" name="key6"
                                                            placeholder="" id="key6">
                                                    </div>
                                                    <div class="col-sm-3">
                                                        <label for="ward">What id your seventh keyword term? </label>


                                                        <input type="text"
                                                            class="form-control form-control-user input-btn" name="key7"
                                                            placeholder="" id="key7">
                                                    </div>

                                                    <div class="col-sm-3">
                                                        <label for="ward">What id your eighth keyword term? </label>

                                                        <input type="text"
                                                            class="form-control form-control-user input-btn" name="key8"
                                                            placeholder="" id="key8">
                                                    </div>

                                                    <div class="col-sm-3">
                                                        <label for="ward">What id your nineth keyword term? </label>

                                                        <input type="text"
                                                            class="form-control form-control-user input-btn" name="key9"
                                                            placeholder="" id="key9">
                                                    </div>
                                                    <div class="col-sm-3">
                                                        <label for="ward">What id your tenth keyword term? </label>

                                                        <input type="text"
                                                            class="form-control form-control-user input-btn"
                                                            name="key10" placeholder="" id="key10">
                                                    </div>

                                                    <div class="row mt-4 w-100">
                                                        <div class="col-sm-12 d-flex justify-content-end">
                                                            <div class="brown-btn-pill  px-5 waves-effect waves-light me-3"
                                                                id="back-btn"> Back </div>

                                                            <div class="brown-btn-filled ml-3  px-5 waves-effect waves-light"
                                                                id="go-to-submission-btn"> Next <img
                                                                    src="img/new/arrow-in-circle.svg"></div>

                                                        </div>
                                                    </div>
                                                </div>

                                                <!-- Business -->
                                                <div class="form-group row" id="businessFields">
                                                    <div class="col-md-12 col-sm-12 mb-3 mb-sm-0">
                                                        <label for="best_known_for">We are best known for. <span
                                                                id="bbkfcount" style="font-size: 11px;">50</span> words
                                                            required</label>
                                                        <textarea class="form-control form-control-user input-btn"
                                                            name="bbfk" placeholder="Optional" rows="4"
                                                            id="bbkf"></textarea>
                                                    </div>

                                                    <div class="col-md-6 col-sm-12 mb-3 mb-sm-0">
                                                        <label for="best_known_for">Location</label>
                                                        <input type="text"
                                                            class="form-control form-control-user input-btn"
                                                            name="b_location_pin" placeholder="Location" id="b_location_pin">
                                                    </div>
                                                    <div class="col-md-6 col-sm-12 mb-3 mb-sm-0">
                                                        <label for="best_known_for">Website (optional)</label>
                                                        <input type="text"
                                                            class="form-control form-control-user input-btn"
                                                            name="b_website" placeholder="website url">
                                                    </div>
                                                    <div class="col-md-6 col-sm-12 mb-3 mb-sm-0">
                                                        <label for="social_media">Social media links</label>
                                                        <input type="text"
                                                            class="form-control form-control-user input-btn"
                                                            name="b_social_media" placeholder="Optional">
                                                    </div>
                                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                                        <label for="biz-category">Business or Company category</label>
                                                        <select class="form-control form-control-user input-btn rounded others-input"
                                                            name="biz-category">
                                                            <option value="">Select business type</option>
                                                            <option value="Accommodation and Hospitality">Accommodation
                                                                and Hospitality</option>
                                                            <option value="Advertising and Marketing Firms">Advertising
                                                                and Marketing Firms/Agencies
                                                            </option>
                                                            <option value="">Aerospace</option>
                                                            <option value="Agriculture">Agriculture</option>
                                                            <option value="Arts">Arts, Culture, Entertainment and Design
                                                            </option>
                                                            <option value="Computer and Technology">Computer and
                                                                Technology</option>
                                                            <option value="Construction">Construction</option>
                                                            <option value="Education and Training">Education and
                                                                Training</option>
                                                            <option value="Fashion">Fashion</option>
                                                            <option value="Financial">Financial</option>
                                                            <option value="Insurance">Insurance</option>
                                                            <option value="Fitness and Sports">Fitness and Sports
                                                            </option>
                                                            <option value="Healthcare and Social Assistance">Healthcare
                                                                and Social Assistance</option>
                                                            <option value="Mining">Mining</option>
                                                            <option value="Hairdressing and Beauty Services">
                                                                Hairdressing and Beauty Services</option>
                                                            <option value="Retail Trade">Retail Trade</option>
                                                            <option value="Security">Security</option>
                                                            <option value="Wholesale trade">Wholesale trade</option>
                                                            <option value="Manufacturing">Manufacturing</option>
                                                            <option value="Media and News">Media and News</option>
                                                            <option value="Pharmaceutical">Pharmaceutical</option>
                                                            <option value="Telecommunication">Telecommunication</option>
                                                            <option value="Transportation">Transportation</option>
                                                            <option value="Other">Other</option>
                                                        </select>
                                                    </div>
                                                    <div class="col-md-6 col-sm-12 mb-3 mb-sm-0 hide-profession" id="show-other-prof">
                                                        <label for="other_prof">Enter your profession</label>
                                                        <input type="text"
                                                            class="form-control form-control-user input-btn"
                                                            name="other_profession" placeholder="Profession">
                                                    </div>

                                                    <h5 class="mt-4">
                                                        Define your working hours
                                                    </h5>
                                                    <div class="col-sm-12 mb-3 mb-sm-0">
                                                        <label for="working_hours">Working hours</label>
                                                        <div class="time-range">
                                                            <div class="form-group">
                                                                <label for="days_select">Select Days</label>
                                                                <select id="days_selectb" class="form-control"
                                                                    multiple="multiple" name="b_working_day">
                                                                    <option value="Monday">Monday</option>
                                                                    <option value="Tuesday">Tuesday</option>
                                                                    <option value="Wednesday">Wednesday</option>
                                                                    <option value="Thursday">Thursday</option>
                                                                    <option value="Friday">Friday</option>
                                                                    <option value="Saturday">Saturday</option>
                                                                    <option value="Sunday">Sunday</option>
                                                                </select>
                                                            </div>
                                                            <div class="row mt-3">
                                                                <div class="col-md-6">
                                                                    <div class="form-group">
                                                                        <label for="start_time">Start Time</label>
                                                                        <input type="time" class="form-control"
                                                                            id="start_timeb" name="b_start_time"
                                                                            disabled>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <div class="form-group">
                                                                        <label for="end_time">End Time</label>
                                                                        <input type="time" class="form-control"
                                                                            id="end_timeb" name="b_end_time" disabled>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 col-sm-12 mb-3 mb-sm-0">
                                                        <label for="price_type">Our cheapest price</label>
                                                        <input type="number"
                                                            class="form-control form-control-user input-btn"
                                                            name="b_price" placeholder="Price" value="0">
                                                    </div>


                                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                                        <label for="price_type">Price is fixed or Negotiable</label>
                                                        <select class="form-control form-control-user input-btn rounded"
                                                            name="b_price_negotiable">
                                                            
                                                            <option value="N">Our Prices are fixed</option>
                                                            <option value="Y">Our fixed are negotiable
</option>
                                                        </select>
                                                    </div>


                                                    <label for="customer_message">What would you like to tell your
                                                        potential
                                                        customers regarding your business</label>
                                                    <textarea class="form-control form-control-user input-btn"
                                                        name="b_message" id="b_message"></textarea>

                                                    <label for="branches_countries">Do you have branches in other
                                                        Countries</label>
                                                    <textarea class="form-control form-control-user input-btn"
                                                        id="branches_countries" name="b_branches"
                                                        placeholder="Optional"></textarea>
                                                    <div class="col-sm-3 mb-3 mb-sm-0">
                                                        <label for="ward">What id your first keyword term? </label>

                                                        <input type="text"
                                                            class="form-control form-control-user input-btn"
                                                            name="bkey1" id="bkey1" placeholder="">
                                                    </div>
                                                    <div class="col-sm-3 mb-3 mb-sm-0">
                                                        <label for="ward">What id your second keyword term? </label>
                                                        <input type="text"
                                                            class="form-control form-control-user input-btn"
                                                            name="bkey2" id="bkey2" placeholder="">
                                                    </div>
                                                    <div class="col-sm-3 mb-3 mb-sm-0">
                                                        <label for="ward">What id your third keyword term? </label>

                                                        <input type="text"
                                                            class="form-control form-control-user input-btn"
                                                            name="bkey3" id="bkey3" placeholder="">
                                                    </div>
                                                    <div class="col-sm-3 mb-3 mb-sm-0">
                                                        <label for="ward">What id your fourth keyword term? </label>
                                                        <input type="text"
                                                            class="form-control form-control-user input-btn" name="key4"
                                                            id="bkey4" placeholder="">
                                                    </div>
                                                    <div class="col-sm-3 mb-3 mb-sm-0">
                                                        <label for="ward">What id your fifth keyword term? </label>
                                                        <input type="text"
                                                            class="form-control form-control-user input-btn"
                                                            name="bkey5" id="bkey5" placeholder="">
                                                    </div>
                                                    <div class="col-sm-3 mb-3 mb-sm-0">
                                                        <label for="ward">What id your sixth keyword term? </label>
                                                        <input type="text"
                                                            class="form-control form-control-user input-btn"
                                                            name="bkey6" id="bkey6" placeholder="">
                                                    </div>
                                                    <div class="col-sm-3 mb-3 mb-sm-0">
                                                        <label for="ward">What id your seventh keyword term? </label>
                                                        <input type="text"
                                                            class="form-control form-control-user input-btn"
                                                            name="bkey7" id="bkey7" placeholder="">
                                                    </div>
                                                    <div class="col-sm-3 mb-3 mb-sm-0">
                                                        <label for="ward">What id your eighth keyword term? </label>
                                                        <input type="text"
                                                            class="form-control form-control-user input-btn"
                                                            name="bkey8" id="bkey8" placeholder="">
                                                    </div>

                                                    <div class="col-sm-3 mb-3 mb-sm-0">
                                                        <label for="ward">What id your ninetht keyword term? </label>
                                                        <input type="text"
                                                            class="form-control form-control-user input-btn"
                                                            name="bkey9" id="bkey9" placeholder="">
                                                    </div>
                                                    <div class="col-sm-3 mb-3 mb-sm-0">
                                                        <label for="ward">What id your tenth keyword term? </label>
                                                        <input type="text"
                                                            class="form-control form-control-user input-btn"
                                                            name="bkey10" id="bkey10" placeholder="">
                                                    </div>
                                                    
                                                    <div class="row mt-4 w-100">
                                                        <div class="col-sm-12 d-flex justify-content-end">
                                                            <div class="brown-btn-pill  px-5 waves-effect waves-light me-3"
                                                                id="back-btn"> Back </div>

                                                            <div class="brown-btn-filled ml-3  px-5 waves-effect waves-light"
                                                                id="go-to-submission-btn"> Next <img
                                                                    src="img/new/arrow-in-circle.svg"></div>

                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- Emergency -->

                                                <div class="form-group row" id="emergencyFields">


                                                    <div class="col-sm-12 mb-3 mb-sm-0">
                                                        <label for="price_type">Service </label>
                                                        <select class="form-control form-control-user input-btn rounded"
                                                            name="e_service" id="e_service">
                                                            <option value="">Select service</option>
                                                            <option value="Ambulance">Ambulance</option>
                                                            <option value="Fire brigade">Fire brigade</option>
                                                            <option value="Breakdown/Flatbed">Breakdown/Flatbed</option>
                                                            <option value="Flying doctors">Flying doctors</option>
                                                            <option value="Police">Police</option>
                                                        </select>
                                                    </div>
                                                    <div class="col-sm-12 mb-3 mb-sm-0">
                                                        <label for="social_media">Our cheapest price</label>
                                                        <input type="number"
                                                            class="form-control form-control-user input-btn"
                                                            name="e_price" placeholder="Optional" value="0">

                                                    </div>
                                                    <div class="col-sm-12 mb-3 mb-sm-0">
                                                        <label for="price_type">Negotiable or Fixed</label>
                                                        <select class="form-control form-control-user input-btn rounded"
                                                            name="e_price_negotiable">
                                                            <option value="N">Our Prices are fixed</option>
                                                            <option value="Y">Our fixed are negotiable
</option>
                                                        </select>
                                                    </div>
                                                    <div class="row mt-4 w-100">
                                                        <div class="col-sm-12 d-flex justify-content-end">
                                                            <div class="brown-btn-pill  px-5 waves-effect waves-light me-3"
                                                                id="back-btn"> Back </div>

                                                            <div class="brown-btn-filled ml-3  px-5 waves-effect waves-light"
                                                                id="go-to-submission-btn"> Next <img
                                                                    src="img/new/arrow-in-circle.svg"></div>

                                                        </div>
                                                    </div>
                                                </div>

                                                <!-- Hire me field  -->
                                                <div class="form-group row" id="hireMeFields">
                                                    <div class="col-md-12 col-sm-12 mb-3 mb-sm-0">
                                                        <label for="best_known_for">We are best known for. <span
                                                                id="hbkfcount" style="font-size: 11px;">50</span> words
                                                            required</label>
                                                        <textarea class="form-control form-control-user input-btn"
                                                            name="hbfk" placeholder="Optional" rows="4"
                                                            id="hbkf"></textarea>
                                                    </div>
                                                    <div class="col-md-6 col-sm-12">
                                                        <label for="best_known_for">I’m looking for</label>
                                                        <select class="form-control form-control-user input-btn rounded"
                                                            name="h_looking_for">
                                                            <option value="Employment">Employment </option>
                                                            <option value="Attachment">Attachment </option>
                                                            <option value="Internship">Internship </option>
                                                            <option value="Volunteer">Volunteer </option>
                                                        </select>
                                                    </div>
                                                    <div class="col-md-6 col-sm-12">
                                                        <label for="best_known_for">Profession</label>
                                                        <select class="form-control form-control-user input-btn rounded others-input"
                                                            name="h_profession">
                                                            <option value="Accountant">Accountant</option>
                                                            <option value="Auditor">Auditor</option>
                                                            <option value="Actor/Actress">Actor/Actress</option>
                                                            <option value="Architect">Architect</option>
                                                            <option value="Author">Author</option>
                                                            <option value="Advocate">Advocate</option>
                                                            <option value="Baker">Baker</option>
                                                            <option value="Beauty guru">Beauty guru</option>
                                                            <option value="Bricklayer">Bricklayer</option>
                                                            <option value="Bus driver">Bus driver</option>
                                                            <option value="Business analyst">Business analyst</option>
                                                            <option value="Butcher">Butcher</option>
                                                            <option value="Caregiver">Caregiver</option>
                                                            <option value="Carpenter">Carpenter</option>
                                                            <option value="Cashier">Cashier</option>
                                                            <option value="Chauffeur/Driver">Chauffeur/Driver</option>
                                                            <option value="Chef/Cook">Chef/Cook</option>
                                                            <option value="Child care worker">Child care worker</option>
                                                            <option value="Cleaner/Mama fua">Cleaner/Mama fua</option>
                                                            <option value="Dancer">Dancer</option>
                                                            <option value="Data Analyst">Data Analyst</option>
                                                            <option value="Disk Jockey (Deejay/DJ)">Disk Jockey
                                                                (Deejay/DJ)</option>
                                                            <option value="Dentist">Dentist</option>
                                                            <option value="Designer">Designer</option>
                                                            <option value="Director">Director</option>
                                                            <option value="Doctor">Doctor</option>
                                                            <option value="Dustman/Refuse collector">Dustman/Refuse
                                                                collector</option>
                                                            <option value="Electrician">Electrician</option>
                                                            <option value="Engineer">Engineer</option>
                                                            <option value="Event planner">Event planner</option>
                                                            <option value="Fashion Designer">Fashion Designer</option>
                                                            <option value="Fitness trainer">Fitness trainer</option>
                                                            <option value="Fireman/Fire fighter">Fireman/Fire fighter
                                                            </option>
                                                            <option value="Fisherman">Fisherman</option>
                                                            <option value="Florist">Florist</option>
                                                            <option value="Gardener">Gardener</option>
                                                            <option value="Hairdresser/Hairstylists">
                                                                Hairdresser/Hairstylists</option>
                                                            <option value="Interior Designer">Interior Designer</option>
                                                            <option value="Journalist">Journalist</option>
                                                            <option value="Lawyer">Lawyer</option>
                                                            <option value="Lecturer">Lecturer</option>
                                                            <option value="Librarian">Librarian</option>
                                                            <option value="Lifeguard/Swimming tutor">Lifeguard/Swimming
                                                                tutor</option>
                                                            <option value="Make-up-artist">Make-up-artist</option>
                                                            <option value="Marketer">Marketer</option>
                                                            <option value="Marketing analyst">Marketing analyst</option>
                                                            <option value="Mechanic">Mechanic</option>
                                                            <option value="Master of ceremony (M.C)/Hype man">Master of
                                                                ceremony (M.C)/Hype man</option>
                                                            <option value="Model">Model</option>
                                                            <option value="Midwife">Midwife</option>
                                                            <option value="Nurse">Nurse</option>
                                                            <option value="Optician">Optician</option>
                                                            <option value="Painter">Painter</option>
                                                            <option value="Pharmacist">Pharmacist</option>
                                                            <option value="Photographer">Photographer</option>
                                                            <option value="Plumber">Plumber</option>
                                                            <option value="Project manager">Project manager</option>
                                                            <option value="Public Relations manager">Public Relations
                                                                manager</option>
                                                            <option value="Real estate agent">Real estate agent</option>
                                                            <option value="Receptionist">Receptionist</option>
                                                            <option value="Scientist">Scientist</option>
                                                            <option value="Sailor">Sailor</option>
                                                            <option value="Sales and marketer">Sales and marketer
                                                            </option>
                                                            <option value="Scientist">Scientist</option>
                                                            <option value="Script writer">Script writer</option>
                                                            <option value="Sculptor">Sculptor</option>
                                                            <option value="Seamstress">Seamstress</option>
                                                            <option value="Secretary">Secretary</option>
                                                            <option value="Software Developer">Software Developer
                                                            </option>
                                                            <option value="Shop assistant">Shop assistant</option>
                                                            <option value="Surveyor">Surveyor</option>
                                                            <option value="Tailor">Tailor</option>
                                                            <option value="Taxi driver">Taxi driver</option>
                                                            <option value="Teacher/Tutor">Teacher/Tutor</option>
                                                            <option value="Translator">Translator</option>
                                                            <option value="Travel agent">Travel agent</option>
                                                            <option value="Travel tour guide">Travel tour guide</option>
                                                            <option value="Language translator">Language translator
                                                            </option>
                                                            <option value="Veterinary doctor (Vet)">Veterinary doctor
                                                                (Vet)</option>
                                                            <option value="Videographer">Videographer</option>
                                                            <option value="Video editor">Video editor</option>
                                                            <option value="Waiter/Waitress">Waiter/Waitress</option>
                                                            <option value="Writer">Writer</option>
                                                            <option value="Web Developer">Web Developer</option>
                                                            <option value="Other">Other</option>
                                                        </select>
                                                    </div>
                                                    <div class="col-md-6 col-sm-12 mb-3 mb-sm-0 hide-profession" id="show-other-prof">
                                                        <label for="other_prof">Enter your profession</label>
                                                        <input type="text"
                                                            class="form-control form-control-user input-btn"
                                                            name="other_profession" placeholder="Profession">
                                                    </div>
                                                    <div class="col-md-6 col-sm-12 mb-3 mb-sm-0">
                                                        <label for="best_known_for">Experience (required)</label>
                                                        <input type="text"
                                                            class="form-control form-control-user input-btn"
                                                            name="h_experience" placeholder="Experience" id="h_experience">
                                                    </div>

                                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                                        <label for="best_known_for">Education facility and level
                                                            (required)</label>
                                                        <input type="text"
                                                            class="form-control form-control-user input-btn"
                                                            name="h_facility_level" id="h_facility_level" placeholder="School/College name">
                                                    </div>

                                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                                        <label for="best_known_for">What can you do?</label>
                                                        <input type="text"
                                                            class="form-control form-control-user input-btn"
                                                            name="h_skill" id="h_skill" placeholder="What are your skills">
                                                    </div>


                                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                                        <label for="best_known_for">Preferred salary in (KES)</label>
                                                        <input type="number"
                                                            class="form-control form-control-user input-btn"
                                                            name="h_salary_expectation" placeholder="Optional"
                                                            value="0">
                                                    </div>

                                                    <div class="col-md-12 col-sm-12 mb-3 mb-sm-0">
                                                        <label for="best_known_for">Upload resume (CV)</label>
                                                        <input type="file"
                                                            class="form-control form-control-user input-btn"
                                                            name="cv_file" placeholder="Your cv" id="cv_file">
                                                    </div>
                                                    <div class="row mt-4 w-100">
                                                        <div class="col-sm-12 d-flex justify-content-end">
                                                            <div class="brown-btn-pill  px-5 waves-effect waves-light me-3"
                                                                id="back-btn"> Back </div>

                                                            <div class="brown-btn-filled ml-3  px-5 "
                                                                id="go-to-submission-btn"> Next <img
                                                                    src="img/new/arrow-in-circle.svg"></div>

                                                        </div>
                                                    </div>

                                                </div>

                                                <div class="error-section" id="error-section">
                                                    <p class="text-center">
                                                        Kindly fill in the required fields
                                                    </p>
                                                    <div class="row mt-4 w-100">
                                                        <div class="col-sm-12 d-flex justify-content-end">
                                                            <div class="brown-btn-pill  px-5 waves-effect waves-light "
                                                                id="back-btn"> Back </div>
                                                        </div>
                                                    </div>

                                                </div>

                                            </div>

                                            <div class="form-part-3" id="submission-dets">
                                                <!-- confirmation part -->
                                                <h2 class="text-center">
                                                    Yay! You have finished entering your details
                                                </h2>
                                                <p class="text-center">
                                                    You can now submit your details. Thank you for choosing
                                                    Hanna's connect
                                                </p>
                                                <div class="form-group text-center">
                                                    <input type="checkbox" class="form-check-input" id="terms"
                                                        name="terms" required>
                                                    <label for="terms">I agree to the <a href="uploads/t-c.pdf"
                                                            target="_blank">Terms and Conditions</a></label>
                                                    &nbsp;&nbsp;&nbsp;&nbsp;


                                                </div>
                                                <div class="d-flex justify-content-end">
                                                    <div class="brown-btn-pill  px-5 waves-effect waves-light "
                                                        id="back-btn"> Back </div>

                                                    <input type="submit"
                                                        class="brown-btn-filled ml-3  px-5 waves-effect waves-light"
                                                        name="send" value="Submit Listing" id="finish">
                                                </div>
                                            </div>

                                        </form>


                                        <!-- end row -->
                                    </div> <!-- end .padding-5 -->
                                </div> <!-- end col -->
                            </div> <!-- end row -->
                        </div> <!-- end .w-100 -->
                    </div> <!-- end .d-flex -->
                </div> <!-- end col-->
            </div> <!-- end row -->
        </div>
        <!-- end container -->
    </div>
    <!-- end page -->

    <!-- jQuery  -->
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/js/bootstrap.bundle.min.js"></script>
    <script src="assets/js/metismenu.min.js"></script>
    <script src="assets/js/waves.js"></script>
    <script src="assets/js/simplebar.min.js"></script>

    <!-- App js -->
    <script src="assets/js/theme.js"></script>

    <script>

        //part 1 of form 
        var formPart1 = document.querySelector('#form-part-1');
        var nextBtn = document.querySelector('#next-btn');
        var backBtn = document.querySelectorAll('#back-btn');
        var finalBtn = document.querySelectorAll('#go-to-submission-btn');
        var errorSection = document.querySelector('#error-section');
        var submissionSection = document.querySelector('#submission-dets');
        var progressbar = document.querySelector('#progressbar');

        // Get references to the select elements
        var categorySelect = document.getElementById('category');
        var businessFields = document.getElementById('businessFields');
        var emergencyFields = document.getElementById('emergencyFields');
        var hireMeFields = document.getElementById('hireMeFields');
        var individualFields = document.getElementById('individualFields');

        var profession = document.getElementById('profession');
        var otherProfession = document.getElementById('show-other-prof');

        var professions = document.querySelectorAll('.others-input');
        var showOtherProfessions = document.querySelectorAll('.hide-profession')
        

        // get required input fields
        var sloganCheck = document.querySelector("#slogan");
        var countyCheck = document.querySelector("#county");
        var constituencyCheck = document.querySelector("#sub_county");
        var wardCheck = document.querySelector("#ward");
        selectedCategory = categorySelect.value;
        
        businessFields.style.display = 'none';
        emergencyFields.style.display = 'none';
        hireMeFields.style.display = 'none';
        individualFields.style.display = 'none';
        errorSection.style.display = 'none';
        submissionSection.style.display = 'none';


        professions.forEach(item =>{
            item.addEventListener('change', function(){
                if(item.value == "Other"){

                    showOtherProfessions.forEach(work =>{
                        work.style.display = 'block'
                    })
                }
            else{
                showOtherProfessions.forEach(work =>{
                    work.style.display = 'none'
                })
            }

            })
        })


        // profession.addEventListener('change', function(){
        //     if(profession.value=="Other"){
        //         otherProfession.style.display = 'block';
        //     }
        //     else{
        //         otherProfession.style.display = 'none';
        //     }
        // })
        // on clicking next btn, go to various category
        nextBtn.addEventListener('click', function () {
            selectedCategory = categorySelect.value;
            if (selectedCategory==="1"){
                $("#ibkfcount").text(30)
            }
            if (areFieldsEmpty()) {
                alert("Kindly fill all required fields")
                return; 
            } 

            formPart1.style.display = "none";
            businessFields.style.display = 'none';
            emergencyFields.style.display = 'none';
            hireMeFields.style.display = 'none';
            individualFields.style.display = 'none';
            errorSection.style.display = 'none';
            submissionSection.style.display = 'none';

            progressbar.style.display = "flex";


            // Show dynamic fields based on selected category
            if (selectedCategory === '1') {
                individualFields.style.display = 'flex';

            } else if (selectedCategory === '2') {
                businessFields.style.display = 'flex';

            } else if (selectedCategory === '3') {
                emergencyFields.style.display = 'flex';

            } else if (selectedCategory === '4') {
                hireMeFields.style.display = 'flex';
            }
            else {
                errorSection.style.display = 'block';
                progressbar.style.display = "none";

            }


        });

        //on clicking back, go to form part 1
        backBtn.forEach(item => {
            item.addEventListener('click', function () {
                businessFields.style.display = 'none';
                emergencyFields.style.display = 'none';
                hireMeFields.style.display = 'none';
                individualFields.style.display = 'none';
                errorSection.style.display = 'none';
                formPart1.style.display = 'block';
                progressbar.style.display = "flex";

                submissionSection.style.display = 'none';

            })
        })

        finalBtn.forEach(item => {
            item.addEventListener('click', function () {
                if (selectedCategory === '1') {
                    if (areIndividualFieldsEmpty()) {
                    alert("Kindly fill all required fields")
                    return; 
                    }
                }

                if (selectedCategory === '2') {
                    if (areBusinessFieldsEmpty()) {
                    alert("Kindly fill all required fields")
                    return; 
                    }
                }

                if (selectedCategory === '3') {
                    if (areEmergencyFieldsEmpty()) {
                    alert("Kindly fill all required fields")
                    return; 
                    }
                }
                if (selectedCategory === '4') {
                    if (areHiremeFieldsEmpty()) {
                    alert("Kindly fill all required fields")
                    return; 
                    }
                }

                businessFields.style.display = 'none';
                emergencyFields.style.display = 'none';
                hireMeFields.style.display = 'none';
                individualFields.style.display = 'none';
                errorSection.style.display = 'none';
                submissionSection.style.display = 'block';
            })
        })

function areFieldsEmpty() {
    var isEmpty = false;

    var logoInput = document.querySelector("#logo"); // Replace with the correct ID for your logo input field
    var emailInput = document.querySelector("#email");
    var nameInput = document.querySelector("#name");
    var categorySelect = document.querySelector("#category");
    var phoneInput = document.querySelector("#phone");
    var sloganInput = document.querySelector("#slogan");


    if (logoInput.value.trim() === "") {
        isEmpty = true;
    }
    if (phoneInput.value.trim() === "") {
        isEmpty = true;
    }
    if (sloganInput.value.trim() === "") {
        isEmpty = true;
    }

    if (emailInput.value.trim() === "") {
        isEmpty = true;
    }

    if (nameInput.value.trim() === "") {
        isEmpty = true;
    }

    if (categorySelect.value === '0') {
        isEmpty = true;
    }


    return isEmpty;
}

function areIndividualFieldsEmpty() {
    var isEmpty = false;

    var ibfk = document.querySelector("#ibkf"); 
    var i_location_pin = document.querySelector("#i_location_pin"); 
    var start_time = document.querySelector("#start_time"); 
    var end_time = document.querySelector("#end_time"); 
    var key1 = document.querySelector("#key1"); 
    var key2 = document.querySelector("#key2"); 
    var key3 = document.querySelector("#key3"); 
    var key4 = document.querySelector("#key4"); 
    var key5 = document.querySelector("#key5"); 
    var key6 = document.querySelector("#key6"); 
    var key7 = document.querySelector("#key7"); 
    var key8 = document.querySelector("#key8"); 
    var key9 = document.querySelector("#key9"); 
    var key10 = document.querySelector("#key10"); 
    

    if (ibfk.value.trim() === "") {
        isEmpty = true;
    }
    if (selectedCategory==="1" && ibfk.value.length>30){
        alert("Individual accounts are limited to 30 words")
        isEmpty=true
    }
    if (i_location_pin.value.trim() === "") {
        isEmpty = true;
    }
    if (!$("#days_selectb").val()) {
        alert("Please provide the working days")
        isEmpty = true;
    }
    if (end_time.value.trim() === "") {
        isEmpty = true;
    }
    if (start_time.value.trim() === "") {
        isEmpty = true;
    }
    if (key1.value.trim() === "") {
        isEmpty = true;
    }
    if (key2.value.trim() === "") {
        isEmpty = true;
    }
    if (key3.value.trim() === "") {
        isEmpty = true;
    }
    if (key4.value.trim() === "") {
        isEmpty = true;
    }
    if (key5.value.trim() === "") {
        isEmpty = true;
    }
    if (key6.value.trim() === "") {
        isEmpty = true;
    }
    if (key7.value.trim() === "") {
        isEmpty = true;
    }
    if (key8.value.trim() === "") {
        isEmpty = true;
    }
    if (key9.value.trim() === "") {
        isEmpty = true;
    }
    if (key10.value.trim() === "") {
        isEmpty = true;
    }


    return isEmpty;
}

function areBusinessFieldsEmpty() {
    var isEmpty = false;

    var bbfk = document.querySelector("#bbkf"); 
    var b_location_pin = document.querySelector("#b_location_pin"); 
    var b_start_time = document.querySelector("#start_timeb"); 
    var b_end_time = document.querySelector("#end_timeb"); 
    var bkey1 = document.querySelector("#bkey1"); 
    var bkey2 = document.querySelector("#bkey2"); 
    var bkey3 = document.querySelector("#bkey3"); 
    var bkey4 = document.querySelector("#bkey4"); 
    var bkey5 = document.querySelector("#bkey5"); 
    var bkey6 = document.querySelector("#bkey6"); 
    var bkey7 = document.querySelector("#bkey7"); 
    var bkey8 = document.querySelector("#bkey8"); 
    var bkey9 = document.querySelector("#bkey9"); 
    var bkey10 = document.querySelector("#bkey10"); 
    var b_message = document.querySelector("#b_message"); 
    var b_branches = document.querySelector("#branches_countries"); 
    

    if (bbfk.value.trim() === "") {
        isEmpty = true;
    }
    if (b_location_pin.value.trim() === "") {
        isEmpty = true;
    }
    if (b_end_time.value.trim() === "") {
        isEmpty = true;
    }
    if (b_start_time.value.trim() === "") {
        isEmpty = true;
    }
    if (bkey1.value.trim() === "") {
        isEmpty = true;
    }
    if (bkey2.value.trim() === "") {
        isEmpty = true;
    }
    if (bkey3.value.trim() === "") {
        isEmpty = true;
    }
    if (bkey4.value.trim() === "") {
        isEmpty = true;
    }
    if (bkey5.value.trim() === "") {
        isEmpty = true;
    }
    if (bkey6.value.trim() === "") {
        isEmpty = true;
    }
    if (bkey7.value.trim() === "") {
        isEmpty = true;
    }
    if (bkey8.value.trim() === "") {
        isEmpty = true;
    }
    if (bkey9.value.trim() === "") {
        isEmpty = true;
    }
    if (bkey10.value.trim() === "") {
        isEmpty = true;
    }
    if (b_message.value.trim() === "") {
        isEmpty = true;
    }
    if (b_branches.value.trim() === "") {
        isEmpty = true;
    }

    return isEmpty;
}



function areEmergencyFieldsEmpty() {
    var isEmpty = false;

    var e_service = document.querySelector("#e_service"); 
    

    if (e_service.value.trim() === "") {
        isEmpty = true;
    }
    

    return isEmpty;
}
function areHiremeFieldsEmpty() {
    var isEmpty = false;

    var hbkf = document.querySelector("#hbkf");
    var cv_file = document.querySelector("#cv_file"); 
    var h_experience = document.querySelector("#h_experience"); 
    var h_facility_level = document.querySelector("#h_facility_level"); 
    var h_skill = document.querySelector("#h_skill"); 

    

    if (hbkf.value.trim() === "") {
        isEmpty = true;
    }

    if (cv_file.value.trim() === "") {
        isEmpty = true;
    }
    
    if (h_experience.value.trim() === "") {
        isEmpty = true;
    }
    
    if (h_facility_level.value.trim() === "") {
        isEmpty = true;
    }
    
    if (h_skill.value.trim() === "") {
        isEmpty = true;
    }
    

    return isEmpty;
}







    </script>
    <script>

        var countySelect = document.getElementById('county');
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
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const togglePassword = document.querySelectorAll('.toggle-password');

            togglePassword.forEach(function (toggle) {
                toggle.addEventListener('click', function () {
                    const passwordInput = document.querySelector(this.getAttribute('toggle'));
                    if (passwordInput.type === 'password') {
                        passwordInput.type = 'text';
                    } else {
                        passwordInput.type = 'password';
                    }
                });
            });
        });
    </script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script
        src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/0.9.16/js/bootstrap-multiselect.min.js"></script>
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/0.9.16/css/bootstrap-multiselect.min.css">
    <script>
        $(document).ready(function () {
            $('#days_select').multiselect({
                nonSelectedText: 'Select Days',
                enableFiltering: true,
                includeSelectAllOption: true,
                onChange: function (option, checked) {
                    var selectedDays = $('#days_select').val();
                    var timeInputs = $(this.$select.closest('.time-range')).find('input[type="time"]');
                    timeInputs.prop('disabled', selectedDays.length === 0);
                }
            });
        });
    </script>
    <script>
        $(document).ready(function () {
            $('#days_selectb').multiselect({
                nonSelectedText: 'Select Days',
                enableFiltering: true,
                includeSelectAllOption: true,
                onChange: function (option, checked) {
                    var selectedDays = $('#days_selectb').val();
                    var timeInputs = $(this.$select.closest('.time-range')).find('input[type="time"]');
                    timeInputs.prop('disabled', selectedDays.length === 0);
                }
            });
        });
    </script>
    <script>
        function onSubmit() {
            document.querySelector('#finish').value = "Please wait...";
            document.querySelector('#finish').disabled = true;
        }
    </script>
    <script>
        const btextArea = document.getElementById('bbkf');
        const bwordCountDisplay = document.getElementById('bbkfcount');
        const htextArea = document.getElementById('hbkf');
        const hwordCountDisplay = document.getElementById('hbkfcount');

        const itextArea = document.getElementById('ibkf');
        const iwordCountDisplay = document.getElementById('ibkfcount');

        btextArea.addEventListener('input', function () {
            const text = this.value;
            const words = text.trim().split(/\s+/);
            const wordCount = 50 - words.length;
            bwordCountDisplay.textContent = wordCount;
        });

        htextArea.addEventListener('input', function () {
            const text = this.value;
            const words = text.trim().split(/\s+/);
            const wordCount = 50 - words.length;
            hwordCountDisplay.textContent = wordCount;
        });

        itextArea.addEventListener('input', function () {
            const text = this.value;
            const words = text.trim().split(/\s+/);
            const wordCount = 50 - words.length;
            iwordCountDisplay.textContent = wordCount;
        });
    </script>


</body>

</html>