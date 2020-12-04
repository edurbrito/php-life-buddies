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