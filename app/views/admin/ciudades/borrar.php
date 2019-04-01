<?php require RUTA_APP . '/vistas/inc/header.php'; ?>

<a href="<?php echo RUTA_URL; ?>/ciudades" class="btn btn-light"><i class="fa fa-backward"></i>Volver</a>
<div class="card card-body bg-light mt-5">
    <h2>Borrar ciudad</h2>
    <form action="<?php echo RUTA_URL; ?>/ciudades/borrar/<?php echo $datos['ciudad']; ?>" method="POST">
        <div class="form-group">
            <label for="nombre">Nombre: <sup>*</sup></label>
            <input type="text" name="nombre" class="form-control form-control-lg" value="<?php echo $datos['nombre']; ?>">
        </div>
        <!--<div class="form-group">
            <label for="email">Nacionalidad: <sup>*</sup></label>
            <input type="text" name="nacionalidad" class="form-control form-control-lg" value="<?php echo $datos['nacionalidad']; ?>" >
        </div>-->
        <div class="form-group">
            <label for="abreviatura">Abreviatura: <sup>*</sup></label>
            <input type="text" name="abreviatura" class="form-control form-control-lg" value="<?php echo $datos['abreviatura']; ?>" >
        </div>
        
        <input type="submit" class="btn btn-success" value="Borrar Ciudad">
    </form>
</div>
<?php require RUTA_APP . '/vistas/inc/footer.php';