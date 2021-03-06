<?php
    //update Paises
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
                            <div class="card shadow mb-8">
                                <div class="card-header py-6">
                                    <h6 class="m-0 font-weight-bold text-primary"><i class="fas fa-edit"></i> <?php echo $datos['title']; ?></h6>
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
                                                                <i class="fas fa-check-circle"></i> Se ha actualizado el registro Exitosamente!
                                                            </div>
                                                            <?php 
                                                        }else{
                                                           ?>
                                                            <div class="alert alert-danger">
                                                                <i class="fas fa-exclamation-circle"></i>º <?php echo $value; ?>
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
                                            <form role="form" id="form_updatePais" action="<?php echo RUTA_URL; ?>/paises/update/<?php echo $datos['pais']; ?>" method="POST">
                                                <div class="form-group">
                                                    <label>Nombre</label>
                                                    <input class="form-control" id="updt_nombre_pais" name="updt_nombre_pais" type="text" placeholder="Por favor, ingrese el nombre del Pais(Obligatorio)" value="<?php echo $datos['updt_nombre_pais']; ?>" autofocus required>
                                                    <p id="error_updt_nombre_pais" class="text-danger" >El campo Nombre es Obligatorio</p>
                                                </div>
                                                <div class="form-group">
                                                    <label>Nacionalidad</label>
                                                    <input class="form-control" id="updt_nacionalidad_pais" name="updt_nacionalidad_pais" type="text" placeholder="Ingrese nacionalidad" value="<?php echo $datos['updt_nacionalidad_pais']; ?>" >
                                                </div>
                                                <div class="form-group">
                                                    <label>Abreviatura</label>
                                                    <input class="form-control" id="updt_abreviatura_pais" name="updt_abreviatura_pais" type="text" placeholder="Ingrese abreviatura" maxlength="3" value="<?php echo $datos['updt_abreviatura_pais']; ?>" >
                                                    <p id="error_updt_abreviatura_pais" class="text-danger" >El campo Abreviatura debe ser de m&aacute;ximo Tres(3) Caract&eacute;res</p>
                                                    <p class="help-block">Debe escribir hasta un m&aacute;ximo de tres(3) Caract&eacute;res.</p>
                                                </div>
                                                <input id="updt_id_pais" name="updt_id_pais" type="hidden" value="<?php echo $datos['pais']; ?>">
                                                <button id="btn_updatePais" type="button" class="btn btn-primary btn-icon-split">
                                                   <span class="text">Guardar</span>
                                                </button>
                                            </form>
                                            <br>
                                            <img id="loading-updt-pais" src="<?php echo IMAGES; ?>/ajax-loader.gif" />
                                        </div>
                                    </div>                                    
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
    // Scripts validacion por ajax para el form de agregar categorias
	$(document).ready(function(){
		//Al iniciar el formulario, ocultar el lodading de espera y el parrafo error
		$('#loading-updt-pais').hide();
		$('#error_updt_nombre_pais').hide();
        $('#error_updt_abreviatura_pais').hide();
        
		// validacion del evento: onclick() del form de update pais
		$("#btn_updatePais").on("click", function(){
			var updt_nombre_pais;
            var updt_abreviatura_pais;
            
            //Mostrar el lodading de espera mientras dure el proceso de insert
            $('#loading-updt-pais').show();
        
			// El usuario hizo click en el boton guardar...
			updt_nombre_pais = $("#updt_nombre_pais").val();
            updt_nombre_pais = $.trim(updt_nombre_pais); //sacar espacios en blanco
            updt_abreviatura_pais = $("#updt_abreviatura_pais").val();
            //alert("nombre: "+updt_nombre_pais);
            
            /*if(updt_nombre_pais === '' || updt_nombre_pais === null){
                $('#updt_nombre_pais').css('border','1px solid #d9534f');
                $('#error_updt_nombre_pais').show();
                
                //alert("El campo Nombre es Obligatorio");
                $('#updt_nombre_pais').val(""); //limpiar el input
				$("#updt_nombre_pais").focus(); //fijar nuevamente el focus sobre el input            
                $('#loading-updt-pais').hide();
            }else{
                $("#form_updatePais").submit();
            }*/
            if(updt_nombre_pais === '' || updt_nombre_pais === null){
                //alert("El campo Nombre es Obligatorio");
                $('#updt_nombre_pais').css('border','1px solid #d9534f');
                $('#error_updt_nombre_pais').show();
                
                $('#updt_nombre_pais').val(""); //limpiar el input
				$("#updt_nombre_pais").focus(); //fijar nuevamente el focus sobre el input
                $('#loading-updt-pais').hide();
            }else if(updt_abreviatura_pais.length > 3){
                $('#updt_abreviatura_pais').css('border','1px solid #d9534f');
                $('#error_updt_abreviatura_pais').show();
            }else{
                $("#form_updatePais").submit();
            }
        });
	});
</script>
</body>
</html>
