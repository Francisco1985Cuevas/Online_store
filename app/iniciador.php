<?php
    //Cargamos librerias
    require_once 'config/configurar.php';

    require_once 'helpers/url_helper.php';
    //require_once 'librerias/Dbase.php';
    //require_once 'librerias/Base.php';
    //require_once 'librerias/Controlador.php';
    //require_once 'librerias/Core.php';
    
    
    //Autoload php
    spl_autoload_register(function($nombreClase){
        require_once 'librerias/'.$nombreClase.'.php';
    });
    
    require_once 'librerias/app_functions.php';
    
    
    //$var = new Dbase;
    //$dbCN = $this->db->Cnxn(); //This step is really neccesary for create connection to database, and getting the errors in methods.
    //if($dbCN == false) die("Error: No se puede conectar a la base de datos.");
    //echo $this->db->getError(); //Show error description if exist, else is empty.
    
    /*
        # Autoload PHP para las clases.
        --------------------------------
        Obs.: ¿En resumen como funciona la funcion especial de PHP spl_autoload_register() ?
                - detecta cuales son los archivos que se encuentran dentro de la 
                    carpeta, para este caso es la carpeta: "librerias", cuales son 
                    los archivos que empiezan con Mayuscula inicial y son archivos 
                    de clase(class), y ya crea una instancia de dichas clases sin
                    la necesidad de tener que hacerlo manualmente.
                - Si en la carpeta librerias, tenemos muchos archivos.php con el autoload
                  los instanciaria.. la regla debe ser que el NOMBRE DEL ARCHIVO
                  [Base, Controlador, Core, etc..] debe corresponder exactamente 
                    el nombre del archivo con el nombre de la clase.
     */