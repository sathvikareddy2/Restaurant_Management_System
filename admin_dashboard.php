<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <style>
        body {
            font-family: 'Times New Roman', Times, serif;
            margin: 0;
            display: flex;
            flex-direction: column;
            align-items: center;
            background-color: white;
            color: #333;
        }
        .navbar {
            display: flex;
            justify-content: center;
            background-color: #2a9d8f;
            width: 100%;
            padding: 15px 0;
        }
        .navbar a {
            color: white;
            text-decoration: none;
            padding: 14px 20px;
            text-align: center;
            transition: background-color 0.3s;
        }
        .navbar a:hover {
            background-color: #21867a;
        }
        h1, h2 {
            margin-top: 20px;
        }
        h1 {
            font-size: 2.5em;
            color: #333;
        }
        h2 {
            font-size: 2em;
            color: #333;
        }
        p {
            font-size: 1.2em;
            color: #333;
        }
        .bookings-table {
            width: 90%;
            margin: 20px auto;
            border-collapse: collapse;
            font-size: 16px;
            text-align: left;
            background-color: #ffebcd;
            border: 2px solid #ff7e5f;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }
        .bookings-table th, .bookings-table td {
            padding: 12px 15px;
            border: 1px solid #ff7e5f;
        }
        .bookings-table th {
            background-color: #ff7e5f;
            color: white;
            text-transform: uppercase;
            letter-spacing: 0.1em;
        }
        .bookings-table tr:nth-child(even) {
            background-color: #ffd1b3;
        }
        .bookings-table tr:hover {
            background-color: #ffcc99;
        }
    </style>
</head>
<body>
    <div class="navbar">
        <a href="admin_dashboard.php">Dashboard</a>
        <a href="admin_dashboard.php?type=past">Past Reservations</a>
        <a href="admin_dashboard.php?type=future">Future Reservations</a>
        <a href="admin_dashboard.php?type=today">Today's Reservations</a>
        <a href="index.php">Logout</a>
    </div>
    <h1>Admin Dashboard</h1>
    <p>Welcome, admin!</p>
    <h2>All Bookings:</h2>
    <?php
    session_start();

    if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
        header('Location: admin_login.php');
        exit;
    }

    // Display all bookings details
    require 'includes/view.all_bookings.inc.php';
    ?>
</body>
</html>
