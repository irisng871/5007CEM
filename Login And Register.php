<?php
session_start();

if (isset($_SESSION['id'])) {
    header('Location: Home.php');
    exit();
}

$dbc = mysqli_connect('localhost', 'root', '', 'careplusdb');

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['login'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $email = mysqli_real_escape_string($dbc, $email);
    $password = mysqli_real_escape_string($dbc, $password);

    $query = "SELECT * FROM user WHERE email = '$email' AND password = '$password'";

    $result = mysqli_query($dbc, $query);

    if ($result) {
        $user = mysqli_fetch_assoc($result);
        if ($user) {
            $_SESSION['id'] = $user['id'];

            // Check if the email domain is pharmacy.com
            $emailParts = explode('@', $email);
            $domain = end($emailParts);

            if ($domain == 'pharmacy.com') {
                echo '<script>alert("Login successful! Redirecting to the calendar page.");</script>';
                echo '<script>window.location.href = "Pharmacy Calendar.php";</script>';
                exit();
            } else {
                echo '<script>alert("Login successful! Redirecting to the home page.");</script>';
                echo '<script>window.location.href = "Home.php";</script>';
                exit();
            }
        } else {
            echo '<script>alert("Invalid email or password.");</script>';
        }
    } else {
        echo '<script>alert("Error: ' . mysqli_error($dbc) . '");</script>';
    }

    mysqli_close($dbc);
}

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
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Login</title>
        <link href="image/weblogo.png" alt="icon">
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <script src="js/login and register.js"></script>
        <link rel="stylesheet" href="css/Login And Register style.css">
        <link href="https://db.onlinewebfonts.com/c/04d799f9fc4bd0a0973b3331ff889f32?family=Schnyder+Cond+M+Light" rel="stylesheet">
        <link href="https://db.onlinewebfonts.com/c/2d98f490df6dc039774b101701ce3aba?family=CircularStd-Book" rel="stylesheet">
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    </head>
    <body>
        <div class="cotn_principal">
            <div class="cont_centrar">

                <div class="cont_login">
                    <div class="cont_info_log_register">
                        <div class="col_md_login">
                            <div class="cont_ba_opcitiy">
                                <h2>LOGIN</h2>
                                <button class="btn_login" onclick="change_to_login()">LOGIN INTO ACCOUNT</button>
                            </div>
                        </div>
                        <div class="col_md_register">
                            <div class="cont_ba_opcitiy">
                                <h2>REGISTER</h2>
                                <button class="btn_register" onclick="change_to_register()">REGISTER NEW ACCOUNT</button>
                            </div>
                        </div>
                    </div>

                    <div class="cont_back_info">
                        <div class="cont_img_back_grey">
                            <img src="https://c4.wallpaperflare.com/wallpaper/947/583/747/mountain-nature-hd-wallpapers-top-beautiful-desktop-nature-images-background-wallpaper-preview.jpg" alt="background image" />
                        </div>

                    </div>
                    <div class="cont_forms" >
                        <div class="cont_img_back_">
                            <img src="https://c4.wallpaperflare.com/wallpaper/947/583/747/mountain-nature-hd-wallpapers-top-beautiful-desktop-nature-images-background-wallpaper-preview.jpg" alt="background image" />
                        </div>

                        <form onsubmit="return loginValidation(event)" method="post" id="loginForm">
                            <div class="cont_form_login">
                                <a href="#" onclick="hidden_login_and_register()" ><i class="material-icons">&#xE5C4;</i></a>
                                <h2>LOGIN</h2>
                                <input type="text" id="email" name="email" placeholder="Email" />
                                <div id="loginEmailErr" class="loginError"></div>

                                <input type="password" id="password" name="password" placeholder="Password" />
                                <div id="loginPasswordErr" class="loginError"></div>

                                <button class="btn_login" name="login" onclick="loginValidation()">LOGIN</button>
                            </div>
                        </form>

                        <?php
                        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['register'])) {
                            $name = $_POST['name'];
                            $birth_date = $_POST['birth_date'];
                            $ic_number = $_POST['ic_number'];
                            $contact = $_POST['contact'];
                            $email = $_POST['email'];
                            $password = $_POST['password'];

                            if ($dbc = mysqli_connect('localhost', 'root', '', 'careplusdb')) {
                                $name = mysqli_real_escape_string($dbc, $name);
                                $birth_date = mysqli_real_escape_string($dbc, $birth_date);
                                $ic_number = mysqli_real_escape_string($dbc, $ic_number);
                                $contact = mysqli_real_escape_string($dbc, $contact);
                                $email = mysqli_real_escape_string($dbc, $email);
                                $password = mysqli_real_escape_string($dbc, $password);

                                $query = "INSERT INTO user (name, birth_date, ic_number, contact, email, password, category_id) 
                                                VALUES ('$name', '$birth_date', '$ic_number', '$contact', '$email', '$password', '2')";

                                if (mysqli_query($dbc, $query)) {
                                    echo '<script>alert("Registration successful!");</script>';
                                    echo '<script>document.getElementById("registrationForm").reset();</script>';
                                    echo '<script>window.location.href = "Home.php";</script>';
                                    exit();
                                } else {
                                    echo '<script>alert("Error: ' . mysqli_error($dbc) . '");</script>';
                                }

                                mysqli_close($dbc);
                            }
                        }
                        ?>

                        <form onsubmit="return validation(event)" method="post" id="registrationForm">
                            <div class="cont_form_register">
                                <a href="#" onclick="hidden_login_and_register()"><i class="material-icons">&#xE5C4;</i></a>
                                <h2>REGISTER</h2>
                                <input type="text" id="name" name="name" placeholder="Name">
                                <div id="nameErr" class="error"></div>

                                <input type="date" id="birthDate" name="birth_date" placeholder="Birth Date">
                                <div id="birthDateErr" class="error"></div>

                                <input type="text" id="icNumber" name="ic_number" placeholder="Identity Card Number (last 4 digit)">
                                <div id="icNumberErr" class="error"></div>

                                <input type="text" id="contactNumber" name="contact" placeholder="Contact Number">
                                <div id="contactNumberErr" class="error"></div>

                                <input type="text" id="email" name="email" placeholder="Email">
                                <div id="emailErr" class="error"></div>

                                <input type="password" id="password" name="password" placeholder="Password">
                                <div id="passwordErr" class="error"></div>

                                <button class="btn_register" name="register" onclick="validation()">REGISTER</button>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
