let images_section = document.getElementById("images-preview");
let image = document.getElementById("img");

function createImageTag(src, alt) {
    var img = document.createElement('img');
    img.src = src;
    if ( alt != null ) img.alt = alt;
    img.width = 200;
    img.height = 200;
    return img;
}

function previewImages(input) {
    images_section.innerHTML = "";
    if (input.files && input.files[0]) {
        for (let i = 0; i < input.files.length; i++) {
            var reader = new FileReader();
            reader.onload = function (e) {
                let img = createImageTag(e.target.result);
                images_section.appendChild(img);
            }    
            reader.readAsDataURL(input.files[i]);
        }
    }
}

// Invalid Names and Errors associated
function invalidName(textbox) {
    textbox.setCustomValidity('');
    var input = document.getElementsByName('name')[0];
    if(input.validity.patternMismatch){
        input.setCustomValidity("Please write a valid pet name. The name must only contain letters e.g. Max");
   }    
   else {
    input.setCustomValidity('');
   }
   return true;
}

function checkName(){
    var name = document.getElementsByName('name')[0];
    invalidName(name);
    if (name.validity.patternMismatch){
        name.style.color = 'red';
    }
    else
    name.style.color = 'black';
  }


// Invalid Species and Errors associated
function invalidSpecies(textbox) {
    textbox.setCustomValidity('');
    var input = document.getElementsByName('species')[0];
    if(input.validity.patternMismatch){
        input.setCustomValidity("Please write a valid pet species. The species must only contain letters e.g. Cat");
   }    
   else {
    input.setCustomValidity('');
   }
   return true;
}

function checkSpecies(){
    var species = document.getElementsByName("species")[0];
    invalidSpecies(species);
    if (species.validity.patternMismatch){
        species.style.color = 'red';
    }
    else
    species.style.color = 'black';
  }

// Invalid Age and Errors associated
function invalidAge(textbox) {
    textbox.setCustomValidity('');
    var input = document.getElementsByName('age')[0];
    if(input.validity.patternMismatch){
        input.setCustomValidity("Please write a valid age for the pet e.g. 3 years");
   }    
   else {
    input.setCustomValidity('');
   }
   return true;
}

function checkAge(){
    var age = document.getElementsByName("age")[0];
    invalidAge(age);
    if (age.validity.patternMismatch){
        age.style.color = 'red';
    }
    else
    age.style.color = 'black';
  }

// Invalid Age and Errors associated
function invalidAge(textbox) {
    textbox.setCustomValidity('');
    var input = document.getElementsByName('age')[0];
    if(input.validity.patternMismatch){
        input.setCustomValidity("Please write a valid age for the pet e.g. 3 years");
   }    
   else {
    input.setCustomValidity('');
   }
   return true;
}

function checkAge(){
    var age = document.getElementsByName("age")[0];
    invalidAge(age);
    if (age.validity.patternMismatch){
        age.style.color = 'red';
    }
    else
    age.style.color = 'black';
  }

// Invalid Color and Errors associated
function invalidColor(textbox) {
    textbox.setCustomValidity('');
    var input = document.getElementsByName('color')[0];
    if(input.validity.patternMismatch){
        input.setCustomValidity("Please write a valid color for the pet e.g. black");
   }    
   else {
    input.setCustomValidity('');
   }
   return true;
}

function checkColor(){
    var color = document.getElementsByName("color")[0];
    invalidColor(color);
    if (color.validity.patternMismatch){
        color.style.color = 'red';
    }
    else
    color.style.color = 'black';
  }

// Invalid Color and Errors associated
function invalidColor(textbox) {
    textbox.setCustomValidity('');
    var input = document.getElementsByName('color')[0];
    if(input.validity.patternMismatch){
        input.setCustomValidity("Please write a valid color for the pet e.g. black");
   }    
   else {
    input.setCustomValidity('');
   }
   return true;
}

function checkColor(){
    var color = document.getElementsByName("color")[0];
    invalidColor(color);
    if (color.validity.patternMismatch){
        color.style.color = 'red';
    }
    else
    color.style.color = 'black';
  }

// Invalid Location and Errors associated
function invalidLocation(textbox) {
    textbox.setCustomValidity('');
    var input = document.getElementsByName('location')[0];
    if(input.validity.patternMismatch){
        input.setCustomValidity("Please write a valid address for the pet e.g. R. D Joao I, 20 - Porto");
   }    
   else {
    input.setCustomValidity('');
   }
   return true;
}

function checkLocation(){
    var location = document.getElementsByName("location")[0];
    invalidLocation(location);
    if (location.validity.patternMismatch){
        location.style.color = 'red';
    }
    else
    location.style.color = 'black';
  }