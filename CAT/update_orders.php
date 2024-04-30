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
    
    // Prepare and execute SELECT statement to retrieve orders details
    $stmt = $connection->prepare("SELECT * FROM orders WHERE id = ?");
    $stmt->bind_param("i", $oid);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $x = $row['id'];
        $y = $row['orders_quantity'];
        $z = $row['orders_item'];
      
    } else {
        echo "orders not found.";
    }
}

?>

<!DOCTYPE html>
<html>
<head>
    <title>Update orders</title>
 <!-- JavaScript validation and content load for update or modify data-->
    <script>
        function confirmUpdate() {
            return confirm('Are you sure you want to update this record?');
        }
    </script>
</head>
<body><center>
    <!-- Update orders form -->
    <h2><u>Update orders form</u></h2>
    <form method="POST" onsubmit="return confirmUpdate();">
        <label for="id">ID:</label>
        <input type="number" name="id" value="<?php echo isset($x) ? $x : ''; ?>">
        <br><br>

        <label for="quantity">quantity:</label>
        <input type="number" name="quantity" value="<?php echo isset($y) ? $y : ''; ?>">
        <br><br>

        <label for="item">item:</label>
        <input type="text" name="item" value="<?php echo isset($z) ? $z : ''; ?>">
        <br><br>
        
        
        
        <input type="submit" name="up" value="Update">
        
    </form>
</body>
</html>

<?php
if(isset($_POST['up'])) {
    // Retrieve updated values from form
    $id = $_POST['id'];
    $quantity = $_POST['quantity'];
    $item = $_POST['item'];
   

    // Update the orders in the database
    $stmt = $connection->prepare("UPDATE orders SET quantity=?, item=? WHERE id=?");
    $stmt->bind_param("ssi", $quantity, $item, $id);
    
    if ($stmt->execute()) {
        // Redirect to orders.php after successful update
        header('Location: orders.php');
        exit(); // Ensure that no other content is sent after the header redirection
    } else {
        echo "Error updating orders: " . $stmt->error;
    }
}
?>
