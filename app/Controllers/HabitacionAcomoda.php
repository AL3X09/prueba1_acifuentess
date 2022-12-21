<?php 
namespace App\Controllers;

use App\Models\Article\TipohabitacionModel as ArticleTipohabitacionModel;
use Config\Services;
use CodeIgniter\API\ResponseTrait;
use CodeIgniter\RESTful\ResourceController;
use Exception;
use App\Models\HabitacionAcomodaModel;

// headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=utf8");
header("Access-Control-Allow-Headers: Content-Type, Access-Control");

//grupo de la unidad de servicios de salud
class HabitacionAcomoda extends ResourceController{
    
    use ResponseTrait;

    public function getallData(){
        
        try {
            
            $thabutaacomo = new HabitacionAcomodaModel();
            $exis_data = $thabutaacomo->get_all();
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
            $thabutaacomo = new HabitacionAcomodaModel();
             //vedrifico si llega información obligatoria
             //var_dump($_POST);

             if (!empty($_POST['fk_tipo_habitacion']) && !empty($_POST['fk_acomodacion'])) {

                $data = [
                    "FK_tipo_habitacion" => $this->request->getVar("fk_tipo_habitacion"),
                    "FK_acomodacion" => $this->request->getVar("fk_acomodacion"),
                ];
				//print_r($data);
               //valido si ya esta registrado el nombre
               $exis_d = $thabutaacomo->exist_hc($data);

               if ($exis_d) {
                   $response = [
                       'status' => 401,
                       "error" => TRUE,
                       'messages' => 'El valor ya existe',
                   ];
               } else {
                //Envio datos al modelo para insertar
                $insert_hc = $thabutaacomo->insert_hc($data);

                    if ($insert_hc) {
                        $response = [
							'status' => 201,
							"error" => FALSE,
							'messages' => 'Asociación creada',
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