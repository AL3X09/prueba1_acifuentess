//creado por Alex CS
$(document).ready(function () {
  var nuemeros =[]
  for (i=0;i<=20;i++){
    nuemeros.push(Math.floor(Math.random() * 100))
  }
  
  $("#numeros").val(nuemeros)
});

function ejercicio3() {

  $.ajax({
    url: base_url + '/api/prueba/e3',
    method: 'POST',
    data: $("#farreglo").serialize(),
    beforeSend: function () {
      Swal.fire('Esperando respuesta');
    },
    success: function (data) {

      if (data.status == '201') {
        //console.log(data);
        Swal.fire({
          title: data.messages,
          icon: 'info',
          html: data.data,
        })
        
      } else {
        Swal.fire(data.messages);
      }
    },
    error: function (data) {
      Swal.fire('Error al conectar con el controlador');
    }

  });
  
}
