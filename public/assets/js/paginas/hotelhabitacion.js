//creado por Alex CS
$(document).ready(function () {
  ejercicio5();
});

function ejercicio5(){
    $("#tabla").jsGrid({
        width: "100%",
        height: "auto",
        autoload:   true,
        paging:     true,
        controller: {
            loadData: function() {
                var d = $.Deferred();
 
                $.ajax({
                    url: base_url+"/api/hotelhabita/listar",
                    dataType: "json",
                }).done(function(response) {
                    d.resolve(response.data);
                    //console.log(response.data);
                });
                return d.promise();
            }
        },
        fields: [
          {name: "id_hh", title: 'ID', type: "text"},
          {name: "nombre_h", title: 'Hotel', type: "text", },
          {name: "tipo", title: 'Tipo Habitación', type: "text", },
          {name: "nombre", title: 'Acomodación', type: "text", },
          {name: "cantidad", title: 'Cantidad', type: "text", },
          {
            type: "control",
            modeSwitchButton: false,
            editButton: false,
            headerTemplate: function() {
                return $("<button>").attr("type", "button").addClass("btn btn-info").text("Nuevo")
                        .on("click", function () {
                          dialogAdd();
                        });
            }
          },
        ]
      });
}
function dialogAdd(){
  Swal.fire({
    title: '<strong>Ingresar Nuevo Registro</strong>',
    icon: 'info',
    html:
    '<form id="nuevo_r">'+
    '<label for="fname">Hotel:</label><br>'+
    '<select id="fk_hotel" name="fk_hotel" class="form-control">'+
    '</select>'+
    '<label for="fname">Tipo Habitacion:</label><br>'+
    '<select id="fk_habitacion_acomo" name="fk_habitacion_acomo" class="form-control">'+
    '</select>'+
    '<label for="fname">Cantidad:</label><br>'+
    '<input type="text" id="cantidad" name="cantidad" class="form-control">'+
    '</form> ',
    showCloseButton: true,
    showCancelButton: true,
    focusConfirm: false,
    confirmButtonText:
      '<button type="submit" class="btn btn-primary">Enviar</button>',
    //confirmButtonAriaLabel: 'Thumbs up, great!',
    cancelButtonText:
      '<button type="submit" class="btn btn-danger">Cancelar</button>',
    //cancelButtonAriaLabel: 'Thumbs down'
  }).then((result) => {
    /* Read more about isConfirmed, isDenied below */
    if (result.isConfirmed) {
      //ajax insert
      $.ajax({
        url: base_url + '/api/hotelhabita/insertar',
        method: 'POST',
        data: $("#nuevo_r").serialize(),
        beforeSend: function () {
          Swal.fire("Enviando datos espere...");
        },
        success: function (data) {
    
          if (data.status == '201') {
            Swal.fire({
              title: data.messages,
              icon: 'success',
              timer: 1500,
              willClose: () => {
                window.location.reload();
              }
            })
          } else {
            Swal.fire(data.messages);
          }
        },
        error: function (data) {
          Swal.fire('Error al conectar con el controlador');
        }
      })
      
    } else if (result.isDenied) {
      Swal.fire('Operación cancelada', '', 'info')
    }
  })

  listarhotel();
}

function listarhotel(){
//limpio select
$('#fk_hotel')
.find('option')
.remove()
.end()
.append('<option value="">Seleccione</option>')
.val('');
//cargo select
  $.ajax({
    url: base_url + '/api/hotel/listar',
    method: 'GET',
    success: function (data) {

      if (data.status == '200') {
        $.each(data.data, function (k, v) {
          $("#fk_hotel").append('<option value=' + v.id_h + '>' +v.nombre_h+ '</option>');
        });

      } else {
        Swal.fire(data.messages);
      }
    },
    error: function (data) {
      Swal.fire('Error al conectar con el controlador');
    }
  })
  listaracomo();
}

function listaracomo(){
  //limpio select
  $('#fk_habitacion_acomo')
  .find('option')
  .remove()
  .end()
  .append('<option value="">Seleccione</option>')
  .val('');
  //cargo select
    $.ajax({
      url: base_url + '/api/habitacomoda/listar',
      method: 'GET',
      success: function (data) {
  
        if (data.status == '200') {
          $.each(data.data, function (k, v) {
            $("#fk_habitacion_acomo").append('<option value=' + v.id_hc + '>' +v.tipo+'-'+v.nombre+ '</option>');
          });
  
        } else {
          Swal.fire(data.messages);
        }
      },
      error: function (data) {
        Swal.fire('Error al conectar con el controlador');
      }
    })
}