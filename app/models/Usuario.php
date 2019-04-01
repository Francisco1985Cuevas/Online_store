<?php
    // Modelo Usuario
    class Usuario{
        //propiedades
        private $db;
        
        //metodos
        public function __construct(){
            $this->db = new Base;
        }
        
        public function obtenerUsuarios(){
            $this->db->query('SELECT * FROM usuarios');
            $resultados = $this->db->registros();
            return $resultados;
        }
        
        public function agregarUsuario($datos){
            $this->db->query('INSERT INTO usuarios(nombre, email, telefono) VALUES(:nombre, :email, :telefono)');
        
            //Vincular valores
            $this->db->bind(':nombre', $datos['nombre']);
            $this->db->bind(':email', $datos['email']);
            $this->db->bind(':telefono', $datos['telefono']);
            
            //Ejecutar
            if($this->db->execute()){
                return true;
            }else{
                return false;
            }
        }
        
        public function obtenerUsuarioId($id){
            $this->db->query('SELECT * FROM usuarios WHERE id_usuario = :id');
            $this->db->bind(':id', $id);
            $fila = $this->db->registro();
            return $fila;
        }
        
        public function actualizarUsuario($datos){
            $this->db->query('UPDATE usuarios SET nombre = :nombre, email = :email, telefono = :telefono WHERE id_usuario = :id'); 
        
            //Vincular valores
            $this->db->bind(':id', $datos['id_usuario']);
            $this->db->bind(':nombre', $datos['nombre']);
            $this->db->bind(':email', $datos['email']);
            $this->db->bind(':telefono', $datos['telefono']);
            
            //Ejecutar
            if($this->db->execute()){
                return true;
            }else{
                return false;
            }
        }
        
        public function borrarUsuario($datos){
            $this->db->query('DELETE FROM usuarios WHERE id_usuario = :id'); 
        
            //Vincular valores
            $this->db->bind(':id', $datos['id_usuario']);
           
            //Ejecutar
            if($this->db->execute()){
                return true;
            }else{
                return false;
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