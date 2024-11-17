<script> 


function buscar_producto(){
let input_producto=document.querySelector('#input_producto').value;

input_producto=input_producto.trim();


if(input_producto!=""){
    let datos = new FormData();
    datos.append("buscar_producto",input_producto);

    fetch("<?php echo SERVERURL; ?>ajax/carritoAjax.php",{
        method: 'POST',
        body:datos

    })
      .then(respuesta => respuesta.text())
      .then(respuesta => {
        let tabla_producto=document.querySelector('#tabla_productos');
        tabla_producto.innerHTML=respuesta;
      });
     

}else{
      Swal.fire({
    title: 'Ocurrio un error ',
    text: 'Para realizar la busqueda debes introducir  Nombre o Codigo del producto',
   icon: 'error',
    confirmButtonText: 'Aceptar'

    });

}
}
function modal_agregar_producto(id){
$('#ModalItem').modal('hide');
$('#ModalAgregarItem').modal('show');
document.querySelector('#id_agregar_producto').setAttribute("value",id);


}


function modal_cancel_producto(){
  $('#ModalAgregarItem').modal('hide');
  $('#ModalItem').modal('hide');

}
function modal_agregarr_producto(id){

$('#ModalAgregarItem').modal('show');
document.querySelector('#id_agregar_producto').setAttribute("value",id);


}


</script>