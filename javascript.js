function enviarDatos() {
  var dato1 = document.getElementById("dato1").value;
  var dato2 = document.getElementById("dato2").value;
  // Agrega más campos según sea necesario

  var data = {
    nombre : dato1,
    apellido: dato2
  };

  console.log(data)

  var url = "https://script.google.com/macros/s/AKfycbxYl1OU-MrNi3E21LhoAG6WLTJ_v60KaId6JJAW0TOVghLKaPaxLIMcpfpNI0fjFoVyXA/exec";  // Reemplaza con la URL de tu script de Google Apps Script
  var script = document.createElement('script');
  script.src = url + '?callback=handleResponse&data=' + encodeURIComponent(JSON.stringify(data));
  document.body.appendChild(script);

  console.log(script)

}

function handleResponse(response) {
  console.log(response);
  // Tu lógica aquí para manejar la respuesta
}
