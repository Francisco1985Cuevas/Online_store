<?php
    //Modelo Pais
    
    /*
     * Para identificar rapidamente el tipo de accion que se intenta hacer
     * con los datos enviados desde los formularios se abrevian los campos
     * de entrada de texto de la siguiente manera:
     * accion[create, update, delete] nombre del campo en la base de datos
     * nombre de la tabla, ejemplo: create_nombre_pais(accion_nombreCampo_tabla)
     */
    class Pais{
        //Propiedades
        private $db;
        //public $error_message = "";
        public $error_message = array(); //renombrar este array como: message
        public $error = array();
        
        //Definicion de constantes
        const NOMBRE_REQUIRED = 'El campo Nombre es Obligatorio'; //renombrar esto como: Este campo es obligatorio
        const ABREVIATURA_MAX = "El campo Abreviatura debe ser de m&aacute;ximo Tres(3) Caract&eacute;res";
        const SUCCESS = 'Se ha creado el registro exitosamente!'; //renombrar para que sea mas entendible para usar en create/udate/delete
        
        
        //Metodos
        public function __construct(){
            //
            $this->db = new Dbase;
            $dbCN = $this->db->Cnxn(); //This step is really neccesary for create connection to database, and getting the errors in methods.
            //if($dbCN == false) die("Error: No se puede conectar a la base de datos.");
            //echo $this->db->getError(); //Show error description if exist, else is empty.
            if($dbCN == false){
                echo $this->db->getError();
                //en vez del die(), puedo redireccionar a una pagina de errores
                die();
            }
        }
        
        public function obtenerPaises(){
            //
            $rs = null;
            $rs = $this->db->query("SELECT PAIS, NOMBRE, NACIONALIDAD, ABREVIATURA, DATE_FORMAT(CREATED, '%d/%m/%Y %H:%i %r') AS CREATED
                                    FROM paises 
                                    WHERE estado = 'Activo'
                                    ORDER BY CREATED, NOMBRE
                                    LIMIT 50");
            //$this->db->disconnect();
            return $rs;
        }
        
        public function agregarPais($datos){
            //crt_nombre_pais = create_nombre_pais(accion_nombreCampo_tabla)
            
            $bandera = 0;
            
            //vaciar primeramente el array $error_message
            foreach ($this->error_message as $key => $value) {
                unset($this->error_message[$key]);
            }
            
            //eliminar espacio en blanco (u otro tipo de caracteres) del inicio y el final de la cadena
            $datos['crt_nombre_pais'] = trim($datos['crt_nombre_pais']);
            $datos['crt_nacionalidad_pais'] = trim($datos['crt_nacionalidad_pais']);
            $datos['crt_abreviatura_pais'] = trim($datos['crt_abreviatura_pais']);
            
            //Eliminar si es que existe algun caracter especial que ingresa 
            //el usuario antes de insertar en la base de datos
            $datos['crt_nombre_pais'] = deleteSpecialChars($datos['crt_nombre_pais']);
            $datos['crt_nacionalidad_pais'] = deleteSpecialChars($datos['crt_nacionalidad_pais']);
            $datos['crt_abreviatura_pais'] = deleteSpecialChars($datos['crt_abreviatura_pais']);
            
            //Convertir a mayusculas para una mejor Lectura visual posterior de los datos.
            $datos['crt_nombre_pais'] = strtoupper($datos['crt_nombre_pais']);
            $datos['crt_nacionalidad_pais'] = strtoupper($datos['crt_nacionalidad_pais']);
            $datos['crt_abreviatura_pais'] = strtoupper($datos['crt_abreviatura_pais']);
            
            if(empty($datos['crt_nombre_pais'])){
                $bandera = 1;
                array_push($this->error_message, "El campo Nombre es Obligatorio");
            }
            
            //validar que se ingresen hasta tres caractres para el campo abreviatura
            if(strlen($datos['crt_abreviatura_pais']) > 3){
                $bandera = 1;
                array_push($this->error_message, "El campo Abreviatura debe ser de m&aacute;ximo Tres(3) Caract&eacute;res");
            }

            // Comprobar que no se repita un mismo nombre de pais.
            $this->db->query("SELECT * 
                                FROM paises 
                                WHERE NOMBRE = '$datos[crt_nombre_pais]'");
            if($this->db->rowcount() > 0){
                $bandera = 1;
                array_push($this->error_message, "El Nombre <b>$datos[crt_nombre_pais]</b> ya esta Registrado en la Base de datos");
            }
            
            if($bandera === 0){
                $this->db->insert("PAISES", "ABREVIATURA = '$datos[crt_abreviatura_pais]', NACIONALIDAD = '$datos[crt_nacionalidad_pais]', CREATED = now(), NOMBRE = '$datos[crt_nombre_pais]', ESTADO = 'Activo'");
                /*array_push($this->error_message, "0");
                return $this->error_message;*/
                
                array_push($this->error_message, "Se ha creado el registro exitosamente!");
                $this->error['error'] = 0; //
                array_push($this->error, $this->error_message);
                return $this->error;
            }else{
                /*return $this->error_message;*/
                
                $this->error['error'] = 1; //
                array_push($this->error, $this->error_message);
                return $this->error;
            }
        }
        
        
        public function obtenerPaisId($id){
            //
            $rs = null;
            $rs = $this->db->query("SELECT * FROM paises WHERE pais = '$id'");
            //$this->db->disconnect();
            return $rs;
        }
        
        public function actualizarPais($datos){
            //updt_nombre_pais = update_nombre_pais(accion_nombreCampo_tabla)
            
            $bandera = 0;
            
            //vaciar primeramente el array $error_message
            foreach ($this->error_message as $key => $value) {
                unset($this->error_message[$key]);
            }
            
            //eliminar espacio en blanco (u otro tipo de caracteres) del inicio y el final de la cadena
            $datos['updt_nombre_pais'] = trim($datos['updt_nombre_pais']);
            $datos['updt_nacionalidad_pais'] = trim($datos['updt_nacionalidad_pais']);
            $datos['updt_abreviatura_pais'] = trim($datos['updt_abreviatura_pais']);
            
            //Eliminar si es que existe algun caracter especial que ingreso 
            //el usuario antes de insertar en la base de datos
            $datos['updt_nombre_pais'] = deleteSpecialChars($datos['updt_nombre_pais']);
            $datos['updt_nacionalidad_pais'] = deleteSpecialChars($datos['updt_nacionalidad_pais']);
            $datos['updt_abreviatura_pais'] = deleteSpecialChars($datos['updt_abreviatura_pais']);
            
            //Convertir a mayusculas para una mejor legibilidad de los datos.
            $datos['updt_nombre_pais'] = strtoupper($datos['updt_nombre_pais']);
            $datos['updt_nacionalidad_pais'] = strtoupper($datos['updt_nacionalidad_pais']);
            $datos['updt_abreviatura_pais'] = strtoupper($datos['updt_abreviatura_pais']);
            
            if(empty($datos['updt_nombre_pais'])){
                $bandera = 1;
                //array_push($this->error_message, "El campo Nombre es Obligatorio");
                array_push($this->error_message, self::NOMBRE_REQUIRED);
            }
            
            //validar que se ingresen hasta tres caractres para el campo abreviatura
            if(strlen($datos['updt_abreviatura_pais']) > 3){
                $bandera = 1;
                //array_push($this->error_message, "El campo Abreviatura debe ser de maximo Tres(3) Caracteres");
                array_push($this->error_message, self::ABREVIATURA_MAX);
            }
            
            $rs = null;
            $rs = $this->db->query("SELECT count(*) as total 
                                    FROM paises 
                                    WHERE NOMBRE = '$datos[updt_nombre_pais]' 
                                    AND PAIS = '$datos[pais]'");
            foreach($rs as $row){
                $total = $row["total"];
            }
            
            if($total == 1){
				//no hay error							
			}else{
				$rs = $this->db->query("SELECT count(*) as total 
                                        FROM paises 
                                        WHERE NOMBRE = '$datos[updt_nombre_pais]'");
				foreach($rs as $row){
                    $total = $row["total"];
                }
                
				if($total > 0){
					//ya existe el pais...
					$bandera = 1;
                    array_push($this->error_message, "El Nombre <b>$datos[updt_nombre_pais]</b> ya esta Registrado en la Base de datos");
				}				
			}
            
            if($bandera === 0){
                //update
                $this->db->update("PAISES", "NOMBRE='$datos[updt_nombre_pais]', NACIONALIDAD='$datos[updt_nacionalidad_pais]', ABREVIATURA='$datos[updt_abreviatura_pais]',UPDATED=now()", "PAIS='$datos[pais]'");
                
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
        
        
        public function borrarPais($datos){
            //echo "id: ".$datos['pais'];
            $this->db->update("PAISES", "ESTADO='Inactivo', DELETED = now()", "PAIS='$datos[pais]'");
            /*array_push($this->error_message, "0");
            return $this->error_message;*/
            
            array_push($this->error_message, self::SUCCESS);
            $this->error['error'] = 0;
            array_push($this->error, $this->error_message);
            return $this->error;
        }
        
        
        public function get_last_updated_pais(){
            //Obtiene la fecha de la ultima actualizacion en la tabla de Paises
            $rs = null;
            $rs = $this->db->query("SELECT CREATED, UPDATED 
                                    FROM paises 
                                    WHERE ESTADO = 'Activo' 
                                    ORDER BY UPDATED, CREATED desc
                                    LIMIT 1");
            return $rs;
        }
        
        
        public function obtenerPaisNombre($nombre){
            //
            $rs = null;
            $rs = $this->db->query("SELECT PAIS, NOMBRE, NACIONALIDAD, ABREVIATURA, CREATED, UPDATED FROM paises WHERE NOMBRE = '$nombre' AND ESTADO = 'Activo'");
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