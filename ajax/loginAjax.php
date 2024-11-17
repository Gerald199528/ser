<?php 

$peticionAjax=true;
require_once "../config/APP.php";

 if(isset($_POST['token']) && isset($_POST['usuario'])){

   require_once "../Controladores/loginControlador.php";
$ins_login = new loginControlador();

echo $ins_login->cerrar_sesion_usuario_controlador();

 }else{
    session_start(['name'=>'Ser']);
    session_unset();
    session_destroy();
    header("Location: ".SERVERURL.DASHBOARD);
    exit();

 }