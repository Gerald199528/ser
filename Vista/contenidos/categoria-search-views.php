
<div class="full-box page-header">
    <h3 class="text-center roboto-condensed-regular text-uppercase">
        <i class="fas fa-search fa-fw"></i> &nbsp; Buscar categoría
    </h3>
</div>

<div class="container-fluid">
					<ul class="full-box list-unstyled page-nav-tabs">
						<li>
							<a  href="<?php echo SERVERURL.DASHBOARD; ?>/categoria-new/"><i class="fas fa-plus fa-fw"></i> &nbsp; NUEVA CATEGORIA </a>
						</li>
						<li>
							<a  href="<?php echo SERVERURL.DASHBOARD; ?>/categoria-list/"><i class="fas fa-clipboard-list fa-fw"></i> &nbsp; LISTA DE CATEGORIA </a>
						</li>
						<li>
							<a  class="active"  href="<?php echo SERVERURL.DASHBOARD; ?>/categoria-search/"><i class="fas fa-search fa-fw"></i> &nbsp; BUSCAR CATEGORIA </a>
						</li>
					</ul>	
				</div>


<div class="container-fluid">
    <?php
        if(!isset($_SESSION['busqueda_categoria']) && empty($_SESSION['busqueda_categoria'])){
    ?>
    <form class="FormularioAjax" action="<?php echo SERVERURL; ?>ajax/buscadorAjax.php" data-form="default"" method="POST" autocomplete="off" style="padding-top: 40px">
        <input type="hidden" name="modulo" value="categoria">
        <div class="container-fluid">
            <div class="row d-flex justify-content-center">
            <div class="col-12 col-md-6">
									<div class="form-group">
                        <input type="text" pattern="[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ ]{1,30}" class="form-control" name="busqueda_inicial" id="busqueda_inicial" maxlength="30">
                        <label for="busqueda_inicial" class="form-label">¿Qué categoría estás buscando?</label>
                    </div>
                    <p class="text-center">
                    <button type="submit" class="btn btn-raised btn-info"><i class="fas fa-search"></i> &nbsp;Buscar</button>
                    </p>
                </div>
            </div>
        </div>
    </form>
    <?php }else{ ?>
    <div class="dashboard-container mb-4">
        <form class="mb-4 FormularioAjax" action="<?php echo SERVERURL; ?>ajax/buscadorAjax.php" data-form="search"  method="POST">
            <input type="hidden" name="modulo" value="categoria">
            <input type="hidden" name="eliminar_busqueda" value="eliminar">
            <p class="lead text-center roboto-condensed-regular">Resultados de la búsqueda <span class="font-weight-bold">“<?php echo $_SESSION['busqueda_categoria']; ?>”</span></p>
            <p class="text-center">
            <button type="submit" class="btn btn-raised btn-danger"><i class="far fa-trash-alt"></i> &nbsp; Eliminar búsqueda</button>
            </p>
        </form>

        <?php
            require_once "./controladores/categoriaControlador.php";
            $ins_categoria = new categoriaControlador();

            echo $ins_categoria->paginador_categoria_controlador($pagina[1],4,$pagina[1],$_SESSION['busqueda_categoria']);
        ?>
    </div>
    <?php } ?>
</div>