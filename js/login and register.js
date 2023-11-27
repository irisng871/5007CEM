const time_to_show_login = 400;
const time_to_hidden_login = 200;

function change_to_login() {
    document.querySelector('.cont_forms').className = "cont_forms cont_forms_active_login";
    document.querySelector('.cont_form_login').style.display = "block";
    document.querySelector('.cont_form_register').style.opacity = "0";

    setTimeout(function () {
        document.querySelector('.cont_form_login').style.opacity = "1";
    }, time_to_show_login);

    setTimeout(function () {
        document.querySelector('.cont_form_register').style.display = "none";
    }, time_to_hidden_login);
}

const time_to_show_register = 100;
const time_to_hidden_register = 400;

function change_to_register(at) {
    document.querySelector('.cont_forms').className = "cont_forms cont_forms_active_register";
    document.querySelector('.cont_form_register').style.display = "block";
    document.querySelector('.cont_form_login').style.opacity = "0";

    setTimeout(function () {
        document.querySelector('.cont_form_register').style.opacity = "1";
    }, time_to_show_register);

    setTimeout(function () {
        document.querySelector('.cont_form_login').style.display = "none";
    }, time_to_hidden_register);
}

const time_to_hidden_all = 500;

function hidden_login_and_register() {

    document.querySelector('.cont_forms').className = "cont_forms";
    document.querySelector('.cont_form_register').style.opacity = "0";
    document.querySelector('.cont_form_login').style.opacity = "0";

    setTimeout(function () {
        document.querySelector('.cont_form_register').style.display = "none";
        document.querySelector('.cont_form_login').style.display = "none";
    }, time_to_hidden_all);
}

function validation() {
    var name = document.getElementById('name').value;
    var birthDate = document.getElementById('birthDate').value;
    var icNumber = document.getElementById('icNumber').value;
    var contactNumber = document.getElementById('contactNumber').value;
    var email = document.getElementById('email').value;
    var password = document.getElementById('password').value;

    //construct value form inputbox into json
    var acc = { 'name': name, 'birthDate': birthDate, 'icNumber': icNumber, 'contactNumber': contactNumber, 'email': email, 'password': password} 

    var nameErr = birthDateErr = icNumberErr = contactNumberErr = emailErr = passwordErr = true; // define error variables with a default value
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

    // Validate date
    var birthDate = document.getElementById("birthDate").value;
    if (birthDate === "") {
        printError("birthDateErr", "Please select your birth date");
    } else {
        printError("birthDateErr", "");
        birthDateErr = false;
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

    // Validate contact number
    if (contactNumber === "") {
        printError("contactNumberErr", "Please enter your phone number");
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

    // Validate email
    if (email === "") {
        printError("emailErr", "Please enter your email address");
    } else {
        var regex = /^\S+@\S+\.\S+$/; // Must contain @ and .
        if (regex.test(email) === false) {
            printError("emailErr", "Please enter a valid email address");
        } else {
            printError("emailErr", "");
            emailErr = false;
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

    if ((nameErr || birthDateErr || icNumberErr || contactNumberErr || emailErr || passwordErr == true)) { // prevent the form submitted if thr are any errors
        return false;
    } else {
        registerAccount();
    }
}

function printError(elementId, hintMsg) {
    document.getElementById(elementId).innerHTML = hintMsg;
}