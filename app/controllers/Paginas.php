<?php
    // Aqui programamos la funcionalidad del controlador
    class Paginas extends Controlador{
        //propiedades
        //public $usuarioModelo;
        
        //metodos
        public function __construct() {
            //llamamos al modelo usuario(clase) e instanciamos un objeto de esa clase
            //$this->usuarioModelo = $this->modelo('Usuario');
            
            
        }
        
        public function index(){  
            //obtener los usuarios
            //$usuarios = $this->usuarioModelo->obtenerUsuarios();
            
            // cargamos el array $datos
            //$datos = ['titulo' => 'Bienvenidos a MVC render2web'];
            //$datos = ['usuarios' => $usuarios];

            ////Cargamos la vista
            //$this->vista('paginas/index', $datos);
            
            //Cargamos la vista
            $this->vista('paginas/index');
            
        }
        
        //        public function agregar(){
        //            if($_SERVER['REQUEST_METHOD'] == 'POST'){
        //                $datos = [
        //                    'nombre' => trim($_POST['nombre']),
        //                    'email' => trim($_POST['email']),
        //                    'telefono' => trim($_POST['telefono']),
        //                ];
        //                if($this->usuarioModelo->agregarUsuario($datos)){
        //                    redireccionar('/paginas');  //esta funcion esta en el archivo url_helper
        //                }else {
        //                    die('Algo salió mal');
        //                }
        //            }else{
        //                $datos = ['nombre' => '', 'email' => '', 'telefono' => ''];
        //                $this->vista('paginas/agregar', $datos);
        //            }
        //        }
        
        //        public function editar($id){
        //            if($_SERVER['REQUEST_METHOD'] == 'POST'){
        //                //si se ha recibido por post los sgtes datos...
        //                //cuando se hace clic en el boton enviar del form...
        //                $datos = [
        //                    'id_usuario' => $id,
        //                    'nombre' => trim($_POST['nombre']),
        //                    'email' => trim($_POST['email']),
        //                    'telefono' => trim($_POST['telefono']),
        //                ];
        //                if($this->usuarioModelo->actualizarUsuario($datos)){
        //                    redireccionar('/paginas');
        //                }else {
        //                    die('Algo salió mal');
        //                }
        //            }else{
        //                //cuando se hace clic en el "enlace" editar/parametro... de la lista
        //                //obtener informacion de usuario desde el modelo
        //                $usuario = $this->usuarioModelo->obtenerUsuarioId($id);
        //                $datos = ['id_usuario' => $usuario->id_usuario,
        //                            'nombre' => $usuario->nombre,
        //                            'email' => $usuario->email,
        //                            'telefono' => $usuario->telefono
        //                        ];
        //                //Cargamos la vista paginas/editar
        //                $this->vista('paginas/editar', $datos);
        //            }
        //        }
        
        //        public function borrar($id){
        //            //obtener informacion de usuario desde el modelo
        //            $usuario = $this->usuarioModelo->obtenerUsuarioId($id);
        //            $datos = ['id_usuario' => $usuario->id_usuario,
        //                        'nombre' => $usuario->nombre,
        //                        'email' => $usuario->email,
        //                        'telefono' => $usuario->telefono
        //                    ];
        //            if($_SERVER['REQUEST_METHOD'] == 'POST'){
        //                $datos = ['id_usuario' => $id];
        //                if($this->usuarioModelo->borrarUsuario($datos)){
        //                    redireccionar('/paginas');
        //                }else {
        //                    die('Algo salió mal');
        //                }
        //            }
        //            //invoca a la vista borrar
        //            $this->vista('paginas/borrar', $datos);
        //        }
    }
    /*
    * Obs.: Todo Controlador debe tener un metodo index().
        - Esta clase(class) Paginas(), es el controlador por default
        que definimos sino cargamos ningun controlador en la url
        desde el archivo: librerias/Core.php
    */