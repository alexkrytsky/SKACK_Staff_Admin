var inputFields = document.querySelectorAll("input");

for (var i = 0; i < inputFields.length; i++) {
    inputFields[i].addEventListener("focusout", validation);
}

$(".phone").keypress(enterNumber);

function validation() {

    if (this.required) {
        if (this.value == "") {
            this.classList.remove("is-valid");
            this.classList.add("is-invalid");
        } else {
            this.classList.remove("is-invalid");
            this.classList.add("is-valid");
        }
    } else {
        if (this.value != "") {
            // this.classList.remove("is-invalid");
            this.classList.add("is-valid");
        }
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