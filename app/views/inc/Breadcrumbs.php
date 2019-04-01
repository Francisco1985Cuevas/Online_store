<!-- Breadcrumbs-->
<ol class="breadcrumb">
    
    <li class="breadcrumb-item">
        <a href="#">Dashboard</a>
    </li>
    <!-- <li class="breadcrumb-item active">Overview</li> -->
    <?php
        if(!empty($datos['table'])){
            echo '<li class="breadcrumb-item ">'.$datos['table'].'</li>';
            echo '<li class="breadcrumb-item active">'.$datos['action'].'</li>';
        }
    ?>
</ol>


