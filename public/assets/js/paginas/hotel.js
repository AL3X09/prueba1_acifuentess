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
                    url: base_url+"/api/hotel/listar",
                    dataType: "json",
                }).done(function(response) {
                    d.resolve(response.data);
                    //console.log(response.data);
                });
                return d.promise();
            }
        },
        fields: [
          {name: "id_h", title: 'ID', type: "text"},
          {name: "nombre_h", title: 'Nombre', type: "text", },
          {name: "ciudad", title: 'Ciudad', type: "text", },
          {name: "direccion", title: 'Dirección', type: "text", },
          {name: "nit", title: 'NIT', type: "text", },
          {name: "num_habitaciones", title: 'Numero de Hab', type: "text", },
          {name: "datos_h", title: 'Datos Hsbitación', type: "textarea", width: 50, align: "center",

            itemTemplate: function(value, item) {
                //console.log(value);
                //console.log(item);
                var $nestedGrid = $("<div>");          
                $nestedGrid.jsGrid({
                    width: 200,
                height: "auto",
                data: item.datos,
                heading: false,
                fields: [
                    { name: "tipo_habi", title: 'Fecha', type: "text", width: 200 },
                    { name: "acomodacion", title: 'Tipo de cambio', type: "number", width: 200 },
                    { name: "cantidad", title: 'Tipo de cambio', type: "number", width: 200 },
                ]
                });
                return $("<td>").append($nestedGrid);
                }
          },
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
      '<label for="fname">Tipo:</label><br>'+
      '<input type="text" id="tipo" name="tipo" class="form-control">'+
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
        url: base_url + '/api/tipohabitacion/insertar',
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

}