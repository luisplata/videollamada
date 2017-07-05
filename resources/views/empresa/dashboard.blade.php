@extends("plantilla.app")
@section("css")
    
@endsection
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
            <h2>Sala</h2>
             <code id="sala">
                {{Session::get("sala")}}
            </code><br/>
            <!-- <p>Para entrar a la sala se debe agregar <code>&nombre=NOMBRE_USUARIO</code> al final de la ruta.</p> -->
           
           <button id="botonCopiarSala">Copiar</button>
            <a class="button" id="crear_sala">Crear una sala</a>
        </div>
    </div>
    <script>
        var boton = document.querySelector('#botonCopiar');
         var botonSala = document.querySelector('#botonCopiarSala');

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

        botonSala.addEventListener('click', function (event) {
            // seleccionar el texto de la dirección de email
            var token = document.querySelector('#sala');
            var range = document.createRange();
            range.selectNode(sala);
            window.getSelection().addRange(range);

            try {
                // intentar copiar el contenido seleccionado
                var resultado = document.execCommand('copy');
                console.log(resultado ? 'Ruta Sala copiado' : 'No se pudo copiar ruta sala');
                if(resultado){
                    swal("Ruta Sala copiado en su portapapeles");
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
@section("scripts")
   

   @include("empresa.modal_registro_sala")
@endsection

