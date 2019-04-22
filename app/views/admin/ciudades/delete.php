<?php 
    //delete Ciudades
    require HEAD;
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
                                    <h6 class="m-0 font-weight-bold text-primary"><i class="fas fa-trash"></i> <?php echo $datos['title']; ?></h6>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <!--<div class="alert alert-warning">
                                                Realmente esta seguro de querer eliminar este Registro?
                                            </div>-->
                                            <?php
                                                /*if(!empty($datos['message'])){
                                                    foreach($datos['message'] as $key => $value) {
                                                        if($value == "0"){
                                                            ?>
                                                            <div class="alert alert-success">
                                                                Se ha borrado el registro Exitosamente!
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
                                                }else{
                                                   ?>
                                                    <div class="alert alert-warning">
                                                        <i class="fas fa-exclamation-circle"></i> Realmente esta seguro de querer eliminar este Registro?
                                                    </div>
                                                    <?php 
                                                }
                                            ?>
                                            <form role="form" id="form_deleteCiudad" action="<?php echo RUTA_URL; ?>/ciudades/delete/<?php echo $datos['ciudad']; ?>" method="POST">    
                                                <div class="form-group">
                                                    <label>Nombre(Ciudad/Localidad)</label>
                                                    <input class="form-control" id="del_nombre_ciudad" name="del_nombre_ciudad" type="text" placeholder="Por favor, Ingrese el nombre de la Ciudad(Obligatorio)" value="<?php echo $datos['del_nombre_ciudad']; ?>" autofocus required>
                                                </div>
                                                <div class="form-group">
                                                    <label>Abreviatura</label>
                                                    <input class="form-control" id="del_abreviatura_ciudad" name="del_abreviatura_ciudad" type="text" placeholder="Ingrese abreviatura" maxlength="3" value="<?php echo $datos['del_abreviatura_ciudad']; ?>" >
                                                    <p class="help-block">M&aacute;ximo de Tres(3) Caracteres.</p>
                                                </div>
                                                <div class="form-group">
                                                    <label for="del_pais_ciudad">Pais</label>
                                                    <select class="form-control" id="del_pais_ciudad" name="del_pais_ciudad">
                                                        <?php
                                                            foreach($datos['paises'] as $k => $v){
                                                                if($datos['del_pais_ciudad'] == $v['pais'] ){
                                                                    echo "<option value='$v[pais]' selected >$v[nombre]</option>";
                                                                }else{
                                                                    echo "<option value='$v[pais]'>$v[nombre]</option>";
                                                                }
                                                            }
                                                        ?>
                                                    </select>
                                                </div>
                                                <button id="btn_deleteCiudad" type="button" class="btn btn-danger btn-icon-split">
                                                    <span class="text">Eliminar</span>
                                                </button>
                                            </form>
                                            <br>
                                            <img id="loading-del-ciudad" src="<?php echo IMAGES; ?>/ajax-loader.gif" />
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
        //Al iniciar el formulario, ocultar el <img loading> 
		$('#loading-del-ciudad').hide();
        
        // validacion del evento: onclick() del form de delete ciudad
		$("#btn_deleteCiudad").on("click", function(){
			//Mostrar el loading de espera mientras dure el proceso
            $('#loading-del-ciudad').show();
            
            $("#form_deleteCiudad").submit();
        });
    });
</script>
</body>
</html>
