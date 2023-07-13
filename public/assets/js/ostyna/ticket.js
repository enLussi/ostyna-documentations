const selectState = document.getElementById("state");

selectState.onchange = () => {
  let formData = new FormData();

  formData.append("value", selectState.value);

  fetch(window.location.href, {
    method: 'POST',
    body: formData,
    mode: 'same-origin',
  })
    .then(response => response.text())
    .then(result => window.location.href = "/admin/tickets");
}