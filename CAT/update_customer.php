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
    $stmt = $connection->prepare("SELECT * FROM customer WHERE id = ?");
    $stmt->bind_param("i", $cid);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $x = $row['id'];
        $y = $row['address']; // Corrected column name
        $z = $row['name']; // Corrected column name
        $v = $row['phone']; // Corrected column name
        $w = $row['Email']; // Corrected column name
    } else {
        echo "Customer not found.";
    }
}

?>
<!DOCTYPE html>
<html>
<head>
    <title>Update customer</title>
 <!-- JavaScript validation and content load for update or modify data-->
    <script>
        function confirmUpdate() {
            return confirm('Are you sure you want to update this record?');
        }
    </script>
</head>
<body><center>
    <!-- Update products form -->
    <h2><u>Update customer form</u></h2>
    <form method="POST" onsubmit="return confirmUpdate();">
    <label for="id">ID:</label>
        <input type="number" name="id" value="<?php echo isset($x) ? $x : ''; ?>">
        <br><br>

        <label for="address">Address:</label>
        <input type="text" name="address" value="<?php echo isset($y) ? $y : ''; ?>">
        <br><br>

        <label for="name">Name:</label>
        <input type="text" name="name" value="<?php echo isset($z) ? $z : ''; ?>">
        <br><br>
        
        <label for="phone">Phone:</label>
        <input type="number" name="phone" value="<?php echo isset($v) ? $v : ''; ?>">
        <br><br>
        
        <label for="Email">Email:</label>
        <input type="email" name="Email" value="<?php echo isset($w) ? $w : ''; ?>">
        <br><br>
        
        <input type="submit" name="up" value="Update">
        
    </form>
</body>
</html>

<?php
if(isset($_POST['up'])) {
    // Retrieve updated values from form
    $id = $_POST['id'];
    $address = $_POST['address'];
    $name = $_POST['name'];
    $phone = $_POST['phone'];
    $Email = $_POST['Email'];

    // Update the customer in the database
    $stmt = $connection->prepare("UPDATE customer SET address=?, name=?, phone=?, Email=? WHERE id=?");
    $stmt->bind_param("ssssi", $address, $name, $phone, $Email, $id);
    
    if ($stmt->execute()) {
        // Redirect to customer.php after successful update
        header('Location: customer.php');
        exit(); // Ensure that no other content is sent after the header redirection
    } else {
        echo "Error updating customer: " . $stmt->error;
    }
}
?>
