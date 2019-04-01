<?php require RUTA_APP . '/vistas/inc/header.php';
//print_r($datos);
?>
<table class="table">
    <thead>
        <tr>
            <th>Ciudad</th>
            <th>Nombre</th>
            <th>Abreviatura</th>
            <th>Pais</th>
            <th>Creado</th>
            <th>Actualizado</th>
            <th>Acciones</th>
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
                echo "<td>".$v['UPDATED']."</td>";
                echo "<td>";
                echo '<td><a href="'.RUTA_URL.'/ciudades/editar/'.$v['CIUDAD'].'">Editar</a></td>';
                echo '<td><a href="'.RUTA_URL.'/ciudades/borrar/'.$v['CIUDAD'].'">Borrar</a></td>';
            }
            
        ?>
    </tbody>
</table>
<?php require RUTA_APP . '/vistas/inc/footer.php'; ?>
