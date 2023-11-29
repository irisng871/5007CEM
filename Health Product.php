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
        <title>Health Product</title>
        <link href="image/weblogo.png" alt="icon">
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <script src="js/health product.js"></script>
        <link rel="stylesheet" href="css/Health Product style.css">
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
                            <a onclick="closeNav(); scrollTo21Century()">21 Century</a>
                            <a onclick="closeNav(); scrollToBlackmores()">Blackmores</a>
                            <a onclick="closeNav(); scrollToBrands()">Brands</a>
                            <a onclick="closeNav(); scrollToEurobio()">Eurobio</a>
                            <a onclick="closeNav(); scrollToSwisse()">Swisse</a>
                            <a onclick="closeNav(); scrollToVitahealth()">Vitahealth</a>
                            <a onclick="closeNav(); scrollToVitamode()">Vitamode</a>
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

        <div id="21century"></div>
        <h2>21 Century</h2>
        <?php
        if ($dbc = mysqli_connect('localhost', 'root', '', 'careplusdb')) {
            $sql = "SELECT name, image, ingredient, directions FROM healthProduct WHERE category_id=1";
            $result = mysqli_query($dbc, $sql);

            $counter = 0;

            echo '<div class="main-container-wrapper">';

            while ($row = mysqli_fetch_assoc($result)) {
                echo '<div class="main-container">';

                // Display name
                echo '<div>';
                echo "<h3 class='productHeader'>{$row['name']}</h3>";
                echo '</div>';

                // Display image
                echo '<div class="hpimg">';
                echo '<img width="250" height="300" src="data:image/;base64,' . base64_encode($row['image']) . '" />';
                echo '</div>';

                // Display ingredient
                echo '<div class="coll-container">';
                echo '<div class="coll-header">';
                echo '<button class="containerButton">+</button>';
                echo '<b>Ingredient</b>';
                echo '</div>';
                echo '<div class="coll-content">';
                echo '<div class="coll-item">';
                echo "<p>{$row['ingredient']}</p>";
                echo '</div>';
                echo '</div>';
                echo '</div>';

                // Display directions
                echo '<div class="coll-container">';
                echo '<div class="coll-header">';
                echo '<button class="containerButton">+</button>';
                echo '<b>Directions</b>';
                echo '</div>';
                echo '<div class="coll-content">';
                echo '<div class="coll-item">';
                echo "<p>{$row['directions']}</p>";
                echo '</div>';
                echo '</div>';
                echo '</div>';

                echo '</div>';

                $counter++;

                if ($counter % 3 === 0) {
                    echo '</div><div class="main-container-wrapper">';
                }
            }

            echo '</div>';
        }
        ?>

        <div id="blackmores"></div>
        <h2>Blackmores</h2>
        <?php
        if ($dbc = mysqli_connect('localhost', 'root', '', 'careplusdb')) {
            $sql = "SELECT name, image, ingredient, directions FROM healthProduct WHERE category_id=2";
            $result = mysqli_query($dbc, $sql);

            $counter = 0;

            echo '<div class="main-container-wrapper">';

            while ($row = mysqli_fetch_assoc($result)) {
                echo '<div class="main-container">';

                // Display name
                echo '<div>';
                echo "<h3 class='productHeader'>{$row['name']}</h3>";
                echo '</div>';

                // Display image
                echo '<div class="hpimg">';
                echo '<img width="250" height="300" src="data:image/;base64,' . base64_encode($row['image']) . '" />';
                echo '</div>';

                // Display ingredient
                echo '<div class="coll-container">';
                echo '<div class="coll-header">';
                echo '<button class="containerButton">+</button>';
                echo '<b>Ingredient</b>';
                echo '</div>';
                echo '<div class="coll-content">';
                echo '<div class="coll-item">';
                echo "<p>{$row['ingredient']}</p>";
                echo '</div>';
                echo '</div>';
                echo '</div>';

                // Display directions
                echo '<div class="coll-container">';
                echo '<div class="coll-header">';
                echo '<button class="containerButton">+</button>';
                echo '<b>Directions</b>';
                echo '</div>';
                echo '<div class="coll-content">';
                echo '<div class="coll-item">';
                echo "<p>{$row['directions']}</p>";
                echo '</div>';
                echo '</div>';
                echo '</div>';

                echo '</div>';

                $counter++;

                if ($counter % 3 === 0) {
                    echo '</div><div class="main-container-wrapper">';
                }
            }

            echo '</div>';
        }
        ?>

        <div id="brands"></div>
        <h2>Brands</h2>
        <?php
        if ($dbc = mysqli_connect('localhost', 'root', '', 'careplusdb')) {
            $sql = "SELECT name, image, ingredient, directions FROM healthProduct WHERE category_id=3";
            $result = mysqli_query($dbc, $sql);

            $counter = 0;

            echo '<div class="main-container-wrapper">';

            while ($row = mysqli_fetch_assoc($result)) {
                echo '<div class="main-container">';

                // Display name
                echo '<div>';
                echo "<h3 class='productHeader'>{$row['name']}</h3>";
                echo '</div>';

                // Display image
                echo '<div class="hpimg">';
                echo '<img width="250" height="300" src="data:image/;base64,' . base64_encode($row['image']) . '" />';
                echo '</div>';

                // Display ingredient
                echo '<div class="coll-container">';
                echo '<div class="coll-header">';
                echo '<button class="containerButton">+</button>';
                echo '<b>Ingredient</b>';
                echo '</div>';
                echo '<div class="coll-content">';
                echo '<div class="coll-item">';
                echo "<p>{$row['ingredient']}</p>";
                echo '</div>';
                echo '</div>';
                echo '</div>';

                // Display directions
                echo '<div class="coll-container">';
                echo '<div class="coll-header">';
                echo '<button class="containerButton">+</button>';
                echo '<b>Directions</b>';
                echo '</div>';
                echo '<div class="coll-content">';
                echo '<div class="coll-item">';
                echo "<p>{$row['directions']}</p>";
                echo '</div>';
                echo '</div>';
                echo '</div>';

                echo '</div>';

                $counter++;

                if ($counter % 3 === 0) {
                    echo '</div><div class="main-container-wrapper">';
                }
            }

            echo '</div>';
        }
        ?>

        <div id="eurobio"></div>
        <h2>Eurobio</h2>
        <?php
        if ($dbc = mysqli_connect('localhost', 'root', '', 'careplusdb')) {
            $sql = "SELECT name, image, ingredient, directions FROM healthProduct WHERE category_id=4";
            $result = mysqli_query($dbc, $sql);

            $counter = 0;

            echo '<div class="main-container-wrapper">';

            while ($row = mysqli_fetch_assoc($result)) {
                echo '<div class="main-container">';

                // Display name
                echo '<div>';
                echo "<h3 class='productHeader'>{$row['name']}</h3>";
                echo '</div>';

                // Display image
                echo '<div class="hpimg">';
                echo '<img width="250" height="300" src="data:image/;base64,' . base64_encode($row['image']) . '" />';
                echo '</div>';

                // Display ingredient
                echo '<div class="coll-container">';
                echo '<div class="coll-header">';
                echo '<button class="containerButton">+</button>';
                echo '<b>Ingredient</b>';
                echo '</div>';
                echo '<div class="coll-content">';
                echo '<div class="coll-item">';
                echo "<p>{$row['ingredient']}</p>";
                echo '</div>';
                echo '</div>';
                echo '</div>';

                // Display directions
                echo '<div class="coll-container">';
                echo '<div class="coll-header">';
                echo '<button class="containerButton">+</button>';
                echo '<b>Directions</b>';
                echo '</div>';
                echo '<div class="coll-content">';
                echo '<div class="coll-item">';
                echo "<p>{$row['directions']}</p>";
                echo '</div>';
                echo '</div>';
                echo '</div>';

                echo '</div>';

                $counter++;

                if ($counter % 3 === 0) {
                    echo '</div><div class="main-container-wrapper">';
                }
            }

            echo '</div>';
        }
        ?>

        <div id="swisse"></div>
        <h2>Swisse</h2>
        <?php
        if ($dbc = mysqli_connect('localhost', 'root', '', 'careplusdb')) {
            $sql = "SELECT name, image, ingredient, directions FROM healthProduct WHERE category_id=5";
            $result = mysqli_query($dbc, $sql);

            $counter = 0;

            echo '<div class="main-container-wrapper">';

            while ($row = mysqli_fetch_assoc($result)) {
                echo '<div class="main-container">';

                // Display name
                echo '<div>';
                echo "<h3 class='productHeader'>{$row['name']}</h3>";
                echo '</div>';

                // Display image
                echo '<div class="hpimg">';
                echo '<img width="250" height="300" src="data:image/;base64,' . base64_encode($row['image']) . '" />';
                echo '</div>';

                // Display ingredient
                echo '<div class="coll-container">';
                echo '<div class="coll-header">';
                echo '<button class="containerButton">+</button>';
                echo '<b>Ingredient</b>';
                echo '</div>';
                echo '<div class="coll-content">';
                echo '<div class="coll-item">';
                echo "<p>{$row['ingredient']}</p>";
                echo '</div>';
                echo '</div>';
                echo '</div>';

                // Display directions
                echo '<div class="coll-container">';
                echo '<div class="coll-header">';
                echo '<button class="containerButton">+</button>';
                echo '<b>Directions</b>';
                echo '</div>';
                echo '<div class="coll-content">';
                echo '<div class="coll-item">';
                echo "<p>{$row['directions']}</p>";
                echo '</div>';
                echo '</div>';
                echo '</div>';

                echo '</div>';

                $counter++;

                if ($counter % 3 === 0) {
                    echo '</div><div class="main-container-wrapper">';
                }
            }

            echo '</div>';
        }
        ?>

        <div id="vitahealth"></div>
        <h2>Vitahealth</h2>
        <?php
        if ($dbc = mysqli_connect('localhost', 'root', '', 'careplusdb')) {
            $sql = "SELECT name, image, ingredient, directions FROM healthProduct WHERE category_id=6";
            $result = mysqli_query($dbc, $sql);

            $counter = 0;

            echo '<div class="main-container-wrapper">';

            while ($row = mysqli_fetch_assoc($result)) {
                echo '<div class="main-container">';

                // Display name
                echo '<div>';
                echo "<h3 class='productHeader'>{$row['name']}</h3>";
                echo '</div>';

                // Display image
                echo '<div class="hpimg">';
                echo '<img width="250" height="300" src="data:image/;base64,' . base64_encode($row['image']) . '" />';
                echo '</div>';

                // Display ingredient
                echo '<div class="coll-container">';
                echo '<div class="coll-header">';
                echo '<button class="containerButton">+</button>';
                echo '<b>Ingredient</b>';
                echo '</div>';
                echo '<div class="coll-content">';
                echo '<div class="coll-item">';
                echo "<p>{$row['ingredient']}</p>";
                echo '</div>';
                echo '</div>';
                echo '</div>';

                // Display directions
                echo '<div class="coll-container">';
                echo '<div class="coll-header">';
                echo '<button class="containerButton">+</button>';
                echo '<b>Directions</b>';
                echo '</div>';
                echo '<div class="coll-content">';
                echo '<div class="coll-item">';
                echo "<p>{$row['directions']}</p>";
                echo '</div>';
                echo '</div>';
                echo '</div>';

                echo '</div>';

                $counter++;

                if ($counter % 3 === 0) {
                    echo '</div><div class="main-container-wrapper">';
                }
            }

            echo '</div>';
        }
        ?>

        <div id="vitamode"></div>
        <h2>Vitamode</h2>
        <?php
        if ($dbc = mysqli_connect('localhost', 'root', '', 'careplusdb')) {
            $sql = "SELECT name, image, ingredient, directions FROM healthProduct WHERE category_id=7";
            $result = mysqli_query($dbc, $sql);

            $counter = 0;

            echo '<div class="main-container-wrapper">';

            while ($row = mysqli_fetch_assoc($result)) {
                echo '<div class="main-container">';

                // Display name
                echo '<div>';
                echo "<h3 class='productHeader'>{$row['name']}</h3>";
                echo '</div>';

                // Display image
                echo '<div class="hpimg">';
                echo '<img width="250" height="300" src="data:image/;base64,' . base64_encode($row['image']) . '" />';
                echo '</div>';

                // Display ingredient
                echo '<div class="coll-container">';
                echo '<div class="coll-header">';
                echo '<button class="containerButton">+</button>';
                echo '<b>Ingredient</b>';
                echo '</div>';
                echo '<div class="coll-content">';
                echo '<div class="coll-item">';
                echo "<p>{$row['ingredient']}</p>";
                echo '</div>';
                echo '</div>';
                echo '</div>';

                // Display directions
                echo '<div class="coll-container">';
                echo '<div class="coll-header">';
                echo '<button class="containerButton">+</button>';
                echo '<b>Directions</b>';
                echo '</div>';
                echo '<div class="coll-content">';
                echo '<div class="coll-item">';
                echo "<p>{$row['directions']}</p>";
                echo '</div>';
                echo '</div>';
                echo '</div>';

                echo '</div>';

                $counter++;

                if ($counter % 3 === 0) {
                    echo '</div><div class="main-container-wrapper">';
                }
            }

            echo '</div>';
        }
        ?>

    </body>
</html>
