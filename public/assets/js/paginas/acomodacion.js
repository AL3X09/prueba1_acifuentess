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
                    url: base_url+"/api/acomodacion/listar",
                    dataType: "json",
                }).done(function(response) {
                    d.resolve(response.data);
                    //console.log(response.data);
                });
                return d.promise();
            }
        },
        fields: [
          {name: "id_acom", title: 'ID', type: "text"},
          {name: "nombre", title: 'Acomodación', type: "text"},
        ]
      });
}