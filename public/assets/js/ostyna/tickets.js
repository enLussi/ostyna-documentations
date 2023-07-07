const versionForm = document.getElementById('version');
const listForm = document.getElementById('list');
const ticketForm = document.getElementById('ticket');
const remarkForm = document.getElementById('remark');
const sendbutton = document.getElementById('sendbutton');

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
  }
}

listForm.onchange = () => {
  if(document.getElementById('tickets').value.length > 0) {
    listForm.setAttribute("hidden", true);
    remarkForm.removeAttribute("hidden");
    sendbutton.removeAttribute("hidden");
  } else if(document.getElementById('new_ticket').checked) {
    isnew = document.getElementById('new_ticket').checked;
    listForm.setAttribute("hidden", true);
    ticketForm.removeAttribute("hidden");
    sendbutton.removeAttribute("hidden");
  }
}

sendbutton.onclick = () => {

  let formData = new FormData();

  formData.append("version", version);
  formData.append("isnew", isnew);
  if(isnew) {
    let ticketdata = new FormData(ticketForm);
    ticketdata.forEach((data, index) => {
      formData.append(index, data);
    });
  } else {
    let remarkdata = new FormData(remarkForm);
    remarkdata.forEach((data, index) => {
      formData.append(index, data);
    });
  }

  fetch(window.location.pathname, {
    method: 'POST',
    body: formData
  })
    .then(response => response.text())
    .then(result => console.log(result));

}