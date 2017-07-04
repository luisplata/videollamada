@extends("plantilla.app")
@section('titulo', 'Inicio')
@section('contenido')
<!-- Banner -->
<section id="banner">
    <div class="inner">
        <div class="logo"><span class="icon fa-video-camera"></span></div>
        <h2>Nabu - Videollamada</h2>
        <p>Videollamadas incluidas en el navegador. Pruebalo <a target="_blank" href="https://demo.nabu.com.co?prueba">Aqui</a>.</p>
    </div>

</section>


@endsection
@section("item-menu")
<li><a href="#" id="btn-open-modal">Ingresar</a></li>
@endsection


@section("footer")

<!-- Footer -->
<section id="footer">
    <div class="inner">
        <ul class="copyright">
            <li>&copy; <strong>Nabu</strong> Todos los derechos reservados.</li><li>Diseñado en: <a target="_blank" href="http://html5up.net">HTML5 UP</a></li>
        </ul>
    </div>
</section>
@include("modal_login")
@endsection
