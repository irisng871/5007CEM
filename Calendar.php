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
        <title>My Calendar</title>
        <link href="image/weblogo.png" alt="icon">
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="css/Calendar style.css">
        <link href="https://db.onlinewebfonts.com/c/04d799f9fc4bd0a0973b3331ff889f32?family=Schnyder+Cond+M+Light" rel="stylesheet">
        <link href="https://db.onlinewebfonts.com/c/2d98f490df6dc039774b101701ce3aba?family=CircularStd-Book" rel="stylesheet">
        <link href="https://use.fontawesome.com/releases/v5.6.1/css/all.css" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Lato&display=swap" rel="stylesheet">
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

        <?php
        if ($dbc = mysqli_connect('localhost', 'root', '', 'careplusdb')) {
            $user_id = $_SESSION['id'];

            $query = "SELECT
                a.id, a.booking_id,
                    b.state, b.date, b.time,
                    u.id as user_id, u.name as user_name, u.birth_date, u.ic_number as user_ic_number, u.contact as user_contact, u.email,
                    p.id as pharmacy_id, p.name as pharmacy_name, p.address, p.operation_hour, p.contact as pharmacy_contact
                FROM
                    availability a
                    LEFT JOIN 
                        booking b 
                    ON 
                        a.booking_id = b.id
                    LEFT JOIN 
                        user u 
                    ON 
                        b.user_id = u.id
                    LEFT JOIN 
                        pharmacy p 
                    ON 
                    b.pharmacy_id = p.id
            WHERE
                u.id = $user_id";

            $result = mysqli_query($dbc, $query);

            $counter = 0;

            echo '<div class="bookingphar-wrapper">';
            if ($result) {
                while ($row = mysqli_fetch_assoc($result)) {
                    echo '<div class="bookingphar">';
                    echo '<div style="text-align: center; font-weight: bold;">';
                    echo "Availability ID: {$row['id']}<br><br>";
                    echo '</div>';

                    echo '<div style="font-weight: bold;">';
                    echo "Booking Info<br>";
                    echo '</div>';

                    echo "Id: {$row['booking_id']}<br>";
                    echo "Date: {$row['date']}<br>";
                    echo "Time: {$row['time']}<br><br>";

                    echo '<div style="font-weight: bold;">';
                    echo "User Info<br>";
                    echo '</div>';

                    echo "Id: {$row['user_id']}<br>";
                    echo "Name: {$row['user_name']}<br>";
                    echo "Birth Date: {$row['birth_date']}<br>";
                    echo "Ic Number: {$row['user_ic_number']}<br>";
                    echo "Contact: {$row['user_contact']}<br>";
                    echo "Email: {$row['email']}<br><br>";

                    echo '<div style="font-weight: bold;">';
                    echo "Pharmacy Info<br>";
                    echo '</div>';

                    echo "Id: {$row['pharmacy_id']}<br>";
                    echo "Name: {$row['pharmacy_name']}<br>";
                    echo "State: {$row['state']}<br>";
                    echo "Address: {$row['address']}<br>";
                    echo "Operation Hour: {$row['operation_hour']}<br>";
                    echo "Contact: {$row['pharmacy_contact']}<br>";
                    echo '</div>';

                    $counter++;

                    if ($counter % 2 === 0) {
                        echo '</div><div class="bookingphar-wrapper">';
                    }
                }
            } else {
                echo "Error in query: " . mysqli_error($dbc);
            }

            mysqli_close($dbc);
        }
        ?>

    </body>
</html>