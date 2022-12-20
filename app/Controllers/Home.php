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
		echo view('hotele/index');
		echo view('template/footer');
    }

}
