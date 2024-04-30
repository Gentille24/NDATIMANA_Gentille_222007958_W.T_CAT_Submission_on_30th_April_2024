<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Search Results</title>
</head>
<body style="background-color: orange;">

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

// Check if 'query' key exists in the $_GET array
if (isset($_GET['query'])) {

    // Sanitize the input to avoid SQL injection
    $searchTerm = $connection->real_escape_string($_GET['query']);

    $queries = [
        'customer' => "SELECT id, CONCAT(address, ' ', name) AS full_name, address 
                             FROM customer 
                             WHERE id LIKE '%$searchTerm%' 
                             OR CONCAT(address, ' ', name) LIKE '%$searchTerm%'",
        'menu' => "SELECT id, availability
                   FROM menu
                   WHERE id LIKE '%$searchTerm%' 
                   OR availability LIKE '%$searchTerm%'",
        'orders' => "SELECT id, item 
                     FROM orders 
                     WHERE id LIKE '%$searchTerm%' 
                     OR item LIKE '%$searchTerm%'",
        'payment' => "SELECT id, method
                      FROM payment
                      WHERE id LIKE '%$searchTerm%' 
                      OR method LIKE '%$searchTerm%'",
        'restaurant' => "SELECT id, address
                         FROM restaurant 
                         WHERE id LIKE '%$searchTerm%' 
                         OR address LIKE '%$searchTerm%'",
    ];

    echo "<h2><u>Search Results:</u></h2>";

    // Display search results from each query
    foreach ($queries as $table => $sql) {
        $result = $connection->query($sql);
        echo "<h3>Table: " . ucfirst($table) . "</h3>";

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<p>";
                foreach ($row as $key => $value) {
                    echo "<strong>$key</strong>: $value ";
                }
                echo "</p>";
            }
        } else {
            echo "<p>No results found in $table matching the search term: '$searchTerm'</p>";
        }
    }

    $connection->close();
} else {
    echo "<p>No search term was provided.</p>";
}

// Place the "Back to home" button at the bottom of the results
echo '<a href="home.html"><button>&larr; Back to home</button></a>';
?>

</body>
</html>
