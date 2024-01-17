// Fecha de inicio: 5 de enero de 204
const fechaInicio = new Date('204-01-05T00:00:00');

// Fecha de fin: 9 de septiembre de 2024
const fechaFin = new Date('2024-09-14T00:00:00');

function actualizarContador() {
    const ahora = new Date();
    
    const diferencia = fechaFin - ahora;
    
    if (diferencia > 0) {
        const dias = Math.floor(diferencia / (1000 * 60 * 60 * 24));
        const horas = Math.floor((diferencia % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
        const minutos = Math.floor((diferencia % (1000 * 60 * 60)) / (1000 * 60));
        const segundos = Math.floor((diferencia % (1000 * 60)) / 1000);
        
        document.getElementById("dias").innerText = dias;
        document.getElementById("horas").innerText = horas;
        document.getElementById("minutos").innerText = minutos;
        document.getElementById("segundos").innerText = segundos;
    } else {
        document.getElementById("dias").innerText = "0";
        document.getElementById("horas").innerText = "0";
        document.getElementById("minutos").innerText = "0";
        document.getElementById("segundos").innerText = "0";
    }
}

// Actualizar el contador cada segundo
setInterval(actualizarContador, 1000);

function abrirInvitacion() {
    // Reemplaza 'url_de_tu_invitacion' con la URL real de tu invitación de casamiento
    window.location.href = 'tarjeta.html';
  }


    // Obtén el elemento del calendario
  const calendar = document.getElementById('calendario');

  // Función para crear el calendario
  function createCalendar() {
    const currentDate = new Date();
    const currentMonth = currentDate.getMonth();
    const daysInMonth = new Date(currentDate.getFullYear(), currentMonth + 1, 0).getDate();
    const specialDay = 14; // Día especial

    for (let day = 1; day <= daysInMonth; day++) {
      const dayElement = document.createElement('div');
      dayElement.classList.add('day');
      dayElement.textContent = day;

      // Marcar el día especial
      if (day === specialDay) {
        dayElement.classList.add('special-day');
      }

      calendar.appendChild(dayElement);
    }
  }