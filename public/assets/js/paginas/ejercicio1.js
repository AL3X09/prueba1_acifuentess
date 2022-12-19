//creado por Alex CS
$(document).ready(function () {
  
  
});

function ejercicio1() {

  $.ajax({
    url: base_url + '/api/prueba/e1',
    method: 'POST',
    data: $("#fbisiesto").serialize(),
    beforeSend: function () {
      Swal.fire('Esperando respuesta');
    },
    success: function (data) {

      if (data.status == '200') {
        $.each(data.data, function (k, v) {

        });

      } else {
        Swal.fire(data.messages);
      }
    },
    error: function (data) {
      Swal.fire('Error al conectar con el controlador');
    }

  });
}
