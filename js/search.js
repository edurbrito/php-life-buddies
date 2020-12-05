
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
            console.log(request.response);
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

    request.open("GET", "../actions/action_search_pet.php?" + encodeForAjax(kvpairs), true)
    request.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded')    
    request.send();

});
