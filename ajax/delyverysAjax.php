<?php 

$peticionAjax=true;
require_once "../config/APP.php";

 if(isset($_POST['codigo_reg']) || isset($_POST['codigo_del']) || isset($_POST['id_up'])){
    	/*----------  Ruta al Controlador ----------*/
require_once "../Controladores/delyverysControlador.php";
$ins_delyverys= new delyverysControlador();


/*----------  agregar delyverys ----------*/
if(isset($_POST['codigo_reg']) && isset($_POST['nombre_reg'])){
echo $ins_delyverys->agregar_delyverys_Controlador();
}
/*----------  ELIMINAR delyverys ----------*/
if(isset($_POST['codigo_del'])){
echo $ins_delyverys->eliminar_delyverys_controlador();

}
/*----------  Actualizar delyverys ----------*/
if(isset($_POST['id_up'])){
   echo $ins_delyverys->actualizar_delyverys_controlador();
   
   }

 }else{
    session_start(['name'=>'Ser']);
    session_unset();
    session_destroy();
    header("Location:" .SERVERURL. "login/");
    exit();

 }