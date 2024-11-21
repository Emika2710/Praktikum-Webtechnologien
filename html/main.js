window.backendUrl = "https://online-lectures-cs.thi.de/chat/f00a3c26-3aa4-40c6-a772-5adebc4c3689";
window.token = "eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJ1c2VyIjoiSmVycnkiLCJpYXQiOjE3MzIxOTI4OTh9.i4-FjUDMIaJ64B0kCXSX37yJgkl8Rm_t2ZSCawn5AFo";


// Freundesliste mit nachrichten darstellen
function updateFriends(data) {

    let ul = document.getElementById("friendslist");
    ul.innerHTML = "";

    let ol = document.getElementById("requests");
    ol.innerHTML = "";

    for (let i = 0; i < data.length; i++) {
        let li = document.createElement("li");
        let friends = data[i].username;
        let messages = data[i].unread;

        if (data[i].status == "accepted") {

            let friend = document.createElement('a');
            // An Meli: hier kannst zu die Infos (welcher Freund ist es) weiterleiten
            friend.href = "chat.html" + "?friend=" + friends;
            friend.innerHTML = friends;

            let div = document.createElement('div');
            div.className = "box";
            div.innerHTML = messages;

            li.appendChild(friend);
            li.appendChild(div);


            ul.appendChild(li);
        }
        if (data[i].status === "requested") {

            let b = document.createElement('b');
            b.innerHTML = friends;

            li.innerHTML = "Friend Request from ";
            li.appendChild(b);
            ol.appendChild(li);

        }
    }
}

// firendlist Aktualisieren
function loadFriends() {


    let xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function () {
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
            let data = JSON.parse(xmlhttp.responseText);
            console.log(data);
            updateFriends(data);
        }
    };
    xmlhttp.open("GET", "https://online-lectures-cs.thi.de/chat/a21f6c70-a791-43f3-8b05-fb459645f47a/friend", true);
    xmlhttp.setRequestHeader('Content-type', 'application/json');
    xmlhttp.setRequestHeader('Authorization', 'Bearer eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJ1c2VyIjoiVG9tIiwiaWF0IjoxNzMyMjAzMDc3fQ.KGI9SdwBqsh2yDyGaRjcKDC8CCGCfHxUhXrxNMs06Kc');
    xmlhttp.send();

};
/*
window.setInterval(function () {
    loadFriends();
}, 1000);
*/
loadFriends();