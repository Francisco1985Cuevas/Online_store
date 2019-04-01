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
                        <a href="<?php echo RUTA_URL; ?>/paises/agregar" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
                            <i class="fas fa-plus fa-sm text-white-50"></i> 
                            Nuevo Registro
                        </a>
                    </div>
                    <?php
                        require BREADCRUMBS;
                    ?>
                    
                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Listado de <?php echo $datos['table']; ?></h6>
                        </div>
                        <div class="card-body">
                            <?php
                                
                                if(is_array($datos['paises']) && count($datos['paises']) > 0){
                                    ?>
                                    <!--
                                    <div class="table-responsive">
                                        <table class="table table-bordered" id="dataTable-inicio-pais" width="100%" cellspacing="0">
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
                                            <tfoot>
                                                <tr>
                                                    <th>ID</th>
                                                    <th>Nombre</th>
                                                    <th>Nacionalidad</th>
                                                    <th>Abreviatura</th>
                                                    <th>Creado</th>
                                                    <th class="text-center">Operaci&oacute;n</th>
                                                </tr>
                                            </tfoot>
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
                                                        //echo "<td>".$v['UPDATED']."</td>";
                                                        echo "<td>
                                                            <a class='btn btn-success btn-circle btn-sm' href='".RUTA_URL."/paises/editar/".$v['PAIS']."' title='Actualizar'> 
                                                                <i class='fas fa-edit'></i>
                                                            </a>
                                                            <a class='btn btn-danger btn-circle btn-sm' href='".RUTA_URL."/paises/borrar/".$v['PAIS']."' title='Borrar'> 
                                                                <i class='fas fa-trash'></i>
                                                            </a>
                                                            </td>";
                                                        echo "</tr>";
                                                    }
                                                ?>                      
                                            </tbody>
                                        </table>
                                    </div>
                                    -->
                                    <?php
								}else{
                                    ?>
                                    <!-- Default Card Example -->
                                    <div class="card mb-4">
                                        <div class="card-header">
                                            Default Card Example
                                        </div>
                                        <div class="card-body">
                                            <div class="alert alert-warning">
                                                <i class="fas fa-exclamation-triangle"></i>
                                                No hay Paises Guardados.
                                            </div>
                                            <br>
                                            <div class="card-body d-flex">
                                                <a href="<?php echo RUTA_URL; ?>/paises/agregar" class="btn btn-primary btn-icon-split">
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
                            <!-- Updated yesterday at 11:59 PM -->
                            <!-- &Uacute;ltima actualizaci&oacute;n, <?php echo $datos['last_updated']; ?> -->
                            <?php
                                if(empty($datos['last_updated'])){
                                    echo '';
                                }else{
                                    echo "&Uacute;ltima actualizaci&oacute;n, $datos[last_updated]";
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
    /*    
    $(document).ready(function() {
        $('#dataTables-pais').DataTable({
            responsive: true,
            "language": {"url": "<?php /*echo RUTA_URL*/?>/js/spanish.json"}
        });
    });
    */
    
    // Call the dataTables jQuery plugin
    $(document).ready(function() {
        $('#dataTable-inicio-pais').DataTable();
    });
</script>
</body>
</html>
