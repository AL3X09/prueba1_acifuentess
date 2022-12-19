//creado por Alex CS
$(document).ready(function () {
  
  
});

function ejercicio2() {
  var filas = $('#filas').val();
  var columnas = $('#columnas').val();
  var tabla = $('#datadina');

  for (var i = 0; i < filas; i++) {
    row = $('<tr></tr>');
    tabla.append('<tr>');
    for (var j = 0; j < columnas; j++) {
      var rowData = $('<td>columna '+(j+1)+' </td>');
      row.append(rowData);
    }
    tabla.append(row);
  }
  
}
