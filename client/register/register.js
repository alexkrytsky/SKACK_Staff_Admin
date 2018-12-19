var inputFields = document.querySelectorAll("input");

for (var i = 0; i < inputFields.length; i++) {
    inputFields[i].addEventListener("focusout", validation);
}
document.getElementById("state").addEventListener("focusout", validation);

function validation() {

    if (this.required) {
        if (this.value == "") {
            this.classList.add("is-invalid");
            this.classList.remove("is-valid");
        } else {
            this.classList.remove("is-invalid");
            this.classList.add("is-valid");
        }
    } else {
        if (this.value != "") {
            this.classList.remove("is-invalid");
            this.classList.add("is-valid");
        }
    }
}

document.querySelector("#phone").addEventListener("keypress", enterNumber);
document.querySelector("#zip").addEventListener("keypress", numbersOnly);

document.getElementById("password").addEventListener("keypress", passwordComplexity);
document.querySelector("#passwordConfirm").addEventListener("focusout", validatePassword)

//enables only numvers and limits it to 5 digit
function numbersOnly() {
    event.preventDefault();
    if (event.charCode < 48 || event.charCode > 57) {
        return;
    }else if(this.value.length >= 5){
        this.value = this.value;
        return;
    }else {
        this.value = this.value + event.key;
    }

}

//checks is the number or not and limits input only to numbers
function enterNumber() {

    event.preventDefault();
    //get control and text
    var text = this.value;

    //is this a numeric digit
    if (event.charCode < 48 || event.charCode > 57) {
        return;
    }
    //add special characters when needed
    if (text.length <= 13) {
        text += event.key;
    }
    //add special characters when needed
    if (text.length == 1) {
        text = "(" + text;
    }
    if (text.length == 4) {
        text = text + ") ";
    }
    if (text.length == 9) {
        text += "-"
    }
    //assign the text to the value
    this.value = text;
}

function passwordComplexity() {
    var strongRegex = new RegExp("^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[!@#\$%\^&\*])(?=.{8,})");
    var mediumRegex = new RegExp("^(((?=.*[a-z])(?=.*[A-Z]))|((?=.*[a-z])(?=.*[0-9]))|((?=.*[A-Z])(?=.*[0-9])))(?=.{6,})");

    var passFeedback = document.getElementById("passwordFeedback");
    if(strongRegex.test(this.value)){
        this.classList.add("is-valid");
        this.classList.remove("is-invalid");
        passFeedback.innerText = "Good complex password!";
        this.style.border = "1px solid green";
        passFeedback.style.color = "green";

    }else if(mediumRegex.test(this.value)){
        this.classList.add("is-valid");
        this.classList.remove("is-invalid");
        passFeedback.innerText = "Your password is medium complexity";
        passFeedback.style.color = "orange";
        this.style.border = "1px solid orange";
    }else {
        this.classList.remove("is-valid");
        this.classList.add("is-invalid");
    }

}

//to check are the password math in password and password confirm window
function validatePassword() {
    var password = document.getElementById("password");

    if (password.value != this.value) {
        this.value = "";
        password.value = "";
        this.classList.remove("is-valid");
        password.classList.remove("is-valid");
        this.classList.add("is-invalid");
        password.classList.add("is-invalid");
        password.style.border = "1px solid red";
    }
}

