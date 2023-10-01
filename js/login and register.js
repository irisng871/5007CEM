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