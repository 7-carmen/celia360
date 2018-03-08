<?php
class Conversorbd2json extends CI_Controller {
    
    public function __construct(){
        parent::__construct();
        $this->load->model("conversorjson");
    } 

  public function index(){
    $this->load->model("Mapa","mapa");
    $this->load->model('BibliotecaModel', 'biblioteca');
    $datos["vista"] = "portada";
    $datos["libros"] = $this->biblioteca->get_info();
    $datos["mapa"] = $this->mapa->cargar_mapa();
    $datos["puntos"] = $this->mapa->cargar_puntos();
    $datos["config_mapa"] = $this->mapa->cargar_config();    
    $this->load->view("main_template", $datos);
  }

  public function get_json_libre() {
    $json = $this->conversorjson->get_datos_libre();
    echo $json;
  }
  
   public function get_json_guiada() {
    $json = $this->conversorjson->get_datos_guiada();
    echo $json;
  }
  
    public function get_json_destacados() {
    $json = $this->conversorjson->get_datos_destacado();
    echo $json;
  }
  
    public function get_json_evacuacion() {
    
  }
  
  public function get_json_plataforma($escenaInicial) {
      $json = $this->conversorjson->get_datos_plataforma($escenaInicial);
      echo $json;
  }
  
  
}