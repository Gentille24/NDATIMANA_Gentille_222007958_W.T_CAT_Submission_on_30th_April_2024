<?php
$host = "localhost";
$user = "root";
$pass = "";
$database = "food_ordering_system";

// Creating connection
$connection = new mysqli($host, $user, $pass, $database);

// Check connection
if ($connection->connect_error) {
    die("Connection failed: " . $connection->connect_error);
}
if (isset($_GET["id"])) {
    $id = $connection->real_escape_string($_GET["id"]);

    // Prepare DELETE statement
    $sql = "DELETE FROM restaurant WHERE id = $id";

    // Execute DELETE statement
    if ($connection->query($sql) === TRUE) {
        echo "Record deleted successfully";
         header("Location: restaurant.php");
    } else {
        echo "Error deleting record: " . $connection->error;
    }
}
$connection->close();
?>