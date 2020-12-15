// Invalid Names and Errors associated
function invalidName(textbox) {
    textbox.setCustomValidity('');
    var input = document.getElementsByName('name')[0];
    if(input.validity.patternMismatch){
        input.setCustomValidity("Please write your real name. Your name must only contain letters (e.g. John Smith)");
   }    
   else {
    input.setCustomValidity('');
   }
   return true;
}

function checkName(){
    var name = document.getElementsByName("name")[0];
    invalidName(name);
    if (name.validity.patternMismatch){
        name.style.color = 'red';
    }
    else
    name.style.color = 'black';
  }

// Invalid Phones and Errors associated

  function invalidPhone(textbox) {
    textbox.setCustomValidity('');
    var input = document.getElementsByName('phone')[0];
    if(input.validity.patternMismatch){
        if(input.value.length<9)
            input.setCustomValidity("Your phone number should have exactly 9 digits e.g. 923456789");
        else if(input.value.length>9)
            input.setCustomValidity("Your phone number should have exactly 9 digits e.g. 923456789");
        else
            input.setCustomValidity("Your phone number should be valid (starting by 91, 92, 93 or 96)");
   }    
   else {
    input.setCustomValidity('');
   }
   return true;
}
  
function checkPhone(){
    var phone = document.getElementsByName("phone")[0];
    invalidPhone(phone);
    if (phone.validity.patternMismatch){
        phone.style.color = 'red';
    }
    else
    phone.style.color = 'black';
  }
  
// Invalid Emails and Errors associated

function invalidEmail(textbox) {
    textbox.setCustomValidity('');
    var input = document.getElementsByName('email')[0];
    if(input.validity.patternMismatch){
        input.setCustomValidity("Your email adress should be valid");
   }    
   else {
    input.setCustomValidity('');
   }
   return true;
}
  
function checkEmail(){
    var email = document.getElementsByName("email")[0];
    invalidEmail(email);
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

function invalidPassword(textbox) {
    textbox.setCustomValidity('');
    var input = document.getElementsByName('password')[0];
    if (input==null)
        input = document.getElementsByName('new-password')[0];
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

function checkPassword(){
    var password = document.getElementsByName("password")[0];
    if (password==null)
        password = document.getElementsByName('new-password')[0];
    invalidPassword(password);
  }
