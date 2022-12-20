<?php 
namespace App\Controllers;

use App\Models\Article\TipohabitacionModel as ArticleTipohabitacionModel;
use Config\Services;
use CodeIgniter\API\ResponseTrait;
use CodeIgniter\RESTful\ResourceController;
use Exception;
use App\Models\HotelHabitacionModel;
use App\Models\HotelModel;

// headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=utf8");
header("Access-Control-Allow-Headers: Content-Type, Access-Control");

//grupo de la unidad de servicios de salud
class HotelHabitacion extends ResourceController{
    
    use ResponseTrait;

    public function getallData(){
        
        try {
            
            $thotelhabitacion = new HotelHabitacionModel();
            if (!empty($_POST['fk_hotel']) && !empty($_POST['fk_tipohabitacion']) && !empty($_POST['cantidad']) ) {
            //vedrifico si llega información
            $exis_data = $thotelhabitacion->get_all();
                if (!empty($exis_data)) {

                    $response = [
                        'status' => 200,
                        "error" => FALSE,
                        'data' => $exis_data,
                    ];

                } else {

                    $response = [
                        'status' => 400,
                        "error" => TRUE,
                        'messages' => 'Error, tabla sin datos',
                    ];
                }

            return $this->respond($response);
        } catch (\Exception $e) {
            //throw new \RuntimeException($e->getMessage(), $e->getCode(), $e);
            return $this->failServerError('se ha presntado una exepción ' . $e->getMessage());
        }
    }

    public function insertData(){
        
        try {
            $thotelhabitaModel = new HotelModel();
             //vedrifico si llega información obligatoria
             if (!empty($_POST['fk_hotel']) && !empty($_POST['fk_tipohabitacion']) && !empty($_POST['cantidad']) ) {
                //consulto la cantidad total que puede tener el hotel
                $thotelModel = new HotelModel();
                $total_h = $thotelModel->get_thabitaciones();
                //obtengo la cantidad de habitaciones asociadas
                $count_data = $thotelhabitacion->count_all();
                if (!empty($count_data) &&  $count_data < $thotelModel ) {
                    $total=($count_data+$_POST['cantidad']);
                    //valido que no supero el numero de habitaciones
                    if($total > $thotelModel){
                        $response = [
                            'status' => 401,
                            "error" => TRUE,
                            'messages' => 'Excede el valor de las habitaciones para el hotel',
                        ];
                    }
                }

                $data = [
                    "fk_hotel" => $this->request->getVar("nombre"),
                    "fk_tipohabitacion" => $this->request->getVar("ciudad"),
                    "cantidad" => $this->request->getVar("numero_hab"),
                ];
               //valido si ya esta registrado el correo y envio exeption
               $exis_d = $thabitacionModel->exist_t($data);

               if ($exis_d) {
                   $response = [
                       'status' => 401,
                       "error" => TRUE,
                       'messages' => 'El valor ya existe',
                   ];
               } else {
                   //Envio datos al modelo para insertar
                   $insert_t = $thabitacionModel->insert_t($data);

                   if ($insert_t) {
                       $response = [
                           'status' => 201,
                           "error" => FALSE,
                           'messages' => 'Tipo creado',
                       ];
                   } else {

                       $response = [
                           'status' => 500,
                           "error" => TRUE,
                           'messages' => 'Fallo al crear',
                       ];
                   }
               }
           } else {

               $response = [
                   'status' => 409,
                   "error" => TRUE,
                   'messages' => 'No se encontraron variables de envio obligatorias',
               ];
           }
       } catch (\Exception $e) {
           $response = [
               'status' => 500,
               "error" => TRUE,
               'messages' => 'se ha presntado una exepción ' . $e->getMessage(),
           ];
           //die($e->getMessage());
       }
       return $this->respond($response);

    }

}