function change_done(id) {
    var xhttp = new XMLHttpRequest();
    xhttp.open("GET", "change_done.php?id=" + id, true);
    xhttp.send();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4)
            document.getElementById(id).innerHTML = xhttp.responseText;
    }
}