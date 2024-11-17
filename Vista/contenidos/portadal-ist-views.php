<div class="full-box page-header">
    <h3 class="text-center roboto-condensed-regular text-uppercase">
        <i class="fas fa-boxes fa-fw"></i> &nbsp; Imagen de portada
    </h3>
</div>

<div class="container-fluid">
                        <ul class="full-box list-unstyled page-nav-tabs">
        <li class="nav-item" role="presentation">
            <a    href="<?php echo SERVERURL.DASHBOARD; ?>/portada/" ><i class="fas fa-plus fa-fw"></i> &nbsp; AGREGAR IMAGEN</a>
        </li>
        <li class="nav-item" role="presentation">
            <a  class="active" href="<?php echo SERVERURL.DASHBOARD; ?>/portadal-ist/" ><i class="fas fa-boxes fa-fw"></i> &nbsp;LISTA DE IMAGEN</a>
        </li>
     
       
    </ul>
</div>
<div class="container-fluid">
    <div class="full-box dashboard-container">
        <?php
            require_once "./Controladores/portadaControlador.php";
            $Lc = new  portadaControlador();

            echo $Lc->portada_paginador_controlador($pagina[2],4,$pagina[1],"");
        ?>
    </div>
</div>