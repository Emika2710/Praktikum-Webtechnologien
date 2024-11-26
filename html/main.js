window.backendUrl = "https://online-lectures-cs.thi.de/chat/f00a3c26-3aa4-40c6-a772-5adebc4c3689";
window.token = "eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJ1c2VyIjoiSmVycnkiLCJpYXQiOjE3MzIxOTI4OTh9.i4-FjUDMIaJ64B0kCXSX37yJgkl8Rm_t2ZSCawn5AFo";

// gibt Chatpartner name zurück (aus Vorgebe entnommen)
function getChatpartner() {
    const url = new URL(window.location.href);
    //	Access the query parameters using searchParams
    const queryParams = url.searchParams;
    //	Retrieve the value of the "friend" parameter
    const friendValue = queryParams.get("friend");
    return friendValue;
}

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
            friend.setAttribute("href", "chat.html?friend=" + friends);
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

// Freundesliste Aktualisieren
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

//Funktionen für den Chat
function onChatLoad() {
    let friend = getChatpartner();
    let heading = document.getElementsByTagName("h1")[0];
    heading.innerText = "Chat with " + friend;
    loadChat();
    setInterval(loadChat, 1000);
}

function loadChat() {
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function () {
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
            let data = JSON.parse(xmlhttp.responseText);
            //Einfügen der Elemente des Arrays Data in die Liste des Chats
            let chat = document.getElementById("chat");
            chat.innerHTML = "";
            for (let i = 0; i < data.length; i++) {
                let chatelement = document.createElement("li");
                let currentData = data[i];
                chatelement.innerText = currentData.from + ": " + currentData.msg;
                chat.appendChild(chatelement);
            }
        }
    };
    xmlhttp.open("GET", "https://online-lectures-cs.thi.de/chat/fe0874f3-946f-452d-b623-46c95cff6b52/message/" + getChatpartner(), true);
    xmlhttp.setRequestHeader('Authorization', 'Bearer eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJ1c2VyIjoiVG9tIiwiaWF0IjoxNzMyMjI1NDY0fQ.xhntKonXGqqHiVEDACeldiO597mhL9HPOVr4jnS3lIo');
    xmlhttp.send();
}
 //Senden einer Nachricht
function sendMessage() {
    let messageElement = document.getElementById("message");
    let message = messageElement.value;
    let xmlhttp = new XMLHttpRequest();
    xmlhttp.open("POST", "https://online-lectures-cs.thi.de/chat/fe0874f3-946f-452d-b623-46c95cff6b52/message", true);
    xmlhttp.setRequestHeader('Content-type', 'application/json');
    // Add token, e. g., from Tom
    xmlhttp.setRequestHeader('Authorization', 'Bearer eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJ1c2VyIjoiVG9tIiwiaWF0IjoxNzMyMjI1NDY0fQ.xhntKonXGqqHiVEDACeldiO597mhL9HPOVr4jnS3lIo');
    // Create request data with message and receiver
    let data = {
        message: message,
        to: getChatpartner()
    };
    let jsonString = JSON.stringify(data); // Serialize as JSON
    xmlhttp.send(jsonString); // Send JSON-data to server
    messageElement.value = "";
}