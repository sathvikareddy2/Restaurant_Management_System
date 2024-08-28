<?php
require "header.php";
?>

<!-- end of nav bar -->

<br><br>
<div class="container">
    <h3 class="text-center"><br>New Reservation<br></h3>
    <div class="row">
        <div class="col-md-6 offset-md-3">

            <?php
            if (isset($_SESSION['user_id'])) {
                echo '<p class="text-white bg-dark text-center">Welcome ' . $_SESSION['username'] . ', Create your reservation here!</p>';

                // Error handling
                if (isset($_GET['error3'])) {
                    if ($_GET['error3'] == "emptyfields") {
                        echo '<h5 class="bg-danger text-center">Fill all fields, Please try again!</h5>';
                    } else if ($_GET['error3'] == "invalidfname") {
                        echo '<h5 class="bg-danger text-center">Invalid First Name, Please try again!</h5>';
                    } else if ($_GET['error3'] == "invalidlname") {
                        echo '<h5 class="bg-danger text-center">Invalid Last Name, Please try again!</h5>';
                    } else if ($_GET['error3'] == "invalidtele") {
                        echo '<h5 class="bg-danger text-center">Invalid Telephone, Please try again!</h5>';
                    } else if ($_GET['error3'] == "invalidcomment") {
                        echo '<h5 class="bg-danger text-center">Invalid Comment, Please try again!</h5>';
                    } else if ($_GET['error3'] == "invalidguests") {
                        echo '<h5 class="bg-danger text-center">Invalid Guests, Please try again!</h5>';
                    } else if ($_GET['error3'] == "full") {
                        echo '<h5 class="bg-danger text-center">Reservations are full this date and time zone, Please try again!</h5>';
                    } else if ($_GET['error3'] == "invaliddate") {
                        echo '<h5 class="bg-danger text-center">Please select a date within the next 10 days.</h5>';
                    } else if ($_GET['error3'] == "invalidtime") {
                        echo '<h5 class="bg-danger text-center">Please select a time in the future.</h5>';
                    }
                }

                if (isset($_GET['reservation'])) {
                    if ($_GET['reservation'] == "success") {
                        echo '<h5 class="bg-success text-center">Your reservation was successful!</h5>';
                    }
                }
                echo '<br>';

                // Reservation form
                echo '
                <div class="signup-form">
                    <form name="reservationForm" action="includes/reservation.inc.php" method="post" onsubmit="return validateDateTimeSelection()">
                        <div class="form-group">
                            <label>First Name</label>
                            <input type="text" class="form-control" name="fname" placeholder="First Name" required="required">
                            <small class="form-text text-muted">First name must be 2-20 characters long</small>
                        </div>
                        <div class="form-group">
                            <label>Last Name</label>
                            <input type="text" class="form-control" name="lname" placeholder="Last Name" required="required">
                            <small class="form-text text-muted">Last name must be 2-20 characters long</small>
                        </div>
                        <div class="form-group">
                            <label>Enter Date</label>
                            <input type="date" class="form-control" name="date" placeholder="Date" required="required">
                        </div>
                        <div class="form-group">
                            <label>Enter Time Zone</label>
                            <select class="form-control" name="time">
                                <option>10:57 - 10:59</option>
                                <option>11:00 - 11:10</option>
                                <option>11:00 - 12:00</option>
                                <option>12:15 - 13:15</option>
                                <option>13:30 - 14:30</option>
                                <option>14:45 - 15:45</option>
                                <option>16:00 - 17:00</option>
                                <option>17:15 - 18:15</option>
                                <option>18:30 - 19:30</option>
                                <option>19:45 - 20:45</option>
                                <option>21:00 - 22:00</option>
                                <option>22:15 - 23:15</option>
                                <option>23:30 - 00:30</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Enter number of Guests</label>
                            <input type="number" class="form-control" min="1" name="num_guests" placeholder="Guests" required="required">
                            <small class="form-text text-muted">Minimum value is 1</small>
                        </div>
                        <div class="form-group">
                            <label for="guests">Enter your Telephone Number</label>
                            <input type="tel" class="form-control" name="tele" placeholder="Telephone" required="required">
                            <small class="form-text text-muted">Telephone must be 6-20 characters long</small>
                        </div>
                        <div class="form-group">
                            <label>Select Food Items (optional)</label><br>
                            <textarea class="form-control" name="food_items" placeholder="Enter your desired food items here..."></textarea>
                            <small class="form-text text-muted">Please refer to the list below for available food items and their costs.</small>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-dark btn-lg btn-block" name="reserv-submit">Book Now</button>
                        </div>
                    </form>
                    <br><br>
                </div>
                ';
                // Food items list
                echo '
                <div class="food-items-list">
                    <h4 class="text-center">Food Items and Prices</h4>
                    <ul>
                        <li>Chicken Biryani - 210</li>
                        <li>Mutton Biryani - 253</li>
                        <li>Chicken Family Pack - 533</li>
                        <li>Mutton Family Pack - 732</li>
                        <li>Special Chicken Biryani - 337</li>
                        <li>Special Mutton Biryani - 337</li>
                        <li>Supreme Chicken Biryani - 514</li>
                        <li>Supreme Mutton Biryani - 819</li>
                        <li>Egg Biryani - 184</li>
                        <li>Veg. Biryani - 154</li>
                        <li>Veg. Family Pack - 383</li>
                        <li>Veg. Supreme Pack - 574</li>
                        <li>Chilli Chicken - 264</li>
                        <li>Chicken 65 - 264</li>
                        <li>Pepper Chicken - 326</li>
                        <li>Paneer 65 - 239</li>
                        <li>Veg. Manchurian - 189</li>
                        <li>Chicken Tikka Kebab - 243</li>
                        <li>Tandoori Chicken (Half) - 243</li>
                        <li>Tandoori Chicken (Full) - 463</li>
                        <li>Chicken Reshmi Kebab - 243</li>
                        <li>Chicken Garlic Kebab - 243</li>
                        <li>Butter Chicken Boneless - 246</li>
                        <li>Nizami Handi - 171</li>
                        <li>Tandoori Roti - 40</li>
                        <li>Rumali Roti - 40</li>
                        <li>Butter Naan - 50</li>
                        <li>Butter Kulcha - 50</li>
                        <li>Plain Naan - 35</li>
                        <li>Plain Kulcha - 35</li>
                        <li>Jeera Rice - 158</li>
                        <li>Veg. Pulao - 168</li>
                        <li>Coke</li>
                        <li>Diet Coke</li>
                        <li>Thums Up</li>
                        <li>Mineral Water</li>
                        <li>Maaza</li>
                        <li>Pepsi</li>
                        <li>Coke</li>
                    </ul>
                </div>
                ';

            } else {
                echo ' <p class="text-center text-danger"><br>You are currently not logged in!<br></p>
                <p class="text-center">In order to make a reservation you have to create an account!<br><br><p>';
            }
            ?>

        </div>
    </div>
</div>
<br><br>

<script>
// Function to validate the date and time selection
function validateDateTimeSelection() {
    var selectedDate = new Date(document.forms["reservationForm"]["date"].value);
    var selectedTime = document.forms["reservationForm"]["time"].value;
    var currentTime = new Date();

    // Set current time to midnight of current date
    currentTime.setHours(0, 0, 0, 0);

    // Maximum allowed date (10 days from now)
    var maxDate = new Date(currentTime);
    maxDate.setDate(maxDate.getDate() + 10);

    // Compare selected date with current date and max date
    if (selectedDate < currentTime) {
        alert("Please select a date in the future.");
        return false;
    }

    if (selectedDate > maxDate) {
        alert("Please select a date within the next 10 days.");
        return false;
    }

    // If selected date is today, validate time
    if (selectedDate.toDateString() === new Date().toDateString()) {
        var currentHour = new Date().getHours();
        var currentMinute = new Date().getMinutes();

        // Extract hours and minutes from selected time
        var selectedHour = parseInt(selectedTime.split(":")[0]);
        var selectedMinute = parseInt(selectedTime.split(":")[1].split(" - ")[0]);

        // Check if the selected time is earlier than the current time
        if (selectedHour < currentHour || (selectedHour === currentHour && selectedMinute <= currentMinute)) {
            alert("Please select a time in the future.");
            return false;
        }
    }

    return true;
}
</script>

<?php
require "footer.php";
?>
