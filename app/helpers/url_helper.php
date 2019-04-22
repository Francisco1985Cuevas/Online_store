<?php
    //Para redireccionar pagina
    function redireccionar($pagina){
        header('location: '. RUTA_URL .$pagina);
    }
    
    
    /**
	 * Convierte con funciones de PHP, una fecha pasada como parametro
	 * en formato un poco mas entendible para la vista del usuario
     * 
     * @param  String  $fecha
	 * @return Fecha Formateada
	 */
    function fechaCastellano($fecha){
        //
        $fecha = substr($fecha, 0, 10);
        
        $numeroDia = date('d', strtotime($fecha));
        
        $dia = date('l', strtotime($fecha));
        $mes = date('F', strtotime($fecha));
        $anho = date('Y', strtotime($fecha));
        
        $dias_ES = array("Lunes", "Martes", "Miércoles", "Jueves", "Viernes", "Sábado", "Domingo");
        $dias_EN = array("Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday", "Sunday");
        $nombredia = str_replace($dias_EN, $dias_ES, $dia);
        
        $meses_ES = array("Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre");
        $meses_EN = array("January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December");
        $nombreMes = str_replace($meses_EN, $meses_ES, $mes);
        
        return $nombredia." ".$numeroDia." de ".$nombreMes." de ".$anho;   
    }
    
    
    /**
	 * Reemplaza posibles caracteres especiales en una cadena pasado como parametro...
     * 
     * @param  String  $str
	 * @return $str Formateado
	 */
    function deleteSpecialChars($str){
        //~`!@#$%^&*()_-=+{}[]"':;?/><.,
		
        $patterns = array('/\//', '/\~/', '/\`/', '/\!/', '/\@/', 
                            '/\#/', '/\$/', '/\%/', '/\^/', '/\&/', 
                            '/\*/', '/\(/', '/\)/', '/\_/', '/\-/', 
                            '/\=/', '/\+/', '/\{/', '/\}/', '/\[/', 
                            '/\]/', "/\'/", '/\;/', '/\;/', '/\?/', 
                            '/\//', '/\\\/', '/\</', '/\>/', '/\./',
                            '/\,/');
		
        $replace = array('', '', '', '', '', 
                            '', '', '', '', '',
                            '', '', '', '', '', 
                            '', '', '', '', '', 
                            '', '', '', '', '', 
                            '', '', '', '', '',
                            '');
		   
		return preg_replace($patterns, $replace, $str);
	}
    