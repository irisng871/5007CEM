<?php
session_start();

// If the logout button is clicked
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['logout'])) {
    unset($_SESSION['id']);
    header("Location: home.php");
    exit();
}

// Check if the user is already logged in
if (isset($_SESSION['id'])) {
    // If logged in, retrieve user information based on 'id'
    $dbc = mysqli_connect('localhost', 'root', '', 'careplusdb');

    if (isset($_SESSION['id'])) {
        $user_id = $_SESSION['id'];

        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['save'])) {
            $newName = mysqli_real_escape_string($dbc, $_POST['name']);
            $newContactNumber = mysqli_real_escape_string($dbc, $_POST['contact']);
            $newPassword = mysqli_real_escape_string($dbc, $_POST['password']);

            $updateQuery = "UPDATE user SET name='$newName', contact='$newContactNumber', password='$newPassword' WHERE id=$user_id";
            $updateResult = mysqli_query($dbc, $updateQuery);

            if ($updateResult) {
                echo '<script>alert("Data updated successfully!");</script>';
            } else {
                echo '<script>alert("Error updating data: ' . mysqli_error($dbc) . '");</script>';
            }
        }

        $query = "SELECT * FROM user WHERE id = $user_id";
        $result = mysqli_query($dbc, $query);

        if ($result) {
            $user_info = mysqli_fetch_assoc($result);
            if ($user_info) {
                $userData = array(
                    'name' => $user_info['name'],
                    'birthDate' => $user_info['birth_date'],
                    'icNumber' => $user_info['ic_number'],
                    'contactNumber' => $user_info['contact'],
                    'email' => $user_info['email'],
                    'password' => $user_info['password']
                );
            }
        }
    }
}
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Account Details</title>
        <link href="image/weblogo.png" alt="icon">
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <script src="js/account details.js"></script>
        <link rel="stylesheet" href="css/Account Details style.css">
        <link href="https://db.onlinewebfonts.com/c/04d799f9fc4bd0a0973b3331ff889f32?family=Schnyder+Cond+M+Light" rel="stylesheet">
        <link href="https://db.onlinewebfonts.com/c/2d98f490df6dc039774b101701ce3aba?family=CircularStd-Book" rel="stylesheet">
        <link href="https://use.fontawesome.com/releases/v5.6.1/css/all.css" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Lato&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

        <script>
            function setUserData() {
                document.getElementById("name").value = "<?php echo $userData['name']; ?>";
                document.getElementById("birthDate").value = "<?php echo $userData['birthDate']; ?>";
                document.getElementById("icNumber").value = "<?php echo $userData['icNumber']; ?>";
                document.getElementById("contactNumber").value = "<?php echo $userData['contactNumber']; ?>";
                document.getElementById("email").value = "<?php echo $userData['email']; ?>";
                document.getElementById("password").value = "<?php echo $userData['password']; ?>";
            }

            window.onload = setUserData;
        </script>

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
                                    <h2><strong>ACCOUNT DETAILS</strong></h2>
                                </div>
                            </div>

                            <form onsubmit="return validation(event)" method="post" id="accountDetails">
                                <div class="row">
                                    <div class="form-group">
                                        <span class="form-label">Name</span><br>
                                        <input type="text" id="name" name="name" class="form-control">
                                        <div id="nameErr" class="error"></div>
                                    </div>
                                    <div class="form-group">
                                        <span class="form-label">Birth Date</span><br>
                                        <input type="text" id="birthDate" name="birth_date" class="form-control" style="background-color:#dbdbd5" disabled/>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group">
                                        <span class="form-label">Identity Card Number (last 4 digit)</span><br>
                                        <input type="text" id="icNumber" name="ic_number" class="form-control" style="background-color:#dbdbd5" disabled/>
                                    </div>
                                    <div class="form-group">
                                        <span class="form-label">Contact Number</span><br>
                                        <input type="text" id="contactNumber" name="contact" class="form-control">
                                        <div id="contactNumberErr" class="error"></div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group">
                                        <span class="form-label">Email</span><br>
                                        <input type="text" id="email" name="email" class="form-control" style="background-color:#dbdbd5" disabled/>
                                    </div>
                                    <div class="form-group">
                                        <span class="form-label">Password</span><br>
                                        <input type="text" id="password" name="password" class="form-control">
                                        <div id="passwordErr" class="error"></div>
                                    </div>
                                </div>
                                <div class="form-btn">
                                    <button class="submit-btn" name="save">SAVE</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
