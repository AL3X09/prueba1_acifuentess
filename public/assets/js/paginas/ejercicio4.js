//creado por Alex CS
$(document).ready(function () {
  var G1 = letra(10);
  var G2 = letra(10);
  $("#g1").val(G1)
  $("#g2").val(G2)
});

function letra(length) {
  var result           = '';
  var characters       = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
  var charactersLength = characters.length;
  for ( var i = 0; i < length; i++ ) {
      result += characters.charAt(Math.floor(Math.random() * charactersLength))+',';
  }
  return result;
}


function ejercicio4() {

  $.ajax({
    url: base_url + '/api/prueba/e4',
    method: 'POST',
    data: $("#farreglo").serialize(),
    beforeSend: function () {
      Swal.fire("Solicitando datos espere...");
    },
    success: function (data) {

      if (data.status == '201') {
        Swal.fire({
          title: data.messages,
          icon: 'info',
          html: '<input value="'+data.data.message1+'" readonly>'
                +'<input value="'+data.data.union+'" readonly>'
                +'<input value="'+data.data.message2+'" readonly>'
                +'<input value="'+data.data.interseccion+'" readonly>'
                +'<input value="'+data.data.message3+'" readonly>'
                +'<input value="'+data.data.diferen+'" readonly>',
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
