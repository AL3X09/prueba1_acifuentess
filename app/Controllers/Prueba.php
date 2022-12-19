<?php

namespace App\Controllers;

use Config\Services;
use CodeIgniter\API\ResponseTrait;
use CodeIgniter\RESTful\ResourceController;
use Exception;

// headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=utf8");
header("Access-Control-Allow-Headers: Content-Type, Access-Control");

//grupo de la unidad de servicios de salud
class Prueba extends ResourceController
{

    use ResponseTrait;

    public function index()
    {
    }

    public function E1()
    {
        try {
            if (!empty($_POST['anio'])) {
                $anio = $_POST['anio'];
                //print_r(strlen($anio));
                if (strlen($anio) < 4) {
                    $response = [
                        'status' => 404,
                        "error" => FALSE,
                        "messages" => "Debe ingresar un año valido",
                    ];
                } else {

                    if (($anio % 4 == 0 && $anio % 100 != 0) || $anio % 400 == 0) {
                        $response = [
                            'status' => 201,
                            "error" => FALSE,
                            "messages" => "Es Bisiesto",
                        ];
                    } else {
                        $response = [
                            'status' => 201,
                            "error" => FALSE,
                            "messages" => "No es Bisiesto",
                        ];
                    }
                }
            } else {
                $response = [
                    'status' => 400,
                    "error" => TRUE,
                    'messages' => 'Error, Debe ingresar datos a consultar',
                ];
            }

            return $this->respond($response);
        } catch (\Exception $e) {
            return $this->failServerError('se ha presntado una exepción ' . $e->getMessage());
        }
    }

    public function E3()
    {
        try {
            //$arreglo = array();
            //$newpila = [];
            if (!empty($_POST['numeros'])) {
                //array_push($arreglo,$_POST['numeros']);
                $arreglo=$_POST['numeros'];
                //print_r($arreglo);
                $newdata = explode(",", $arreglo[0]);
                //print_r($newdata);
                //var_dump(count($arreglo));
                
                for($j = 0; $j < 20; $j ++) {
                    for($i = 0; $i < (20-1); $i ++){
                
                        if($newdata[$i] > $newdata[$i+1]) {
                            $temp = $newdata[$i+1];
                            $newdata[$i+1]=$newdata[$i];
                            $newdata[$i]=$temp;
                        }       
                    }
                }

                        $response = [
                            'status' => 201,
                            "error" => FALSE,
                            "messages" => "Los datos ordenados son: ",
                            "data" => $newdata,
                        ];

            } else {
                $response = [
                    'status' => 400,
                    "error" => TRUE,
                    'messages' => 'Error, Debe ingresar datos a consultar',
                ];
            }
            return $this->respond($response);
        } catch (\Exception $e) {
            return $this->failServerError('se ha presntado una exepción ' . $e->getMessage());
        }
    }

    public function E4()
    {
        try {
            
            $i = 0;
            if (!empty($_POST['g1']) && !empty($_POST['g2']) ) {
                $d1 = $_POST['g1'];
                $d2 = $_POST['g2'];

                $A = explode(",", $d1[0]);
                $B = explode(",", $d2[0]);
                array_pop($A);
                array_pop($B);
                //print_r($A);
                $AUB = array();
                //$AnB = array();
                $AVB = array();
                $A_B = array();

                //union
                $AUB = array_merge($A, $B);

                //intersección
                $AnB = array_intersect($A, $B);
                $AnB = array_values($AnB);

                //diferencia
                $AVB = array_diff($A, $B);
                $AVB = array_values($AVB);
                                   
                $response = [
                    'status' => 201,
                    "error" => FALSE,
                    "data" =>[
                        "message1" => "Union: ",
                        "union" => $AUB,
                        "message2" => "Intersección: ",
                        "interseccion" => $AnB,
                        "message3" => "Diferencia: ",
                        "diferen" => $AVB,
                    ]
                ];

            } else {
                $response = [
                    'status' => 400,
                    "error" => TRUE,
                    'messages' => 'Error, Debe ingresar todos los conjuntos de datos a comparar',
                ];
            }

            return $this->respond($response);
        } catch (\Exception $e) {
            return $this->failServerError('se ha presntado una exepción ' . $e->getMessage());
        }
    }
    
}