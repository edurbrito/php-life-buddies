// Invalid Names and Errors associated
function InvalidName(textbox) {
    textbox.setCustomValidity('');
    var input = document.getElementById('name');
    if(input.validity.patternMismatch){
        input.setCustomValidity("Please wright your real name. Your name must only contain letters e.g. John Smith");
   }    
   else {
    input.setCustomValidity('');
   }
   return true;
}

function Checkname(){
    var name = document.getElementById("name");
    InvalidName(name);
    if (name.validity.patternMismatch){
        name.style.color = 'red';
    }
    else
    name.style.color = 'black';
  }

// Invalid Phones and Errors associated

  function InvalidPhone(textbox) {
    textbox.setCustomValidity('');
    var input = document.getElementById('phone');
    if(input.validity.patternMismatch){
        if(input.value.length<9)
            input.setCustomValidity("Your phone number should have exactly 9 digits e.g. 923456789");
        else if(input.value.length>9)
            input.setCustomValidity("Your phone number should have exactly 9 digits e.g. 923456789");
        else
            input.setCustomValidity("Your phone number should be valid (which means your second number should be either 1,2,3 or 6)");
   }    
   else {
    input.setCustomValidity('');
   }
   return true;
}
  
function Checkphone(){
    var phone = document.getElementById("phone");
    InvalidPhone(phone);
    if (phone.validity.patternMismatch){
        phone.style.color = 'red';
    }
    else
    phone.style.color = 'black';
  }
  
// Invalid Emails and Errors associated

function InvalidPhone(textbox) {
    textbox.setCustomValidity('');
    var input = document.getElementById('phone');
    if(input.validity.patternMismatch){
        if(input.value.length<9)
            input.setCustomValidity("Your phone number should have exactly 9 digits e.g. 923456789");
        else if(input.value.length>9)
            input.setCustomValidity("Your phone number should have exactly 9 digits e.g. 923456789");
        else
            input.setCustomValidity("Your phone number should be valid (which means your second number should be either 1,2,3 or 6)");
   }    
   else {
    input.setCustomValidity('');
   }
   return true;
}
  
function CheckEmail(){
    var email = document.getElementById("email");
    if (email.validity.patternMismatch){
        email.style.color = 'red';
    }
    else
    email.style.color = 'black';
  }

// Invalid Password and Errors associated

function hasNumber(myString) {
    return /\d/.test(myString);
  }

function InvalidPassword(textbox) {
    textbox.setCustomValidity('');
    var input = document.getElementById('password');
    if(input.validity.patternMismatch){
        if (input.value.length<8)
        {
            input.setCustomValidity("Password must have at least 8 characters");
        }
        else if (!hasNumber(input.value))
        {
            input.setCustomValidity("Password must have at least one number");
        }
        else{
            input.setCustomValidity("Password must have at least one uppercase and lowercase letters");
        }
   }    
   else {
    input.setCustomValidity('');
   }
   return true;
}

function CheckPassword(){
    var password = document.getElementById("password");
    InvalidPassword(password);
  }
