<?php
    // Aqui programamos la funcionalidad del controlador
    class Ciudades extends Controlador{
        //Propiedades
        //public $ciudadModelo;
        
        //Metodos
        public function __construct(){
            //llamamos al modelo ciudad(clase) e instanciamos un objeto de esa clase...
            $this->ciudadModelo = $this->modelo('Ciudad');
        }
        
        public function index(){
            //obtener todos los registros de ciudades para mostrar en el listado inicial de la pagina...
            $ciudades = $this->ciudadModelo->obtenerCiudades();
            
            //cargamos el array $datos
            $datos = ['ciudades' => $ciudades];
            
            //Cargamos la vista
            $this->vista('admin/ciudades/inicio', $datos);
        }
        
        public function agregar(){
            //
            if($_SERVER['REQUEST_METHOD'] == 'POST'){
               $datos = ['nombre' => trim($_POST['nombre']),
                            'pais' => trim($_POST['pais']),
                            'abreviatura' => trim($_POST['abreviatura'])
                        ];
                
                if($this->ciudadModelo->agregarCiudad($datos)){
                    redireccionar('/admin/ciudades');  //esta funcion esta en el archivo url_helper
                }else{
                    //die('Algo salió mal');
                    echo "<br>".$this->ciudadModelo->ciudad_err_msg;
                    die("");
                }
            }else{
                //obtener los paises para usar en el list del form de ciudades
                $paises = $this->ciudadModelo->obtenerPaises();
                
                $datos = ['nombre' => '', 'pais' => '', 'abreviatura' => '', 'paises' => $paises];
                $this->vista('admin/ciudades/agregar', $datos);
            }
        }
        
        
        public function editar($id){
            if($_SERVER['REQUEST_METHOD'] == 'POST'){
                //si se ha recibido por post los sgtes datos...
                //cuando se hace clic en el boton enviar del form...
                $datos = ['ciudad' => $id,
                            'pais' => trim($_POST['pais']),
                            'nombre' => trim($_POST['nombre']),
                            'abreviatura' => trim($_POST['abreviatura'])
                        ];
                
                if($this->ciudadModelo->actualizarCiudad($datos)){
                    redireccionar('/admin/ciudades');
                }else {
                    die('Algo salió mal');
                }
            }else{
                //cuando se hace clic en el "enlace" editar/parametro... de la lista
                //obtener informacion de la ciudad desde el modelo
                
                //obtener los paises para usar en el list del form de ciudades
                $paises = $this->ciudadModelo->obtenerPaises();
                
                $ciudad = $this->ciudadModelo->obtenerCiudadId($id);
                
                //echo "id_ciudad: ".$id;
                //echo "<br>paises<br>";
                //print_r($paises);
                //echo "<br>ciudad<br>";
                //print_r($ciudad);
                //echo "<br>id: ".$ciudad[0]['CIUDAD'];
                //die("");
                
                foreach($ciudad as $k => $v){
                    $datos = ['paises' => $paises,
                                'ciudad' => $v['CIUDAD'],
                                'nombre' => $v['NOMBRE'],
                                'abreviatura' => $v['ABREVIATURA'],
                                'pais' => $v['PAIS']
                            ];
                }
                //print_r($datos);
                
                //Cargamos la vista ciudades/editar
                $this->vista('admin/ciudades/editar', $datos);                
            }
        }
        
        public function borrar($id){
            //obtener informacion de la ciudad desde el modelo
            //$usuario = $this->usuarioModelo->obtenerUsuarioId($id);
            //$datos = ['id_usuario' => $usuario->id_usuario, 'nombre' => $usuario->nombre, 'email' => $usuario->email, 'telefono' => $usuario->telefono];
            
            //cuando se hace clic en el "enlace" borrar/parametro... de la lista
            //obtener informacion de pais desde el modelo
            $ciudad = $this->ciudadModelo->obtenerCiudadId($id);
            
            foreach($ciudad as $k => $v){
                $datos = ['ciudad' => $v['CIUDAD'],
                            'nombre' => $v['NOMBRE'],
                            'abreviatura' => $v['ABREVIATURA'],
                            'pais' => $v['PAIS']
                        ];
            }
            
               
            if($_SERVER['REQUEST_METHOD'] == 'POST'){
                $datos = ['ciudad' => $id];
                
                if($this->ciudadModelo->borrarCiudad($datos)){
                    redireccionar('/admin/ciudades');
                }else {
                    //die('Algo salió mal');
                    echo "<br>".$this->ciudadModelo->ciudad_err_msg;
                    die("");
                }
            }
            
            //invoca a la vista borrar
            $this->vista('admin/ciudades/borrar', $datos);
            
        }
        
        
        
        
    }
    
    /*
    * Obs.: Todo Controlador debe tener un metodo index().
        - Esta clase(class) Paginas(), es el controlador por default
        que definimos sino cargamos ningun controlador en la url
        desde el archivo: librerias/Core.php
    */