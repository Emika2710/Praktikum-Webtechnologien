
function checkUserExists(){
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function () {
        if (xmlhttp.readyState == 4) {
            if(xmlhttp.status == 204) {
                console.log("Exists");

                // neuer Feedback Text
                let feedback = document.getElementsByClassName('invalid-feedback')[0];
                feedback.innerHTML = "Username already exists";

                document.getElementById("register_username").classList.add("is-invalid");
                document.getElementsByClassName('invalid-feedback')[0].style.display = 'block';
            
            } else if(xmlhttp.status == 404) {
                console.log("Does not exist");
                document.getElementById("register_username").classList.add("is-valid");
                document.getElementsByClassName('invalid-feedback')[0].style.display = 'none';
            }
        }
    };
    var username = document.getElementById("register_username").value;
    xmlhttp.open("GET", "ajax_check_user.php?user="+username, true);
    xmlhttp.send();
}

// Register Functions
function checkUsername(){
    var username = document.getElementById("register_username");

    username.classList.remove('is-valid', 'is-invalid');
    if(username.value.length > 2){
        checkUserExists();
    } 
    else{
        // neuer Feedback Text
        let feedback = document.getElementsByClassName('invalid-feedback')[0];
        feedback.innerHTML = "Username must be at least 3 characters long";

        username.classList.add("is-invalid");
        document.getElementsByClassName('invalid-feedback')[0].style.display = 'block';

    }
    
}

function checkPassword(){
    var password = document.getElementById("register_password");

    password.classList.remove('is-valid', 'is-invalid');
    if(password.value.length >= 8){
        password.classList.add("is-valid");
        document.getElementsByClassName('invalid-feedback')[1].style.display = 'none';
    } 
    else{
        password.classList.add("is-invalid");
        document.getElementsByClassName('invalid-feedback')[1].style.display = 'block';
    }

}

function checkConfirm(){
    var password = document.getElementById("register_password");
    var confirm = document.getElementById("register_confirm");

    confirm.classList.remove('is-valid', 'is-invalid');
    if(confirm.value == password.value){
        confirm.classList.add("is-valid");
        document.getElementsByClassName('invalid-feedback')[2].style.display = 'none';
    } 
    else{
        confirm.classList.add("is-invalid");
        document.getElementsByClassName('invalid-feedback')[2].style.display = 'block';
    }
}