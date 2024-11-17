<?php 

$peticionAjax=true;
require_once "../config/APP.php";

 if(isset($_POST['usuario_cedula_reg']) || isset($_POST['usuario_id_del']) || isset($_POST['usuario_id_up'])){
    	/*----------  Ruta al Controlador ----------*/
require_once "../Controladores/usuarioControlador.php";
$ins_usuario = new usuarioControlador();


/*----------  agregar usuario ----------*/
if(isset($_POST['usuario_cedula_reg']) && isset($_POST['usuario_nombre_reg'])){
echo $ins_usuario->agregar_usuario_Controlador();
}

/*----------  eliminar usuario ----------*/
if(isset($_POST['usuario_id_del'])){
echo $ins_usuario->eliminar_usuario_controlador();
}

/*----------  actualizar usuario ----------*/
if(isset($_POST['usuario_id_up'])){
   echo $ins_usuario->actualizar_usuario_controlador();

}


 }else{
    session_start(['name'=>'Ser']);
    session_unset();
    session_destroy();
    header("Location:" .SERVERURL. "login/");
    exit();

 }