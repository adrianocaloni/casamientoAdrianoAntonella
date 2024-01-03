function enviarDatos() {
  var dato1 = document.getElementById("dato1").value;
  var dato2 = document.getElementById("dato2").value;
  // Agrega más campos según sea necesario

  var url = "https://script.google.com/macros/s/AKfycbwRhiuMfTu3RQebj5b-70PgzZ2rTMc3GZFROd_PGU-bjolBMl7hvUM1TKXMAFml1MYlrQ/exec";  // Reemplaza con la URL de tu script de Google Apps Script
  fetch(url, {
    method: 'POST',
    headers: {
      'Content-Type': 'application/json'
    },
    body: JSON.stringify({
      dato1: dato1,
      dato2: dato2
      // Agrega más campos según sea necesario
    })
  })
  .then(response => response.text())
  .then(data => {
    console.log(data);  // Maneja la respuesta del servidor
  })
  .catch(error => {
    console.error('Error:', error);
  });
}