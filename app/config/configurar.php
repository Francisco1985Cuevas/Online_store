<?php
    //Configuracion de acceso a la base de datos
    /*
    define('DB_HOST', 'localhost');
    define('DB_USUARIO', 'root');
    define('DB_PASSWORD', '');
    define('DB_NOMBRE', 'crud_mvc2');
    */
    
    define('DB_SERVER', '127.0.0.1');
    define('DB_USER', 'root');
    define('DB_PASS', '');
    define('DB_NAME', 'online_store_db');
    define('DB_PORT', '');
    define('DB_TYPE', 'mysql');
    
    //Ruta de la aplicacion
    //echo dirname(dirname(__FILE__));
    //Ruta de la aplicacion, Ejemplo: C:\wamp64\www\Online_store\app
    define('RUTA_APP', dirname(dirname(__FILE__)));
    //echo "RUTA_APP: ".RUTA_APP;
    
    //Ruta url Ejemplo: http://localhost/Online_store/
    define('RUTA_URL', 'http://localhost/Online_store');
    
    //Nombre del proyecto o sitio
    define('NOMBRESITIO', 'Tienda Online - Version-2.0');
    define('SITENAME', 'Tienda Online');
    define('VERSION', 'Version 2.0');
    
    //Directorios
    define('VIEWS', RUTA_APP . '/views');
    define('HEAD', VIEWS . '/inc/head.php');
    define('FOOTER', VIEWS . '/inc/footer.php');
    define('SIDEBAR', VIEWS . '/inc/Sidebar.php');
    define('TOPBAR', VIEWS . '/inc/Topbar.php');
    define('BREADCRUMBS', VIEWS . '/inc/Breadcrumbs.php');
    define('COPYRIGHT', VIEWS . '/inc/copyright.php');
    
    define('IMAGES', RUTA_URL . '/public/images');