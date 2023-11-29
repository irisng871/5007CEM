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
        <title>Health Tips</title>
        <link href="image/weblogo.png" alt="icon">
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <script src="js/health tips.js"></script>
        <link rel="stylesheet" href="css/Health Tips style.css">
        <link href="https://db.onlinewebfonts.com/c/04d799f9fc4bd0a0973b3331ff889f32?family=Schnyder+Cond+M+Light" rel="stylesheet">
        <link href="https://db.onlinewebfonts.com/c/2d98f490df6dc039774b101701ce3aba?family=CircularStd-Book" rel="stylesheet">
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

        <h2>Health Tips</h2><br><br>

        <div class="container">
            <div class="media media-news">
                <div class="media-img">
                    <img src="https://www.bigpharmacy.com.my/site_media/img/banners/3_Health_Benefits_of_Vitamin_A__Cover_20220707140617_20220811155017.jpg" width="350" height="250" alt="Generic placeholder image">
                </div>
                <div class="media-body">
                    <span class="media-date">5 October 2023</span>
                    <h3>3 Health Benefits of Vitamin A</h3>
                    <p>
                        Vitamin A, an essential fat-soluble vitamin, plays a crucial role in various bodily functions, including vision, immune system support, and skin health. Metabolized into different forms, 
                        such as retinol and retinoic acid, vitamin A is vital for optimal bodily functions. Men are recommended to consume 900 mcg, while women should aim for 700 mcg daily, either through supplements or a balanced diet.
                        <br><br>
                        One primary benefit of vitamin A is its protective role in maintaining eye health. Critical for the function of rods, which are essential for low-light conditions, vitamin A deficiency can lead to night blindness. 
                        Adequate vitamin A levels can alleviate poor night vision symptoms. Additionally, vitamin A is pivotal in supporting a robust immune system. Research indicates that individuals with vitamin A deficiency are more susceptible to infections and experience slower recovery from illnesses.
                        <br><br>
                        Furthermore, vitamin A contributes to skin health, particularly in addressing acne concerns. Research suggests that vitamin A deficiency may increase the likelihood of developing acne. 
                        Some prescription medications for acne are derived from vitamin A, and when used topically, it induces an anti-inflammatory effect, effectively treating the condition. 
                        Stronger oral forms are available but require consultation with a healthcare professional. To harness the full benefits of vitamin A, it is essential to maintain an adequate intake through a well-rounded diet or supplementation.
                        <br><br>
                    </p>
                </div>
            </div>
            <div class="media media-news">
                <div class="media-img">
                    <img src="https://www.bigpharmacy.com.my/site_media/img/banners/Stomach_Pain_Cover_20220704100317_20220705161209.jpg" width="350" height="250" alt="Generic placeholder image">
                </div>
                <div class="media-body">
                    <span class="media-date">21 October 2023</span>
                    <h3>Stomach Pain: Potential Causes and Treatments</h3>
                    <p>
                        Stomach pain is a common ailment that everyone experiences at some point in their lives, often stemming from various causes such as indigestion or overeating. 
                        Surprisingly, approximately one-third of adult patients find it challenging to pinpoint the exact underlying cause of their abdominal pain. 
                        If you find yourself uncertain about the origin of your stomach pain, a comprehensive guide exploring potential causes and treatments could provide valuable insights.
                        <br><br>
                        Stomach pain, although often referred to as such, may originate from organs within the gastrointestinal system, including the small intestine, large intestine, and liver. 
                        The discomfort can manifest in different ways, described as burning, aching, crampy, or sharp, depending on the nature of the cause. 
                        One prevalent cause is stomach acid issues, leading to conditions like acid reflux and potentially developing into gastroesophageal reflux disease (GERD). Symptoms include heartburn, a sour taste in the mouth, and bloating, typically after eating. Lifestyle changes, such as quitting smoking, maintaining a healthy weight, and dietary adjustments, along with medications, can effectively manage GERD.
                        <br><br>
                        Another common cause of stomach pain is food poisoning, resulting from the consumption of contaminated or spoiled food. Symptoms vary in onset and severity, with fever, stomach cramps, diarrhea, and nausea being common indicators.
                        Hydration is crucial during episodes of food poisoning, and electrolyte drinks or hydration salts are recommended. Over-the-counter medications like anti-diarrheals may alleviate symptoms, but in severe cases, medical attention and possible antibiotic treatment may be necessary.
                        <br><br>
                        In conclusion, while stomach pains are a normal part of life, understanding their causes is essential for appropriate management. Recognizable causes like food poisoning and acid reflux are treatable with lifestyle adjustments and medications. 
                        However, mysterious or more sinister causes require consultation with healthcare providers. Seeking guidance from healthcare professionals or visiting a doctor or pharmacist when in doubt ensures proper diagnosis and treatment for stomach-related concerns.
                        <br><br>
                    </p>
                </div>
            </div>
            <div class="media media-news">
                <div class="media-img">
                    <img src="https://www.bigpharmacy.com.my/site_media/img/banners/3_tips_to_prevent_osteoporosis_Cover_20221028164557.jpg" width="350" height="250" alt="Generic placeholder image">
                </div>
                <div class="media-body">
                    <span class="media-date">15 November 2023</span>
                    <h3>3 Tips To Prevent Bone Loss or Osteporosis</h3>
                    <p>
                        Osteoporosis, a symptomless yet debilitating condition, weakens bones and makes them prone to fractures even with minor incidents like a fall or cough. Prevention is crucial, and three key tips can help mitigate the risk of bone loss. Firstly, taking Vitamin D and calcium supplements is vital for bone formation, with the recommended daily intake being 1000mg/day for men and 1200mg/day for women. 
                        Vitamin D aids calcium absorption, but it's advisable to consult a pharmacist or doctor before starting any supplement regimen. Secondly, engaging in weight-bearing exercises, including bodyweight activities like squats and resistance training with weights, is essential for maintaining bone health. 
                        Finally, periodic bone density tests, especially for individuals with risk factors such as vitamin D deficiency or previous fractures, are crucial for early detection and intervention. These tests are recommended for women aged 65 and above, men aged 70 and above, women aged 50-64, and men aged 50-69 with identified risk factors. Seeking advice from healthcare professionals is key to effective osteoporosis prevention.
                        <br><br>
                    </p>
                </div>
            </div>
            <div class="media media-news">
                <div class="media-img">
                    <img src="https://www.bigpharmacy.com.my/site_media/img/banners/Visual_1_20220909101224.jpg" width="350" height="250" alt="Generic placeholder image">
                </div>
                <div class="media-body">
                    <span class="media-date">23 November 2023</span>
                    <h3>Pneumonia or Bad Cold? Be clear on this!</h3>
                    <p>
                        Pneumonia is a serious lung infection, distinct from a common cold, often caused by bacteria and requiring immediate medical attention due to inflammation and fluid buildup in the lungs. Its severity ranges from mild to life-threatening, contrasting with the self-limiting nature of the common cold caused by viruses. 
                        Symptoms vary in intensity, including chest pain, persistent cough with phlegm, nausea, shortness of breath, fatigue, fever, and confusion in older adults. 
                        Infants may exhibit symptoms such as vomiting, fever, restlessness, and difficulty breathing. Risk factors include advanced age, particularly for those over 65, and vulnerability in infants and young children. 
                        Prevention involves practicing good hygiene, avoiding smoking, and maintaining a strong immune system through adequate sleep, regular exercise, and a healthy diet. Pneumonia, with its potential seriousness, requires expert advice for accurate diagnosis and timely treatment, discouraging self-diagnosis that may cause delays. 
                        Seeking guidance from healthcare professionals or consulting pharmacists, like those at BIG Pharmacy, is essential for related health concerns. In summary, pneumonia demands vigilant attention, and uncertainty about an illness should prompt immediate expert consultation to avoid treatment delays.
                        <br><br>
                    </p>
                </div>
            </div>
        </div>
    </body>
</html>
