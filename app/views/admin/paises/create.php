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
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary"><?php echo $datos['action']; ?></h6>
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
                                                }
                                            ?>
                                            <!-- <form role="form" id="form_createPais" action="<?php echo RUTA_URL; ?>/paises/agregar" method="POST"> -->
                                            <form role="form" id="form_createPais" action="<?php echo RUTA_URL; ?>/paises/store" method="POST">    
                                                
                                                <div class="form-group">
                                                    <label>Nombre</label>
                                                    <input class="form-control" id="crt_nombre_pais" name="crt_nombre_pais" type="text" placeholder="Por favor, Ingrese el nombre del Pais..." required autofocus >
                                                </div>
                                                <div class="form-group">
                                                    <label>Nacionalidad</label>
                                                    <input class="form-control" id="crt_nacionalidad_pais" name="crt_nacionalidad_pais" type="text" placeholder="Ingrese Nacionalidad...">
                                                </div>
                                                <div class="form-group">
                                                    <label>Abreviatura</label>
                                                    <input class="form-control" id="crt_abreviatura_pais" name="crt_abreviatura_pais" type="text" placeholder="Ingrese abreviatura..." maxlength="3">
                                                    <p class="help-block">M&aacute;ximo de Tres(3) Caracteres.</p>
                                                </div>
                                                
                                                <button id="btn_createPais" type="submit" class="btn btn-primary btn-icon-split">
                                                    <span class="text">Guardar</span>
                                                </button>
                                            </form>
                                            
                                            <br>
                                            <!-- <div id="ajax_agregaCategoria_result"> -->
                                                <img id="loading-crt-pais" src="<?php echo IMAGES; ?>/ajax-loader.gif" />
                                            <!-- </div> -->
                                            
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
	// Scripts validacion por ajax para el form de agregar categorias
	$(document).ready(function(){
		
		//Al iniciar el formulario, ocultar el lodading de espera..
		$('#loading-crt-pais').hide();
		
		// validacion del evento: onclick() del form de agregar categorias
		$("#btn_createPais").on("click", function(){
			
            //Mostrar el lodading de espera mientras dure el proceso de insert
            $('#loading-crt-pais').show();
        
			// El usuario hizo click en el boton guardar...
			crt_nombre_pais = $("#crt_nombre_pais").val();
            
            //alert("nombre: "+crt_nombre_pais);
            
            if(crt_nombre_pais === '' || crt_nombre_pais === null){
                alert("El campo Nombre es Obligatorio");
                $('#crt_nombre_pais').val(""); //limpiar el input
				$("#crt_nombre_pais").focus(); //fijar nuevamente el focus sobre el input            
            }else{
                $("#form_createPais").submit();
            }
            
        });
	});
</script>

</body>
</html>


