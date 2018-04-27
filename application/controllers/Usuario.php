<?php
    // Este es el controlador de la aplicación
    
    class Usuario extends CI_Controller {
  /*************************************************************************
  *                                 USUARIO
  *                                               
  *************************************************************************/  

        public function __construct(){
            parent::__construct();
            $this->load->model("UsuarioModel");
        }

        public function index() {
            $this->showloginform();
        } 


        public function showloginForm($msj = ""){       
        //Muestra la ventana de login
            $data["vista"] ="usuario/formLogin";
            $data["mensaje"] = $msj; 
            $this->load->view('login_template', $data);
        }


        public function checklogin(){
            //Ejecuta el login
            $resultado = $this->UsuarioModel->login($_REQUEST["user"],$_REQUEST["pass"]);
        
            
             if($resultado ==1){
                    $this->load->model("EscenasModel");
                    $this->load->model("UsuarioModel");
                    $this->load->model("MapaModel","mapa");
                    $datos["tablaEscenas"] = $this->EscenasModel->getAll();
                    $datos["mapa"] = $this->mapa->cargar_mapa();
                    $datos["puntos"] = $this->mapa->cargar_puntos();
                    $datos["vista"]="escenas/Escenastable";
                    $datos["permiso"]=$this->UsuarioModel->comprueba_permisos($datos["vista"]);
                    $this->load->view('admin_template', $datos);
             }else if($resultado ==2){
                    $this->load->model("EscenasModel");
                    $this->load->model("UsuarioModel");
                    $this->load->model("MapaModel","mapa");
                    $datos["tablaEscenas"] = $this->EscenasModel->getAll();
                    $datos["mapa"] = $this->mapa->cargar_mapa();
                    $datos["puntos"] = $this->mapa->cargar_puntos();
                    $datos["vista"]="escenas/Escenastable";
                    $datos["permiso"]=$this->UsuarioModel->comprueba_permisos($datos["vista"]);
                    $this->load->view('admin_template', $datos);
            }else if($resultado ==3){
                $datos["tabla"] = $libro->get_info();
                $datos["vista"] = "libro/IntAdmin";
                $this->load->view('login_template',$datos);

            }else if($resultado ==0){
                $datos["error"] = "Usuario sin confirmar";
                $datos["vista"] = "usuario/formLogin";
                $this->load->view('login_template',$datos);

            }else{

                $datos["error"] = "Usuario no registrado";
                $datos["vista"] = "usuario/formLogin";
                $this->load->view('login_template',$datos);
            }
          }
        
        public function showregisterform(){
        //Mostrar el formulario de registro
            $data["vista"] = "usuario/registerForm";
            $this->load->view('login_template',$data);
        }
        

        public function processregisterform(){
        //Formulario de registro de usuarios
         
            $resultado = $this->UsuarioModel->inserusu();
            if ($resultado){
                // Usuario creado correctamente
                $datos["mensaje"] = "Usuario creado correctamente";
                if ($this->UsuarioModel->get_tipo_usuario() == -1) {
                    // El usuario aún no está logueado: volvemos a la pantalla de login
                    $datos["vista"] = "usuario/formLogin";
                    $this->load->view('login_template', $datos);
                }
                else {
                    // El usuario ya está logueado: volvemos al panel de administración
                    $datos["vista"] = "usuario/usuarios";       
                    $datos["permiso"]=$this->UsuarioModel->comprueba_permisos($datos["vista"]);
                    $datos["tablaUsuarios"] = $this->UsuarioModel->buscartodousu();
                    $this->load->view('admin_template',$datos);
                }
            }
            else {
                $datos["error"] = "Error al crear el usuario";
                if ($this->UsuarioModel->get_tipo_usuario() == -1) {
                    // No hay usuario logueado: volvemos a la pantalla de registro
                    $datos["vista"] = "usuario/registerForm";
                    $this->load->view("login_template", $datos);
                }
                else {
                    // El usuario ya está logueado: volvemos al panel de administración
                    $datos["vista"] = "usuario/usuarios";       
                    $datos["permiso"]=$this->UsuarioModel->comprueba_permisos($datos["vista"]);
                    $datos["tablaUsuarios"] = $this->UsuarioModel->buscartodousu();
                    $this->load->view('admin_template',$datos);
                }
                
            }
     
        }
        
        public function modificar($id){
    
        //Abrir la ventana para modificar el usuario

            $datos["DatosMod"]=$this->UsuarioModel->buscarusuid($id);
            $datos["vista"] = "usuario/modUsu";
            $datos["permiso"]=$this->UsuarioModel->comprueba_permisos($datos["vista"]);
            $this->load->view("admin_template",$datos);

        }
        
        /**
         * Modifica el tipo de un usuario. Petición por ajax.
         * 
         * Devuelve 1 si la modificación es un éxito, 0 en caso de fallo. Lo devuelve a Ajax.
         * 
         * @param integer $idusu El id del usuario a modificar
         * @param integer $nuevotipo El nuevo tipo que se le debe asignar
         * 
         */
        public function modtipo($idusu, $nuevotipo) {
            $resultado = $this->UsuarioModel->modtipo($idusu, $nuevotipo);
            echo $resultado;
        }
        
        public function modusuario(){
        
        //Modificar el usuario
        $id = $_REQUEST["id"];
        $this->UsuarioModel->alterarusu($id);
        $datos["tablaUsuarios"] = $this->UsuarioModel->buscartodousu();
        $datos["mensaje"] = "usuario modificado correctamente.";
            
        $datos["vista"] = "usuario/usuarios";       
        $datos["permiso"]=$this->UsuarioModel->comprueba_permisos($datos["vista"]);
        $this->load->view('admin_template',$datos);

        }

        public function borrarusuario($idusu){ 
        //Borrar usuario
            
            $resultado = $this->UsuarioModel->borrarusu($idusu);
            if ($resultado != 0) 
                echo $idusu;
            else
                echo $resultado;
            //$datos["tablaUsuarios"] = $this->UsuarioModel->buscartodousu();
            //$datos["nombreUsuario"] = "usuario borrado correctamente.";
            //$datos["vista"] = "usuario/usuarios";
            //$this->load->view("admin_template",$datos);

          
        }

        public function usuarios(){

            $datos["tablaUsuarios"]=$this->UsuarioModel->buscartodousu();
            $datos["vista"] = "usuario/usuarios";
            $datos["permiso"]=$this->UsuarioModel->comprueba_permisos($datos["vista"]);
            $this->load->view('admin_template',$datos);
        }

        public function mapero(){
            
            $data["vista"] = "usuario/mapero";
            $datos["permiso"]=$this->UsuarioModel->comprueba_permisos($datos["vista"]);
                $this->load->view('admin_template', $data);

        }

            

         public function cerrarSesion() {
            $this->session->sess_destroy();
            $this->showloginForm();
        }

    }
?>
