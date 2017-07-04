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
        <!--[if lte IE 8]><script src="assets/js/ie/html5shiv.js"></script><![endif]-->
        <link rel="stylesheet" href="/css/main.css" />        
        <link rel="stylesheet" href="/css/sweetalert.css" />
        <!--[if lte IE 9]><link rel="stylesheet" href="assets/css/ie9.css" /><![endif]-->
        <!--[if lte IE 8]><link rel="stylesheet" href="assets/css/ie8.css" /><![endif]-->
    </head>
    <body>
        <!-- Page Wrapper -->
        <div id="page-wrapper">

            <!-- Header -->
            <header id="header">
                <h1><a href="/">Videollamadas</a></h1>
                <nav>
                    <a href="#menu">Menu</a>
                </nav>
            </header>

            <!-- Menu -->
            <nav id="menu">
                <div class="inner">
                    <h2>Menu</h2>
                    <ul class="links">
                        <li><a href="/">Inicio</a></li>
                        <li><a href="#" id="btn-registro">Registrarse</a></li>
                        <li><a href="/logout">Salir</a></li>
                        @yield("item-menu")
                    </ul>
                    <a href="#" class="close">Close</a>
                </div>
            </nav>
            @yield("contenido")
            @yield("footer")


        </div>

        <!-- Scripts -->
        <script src="/js/skel.min.js"></script>
        <script src="/js/jquery.min.js"></script>
        <script src="/js/jquery.scrollex.min.js"></script>
        <script src="/js/util.js"></script>
        <!--[if lte IE 8]><script src="assets/js/ie/respond.min.js"></script><![endif]-->
        <script src="/js/sweetalert-dev.js"></script>
        <script src="/js/main.js"></script>
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