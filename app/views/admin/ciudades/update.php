<?php
    //update Ciudades
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
                                                                Se ha actualizado el registro Exitosamente!
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
                                            <form role="form" id="form_updateCiudad" action="<?php echo RUTA_URL; ?>/ciudades/update/<?php echo $datos['ciudad']; ?>" method="POST">
                                                <div class="form-group">
                                                    <label>Nombre(Ciudad/Localidad)</label>
                                                    <input class="form-control" id="updt_nombre_ciudad" name="updt_nombre_ciudad" type="text" placeholder="Por favor, Ingrese el nombre de la Ciudad(Obligatorio)" value="<?php echo $datos['updt_nombre_ciudad']; ?>" autofocus required>
                                                    <p id="error_updt_nombre_ciudad" class="text-danger" >El campo Nombre es Obligatorio</p>
                                                </div>
                                                <div class="form-group">
                                                    <label>Abreviatura</label>
                                                    <input class="form-control" id="updt_abreviatura_ciudad" name="updt_abreviatura_ciudad" type="text" placeholder="Ingrese abreviatura" maxlength="3" value="<?php echo $datos['updt_abreviatura_ciudad']; ?>" >
                                                    <p id="error_updt_abreviatura_ciudad" class="text-danger" >El campo Abreviatura debe ser de m&aacute;ximo Tres(3) Caract&eacute;res</p>
                                                    <p class="help-block">M&aacute;ximo de Tres(3) Caracteres.</p>
                                                </div>
                                                <div class="form-group">
                                                    <label for="updt_pais_ciudad">Pais</label>
                                                    <select class="form-control" id="updt_pais_ciudad" name="updt_pais_ciudad">
                                                        <?php
                                                            foreach($datos['paises'] as $k => $v){
                                                                if($datos['updt_pais_ciudad'] == $v['pais'] ){
                                                                    echo "<option value='$v[pais]' selected >$v[nombre]</option>";
                                                                }else{
                                                                    echo "<option value='$v[pais]'>$v[nombre]</option>";
                                                                }
                                                            }
                                                        ?>
                                                    </select>
                                                </div>
                                                <input id="updt_id_ciudad" name="updt_id_ciudad" type="hidden" value="<?php echo $datos['ciudad']; ?>">
                                                <button id="btn_updateCiudad" type="button" class="btn btn-primary btn-icon-split">
                                                   <span class="text">Guardar</span>
                                                </button>
                                            </form>
                                            <br>
                                            <img id="loading-updt-ciudad" src="<?php echo IMAGES; ?>/ajax-loader.gif" />
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
		//Al iniciar el formulario, ocultar el lodading de espera..
		$('#loading-updt-ciudad').hide();
		$('#error_updt_nombre_ciudad').hide();
        $('#error_updt_abreviatura_ciudad').hide();
        
		// validacion del evento: onclick() del form update Ciudades
		$("#btn_updateCiudad").on("click", function(){
            //Mostrar el lodading de espera mientras dure el proceso de insert
            $('#loading-updt-ciudad').show();
        
			// El usuario hizo click en el boton guardar...
            var updt_nombre_ciudad;
            var updt_abreviatura_ciudad;
			
            updt_nombre_ciudad = $("#updt_nombre_ciudad").val();
            updt_nombre_ciudad = $.trim(updt_nombre_ciudad); //sacar espacios en blanco
            updt_abreviatura_ciudad = $("#updt_abreviatura_ciudad").val();
            //alert("nombre: "+updt_nombre_ciudad);
            
            /*if(updt_nombre_ciudad === '' || updt_nombre_ciudad === null){
                $('#updt_nombre_ciudad').css('border','1px solid #d9534f');
                $('#error_updt_nombre_ciudad').show();
                //alert("El campo Nombre es Obligatorio");
                $('#updt_nombre_ciudad').val(""); //limpiar el input
				$("#updt_nombre_ciudad").focus(); //fijar nuevamente el focus sobre el input
                $('#loading-updt-ciudad').hide();
            }else{
                $("#form_updateCiudad").submit();
            }*/
            //HAY QUE RECORRER EL FORM PARA MOSTRAR LOS ERRORES
            if(updt_nombre_ciudad === '' || updt_nombre_ciudad === null){
                //alert("El campo Nombre es Obligatorio");
                $('#updt_nombre_ciudad').css('border','1px solid #d9534f');
                $('#error_updt_nombre_ciudad').show();
                
                $('#updt_nombre_ciudad').val(""); //limpiar el input
				$("#updt_nombre_ciudad").focus(); //fijar nuevamente el focus sobre el input
                $('#loading-updt-ciudad').hide();
            }else if(updt_abreviatura_ciudad.length > 3){
                $('#updt_abreviatura_ciudad').css('border','1px solid #d9534f');
                $('#error_updt_abreviatura_ciudad').show();
            }else{
                $("#form_updateCiudad").submit();
            }
        });
	});
</script>
</body>
</html>
