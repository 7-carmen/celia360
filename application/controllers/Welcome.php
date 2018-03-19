<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

  
    
	public function cargar_escena($escenaInicial, $redireccion, $piso = null){
        $this->load->library('session');
        if(isset($piso) && is_numeric($piso)){
            $this->session->piso=$piso; 
        }
        
        $redireccion = site_url("/hotspots/".$redireccion."/");
        $datos["redireccion_jotpoch"]= $redireccion;
		$datos["escenaInicial"] = $escenaInicial;
        $datos["idhotspot"]= "vacio";
		$this->load->view("jotpoch", $datos);	
	}
    
    // sobrecargando la funcion cargar_escena para añadirle funcionalidad para modificar hotspots
    public function cargar_escena_modificar($escenaInicial, $redireccion, $idhotspot){
        $redireccion = site_url("/hotspots/".$redireccion."/");
        echo $redireccion;
        $datos["redireccion_jotpoch"]= $redireccion;
		$datos["escenaInicial"] = $escenaInicial;
        $datos["idhotspot"]= $idhotspot;
		$this->load->view("jotpoch", $datos);	
    }

    public function index(){
		$this->load->view("creditos");	
    }
    
}
