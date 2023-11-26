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
        <title>Home</title>
        <link href="image/weblogo.png" alt="icon">
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <script src="js/home.js"></script>
        <link rel="stylesheet" href="css/Home style.css">
        <link href="https://db.onlinewebfonts.com/c/04d799f9fc4bd0a0973b3331ff889f32?family=Schnyder+Cond+M+Light" rel="stylesheet">
        <link href="https://db.onlinewebfonts.com/c/2d98f490df6dc039774b101701ce3aba?family=CircularStd-Book" rel="stylesheet">
        <link href="https://db.onlinewebfonts.com/c/7d12ca843dd31fca4367d8f2fea2dc65?family=Emotional+Rescue" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Play" rel="stylesheet">
        <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css">
        <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
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
    </div>
</div>
</div>
<div id="nav" class="overlay">
    <span onclick="closeNav()" class="closebtn" id="closebtn">&times;</span>
    <div class="imgmenu">
        <img src="image/medicine.jpg" class="medicineimg" id="medicineimg" alt="medicine">
        <div class="contentOverlay" id="contentOverlay">
            <div class="dropdown">
                <a href="#" class="dropbtn">Health Product</a>
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
                <a href="#" class="dropbtn">Pharmacy List</a>
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

<div class="blog-slider">
    <div class="blog-slider__wrp swiper-wrapper">
        <div class="blog-slider_item swiper-slide">
            <div class="blog-slider_img">
                <img src="image\health product\21st century product\21st century logo.png" alt="21st century logo">
            </div>
            <div class="blog-slider_content">
                <div class="blog-slider_title">About 21 Century</div>
                <div class="blog-slider_text">
                    The 21st Century brand is synonymous with health and nutrition. Apart from being Malaysia’s No.1 health supplement brand, we are also one of the most recognized international vitamin brands. 
                    21st Century products are made with everyone in mind.At 21st Century, we care about you and your family’s health at all stages of life. 
                    We are committed to providing you with vitamins and nutritional supplements of unrivalled excellence using only the finest ingredients.
                    When you buy 21st Century, you are guaranteed unsurpassed quality and value.
                    At 21ST Century HealthCare, we have a reputation for our dedication to quality. Our state-of-the-art facilities located in Tempe, 
                    Arizona are cGMP compliant and adhere to the strict FDA standards for dietary and nutritional supplement manufacturing.
                    In short, you are guaranteed that the over 500 wellness products we manufacture at 21ST Century HealthCare are trusted to be 100% safe, contain the purest ingredients and are guaranteed for label potency.
                </div>
            </div>
        </div>
        <div class="blog-slider_item swiper-slide">
            <div class="blog-slider_img">
                <img src="image\health product\blackmores product\blackmores logo.png" alt="blackmores logo">
            </div>
            <div class="blog-slider_content">
                <div class="blog-slider_title">About Blackmores</div>
                <div class="blog-slider_text">
                    Blackmores is Australia's leading natural health company. Our quality range of vitamin, minerals, herbal and nutritional supplements, 
                    and continued support of the community and environment, are among the many reasons Blackmores is the most trusted name in natural health.
                    At Blackmores we never compromise on quality, always placing the health and safety of our consumers at the heart of our business. 
                    We use premium ingredients from around the world, with products made to strict Australian manufacturing standards and more than 30 rigorous quality checks.
                    Blackmores' extensive range of vitamins, minerals, herbal and nutritional supplements is developed by in-house experts using high quality ingredients from around the world and made to exacting requirements 
                    under the international Pharmaceutical Inspection Convention and Pharmaceutical Inspection Cooperation Scheme (PIC/s) standards of good manufacturing practice (GMP) in accordance with Australian requirements.
                </div>
            </div>
        </div>
        <div class="blog-slider_item swiper-slide">
            <div class="blog-slider_img">
                <img src="image\health product\brands product\brands logo.png" alt="brands logo">
            </div>
            <div class="blog-slider_content">
                <div class="blog-slider_title">About Brands</div>
                <div class="blog-slider_text">
                    BRAND'S® Research Centre was established in 2010 to continue its commitment to research and development. The centre conducts scientific research to prove the efficacy of BRAND'S® products for overall health. 
                    Unlike other health food companies, BRAND'S® goes beyond proving product efficacy and focuses on discovering the mechanisms behind their products. Equipped with state-of-the-art facilities and cutting-edge technology, the centre can conduct biochemical, cellular, and clinical research. 
                    The investments in scientific and clinical research have yielded substantial results, particularly in proving the efficacy of BRAND'S® Essence of Chicken and its possible mechanisms. 
                    The BRAND'S® Essence of Chicken is the only scientifically proven product of its kind, documented in over 40 scientific journals published in collaboration with scientists from various universities.
                </div>
            </div>
        </div>
        <div class="blog-slider_item swiper-slide">
            <div class="blog-slider_img">
                <img src="image\health product\eurobio product\eurobio logo.png" alt="eurobio logo">
            </div>
            <div class="blog-slider_content">
                <div class="blog-slider_title">About Eurobio</div>
                <div class="blog-slider_text">
                    Eurobio began with a simple purpose – to enable you, our consumers to lead an enhanced and healthier lifestyle.
                    So that you can live your best life. Without any setback, without any worry.
                    We’re more than just a health provider – we look at ourselves as your health partner. One that truly understands our consumers’ everyday pain points through deep understanding and knowledge.
                    Putting your well-being first, we use only quality ingredients and superior formulations from reliable sources. You’ll be reassured with noticeable results.
                    We want to empower healthy living as a choice through quality and accessible health solutions. At Eurobio, we believe health is best empowered, not dispensed.
                    As a company under Medipharm, all our products are approved and registered with the National Pharmaceutical Regulatory Agency (NPRA), while adhering to the World Health Organization current Good Manufacturing Practice.
                </div>
            </div>
        </div>
        <div class="blog-slider_item swiper-slide">
            <div class="blog-slider_img">
                <img src="image\health product\swisse product\swisse logo.png" alt="swisse logo">
            </div>
            <div class="blog-slider_content">
                <div class="blog-slider_title">About Swisse</div>
                <div class="blog-slider_text">
                    The Swisse vitamin and supplement product range caters to all stages of life – from pre-conception supplements for men and women, to infants, children, teenagers and adults of various ages to the elderly. Swisse Ultivite multivitamin products are unique in that they were the first products targeted to gender and specific age ranges globally.
                    Swisse drives product innovation from its global headquarters in Melbourne, maintaining a laser focus on quality. In recent years it has released products in a number of consumption formats, such as liquids, vegetarian-friendly capsules, dissolvable powders and effervescents with natural fruit flavourings, to reflect various consumers’ preferences. 
                    Swisse aims to avoid added sugars, and work to ensure products are as ‘clean’ as possible in formulating for bioavailability and minimising excipients.
                    Swisse has also recently released a product range combining probiotics, nutrients, and herbs, as well as a range using Australian hemp seed oil, which the company believes "will play an important role in the delivery of incremental growth for Swisse ANZ in 2020."
                </div>
            </div>
        </div>
        <div class="blog-slider_item swiper-slide">
            <div class="blog-slider_img">
                <img src="image\health product\vitahealth product\vitahealth logo.png" alt="vitahealth logo">
            </div>
            <div class="blog-slider_content">
                <div class="blog-slider_title">About Vitahealth</div>
                <div class="blog-slider_text">
                    VitaHealth understands that looking good and feeling great are priorities, which makes us passionate about helping you vitalise and transform yourself in a way that works for you. 
                    Our nutritional products are specially formulated to cater to your individual needs, from inner wellness to outer radiance.
                    They are backed by scientific expertise and 75 years of international experience in nutritional health. Furthermore, 
                    our helpful wellness programmes seek to enhance your health with recommendations and tips on balanced eating and energising physical activities.
                    There is only one life and each day is a gift to a healthy body and mind. Make the most of every moment, revitalise your health and charge up your life with us.
                </div>
            </div>
        </div>
        <div class="blog-slider_item swiper-slide">
            <div class="blog-slider_img">
                <img src="image\health product\vitamode product\vitamode logo.png" alt="vitamode logo">
            </div>
            <div class="blog-slider_content">
                <div class="blog-slider_title">About Vitamode</div>
                <div class="blog-slider_text">
                    Since 2012, we've been researching, innovating and developing our comprehensive
                    line of products that span across a wide range of health functions. We take high standards seriously. Over the last 9 years, we have collaborated with some of the world's best research
                    laboratories to develop premium supplements backed by verifiable science. As such, both healthcare practitioners
                    and consumers always know they are getting supplements that they can feel good about and feel good from. We create supplements that are potent and sustainable. All of our formulas are backed
                    by research to reach the highest efficacy to meet your body's nutritional needs. You deserve to live a happy, healthy life. And we're here to support you on that journey
                    today and beyond. From innovative nutritional concepts to expert guidance, we promise
                    to become your definition of trusted quality with products that are backed by verifiable
                    science and validated by experts.
                </div>
            </div>
        </div>
    </div>
    <div class="blog-slider__pagination"></div>
</div>
</body>
</html>
