
function cambiarContenido(event, seccionId) {
  event.preventDefault(); // Evita el comportamiento predeterminado de los enlaces

  // Oculta todas las secciones de contenido
  var secciones = document.querySelectorAll('section[id^="contenido-"]');
  for (var i = 0; i < secciones.length; i++) {
    secciones[i].style.display = "none";
  }

  // Muestra la sección de contenido seleccionada
  var seccion = document.getElementById(seccionId);
  seccion.style.display = "block";
}

