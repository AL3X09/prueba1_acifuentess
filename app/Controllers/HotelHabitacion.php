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
            //if (!empty($_POST['fk_hotel']) && !empty($_POST['fk_tipohabitacion']) && !empty($_POST['cantidad']) ) {
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
            $thotelhabitacion = new HotelHabitacionModel();
             //vedrifico si llega información obligatoria
             if (!empty($_POST['fk_hotel']) && !empty($_POST['fk_habitacion_acomo']) && !empty($_POST['cantidad']) ) {
                $data = [
                    "FK_hotel" => $this->request->getVar("fk_hotel"),
                    "FK_habitacion_acomo" => $this->request->getVar("fk_habitacion_acomo"),
                    "cantidad" => $this->request->getVar("cantidad"),
                ];
                
                //consulto la cantidad total de habitaciones que tiene el hotel
                $thotelModel = new HotelModel();
                $total_h = $thotelModel->get_thabitacion($data['FK_hotel']);
                //consulto la cantidad de habitaciones por acomodación
                $cantidad_h = $thotelhabitacion->get_t_habitaciones($data['FK_hotel']);
                //print_r($total_h[0]['t_habitaciones']);
                //echo "entra aca";
                //print_r($cantidad_h[0]['cantidad']);
                if (!empty($total_h[0]['t_habitaciones']) ) {
                    if (!empty($cantidad_h[0]['cantidad']) ) {
                        $t_habitaciones = intval($cantidad_h[0]['cantidad']) + intval($_POST['cantidad']);
                    }else{
                        $t_habitaciones = intval($_POST['cantidad']);
                    }
                    
                    if($t_habitaciones > $total_h[0]['t_habitaciones']){
                        $response = [
                            'status' => 401,
                            "error" => TRUE,
                            'messages' => 'Excede el valor de las habitaciones para el hotel',
                        ];
                    }else if($t_habitaciones <= $total_h[0]['t_habitaciones']){
                        //inserto datos
                        //valido si ya esta registrado el correo y envio exeption
                        $exis_d = $thotelhabitacion->exist_hh($data);

                        if ($exis_d) {
                            $response = [
                                'status' => 401,
                                "error" => TRUE,
                                'messages' => 'El valor ya existe',
                            ];
                        } else {
                            //Envio datos al modelo para insertar
                            $insert_t = $thotelhabitacion->insert_hh($data);

                            if ($insert_t) {
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
           
       }
       return $this->respond($response);

    }

}