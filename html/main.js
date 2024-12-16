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

// Freundesliste mit Nachrichten darstellen 
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

            let div = document.createElement('div');

            let button1 = document.createElement('input');
            button1.type = "button";
            button1.value = "Accept";
            button1.id = "friendlist_accept";

            let button2 = document.createElement('input');
            button2.type = "button";
            button2.value = "Decline";
            button2.id = "friendlist_decline";

            div.appendChild(button1);
            div.appendChild(button2);

            li.appendChild(div);

            ol.appendChild(li);

        }
    }
}
//Versuch für Accept und Reject
    /*document.addEventListener("click", function(event) {
        if (event.target && event.target.id === "friendlist_accept") {
            let friendName = event.target.closest("li").querySelector("b").innerText;
    
            // AJAX-Request für "Accept"
            fetch("friendlist.php", {
                method: "POST",
                headers: { "Content-Type": "application/x-www-form-urlencoded" },
                body: `action=accept&friend=${encodeURIComponent(friendName)}`
            })
            .then(response => response.json())
            .then(data => {
                alert(data.message); // Serverantwort anzeigen
                location.reload(); // Optional, Seite neu laden
            });
        }
    
        if (event.target && event.target.id === "friendlist_decline") {
            let friendName = event.target.closest("li").querySelector("b").innerText;
    
            // AJAX-Request für "Decline"
            fetch("friendlist.php", {
                method: "POST",
                headers: { "Content-Type": "application/x-www-form-urlencoded" },
                body: `action=decline&friend=${encodeURIComponent(friendName)}`
            })
            .then(response => response.json())
            .then(data => {
                alert(data.message); // Serverantwort anzeigen
                location.reload(); // Optional, Seite neu laden
            });
        }
    });*/


// Friendlist laden
function loadFriendList() {
    let xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function () {
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
            let data = JSON.parse(xmlhttp.responseText);
            console.log(data);
            updateFriends(data);
        }
    };
    xmlhttp.open("GET", "ajax_load_friends.php", true); // URL geändert
    // Token und Content-type Header entfernt
    xmlhttp.send();
};

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
    // Add token
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

function loadFriends() {
    let xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function () {
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
            let data = JSON.parse(xmlhttp.responseText);
            console.log(data);
        }
    };
    xmlhttp.open("GET", "https://online-lectures-cs.thi.de/chat/f00a3c26-3aa4-40c6-a772-5adebc4c3689/friend", true);
    xmlhttp.setRequestHeader('Content-type', 'application/json');
    xmlhttp.setRequestHeader('Authorization', 'Bearer ' + window.token);
    xmlhttp.send();
}

window.setInterval(function () {
    loadFriends();
}, 1000);

loadFriends();
