
<div class="full-box page-header">
    <h3 class="text-center roboto-condensed-regular text-uppercase">
        <i class="fas fa-clipboard-list fa-fw" ></i> &nbsp; Lista de categorías
    </h3>
</div>


<div class="container-fluid">
					<ul class="full-box list-unstyled page-nav-tabs">
						<li>
							<a   href="<?php echo SERVERURL.DASHBOARD; ?>/categoria-new/"><i class="fas fa-plus fa-fw"></i> &nbsp; NUEVA CATEGORIA </a>
						</li>
						<li>
							<a class="active" href="<?php echo SERVERURL.DASHBOARD; ?>/categoria-list/"><i class="fas fa-clipboard-list fa-fw"></i> &nbsp; LISTA DE CATEGORIA </a>
						</li>
						<li>
							<a  href="<?php echo SERVERURL.DASHBOARD; ?>/categoria-search/"><i class="fas fa-search fa-fw"></i> &nbsp; BUSCAR CATEGORIA </a>
						</li>
					</ul>	
				</div>


<div class="container-fluid">
  
        <?php
            require_once "./Controladores/categoriacontrolador.php";
            $ins_categoria = new categoriaControlador();

            echo $ins_categoria->paginador_categoria_controlador($pagina[2],4,$pagina[1],"");
        ?>
    </div>
</div>