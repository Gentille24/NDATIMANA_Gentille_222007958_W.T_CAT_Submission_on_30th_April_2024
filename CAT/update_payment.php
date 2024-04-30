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
    
    // Prepare and execute SELECT statement to retrieve customer details
    $stmt = $connection->prepare("SELECT * FROM payment WHERE id = ?");
    $stmt->bind_param("i", $pid);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $x = $row['id'];
        $y = $row['payment_date'];
        $z = $row['payment_amaunt'];
        $v = $row['payment_method'];
        
    } else {
        echo "payment not found.";
    }
}

?>

<!DOCTYPE html>
<html>
<head>
    <title>Update payment</title>
 <!-- JavaScript validation and content load for update or modify data-->
    <script>
        function confirmUpdate() {
            return confirm('Are you sure you want to update this record?');
        }
    </script>
</head>
<body><center>
    <!-- Update payment form -->
    <h2><u>Update payment form</u></h2>
    <form method="POST" onsubmit="return confirmUpdate();">
        <label for="id">ID:</label>
        <input type="number" name="id" value="<?php echo isset($x) ? $x : ''; ?>">
        <br><br>

        <label for="date">date:</label>
        <input type="date" name="date" value="<?php echo isset($y) ? $y : ''; ?>">
        <br><br>

        <label for="amaunt">amaunt:</label>
        <input type="number" name="amaunt" value="<?php echo isset($z) ? $z : ''; ?>">
        <br><br>
        
        <label for="method">method:</label>
        <input type="text" name="method" value="<?php echo isset($v) ? $v : ''; ?>">
        <br><br>
        
       
        <input type="submit" name="up" value="Update">
        
    </form>
</body>
</html>

<?php
if(isset($_POST['up'])) {
    // Retrieve updated values from form
    $id = $_POST['id'];
    $date = $_POST['date'];
    $amaunt = $_POST['amaunt'];
    $method = $_POST['method'];
    

    // Update the payment in the database
    $stmt = $connection->prepare("UPDATE payment SET date=?, amaunt=?, method=? WHERE id=?");
    $stmt->bind_param("sssi", $date, $amaunt, $method, $id);
    
    if ($stmt->execute()) {
        // Redirect to payment.php after successful update
        header('Location: payment.php');
        exit(); // Ensure that no other content is sent after the header redirection
    } else {
        echo "Error updating payment: " . $stmt->error;
    }
}
?>
