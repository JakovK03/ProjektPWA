document.getElementById("registration").onclick = function(event) {
    var slanje_forme = true;

    var unameElement = document.getElementById("uname");
    var unameValue = document.getElementById("uname").value;
    if (unameValue.length < 10) {
        slanje_forme = false;
        unameElement.style.border = "1px dashed red";
        document.getElementById("unameMsg").innerHTML = "Username can't be under 10 characters long!<br><br>";
    } else {
        unameElement.style.border = "";
        document.getElementById("unameMsg").innerHTML = "";
    }
    
    var passElement = document.getElementById("pass");
    var passValue = document.getElementById("pass").value;
    if (passValue.length < 12) {
        slanje_forme = false;
        passElement.style.border = "1px dashed red";
        document.getElementById("passMsg").innerHTML = "Password can't be under 12 characters long!<br><br>";
    } else {
        passElement.style.border = "";
        document.getElementById("passMsg").innerHTML = "";
    }

    var countryElement = document.getElementById("country");
    var countryValue = document.getElementById("country").value;
    if (countryValue == "Please select") {
        slanje_forme = false;
        countryElement.style.border = "1px dashed red";
        document.getElementById("countryMsg").innerHTML = "Please select your country!<br><br>";
    } else {
        countryElement.style.border = "";
        document.getElementById("countryMsg").innerHTML = "";
    }

    if (slanje_forme != true || window.confirm("Create account?") == false) {
        event.preventDefault();
    }
}