function encodeForAjax(data) {
  return Object.keys(data).map(function (k) {
    return encodeURIComponent(k) + '=' + encodeURIComponent(data[k])
  }).join('&')
}

let notifications = document.querySelector("#notification")
let pop_up = document.querySelector("#popup")
let close_pop_up = document.querySelector(".popup .close")

close_pop_up.addEventListener('click', () => {
  pop_up.style.visibility = 'hidden';
  pop_up.style.opacity = 0;
  notifications.removeAttribute("data-count");
})

notifications.addEventListener('click', () => {
  let request = new XMLHttpRequest()
  request.onreadystatechange = function () {
    if (request.readyState == XMLHttpRequest.DONE) {
      let response = JSON.parse(request.response)
      let pop_up_container = document.querySelector("#popup-content")

      if (response.length == 0)
        pop_up_container.innerHTML = "Nothing to show here..."
      else {
        pop_up_container.innerHTML = "";
        response.forEach(element => {
          let article = document.createElement("article")

          let p = document.createElement("p")
          p.innerHTML = element.string

          let a1 = document.createElement("a")
          a1.innerHTML = "View User"
          a1.href = "/pages/profile.php?user=" + element.notifier

          let a2 = document.createElement("a")
          a2.innerHTML = "View Pet"
          a2.href = "/pages/pet.php?pet_id=" + element.pet_id

          article.appendChild(document.createElement("hr"))
          article.appendChild(p)
          article.appendChild(a1)
          article.appendChild(a2)

          pop_up_container.appendChild(article)
        });
      }

      pop_up.style.visibility = 'visible';
      pop_up.style.opacity = 1;

    }
  }

  request.open("GET", "../actions/user/action_get_notifications.php", true)
  request.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded')
  request.send();
})