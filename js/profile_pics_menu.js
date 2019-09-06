
function readystatechange2(xmlhttp){
    if (xmlhttp.readyState == 4) {
        if (xmlhttp.status == 200)
            document.getElementById('close').click();
    }
}

function delete_pic() {
    var pic = document.getElementById('img01');
    var json = JSON.stringify(pic.src);
    var list_img = document.getElementsByClassName('d_img');
    for (var i = 0; i <= 11; i++) {
        if(list_img[i].src == pic.src)
            {
                list_img[i].remove();
                break;
            }
    }
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() { readystatechange2(xmlhttp); };
    xmlhttp.open("POST", "model/delete_pic.php", true);
    xmlhttp.setRequestHeader("Content-type", "text/plain");
    xmlhttp.send(json);
}

// Get the modal
var modal = document.getElementById("myModal");
function print_com(img) {
    var modalImg = document.getElementById("img01");
    var captionText = document.getElementById("caption");
    modal.style.display = "flex";
    modalImg.src = img.src;
    captionText.innerHTML = "Cliquez ici pour supprimer la photo.";
    captionText.setAttribute("onclick", "delete_pic()");
}

// Get the <span> element that closes the modal
var span = document.getElementsByClassName("close")[0];

// When the user clicks on <span> (x), close the modal
span.onclick = function() {
    modal.style.display = "none";
}