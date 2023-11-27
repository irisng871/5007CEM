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
        <title>Pharmacy List</title>
        <link href="image/weblogo.png" alt="icon">
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <script src="js/pharmacy list.js"></script>
        <link rel="stylesheet" href="css/Pharmacy List style.css">
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
                            <a onclick="closeNav(); scrollToPerlis()">Perlis</a>
                            <a onclick="closeNav(); scrollToKedah();">Kedah</a>
                            <a onclick="closeNav(); scrollToPenang()">Penang</a>
                            <a onclick="closeNav(); scrollToPerak()">Perak</a>
                            <a onclick="closeNav(); scrollToSelangor()">Selangor</a>
                            <a onclick="closeNav(); scrollToNegeriSembilan()">Negeri Sembilan</a>
                            <a onclick="closeNav(); scrollToMelaka()">Melaka</a>
                            <a onclick="closeNav(); scrollToKelantan()">Kelantan</a>
                            <a onclick="closeNav(); scrollToTerengganu()">Terengganu</a>
                            <a onclick="closeNav(); scrollToPahang()">Pahang</a>
                            <a onclick="closeNav(); scrollToJohor()">Johor</a>
                            <a onclick="closeNav(); scrollToSabah()">Sabah</a>
                            <a onclick="closeNav(); scrollToSarawak()">Sarawak</a>
                        </div>
                    </div>

                    <a href="Booking Form.php">Booking Form</a><br>
                    <a href="Health Tips.php">Health Tips</a><br>
                    <a href="Account Details.php">Account Details</a><br>
                </div>
            </div>
            <p class="slogan">By Your Health Side.</p>
        </div>

        <div id="perlis"></div>
        <h2>PERLIS</h2><br><br>
        <?php
        if ($dbc = mysqli_connect('localhost', 'root', '', 'careplusdb')) {
            $sql = "SELECT image, name, address, operation_hour, contact, facebook, map FROM pharmacy WHERE category_id=1";
            $result = mysqli_query($dbc, $sql);

            $counter = 0;

            echo '<div class="sideMap">';
            while ($row = mysqli_fetch_assoc($result)) {
                echo '<div>';
                echo '<img width=250 height=250 src="data:image/;base64,' . base64_encode($row['image']) . '" /><br><br>';
                echo '</div>';
                echo '<div class="setWidth">';
                echo "<h3>{$row['name']}</h3>";
                echo "&#128205; {$row['address']}<br><br>";
                echo "&#9200; {$row['operation_hour']}<br><br>";
                echo "&#128222; {$row['contact']}<br><br>";
                echo "{$row['facebook']}";
                echo '</div>';
                echo '<div>';
                echo "{$row['map']}";
                echo '</div>';

                $counter++;

                if ($counter % 1 === 0) {
                    echo '</div><div class="sideMap">';
                }
            }
            echo '</div>';
        }
        ?>


        <div id="kedah"></div>
        <h2>Kedah</h2><br><br>
        <?php
        if ($dbc = mysqli_connect('localhost', 'root', '', 'careplusdb')) {
            $sql = "SELECT image, name, address, operation_hour, contact, facebook, map FROM pharmacy WHERE category_id=2";
            $result = mysqli_query($dbc, $sql);

            $counter = 0;

            echo '<div class="sideMap">';
            while ($row = mysqli_fetch_assoc($result)) {
                echo '<div>';
                echo '<img width=250 height=250 src="data:image/;base64,' . base64_encode($row['image']) . '" /><br><br>';
                echo '</div>';
                echo '<div class="setWidth">';
                echo "<h3>{$row['name']}</h3>";
                echo "&#128205; {$row['address']}<br><br>";
                echo "&#9200; {$row['operation_hour']}<br><br>";
                echo "&#128222; {$row['contact']}<br><br>";
                echo "{$row['facebook']}";
                echo '</div>';
                echo '<div>';
                echo "{$row['map']}";
                echo '</div>';

                $counter++;

                if ($counter % 1 === 0) {
                    echo '</div><div class="sideMap">';
                }
            }
            echo '</div>';
        }
        ?>

        <div id="penang"></div>
        <h2>Penang</h2><br><br>
        <?php
        if ($dbc = mysqli_connect('localhost', 'root', '', 'careplusdb')) {
            $sql = "SELECT image, name, address, operation_hour, contact, facebook, map FROM pharmacy WHERE category_id=3";
            $result = mysqli_query($dbc, $sql);

            $counter = 0;

            echo '<div class="sideMap">';
            while ($row = mysqli_fetch_assoc($result)) {
                echo '<div>';
                echo '<img width=250 height=250 src="data:image/;base64,' . base64_encode($row['image']) . '" /><br><br>';
                echo '</div>';
                echo '<div class="setWidth">';
                echo "<h3>{$row['name']}</h3>";
                echo "&#128205; {$row['address']}<br><br>";
                echo "&#9200; {$row['operation_hour']}<br><br>";
                echo "&#128222; {$row['contact']}<br><br>";
                echo "{$row['facebook']}";
                echo '</div>';
                echo '<div>';
                echo "{$row['map']}";
                echo '</div>';

                $counter++;

                if ($counter % 1 === 0) {
                    echo '</div><div class="sideMap">';
                }
            }
            echo '</div>';
        }
        ?>

        <div id="perak"></div>
        <h2>Perak</h2><br><br>
        <?php
        if ($dbc = mysqli_connect('localhost', 'root', '', 'careplusdb')) {
            $sql = "SELECT image, name, address, operation_hour, contact, facebook, map FROM pharmacy WHERE category_id=4";
            $result = mysqli_query($dbc, $sql);

            $counter = 0;

            echo '<div class="sideMap">';
            while ($row = mysqli_fetch_assoc($result)) {
                echo '<div>';
                echo '<img width=250 height=250 src="data:image/;base64,' . base64_encode($row['image']) . '" /><br><br>';
                echo '</div>';
                echo '<div class="setWidth">';
                echo "<h3>{$row['name']}</h3>";
                echo "&#128205; {$row['address']}<br><br>";
                echo "&#9200; {$row['operation_hour']}<br><br>";
                echo "&#128222; {$row['contact']}<br><br>";
                echo "{$row['facebook']}";
                echo '</div>';
                echo '<div>';
                echo "{$row['map']}";
                echo '</div>';

                $counter++;

                if ($counter % 1 === 0) {
                    echo '</div><div class="sideMap">';
                }
            }
            echo '</div>';
        }
        ?>

        <div id="selangor"></div>
        <h2>Selangor</h2><br><br>
        <?php
        if ($dbc = mysqli_connect('localhost', 'root', '', 'careplusdb')) {
            $sql = "SELECT image, name, address, operation_hour, contact, facebook, map FROM pharmacy WHERE category_id=5";
            $result = mysqli_query($dbc, $sql);

            $counter = 0;

            echo '<div class="sideMap">';
            while ($row = mysqli_fetch_assoc($result)) {
                echo '<div>';
                echo '<img width=250 height=250 src="data:image/;base64,' . base64_encode($row['image']) . '" /><br><br>';
                echo '</div>';
                echo '<div class="setWidth">';
                echo "<h3>{$row['name']}</h3>";
                echo "&#128205; {$row['address']}<br><br>";
                echo "&#9200; {$row['operation_hour']}<br><br>";
                echo "&#128222; {$row['contact']}<br><br>";
                echo "{$row['facebook']}";
                echo '</div>';
                echo '<div>';
                echo "{$row['map']}";
                echo '</div>';

                $counter++;

                if ($counter % 1 === 0) {
                    echo '</div><div class="sideMap">';
                }
            }
            echo '</div>';
        }
        ?>

        <div id="negerisembilan"></div>
        <h2>Negeri Sembilan</h2><br><br>
        <?php
        if ($dbc = mysqli_connect('localhost', 'root', '', 'careplusdb')) {
            $sql = "SELECT image, name, address, operation_hour, contact, facebook, map FROM pharmacy WHERE category_id=6";
            $result = mysqli_query($dbc, $sql);

            $counter = 0;

            echo '<div class="sideMap">';
            while ($row = mysqli_fetch_assoc($result)) {
                echo '<div>';
                echo '<img width=250 height=250 src="data:image/;base64,' . base64_encode($row['image']) . '" /><br><br>';
                echo '</div>';
                echo '<div class="setWidth">';
                echo "<h3>{$row['name']}</h3>";
                echo "&#128205; {$row['address']}<br><br>";
                echo "&#9200; {$row['operation_hour']}<br><br>";
                echo "&#128222; {$row['contact']}<br><br>";
                echo "{$row['facebook']}";
                echo '</div>';
                echo '<div>';
                echo "{$row['map']}";
                echo '</div>';

                $counter++;

                if ($counter % 1 === 0) {
                    echo '</div><div class="sideMap">';
                }
            }
            echo '</div>';
        }
        ?>

        <div id="melaka"></div>
        <h2>Melaka</h2><br><br>
        <?php
        if ($dbc = mysqli_connect('localhost', 'root', '', 'careplusdb')) {
            $sql = "SELECT image, name, address, operation_hour, contact, facebook, map FROM pharmacy WHERE category_id=7";
            $result = mysqli_query($dbc, $sql);

            $counter = 0;

            echo '<div class="sideMap">';
            while ($row = mysqli_fetch_assoc($result)) {
                echo '<div>';
                echo '<img width=250 height=250 src="data:image/;base64,' . base64_encode($row['image']) . '" /><br><br>';
                echo '</div>';
                echo '<div class="setWidth">';
                echo "<h3>{$row['name']}</h3>";
                echo "&#128205; {$row['address']}<br><br>";
                echo "&#9200; {$row['operation_hour']}<br><br>";
                echo "&#128222; {$row['contact']}<br><br>";
                echo "{$row['facebook']}";
                echo '</div>';
                echo '<div>';
                echo "{$row['map']}";
                echo '</div>';

                $counter++;

                if ($counter % 1 === 0) {
                    echo '</div><div class="sideMap">';
                }
            }
            echo '</div>';
        }
        ?>

        <div id="kelantan"></div>
        <h2>Kelantan</h2><br><br>
        <?php
        if ($dbc = mysqli_connect('localhost', 'root', '', 'careplusdb')) {
            $sql = "SELECT image, name, address, operation_hour, contact, facebook, map FROM pharmacy WHERE category_id=8";
            $result = mysqli_query($dbc, $sql);

            $counter = 0;

            echo '<div class="sideMap">';
            while ($row = mysqli_fetch_assoc($result)) {
                echo '<div>';
                echo '<img width=250 height=250 src="data:image/;base64,' . base64_encode($row['image']) . '" /><br><br>';
                echo '</div>';
                echo '<div class="setWidth">';
                echo "<h3>{$row['name']}</h3>";
                echo "&#128205; {$row['address']}<br><br>";
                echo "&#9200; {$row['operation_hour']}<br><br>";
                echo "&#128222; {$row['contact']}<br><br>";
                echo "{$row['facebook']}";
                echo '</div>';
                echo '<div>';
                echo "{$row['map']}";
                echo '</div>';

                $counter++;

                if ($counter % 1 === 0) {
                    echo '</div><div class="sideMap">';
                }
            }
            echo '</div>';
        }
        ?>

        <div id="terengganu"></div>
        <h2>Terengganu</h2><br><br>
        <?php
        if ($dbc = mysqli_connect('localhost', 'root', '', 'careplusdb')) {
            $sql = "SELECT image, name, address, operation_hour, contact, facebook, map FROM pharmacy WHERE category_id=9";
            $result = mysqli_query($dbc, $sql);

            $counter = 0;

            echo '<div class="sideMap">';
            while ($row = mysqli_fetch_assoc($result)) {
                echo '<div>';
                echo '<img width=250 height=250 src="data:image/;base64,' . base64_encode($row['image']) . '" /><br><br>';
                echo '</div>';
                echo '<div class="setWidth">';
                echo "<h3>{$row['name']}</h3>";
                echo "&#128205; {$row['address']}<br><br>";
                echo "&#9200; {$row['operation_hour']}<br><br>";
                echo "&#128222; {$row['contact']}<br><br>";
                echo "{$row['facebook']}";
                echo '</div>';
                echo '<div>';
                echo "{$row['map']}";
                echo '</div>';

                $counter++;

                if ($counter % 1 === 0) {
                    echo '</div><div class="sideMap">';
                }
            }
            echo '</div>';
        }
        ?>

        <div id="pahang"></div>
        <h2>Pahang</h2><br><br>
        <?php
        if ($dbc = mysqli_connect('localhost', 'root', '', 'careplusdb')) {
            $sql = "SELECT image, name, address, operation_hour, contact, facebook, map FROM pharmacy WHERE category_id=10";
            $result = mysqli_query($dbc, $sql);

            $counter = 0;

            echo '<div class="sideMap">';
            while ($row = mysqli_fetch_assoc($result)) {
                echo '<div>';
                echo '<img width=250 height=250 src="data:image/;base64,' . base64_encode($row['image']) . '" /><br><br>';
                echo '</div>';
                echo '<div class="setWidth">';
                echo "<h3>{$row['name']}</h3>";
                echo "&#128205; {$row['address']}<br><br>";
                echo "&#9200; {$row['operation_hour']}<br><br>";
                echo "&#128222; {$row['contact']}<br><br>";
                echo "{$row['facebook']}";
                echo '</div>';
                echo '<div>';
                echo "{$row['map']}";
                echo '</div>';

                $counter++;

                if ($counter % 1 === 0) {
                    echo '</div><div class="sideMap">';
                }
            }
            echo '</div>';
        }
        ?>

        <div id="johor"></div>
        <h2>Johor</h2><br><br>
        <?php
        if ($dbc = mysqli_connect('localhost', 'root', '', 'careplusdb')) {
            $sql = "SELECT image, name, address, operation_hour, contact, facebook, map FROM pharmacy WHERE category_id=11";
            $result = mysqli_query($dbc, $sql);

            $counter = 0;

            echo '<div class="sideMap">';
            while ($row = mysqli_fetch_assoc($result)) {
                echo '<div>';
                echo '<img width=250 height=250 src="data:image/;base64,' . base64_encode($row['image']) . '" /><br><br>';
                echo '</div>';
                echo '<div class="setWidth">';
                echo "<h3>{$row['name']}</h3>";
                echo "&#128205; {$row['address']}<br><br>";
                echo "&#9200; {$row['operation_hour']}<br><br>";
                echo "&#128222; {$row['contact']}<br><br>";
                echo "{$row['facebook']}";
                echo '</div>';
                echo '<div>';
                echo "{$row['map']}";
                echo '</div>';

                $counter++;

                if ($counter % 1 === 0) {
                    echo '</div><div class="sideMap">';
                }
            }
            echo '</div>';
        }
        ?>

        <div id="sabah"></div>
        <h2>Sabah</h2><br><br>
        <?php
        if ($dbc = mysqli_connect('localhost', 'root', '', 'careplusdb')) {
            $sql = "SELECT image, name, address, operation_hour, contact, facebook, map FROM pharmacy WHERE category_id=12";
            $result = mysqli_query($dbc, $sql);

            $counter = 0;

            echo '<div class="sideMap">';
            while ($row = mysqli_fetch_assoc($result)) {
                echo '<div>';
                echo '<img width=250 height=250 src="data:image/;base64,' . base64_encode($row['image']) . '" /><br><br>';
                echo '</div>';
                echo '<div class="setWidth">';
                echo "<h3>{$row['name']}</h3>";
                echo "&#128205; {$row['address']}<br><br>";
                echo "&#9200; {$row['operation_hour']}<br><br>";
                echo "&#128222; {$row['contact']}<br><br>";
                echo "{$row['facebook']}";
                echo '</div>';
                echo '<div>';
                echo "{$row['map']}";
                echo '</div>';

                $counter++;

                if ($counter % 1 === 0) {
                    echo '</div><div class="sideMap">';
                }
            }
            echo '</div>';
        }
        ?>

        <div id="sarawak"></div>
        <h2>Sarawak</h2>
        <?php
        if ($dbc = mysqli_connect('localhost', 'root', '', 'careplusdb')) {
            $sql = "SELECT image, name, address, operation_hour, contact, facebook, map FROM pharmacy WHERE category_id=13";
            $result = mysqli_query($dbc, $sql);

            $counter = 0;

            echo '<div class="sideMap">';
            while ($row = mysqli_fetch_assoc($result)) {
                echo '<div>';
                echo '<img width=250 height=250 src="data:image/;base64,' . base64_encode($row['image']) . '" /><br><br>';
                echo '</div>';
                echo '<div class="setWidth">';
                echo "<h3>{$row['name']}</h3>";
                echo "&#128205; {$row['address']}<br><br>";
                echo "&#9200; {$row['operation_hour']}<br><br>";
                echo "&#128222; {$row['contact']}<br><br>";
                echo "{$row['facebook']}";
                echo '</div>';
                echo '<div>';
                echo "{$row['map']}";
                echo '</div>';

                $counter++;

                if ($counter % 1 === 0) {
                    echo '</div><div class="sideMap">';
                }
            }
            echo '</div>';
        }
        ?>
    </body>
</html>
