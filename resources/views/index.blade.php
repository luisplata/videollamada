@extends("plantilla.app")
@section('titulo', 'Inicio')
@section('contenido')
<!-- Banner -->
<section id="banner">
    <div class="inner">
        <div class="logo"><span class="icon fa-video-camera"></span></div>
        <h2>Nabu - Videollamada</h2>
        <p>Videollamadas incluidas en el navegador. Pruébalo <a target="_blank" href="https://videollamada.nabu.com.co/videollamada?sala=595d836068c92&nombre=anonimo">Aquí</a>.</p>
    </div>

</section>

@include("modal_login")
@endsection
@section("item-menu")
<li><a href="#" id="btn-open-modal">Ingresar</a></li>
@endsection