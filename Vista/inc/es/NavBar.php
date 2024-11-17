 <nav class="full-box navbar-info">
                <a href="#" class="float-left show-nav-lateral">
                    <i class="fas fa-exchange-alt"></i>
                </a>
                <a href="<?php echo SERVERURL;?>" title="Ir pagina" >
        <i class="fas fa-home"></i>
    </a>
                <?php if( $_SESSION['privilegio_Ser']==1){ ?>
                <a href="<?php echo  SERVERURL.DASHBOARD.'/admin-update/'.$Lc->encryption( $_SESSION['id_Ser'])."/"; ?> " title="Actualizar" >
                    <i class="fas fa-user-cog"></i>
                    <?php  } ?>
                </a>
                
                <a href="#" class="btn-exit-system"  title="Salir del sistema" >
                    <i class="fa-solid fa-arrow-right-from-bracket"></i>
                </a>
            </nav>