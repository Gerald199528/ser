<?php

if($peticionAjax){
    require_once "../Modelo/carritoModelo.php";
}else{
    require_once "./Modelo/carritoModelo.php";

}
	class carritoControlador extends mainModelo{

    
        public function buscar_producto_Controlador(){

            /*-- Recibiendo datos del formulario - Receiving form data --*/
            $producto=mainModelo::limpiar_cadena($_POST['buscar_producto']);
        
         

         

            /*-- Comprobando campos vacios - Checking empty fields --*/
            if($producto==""){
                return '<div class="alert alert-warning" role="alert">
                <p class="text-center mb-0">
                    <i class="fas fa-exclamation-triangle fa-2x"></i><br>
                    Para realizar la busqueda debes introducir  Nombre o Codigo
                </p>
            </div>';
               exit(); 
            }

            /*  sleccionando productos en la bd*/
            $datos_producto=mainModelo::ejecutar_consulta_simple("SELECT * FROM producto WHERE (producto_codigo like '%$producto%'  OR producto_nombre like '%$producto%'  OR   producto_id like '%$producto%'  OR producto_portada like '%$producto%') AND  (producto_estado='Habilitado')   ORDER BY producto_nombre ASC ");
       
       
            if($datos_producto->rowCount()>=1){

                $datos_producto=$datos_producto->fetchALL();


                $tabla=' <div class="table-responsive"><table class="table table-hover table-bordered table-sm">
                    <tbody>';

                    foreach($datos_producto as $rows){
                        $tabla.='                       
                        <td class="card-producto-img">';
                                if(is_file("./Vista/assets/product/cover/".$rows['producto_portada'])){
                                    $tabla.='<img src="'.SERVERURL.'Vista/assets/product/cover/'.$rows['producto_portada'].'" class="img-fluid" />';
                                }else{
                                    $tabla.='<img src="'.SERVERURL.'Vista/assets/product/cover/'.$rows['producto_portada'].'"  />';
                             
                            
                        $tabla.= '
                        <td>Codigo:'.$rows['producto_codigo'].'  </div> </td>
                        <td >Nombre:'.$rows['producto_nombre'].' </td>
                        <td>
                            <button  type="button" class="btn btn-primary"  onclick="modal_agregar_producto('.$rows['producto_id'].')"  ><i class="fas fa-box-open"> </i></button>
                            </td>
                    </tr>';
                    }
                }
                    $tabla.='</tbody></table></div>  </td> ';
                    return  $tabla;
                 
        }else{

            return ' <div class="alert alert-warning" role="alert">
            <p class="text-center mb-0">
                <i class="fas fa-exclamation-triangle fa-2x"></i><br>
                No hemos encontrado ningún producto en el sistema que coincida con <strong>“'.$producto.'”</strong>
            </p>
        </div>';
           exit(); 

        }   
        
        
        
        }
        public function agregar_producto_Controlador(){
       /*-- Recibiendo datos del formulario - Receiving form data --*/
       $id=mainModelo::limpiar_cadena($_POST['id_agregar_producto']);


         /*  sleccionando productos en la bd*/
         $check_producto=mainModelo::ejecutar_consulta_simple("SELECT * FROM producto WHERE producto_id='$id' AND producto_estado='Habilitado' ");
       if($check_producto->rowCount()<=0){
        $alerta=[
            "Alerta" => "simple",
            "Titulo" =>"Ocurrio un error",
            "Texto" =>"No hemos podidos seleccionar el producto por favor intente nuevamente",
            "Icono"  =>"error"
        ];
        echo json_encode($alerta);
        exit();

       }else{

$campos=$check_producto->fetch();

       }
       $cantidad=mainModelo::limpiar_cadena($_POST['venta_cantidad']);
       $hora=mainModelo::limpiar_cadena($_POST['venta_hora']);
       $fecha=mainModelo::limpiar_cadena($_POST['venta_fecha']);
    

          /*-- Comprobando campos vacios - Checking empty fields --*/
          if($cantidad=="" || $hora=="" || $fecha=="" ){
            $alerta=[
                "Alerta"=>"simple",
                "Titulo"=>"Ocurrió un error inesperado",
                "Texto"=>"No has llenado todos los campos que son obligatorios",
                "Icono"=>"error"
                
            ];
            echo json_encode($alerta);
            exit();
        }
        
        session_start(['name'=>'Ser']);
        
  if(empty($_SESSION['datos_producto'][$id])){


    $_SESSION['datos_producto'][$id]=[
        "ID"=>$campos['producto_id'],        
        "Codigo"=>$campos['producto_codigo'],
        "Nombre"=>$campos['producto_nombre'],
        "Venta"=>$campos['producto_precio_venta'],
        "Disponibilidad"=>$campos['producto_disponibilidad'],
        "Descuento"=>$campos['producto_descuento'],
        "Marca"=>$campos['producto_marca'],
        "Tipo"=>$campos['producto_tipo'],
        "Categoria"=>$campos['categoria_id'],
        "Estado"=>$campos['producto_estado'],
        "Descripcion"=>$campos['producto_descripcion'],
        "Portada"=>$campos['producto_portada'],
      "Cantidad"=>$cantidad,
        "Fecha"=>$fecha,
        "Hora"=>$hora
       
       
          ];

          $alerta=[
            "Alerta" => "recargar",
            "Titulo" =>"Producto agregado en el carrito",
            "Texto" =>"El producto se agrego al carrito correctamente",
            "Icono"  =>"success"
            
        ];
        echo json_encode($alerta);
        exit();
        
    }else{
 
        $alerta=[
            "Alerta" => "simple",
            "Titulo" =>"Ocurrió un error inesperado",
            "Texto" =>"El producto no se a podido agregar o ya esta en cola",
            "Icono"  =>"error"
            
        ];
        echo json_encode($alerta);
        exit();

    }

      }  
      public function eliminar_producto_Controlador(){

          
            $id=mainModelo::limpiar_cadena($_POST['id_eliminar_producto']);

            session_start(['name'=>'Ser']);


            unset($_SESSION['datos_producto'][$id]);



            if(empty($_SESSION['datos_producto'][$id])){          




                $alerta=[
                    "Alerta" => "recargar",
                    "Titulo" =>"Producto eliminado correctamente del carrito",
                    "Texto" =>"El producto se elimino del carrito",
                    "Icono"  =>"success"
                    
                ];
                echo json_encode($alerta);
                exit();
                
            }else{
         
                $alerta=[
                    "Alerta" => "simple",
                    "Titulo" =>"Ocurrió un error inesperado",
                    "Texto" =>"El producto no se a podido eliminar del carrito ",
                    "Icono"  =>"error"
                    
                ];
                echo json_encode($alerta);
                exit();
        
            }

      }

        }
        
        



    