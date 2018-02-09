<?php

// Este es el controlador de la aplicación
defined('BASEPATH') OR exit('No se permite el acceso directo al script');

class Audio extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model("Audm");
        $this->load->model("UsuarioModel");
    }

    public function index() {
        $this->mostraraudios();
    }

    public function forminsertaraudio() {
        $datos["vista"] = "audio/Insertaraudios";
        $datos["permiso"] = $this->UsuarioModel->comprueba_permisos($datos["vista"]);
        $this->load->view("template_admin", $datos);
    }

    public function insertaraud() {
        $f_def = "audios/" . $_FILES["audio"]["name"];
        $r = $this->Audm->existeaud($f_def);

        if ($r == true) {
            echo"el archivo ya existe en el servidor, intenta cambiarle el nombre antes de subirlo si no quieres qe se sobreescriba";
            echo"</br><a href='" . site_url("audio/forminsertaraudio") . "'>insertar</a></br>";
            echo"</br><a href='" . site_url("audio/mostraraudios") . "'>mostrar</a></br>";
            echo"</br><a href='" . site_url("audio/mostraraudios") . "'>renombrar archivo en el servidor</a></br>";
        } else {
            $tipo = $this->input->post_get("tipo_aud");
            $desc = $this->input->post_get("desc");
            $res = $this->Audm->insertaraud($desc, $tipo);
            $datos["tabla"] = $this->Audm->buscaraud();
            $datos["vista"] = "audio/Vaudios";
            $datos["permiso"] = $this->UsuarioModel->comprueba_permisos($datos["vista"]);
            $this->load->view("template_admin", $datos);
        }
    }

    public function mostraraudios() {
        $datos["tabla"] = $this->Audm->buscaraud();
        $datos["vista"] = "audio/Vaudios";
        $datos["permiso"] = $this->UsuarioModel->comprueba_permisos($datos["vista"]);
        $this->load->view("template_admin", $datos);
    }

    public function borraraud($id) {
        $this->Audm->borraraud($id);
        $datos["tabla"] = $this->Audm->buscaraud();
        $datos["vista"] = "audio/Vaudios";
        $datos["permiso"] = $this->UsuarioModel->comprueba_permisos($datos["vista"]);
        $this->load->view("template_admin", $datos);
    }

    public function formmodificarAud($id_aud) {
        $datos["aud"] = $this->Audm->buscaridaud($id_aud);
        $datos["vista"] = "audio/Modificaraudios";
        $datos["permiso"] = $this->UsuarioModel->comprueba_permisos($datos["vista"]);
        $this->load->view("template_admin", $datos);
    }

    public function modificaraud() {
        $id = $this->input->post_get("id");
        $this->Audm->modificaraud($id);
        $datos["tabla"] = $this->Audm->buscaraud();
        $datos["vista"] = "audio/Vaudios";
        $datos["permiso"] = $this->UsuarioModel->comprueba_permisos($datos["vista"]);
        $this->load->view("template_admin", $datos);
    }

}

?>