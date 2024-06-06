document.getElementById("submit_add").onclick = function(event) {
    var slanje_forme = true;

    var titleElement = document.getElementById("title");
    var titleValue = document.getElementById("title").value;
    if (titleValue.length < 70 || titleValue.length > 170) {
        slanje_forme = false;
        titleElement.style.border = "1px dashed red";
        document.getElementById("titleMsg").innerHTML = "Title needs to be between 70 and 170 characters long [" + titleValue.length + "]<br><br>";
    } else {
        titleElement.style.border = "";
        document.getElementById("titleMsg").innerHTML = "";
    }

    var titleSmallElement = document.getElementById("title_small");
    var titleSmallValue = document.getElementById("title_small").value;
    if (titleSmallValue.length < 35 || titleSmallValue.length > 100) {
        slanje_forme = false;
        titleSmallElement.style.border = "1px dashed red";
        document.getElementById("titleSmallMsg").innerHTML = "Short title needs to be between 35 and 100 characters long [" + titleSmallValue.length + "]<br><br>";
    } else {
        titleSmallElement.style.border = "";
        document.getElementById("titleSmallMsg").innerHTML = "";
    }

    var contentElement = document.getElementById("content");
    var contentValue = document.getElementById("content").value;
    if (contentValue.length < 1000) {
        slanje_forme = false;
        contentElement.style.border = "1px dashed red";
        document.getElementById("contentMsg").innerHTML = "Content needs to be at least 1000 characters long [" + contentValue.length + "]<br><br>";
    } else {
        contentElement.style.border = "";
        document.getElementById("contentMsg").innerHTML = "";
    }

    var fileElement = document.getElementById("image");
    var fileValue = document.getElementById("image").value;
    if (!fileValue) {
        slanje_forme = false;
        fileElement.style.color = "red";
    } else {
        fileElement.style.color = "";
    }

    var dateElement = document.getElementById("date");
    var dateValue = document.getElementById("date").value;
    if (!dateValue) {
        slanje_forme = false;
        dateElement.style.color = "red";
    } else {
        dateElement.style.color = "";
    }

    if (slanje_forme != true || window.confirm("Add news?") == false) {
        event.preventDefault();
    }

}