
window.backendUrl = "https://online-lectures-cs.thi.de/chat/f00a3c26-3aa4-40c6-a772-5adebc4c3689";
window.token = "eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJ1c2VyIjoiVG9tIiwiaWF0IjoxNzMyMTkyODk4fQ.eG5Bqpm99eI12eWnB_puyn3enKMFjxhcIrmBNyt1Br8";

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