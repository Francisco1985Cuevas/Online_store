<?php
    //create Ciudades
    require HEAD;
    //print_r($datos);
?>
<body id="page-top">
    <!-- Page Wrapper -->
    <div id="wrapper">        
        <?php
            require SIDEBAR;
        ?>
        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">
            <!-- Main Content -->
            <div id="content">
                <?php
                    require TOPBAR;
                ?>
                <!-- Begin Page Content -->
                <div class="container-fluid">
                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800"><?php echo $datos['table']; ?></h1>
                    </div>
                    <?php
                        require BREADCRUMBS;
                    ?>
                    <!-- Form Ciudad -->
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary"><i class="fas fa-newspaper"></i> <?php echo $datos['title']; ?></h6>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <?php
                                                /*if(!empty($datos['message'])){
                                                    foreach($datos['message'] as $key => $value) {
                                                        if($value == "0"){
                                                            ?>
                                                            <div class="alert alert-success">
                                                                Se ha creado el registro Exitosamente!
                                                            </div>
                                                            <?php 
                                                        }else{
                                                           ?>
                                                            <div class="alert alert-danger">
                                                                <?php echo $value; ?>
                                                            </div>
                                                            <?php  
                                                        }
                                                    } 
                                                }*/
                                                if(!empty($datos['message'])){
                                                    $error = $datos['message']['error'];
                                                    foreach($datos['message'] as $key => $value){
                                                        if(is_array($value)){
                                                            if($error == 1){ //hay error, mostrar errores
                                                                echo "<div class='alert alert-danger'>";
                                                                foreach($value as $k => $v){
                                                                    echo "<i class='fas fa-exclamation-circle'></i> $v<br>";
                                                                }
                                                                echo "</div>";
                                                            }else{ //No hay error, mostrar mensaje de exito
                                                                foreach($value as $k => $v){
                                                                    echo "<div class='alert alert-success'><i class='fas fa-check-circle'></i> $v</div>";
                                                                }
                                                            }
                                                        }
                                                    }
                                                }
                                            ?>
                                            <form role="form" id="form_createCiudad" action="<?php echo RUTA_URL; ?>/ciudades/store" method="POST">
                                                <div class="form-group">
                                                    <label>Nombre(Ciudad/Localidad)</label>
                                                    <input class="form-control" id="crt_nombre_ciudad" name="crt_nombre_ciudad" type="text" placeholder="Por favor, Ingrese el nombre de la Ciudad(Obligatorio)" required autofocus >
                                                    <p id="error_crt_nombre_ciudad" class="text-danger" >El campo Nombre es Obligatorio</p>
                                                </div>
                                                <div class="form-group">
                                                    <label>Abreviatura</label>
                                                    <input class="form-control" id="crt_abreviatura_ciudad" name="crt_abreviatura_ciudad" type="text" placeholder="Ingrese abreviatura" maxlength="3">
                                                    <p id="error_crt_abreviatura_ciudad" class="text-danger" >El campo Abreviatura debe ser de m&aacute;ximo Tres(3) Caract&eacute;res</p>
                                                    <p class="help-block">M&aacute;ximo de Tres(3) Caracteres.</p>
                                                </div>
                                                <div class="form-group">
                                                    <label for="crt_pais_ciudad">Pais</label>
                                                    <select class="form-control" id="crt_pais_ciudad" name="crt_pais_ciudad">
                                                        <?php
                                                            foreach($datos['paises'] as $k => $v){
                                                                echo "<option value='$v[pais]'>$v[nombre]</option>";
                                                            }
                                                        ?>
                                                    </select>
                                                </div>
                                                <!-- Autocomplete -->
                                                <!-- <div class="form-group"> <label for="crt_pais_ciudad">Pais</label> <input class="form-control" id="autocomplete" name="autocomplete" type="text" > </div> -->
                                                <button id="btn_createCiudad" type="button" class="btn btn-primary btn-icon-split">
                                                    <span class="text">Guardar</span>
                                                </button>
                                            </form>
                                            <br>
                                            <img id="loading-crt-ciudad" src="<?php echo IMAGES; ?>/ajax-loader.gif" />
                                        </div>
                                        <!-- /.col-lg-6 (nested) -->
                                    </div>
                                    <!-- /.row (nested) -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.container-fluid -->
            </div>
            <!-- End of Main Content -->
            <?php
                require COPYRIGHT;
            ?>
        </div>
        <!-- End of Content Wrapper -->
    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>
<?php 
    require FOOTER;
?>
<script>
	
	$(document).ready(function(){
		//Al iniciar el formulario, ocultar loading de espera, <p> con mensaje de error
		$('#loading-crt-ciudad').hide();
		$('#error_crt_nombre_ciudad').hide();
        $('#error_crt_abreviatura_ciudad').hide();
        
		// validacion del evento: onclick() del form create Ciudad
		$("#btn_createCiudad").on("click", function(){
			//Mostrar el lodading de espera mientras dure el proceso de espera
            $('#loading-crt-ciudad').show();
            
            var crt_nombre_ciudad;
			var crt_abreviatura_ciudad;
            
            // El usuario hizo click en el boton guardar...
			crt_nombre_ciudad = $("#crt_nombre_ciudad").val();
            crt_nombre_ciudad = $.trim(crt_nombre_ciudad); //sacar espacios en blanco
            crt_abreviatura_ciudad = $("#crt_abreviatura_ciudad").val();
            //alert("nombre: "+crt_nombre_ciudad);
            
            /*if(crt_nombre_ciudad === '' || crt_nombre_ciudad === null){
                $('#crt_nombre_ciudad').css('border','1px solid #d9534f');
                $('#error_crt_nombre_ciudad').show();
                //alert("El campo Nombre es Obligatorio");
                $('#crt_nombre_ciudad').val(""); //limpiar el input
				$("#crt_nombre_ciudad").focus(); //fijar nuevamente el focus sobre el input
                $('#loading-crt-ciudad').hide();
            }else{
                $("#form_createCiudad").submit();
            }*/
            if(crt_nombre_ciudad === '' || crt_nombre_ciudad === null){
                //alert("El campo Nombre es Obligatorio");
                $('#crt_nombre_ciudad').css('border','1px solid #d9534f');
                $('#error_crt_nombre_ciudad').show();
                
                $('#crt_nombre_ciudad').val(""); //limpiar el input
				$("#crt_nombre_ciudad").focus(); //fijar nuevamente el focus sobre el input
                $('#loading-crt-ciudad').hide();
            }else if(crt_abreviatura_ciudad.length > 3){
                $('#crt_abreviatura_ciudad').css('border','1px solid #d9534f');
                $('#error_crt_abreviatura_ciudad').show();
            }else{
                $("#form_createCiudad").submit();
            }
            
        });
	});
    
    /*
    var availableTags = ["ActionScript",
                            "AppleScript",
                            "Asp",
                            "BASIC",
                            "C",
                            "C++",
                            "Clojure",
                            "COBOL",
                            "ColdFusion",
                            "Erlang",
                            "Fortran",
                            "Groovy",
                            "Haskell",
                            "Java",
                            "JavaScript",
                            "Lisp",
                            "Perl",
                            "PHP",
                            "Python",
                            "Ruby",
                            "Scala",
                            "Scheme"
                        ];
    $( "#autocomplete" ).autocomplete({
        source: availableTags
        //serviceUrl: '/service.php'
        
    });
    */
</script>
</body>
</html>


