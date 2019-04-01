<?php 
    require RUTA_APP . '/vistas/inc/header.php'; 
    // print_r($datos);
?>
<a href="<?php echo RUTA_URL; ?>/ciudades" class="btn btn-light"><i class="fa fa-backward"></i>Volver</a>
<div class="card card-body bg-light mt-5">
    <h2>Agregar ciudades</h2>
    <form action="<?php echo RUTA_URL; ?>/ciudades/agregar" method="POST">
        <div class="form-group">
            <label for="nombre">Nombre: <sup>*</sup></label>
            <input type="text" name="nombre" class="form-control form-control-lg">
        </div>
        <div class="form-group">
            <label for="pais">Pais</label>
            <select class="form-control" id="pais" name="pais">
                <?php
                    foreach($datos['paises'] as $k => $v){
                        echo "<option value='$v[pais]'>$v[nombre]</option>";
                    }
                ?>
            </select>
        </div>
        <div class="form-group">
            <label for="abreviatura">Abreviatura: <sup>*</sup></label>
            <input type="text" name="abreviatura" class="form-control form-control-lg">
        </div>
        <input type="submit" class="btn btn-success" value="Agregar Ciudad">
    </form>
</div>
<?php require RUTA_APP . '/vistas/inc/footer.php'; ?>
