let favorite = document.querySelector("#favorite")

favorite.addEventListener('click', () => {
    let pet_id = document.querySelector('.pet-container').getAttribute('data-id');
    let request = new XMLHttpRequest()
    request.onreadystatechange = function() {
        if (request.readyState == XMLHttpRequest.DONE) {
            let response = JSON.parse(request.response);
            if(response.type == 'success'){
                if(response.action == 'added') favorite.classList = 'fas fa-star fa-2x';
                else if(response.action == 'removed') favorite.classList = 'far fa-star fa-2x';
            }

        }
    }
    request.open("GET", "../actions/pet/action_favorite_pet.php?pet_id=" + pet_id, true)
    request.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded')    
    request.send()
})


let question = document.querySelector("#question")

question.addEventListener('click', () => {
    question.parentNode.submit()
})