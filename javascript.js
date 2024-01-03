function doPost(e) {
    var sheet = SpreadsheetApp.getActiveSpreadsheet().getActiveSheet();
    var newRow = sheet.getLastRow() + 1;
    sheet.getRange(newRow, 1, 1, e.parameter.dato1.split(",").length).setValues([[e.parameter.dato1, e.parameter.dato2]]);
    return ContentService.createTextOutput("Datos enviados con éxito");
  }

function enviarDatos() {
    var datos = "dato1,dato2,dato3";  // Aquí pones tus datos separados por comas
    var url = "https://docs.google.com/spreadsheets/d/1tOygYuCg-F78Rv8jSrjki7rD0igoQCcz3uhc9gRl3JY/edit?pli=1#gid=0";  // Reemplaza con la URL de tu web app de Google Apps Script
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