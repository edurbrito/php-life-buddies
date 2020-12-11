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
    var input = document.getElementById('name');
    if(input.validity.patternMismatch){
        input.setCustomValidity("Please write a valid pet name. The name must only contain letters e.g. Max");
   }    
   else {
    input.setCustomValidity('');
   }
   return true;
}

function checkName(){
    var name = document.getElementById("name");
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
    console.log(input);
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