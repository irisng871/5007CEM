function openNav() {
    var nav = document.getElementById("nav");
    var contentOverlay = document.querySelector(".contentOverlay");
    var medicineImg = document.querySelector(".medicineimg");

    // Clone the contentOverlay element, clone means separate copy of original
    var contentOverlayClone = contentOverlay.cloneNode(true);
    var medicineImgClone = medicineImg.cloneNode(true);

    // Replace the original contentOverlay with the cloned element
    contentOverlay.parentNode.replaceChild(contentOverlayClone, contentOverlay);
    medicineImg.parentNode.replaceChild(medicineImgClone, medicineImg);

    nav.style.height = "100%";
}

function closeNav() {
    document.getElementById("nav").style.height = "0%";
}

// Add this function to fetch pharmacy_id based on selected pharmacy name
async function getPharmacyId() {
    const selectedPharmacy = document.getElementById("pharmacy").value;

    try {
        const response = await fetch('http://localhost/5007CEM/public_html/Booking%20Form.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
            },
            body: `pharmacy=${selectedPharmacy}`,
        });
        const data = await response.json();
        return data.pharmacy_id;
    } catch (error) {
        console.error('Error fetching pharmacy ID:', error);
        return null;
    }
}

// Add this function to fetch user ID based on IC number
async function getUserId() {
    const selectedICNumber = document.getElementById("ic_number").value;

    try {
        const response = await fetch('http://localhost/5007CEM/public_html/Booking%20Form.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
            },
            body: `ic_number=${selectedICNumber}`,
        });
        const data = await response.json();
        return data.user_id;
    } catch (error) {
        console.error('Error fetching user ID:', error);
        return null;
    }
}

async function validation(event) {
    var name = document.getElementById('name').value;
    var contactNumber = document.getElementById('contactNumber').value;
    var icNumber = document.getElementById('icNumber').value;
    var state = document.getElementById('state').value;
    var pharmacy = document.getElementById('pharmacy').value;
    var date = document.getElementById('date').value;
    var time = document.getElementById('time').value;
    
    //construct value form inputbox into json
    var booking = { 'name': name, 'contactNumber': contactNumber, 'icNumber': icNumber,  'state': state, 'pharmacy': pharmacy, 'date': date, 'time': time} 

    var nameErr  = contactNumberErr = icNumberErr = stateErr = pharmacyErr = dateErr = timeErr = true; // define error variables with a default value
    //true means gt error and show error message

    // Validate name
    if (name === "") {
        printError("nameErr", "Please enter your name");
    } else {
        var regex = /^[a-zA-Z\s]+$/; // Contains A-Z, a-z
        if (regex.test(name) === false) {
            printError("nameErr", "Please enter a valid name");
        } else {
            printError("nameErr", "");
            nameErr = false;
        }
    }

    // Validate contact number
    if (contactNumber === "") {
        printError("contactNumberErr", "Please enter your contact number");
    } else {
        var regex = /^(?:\d{3}[-\s]\d{4} \d{4}|\d{2}[-\s]\d{4} \d{3}|\d{3}[-\s]\d{3} \d{4})$/;
        // At least one digit, at least one space or hyphen, total length between 8 and 11

        if (regex.test(contactNumber) === false) {
            printError("contactNumberErr", "01X-XXXX XXXX / 01X-XXX XXXX / 0X-XXX XXXX");
        } else {
            printError("contactNumberErr", "");
            contactNumberErr = false;
        }
    }

    // Validate ic number
    if (icNumber === "") {
        printError("icNumberErr", "Please enter your ic number");
    } else {
        var regex = /^\d{4,}$/; // Minimum length: 4, only digits
        if (regex.test(icNumber) === false) {
            printError("icNumberErr", "Please enter a valid ic number");
        } else {
            printError("icNumberErr", "");
            icNumber = false;
        }
    }

    // Validate state selection
    var state = document.getElementById("state").value;
    if (state === "Select State") {
        printError("stateErr", "Please select a state");
        stateErr = true;
    } else {
        printError("stateErr", "");
        stateErr = false;
    }

    // Validate pharmacy selection
    var pharmacy = document.getElementById("pharmacy").value;
    if (pharmacy === "Select Pharmacy") {
        printError("pharmacyErr", "Please select a pharmacy");
        pharmacyErr = true;
    } else {
        printError("pharmacyErr", "");
        pharmacyErr = false;

        // Fetch pharmacy_id and set the value of the hidden input
        const pharmacyId = await getPharmacyId();
        document.getElementById("pharmacy_id").value = pharmacyId;
    }

    // Validate date
    var date = document.getElementById("date").value;
    if (date === "") {
        printError("dateErr", "Please select a date");
    } else {
        printError("dateErr", "");
        dateErr = false;
    }

    // Validate time input
    var time = document.getElementById("time").value;
    if (time === "") {
        printError("timeErr", "Please select a time");
    } else {
        printError("timeErr", "");
        timeErr = false;
    }

    if ((nameErr || contactNumberErr || icNumberErr || stateErr || pharmacyErr || dateErr || timeErr == true)) { // prevent the form submitted if thr are any errors
        event.preventDefault();
        return false;
    } else {
        bookPharmacy();
    }
}

function printError(elementId, hintMsg) {
    document.getElementById(elementId).innerHTML = hintMsg;
}

function updatePharmacyOptions() {
    var stateSelect = document.getElementById("state");
    var pharmacySelect = document.getElementById("pharmacy");
    var selectedState = stateSelect.value;

    // Clear existing pharmacy options
    pharmacySelect.innerHTML = '<option disabled selected>Select Pharmacy</option>';

    // Add pharmacy options based on the selected state
    switch (selectedState) {
        case "Perlis":
            addPharmacyOption("Myfirst Pharmacy");
            addPharmacyOption("G Wellness Pharmacy");
            addPharmacyOption("Farmasi Setia");
            break;
        case "Kedah":
            addPharmacyOption("Farmasi Teratai");
            addPharmacyOption("BIG Pharmacy Arau");
            addPharmacyOption("Farmasi Desa");
            break;
        case "Penang":
            addPharmacyOption("Georgetown Pharmacy Bayan Baru");
            addPharmacyOption("Alpro The Promanade");
            addPharmacyOption("Farmasi Green River (Sungai Dua)");
            break;
        case "Perak":
            addPharmacyOption("Imay Pharmacy Sdn Bhd");
            addPharmacyOption("HTM Pharmacy Flagship Store (First Garden)");
            addPharmacyOption("Farmasi Rapat");
            break;
        case "Selangor":
            addPharmacyOption("Sunway Multicare Pharmacy Bestari Jaya");
            addPharmacyOption("V Pro Pharmacy Mayang");
            addPharmacyOption("Well Smith Pharmacy");
            break;
        case "Negeri Sembilan":
            addPharmacyOption("CARiNG Pharmacy Taipan Senawang, Seremban");
            addPharmacyOption("AA Pharmacy Seremban");
            addPharmacyOption("Farmasi Ai");
            break;        
        case "Melaka":
            addPharmacyOption("Health Lane Family Pharmacy Melaka Cheng Baru");
            addPharmacyOption("Farmasi Murni @ Ayer Keroh");
            addPharmacyOption("Pink Pharmacy Melaka Pertam Jaya");
            break;
        case "Kelantan":
            addPharmacyOption("Farmasi Cemerlang");
            addPharmacyOption("eGrand Pharmacy");
            addPharmacyOption("Farmasi Awana Kota Bharu");
            break;
        case "Terengganu":
            addPharmacyOption("Farmasi Pro");
            addPharmacyOption("Farmasi Sayang");
            addPharmacyOption("Farmasi Lautan Sultanah Zainab");
            break;
        case "Pahang":
            addPharmacyOption("Pahang Pharmacy (Raub)");
            addPharmacyOption("Pahang Pharmacy (Bentong)");
            addPharmacyOption("Cameron Pharmacy");
            break;
        case "Johor":
            addPharmacyOption("AM PM Pharmacy (Taman Century)");
            addPharmacyOption("New Life Pharmacy");
            addPharmacyOption("Seyon Pharmacy Tampoi Indah");
            break;
        case "Sabah":
            addPharmacyOption("Sunlight Pharmacy KK (Jalan Pantai Outlet)");
            addPharmacyOption("Public Chemist Pharmacy");
            addPharmacyOption("UMH Pharmacy Sdn. Bhd.");
            break;
        case "Sarawak":
            addPharmacyOption("Sing Lee Pharmacy");
            addPharmacyOption("Central Park Pharmacy");
            addPharmacyOption("Ting Pharmacy");
            break;
    }
}

function addPharmacyOption(pharmacyName) {
    var pharmacySelect = document.getElementById("pharmacy");
    var option = document.createElement("option");
    option.text = pharmacyName;
    option.value = pharmacyName;
    pharmacySelect.add(option);
}
