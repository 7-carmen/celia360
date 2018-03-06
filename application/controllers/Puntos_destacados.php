<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Puntos_destacados extends CI_Controller {
    
    public function __construct(){
        parent::__construct();
        $this->load->model("PuntosDestacadosModel");
    }
    
    public function quitar_fila($id_fila) {
        $resultado = $this->PuntosDestacadosModel->ocultar_fila($id_fila);
        if ($resultado) {
            $datos["puntos_d"] = $this->PuntosDestacadosModel->getAll();
            $this->load->view("puntosdestacados/adminDestacados", $datos);	
        }
        else {
            echo "Aquí generariamos la vista pero con un mensaje de error";
        }
    }
    
	public function cargar_puntosdestacados(){
        $datos["puntos_d"] = $this->PuntosDestacadosModel->getAll();
		$this->load->view("puntosdestacados/puntosDestacados", $datos);	
	}
    
    public function cargar_edicion_puntosdestacados(){
        $datos["puntos_d"] = $this->PuntosDestacadosModel->getAll();
		$this->load->view("puntosdestacados/puntosDestacados", $datos);	
	}
    
    public function processinsertdestacado(){
        
    }
    
   
    
}
