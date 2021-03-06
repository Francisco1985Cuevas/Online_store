<?php
    //create Paises
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
                    <!-- Form Pais -->
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
                                                //mensaje de error o exito
                                                //print_r($datos);
                                                /*if(!empty($datos['message'])){
                                                    foreach($datos['message'] as $key => $value) {
                                                        if($value == "0"){
                                                            ?>
                                                            <div class="alert alert-success">
                                                                <i class="fas fa-check-circle"></i> Se ha creado el registro Exitosamente!
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
                                            <form role="form" id="form_createPais" action="<?php echo RUTA_URL; ?>/paises/store" method="POST">  
                                                <div class="form-group">
                                                    <label>Nombre</label>
                                                    <input class="form-control" id="crt_nombre_pais" name="crt_nombre_pais" type="text" placeholder="Por favor, ingrese el nombre del Pais(Obligatorio)" required autofocus />
                                                    <p id="error_crt_nombre_pais" class="text-danger" >El campo Nombre es Obligatorio</p>
                                                </div>
                                                <div class="form-group">
                                                    <label>Nacionalidad</label>
                                                    <input class="form-control" id="crt_nacionalidad_pais" name="crt_nacionalidad_pais" type="text" placeholder="Ingrese nacionalidad">
                                                </div>
                                                <div class="form-group">
                                                    <label>Abreviatura</label>
                                                    <input class="form-control" id="crt_abreviatura_pais" name="crt_abreviatura_pais" type="text" placeholder="Ingrese abreviatura" maxlength="3">
                                                    <p id="error_crt_abreviatura_pais" class="text-danger" >El campo Abreviatura debe ser de m&aacute;ximo Tres(3) Caract&eacute;res</p>
                                                    <p class="help-block">Debe escribir hasta un m&aacute;ximo de tres(3) Caract&eacute;res.</p>
                                                </div>
                                                <button id="btn_createPais" type="button" class="btn btn-primary btn-icon-split">
                                                    <span class="text">Guardar</span>
                                                </button>
                                            </form>
                                            <br>
                                            <img id="loading-crt-pais" src="<?php echo IMAGES; ?>/ajax-loader.gif" />
                                        </div>
                                        <!-- /.col-lg-12 (nested) -->
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
		//Al iniciar el formulario, ocultar el <img loading> y los <p error> 
		$('#loading-crt-pais').hide();
		$('#error_crt_nombre_pais').hide();
        $('#error_crt_abreviatura_pais').hide();
        
        // validacion del evento: onclick() del form de crear pais
		$("#btn_createPais").on("click", function(){
			//Mostrar el loading de espera mientras dure el proceso de insert
            $('#loading-crt-pais').show();
            
            var crt_nombre_pais;
            var crt_abreviatura_pais;
            
            // El usuario hizo click en el boton guardar...
			crt_nombre_pais = $("#crt_nombre_pais").val();
            crt_nombre_pais = $.trim(crt_nombre_pais); //sacar espacios en blanco
            crt_abreviatura_pais = $("#crt_abreviatura_pais").val();
            
            /*if(crt_nombre_pais === '' || crt_nombre_pais === null){
                //alert("El campo Nombre es Obligatorio");
                $('#crt_nombre_pais').css('border','1px solid #d9534f');
                $('#error_crt_nombre_pais').show();
                
                $('#crt_nombre_pais').val(""); //limpiar el input
				$("#crt_nombre_pais").focus(); //fijar nuevamente el focus sobre el input
                $('#loading-crt-pais').hide();
            }else{
                $("#form_createPais").submit();
            }*/
            if(crt_nombre_pais === '' || crt_nombre_pais === null){
                //alert("El campo Nombre es Obligatorio");
                $('#crt_nombre_pais').css('border','1px solid #d9534f');
                $('#error_crt_nombre_pais').show();
                
                $('#crt_nombre_pais').val(""); //limpiar el input
				$("#crt_nombre_pais").focus(); //fijar nuevamente el focus sobre el input
                $('#loading-crt-pais').hide();
            }else if(crt_abreviatura_pais.length > 3){
                $('#crt_abreviatura_pais').css('border','1px solid #d9534f');
                $('#error_crt_abreviatura_pais').show();
            }else{
                $("#form_createPais").submit();
            }
                 
        });
	});
</script>

</body>
</html>


