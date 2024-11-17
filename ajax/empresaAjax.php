<?php

$peticionAjax=true;
require_once "../config/APP.php";

	if(isset($_POST['empresa_rif_reg']) || isset($_POST['empresa_id_up'])){

		/*--------- Instancia al controlador - Instance to controller ---------*/
		require_once "../Controladores/empresacontrolador.php";
        $ins_empresa = new empresaControlador();
        

        /*----------  agregar empresa ----------*/
if(isset($_POST['empresa_rif_reg'])){
	echo $ins_empresa->agregar_empresa_Controlador();
	}
		
	/*----------  Actualizar empresa ----------*/
if(isset($_POST['empresa_id_up']) && isset($_POST['empresa_rif_up'])){
	echo $ins_empresa->actualizar_empresa_controlador();
	
	}
 
	}else{
		session_start(['name'=>'Ser']);
		session_unset();
		session_destroy();
		header("Location:" .SERVERURL. "login/");
		exit();
	;
	}