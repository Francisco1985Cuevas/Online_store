<?php
    /*
        Mapear la url ingresada en el navegador, 
        1-controlador
        2-método(funcion)
        3-Parámetro
        Ejemplo: http://localhost/Online_store/articulos/actualizar/4
     
        Este archivo lo que va a hacer es traernos la url ingresada y
        nos va a mapear, en el sentido de que:
        articulos  = controlador
        actualizar = metodo
        4          = parametro
        
        Cuando nos pasen todo esto por la url: http://localhost/Online_store/controlador/metodo/parametro
        guardamos el nombre del controlador, ir a buscar dentro de la carpeta de
        controladores si existe lo carga sino existe carga el controlador por default(paginas)
        y asi tambien para los metodos y los parametros.
    */

    class Core{
        
        //propiedades
        //protected $controladorActual = 'paginas';
        protected $controladorActual = 'paises'; //ORIGINAL
        //protected $controladorActual = 'ciudades';
        
        protected $metodoActual = 'index';
        
        protected $parametros = [];
        
        /*
            Cuando se carga una url vacia(entiendase sin controlador, metodo
            ni parametro) ejemplo: http://localhost/Online_store/
            se debe cargar un controlador actual... un controlador por defecto..
            mientras no se cargue ningun otro debe cargar ese(el default)
            y ese controlador actual es el que estamos definiendo en la 
            propiedad de esta clase:
            controladorActual = 'paginas'
            metodoActual = 'index'
            
            mientras no se cargue ningun parametro, los parametros estaran
            en un array vacio, un arreglo vacio...
            parametros = []
            
        */
        
        //metodos
        
        //Constructor: Un metodo __construct(constructor) es un metodo especial 
        //que se carga automaticamente una vez que se instancia la clase.
        public function __construct(){
            //print_r($this->getUrl()); //Array([0] => articulos, [1] => actualizar, [2] => 4)
        
            $url = $this->getUrl(); //llamamos al metodo o funcion getUrl(), que devuelve la url formateada como un array
            //$url = array: 0,1,2
            //0=controlador
            //1=metodoActual
            //2=parametro
            
            
            /* ***La parte del Controlador*** */
            //$url[0] = Es el que toma el controlador
            //buscar en la carpeta app/controllers si el archivo-controlador existe..
            if(file_exists('../app/controllers/'. ucwords($url[0]).'.php')){    
                //si existe, se setea, se configura como controlador por defecto...
                // en la variable: controladorActual, sino... se queda con su 
                // valor asignado inicialmente(paginas)
                $this->controladorActual = ucwords($url[0]);
            
                //unset indice
                unset($url[0]); 
            }
            
            //requerir el controlador
            require_once '../app/controllers/'.$this->controladorActual.'.php';
            $this->controladorActual = new $this->controladorActual;
            
            
            /* ***La parte del Metodo*** */
            //$url[1] = Es el que toma el metodo
            //chequear/verificar la segunda parte de la url que seria el metodo
            if(isset($url[1])){
                if(method_exists($this->controladorActual, $url[1])){
                    //chequeamos el metodo.
                    $this->metodoActual = $url[1];
                    //unset indice
                    unset($url[1]); 
                } 
            }
        
            //para probar traer metodo
            //echo $this->metodoActual;
            
            
            
            /* ***La parte de los Parametros*** */
            //obtener los parametros
            $this->parametros = $url ? array_values($url) : [];
            //print_r($this->parametros);
            
            
            //llamar callback con parametros array, llamamos a la clase a su metodo y le pasamos parametros si es que hay...
            call_user_func_array([$this->controladorActual, $this->metodoActual], $this->parametros);
        }

        public function getUrl(){
            //Obtiene la url que se esta ingresando en la barra de direcciones del navegador
            //Todo lo que se ingrese en la url...
            
            //url: la variable url, viene del archivo de configuraciones public/.htaccess
            //cuando la variable "url" viene a este archivo, viene de la sgte manera:
            //ejemplo: $_GET['url'] = articulos/actualizar/4
            
            //echo "<br>url: ".$_GET['url']; 
            //die("");
            
            if(isset($_GET['url'])){
                $url = rtrim($_GET['url'], '/');
                $url = filter_var($url, FILTER_SANITIZE_URL);
                $url = explode('/', $url);
                
                return $url;
            }
        }
    
    }

    /*
     * Obs.: method_exists(): Verifica si un metodo existe o no
            El controlador es quien puede tener muchos metodos ejemplo: editar(),
            insertar(), eliminar(), listar(), etc... los metodos se escriben
            en singular.. ejemplo: public function articulo(), public function editar()
     */