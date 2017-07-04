@extends("plantilla.app")
@section("contenido")
<section id="wrapper">
    <header>
        <div class="inner">
            <h2>Token Privado</h2>
            <code id="token">
                {{Session::get("empresa")->token}}
            </code>
            <button id="botonCopiar">Copiar</button><br/>
            <a class="button" href="obtener/token">Obtener uno nuevo</a>
        </div>
    </header>

    <!-- Content -->
    <div class="wrapper">
        <div class="inner">
        </div>
    </div>
    <script>
        var boton = document.querySelector('#botonCopiar');

        boton.addEventListener('click', function (event) {
            // seleccionar el texto de la dirección de email
            var token = document.querySelector('#token');
            var range = document.createRange();
            range.selectNode(token);
            window.getSelection().addRange(range);

            try {
                // intentar copiar el contenido seleccionado
                var resultado = document.execCommand('copy');
                console.log(resultado ? 'Email copiado' : 'No se pudo copiar el email');
                if(resultado){
                    swal("Token copiado en su portapapeles");
                }
            } catch (err) {
                swal("Error","Error al copiarlo en su portapapeles","error");
            }

            // eliminar el texto seleccionado
            window.getSelection().removeAllRanges();
            // cuando los navegadores lo soporten, habría
            // que utilizar: removeRange(range)
        });
    </script>
</section>
@endsection