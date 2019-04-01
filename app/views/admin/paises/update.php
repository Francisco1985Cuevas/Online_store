<?php
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
                    <div class="row">
                        <div class="col-lg-12">
                            <!-- Basic Card Example -->
                            <div class="card shadow mb-8">
                                <div class="card-header py-6">
                                    <h6 class="m-0 font-weight-bold text-primary">
                                        <?php echo $datos['action']; ?>
                                    </h6>
                                </div>
                                <div class="card-body">
                                    
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <?php
                                                if(!empty($datos['message'])){
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
                                                }
                                            ?>
                                            <!-- <form role="form" id="form_updatePais" action="<?php echo RUTA_URL; ?>/paises/editar/<?php echo $datos['pais']; ?>" method="POST"> -->
                                            <form role="form" id="form_updatePais" action="<?php echo RUTA_URL; ?>/paises/update/<?php echo $datos['pais']; ?>" method="POST">
                                                <div class="form-group">
                                                    <label>Nombre</label>
                                                    <input class="form-control" id="updt_nombre_pais" name="updt_nombre_pais" type="text" placeholder="Por favor, Ingrese Nombre del Pais..." value="<?php echo $datos['updt_nombre_pais']; ?>" autofocus required>
                                                </div>
                                                <div class="form-group">
                                                    <label>Nacionalidad</label>
                                                    <input class="form-control" id="updt_nacionalidad_pais" name="updt_nacionalidad_pais" type="text" placeholder="Ingrese Nacionalidad..." value="<?php echo $datos['updt_nacionalidad_pais']; ?>" >
                                                </div>
                                                <div class="form-group">
                                                    <label>Abreviatura</label>
                                                    <input class="form-control" id="updt_abreviatura_pais" name="updt_abreviatura_pais" type="text" placeholder="Ingrese abreviatura..." maxlength="3" value="<?php echo $datos['updt_abreviatura_pais']; ?>" >
                                                    <p class="help-block">M&aacute;ximo de Tres(3) Caracteres.</p>
                                                </div>
                                                <input id="updt_id_pais" name="updt_id_pais" type="hidden" value="<?php echo $datos['pais']; ?>">
                                                <button id="btn_updatePais" type="submit" class="btn btn-primary btn-icon-split">
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
    /*    
    $(document).ready(function() {
        $('#dataTables-pais').DataTable({
            responsive: true,
            "language": {"url": "<?php /*echo RUTA_URL*/?>/js/spanish.json"}
        });
    });
    */
    
    // Scripts validacion por ajax para el form de agregar categorias
	$(document).ready(function(){
		
		//Al iniciar el formulario, ocultar el lodading de espera..
		$('#loading-updt-pais').hide();
		
		// validacion del evento: onclick() del form de agregar categorias
		$("#btn_updatePais").on("click", function(){
			
            //Mostrar el lodading de espera mientras dure el proceso de insert
            $('#loading-updt-pais').show();
        
			// El usuario hizo click en el boton guardar...
			updt_nombre_pais = $("#updt_nombre_pais").val();
            
            //alert("nombre: "+edtr_nombre_pais);
            
            if(updt_nombre_pais === '' || updt_nombre_pais === null){
                alert("El campo Nombre es Obligatorio");
                $('#updt_nombre_pais').val(""); //limpiar el input
				$("#updt_nombre_pais").focus(); //fijar nuevamente el focus sobre el input            
            }else{
                $("#form_updatePais").submit();
            }
            
        });
	});
    
</script>
</body>
</html>
