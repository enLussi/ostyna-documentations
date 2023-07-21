const versionForm = document.getElementById('version');
const listForm = document.getElementById('list');
const ticketForm = document.getElementById('ticket');
const remarkForm = document.getElementById('remark');
const sendbutton = document.getElementById('sendbutton');

const loadingBar = document.getElementById('percentage');
const indicator = document.getElementById('indicator');

loadingBar.style.width = loadingBar.dataset.perc+"%";

console.log(indicator);

let version = null;
let isnew = false;

let ticket = null;

let remark = null;

listForm.setAttribute("hidden", true);
ticketForm.setAttribute("hidden", true);
remarkForm.setAttribute("hidden", true);
sendbutton.setAttribute("hidden", true);

versionForm.onchange = () => {
  if(document.getElementById('version-select').value.length > 0 ) {
    version = document.getElementById('version-select').value; 
    versionForm.setAttribute("hidden", true);
    listForm.removeAttribute("hidden");

    addPercentage(25);
  }
  
}

listForm.onchange = () => {
  if(document.getElementById('tickets').value.length > 0) {
    listForm.setAttribute("hidden", true);
    remarkForm.removeAttribute("hidden");
    sendbutton.removeAttribute("hidden");

    addPercentage(25);
  } else if(document.getElementById('new_ticket').checked) {
    isnew = document.getElementById('new_ticket').checked;
    listForm.setAttribute("hidden", true);
    ticketForm.removeAttribute("hidden");
    sendbutton.removeAttribute("hidden");

    addPercentage(25);
  }
}

sendbutton.onclick = () => {

  let formData = new FormData();
  let isValid = true;

  formData.append("version", version);
  formData.append("isnew", isnew);
  if(isnew) {
    let ticketdata = new FormData(ticketForm);
    ticketdata.forEach((data, index) => {
      if(typeof(data) == "string" && data !== "") {
        formData.append(index, data);
      } else {
        isValid = false;
      }
    });
  } else {
    let remarkdata = new FormData(remarkForm);
    remarkdata.forEach((data, index) => {
      if(typeof(data) == "string" && data !== "") {
        formData.append(index, data);
      } else {
        isValid = false;
      }
    });
  }

  if (isValid) {
    addPercentage(25);

    fetch(window.location.href, {
      method: 'POST',
      body: formData,
      mode: 'same-origin',
    })
    .then(response => response.text())
    .then(result => {
      addPercentage(25);

      setTimeout(function(){
        window.location.href = "/tickets"
      }, 5000)
    })
  } 
}

function addPercentage(percent) {
  loadingBar.dataset.perc = parseInt(loadingBar.dataset.perc) + percent;
  if(loadingBar.dataset.perc >= 100) {
    loadingBar.dataset.perc = 100;
    fullPercentage();
  }

  loadingBar.style.width = loadingBar.dataset.perc+"%";

}

function fullPercentage() {
  indicator.classList.add("indicate");
  indicator.innerHTML = "<p>Terminé</p>";
}