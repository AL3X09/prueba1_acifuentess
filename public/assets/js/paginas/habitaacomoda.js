//creado por Alex CS
$(document).ready(function () {
  ejercicio5();
});

function ejercicio5(){
    $("#tabla").jsGrid({
        width: "100%",
        height: "auto",
        autoload: true,
        paging: true,
        controller: {
            loadData: function() {
                var d = $.Deferred();
 
                $.ajax({
                    url: base_url+"/api/habitacomoda/listar",
                    dataType: "json",
                }).done(function(response) {
                    d.resolve(response.data);
                    //console.log(response.data);
                });
                return d.promise();
            }
        },
        fields: [
          {name: "tipo", title: 'Tipo Habitación', type: "text"},
          {name: "nombre", title: 'Acomodación', type: "text"}, 
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
      '<label for="fname">Tipo Habitación:</label><br>'+
      '<select id="fk_tipo_habitacion" name="fk_tipo_habitacion" class="form-control">'+
      '</select>'+
      '<label for="fname">Acomodación:</label><br>'+
      '<select id="fk_acomodacion" name="fk_acomodacion" class="form-control">'+
      '</select>'+
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
        url: base_url + '/api/habitacomoda/insertar',
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
  listartipo()
}

function listartipo(){
//limpio select
$('#fk_tipo_habitacion')
.find('option')
.remove()
.end()
.append('<option value="">Seleccione</option>')
.val('');
//cargo select
  $.ajax({
    url: base_url + '/api/tipohabitacion/listar',
    method: 'GET',
    success: function (data) {

      if (data.status == '200') {
        $.each(data.data, function (k, v) {
          $("#fk_tipo_habitacion").append('<option value=' + v.id_habi + '>' +v.tipo+ '</option>');
          
          /*if ($("#fk_tipo_habitacion").length) {
            $("#fk_tipo_habitacion").append('<option value=' + v.id_tbl_serv_ofertado + '>' +v.nombre_serv + '</option>');
            $("#fk_tipo_habitacion").val($idsvo);
          }*/
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
  $('#fk_acomodacion')
  .find('option')
  .remove()
  .end()
  .append('<option value="">Seleccione</option>')
  .val('');
  //cargo select
    $.ajax({
      url: base_url + '/api/acomodacion/listar',
      method: 'GET',
      success: function (data) {
  
        if (data.status == '200') {
          $.each(data.data, function (k, v) {
            $("#fk_acomodacion").append('<option value=' + v.id_acom + '>' +v.nombre+ '</option>');
            
            /*if ($("#fk_tipo_habitacion").length) {
              $("#fk_tipo_habitacion").append('<option value=' + v.id_tbl_serv_ofertado + '>' +v.nombre_serv + '</option>');
              $("#fk_tipo_habitacion").val($idsvo);
            }*/
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