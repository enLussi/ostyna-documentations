const formButton = document.getElementById('sendChangelog');
const form = document.getElementById('newChangelog');

const editor = new EditorJS({
  holder: 'editor',
  tools: {
    raw: RawTool,
    header: Header,
    list: List
  }
});

formButton.onclick = () => {
  let data = new FormData(form);

  editor.save().then((outputData) =>{
    data.append('content', JSON.stringify(outputData))

    fetch(window.location.href, {
      method: 'POST',
      body: data,
      mode: 'same-origin',
    })
      .then(response => response.text())
      .then(result => 
        window.location.href = "/admin/changelogs"
      );
  }).catch((error) => {
    console.alert('Saving failed: ', error)
  });

  
}