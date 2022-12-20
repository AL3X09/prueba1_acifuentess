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

}