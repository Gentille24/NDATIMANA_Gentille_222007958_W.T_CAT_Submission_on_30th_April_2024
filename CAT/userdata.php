<?php
// Connection details
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

// Check if the connection to the database is successful
if (isset($connection) && $connection instanceof mysqli && !$connection->connect_error) {
    // Check if all form fields are set and not empty
    if(!empty($_POST['firstname']) && !empty($_POST['lastname']) && !empty($_POST['email']) && !empty($_POST['username']) && !empty($_POST['password']) && !empty($_POST['telefone']) && !empty($_POST['activation_code'])) {
        
        // Escape user inputs to prevent SQL injection
        $firstname = $connection->real_escape_string($_POST['firstname']);
        $lastname = $connection->real_escape_string($_POST['lastname']);
        $email = $connection->real_escape_string($_POST['email']);
        $username = $connection->real_escape_string($_POST['username']);
        $password = $connection->real_escape_string($_POST['password']);
        $telefone = $connection->real_escape_string($_POST['telefone']);
        $activation_code = $connection->real_escape_string($_POST['activation_code']); // Define activation_code
        
        // SQL query to insert data into the user table
        $sql = "INSERT INTO user (firstname, lastname, email, username, password, telefone, activation_code)
                VALUES ('$firstname', '$lastname', '$email', '$username', '$password', '$telefone', '$activation_code')";

        // Execute SQL query
        if ($connection->query($sql) === TRUE) {
            echo "Data inserted successfully<br>";
            header("location: index.php");
            exit(); // exit after redirect
        } else {
            echo "Error inserting data: " . $connection->error;
        }
    } else {
        echo "All form fields are required";
    }
    // Close connection
    $connection->close();
} else {
    echo "Connection to the database failed";
}
?>
