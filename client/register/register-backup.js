var inputFields = document.querySelectorAll("input:required");

for(var i = 0; i < inputFields.length; i++){
    inputFields[i].addEventListener("focusout", isEmpty);
}

function isEmpty() {
    if(this.value == ""){
        this.style.border = "1px solid red";
    }
    if(!this.value == ""){
        this.style.border = "1px solid green";
    }
}

var phoneField = document.querySelector("#phone");

phoneField.addEventListener("keypress", enterNumber);
phoneField.addEventListener("focusout", formatPhoneNumber);


var zipCode = document.querySelector("#zip");
zipCode.addEventListener("keypress", enterNumber);

var confirmEmail = document.querySelector("#passwordConfirm");
confirmEmail.addEventListener("focusout", validatePassword)
//formats the phone number
function formatPhoneNumber(event) {
    var s2 = (""+this.value).replace(/\D/g, '');
    var m = s2.match(/^(\d{3})(\d{3})(\d{4})$/);
    this.value =  (!m) ? this.value : "(" + m[1] + ") " + m[2] + "-" + m[3];
}

//checks is the number or not and limits input only to numbers
function enterNumber(){
    if (!/^[0-9]+$/.test(this.value))
    {
        this.value = this.value.substring(0, this.value.length-1);
    }
    if(this.value.length < 10){
        this.style.border = "1px solid red";
    }
}

//to check are the password math in password and password confirm window
function validatePassword() {
    var password = document.getElementById("password");

    if(password.value != this.value){
        alert("Password must match");
        this.value = "";
        password.value = "";
        this.border = "1px solid red";
        password.border = "1px solid red";
    }
}