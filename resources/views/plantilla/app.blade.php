<!DOCTYPE HTML>
<!--
        Solid State by HTML5 UP
        html5up.net | @ajlkn
        Free for personal and commercial use under the CCA 3.0 license (html5up.net/license)
-->
<html>
    <head>
        <title>@yield("titulo", "Nabu")</title>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <meta name="application-name" content="Nabu - videollamadas" />
        <meta name="author" content="nabu.com.co" />
        <meta name="description" content="Servicio de Videollamadas en el navegador" />
        <meta name="keywords" content="Videollamada, videollamada navegador, servicio videollamada, servicio videollamada navegador" />
        <meta name="robots" content="index, follow" />
        <!--[if lte IE 8]><script src="{{asset('assets/js/ie/html5shiv.js')}}"></script><![endif]-->
        <link rel="stylesheet" href="{{asset('/css/main.css')}}" />        
        <link rel="stylesheet" href="{{asset('/css/sweetalert.css')}}" />
        <!--[if lte IE 9]><link rel="stylesheet" href="{{asset('assets/css/ie9.css')}}" /><![endif]-->
        <!--[if lte IE 8]><link rel="stylesheet" href="{{asset('assets/css/ie8.css')}}" /><![endif]-->
        @yield("css")
    </head>
    <body>
        <!-- Page Wrapper -->
        <div id="page-wrapper">

            <!-- Header -->
            <header id="header">
                <h1><a href="{{url('/')}}">Videollamadas</a></h1>
                <nav>
                    <a href="#menu">Menu</a>
                </nav>
            </header>

            <!-- Menu -->
            <nav id="menu">
                <div class="inner">
                    <h2>Menu</h2>
                    <ul class="links">
                        <li><a href="{{url('/')}}">Inicio</a></li>
                        <?php
                        if (!is_object(Session::get("empresa"))) {
                            ?>
                            <li><a href="#" id="btn-registro">Registrarse</a></li>
                            <?php
                        } else {
                            ?>
                            <li><a href="{{url('/logout')}}">Salir</a></li>
                            <?php
                        }
                        ?>
                        <li><a target="_blank" href="{{url('Documentacion/index.html')}}">Documentación</a></li>
                        @yield("item-menu")
                    </ul>
                    <a href="#" class="close">Close</a>
                </div>
            </nav>
            @yield("contenido")

            <!-- Footer -->
            <section id="footer">
                <div class="inner">
                    <ul class="copyright">
                        <li>&copy; <strong>Nabu</strong> Todos los derechos reservados.</li><li>Diseñado en: <a target="_blank" href="http://html5up.net">HTML5 UP</a></li>
                        <li> Version @include("plantilla.version")</li>
                    </ul>
                </div>
            </section>


        </div>

        <!-- Scripts -->
        <script src="{{asset('/js/skel.min.js')}}"></script>
        <script src="{{asset('/js/jquery.min.js')}}"></script>
        <script src="{{asset('/js/jquery.scrollex.min.js')}}"></script>
        <script src="{{asset('/js/util.js')}}"></script>
        <!--[if lte IE 8]><script src="{{asset('assets/js/ie/respond.min.js')}}"></script><![endif]-->
        <script src="{{asset('/js/sweetalert-dev.js')}}"></script>
        <script src="{{asset('/js/main.js')}}"></script>
        <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
        @yield("scripts")
        @include("modal_registro")
        <script>
window.onclick = function (event) {
    if (typeof cerrarModalRegistro === 'function') {
        //cerrarModalLogin
        cerrarModalRegistro(event);
    }
    if (typeof cerrarModalLogin === 'function') {
        cerrarModalLogin(event);
    }
    if (typeof cerrarModalSala === 'function') {
        cerrarModalSalaOut(event);
    }
}

var url_string = window.location;
var url = new URL(url_string);
var mensaje = url.searchParams.get("mensaje");
var tipo = url.searchParams.get("tipo");
var titulo = url.searchParams.get("titulo");
if (mensaje != null) {
    swal(titulo == null ? "" : titulo, mensaje, tipo == null ? "success" : "error");
}
        </script>
    </body>
</html>
