/*
window.backendUrl = "https://online-lectures-cs.thi.de/chat/f00a3c26-3aa4-40c6-a772-5adebc4c3689";
window.token = "eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJ1c2VyIjoiSmVycnkiLCJpYXQiOjE3MzIxOTI4OTh9.i4-FjUDMIaJ64B0kCXSX37yJgkl8Rm_t2ZSCawn5AFo";
*/
// gibt Chatpartner name zurück (aus Vorgebe entnommen)
function getChatpartner() {
    const url = new URL(window.location.href);
    //	Access the query parameters using searchParams
    const queryParams = url.searchParams;
    //	Retrieve the value of the "friend" parameter
    const friendValue = queryParams.get("to");
    return friendValue;
}


// Freundesliste mit Nachrichten darstellen 
function updateFriends(data) {

    let ul = document.getElementById("friendslist");
    ul.innerHTML = "";

    let ol = document.getElementById("requests");
    ol.innerHTML = "";

    for (let i = 0; i < data.length; i++) {
        

        let friends = data[i].username;
        let messages = data[i].unread;

        if (data[i].status == "accepted") {

            // Listenelement erstellen
            let friend = document.createElement('a');
            friend.setAttribute("href", "chat.php?to=" + friends);
            friend.className = "list-group-item list-group-item-action";
            friend.innerHTML = friends;


            //let friend = document.createElement('a');
            //friend.setAttribute("href", "chat.php?to=" + friends);

            
            if(messages > 0) {
                let messagecount = document.createElement('span');
                messagecount.className = "badge text-bg-primary rounded-circle position-absolute end-0 me-3"; 
                messagecount.innerHTML = messages;
                friend.appendChild(messagecount);
            }

            let div = document.createElement('div');
            div.className = "box";
            div.innerHTML = messages;

            //li.appendChild(friend);
            //li.appendChild(div);

            ul.appendChild(friend);
        }
        if (data[i].status === "requested") {

            let li = document.createElement("li");
            li.className = "list-group-item";

            let b = document.createElement('b');
            b.innerHTML = friends;

            li.innerHTML = "Friend Request from ";
            li.appendChild(b);

            let div = document.createElement('div');
            
            let button1 = document.createElement('button');
            button1.class = "button";
            button1.value = friends;
            button1.name = "friendlist_accept";
            button1.innerHTML = "Accept";

            let button2 = document.createElement('button');
            button2.class = "button";
            button2.value = friends;
            button2.name = "friendlist_decline";
            button2.innerHTML = "Decline";
            
            div.appendChild(button1);
            div.appendChild(button2);

            li.appendChild(div);

            ol.appendChild(li);

        }
    }
}


// Friendlist laden
function loadFriendList() {
    console.log("loadFriendList");
    let xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function () {
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
            let data = JSON.parse(xmlhttp.responseText);
            console.log(data);
            updateFriends(data);
        }
    };
    xmlhttp.open("GET", "ajax_load_friends.php", true); // URL geändert
    xmlhttp.setRequestHeader('Authorization', 'Bearer eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJ1c2VyIjoiVG9tIiwiaWF0IjoxNzMyMjI1NDY0fQ.xhntKonXGqqHiVEDACeldiO597mhL9HPOVr4jnS3lIo');
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
            console.log(data);
            //Einfügen der Elemente des Arrays Data in die Liste des Chats
            let chat = document.getElementById("chat");
            chat.innerHTML = "";

            for (let i = 0; i < data.length; i++) {

                //Setup
                let chatelement = document.createElement("li");
                chatelement.className = "list-group-item my-2 fw-medium";
                let currentData = data[i];

                //Nachrichten in die Liste einfügen
                chatelement.innerText = currentData.from + ": " + currentData.msg;
                chat.appendChild(chatelement);

                let time = document.createElement("small");
                time.className = "text-muted position-absolute end-0 ";

                let date = new Date(data[i].time);
                time.innerText = date.toLocaleTimeString();
                chatelement.appendChild(time);
                
            }
        }
    };
    xmlhttp.open("GET", "ajax_load_messages.php?to="+getChatpartner(), true);
    xmlhttp.setRequestHeader('Authorization', 'Bearer eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJ1c2VyIjoiVG9tIiwiaWF0IjoxNzMyMjI1NDY0fQ.xhntKonXGqqHiVEDACeldiO597mhL9HPOVr4jnS3lIo');
    xmlhttp.send();


}

//Senden einer Nachricht
function sendMessage() {
    let messageElement = document.getElementById("message");
    let message = messageElement.value;
    let xmlhttp = new XMLHttpRequest();
    xmlhttp.open("POST", "ajax_send_message.php", true);
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
    loadChat();
}

function loadFriends() {
    let xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function () {
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
            let data = JSON.parse(xmlhttp.responseText);
            console.log(data);
        }
    };
    xmlhttp.open("GET", "ajax_load_friends.php", true);
    xmlhttp.setRequestHeader('Content-type', 'application/json');
    xmlhttp.setRequestHeader('Authorization', 'Bearer ' + window.token);
    xmlhttp.send();
}

loadFriends();
window.setInterval(function () {
    loadFriends();
}, 1000);


// Load user
function loadUser(){
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function () {
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {

            let data = JSON.parse(xmlhttp.responseText);
            console.log(data);

            let datalist = document.getElementById("friend-selector");
            for (let i = 0; i < data.length; i++) {

                // Nutzer laden
                let user = data[i];

                let option = document.createElement("option");
                option.innerHTML = user;

                datalist.appendChild(option);

            }
        }
    };
    xmlhttp.open("GET", "ajax_load_users.php", true);
    xmlhttp.setRequestHeader('Authorization', 'Bearer eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJ1c2VyIjoiVG9tIiwiaWF0IjoxNjI5ODkzNTkwfQ.MRSZeLY8YNGp1dBWoYLUXTfs4ci1v13TkhQmke2nfII');
    xmlhttp.send();

}