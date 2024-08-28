<?php
$servername = "localhost";
$username = "root";  // Default XAMPP username
$password = "";      // Default XAMPP password is blank
$dbname = "loginsystem";    // Your imported database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: ". $conn->connect_error);
}

// Determine which type of bookings to fetch
$current_date = date('Y-m-d H:i:s');
$type = isset($_GET['type'])? $_GET['type'] : '';

$heading = "All Reservations"; // default heading
$sql = "SELECT * FROM reservation"; // default SQL query

if ($type == 'past') {
    $sql = "SELECT * FROM reservation WHERE TIMESTAMP(rdate, time_zone) < NOW()";
    $heading = "Past Reservations";
} elseif ($type == 'future') {
    $sql = "SELECT * FROM reservation WHERE TIMESTAMP(rdate, time_zone) > NOW()";
    $heading = "Future Reservations";
} elseif ($type == 'today') {
    $sql = "SELECT * FROM reservation WHERE DATE(rdate) = CURDATE()";
    $heading = "Today's Reservations";
}
$result = $conn->query($sql);

if (!$result) {
    die("Query failed: ". $conn->error);
}

// Make sure $result is not null before trying to use it
if (isset($result) && $result!== null) {
   ?>

    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title><?php echo $heading;?></title>
        <style>
            body {
                font-family: Arial, sans-serif;
                margin: 20px;
                background-color: #f4f4f9;
            }
            table {
                width: 100%;
                border-collapse: collapse;
                box-shadow: 0 2px 10px rgba(0,0,0,0.1);
                margin-bottom: 20px;
                background-color: #fff;
                border-radius: 5px;
                overflow: hidden;
            }
            th, td {
                padding: 12px 15px;
                border: 1px solid #ddd;
                text-align: left;
            }
            th {
                background-color: #2a9d8f;
                color: #fff;
                text-transform: uppercase;
                letter-spacing: 0.1em;
            }
            tr:nth-child(even) {
                background-color: #f2f2f2;
            }
            tr:hover {
                background-color: #e9f7f6;
            }
            h1 {
                text-align: center;
                color: #333;
            }
        </style>
    </head>
    <body>

    <h1><?php echo $heading;?></h1>

    <?php
    if ($result->num_rows > 0) {
        echo "<table>";
        echo "<tr><th>ID</th><th>First Name</th><th>Last Name</th><th>Number of Guests</th><th>Number of Tables</th><th>Date</th><th>Time Zone</th><th>Telephone</th><th>Food</th><th>Registration Date</th></tr>";
        while($row = $result->fetch_assoc()) {
            echo "<tr>
                    <td>". $row["reserv_id"]. "</td>
                    <td>". $row["f_name"]. "</td>
                    <td>". $row["l_name"]. "</td>
                    <td>". $row["num_guests"]. "</td>
                    <td>". $row["num_tables"]. "</td>
                    <td>". $row["rdate"]. "</td>
                    <td>". $row["time_zone"]. "</td>
                    <td>". $row["telephone"]. "</td>
                    <td>". $row["comment"]. "</td>
                    <td>". $row["reg_date"]. "</td>
                    
                  </tr>";
        }
        echo "</table>";
    } else {
        echo "<p style='text-align: center;'>0 results</p>";
    }

    if (isset($conn)) {
        $conn->close();
    }
   ?>

    </body>
    </html>

    <?php
} else {
    echo "No results found";
}
?>