<?php 
namespace App\Controllers;

use App\Models\Article\TipohabitacionModel as ArticleTipohabitacionModel;
use Config\Services;
use CodeIgniter\API\ResponseTrait;
use CodeIgniter\RESTful\ResourceController;
use Exception;
use App\Models\HotelModel;

// headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=utf8");
header("Access-Control-Allow-Headers: Content-Type, Access-Control");

//grupo de la unidad de servicios de salud
class Hotel extends ResourceController{
    
    use ResponseTrait;

    public function getallData(){
        
        try {
            
            $thotelModel = new HotelModel();
            //printf("entra 2: ".$exis_gus);
            //vedrifico si llega información
            $exis_hotel = $thotelModel->get_all();
                if (!empty($exis_hotel)) {

                    $response = [
                        'status' => 200,
                        "error" => FALSE,
                        'data' => $exis_hotel,
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
            $thotelModel = new HotelModel();
             //vedrifico si llega información obligatoria
             if (!empty($_POST['nombre']) ) {

                $data = [
                    "nombre" => $this->request->getVar("nombre"),
                    "ciudad" => $this->request->getVar("ciudad"),
                    "numero_hab" => $this->request->getVar("numero_hab"),
                    "direccion" => $this->request->getVar("direccion"),
                    "nit" => $this->request->getVar("nit")
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