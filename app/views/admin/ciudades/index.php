<?php
    //index Ciudades
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
                        <a href="<?php echo RUTA_URL; ?>/ciudades/create" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
                            <i class="fas fa-plus fa-sm text-white-50"></i> 
                            Nuevo Registro
                        </a>
                    </div>
                    <?php
                        require BREADCRUMBS;
                    ?>
                    <!-- Para evitar cuellos de botella con los registros en el
                    servidor, al mostrar el listado, mostrar solo hasta un cierto
                    rango de datos, dependiendo de la tabla que se este listando
                    Para darle una solucion provisoria se va a agregar un 
                    buscador que posteriormente hay que usar AUTOCOMPLETE de los
                    registros..-->
                    <div class="row">
                        <div class="col-xl-3 col-md-12 mb-4">
                            <div class="card border-left-primary shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <!-- Search Ciudad -->
                                            <form role="form" id="form_searchCiudad" action="<?php echo RUTA_URL; ?>/ciudades/search" method="POST">
                                                <div class="input-group">
                                                    <input id="search_nombre_ciudad" name="search_nombre_ciudad" type="text" class="form-control bg-light border-0 small" placeholder="Buscar..." aria-label="Search" aria-describedby="basic-addon2">
                                                    <div class="input-group-append">
                                                        <button id="btn_searchCiudad" class="btn btn-primary" type="button">
                                                            <i class="fas fa-search fa-sm"></i>
                                                        </button>
                                                    </div>
                                                </div>
                                                <br>
                                                <img id="loading-search-ciudad" src="<?php echo IMAGES; ?>/ajax-loader.gif" />
                                                <p id="error_search_nombre_ciudad" class="text-danger" >El campo Nombre es Obligatorio para iniciar la busqueda.</p>
                                            </form>
                                            <?php
                                                if(!empty($datos['search'])){
                                                    if(is_array($datos['ciudad_search']) && count($datos['ciudad_search']) > 0 ){
                                                        ?>
                                                        <!-- Ciudad results table -->
                                                        <br>
                                                        <table class="table table-bordered" id="dataTable-search-ciudad" width="100%" cellspacing="0">
                                                            <thead>
                                                                <tr>
                                                                    <th>ID</th>
                                                                    <th>Nombre</th>
                                                                    <th>Abreviatura</th>
                                                                    <th>Pais</th>
                                                                    <th>Creado</th>
                                                                    <th class="text-center">Operaci&oacute;n</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <?php
                                                                    foreach($datos['ciudad_search'] as $k => $v){
                                                                        echo "<tr>";
                                                                        echo "<td>".$v['CIUDAD']."</td>";
                                                                        echo "<td>".$v['NOMBRE']."</td>";
                                                                        echo "<td>".$v['ABREVIATURA']."</td>";
                                                                        echo "<td>".$v['NOMBRE_PAIS']."</td>";
                                                                        echo "<td>".$v['CREATED']."</td>";
                                                                        echo "<td>";
                                                                        echo "<a class='btn btn-success btn-circle btn-sm' href='".RUTA_URL."/ciudades/edit/".$v['CIUDAD']."' title='Actualizar'> 
                                                                                <i class='fas fa-edit'></i>
                                                                            </a>";
                                                                        echo "<a class='btn btn-danger btn-circle btn-sm' href='".RUTA_URL."/ciudades/borrar/".$v['CIUDAD']."' title='Borrar'> 
                                                                                <i class='fas fa-trash'></i>
                                                                            </a>";
                                                                        echo "</td>";
                                                                        echo "</tr>";
                                                                    }
                                                                ?>                      
                                                            </tbody>
                                                        </table>
                                                        <?php
                                                    }else{
                                                        ?>
                                                        <br>
                                                        <div class="alert alert-warning">
                                                            <i class="fas fa-exclamation-triangle"></i>
                                                            No se encontraron resultados para la busqueda.
                                                        </div>  
                                                        <?php
                                                    }
                                                }
                                            ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- DataTale List Ciudades -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary"><i class="fas fa-list"></i> <?php echo $datos['title']; ?></h6>
                        </div>
                        <div class="card-body">
                            <?php
                                if(is_array($datos['ciudades']) && count($datos['ciudades']) > 0){
                                    ?>
                                    <div class="table-responsive">
                                        <table class="table table-bordered" id="dataTable-list-ciudad" width="100%" cellspacing="0">
                                            <thead>
                                                <tr>
                                                    <th>ID</th>
                                                    <th>Nombre</th>
                                                    <th>Abreviatura</th>
                                                    <th>Pais</th>
                                                    <th>Creado</th>
                                                    <th class="text-center">Operaci&oacute;n</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                    foreach($datos['ciudades'] as $k => $v){
                                                        echo "<tr>";
                                                        echo "<td>".$v['CIUDAD']."</td>";
                                                        echo "<td>".$v['NOMBRE']."</td>";
                                                        echo "<td>".$v['ABREVIATURA']."</td>";
                                                        echo "<td>".$v['NOMBRE_PAIS']."</td>";
                                                        echo "<td>".$v['CREATED']."</td>";
                                                        echo "<td>";
                                                        echo "<a class='btn btn-success btn-circle btn-sm' href='".RUTA_URL."/ciudades/edit/".$v['CIUDAD']."' title='Actualizar'> 
                                                                <i class='fas fa-edit'></i>
                                                            </a>";
                                                        echo "<a class='btn btn-danger btn-circle btn-sm' href='".RUTA_URL."/ciudades/borrar/".$v['CIUDAD']."' title='Borrar'> 
                                                                <i class='fas fa-trash'></i>
                                                            </a>";
                                                        echo "</td>";
                                                        echo "</tr>";
                                                    }
                                                ?>                      
                                            </tbody>
                                        </table>
                                    </div>
                                    <?php
								}else{
                                    ?>
                                    <!--<div class="card mb-4">
                                        <div class="card-header">
                                           <i class="fas fa-list"></i> <?php echo $datos['title']; ?>
                                        </div>
                                        <div class="card-body">-->
                                            
                                            <div class="alert alert-info">
                                                <i class="fas fa-info-circle"></i>
                                                No se registran <?php echo $datos['table']; ?> Guardadas.
                                            </div>
                                            <!--<br>-->
                                            <div class="card-body d-flex">
                                                <a href="<?php echo RUTA_URL; ?>/ciudades/create" class="btn btn-primary btn-icon-split">
                                                    <span class="icon text-white-50">
                                                        <i class="fas fa-plus"></i>
                                                    </span>
                                                    <span class="text">Nuevo Registro</span>
                                                </a>
                                            </div>
                                            
                                        <!--</div>
                                    </div>-->
									<?php
								}
                            ?>
                        </div>
                        <div class="card-footer small text-muted">
                            <?php
                                //echo "&Uacute;ltima actualizaci&oacute;n, $datos[last_pais_updated]";
                                if(!empty($datos['last_ciudad_updated'])){
                                    echo "&Uacute;ltima actualizaci&oacute;n, $datos[last_ciudad_updated]";
                                }
                            ?>
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
    // Script Javascript, JQuery
    $(document).ready(function() {
        //ocultar inicialmente la etiqueta <p> que muestra los errores y el <img> de espera
        $('#loading-search-ciudad').hide();
        $('#error_search_nombre_ciudad').hide();
        
        // Call the dataTables jQuery plugin
        $('#dataTable-list-ciudad').DataTable({
            "scrollY":        "300px",
            "scrollCollapse": true,
            responsive: true,
            "language": {"url": "<?php echo RUTA_URL; ?>/public/js/spanish.json"}
        } );
        
        // validacion del evento: onclick() del form de busqueda de ciudad por nombre
        $("#btn_searchCiudad").on("click", function(){
            var search_nombre_ciudad;
            
            //Mostrar el lodading de espera mientras dure el proceso de busqueda
            $('#loading-search-ciudad').show();
            
            search_nombre_ciudad = $("#search_nombre_ciudad").val();
            //alert("search_nombre_ciudad: "+search_nombre_ciudad);
            
            if(search_nombre_ciudad === '' || search_nombre_ciudad === null){
                $('#search_nombre_ciudad').css('border','1px solid #d9534f');
                $('#error_search_nombre_ciudad').show();
                $('#search_nombre_ciudad').val(""); //limpiar el input
                $("#search_nombre_ciudad").focus(); //fijar nuevamente el focus sobre el input            
                $('#loading-search-ciudad').hide();
            }else{
                $('#loading-search-ciudad').hide();
                $('#error_search_nombre_ciudad').hide();
                $("#search_nombre_ciudad").focus(); //fijar nuevamente el focus sobre el input
                $("#form_searchCiudad").submit();       
            }
        });
        
    }); 
</script>
</body>
</html>
