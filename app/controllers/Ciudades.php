<?php
    // Aqui programamos la funcionalidad del controlador
    class Ciudades extends Controlador{
        //Propiedades
        public $ciudadModelo;
        public $table = 'Ciudades';
        public $action;
        public $title;
        
        //Definicion de constantes
        const LISTA = 'Lista de Ciudades';
        const NVO = 'Nuevo Registro';
        const UPD = 'Actualizar Registro';
        const DEL = 'Borrar Registro';
        
        //Metodos
        public function __construct(){
            //llamamos al modelo ciudad(clase) e instanciamos un objeto de esa clase...
            $this->ciudadModelo = $this->modelo('Ciudad');
        }
        
        public function index(){
            //$this->action = 'Listado de Ciudades';
            $this->title = self::LISTA;
            
            //list Ciudades
            $ciudades = $this->ciudadModelo->obtenerCiudades();
            
            // Se obtiene la ultima fecha de actualizacion o la fecha de insercion
            // en la tabla de Ciudades
            //$last_ciudad_updated_tmp = $this->ciudadModelo->get_last_updated_ciudad();
            //if(!empty($last_ciudad_updated_tmp[0]['UPDATED'])){
            //    $last_ciudad_updated = fechaCastellano($last_ciudad_updated_tmp[0]['UPDATED']);
            //}else{
            //    $last_ciudad_updated = fechaCastellano($last_ciudad_updated_tmp[0]['CREATED']);
            //}
            
            $last_ciudad_updated_tmp = $this->ciudadModelo->get_last_updated_ciudad();
            if(empty($last_ciudad_updated_tmp[0]['CREATED']) && empty($last_ciudad_updated_tmp[0]['UPDATED'])){
                $last_ciudad_updated = '';
            }elseif(!empty($last_ciudad_updated_tmp[0]['UPDATED'])){
                $last_ciudad_updated = fechaCastellano($last_ciudad_updated_tmp[0]['UPDATED']);
            }else{
                $last_ciudad_updated = fechaCastellano($last_ciudad_updated_tmp[0]['CREATED']);
            }
            
            
            //cargamos el array $datos
            $datos = ['table' => $this->table,
                        //'action' => $this->action,
                        'title' => $this->title,
                        'search' => false,
                        'ciudades' => $ciudades,
                        'last_ciudad_updated' => $last_ciudad_updated];
            
            //Cargamos la vista
            $this->vista('admin/ciudades/index', $datos);
        }
        
        public function search(){
            if($_SERVER['REQUEST_METHOD'] == 'POST'){
                //$this->action = 'Listado de Ciudades';
                $this->title = self::LISTA;
                
                //obtener la ciudad buscada por nombre
                $ciudad_search = $this->ciudadModelo->obtenerCiudadNombre($_POST['search_nombre_ciudad']);
                
                //list Ciudades
                $ciudades = $this->ciudadModelo->obtenerCiudades();
            
                // Se obtiene la ultima fecha de actualizacion o la fecha de insercion
                // en la tabla de Ciudades
                //$last_ciudad_updated_tmp = $this->ciudadModelo->get_last_updated_ciudad();
                //if(!empty($last_ciudad_updated_tmp[0]['UPDATED'])){
                //    $last_ciudad_updated = fechaCastellano($last_ciudad_updated_tmp[0]['UPDATED']);
                //}else{
                //    $last_ciudad_updated = fechaCastellano($last_ciudad_updated_tmp[0]['CREATED']);
                //}
                $last_ciudad_updated_tmp = $this->ciudadModelo->get_last_updated_ciudad();
                if(empty($last_ciudad_updated_tmp[0]['CREATED']) && empty($last_ciudad_updated_tmp[0]['UPDATED'])){
                    $last_ciudad_updated = '';
                }elseif(!empty($last_ciudad_updated_tmp[0]['UPDATED'])){
                    $last_ciudad_updated = fechaCastellano($last_ciudad_updated_tmp[0]['UPDATED']);
                }else{
                    $last_ciudad_updated = fechaCastellano($last_ciudad_updated_tmp[0]['CREATED']);
                }
            
                //cargamos el array $datos
                $datos = ['table' => $this->table,
                            //'action' => $this->action,
                            'title' => $this->title,
                            'search' => true,
                            'ciudad_search' => $ciudad_search, 
                            'ciudades' => $ciudades,
                            'last_ciudad_updated' => $last_ciudad_updated];
            
                //Cargamos la vista
                $this->vista('admin/ciudades/index', $datos);
            }
        }
        
        
        
        
        
        
        
        
        
        
        
        
        public function create(){
            //$this->action = 'Nuevo Registro';
            $this->title = self::NVO;
            
            //obtener los paises para usar en el list del form de ciudades
            $paises = $this->ciudadModelo->obtenerPaises();
    
            $datos = ['table' => $this->table,
                        //'action' => $this->action,
                        'title' => $this->title,
                        'message' => '',
                        'paises' => $paises
                    ];
            
            $this->vista('admin/ciudades/create', $datos);
        }
        
        
        public function store(){
            //$this->action = 'Nuevo Registro';
            $this->title = self::NVO;
            
            if($_SERVER['REQUEST_METHOD'] == 'POST'){
                $datos = ['crt_nombre_ciudad' => $_POST['crt_nombre_ciudad'],
                            'crt_abreviatura_ciudad' => $_POST['crt_abreviatura_ciudad'],
                            'crt_pais_ciudad' => $_POST['crt_pais_ciudad']
                        ];
                
                $message = $this->ciudadModelo->agregarCiudad($datos);
                
                //vaciar el array $datos para volver a usarlo...
                foreach ($datos as $key => $value) {
                    unset($datos[$key]);
                }
                
                $datos = ['table' => $this->table,
                            //'action' => $this->action,
                            'title' => $this->title,
                            'message' => $message];
                
                $this->vista('admin/paises/create', $datos);
            }
        }
        
        
        
        
        
        
        
        public function edit($id){
            //$this->action = 'Actualizar Registro';
            $this->title = self::UPD;
            
            //cuando se hace clic en el "enlace" editar/parametro... de la lista
            //obtener informacion de la ciudad desde el modelo
            $ciudad = $this->ciudadModelo->obtenerCiudadId($id);
            
            //obtener los paises para usar en el list del form de ciudades
            $paises = $this->ciudadModelo->obtenerPaises();
            
            foreach($ciudad as $k => $v){
                $datos = ['table' => $this->table,
                            //'action' => $this->action,
                            'title' => $this->title,
                            'message' => '',
                            'ciudad' => $v['CIUDAD'],
                            'updt_nombre_ciudad' => $v['NOMBRE'],
                            'updt_abreviatura_ciudad' => $v['ABREVIATURA'],
                            'updt_pais_ciudad' => $v['PAIS'],
                            'paises' => $paises];
            }
            
            //Cargamos la vista ciudades/update
            $this->vista('admin/ciudades/update', $datos);
        }
        
        
        public function update($id){
            //$this->action = 'Actualizar Registro';
            $this->title = self::UPD;
            
            if($_SERVER['REQUEST_METHOD'] == 'POST'){
                //si se ha recibido por post los sgtes datos...
                //cuando se hace clic en el boton enviar del form...
                $datos = ['ciudad' => $id,
                            'updt_nombre_ciudad' => $_POST['updt_nombre_ciudad'],
                            'updt_abreviatura_ciudad' => $_POST['updt_abreviatura_ciudad'],
                            'updt_pais_ciudad' => $_POST['updt_pais_ciudad']
                        ];
                
                $message = $this->ciudadModelo->actualizarCiudad($datos);
                
                //vaciar el array $datos para volver a usarlo...
                //foreach ($datos as $key => $value) {
                //    unset($datos[$key]);
                //}
                
                //obtener informacion de la ciudad desde el modelo
                $ciudad = $this->ciudadModelo->obtenerCiudadId($id);
            
                //obtener los paises para usar en el list del form de ciudades
                $paises = $this->ciudadModelo->obtenerPaises();
            
                foreach($ciudad as $k => $v){
                    $datos = ['table' => $this->table,
                                //'action' => $this->action,
                                'title' => $this->title,
                                'message' => $message,
                                'ciudad' => $v['CIUDAD'],
                                'updt_nombre_ciudad' => $v['NOMBRE'],
                                'updt_abreviatura_ciudad' => $v['ABREVIATURA'],
                                'updt_pais_ciudad' => $v['PAIS'],
                                'paises' => $paises
                            ];
                }
                $this->vista('admin/ciudades/update', $datos);
            }
        }
        
        
        public function borrar($id){
            //$this->action = 'Borrar Registro';
            $this->title = self::DEL;
            
            //obtener los paises para usar en el list del form de ciudades
            $paises = $this->ciudadModelo->obtenerPaises();
            
            //cuando se hace clic en el "enlace" borrar/parametro... de la lista
            //obtener informacion de la ciudad desde el modelo
            $ciudad = $this->ciudadModelo->obtenerCiudadId($id);
            foreach($ciudad as $k => $v){
                $datos = ['table' => $this->table,
                            //'action' => $this->action,
                            'title' => $this->title,
                            'message' => '',
                            'ciudad' => $v['CIUDAD'],
                            'del_nombre_ciudad' => $v['NOMBRE'],
                            'del_abreviatura_ciudad' => $v['ABREVIATURA'],
                            'del_pais_ciudad' => $v['PAIS'],
                            'paises' => $paises];
            }
            
            //invoca a la vista borrar
            $this->vista('admin/ciudades/delete', $datos);
        }
        
        public function delete($id){
            //$this->action = 'Borrar Registro';
            $this->title = self::DEL;
            
            if($_SERVER['REQUEST_METHOD'] == 'POST'){
                $datos = ['ciudad' => $id];
                
                $message = $this->ciudadModelo->borrarCiudad($datos);

                //vaciar el array $datos para volver a usarlo...
                foreach ($datos as $key => $value) {
                    unset($datos[$key]);
                }
                
                $datos = ['table' => $this->table,
                            //'action' => $this->action,
                            'title' => $this->title,
                            'message' => $message
                    ];
               
                //invoca a la vista borrar
                $this->vista('admin/paises/delete', $datos);
            }
        }
        
    }
    
    /*
    * Obs.: Todo Controlador debe tener un metodo index().
        - Esta clase(class) Paginas(), es el controlador por default
        que definimos sino cargamos ningun controlador en la url
        desde el archivo: librerias/Core.php
    */