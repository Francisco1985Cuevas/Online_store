<?php
    // Aqui programamos la funcionalidad del controlador
    class Paises extends Controlador{
        //Propiedades
        public $paisModelo;
        public $table = 'Paises';
        public $action;
        public $title;
        
        //Definicion de constantes
        const LISTA = 'Lista de Paises';
        const NVO = 'Nuevo Registro';
        const UPD = 'Actualizar Registro';
        const DEL = 'Borrar Registro';
        
        //Metodos
        
        //metodo __construct()
        public function __construct(){
            //llamamos al modelo pais(clase) e instanciamos un objeto de esa clase
            $this->paisModelo = $this->modelo('Pais');
        }
        
        //metodo index()
        public function index(){
            //cargamos el array $datos
            //$datos = ['titulo' => 'Bienvenidos a MVC render2web'];
            //$datos = ['usuarios' => $usuarios];
            //print_r($paises);
            
            $this->title = self::LISTA;
            
            //list Paises
            $paises = $this->paisModelo->obtenerPaises();
            
            // Se obtiene la ultima fecha de actualizacion o la fecha de insercion
            // en la tabla de Paises
            $last_pais_updated_tmp = $this->paisModelo->get_last_updated_pais();
            if(empty($last_pais_updated_tmp[0]['CREATED']) && empty($last_pais_updated_tmp[0]['UPDATED'])){
                $last_pais_updated = '';
            }elseif(!empty($last_pais_updated_tmp[0]['UPDATED'])){
                $last_pais_updated = fechaCastellano($last_pais_updated_tmp[0]['UPDATED']);
            }else{
                $last_pais_updated = fechaCastellano($last_pais_updated_tmp[0]['CREATED']);
            }
            
            $datos = ['table' => $this->table,
                        //'action' => $this->action,
                        'title' => $this->title,
                        'search' => false,
                        'paises' => $paises,
                        'last_pais_updated' => $last_pais_updated];
            
            //Cargamos la vista
            $this->vista('admin/paises/index', $datos);
        }
        
        //metodo search()
        public function search(){
            //
            if($_SERVER['REQUEST_METHOD'] == 'POST'){
                $this->title = self::LISTA;
                
                //obtener el pais buscado por nombre
                $pais_search = $this->paisModelo->obtenerPaisNombre($_POST['search_nombre_pais']);
                
                //obtener los paises para seguir mostrando en el listado
                $paises = $this->paisModelo->obtenerPaises();
                
                // Se obtiene la ultima fecha de actualizacion o la fecha de insercion
                // en la tabla de Paises
                $last_pais_updated_tmp = $this->paisModelo->get_last_updated_pais();
                if(empty($last_pais_updated_tmp[0]['CREATED']) && empty($last_pais_updated_tmp[0]['UPDATED'])){
                    $last_pais_updated = '';
                }elseif(!empty($last_pais_updated_tmp[0]['UPDATED'])){
                    $last_pais_updated = fechaCastellano($last_pais_updated_tmp[0]['UPDATED']);
                }else{
                    $last_pais_updated = fechaCastellano($last_pais_updated_tmp[0]['CREATED']);
                }
                
                $datos = ['table' => $this->table,
                            //'action' => $this->action,
                            'title' => $this->title,
                            'search' => true,
                            'pais_search' => $pais_search, 
                            'paises' => $paises, 
                            'last_pais_updated' => $last_pais_updated];
                
                //Cargamos la vista
                $this->vista('admin/paises/index', $datos);
            }
        }
        
        //metodo create()
        public function create(){
            $this->title = self::NVO;
            
            $datos = ['table' => $this->table,
                        //'action' => $this->action,
                        'title' => $this->title,
                        'message' => ''];
            
            $this->vista('admin/paises/create', $datos);
        }
        
        //metodo store()
        public function store(){
            $this->title = self::NVO;
            
            if($_SERVER['REQUEST_METHOD'] == 'POST'){
                $datos = ['crt_nombre_pais' => $_POST['crt_nombre_pais'],
                            'crt_nacionalidad_pais' => $_POST['crt_nacionalidad_pais'],
                            'crt_abreviatura_pais' => $_POST['crt_abreviatura_pais']
                        ];
                
                $message = $this->paisModelo->agregarPais($datos);
                
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
        
        //metodo edit()
        public function edit($id){
            //$this->action = 'Actualizar Registro';
            $this->title = self::UPD;
             
            //cuando se hace clic en el "enlace" editar/parametro... de la lista
            //obtener informacion de pais desde el modelo
            $pais = $this->paisModelo->obtenerPaisId($id);
            foreach($pais as $k => $v){
                $datos = ['table' => $this->table,
                            //'action' => $this->action,
                            'title' => $this->title,
                            'message' => '',
                            'pais' => $v['PAIS'],
                            'updt_nombre_pais' => $v['NOMBRE'],
                            'updt_nacionalidad_pais' => $v['NACIONALIDAD'],
                            'updt_abreviatura_pais' => $v['ABREVIATURA']
                        ];
            }
            
            //Cargamos la vista paises/editar
            $this->vista('admin/paises/update', $datos);
        }
        
        //metodo update()
        public function update($id){
            //$this->action = 'Actualizar Registro';
            $this->title = self::UPD;
            
            $pais = $this->paisModelo->obtenerPaisId($id);
            
            if($_SERVER['REQUEST_METHOD'] == 'POST'){
                //si se ha recibido por post los sgtes datos...
                //cuando se hace clic en el boton enviar del form...
                $datos = ['pais' => $id,
                            'updt_nombre_pais' => $_POST['updt_nombre_pais'],
                            'updt_nacionalidad_pais' => $_POST['updt_nacionalidad_pais'],
                            'updt_abreviatura_pais' => $_POST['updt_abreviatura_pais']
                        ];
                
                $message = $this->paisModelo->actualizarPais($datos);
                
                //vaciar el array $datos para volver a usarlo...
                //foreach ($datos as $key => $value) {
                //    unset($datos[$key]);
                //}
                
                //obtener informacion de pais desde el modelo
                $pais = $this->paisModelo->obtenerPaisId($id);
                foreach($pais as $k => $v){
                    $datos = ['table' => $this->table,
                                //'action' => $this->action,
                                'title' => $this->title,
                                'message' => $message,
                                'pais' => $v['PAIS'],
                                'updt_nombre_pais' => $v['NOMBRE'],
                                'updt_nacionalidad_pais' => $v['NACIONALIDAD'],
                                'updt_abreviatura_pais' => $v['ABREVIATURA']
                            ];
                 }
                $this->vista('admin/paises/update', $datos);
            }
        }
        
        //metodo borrar()
        public function borrar($id){
            // 
            //$this->action = 'Borrar Registro';
            $this->title = self::DEL;
            
            //cuando se hace clic en el "enlace" borrar/parametro... de la lista
            //obtener informacion de pais desde el modelo
            $pais = $this->paisModelo->obtenerPaisId($id);
            foreach($pais as $k => $v){
                $datos = ['table' => $this->table,
                            //'action' => $this->action,
                            'title' => $this->title,
                            'message' => '',
                            'pais' => $v['PAIS'],
                            'del_nombre_pais' => $v['NOMBRE'],
                            'del_nacionalidad_pais' => $v['NACIONALIDAD'],
                            'del_abreviatura_pais' => $v['ABREVIATURA']
                        ];
            }
            
            //invoca a la vista borrar
            $this->vista('admin/paises/delete', $datos);
        }
        
        //metodo delete()
        public function delete($id){
            // 
            //$this->action = 'Borrar Registro';
            $this->title = self::DEL;
            
            if($_SERVER['REQUEST_METHOD'] == 'POST'){
                $datos = ['pais' => $id];
                
                $message = $this->paisModelo->borrarPais($datos);

                //vaciar el array $datos para volver a usarlo...
                foreach ($datos as $key => $value) {
                    unset($datos[$key]);
                }
                
                $datos = ['table' => $this->table,
                            //'action' => $this->action,
                            'title' => $this->title,
                            'message' => $message];
               
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