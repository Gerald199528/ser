<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<title><?php echo COMPANY; ?></title>
	<link rel="icon" href="<?php echo SERVERURL ?>Vista/assets/img/betoven.jpg" >
	<!-- link -->
	  <?php include "./Vista/inc/css/link.php";?>


</head>
<body>
	<?php
    $peticionAjax=false;  
	session_start(['name'=>'Ser']);
	if(isset($_GET['views'])){
	$pagina=explode("/", $_GET['views']);
}else{
	$pagina=[];
}
	
        require_once "./Controladores/vistasControlador.php";
        $IV = new vistasControlador();

		require_once "./Controladores/loginControlador.php";
		$Lc = new loginControlador();

	
		
        if(isset($pagina[0]) && DASHBOARD==$pagina[0]){
        $Vista=$IV->obtener_vistas_controlador("dashboard",LANG);

        if($Vista=="login" || $Vista=="404"){
        require_once "./Vista/contenidos/".LANG."/web-".$Vista.".php";

        }else{
  

	if(!isset($_SESSION['token_Ser']) || !isset($_SESSION['usuario_Ser'])  || !isset($_SESSION['privilegio_Ser']) || !isset( $_SESSION['id_Ser'])){
		echo $Lc->forzar_cierre_sesion_controlador();
		exit();		
	}


?>

	
	<!-- Main container -->
	
	<main class="full-box main-container">

  <?php include "./Vista/inc/".LANG."/Navlateral.php";?>
		<!-- Nav lateral -->
	
		<!-- Page content -->
		<section class="full-box page-content">
		  <?php include "./Vista/inc/".LANG."/NavBar.php";  ?>
       <?php 
	   /*---------- Vista ----------*/
	   require_once $Vista;
   ?>

		
		</section>
	</main>
	<?php
    include "./Vista/inc/logOut.php";
	
}
}else{

	/*---------- Web ----------*/
	$Vista=$IV->obtener_vistas_controlador("web",LANG);

	if($Vista=="404"){
		require_once "./Vista/contenidos/".LANG."/web-404.php";
	}else{
		/*---------- Header ----------*/
		include "./Vista/inc/".LANG."/header.php";

		/*---------- Vista ----------*/
		require_once $Vista;

		/*---------- Footer ----------*/
		include "./Vista/inc/".LANG."/footer.php";


		if(isset($_SESSION['privilegio_Ser']) && ($_SESSION['privilegio_Ser']==1 || $_SESSION['privilegio_Ser']==4)){
			include "./Vista/inc/logOut.php";
			include "./Vista/inc/signinOut.php";
			
			
		}
	}
}

 include "./Vista/inc/js/js.php";
    ?>
</body>
</html>