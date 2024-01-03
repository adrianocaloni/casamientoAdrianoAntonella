function enviarDatos() {
  var datos = "dato1,dato2,dato3";  // Aquí pones tus datos separados por comas
  var url = "https://script.google.com/macros/s/AKfycbwRhiuMfTu3RQebj5b-70PgzZ2rTMc3GZFROd_PGU-bjolBMl7hvUM1TKXMAFml1MYlrQ/exec";  // Reemplaza con la URL de tu web app de Google Apps Script
  fetch(url, {
    method: 'POST',
    payload: {
      data: datos
    }
  })
  .then(response => response.text())
  .then(data => {
    console.log(data);  // Aquí puedes manejar la respuesta
  })
  .catch(error => {
    console.error('Error:', error);
  });
}