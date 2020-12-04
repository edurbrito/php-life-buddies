
let favorite = document.querySelector("#favorite")

favorite.addEventListener('click', () => {
    let pet_id = document.querySelector('.pet-container').getAttribute('data-id');
    let request = new XMLHttpRequest()
    request.onreadystatechange = function() {
        if (request.readyState == XMLHttpRequest.DONE) {
            console.log(request.response)
            let response = JSON.parse(request.response);
            if(response.type == 'success'){
                if(response.action == 'added') favorite.classList = 'fas fa-star fa-2x';
                else if(response.action == 'removed') favorite.classList = 'far fa-star fa-2x';
            }

        }
    }
    request.open("POST", "../actions/action_favorite_pet.php", true)
    request.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded')    
    request.send(JSON.stringify({'pet_id': pet_id}))
})


let question = document.querySelector("#question")

question.addEventListener('click', () => {
    question.parentNode.submit()
})