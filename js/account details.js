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

function validation(event) {
    var name = document.getElementById('name').value;
    var contactNumber = document.getElementById('contactNumber').value;
    var password = document.getElementById('password').value;

    var nameErr = contactNumberErr = passwordErr = true;
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

    // Validate password
    if (password === "") {
        printError("passwordErr", "Please enter your password");
    } else {
        var regex = /^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{6,}$/;  // Minimum length: 6, contains A-Z, a-z, number
        if (regex.test(password) === false) {
            printError("passwordErr", "6+ chars, Uppercase, Lowercase, Number");
        } else {
            printError("passwordErr", "");
            passwordErr = false;
        }
    }

    if ((nameErr || contactNumberErr || passwordErr == true)) {
        event.preventDefault();
        return false;
    }
}

function printError(elementId, hintMsg) {
    document.getElementById(elementId).innerHTML = hintMsg;
}

function performSearch() {
    var searchInput = document.getElementById("searchInput").value;

    // Check if the search input is empty
    if (searchInput.trim() === "") {
        alert("Please enter any keyword to perform search");
    } else {
        redirectToSearch(searchInput);
    }
}

function handleSearchKeyPress(event) {
    if (event.key === 'Enter') {
        var searchInput = document.getElementById("searchInput").value;

        // Check if the search input is empty
        if (searchInput.trim() === "") {
            alert("Please enter any keyword to perform search.");
        } else {
            redirectToSearch(searchInput);
        }
    }
}

function redirectToSearch(searchInput) {
    window.location.href = "http://localhost/5007CEM/public_html/Search%20Result.php?s=" + encodeURIComponent(searchInput);
}