

<?php
    if(empty($pagina[1]) || $pagina[1]==""){
        $pagina[1]="all";
    }

    if(empty($pagina[3]) || $pagina[3]==""){
        $pagina[3]=1;
    }

    if(empty($pagina[2]) || $pagina[2]==""){
        $pagina[2]="ASC";
    }
?>
	<!-- Contenido -->
	<div class="banner">
	    <div class="banner-body">
	        <h3 class="text-uppercase">"HECHA UN VISTASO A SER EXQUISITECES"</h3>
	        <p>Disgustate con un rico  platillo que solo lo obtendras  en SER EXQUISITECES</p>
			
	        	    </div>
	</div>

	<div class="container container-web-page">
	    <h3 class="text-center text-uppercase poppins-regular font-weight-bold">Nuestros servicios</h3>
	    <br>
	    <div class="row">
	        <div class="col-12 col-sm-6 col-md-4">
	            <p class="text-center"><i class="fas fa-shipping-fast fa-5x"></i></p>
	            <h5 class="text-center text-uppercase poppins-regular font-weight-bold">Envíos a domicilio</h5>
	            <p class="text-center">Envìos A DOMICILIOS, a todas partes del estado</p>
	        </div>
	        <div class="col-12 col-sm-6 col-md-4">
	            <p class="text-center"><i class="fas fa-utensils fa-5x"></i></p>
	            <h5 class="text-center text-uppercase poppins-regular font-weight-bold">Ventas al por mayor</h5>
	            <p class="text-center">Puedes realizar pedidos al  mayor </p>
	        </div>
	        <div class="col-12 col-sm-6 col-md-4">
	            <p class="text-center"><i class="fas fa-store-alt fa-5x"></i></p>
	            <h5 class="text-center text-uppercase poppins-regular font-weight-bold">Servicios de Calidad</h5>
	            <p class="text-center">Ofrecemos Mejor calidad de pasteleria panadera y heladeria</p>
	        </div>
	    </div>
	</div>

	<hr>

	<div class="container-fluid container-web-page">
	    <h3 class="text-center text-uppercase poppins-regular font-weight-bold">Nuestros productos más populares</h3>
	    <div class="container-cards full-box">
		<?php
            if(isset($_SESSION['busqueda_tienda']) && !empty($_SESSION['busqueda_tienda'])){
        ?>
	
 
 <?php
    }else{
		$_SESSION['busqueda_tienda']="";
	}

 require_once "./Controladores/portadaControlador.php";
            $Lc = new portadaControlador();

            echo $Lc->cliente_paginador_image_controlador($pagina[3],4,$pagina[2],$pagina[2],$pagina[1],$_SESSION['busqueda_tienda']);
        ?>
 </div>
 </div>
		<?php if(isset($_SESSION['privilegio_Ser']) && ($_SESSION['privilegio_Ser']==1 || $_SESSION['privilegio_Ser']==4)){ ?>
	    <br>
	    <p class="text-center"><a href="menu.html" class="btn btn-raised btn-info btn-sm"><i class="fas fa-hamburger fa-fw"></i> &nbsp; Ir Productos</a></p>
	</div>
	   <?php } ?>
	   <?php if(!isset($_SESSION['privilegio_Ser'])){ ?>
	<hr>

	
	<div class="container container-web-page">
		
	    <div class="row justify-content-md-center">
			
	        <div class="col-12 col-md-6">
			
	            <figure class="full-box">
			
	                <img src="<?php echo SERVERURL; ?>Vista/assets/img/registration.png" alt="registration" class="img-fluid">
	            </figure>
	        </div>
	        <div class="w-100"></div>
	        <div class="col-12 col-md-6">
	            <h3 class="text-center text-uppercase poppins-regular font-weight-bold">Crea tu cuenta</h3>
	            <p class="text-justify">
	                Crea tu cuenta para poder realizar pedidos de platillos hasta la puesta de tu casa, es muy fácil y rápido.
	            </p>
	            <p class="text-center">
	                <a href="<?php echo SERVERURL; ?>registration/"  class="btn btn-raised btn-info btn-sm"><i class="far fa-paper-plane"></i> &nbsp; CREAR CUENTA</a>
				
				</div>
				
	    </div>
		
	</div>  
	<?php  } ?>