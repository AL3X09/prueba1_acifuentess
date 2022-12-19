<?php

namespace App\Controllers;

class Ejercicio extends BaseController{
    
	
	public function __construct()
    {
    }

    public function ejercicio1(){
        echo view('template/header');
		echo view('ejer1');
		echo view('template/footer');
    }

    public function ejercicio2(){
        echo view('template/header');
		echo view('ejer2');
		echo view('template/footer');
    }
    
    public function ejercicio3(){
        echo view('template/header');
		echo view('ejer3');
		echo view('template/footer');
    }

    public function ejercicio4(){
        echo view('template/header');
		echo view('ejer4');
		echo view('template/footer');
    }
    public function ejercicio5(){
        echo view('template/header');
		echo view('ejer5');
		echo view('template/footer');
    }
    
}
