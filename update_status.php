<?php
session_start();
include "includes/dbconnect.php";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (isset($_POST["action"])) {
        $action = $_POST["action"];
        
        if ($action === "update" && isset($_POST["id"])) {
            // Update action
            $item_id = $_POST["id"];
            
            // Perform the MySQL query to update the status to "closed"
            $sql = "UPDATE services SET status = '0' WHERE id = $item_id";
            
            if (mysqli_query($conn, $sql)) {
                echo "Status updated successfully"; // You can return a response if needed
            } else {
                echo "Error updating status: " . mysqli_error($conn);
            }
        } elseif ($action === "delete" && isset($_POST["id"])) {
            // Delete action
            $item_id = $_POST["id"];
            
            // Perform the MySQL query to delete the item
            $sql = "DELETE FROM services WHERE id = $item_id";
            
            if (mysqli_query($conn, $sql)) {
                echo "Item deleted successfully"; // You can return a response if needed
            } else {
                echo "Error deleting item: " . mysqli_error($conn);
            }
        }elseif ($action === "delete_account" && isset($_POST["id"])) {
            // Delete action
            $item_id = $_POST["id"];
            
            // Perform the MySQL query to delete the item
            $sql = "DELETE FROM users WHERE id = '$item_id'";
            
            if (mysqli_query($conn, $sql)) {
                // Delete was successful
                session_destroy();

                
                $response = array("success" => true);
                header("Content-Type: application/json");
                echo json_encode($response);
            } else {
                // Delete failed
                $response = array("success" => false, "error" => mysqli_error($conn));
                header("Content-Type: application/json");
                echo json_encode($response);
            }
        }
        
         else {
            echo "Invalid action or request";
        }
    } else {
        echo "Action not specified";
    }
} else {
    echo "Invalid request method";
}
?>
