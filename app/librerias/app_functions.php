<?php
    // funciones usadas en la aplicacion
    
    function fechaCastellano($fecha){
        //
        $fecha = substr($fecha['updated'], 0, 10);
        
        $numeroDia = date('d', strtotime($fecha));
        
        $dia = date('l', strtotime($fecha));
        $mes = date('F', strtotime($fecha));
        $anio = date('Y', strtotime($fecha));
        
        $dias_ES = array("Lunes", "Martes", "Miércoles", "Jueves", "Viernes", "Sábado", "Domingo");
        $dias_EN = array("Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday", "Sunday");
        $nombredia = str_replace($dias_EN, $dias_ES, $dia);
        
        $meses_ES = array("Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre");
        $meses_EN = array("January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December");
        $nombreMes = str_replace($meses_EN, $meses_ES, $mes);
        
        return $nombredia." ".$numeroDia." de ".$nombreMes." de ".$anio;
    }
    
    
    
    function deleteSpecialChars($str){
        //Reemplaza posibles caracteres especiales en una cadena pasado como argumento...
        
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
    
    

 