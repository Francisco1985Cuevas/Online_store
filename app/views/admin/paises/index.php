<?php
    //index Paises
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
                        <a href="<?php echo RUTA_URL; ?>/paises/create" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
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
                                            <!-- Search Pais -->
                                            <form role="form" id="form_searchPais" action="<?php echo RUTA_URL; ?>/paises/search" method="POST">
                                                <div class="input-group">
                                                    <input id="search_nombre_pais" name="search_nombre_pais" type="text" class="form-control bg-light border-0 small" placeholder="Buscar..." aria-label="Search" aria-describedby="basic-addon2">
                                                    <div class="input-group-append">
                                                        <button id="btn_searchPais" class="btn btn-primary" type="button">
                                                            <i class="fas fa-search fa-sm"></i>
                                                        </button>
                                                    </div>
                                                </div>
                                                <br>
                                                <img id="loading-search-pais" src="<?php echo IMAGES; ?>/ajax-loader.gif" />
                                                <p id="error_search_nombre_pais" class="text-danger" >El campo Nombre es Obligatorio para iniciar la busqueda.</p>
                                            </form>
                                            <?php
                                                if(!empty($datos['search'])){
                                                    if(is_array($datos['pais_search']) && count($datos['pais_search']) > 0 ){
                                                        ?>
                                                        <!-- Pais results table -->
                                                        <br>
                                                        <table class="table table-bordered" id="dataTable-search-pais" width="100%" cellspacing="0">
                                                            <thead>
                                                                <tr>
                                                                    <th>ID</th>
                                                                    <th>Nombre</th>
                                                                    <th>Nacionalidad</th>
                                                                    <th>Abreviatura</th>
                                                                    <th>Creado</th>
                                                                    <th class="text-center">Operaci&oacute;n</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <?php
                                                                    foreach($datos['pais_search'] as $k => $v){
                                                                        echo "<tr>";
                                                                        echo "<td>".$v['PAIS']."</td>";
                                                                        echo "<td>".$v['NOMBRE']."</td>";
                                                                        echo "<td>".$v['NACIONALIDAD']."</td>";
                                                                        echo "<td>".$v['ABREVIATURA']."</td>";
                                                                        echo "<td>".$v['CREATED']."</td>";
                                                                        echo "<td>";
                                                                        echo "<a class='btn btn-success btn-circle btn-sm' href='".RUTA_URL."/paises/edit/".$v['PAIS']."' title='Actualizar'> 
                                                                                <i class='fas fa-edit'></i>
                                                                            </a>";
                                                                        echo "<a class='btn btn-danger btn-circle btn-sm' href='".RUTA_URL."/paises/borrar/".$v['PAIS']."' title='Borrar'> 
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
                    
                    <!-- DataTale List Paises -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <!-- <h6 class="m-0 font-weight-bold text-primary"><i class="fas fa-list"></i> Listado de <?php echo $datos['table']; ?></h6> -->
                            <h6 class="m-0 font-weight-bold text-primary"><i class="fas fa-list"></i> <?php echo $datos['title']; ?></h6>
                        </div>
                        <div class="card-body">
                            <?php
                                if(is_array($datos['paises']) && count($datos['paises']) > 0){
                                    ?>
                                    <div class="table-responsive">
                                        <table class="table table-bordered" id="dataTable-list-pais" width="100%" cellspacing="0">
                                            <thead>
                                                <tr>
                                                    <th>ID</th>
                                                    <th>Nombre</th>
                                                    <th>Nacionalidad</th>
                                                    <th>Abreviatura</th>
                                                    <th>Creado</th>
                                                    <th class="text-center">Operaci&oacute;n</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                    foreach($datos['paises'] as $k => $v){
                                                        //echo "k: ".$k." v: ".$v;
                                                        echo "<tr>";
                                                        echo "<td>".$v['PAIS']."</td>";
                                                        echo "<td>".$v['NOMBRE']."</td>";
                                                        echo "<td>".$v['NACIONALIDAD']."</td>";
                                                        echo "<td>".$v['ABREVIATURA']."</td>";
                                                        echo "<td>".$v['CREATED']."</td>";
                                                        echo "<td>";
                                                        echo "<a class='btn btn-success btn-circle btn-sm' href='".RUTA_URL."/paises/edit/".$v['PAIS']."' title='Actualizar'> 
                                                                <i class='fas fa-edit'></i>
                                                            </a>";
                                                        echo "<a class='btn btn-danger btn-circle btn-sm' href='".RUTA_URL."/paises/borrar/".$v['PAIS']."' title='Borrar'> 
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
                                    <div class="card mb-4">
                                        <div class="card-header">
                                            <i class="fas fa-list"></i> <?php echo $datos['title']; ?>
                                        </div>
                                        <div class="card-body">
                                            <div class="alert alert-info">
                                                <i class="fas fa-info-circle"></i>
                                                No se registran <?php echo $datos['table']; ?> Guardados.
                                            </div>
                                            <div class="card-body d-flex">
                                                <a href="<?php echo RUTA_URL; ?>/paises/create" class="btn btn-primary btn-icon-split">
                                                    <span class="icon text-white-50">
                                                        <i class="fas fa-plus"></i>
                                                    </span>
                                                    <span class="text">Nuevo Registro</span>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
									<?php
								}
                            ?>
                        </div>
                        <div class="card-footer small text-muted">
                            <?php
                                //echo "&Uacute;ltima actualizaci&oacute;n, $datos[last_pais_updated]";
                                if(!empty($datos['last_pais_updated'])){
                                    echo "&Uacute;ltima actualizaci&oacute;n, $datos[last_pais_updated]";
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
    
    <!-- Borrar Modal -->
    <!-- <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Confirmar Borrado</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    Realmente esta seguro de que desea eliminar este Registro?
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancelar</button>
                    <a class="btn btn-primary" href="<?php /*echo RUTA_URL.'/paises/borrar/'.$v['PAIS'];*/ ?>" >Aceptar</a>
                </div>
            </div>
        </div>
    </div> -->
<?php 
    require FOOTER;
?>
<script>
    // Script Javascript, JQuery
    $(document).ready(function() {
        //ocultar inicialmente la etiqueta <p> que muestra los errores y el <img> de espera
        $('#loading-search-pais').hide();
        $('#error_search_nombre_pais').hide();
        
        // Call the dataTables jQuery plugin
        $('#dataTable-list-pais').DataTable({
            "scrollY":        "300px",
            "scrollCollapse": true,
            responsive: true,
            "language": {"url": "<?php echo RUTA_URL; ?>/public/js/spanish.json"}
        } );
        
        // validacion del evento: onclick() del form de busqueda de pais por nombre
		$("#btn_searchPais").on("click", function(){
            var search_nombre_pais;
            //Mostrar el lodading de espera mientras dure el proceso de insert
            $('#loading-search-pais').show();
        
			// El usuario hizo click en el boton guardar...
			search_nombre_pais = $("#search_nombre_pais").val();
            //alert("nombre: "+search_nombre_pais);    
            
            if(search_nombre_pais === '' || search_nombre_pais === null){
                $('#search_nombre_pais').css('border','1px solid #d9534f');
                $('#error_search_nombre_pais').show();
                $('#search_nombre_pais').val(""); //limpiar el input
				$("#search_nombre_pais").focus(); //fijar nuevamente el focus sobre el input
                $('#loading-search-pais').hide();
            }else{
                $('#loading-search-pais').hide();
                $('#error_search_nombre_pais').hide();
                $("#search_nombre_pais").focus(); //fijar nuevamente el focus sobre el input
                $("#form_searchPais").submit();
            }
        });
        
    });
</script>
</body>
</html>
