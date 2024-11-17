<?php

$peticionAjax=true;
require_once "../config/APP.php";

 if(isset($_POST['cliente_dni_reg'])  || isset($_POST['cliente_id_del'])){
    	/*----------  Ruta al Controlador ----------*/
require_once "../Controladores/clienteControlador.php";
$ins_cliente= new clienteControlador();


/*----------  agregar delyverys ----------*/
if(isset($_POST['cliente_dni_reg']) && isset($_POST['cliente_nombre_reg'])){
echo $ins_cliente->agregar_cliente_Controlador();
}
/*----------  ELIMINAR delyverys ----------*/
if(isset($_POST['cliente_id_del'])){
   echo $ins_cliente->eliminar_cliente_controlador();
   
   }
  
         

 }else{
    session_start(['name'=>'Ser']);
    session_unset();
    session_destroy();
    header("Location:" .SERVERURL. "login/");
    exit();

 }
