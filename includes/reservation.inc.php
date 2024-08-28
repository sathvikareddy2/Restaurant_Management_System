<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
session_start();

if (isset($_SESSION['user_id'])) {
    require 'dbh.inc.php';  // Ensure this file contains your database connection code

    $user = $_SESSION['user_id'];
    $role = $_SESSION['role'];

    // Handle reservation submission
    if (isset($_POST['reserv-submit'])) {
        $fname = trim($_POST['fname']);
        $lname = trim($_POST['lname']);
        $date = $_POST['date'];
        $time = $_POST['time'];
        $num_guests = (int)$_POST['num_guests'];
        $tele = trim($_POST['tele']);
        $food_items = trim($_POST['food_items']);

        // Validate input
        if (empty($fname) || empty($lname) || empty($date) || empty($time) || empty($num_guests) || empty($tele)) {
            echo "<script>
                    alert('All fields are required.');
                    window.location.href = '../reservation.php';
                  </script>";
            exit();
        } elseif (!preg_match("/^[a-zA-Z\s]{2,20}$/", $fname)) {
            echo "<script>
                    alert('Invalid first name.');
                    window.location.href = '../reservation.php';
                  </script>";
            exit();
        } elseif (!preg_match("/^[a-zA-Z\s]{2,20}$/", $lname)) {
            echo "<script>
                    alert('Invalid last name.');
                    window.location.href = '../reservation.php';
                  </script>";
            exit();
        } elseif (!preg_match("/^[0-9]{6,15}$/", $tele)) {
            echo "<script>
                    alert('Invalid telephone number.');
                    window.location.href = '../reservation.php';
                  </script>";
            exit();
        } elseif ($num_guests <= 0) {
            echo "<script>
                    alert('Invalid number of guests.');
                    window.location.href = '../reservation.php';
                  </script>";
            exit();
        } elseif (strlen($food_items) > 200) {
            echo "<script>
                    alert('Comments should not exceed 200 characters.');
                    window.location.href = '../reservation.php';
                  </script>";
            exit();
        }

        // Calculate number of tables based on number of guests
        $num_tables = ceil($num_guests / 4); // Assuming each table can accommodate 4 guests

        // Check if the total number of tables for the specified date and time slot exceeds the limit
        $sql = "SELECT COALESCE(SUM(num_tables), 0) as total_tables FROM reservation WHERE rdate = ? AND time_zone = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('ss', $date, $time);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        $total_tables = $row['total_tables'];

        if ($total_tables + $num_tables > 10) {
            echo "<script>
                    alert('The maximum number of tables for the specified date and time slot has been reached.');
                    window.location.href = '../reservation.php';
                  </script>";
            exit();
        }

        // Insert reservation into database
        $sql = "INSERT INTO reservation (user_fk, f_name, l_name, rdate, time_zone, num_guests, num_tables, telephone, comment) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('issssisss', $user, $fname, $lname, $date, $time, $num_guests, $num_tables, $tele, $food_items);

        if ($stmt->execute()) {
            echo "<script>
                    alert('Reservation was booked successfully! Number of tables: " . $num_tables . "');
                    window.location.href = '../reservation.php';
                  </script>";
        } else {
            echo "<script>
                    alert('There was an error booking the reservation. Please try again.');
                    window.location.href = '../reservation.php';
                  </script>";
        }

        $stmt->close();
        $conn->close();
        exit();
    }

    // Display reservations based on user role
    if ($role == 1) {
        // Role: Customer
        $sql = "SELECT * FROM reservation WHERE user_fk = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('i', $user);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            echo '
            <table class="table table-hover table-responsive-sm text-center">
                <thead>
                    <tr>
                        <th scope="col">Full Name</th>
                        <th scope="col">Guests</th>
                        <th scope="col">Reservation Date</th>
                        <th scope="col">Time Zone</th>
                        <th scope="col">Telephone</th>
                        <th scope="col">Register Date</th>
                        <th scope="col">Comments</th>
                        <th class="table-danger" scope="col"></th>
                    </tr>
                </thead>
                <tbody>';
            while ($row = $result->fetch_assoc()) {
                echo "
                    <tr>
                    <form action='includes/delete.php' method='POST'>
                    <input name='reserv_id' type='hidden' value='" . $row["reserv_id"] . "'>
                      <th scope='row'>" . $row["f_name"] . " " . $row["l_name"] . "</th>
                      <td>" . $row["num_guests"] . "</td>
                      <td>" . $row["rdate"] . "</td>
                      <td>" . $row["time_zone"] . "</td>
                      <td>" . $row["telephone"] . "</td>
                      <td>" . $row["reg_date"] . "</td>
                      <td><textarea readonly>" . htmlspecialchars($row["comment"]) . "</textarea></td>
                      <td class='table-danger'><button type='submit' name='delete-submit' class='btn btn-danger btn-sm'>Cancel</button></td>
                    </form>
                    </tr>";
            }
            echo "</tbody></table>";
        } else {
            echo "<p class='text-white text-center bg-danger'>Your reservation list is empty!<p>";
        }
    } elseif ($role == 2) {
        // Role: Admin
        $sql = "SELECT * FROM reservation";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            echo '
            <table class="table table-hover table-responsive-sm text-center">
                <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Full Name</th>
                        <th scope="col">Guests</th>
                        <th scope="col">Tables</th>
                        <th scope="col">Reservation Date</th>
                        <th scope="col">Time Zone</th>
                        <th scope="col">Telephone</th>
                        <th scope="col">Register Date</th>
                        <th scope="col">Comments</th>
                        <th class="table-danger" scope="col"></th>
                    </tr>
                </thead>
                <tbody>';
            while ($row = $result->fetch_assoc()) {
                echo "
                    <tr>
                    <form action='includes/delete.php' method='POST'>
                      <input name='reserv_id' type='hidden' value='" . $row["reserv_id"] . "'>
                      <th scope='row'>" . $row["reserv_id"] . "</th>
                      <td>" . $row["f_name"] . " " . $row["l_name"] . "</th>
                      <td>" . $row["num_guests"] . "</td>
                      <td>" . $row["num_tables"] . "</td>
                      <td>" . $row["rdate"] . "</td>
                      <td>" . $row["time_zone"] . "</td>
                      <td>" . $row["telephone"] . "</td>
                      <td>" . $row["reg_date"] . "</td>
                      <td><textarea readonly>" . htmlspecialchars($row["comment"]) . "</textarea></td>
                      <td class='table-danger'><button type='submit' name='delete-submit' class='btn btn-danger btn-sm'>Cancel</button></td>
                    </form>
                    </tr>";
            }
            echo "</tbody></table>";
        } else {
            echo "<p class='text-white text-center bg-danger'>Reservation list is empty!<p>";
        }
    }

    $conn->close();
} else {
    echo "<script>
            alert('Please login first to access this page.');
            window.location.href = '../index.php';
          </script>";
    exit();
}
?>
