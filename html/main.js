
window.backendUrl = "https://online-lectures-cs.thi.de/chat/91f60642-f8d4-42ec - a26d - 84c7eb95dbc3";
window.token = "...z.B. das Token für Tom...";

const xmlhttp = new XMLHttpRequest();
xmlhttp.onreadystatechange = function () {
    if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
        let data = JSON.parse(xmlhttp.responseText);
        console.log(data);
    }
};
// Chat Server URL und Collection ID als Teil der URL
xmlhttp.open("GET", backendUrl + "/user", true);
// Das Token zur Authentifizierung, wenn notwendig
xmlhttp.setRequestHeader('Authorization', 'Bearer ' + token);
xmlhttp.send();