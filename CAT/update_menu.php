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

// Check if customer_id is set
if(isset($_REQUEST['id'])) {
    $cid = $_REQUEST['id'];
    
    // Prepare and execute SELECT statement to retrieve menu details
    $stmt = $connection->prepare("SELECT * FROM menu WHERE id = ?");
    $stmt->bind_param("i", $mid);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $x = $row['id'];
        $y = $row['menu_price'];
        $z = $row['menu_availability'];
      
    } else {
        echo "menu not found.";
    }
}

?>


<!DOCTYPE html>
<html>
<head>
    <title>Update menu</title>
 <!-- JavaScript validation and content load for update or modify data-->
    <script>
        function confirmUpdate() {
            return confirm('Are you sure you want to update this record?');
        }
    </script>
</head>
<body><center>
    <!-- Update menu form -->
    <h2><u>Update menu form</u></h2>
    <form method="POST" onsubmit="return confirmUpdate();">
        <label for="id">ID:</label>
        <input type="number" name="id" value="<?php echo isset($x) ? $x : ''; ?>">
        <br><br>

        <label for="price">price:</label>
        <input type="number" name="price" value="<?php echo isset($y) ? $y : ''; ?>">
        <br><br>

        <label for="availability">availability:</label>
        <input type="text" name="availability" value="<?php echo isset($z) ? $z : ''; ?>">
        <br><br>
        
        
        
        <input type="submit" name="up" value="Update">
        
    </form>
</body>
</html>

<?php
if(isset($_POST['up'])) {
    // Retrieve updated values from form
    $id = $_POST['id'];
    $price = $_POST['price'];
    $availability = $_POST['availability'];
   

    // Update the menu in the database
    $stmt = $connection->prepare("UPDATE menu SET price=?, availability=? WHERE id=?");
    $stmt->bind_param("ssi", $price, $availability, $id);
    
    if ($stmt->execute()) {
        // Redirect to menu.php after successful update
        header('Location: menu.php');
        exit(); // Ensure that no other content is sent after the header redirection
    } else {
        echo "Error updating menu: " . $stmt->error;
    }
}
?>
