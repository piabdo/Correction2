/************** PAGING *************** */
nb_pics = 12;
xmlhttp = new XMLHttpRequest();
xmlhttp.onreadystatechange = function() {
        if (xmlhttp.readyState == 4) {
            if (xmlhttp.status == 200)
                document.getElementById("m_pictures").innerHTML += xmlhttp.responseText;
    }
};
xmlhttp.open("POST", "model/load_index.php", true);
xmlhttp.setRequestHeader("Content-type", "text/plain");
xmlhttp.send(nb_pics);

function paging() {
    document.getElementById("menu").style.height = "auto";
    nb_pics += 12;
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
            if (xmlhttp.readyState == 4) {
                if (xmlhttp.status == 200)
                    document.getElementById("m_pictures").innerHTML += xmlhttp.responseText;
        }
    };
    xmlhttp.open("POST", "model/load_index.php", true);
    xmlhttp.setRequestHeader("Content-type", "text/plain");
    xmlhttp.send(nb_pics);
}
/*********************************** */
/*************** MODAL ************* */
function print_com(img) {
    var modalImg = document.getElementById("img01");
    document.getElementById("myModal").style.display = "flex";
    modalImg.src = img.src;
    load_likes(modalImg);
    load_like_status(modalImg);
    load_comments();
}

function koko() {
    document.getElementById("myModal").style.display = "none";
    clear_com();
}
/************************************ */
/************** LIKES  ************** */
function load_likes(likes) {
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
            if (xmlhttp.readyState == 4) {
                if (xmlhttp.status == 200)
                    document.getElementById("likes_nb").innerHTML = xmlhttp.responseText;
        }
    };
    xmlhttp.open("POST", "model/load_likes.php", true);
    xmlhttp.setRequestHeader("Content-type", "text/plain");
    xmlhttp.send(likes.src);
}

function load_like_status(likes) {
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
            if (xmlhttp.readyState == 4) {
                if (xmlhttp.status == 200)
                {
                    if (xmlhttp.responseText == 0)
                    {
                        document.getElementById("likes").style.opacity = "0.5";
                        op = 0;
                    }
                    else
                    {
                        document.getElementById("likes").style.opacity = "1";
                        op = 1;
                    }
                }
        }
    };
    xmlhttp.open("POST", "model/load_like_status.php", true);
    xmlhttp.setRequestHeader("Content-type", "text/plain");
    xmlhttp.send(likes.src);
}

function likes() {
    likes_img = document.getElementById("img01");
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
            if (xmlhttp.readyState == 4) {
                if (xmlhttp.status == 200)
                {
                    if (xmlhttp.responseText == 0)
                    {
                        document.getElementById("likes").style.opacity = "0.5";
                        integer = parseInt(document.getElementById("likes_nb").innerHTML, 10);
                        document.getElementById("likes_nb").innerHTML = integer - 1;
                        op = 0;
                    }
                    else
                    {
                        document.getElementById("likes").style.opacity = "1";
                        integer = parseInt(document.getElementById("likes_nb").innerHTML, 10);
                        document.getElementById("likes_nb").innerHTML = integer + 1;
                        op = 1;
                    }
                }
        }
    };
    xmlhttp.open("POST", "model/likes.php", true);
    xmlhttp.setRequestHeader("Content-type", "text/plain");
    xmlhttp.send(likes_img.src);
}

function op_img1(seal) {
    if (op == 0)
        seal.style.opacity = '1';
    else
        seal.style.opacity = '0.5';

}
function op_img2(seal) {
    if (op == 0)
        seal.style.opacity = '0.5';
    else
        seal.style.opacity = '1';

}
/********************************** */
/***************SHARE ************* */
function share_facebook(){
    var button = document.getElementsByClassName('share_facebook');
    var src = document.getElementById('img01').src;
    var shareUrl = "https://www.facebook.com/sharer/sharer.php?u=" + encodeURIComponent(src);
    var left = window.screenLeft || window.screenX;
    var top = window.screenTop || window.screenY;
    var width = window.innerWidth || document.documentElement.clientWidth;
    var height = window.innerHeight || document.documentElement.clientHeight;
    var popupWidth = 640;
    var popupHeight = 320;
    var popupLeft = left + width / 2 - popupWidth / 2;
    var popupTop = top + height /2 - popupHeight / 2;
    window.open(shareUrl, "Share", 'scrollbars=yes, width=' + popupWidth + ', height=' + popupHeight + ', top=' + popupTop + ', left=' + popupLeft + '');
}
/********************************** */
/*************COMMENTS ************ */


function clear_com() {
    var el = document.getElementById('caption');

    while ( el.firstChild ) el.removeChild( el.firstChild );
}

function del_com(cross){
    var com = cross.parentNode.firstChild.innerHTML;
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
        if (xmlhttp.readyState == 4) {
            if (xmlhttp.status == 200)
                cross.parentNode.parentNode.removeChild(cross.parentNode);
        }
    };
    xmlhttp.open("POST", "model/del_comments.php", true);
    xmlhttp.setRequestHeader("Content-type", "text/plain");
    xmlhttp.send(com);
}

function set_cross(new_holder) {
    var com = new_holder.firstChild.innerHTML;
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
        if (xmlhttp.readyState == 4) {
            if (xmlhttp.status == 200)
            {
                if (xmlhttp.responseText == "1")
                {   
                    var cross = document.createElement("div");
                    var x = document.createElement("p");
                    x.innerHTML = "x";
                    cross.setAttribute("id", "del_cross");
                    cross.setAttribute("onclick", "del_com(this)");
                    cross.appendChild(x);
                    new_holder.appendChild(cross);                  
                }
            }
        }
    };
    xmlhttp.open("POST", "model/load_cross.php", true);
    xmlhttp.setRequestHeader("Content-type", "text/plain");
    xmlhttp.send(com);
}

function load_comments() {
    var img_src = document.getElementById('img01').src;
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
        if (xmlhttp.readyState == 4) {
            if (xmlhttp.status == 200)
            {
                if (xmlhttp.responseText == "0")
                    return;
                var json = JSON.parse(xmlhttp.responseText);
                i = 0;
                while (json["com"][i])
                {
                    var new_holder = document.createElement("div");
                    var new_content = document.createElement("p");
                    new_content.innerHTML = "Le Chevalier " + json["id_usr"][i] + " a clamé le " + json["send_date"][i] +" : " + json["com"][i];
                    new_holder.appendChild(new_content);
                    new_holder.setAttribute("id", "com_holder");
                    set_cross(new_holder);
                    var currentDiv = document.getElementById('caption');
                    currentDiv.appendChild(new_holder);
                    i++;
                }
                document.getElementById("add").onkeypress = function(e) {
                    var key = e.charCode || e.keyCode || 0;     
                    if (key == 13) {
                      e.preventDefault();
                    }
                }
            }
        }
    };
    xmlhttp.open("POST", "model/load_comments.php", true);
    xmlhttp.setRequestHeader("Content-type", "text/plain");
    xmlhttp.send(img_src);
}

function add_com() {
    var com = document.getElementById('com').value;
    if (com === null || com === '')
        return;
    var img_src = document.getElementById('img01').src;
    document.getElementById('com').value = "";
    json = JSON.stringify([com, img_src]);
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
        if (xmlhttp.readyState == 4) {
            if (xmlhttp.status == 200)
            {
                if (error = xmlhttp.responseText)
                    alert(error);
                else {
                    load_comments();
                    clear_com();   
                }
            }
	    if(xmlhttp.status == 401)
		return;
        }
    };
    xmlhttp.open("POST", "model/comments.php", true);
    xmlhttp.setRequestHeader("Content-type", "text/plain");
    xmlhttp.send(json);
}
/********************************** */
