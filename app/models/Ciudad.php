<?php
    //Modelo Ciudad
    class Ciudad{
        //Propiedades
        private $db;
        public $error_message = array();
        public $error = array();
        
        //Definicion de constantes
        const NOMBRE_REQUIRED = 'El campo Nombre es Obligatorio'; //renombrar esto como: Este campo es obligatorio
        const ABREVIATURA_MAX = "El campo Abreviatura debe ser de m&aacute;ximo Tres(3) Caract&eacute;res";
        const SUCCESS = 'Se ha creado el registro exitosamente!'; //renombrar para que sea mas entendible para usar en create/udate/delete
        //
        //Metodos
        public function __construct(){
            //
            $this->db = new Dbase;
            $dbCN = $this->db->Cnxn(); //This step is really neccesary for create connection to database, and getting the errors in methods.
            //if($dbCN == false) die("Error: No se puede conectar a la base de datos.");
            //echo $this->db->getError(); //Show error description if exist, else is empty.
            if($dbCN == false){
                echo $this->db->getError();
                die();
            }
        }
        
        public function obtenerCiudades(){
            //
            $rs = null;
            $rs = $this->db->query("select c.*, p.NOMBRE as NOMBRE_PAIS
                                    from ciudades c join paises p on c.PAIS = p.PAIS
                                    where c.ESTADO = 'Activo'
                                    and p.ESTADO = 'Activo'
                                    order by c.CREATED, c.NOMBRE
                                    LIMIT 50");
            //$this->db->disconnect();
            return $rs;
        }
        
        
        public function obtenerPaises(){
            //
            $rs = null;
            $rs = $this->db->query("SELECT pais, nombre FROM paises WHERE estado = 'Activo'");
            //$this->db->disconnect();
            return $rs;
        }
        

        public function agregarCiudad($datos){
            //crt_nombre_ciudad = create_nombre_ciudad(accion_nombreCampo_tabla)
            
            $bandera = 0;
            
            //vaciar primeramente el array $error_message
            foreach ($this->error_message as $key => $value) {
                unset($this->error_message[$key]);
            }
            
            //eliminar espacio en blanco (u otro tipo de caracteres) del inicio y el final de la cadena
            $datos['crt_nombre_ciudad'] = trim($datos['crt_nombre_ciudad']);
            $datos['crt_abreviatura_ciudad'] = trim($datos['crt_abreviatura_ciudad']);
            
            
            //Eliminar si es que existe algun caracter especial que ingresa 
            //el usuario antes de insertar en la base de datos
            $datos['crt_nombre_ciudad'] = deleteSpecialChars($datos['crt_nombre_ciudad']);
            $datos['crt_abreviatura_ciudad'] = deleteSpecialChars($datos['crt_abreviatura_ciudad']);
            
            
            //Convertir a mayusculas para una mejor Lectura visual posterior de los datos.
            $datos['crt_nombre_ciudad'] = strtoupper($datos['crt_nombre_ciudad']);
            $datos['crt_abreviatura_ciudad'] = strtoupper($datos['crt_abreviatura_ciudad']);
            
            
            if(empty($datos['crt_nombre_ciudad'])){
                $bandera = 1;
                //array_push($this->error_message, "El campo Nombre es Obligatorio");
                array_push($this->error_message, self::NOMBRE_REQUIRED);
            }
            
            //validar que se ingresen hasta tres caractres para el campo abreviatura
            if(strlen($datos['crt_abreviatura_ciudad']) > 3){
                $bandera = 1;
                //array_push($this->error_message, "El campo Abreviatura debe ser de maximo Tres(3) Caracteres");
                array_push($this->error_message, self::ABREVIATURA_MAX);
            }

            // Comprobar que no se repita un mismo nombre de ciudad.
            $this->db->query("SELECT * 
                                FROM ciudades 
                                WHERE NOMBRE = '$datos[crt_nombre_ciudad]' 
                                AND PAIS = '$datos[crt_pais_ciudad]'");
            if($this->db->rowcount() > 0){
                $bandera = 1;
                array_push($this->error_message, "El Nombre <b>$datos[crt_nombre_ciudad]</b> ya esta Registrado en la Base de datos");
            }
            
            if($bandera === 0){
                $this->db->insert("CIUDADES", "ABREVIATURA = '$datos[crt_abreviatura_ciudad]', PAIS = '$datos[crt_pais_ciudad]', CREATED = now(), NOMBRE = '$datos[crt_nombre_ciudad]', ESTADO = 'Activo'");
                
                /*array_push($this->error_message, "0");
                return $this->error_message;*/
                
                array_push($this->error_message, self::SUCCESS);
                $this->error['error'] = 0;
                array_push($this->error, $this->error_message);
                return $this->error;
            }else{
                /*return $this->error_message;*/
                
                $this->error['error'] = 1; //
                array_push($this->error, $this->error_message);
                return $this->error;
            }
        }
        
        
        public function obtenerCiudadId($id){
            //
            $rs = null;
            $rs = $this->db->query("SELECT * FROM ciudades WHERE ciudad = '$id'");
            //echo "err_msg: ".$this->db->err_msg;
            //$this->db->disconnect();
            //print_r($rs);
            return $rs;
        }
        
        
        public function actualizarCiudad($datos){
            //updt_nombre_ciudad = update_nombre_ciudad(accion_nombreCampo_tabla)
            
            $bandera = 0;
            
            //vaciar primeramente el array $error_message
            foreach ($this->error_message as $key => $value) {
                unset($this->error_message[$key]);
            }
            
            //eliminar espacio en blanco (u otro tipo de caracteres) del inicio y el final de la cadena
            $datos['updt_nombre_ciudad'] = trim($datos['updt_nombre_ciudad']);
            $datos['updt_abreviatura_ciudad'] = trim($datos['updt_abreviatura_ciudad']);
            
            
            //Eliminar si es que existe algun caracter especial que ingreso 
            //el usuario antes de insertar en la base de datos
            $datos['updt_nombre_ciudad'] = deleteSpecialChars($datos['updt_nombre_ciudad']);
            $datos['updt_abreviatura_ciudad'] = deleteSpecialChars($datos['updt_abreviatura_ciudad']);
            
            
            //Convertir a mayusculas para una mejor legibilidad de los datos.
            $datos['updt_nombre_ciudad'] = strtoupper($datos['updt_nombre_ciudad']);
            $datos['updt_abreviatura_ciudad'] = strtoupper($datos['updt_abreviatura_ciudad']);
            
            if(empty($datos['updt_nombre_ciudad'])){
                $bandera = 1;
                //array_push($this->error_message, "El campo Nombre es Obligatorio");
                array_push($this->error_message, self::NOMBRE_REQUIRED);
            }
            
            //validar que se ingresen hasta tres caractres para el campo abreviatura
            if(strlen($datos['updt_abreviatura_ciudad']) > 3){
                $bandera = 1;
                //array_push($this->error_message, "El campo Abreviatura debe ser de maximo Tres(3) Caracteres");
                array_push($this->error_message, self::ABREVIATURA_MAX);
            }
            
            $rs = null;
            $rs = $this->db->query("SELECT count(*) as total 
                                    FROM ciudades 
                                    WHERE NOMBRE = '$datos[updt_nombre_ciudad]' 
                                    AND CIUDAD = '$datos[ciudad]'");
            foreach($rs as $row){
                $total = $row["total"];
            }
            
            if($total == 1){
				//no hay error							
			}else{
				$rs = $this->db->query("SELECT count(*) as total 
                                        FROM ciudades 
                                        WHERE NOMBRE = '$datos[updt_nombre_ciudad]'");
				foreach($rs as $row){
                    $total = $row["total"];
                }
                
				if($total > 0){
					//ya existe el pais...
					$bandera = 1;
                    array_push($this->error_message, "El Nombre <b>$datos[updt_nombre_ciudad]</b> ya esta Registrado en la Base de datos");
				}				
			}
            
            if($bandera === 0){
                //update
                $this->db->update("CIUDADES", "NOMBRE='$datos[updt_nombre_ciudad]', PAIS='$datos[updt_pais_ciudad]', ABREVIATURA='$datos[updt_abreviatura_ciudad]',UPDATED=now()", "CIUDAD='$datos[ciudad]'");
                
                /*array_push($this->error_message, "0");
                return $this->error_message;*/
                
                array_push($this->error_message, self::SUCCESS);
                $this->error['error'] = 0;
                array_push($this->error, $this->error_message);
                return $this->error;
            }else{
                /*return $this->error_message;*/
                
                $this->error['error'] = 1; //
                array_push($this->error, $this->error_message);
                return $this->error;
            }                
        }
        
        
        public function borrarCiudad($datos){
            //echo "id: ".$datos['ciudad'];
            $this->db->update("CIUDADES", "ESTADO='Inactivo', DELETED = now()", "CIUDAD='$datos[ciudad]'");
            
            /*array_push($this->error_message, "0");
            return $this->error_message;*/
            
            array_push($this->error_message, self::SUCCESS);
            $this->error['error'] = 0;
            array_push($this->error, $this->error_message);
            return $this->error;
        }
        
        
        public function get_last_updated_ciudad(){
            //Obtiene la fecha de la ultima actualizacion en la tabla de Ciudades
            $rs = null;
            $rs = $this->db->query("SELECT CREATED, UPDATED 
                                    FROM ciudades 
                                    WHERE ESTADO = 'Activo' 
                                    ORDER BY UPDATED, CREATED desc
                                    LIMIT 1");
            return $rs;
        }
        
        
        public function obtenerCiudadNombre($nombre){
            //
            $rs = null;
            $rs = $this->db->query("SELECT c.PAIS, c.CIUDAD, c.NOMBRE, c.ABREVIATURA, c.CREATED, c.UPDATED, p.nombre as NOMBRE_PAIS  
                                    FROM ciudades c join paises p on c.pais = p.pais
                                    WHERE c.estado = 'Activo'
                                    AND c.NOMBRE = '$nombre' 
                                    AND p.ESTADO = 'Activo'");
            return $rs;
        }
    }
    
    /*
    * Obs.: Cuando se crean los modelos, la recomendacion es que los modelos
        sean en singular y los controladores en plural
        El nombre de la clase(class) debe coincidir con el nombre del archivo
        que lo contiene.
        ejemplo: archivo: Usuario.php  ->  class Usuario{}
    */
    