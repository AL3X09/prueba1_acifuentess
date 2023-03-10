<?php 
namespace App\Controllers;

use App\Models\Article\TipohabitacionModel as ArticleTipohabitacionModel;
use Config\Services;
use CodeIgniter\API\ResponseTrait;
use CodeIgniter\RESTful\ResourceController;
use Exception;
use App\Models\AcomodacionModel;

// headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=utf8");
header("Access-Control-Allow-Headers: Content-Type, Access-Control");

//grupo de la unidad de servicios de salud
class Acomodacion extends ResourceController{
    
    use ResponseTrait;

    public function getallData(){
        
        try {
            
            $acomodacionModel = new AcomodacionModel();
            //printf("entra 2: ".$exis_gus);
            //vedrifico si llega información
            $exis_acomodacion = $acomodacionModel->get_all();
                if (!empty($exis_acomodacion)) {

                    $response = [
                        'status' => 200,
                        "error" => FALSE,
                        'data' => $exis_acomodacion,
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
            $acomodacionModel = new AcomodacionModel();
             //vedrifico si llega información obligatoria
             if (!empty($_POST['nombre']) ) {

                $data = [
                    "nombre" => $this->request->getVar("nombre"),
                ];
               //valido si ya esta registrado el correo y envio exeption
               $exis_d = $acomodacionModel->exist_a($data);

               if ($exis_d) {
                   $response = [
                       'status' => 401,
                       "error" => TRUE,
                       'messages' => 'El valor ya existe',
                   ];
               } else {
                   //Envio datos al modelo para insertar
                   $insert_t = $acomodacionModel->insert_a($data);

                   if ($insert_t) {
                       $response = [
                           'status' => 201,
                           "error" => FALSE,
                           'messages' => 'Acomodación creada',
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