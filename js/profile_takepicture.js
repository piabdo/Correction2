function readystatechange(xmlhttp){
    if (xmlhttp.readyState == 4) {
        if (xmlhttp.status == 200)
        {
            var img = document.createElement("img");
            img.src = "https://camagru-piabdo.fr/img/picture/img" + xmlhttp.responseText + ".png";
            var sidemenu = document.getElementById("m_pictures");
            img.id = "m_img";
            img.className = "d_img";
            img.setAttribute( "onClick", "print_com(this)");
            i = 0;
            var stock = [];
            while ( sidemenu.firstChild )
            {
                stock[i] = sidemenu.firstChild;
                sidemenu.removeChild( sidemenu.firstChild );
                i++;
            }
            i = 0;
            sidemenu.appendChild(img);
            while (stock[i])
            {
                sidemenu.appendChild(stock[i]);
                i++;
            }
        }
        else if(xmlhttp.status == 401)
            alert("Veuillez vous reconnecter.");
        else if(xmlhttp.status == 204)
            alert("Vous devez selectionner au moins un filtre.");
        else
            alert('12 photos maximum par utilisateur, veuillez en supprimer.Contact support: piabdo@student.42.fr');
    }
}

function ft_grab_cam(){
    var video = document.getElementById("webcam");
    var canvas = document.getElementById("canvas");
    ctx = canvas.getContext('2d');
    try {
        ctx.drawImage(video,0,0,540,405);
    } catch (error) {
        alert("Image not found.");
        return false;
    }
    return canvas.toDataURL();
}

function ft_prepare_json() {
    var img_cam;
    var sticky = document.querySelectorAll('.sticky');
    var array_sticky = Array.prototype.slice.call(sticky);
    if ((img_cam = ft_grab_cam()) == false)
        return false;
    array_sticky.push(img_cam);
    json = JSON.stringify(array_sticky, ["src", "width", "height", "offsetTop", "offsetLeft"]);
    return json;
}

function send_json() {
    var json;
    if ((json = ft_prepare_json()) == false)
        return false;
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() { readystatechange(xmlhttp); };
    xmlhttp.open("POST", "model/takepicture.php", true);
    xmlhttp.setRequestHeader("Content-type", "application/json");
    xmlhttp.send(json);
}
/****************** IMPORT ****************************** */ 
function import_picutre()
{
    var input = document.getElementById("import");
    var sticker = document.getElementsByClassName('sticky');
    while(sticker[0])
      sticker[0].parentNode.removeChild(sticker[0]);
    input.click();
    input.addEventListener("change", function(){
        var img = document.createElement('IMG');
        var sourcevid = document.getElementById('webcam');
        sourcevid.parentNode.removeChild(sourcevid);
        if(!this.files[0])
          document.location.reload(true);
        img.src = URL.createObjectURL(this.files[0]);
        img.style.width = '540px';
        img.style.height = '405px';
        img.id = 'webcam';
        img.classList.add('uploaded');
        document.getElementById('d_webcam').style = "display:flex";
        document.getElementById('d_webcam').appendChild(img);
    });
  }