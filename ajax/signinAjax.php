<?php 

$peticionAjax=true;
require_once "../config/APP.php";

 if(isset($_POST['token']) && isset($_POST['email'])){

   require_once "../Controladores/signinControlador.php";
$ins_login = new signinControlador();

echo $ins_login->cerrar_sesion_cliente_controlador();

 }else{
    session_start(['name'=>'Ser']);
    session_unset();
    session_destroy();
    header("Location: ".SERVERURL."index/");
    exit();

 }