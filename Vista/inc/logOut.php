<script>
let btn_salir=document.querySelector(".btn-exit-system");

btn_salir.addEventListener('click', function(e){
    e.preventDefault();
	Swal.fire({
			title: 'Desea salir del sistema?',
			text: "La sesion se cerrara correctamente!",
			icon: 'question',
            timer: 50000,
            timerProgressBar:true,
			showCancelButton: true,
			confirmButtonColor: '#3085d6',
			cancelButtonColor: '#d33',
			confirmButtonText: 'Si, Salir!',
			cancelButtonText: 'No, cancelar'
		}).then((result) => {
			if (result.value) {
				let url='<?php echo SERVERURL; ?>ajax/loginAjax.php';
                let token='<?php echo $Lc->encryption($_SESSION['token_Ser']); ?>';
                let usuario='<?php echo $Lc->encryption($_SESSION['usuario_Ser']); ?>';

                let datos = new FormData();
                datos.append("token",token);
                datos.append("usuario",usuario);

                fetch(url,{
                    method: 'POST',
                    body: datos
                })
                .then(respuesta => respuesta.json())
                .then(respuesta => {
                    return alertas_ajax(respuesta);
                });

			}
		});
    });
</script>