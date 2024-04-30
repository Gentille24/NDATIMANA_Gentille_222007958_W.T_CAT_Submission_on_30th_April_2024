<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home Page</title>
    <link rel="stylesheet" type="text/css" href="style.css">

    <style>
        /* Global styles for links */
        a {
            padding: 10px;
            color: white;
            background-color: pink;
            text-decoration: none;
            margin-right: 15px;
        }

        a:visited {
            color: purple;
        }

        a:link {
            color: brown;
        }

        a:hover {
            background-color: white;
        }

        a:active {
            background-color: red;
        }

        /* Styles for search button and input */
        button.btn {
            margin-left: 15px;
            margin-top: 4px;
            background-color: blue;
            border: none;
        }

        input.form-control {
            width: 200px; /* Adjust width as needed */
            padding: 8px;
        }

        /* Styles for table */
        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }
    </style>
     <!-- JavaScript validation and content load for insert data-->
        <script>
            function confirmInsert() {
                return confirm('Are you sure you want to insert this record?');
            }
        </script>

</head>
<body>
<header>
    <form class="forms" role="search" action="search.php">
      <input  type="text" placeholder="Search" aria-label="Search"name="query">
      <button  type="submit">Search</button>
    </form>
    <!-- Navigation payment -->
    <ul style="list-style-type: none; padding: 0;">
        <li style="display: inline;"><a href="./home.html">HOME</a></li>
        <li style="display: inline; margin-right: 10px;"><a href="./about.html">ABOUT</a></li>
        <li style="display: inline; margin-right: 10px;"><a href="./contact.html">CONTACT</a></li>
        <li style="display: inline; margin-right: 10px;"><a href="./customer.php">CUSTOMER</a></li>
        <li style="display: inline; margin-right: 10px;"><a href="./menu.php">MENU</a></li>
        <li style="display: inline; margin-right: 10px;"><a href="./orders.php">ORDERS</a></li>
        <li style="display: inline; margin-right: 10px;"><a href="./payment.php">PAYMENT</a></li>
        <li style="display: inline; margin-right: 10px;"><a href="./restaurant.php">RESTAURANT</a></li>
        <li class="dropdown" style="display: inline; margin-right: 10px;">
            <a href="#" style="padding: 10px; color: white; background-color: skyblue; text-decoration: none; margin-right: 15px;">Settings</a>
            <div class="dropdown-contents">
        <!-- Links inside the dropdown menu -->
        <a href="index.php">Login</a>
        <a href="register.php">Register</a>
        <a href="logout.php">Logout</a>
            </div>
        </li>
    </ul>
</header>

<section>
    <h1><u>Payment Form</u></h1>
   <form method="post" onsubmit="return confirmInsert();">
        <label for="id">ID:</label>
        <input type="number" id="id" name="id"><br><br>
        <label for="date">date:</label>
        <input type="date" id="date" name="date" required><br><br>
        <label for="amaunt">amaunt:</label>
        <input type="number" id="amaunt" name="amaunt" required><br><br>
        <label for="method">method:</label>
        <input type="text" id="method" name="method" required><br><br>
       <input type="submit" name="insert" value="Insert"><br><br>
       <a href="./home.html">Go Back to Home</a>
    </form>


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

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Prepare and bind the parameters
    $stmt = $connection->prepare("INSERT INTO payment (Id, date, amaunt, method) VALUES (?, ?, ?, ?)");
     $stmt->bind_param("isss", $id, $date, $amaunt, $method);
    // Set parameters and execute
    $id = $_POST['id'];
    $date = $_POST['date'];
    $amaunt = $_POST['amaunt'];
    $method = $_POST['method'];
   
   
    if ($stmt->execute() == TRUE) {
        echo "New record has been added successfully";
    } else {
        echo "Error: " . $stmt->error;
    }
    $stmt->close();
}
$connection->close();
?>

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
// SQL query to fetch data from the payment table
$sql = "SELECT * FROM payment";
$result = $connection->query($sql);

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Detail information Of payment</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <center><h2>Table of payment</h2></center>
    <table border="5">
        <tr>
            <th> Id</th>
            <th>date</th>
            <th>amaunt</th>
            <th>method</th>
             <th>Delete</th>
            <th>Update</th>
        </tr>
        <?php
        // Define connection parameters
        $host = "localhost";
        $user = "root";
        $pass = "";
        $database = "food_ordering_system";

        // Establish a new connection
        $connection = new mysqli($host, $user, $pass, $database);

        // Check if connection was successful
        if ($connection->connect_error) {
            die("Connection failed: " . $connection->connect_error);
        }

        // Prepare SQL query to retrieve all payment
        $sql = "SELECT * FROM payment";
        $result = $connection->query($sql);

        // Check if there are any payment
        if ($result->num_rows > 0) {
            // Output data for each row
            while ($row = $result->fetch_assoc()) {
                $pid = $row['id']; // Fetch the payment_Id
                echo "<tr>
                    <td>" . $row['id'] . "</td>
                    <td>" . $row['date'] . "</td>
                    <td>" . $row['amaunt'] . "</td>
                    <td>" . $row['method'] . "</td>
                      <td><a style='padding:4px' href='delete_payment.php?id={$row['id']}'>Delete</a></td>
                    <td><a style='padding:4px' href='update_payment.php?id={$row['id']}'>Update</a></td>
                </tr>";
            }
        } else {
            echo "<tr><td colspan='6'>No data found</td></tr>";
        }
        // Close the database connection
        $connection->close();
        ?>
    </table>
</body>

    </section>


  
<footer>
  <center> 
    <b><h2>UR CBE BIT &copy, 2024 &reg, Designer by: @NDATIMANA Gentille</h2></b>
  </center>
</footer>
</body>
</html>