@if (session('success'))
    <div id="alert" class="alert alert-success alert-dismissible d-flex align-items-center fade show">
        
        <i class="fa-solid fa-circle-check"></i>
        <!--Obtener mensaje desde la sesion-->
        <strong class="mx-2">Exito! </strong>{{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>

    <script>
        setTimeout(function() {
        //obtener el elemento por el id
        let alerta = document.getElementById('alert');

        if(alert){
            //quitar clase que permite ver la alerta
            alerta.classList.remove('show');
            //añadir animacion fade
            alerta.classList.remove('fade');

            setTimeout(() => alerta.remove(), 500);
        }

        }, 3000); //desaperecer despues de 3 segundos
    </script>
@endif