
let search = document.querySelector("#search-container form")

search.addEventListener('submit', (e) => {
    e.preventDefault();
    let kvpairs = [];
    for (let i = 0; i < search.elements.length; i++) {
        let e = search.elements[i];
        if(e.value != "" && e.value != null && e.type != "checkbox")
            kvpairs[e.name] = e.value;
        else if (e.type == "checkbox")
            kvpairs[e.name] = e.checked ? "on" : "off";
    }
    
    let request = new XMLHttpRequest()
    request.onreadystatechange = function() {
        if (request.readyState == XMLHttpRequest.DONE) {
            let response = JSON.parse(request.response)

            let adopt_list = document.querySelector("#adopt-list")
            adopt_list.innerHTML = ""

            if(response.length > 0){

                response.forEach(element => {
                    let article = document.createElement("article");
                    article.classList.add("adopt-list-item");

                    let img = document.createElement("img");
                    img.src = element.photo != null ? element.photo : "../css/images/dog.svg";

                    let h3 = document.createElement("h3");
                    h3.innerHTML = element.name + ", " + element.age;

                    let button = document.createElement("a");
                    button.href = "/pages/pet.php?pet_id=" + element.id;
                    button.innerHTML = "<button>View Post</button>";

                    article.append(img, h3, button);

                    adopt_list.appendChild(article);
                    
                });
            }
        }
    }

    request.open("GET", "../actions/search/action_search_pet.php?" + encodeForAjax(kvpairs), true)
    request.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded')    
    request.send();

});

let nameL = document.getElementById("name")
nameL.addEventListener("keyup", nameChanged);

function nameChanged(event) {
    let name = event.target;
    let request = new XMLHttpRequest();
    request.addEventListener("load", namesReceived);
    request.open("get", "../actions/search/action_get_names.php?name=" + name.value, true)
    request.send()
}

function namesReceived() {
    let names = JSON.parse(this.responseText)
    let list = document.getElementById("suggestions-name")
    list.innerHTML = ""

    for(name in names) {
        let item = document.createElement("option")
        item.innerHTML = names[name].name
        list.appendChild(item)
    }
}


let specieL = document.getElementById("species")
specieL.addEventListener("keyup", specieChanged);

function specieChanged(event) {
    let specie = event.target;
    let request = new XMLHttpRequest();
    request.addEventListener("load", speciesReceived);
    request.open("get", "../actions/search/action_get_species.php?specie=" + specie.value, true)
    request.send()
}

function speciesReceived() {
    let species = JSON.parse(this.responseText)
    let list = document.getElementById("suggestions-species")
    list.innerHTML = ""

    for(specie in species) {
        let item = document.createElement("option")
        item.innerHTML = species[specie].species
        list.appendChild(item)
    }
}

let colorL = document.getElementById("color")
colorL.addEventListener("keyup", colorChanged);

function colorChanged(event) {
    let color = event.target;
    let request = new XMLHttpRequest();
    request.addEventListener("load", colorsReceived);
    request.open("get", "../actions/search/action_get_colors.php?color=" + color.value, true)
    request.send()
}

function colorsReceived() {
    let colors = JSON.parse(this.responseText)
    let list = document.getElementById("suggestions-color")
    list.innerHTML = ""

    for(color in colors) {
        let item = document.createElement("option")
        item.innerHTML = colors[color].color
        list.appendChild(item)
    }
}

let ageL = document.getElementById("age")
ageL.addEventListener("keyup", ageChanged);

function ageChanged(event) {
    let age = event.target;
    let request = new XMLHttpRequest();
    request.addEventListener("load", agesReceived);
    request.open("get", "../actions/search/action_get_ages.php?age=" + age.value, true)
    request.send()
}

function agesReceived() {
    let ages = JSON.parse(this.responseText)
    let list = document.getElementById("suggestions-age")
    list.innerHTML = ""

    for(age in ages) {
        let item = document.createElement("option")
        item.innerHTML = ages[age].age
        list.appendChild(item)
    }
}

let locationL = document.getElementById("location")
locationL.addEventListener("keyup", locationChanged);

function locationChanged(event) {
    let location = event.target;
    let request = new XMLHttpRequest();
    request.addEventListener("load", locationsReceived);
    request.open("get", "../actions/search/action_get_locations.php?location=" + location.value, true)
    request.send()
}

function locationsReceived() {
    let locations = JSON.parse(this.responseText)
    let list = document.getElementById("suggestions-location")
    list.innerHTML = ""

    for(loc in locations) {
        let item = document.createElement("option")
        item.innerHTML = locations[loc].location
        list.appendChild(item)
    }
}
