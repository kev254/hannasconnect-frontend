

<?php

class RestApi {
    
    public function handleRequest() {
        if (isset($_GET['method'])) {
            $method = $_GET['method'];

            switch ($method) {
                case 'getListing':
                    $response = $this->getListing();
                    break;
                case 'login':
                    $response = $this->login();
                    break;
                case 'register':
                    $response = $this->register();
                    break;

                case 'addListing':
                    $response = $this->addListing();
                    break;
                case 'getListingByCategory':
                    $response = $this->getListingByCategory();
                    break;

                default:
                    $response = json_encode(['error' => 'Invalid method']);
            }
        } else {
            $response = json_encode(['error' => 'Method parameter is missing']);
        }

        header('Content-Type: application/json');
        echo $response;
    }

    public function getListing() {
        include "includes/dbconnect.php";        
        $sql = "SELECT users.*, services.* FROM users INNER JOIN services ON users.id = services.user_id LIMIT 8";
        $result = $conn->query($sql);
        if (!$result) {
            die("Query failed: " . $conn->error);
        }
        $results = array();

        while ($row = $result->fetch_assoc()) {
            
                        $image = "https://hannasconnect.co.ke/uploads/logo.png";
                        if ($row['image_url'] !== null && $row['image_url'] !== "") {
                            $image = 'https://hannasconnect.co.ke/uploads/' . $row['image_url'];
                        }
            $row['image_url'] = $image;
        $row['cv_url'] = 'https://hannasconnect.co.ke/uploads/' . $row['cv_url'];
            $results[] = $row;
        }
        $conn->close();
        header('Content-Type: application/json');
        return json_encode($results);
    }
    public function getListingByCategory() {
        include "includes/dbconnect.php";
        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
        $category_id=$_GET['cat_id'];        
        $sql = "SELECT users.*, services.* FROM users INNER JOIN services ON users.id = services.user_id where services.category_id='$category_id'";
        $result = $conn->query($sql);
        if (!$result) {
            die("Query failed: " . $conn->error);
        }
        $results = array();

        while ($row = $result->fetch_assoc()) {
            
                        $image = "https://hannasconnect.co.ke/uploads/logo.png";
                        if ($row['image_url'] !== null && $row['image_url'] !== "") {
                            $image = 'https://hannasconnect.co.ke/uploads/' . $row['image_url'];
                        }
            $row['image_url'] = $image;
        $row['cv_url'] = 'https://hannasconnect.co.ke/uploads/' . $row['cv_url'];
            $results[] = $row;
        }
        $conn->close();
        header('Content-Type: application/json');
        return json_encode($results);
    }
    }

public function login() {
        include "includes/dbconnect.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve the raw request body
    $requestBody = file_get_contents('php://input');
    
    // Parse the raw request body as form data
    parse_str($requestBody, $formData);

    if (isset($formData['email']) && isset($formData['password'])) {
        $email = $formData['email'];
        $password = md5($formData['password']);
        
        $sql = "SELECT * FROM users WHERE (email='$email' OR phone='$email') AND password='$password'";
        $result = $conn->query($sql);

        if ($result) {
            if ($result->num_rows > 0) {
                $userData = $result->fetch_assoc();
                header('Content-Type: application/json');
                echo json_encode(['success' => true, 'user' => $userData]);
            } else {
                header('Content-Type: application/json');
                echo json_encode(['success' => false, 'message' => 'Invalid credentials']);
            }
        } else {
            header('Content-Type: application/json');
            echo json_encode(['success' => false, 'message' => 'Query error']);
        }
    } else {
        header('Content-Type: application/json');
        echo json_encode(['success' => false, 'message' => 'Missing email or password']);
    }
} else {
    header('Content-Type: application/json');
    echo json_encode(['success' => false, 'message' => 'Invalid request method']);
}
    }

    public function register() {
        include "includes/dbconnect.php";
    
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = $_POST['email'];
            $password = md5($_POST['password']);
            $phone = $_POST['phone'];
            $name = $_POST['name'];
            $category=0;
            $otp = rand(1000, 9999);
            $api_key = "2029bfa7c1d943a49f15cef0c00c1969";
            $sender_id = "Afritext";
            $message = "Hello ". $name. " your OTP is ". $otp. " follow https://hannasconnect.co.ke to verify your account";

            $userInsertSql = "INSERT INTO users (name,email, phone, password, category_id, created_at, updated_at, role,otp)
                VALUES ('$name', '$email', '$phone', '$password', '$category', NOW(), NOW(), '1', '$otp')";

            if ($conn->query($userInsertSql) === TRUE) {
                
                
                $lastInsertedId = $conn->insert_id;
                $this->sendSMS($api_key,$sender_id,$message,$phone);
                // $response = sendEmail($name, $email, $otp);
                header('Content-Type: application/json');
                echo json_encode(['success' => true, 'user' => $lastInsertedId]);
            } else {
                header('Content-Type: application/json');
                    echo json_encode(['success' => false, 'message' =>  $conn->error]);
               
            }
           
            
    }
}
    

    public function addListing() {
        include "includes/dbconnect.php";
        $keys = array();
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $category = $_POST['category'];
            $name = $_POST['name'];
            $slogan = $_POST['slogan'];
            $county = $_POST['county'];
            $sub_county = $_POST['sub_county'];
            $ward = $_POST['ward'];
            $email = $_POST['email'];
            $phone = $_POST['phone']; 
            $password = md5($_POST['password']);


            $ibfk = $_POST['ibfk'];
            $i_physical_address = $_POST['i_physical_address'];
            $i_location_pin = $_POST['i_location_pin'];
            $i_website = $_POST['i_website'];
            $i_working_day = $_POST['i_working_days'];
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
            $user_id=$_POST['user_id'];
        
            $key1 = $_POST['key1'];
            $key2 = $_POST['key2'];
            $key3 = $_POST['key3'];
            $key4 = $_POST['key4'];
            $key5 = $_POST['key5'];
            $key6 = $_POST['key6'];
            $key7 = $_POST['key7'];
            $key8 = $_POST['key8'];
        
            $bkey1 = $_POST['bkey1'];
            $bkey2 = $_POST['bkey2'];
            $bkey3 = $_POST['bkey3'];
            $bkey4 = $_POST['bkey4'];
            $bkey5 = $_POST['bkey5'];
            $bkey6 = $_POST['bkey6'];
            $bkey7 = $_POST['bkey7'];
            $bkey8 = $_POST['bkey8'];

            $bbfk = $_POST['bbfk'];
            $b_branches = $_POST['b_branches'];
            $b_location_pin = $_POST['b_location_pin'];
            $b_website = $_POST['b_website'];
            $b_working_day = $_POST['b_working_days'];
            $b_start_time = $_POST['b_start_time'];
            $b_end_time = $_POST['b_end_time'];
            $b_social_links = $_POST['b_social_links'];
            $b_message = $_POST['b_message'];
            $b_price_negotiable = $_POST['b_price_negotiable'];
        
        
        
            //Hire values
            $hbfk = $_POST['hbfk'];
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
        
        
            $jsonkeywords = json_encode($keys);
        
        
            $lastInsertedUserId = $user_id; // Get the last inserted user ID
            $result = move_uploaded_file($tempFileName, $fileTarget);

            if ($category === "Individual services") {

                $individualInsertSql = "INSERT INTO services (profession,name, user_id, slogan, county, sub_counry, ward, email, bkf, physical_address, location_pin, website, working_days, open_at, clsoing_at, social_links, price, key_words, plan, price_negotiable, category_id, image_url)
                    VALUES ('$profession','$name', '$lastInsertedUserId', '$slogan', '$county', '$sub_county', '$ward', '$email', '$ibfk', '$i_physical_address', '$i_location_pin', '$i_website', '$i_working_day', '$i_start_time', '$i_end_time', '$i_social_links', '$i_price', '$jsonkeywords ', '$plan', '$i_price_negotiable', '1', '$fileName')";
        
            } else if ($category === "Companies") {
                $individualInsertSql = "INSERT INTO services (name, user_id, slogan, county, sub_counry, ward, email, bkf, branches, location_pin, website, working_days, open_at, clsoing_at, social_links, key_words, plan, price_negotiable, category_id, message, image_url)
                    VALUES ('$name', '$lastInsertedUserId', '$slogan', '$county', '$sub_county', '$ward', '$email', '$bbfk', '$b_ranches', '$i_location_pin', '$b_website', '$b_working_day', '$b_start_time', '$i_end_time', '$b_social_links', '$jsonkeywords ', '$plan', '$b_price_negotiable', '2', '$b_message', '$fileName')";
            } else if ($category === "Emergency services") {
        
                $individualInsertSql = "INSERT INTO services (name, user_id, slogan, county, sub_counry, ward, email,   plan, price,price_negotiable, category_id, service, image_url)
                    VALUES ('$name', '$lastInsertedUserId', '$slogan', '$county', '$sub_county', '$ward', '$email',  '$plan', $e_price, '$e_price_negotiable', '3', '$e_service', '$fileName')";
                //echo "Query: $individualInsertSql";
            } else if ($category === "Hire me (CV center)") {
                $cvfileName = $_FILES['cv_file']['name'];
                $cvtarget = "uploads/";
                $cvfileTarget = $cvtarget . $cvfileName;
                $cvtempFileName = $_FILES["cv_file"]["tmp_name"];
                $cvresult = move_uploaded_file($cvtempFileName, $cvfileTarget);
                $individualInsertSql = "INSERT INTO services (name, user_id, slogan, county, sub_counry, ward, email,   plan, bkf,looking_for, profession,education_level,skill,salary_expectation,image_url,category_id, cv_url)
                    VALUES ('$name', '$lastInsertedUserId', '$slogan', '$county', '$sub_county', '$ward', '$email',  '$plan', '$hbkf', '$h_looking_for', '$h_profession', '$h_facility_level', '$h_skill', '$h_salary_expectation', '$fileName', '4', '$cvfileName')";
            }
            if ($conn->query($individualInsertSql) === TRUE) {

                header('Content-Type: application/json');
                echo json_encode(['success' => true, 'user' => $lastInsertedId]);
            } else {
                header('Content-Type: application/json');
                echo json_encode(['success' => false, 'message' =>  $conn->error]);
            }
            
        }
    }

    function sendSMS($api_key, $sender_id, $message, $phoneNumbers) {
        $url = "https://sms.blessedtexts.com/api/sms/v1/sendsms";
        $data = array(
            "api_key" => $api_key,
            "sender_id" => $sender_id,
            "message" => $message,
            "phone" => $phoneNumbers
        );
        $json_data = json_encode($data);
   
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json', 'Accept: application/json'));
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $json_data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $response = curl_exec($ch);

        if (curl_errno($ch)) {
            echo 'Curl error: ' . curl_error($ch);
        }
    
        curl_close($ch);

        return $response;
    }
}

// Create an instance of the RestApi class
$api = new RestApi();

// Handle the request based on the 'method' parameter
$api->handleRequest();
?>

