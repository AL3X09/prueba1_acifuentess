<?php

namespace App\Controllers;

class Home extends BaseController{
    
	
	public function __construct()
    {
    }

    public function index(){
        echo view('template/header');
		echo view('home');
		echo view('template/footer');
    }

    public function hoteles_view(){
        echo view('template/header');
		echo view('hotel/index');
		echo view('template/footer');
    }

    public function tipohabitacion_view(){
        echo view('template/header');
		echo view('tipohabitacion/index');
		echo view('template/footer');
    }

    public function acomodacion_view(){
        echo view('template/header');
		echo view('acomodacion/index');
		echo view('template/footer');
    }

    public function habitaacomoda_view(){
        echo view('template/header');
		echo view('habitacionacomodacion/index');
		echo view('template/footer');
    }
    public function hotelhabita_view(){
        echo view('template/header');
		echo view('hotelhabitacion/index');
		echo view('template/footer');
    }
    
}
