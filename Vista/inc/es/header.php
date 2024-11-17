
	<!-- Header -->
	<header class="header full-box">
	    <div class="header-brand text-center full-box">
	 <a  > 
	      
	            <img  src="<?php echo SERVERURL; ?>Vista/assets/img/LOGO.jpg" alt="logo" class="img-fluid"></img>
	        </a>
	    </div>

	    <div class="header-options full-box">
	        <nav class="header-navbar full-box poppins-regular font-weight-bold" >
	            <ul class="list-unstyled full-box">

					<li>
						<a href="<?php echo SERVERURL;?>">Inicio<span class="full-box" ></span></a>
						</li>
                        <?php if(isset($_SESSION['privilegio_Ser']) && ($_SESSION['privilegio_Ser']==1 || $_SESSION['privilegio_Ser']==4)){ ?>
					<li>
					<a  href="<?php echo SERVERURL; ?>product/">Productos<span class="full-box" ></span></a>
	                </li>
                    <?php } ?>
					  <li>
	                    <a href="index.html" >Nosotros<span class="full-box" ></span></a>
	                </li>
                    <li>
	                    <a href="index.html" >Contacto<span class="full-box" ></span></a>
	                </li>



	                <?php if(!isset($_SESSION['privilegio_Ser'])){ ?>
                        <li>
                        <a href="<?php echo SERVERURL;?>signin/">Login<span class="full-box" ></span></a>
	                </li>

                    <?php } ?>
	            </ul>
	        </nav>
            
		        <?php if(isset($_SESSION['privilegio_Ser']) && ($_SESSION['privilegio_Ser']==1 || $_SESSION['privilegio_Ser']==4)){ ?>
            <div class="header-button full-box text-center" style="left:40%;" id="userMenu" data-mdb-toggle="dropdown" aria-haspopup="true" aria-expanded="false" title="<?php echo $_SESSION['nombre_Ser']; ?>" >
                <i class="fas fa-user-circle"></i>
                
            </div>
            <div class="dropdown-menu "  aria-labelledby="userMenu">
                <p class="text-center" style="padding-top: 10px;">
                
                    <i class="fas fa-user-circle fa-4x"></i><br>
                    <small><?php echo $_SESSION['nombre_Ser']; ?></small>
                    <small><?php echo $_SESSION['apellido_Ser']; ?></small>
                    
                </p>
             


				<div class="col-12 col-md-12">
                <?php if(isset($_SESSION['privilegio_Ser']) && ($_SESSION['privilegio_Ser']==1 )){ ?>
                    <?php include "./Vista/inc/".LANG."/admin.php";?>
                <?php } ?>




                <?php if(isset($_SESSION['privilegio_Ser']) && ($_SESSION['privilegio_Ser']==4 )){ ?>
                    <?php include "./Vista/inc/".LANG."/cliente.php";?>
                <?php } ?>
                
            </div>
			</div>




            <?php if(isset($_SESSION['privilegio_Ser']) && ($_SESSION['privilegio_Ser']==4 ) || $_SESSION['privilegio_Ser']==1){ ?>
            <?php include "./Vista/inc/".LANG."/carrito.php";?>
            <?php } ?>

      <?php } ?>
    
</header>