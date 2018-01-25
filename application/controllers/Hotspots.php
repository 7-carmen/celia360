<?php
      
class Hotspots extends CI_Controller {
    
    public function __construct() {
        parent::__construct();
        $this->load->model("hotspotsModel");
    }
    
    public function index(){
        $this->show_hotspots_table();
    }
    
    public function show_hotspots_table() {
        $datos["tablaHotspots"] = $this->hotspotsModel->buscarHotspots();
        $this->load->view("hotspots/hotspotsTable", $datos);
    }
    
    public function show_insert_hotspot() {
        $this->load->view("hotspots/InsertHotspot");
    }
    
    public function process_insert_hotspot(){
        $resultado = $this->hotspotsModel->insertarHotspot();
        if ($resultado == true) {
            $datos["mensaje"] = "La inserci&oacute;n ha sido un &eacute;xito";
            $datos["tablaHotspots"] = $this->hotspotsModel->buscarHotspots();
            $this->load->view("hotspots/hotspotsTable", $datos);
        }
        else {
            $datos["error"] = "La inserci&oacute;n ha fallado";
            $datos["tablaHotspots"] = $this->hotspotsModel->buscarHotspots();
            $this->load->view("hotspots/hotspotsTable", $datos);
        }
    }
    
    public function delete_hotspot($id){

        $resultado = $this->hotspotsModel->borrarHotspot($id);
        
        if ($resultado == 1) {
            $datos["mensaje"] = "Hotspot borrado correctamente";
            $datos["tablaHotspots"] = $this->hotspotsModel->buscarHotspots();
            $this->load->view("hotspots/hotspotsTable", $datos);
            }
        else {
            $datos["error"] = "Error al borrar el hotspot";
            $datos["tablaHotspots"] = $this->hotspotsModel->buscarHotspots();
            $this->load->view("hotspots/hotspotsTable",$datos);
        }
        
    }
    
    public function show_update_hotspot($id){

        $datos["tabla"]= $this->hotspotsModel->buscarUnHotspot($id);
        print_r($datos);
    
        $this->load->view("hotspots/UpdateHotspot", $datos);
    }
    
    public function process_update_hotspot(){
    
            
            $id = $_REQUEST["id_hotspot"];
            /**echo "id = $id";**/
            
            $resultado = $this->hotspotsModel->modificarHotspot($id);
            
            if ($resultado == true) {
                $datos["mensaje"] = "La modificaci&oacute;n ha sido un &eacute;xito";
                $datos["tablaHotspots"] = $this->hotspotsModel->buscarHotspots();
                $this->load->view("hotspots/hotspotsTable", $datos);
            }
            else {
                $datos["error"] = "La modificaci&oacute;n ha fallado";
                $datos["tablaHotspots"] = $this->hotspotsModel->buscarHotspots();
                $this->load->view("hotspots/hotspotsTable", $datos);
            }
        
    }


}