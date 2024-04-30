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

// Check if id is set
if(isset($_REQUEST['id'])) {
    $rid = $_REQUEST['id'];
    
    // Prepare and execute SELECT statement to retrieve restaurant details
    $stmt = $connection->prepare("SELECT * FROM restaurant WHERE id = ?");
    $stmt->bind_param("i", $rid);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $x = $row['id'];
        $y = $row['name'];
        $z = $row['address'];
        $v = $row['number'];
    } else {
        echo "Restaurant not found.";
    }
}

?>

<!DOCTYPE html>
<html>
<head>
    <title>Update restaurant</title>
 <!-- JavaScript validation and content load for update or modify data-->
    <script>
        function confirmUpdate() {
            return confirm('Are you sure you want to update this record?');
        }
    </script>
</head>
<body><center>
    <!-- Update restaurant form -->
    <h2><u>Update restaurant Form </u></h2>
    <form method="POST" onsubmit="return confirmUpdate();">
        <label for="id">ID:</label>
        <input type="number" name="id" value="<?php echo isset($x) ? $x : ''; ?>">
        <br><br>

        <label for="name">Name:</label>
        <input type="text" name="name" value="<?php echo isset($y) ? $y : ''; ?>">
        <br><br>

        <label for="address">Address:</label>
        <input type="text" name="address" value="<?php echo isset($z) ? $z : ''; ?>">
        <br><br>
        
        <label for="number">Number:</label>
        <input type="number" name="number" value="<?php echo isset($v) ? $v : ''; ?>">
        <br><br>
        
        <input type="submit" name="up" value="Update">
        
    </form>
</body>
</html>

<?php
if(isset($_POST['up'])) {
    // Retrieve updated values from form
    $id = $_POST['id'];
    $name = $_POST['name'];
    $address = $_POST['address'];
    $number = $_POST['number'];

    // Update the restaurant in the database
    $stmt = $connection->prepare("UPDATE restaurant SET name=?, address=?, number=? WHERE id=?");
    $stmt->bind_param("sssi", $name, $address, $number, $id);
    
    if ($stmt->execute()) {
        // Redirect to restaurant.php after successful update
        header('Location: restaurant.php');
        exit(); // Ensure that no other content is sent after the header redirection
    } else {
        echo "Error updating restaurant: " . $stmt->error;
    }
}
?>
