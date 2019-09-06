var constraints = { audio: false, video: true };
navigator.mediaDevices.getUserMedia(constraints)
.then(function (mediaStream) {
 var video = document.querySelector('video');
 video.srcObject = mediaStream;
 video.onloadmetadata = function(e) {
   video.play();
 };
})


/* *******************************FILTERS*********************************** */

function ft_on_edit(ftr) {
  on_edit = ftr;
}
function remove() {
  if(on_edit == null)
  {
    alert('Aucun filtre sélectionné');
    return;
  }
  var to_remove = on_edit;
  on_edit = null;
  to_remove.parentNode.removeChild(to_remove);
}
function increase() {
  if (typeof(on_edit) !== 'undefined') {
  var to_increase = on_edit;
  var width = to_increase.width + 5;
  to_increase.style.width = width;
  var height = to_increase.height + 5;
  to_increase.style.height = height;
  }
}
function decrease() {
  if (typeof(on_edit) !== 'undefined') {
  var to_increase = on_edit;
  var width = to_increase.width - 5;
  to_increase.style.width = width;
  var height = to_increase.height - 5;
  to_increase.style.height = height;
  }
}
function turn() {
  alert('Fonction en développement')
}

var drag = "drag";
function addfilter(filter) {
  var d_webcam = document.getElementById('d_webcam');
  var img = filter.src;
  var ftr = document.createElement('IMG');
  ftr.src = img;
  ftr.className = 'sticky';
  ftr.id = drag;
  ftr.setAttribute('onclick', 'ft_on_edit(this)');
  ft_on_edit(ftr);
  d_webcam.appendChild(ftr);
  dragElement(document.getElementById(drag));
  drag = drag + 1;
}

function dragElement(elmnt) {
  
  var pos1 = 0, pos2 = 0, pos3 = 0, pos4 = 0;
  if (document.getElementById(elmnt.id + "header")) {
    /* if present, the header is where you move the DIV from:*/
    document.getElementById(elmnt.id + "header").onmousedown = dragMouseDown;
  } else {
    /* otherwise, move the DIV from anywhere inside the DIV:*/
    elmnt.onmousedown = dragMouseDown;
  }

  function dragMouseDown(e) {
    e = e || window.event;
    e.preventDefault();
    // get the mouse cursor position at startup:
    pos3 = e.clientX;
    pos4 = e.clientY;
    document.onmouseup = closeDragElement;
    // call a function whenever the cursor moves:
    document.onmousemove = elementDrag;
  }

  function elementDrag(e) {
    e = e || window.event;
    e.preventDefault();
    // calculate the new cursor position:
    pos1 = pos3 - e.clientX;
    pos2 = pos4 - e.clientY;
    pos3 = e.clientX;
    pos4 = e.clientY;
    // set the element's new position:
    elmnt.style.top = (elmnt.offsetTop - pos2) + "px";
    elmnt.style.left = (elmnt.offsetLeft - pos1) + "px";
  }

  function closeDragElement() {
    /* stop moving when mouse button is released:*/
    document.onmouseup = null;
    document.onmousemove = null;
  }
}

/* ************************************************************************ */