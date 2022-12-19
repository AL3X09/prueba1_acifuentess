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
                    url: "https://www.banxico.org.mx/SieAPIRest/service/v1/series/SP74665,SF61745,SF60634,SF43773/datos/2022-01-01/2022-01-06?token=bcbb5d8c80634a0ff3705828ea05e3cfc55220be1b0286db2bfe0df159b01271",
                    dataType: "json",
                }).done(function(response) {
                    d.resolve(response.bmx.series);
                    //console.log(response.bmx.series);
                });
 
                return d.promise();
            }
        },
        fields: [
          {name: "idSerie", title: 'Serie', type: "text"},
          {name: "titulo", title: 'Titulo', type: "textarea", width: 150 },
          {name: "datos", title: 'Datos', type: "textarea", width: 50, align: "center",

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
                    { name: "fecha", title: 'Fecha', type: "text", width: 200 },
                    { name: "dato", title: 'Tipo de cambio', type: "number", width: 200 },
                ]
                });
                return $("<td>").append($nestedGrid);
                }
          },
        ]
      });
}