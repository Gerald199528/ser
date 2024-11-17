<?php

$peticionAjax=true;
require_once "../config/APP.php";

	if(isset($_POST['modulo_portada'])){

		/*--------- Instancia al controlador - Instance to controller ---------*/
		require_once "../Controladores/portadaControlador.php";
        $ins_portada = new portadaControlador();
        

    /*--------- Registrar portada Register product ---------*/
    if($_POST['modulo_portada']=="registro"){
        echo $ins_portada->registrar_portada_controlador();

    }
             /*--------- Eliminar portada- Delete product ---------*/
      if($_POST['modulo_portada']=="portada_eliminar"){
        echo $ins_portada->eliminar_portada_controlador();
    }
    
    /*--------- Actualizar portada de portada- Update product cover ---------*/
    if($_POST['modulo_portada']=="portada_actualizar"){
        echo $ins_portada->actualizar_portada_image_controlador();
    }

   /*--------- Eliminar imagen de portada - Delete product ---------*/
   if($_POST['modulo_portada']=="eliminar"){
    echo $ins_portada->eliminar_image_controlador();
}
   /*--------- Actualizar portada update product ---------*/
   if($_POST['modulo_portada']=="actualizar"){
    echo $ins_portada->actualizar_portada_controlador();
}
    
        
    }else{
        session_start(['name'=>'Ser']);
        session_unset();
        session_destroy();
        header("Location:" .SERVERURL. "login/");
        exit();
    
     }