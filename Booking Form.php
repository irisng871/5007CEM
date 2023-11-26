<?php
session_start();

// If the logout button is clicked
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['logout'])) {
    unset($_SESSION['id']);
}

// Check if the user is already logged in
if (isset($_SESSION['id'])) {
    // If logged in, retrieve user information based on 'id'
    $dbc = mysqli_connect('localhost', 'root', '', 'careplusdb');

    if (isset($_SESSION['id'])) {
        $user_id = $_SESSION['id'];

        $query = "SELECT * FROM user WHERE id = $user_id";
        $result = mysqli_query($dbc, $query);

        if ($result) {
            $user_info = mysqli_fetch_assoc($result);
            if ($user_info) {
                
            }
        }
    }
}
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Booking Form</title>
        <link href="image/weblogo.png" alt="icon">
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <script src="js/booking form.js"></script>
        <link rel="stylesheet" href="css/Booking Form style.css">
        <link href="https://db.onlinewebfonts.com/c/04d799f9fc4bd0a0973b3331ff889f32?family=Schnyder+Cond+M+Light" rel="stylesheet">
        <link href="https://db.onlinewebfonts.com/c/2d98f490df6dc039774b101701ce3aba?family=CircularStd-Book" rel="stylesheet">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Chivo:ital,wght@1,900&display=swap" rel="stylesheet">
        <link href="https://use.fontawesome.com/releases/v5.6.1/css/all.css" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Lato&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    </head>
    <body>
        <div class="headdiv">
            <div class="logodiv">
                <a href="Home.php"><img src="image/weblogo.png" width="40" height="40" alt="logo"></a>
                <h3 class="logofont">&nbsp; CARE PLUS</h3>
            </div>
            <div class="navdiv">
                <span onclick="openNav()" class="openbtn" id="openbtn">&#9776;</span>
            </div>
            <div class="search-container">
                <input type="text" name="name" id="searchInput" placeholder="Search..." class="search-input" onkeypress="handleSearchKeyPress(event)">
                <a href="#" class="search-btn" onclick="performSearch()">
                    <i class="fas fa-search"></i>      
                </a>
            </div>
            <?php
            if (isset($_SESSION['id'])) {
                echo '<div class="lrdiv">';
                echo '<form method="post" style="display: inline;">';
                echo '<button type="submit" name="logout" style="font-size:24px; border: none; background: none;">';
                echo '<i class="fa fa-sign-out"></i>';
                echo '</button>';
                echo '</form>';
                echo '</div>';
            } else {
                echo '<div class="lrdiv">';
                echo '<a href="Login And Register.php" class="loginregister">Login/Register</a>';
                echo '</div>';
            }
            ?>
        </div>
        <div id="nav" class="overlay">
            <span onclick="closeNav()" class="closebtn" id="closebtn">&times;</span>
            <div class="imgmenu">
                <img src="image/medicine.jpg" class="medicineimg" id="medicineimg" alt="medicine">
                <div class="contentOverlay" id="contentOverlay">
                    <div class="dropdown">
                        <a href="javascript:void(0);" class="dropbtn">Health Product</a>
                        <div class="dropdownContent">
                            <a href="Health Product.php#21Century">21 Century</a>
                            <a href="Health Product.php#blackmores">Blackmores</a>
                            <a href="Health Product.php#brands">Brands</a>
                            <a href="Health Product.php#eurobio">Eurobio</a>
                            <a href="Health Product.php#swisse">Swisse</a>
                            <a href="Health Product.php#sitahealth">Vitahealth</a>
                            <a href="Health Product.php#vitamode">Vitamode</a>
                        </div>
                    </div>

                    <a href="Medical Product.php">Medical Product</a>

                    <div class="dropdown">
                        <a href="javascript:void(0);" class="dropbtn">Pharmacy List</a>
                        <div class="dropdownContent">
                            <a href="Pharmacy List.php#perlis">Perlis</a>
                            <a href="Pharmacy List.php#kedah">Kedah</a>
                            <a href="Pharmacy List.php#penang">Penang</a>
                            <a href="Pharmacy List.php#perak">Perak</a>
                            <a href="Pharmacy List.php#selangor">Selangor</a>
                            <a href="Pharmacy List.php#negerisembilan">Negeri Sembilan</a>
                            <a href="Pharmacy List.php#melaka">Melaka</a>
                            <a href="Pharmacy List.php#kelantan">Kelantan</a>
                            <a href="Pharmacy List.php#terengganu">Terengganu</a>
                            <a href="Pharmacy List.php#pahang">Pahang</a>
                            <a href="Pharmacy List.php#johor">Johor</a>
                            <a href="Pharmacy List.php#sabah">Sabah</a>
                            <a href="Pharmacy List.php#sarawak">Sarawak</a>
                        </div>
                    </div>

                    <a href="Booking Form.php">Booking Form</a><br>
                    <a href="Health Tips.php">Health Tips</a><br>
                    <a href="Account Details.php">Account Details</a><br>
                </div>
            </div>
            <p class="slogan">By Your Health Side.</p>
        </div>

        <div id="booking" class="section">
            <div class="section-center">
                <div class="container">
                    <div class="row">
                        <div class="booking-form">
                            <div class="booking-bg">
                                <div class="form-header">
                                    <h2><strong>MAKE YOUR BOOKING</strong></h2>
                                </div>
                            </div>

                            <?php
                            if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['book'])) {
                                $name = $_POST['name'];
                                $ic_number = $_POST['ic_number'];
                                $contact = $_POST['contact'];
                                $state = $_POST['state'];
                                $pharmacy = $_POST['pharmacy'];
                                $date = $_POST['date'];
                                $time = $_POST['time'];

                                if ($dbc = mysqli_connect('localhost', 'root', '', 'careplusdb')) {
                                    $name = mysqli_real_escape_string($dbc, $name);
                                    $ic_number = mysqli_real_escape_string($dbc, $ic_number);
                                    $contact = mysqli_real_escape_string($dbc, $contact);
                                    $state = mysqli_real_escape_string($dbc, $state);
                                    $pharmacy = mysqli_real_escape_string($dbc, $pharmacy);
                                    $date = mysqli_real_escape_string($dbc, $date);
                                    $time = mysqli_real_escape_string($dbc, $time);

                                    // Fetch user_id based on the provided IC number
                                    $userQuery = "SELECT id FROM user WHERE ic_number = '$ic_number'";
                                    $userResult = mysqli_query($dbc, $userQuery);

                                    if ($userResult) {
                                        $userRow = mysqli_fetch_assoc($userResult);

                                        if ($userRow) {
                                            $userId = $userRow['id'];

                                            // Fetch pharmacy_id based on the selected pharmacy
                                            $pharmacyQuery = "SELECT id FROM pharmacy WHERE name = '$pharmacy'";
                                            $pharmacyResult = mysqli_query($dbc, $pharmacyQuery);

                                            if ($pharmacyResult) {
                                                $pharmacyRow = mysqli_fetch_assoc($pharmacyResult);

                                                if ($pharmacyRow) {
                                                    $pharmacyId = $pharmacyRow['id'];

                                                    // Insert booking into 'booking' table
                                                    $bookingQuery = "INSERT INTO booking (name, ic_number, contact, state, pharmacy, date, time, pharmacy_id, user_id) 
                                                                            VALUES ('$name', '$ic_number', '$contact', '$state', '$pharmacy', '$date', '$time', '$pharmacyId', '$userId')";

                                                    if (mysqli_query($dbc, $bookingQuery)) {
                                                        // Get the last inserted booking ID
                                                        $lastBookingId = mysqli_insert_id($dbc);

                                                        // Insert into 'availability' table with 'booking_id' (id will be auto-incremented)
                                                        $availabilityInsertQuery = "INSERT INTO availability (booking_id) VALUES ('$lastBookingId')";

                                                        if (mysqli_query($dbc, $availabilityInsertQuery)) {
                                                            echo '<script>alert("Booking successful!");</script>';
                                                            echo '<script>document.getElementById("bookingForm").reset();</script>';
                                                            echo '<script>window.location.href = "Calendar.php";</script>';
                                                            exit();
                                                        } else {
                                                            echo '<script>alert("Error inserting availability: ' . mysqli_error($dbc) . '");</script>';
                                                        }
                                                    } else {
                                                        echo '<script>alert("Error inserting booking: ' . mysqli_error($dbc) . '");</script>';
                                                    }
                                                } else {
                                                    echo '<script>alert("Pharmacy not found");</script>';
                                                }
                                            } else {
                                                echo '<script>alert("Error fetching pharmacy ID: ' . mysqli_error($dbc) . '");</script>';
                                            }
                                        } else {
                                            echo '<script>alert("User not found");</script>';
                                        }
                                    } else {
                                        echo '<script>alert("Error fetching user ID: ' . mysqli_error($dbc) . '");</script>';
                                    }

                                    mysqli_close($dbc);
                                }
                            }
                            ?>



                            <form onsubmit="return validation(event)" method="post" id="bookingForm">
                                <div class="row">
                                    <div class="form-group">
                                        <span class="form-label">Name</span><br>
                                        <input type="text" id="name" name="name" class="form-control">
                                        <div id="nameErr" class="error"></div>
                                    </div>
                                    <div class="form-group">
                                        <span class="form-label">Contact Number</span><br>
                                        <input type="text" id="contactNumber" name="contact" class="form-control">
                                        <div id="contactNumberErr" class="error"></div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group">
                                        <span class="form-label">Identity Card Number (last 4 digit)</span><br>
                                        <input type="text" id="icNumber" name="ic_number" class="form-control">
                                        <div id="icNumberErr" class="error"></div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group">
                                        <span class="form-label">State</span><br>
                                        <select id="state" name="state" class="form-control" onchange="updatePharmacyOptions()">
                                            <option disabled selected>Select State</option>
                                            <option value="Perlis">Perlis</option>
                                            <option value="Kedah">Kedah</option>
                                            <option value="Penang">Penang</option>
                                            <option value="Perak">Perak</option>
                                            <option value="Selangor">Selangor</option>
                                            <option value="Negeri Sembilan">Negeri Sembilan</option>
                                            <option value="Melaka">Melaka</option>
                                            <option value="Kelantan">Kelantan</option>
                                            <option value="Terengganu">Terengganu</option>
                                            <option value="Pahang">Pahang</option>
                                            <option value="Johor">Johor</option>
                                            <option value="Sabah">Sabah</option>
                                            <option value="Sarawak">Sarawak</option>
                                        </select>
                                        <div id="stateErr" class="error"></div>
                                    </div>

                                    <div class="form-group">
                                        <span class="form-label">Pharmacy</span><br>
                                        <select id="pharmacy" name="pharmacy" class="form-control">
                                            <option disabled selected>Select Pharmacy</option>
                                        </select>
                                        <div id="pharmacyErr" class="error"></div>
                                        <input type="hidden" id="pharmacy_id" name="pharmacy_id" value="">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group">
                                        <span class="form-label">Date</span><br>
                                        <input type="date" id="date" name="date" class="form-control" min="<?php echo date('Y-m-d', strtotime('+1 day')); ?>">
                                        <div id="dateErr" class="error"></div>
                                    </div>
                                    <div class="form-group">
                                        <span class="form-label">Time</span><br>
                                        <input type="time" id="time" name="time" class="form-control" min="08:00" max="18:00">
                                        <div id="timeErr" class="error"></div>
                                    </div>
                                </div>
                                <div class="form-btn">
                                    <button class="submit-btn" name="book">BOOK NOW</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>