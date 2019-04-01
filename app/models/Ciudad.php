<?php
    //Modelo Ciudad
    class Ciudad{
        //Propiedades
        private $db;
        public $ciudad_err_msg = "";
        
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
            $rs = $this->db->query("SELECT c.*, p.nombre as NOMBRE_PAIS 
                                    FROM ciudades c join paises p on c.pais = p.pais");
            //$this->db->disconnect();
            return $rs;
        }
        
        public function obtenerPaises(){
            //
            $rs = null;
            $rs = $this->db->query("SELECT pais, nombre FROM paises");
            //$this->db->disconnect();
            return $rs;
        }
        
        public function agregarCiudad($datos){
            //Comprobar que no se repita un mismo nombre de ciudad.
            $rs = null;
            $rs = $this->db->query("SELECT * FROM ciudades WHERE nombre = '$datos[nombre]'");
            
            if($this->db->rowcount() > 0){
                $this->ciudad_err_msg = "Error: El nombre <b>$datos[nombre]</b> ya esta en uso. Debe ser unico";
                $this->db->disconnect();
                return false;
                //El nombre de sistema ya está en uso. Debe ser único
                //Debe ser un nombre único.
                //nombre ya existe en el directorio destino.
            }else{
                //$this->db->insert("CIUDADES", "ABREVIATURA = '$datos[abreviatura]', PAIS = '$datos[pais]', CREATED = now(), NOMBRE = '$datos[nombre]', UPDATED = now()");
				$rs = $this->db->insert("CIUDADES", "ABREVIATURA = '$datos[abreviatura]', PAIS = '$datos[pais]', CREATED = now(), NOMBRE = '$datos[nombre]', UPDATED = now()");
                if(empty($rs)){
                    //echo "err_msg: ".$this->db->err_msg;
                    $this->ciudad_err_msg = $this->db->err_msg;
                    $this->db->disconnect();
                    //die("");
                    return false;
                }else{
                    $this->db->disconnect();
                    return true;
                }
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
            //
            $rs = null;
            $rs = $this->db->query("SELECT * FROM ciudades WHERE nombre = '$datos[nombre]' and pais = '$datos[pais]'");
            if($this->db->rowcount() > 0){
                //$this->db->disconnect();
                return false;
            }else{
                //update
				//$getAffectedRows = $this->db->update("CIUDADES", "NOMBRE='$datos[nombre]', PAIS='$datos[pais]', ABREVIATURA='$datos[abreviatura]', UPDATED=now()", "CIUDAD='$datos[ciudad]'");
                //$this->db->disconnect();
                //return true;
                
                //$rs = $this->db->insert("CIUDADES", "ABREVIATURA = '$datos[abreviatura]', PAIS = '$datos[pais]', CREATED = now(), NOMBRE = '$datos[nombre]', UPDATED = now()");
                $getAffectedRows = $this->db->update("CIUDADES", "NOMBRE='$datos[nombre]', PAIS='$datos[pais]', ABREVIATURA='$datos[abreviatura]', UPDATED=now()", "CIUDAD='$datos[ciudad]'");
                if(empty($getAffectedRows)){
                    //echo "err_msg: ".$this->db->err_msg;
                    $this->ciudad_err_msg = $this->db->err_msg;
                    $this->db->disconnect();
                    //die("");
                    return false;
                }else{
                    $this->db->disconnect();
                    return true;
                }
            }           
        }
        
        public function borrarCiudad($datos){
            //
            //echo "id: ".$datos['ciudad'];
            //die("");
            
            if(!$getAffectedRows = $this->db->delete("CIUDADES", "CIUDAD = $datos[ciudad]")){
                //$this->db->disconnect();
                $this->ciudad_err_msg = $this->db->err_msg;
                return false;
            }else{
                //$this->db->disconnect();
                return true;
            }
        
        }
    }
    
    /*
    * Obs.: Cuando se crean los modelos, la recomendacion es que los modelos
        sean en singular y los controladores en plural
        El nombre de la clase(class) debe coincidir con el nombre del archivo
        que lo contiene.
        ejemplo: archivo: Usuario.php  ->  class Usuario{}
    */