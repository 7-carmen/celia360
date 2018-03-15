<?php
class Conversorbd2json extends CI_Controller {
    
    public function __construct(){
        parent::__construct();
        $this->load->model("conversorjson");
        $this->load->model("UsuarioModel");
    } 

  public function index(){
    $this->load->model("Mapa","mapa");
    $this->load->model('BibliotecaModel', 'biblioteca');
    $this->load->model('PortadaModel');
    $datos["vista"] = "portada";
    $datos["portada"]=$this->PortadaModel->info_portada();
    $datos["libros"] = $this->biblioteca->get_info();
    $datos["mapa"] = $this->mapa->cargar_mapa();
    $datos["puntos"] = $this->mapa->cargar_puntos();
    $datos["config_mapa"] = $this->mapa->cargar_config();    
    $this->load->view("main_template", $datos);
  }

  public function get_json_libre() {
    $this->load->model("Mapa","mapa");
    $datos["inicio"] = $this->mapa->cargar_config();
    $json = $this->conversorjson->get_datos_libre($datos);
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
    
    public function get_json_plataforma($escenaInicial) {
        $json = $this->conversorjson->get_datos_plataforma($escenaInicial);
        echo $json;
    }

    // 
    // Modificar datos Portada
    // 
    
  public function formulario_portada(){ 
      $this->load->model("PortadaModel");
      $datos["tabla"]= $this->PortadaModel->info_portada();
      $datos["vista"]="portada/updatePortada";
      $datos["permiso"]=$this->UsuarioModel->comprueba_permisos($datos["vista"]);
      $this->load->view("template_admin", $datos);
  }
  
  public function modificar_titulo(){
    $this->load->model("PortadaModel");
    $resultado = $this->PortadaModel->editar_titulo();   
    $datos["tabla"]= $this->PortadaModel->info_portada();
    $datos["vista"]="portada/updatePortada";
    if ($resultado) $datos["mensaje"] = "Título modificado correctamente";
    else $datos["mensaje"] = "Error al modificar el título";
    $datos["permiso"]=$this->UsuarioModel->comprueba_permisos($datos["vista"]);

    $this->load->view("template_admin", $datos);

  }

  public function modificar_imagen(){
    $this->load->model("PortadaModel");
    $resultado = $this->PortadaModel->editar_imagen();   
    $datos["tabla"]= $this->PortadaModel->info_portada();      
    $datos["vista"]="portada/updatePortada";
    $datos["permiso"]=$this->UsuarioModel->comprueba_permisos($datos["vista"]);
    if ($resultado) $datos["mensaje"] = "Título modificado correctamente";
    else $datos["mensaje"] = "Error al modificar el título";

    $this->load->view("template_admin", $datos);

  }    
  
}