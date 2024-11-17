<script>
let btn_salir=document.querySelector(".btn-exit-web");

btn_salir.addEventListener('click', function(e){
    e.preventDefault();
	Swal.fire({
			title: 'Desea salir del sistema?',
			text: "La sesion se cerrara correctamente!",
			icon: 'question',
            timer: 5000,
            timerProgressBar:true,
			showCancelButton: true,
			confirmButtonColor: '#3085d6',
			cancelButtonColor: '#d33',
			confirmButtonText: 'Si, Salir!',
			cancelButtonText: 'No, cancelar'
		}).then((result) => {
			if (result.value) {
				let url='<?php echo SERVERURL; ?>ajax/signinAjax.php';
                let token='<?php echo $Lc->encryption($_SESSION['token_Ser']); ?>';
                let cliente='<?php echo $Lc->encryption($_SESSION['email_Ser']); ?>';

                let datos = new FormData();
                datos.append("token",token);
                datos.append("email",cliente);

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