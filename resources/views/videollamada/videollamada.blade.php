
<!DOCTYPE html>
<html lang="es">
    <head>
        <title>Videollamada NABU</title>
       <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
       <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="author" content="Luis Enrique Plata Osorio (www.luisplata@gmail.com) - Tilson Navarro (fernandeztilson@gmail.com)" />
        <meta name="robots" content="noindex, nofollow" />
        <meta name="organization" content="NABU S.A.S." />
        <meta name="lang" content="es-ES" />
      <link rel="stylesheet" href="/css/main.css" /> 


      <!-- Bootstrap -->
    <link href="/css/bootstrap.min.css" rel="stylesheet"> 

    <link rel="stylesheet" href="/css/sweetalert.css" />

        <style>
        body{
            margin: 0;

        }
            /*.videoContainer {
                position: fixed;
                top: 0;
                right: 0;
                bottom: 0;
                left: 0;
                overflow: hidden;
              z-index: -100;
             }
            .videoContainer video {
                             position: absolute;
                top: 0;
                left: 0;
                width: 100%;
              height: 100%;
            }

            @media (min-aspect-ratio: 16/9) {
                .videoContainer video {
                  height: 300%;
                  top: -100%;
                }
              }

            @media (max-aspect-ratio: 16/9) {
                .videoContainer video {
                  width: 300%;
                  left: -100%;
                }
              }

            @media (max-width: 767px) {
              .fullscreen-bg {
                background: url('../img/videoframe.jpg') center center / cover no-repeat;
              }

              .fullscreen-bg__video {
                display: none;
              }
            }*/

            video{ position: fixed; top: 50%; left: 50%; min-width: 100%; min-height: 100%; width: auto; height: auto; z-index: -100; transform: translateX(-50%) translateY(-50%); background: url('images/poster.jpg') no-repeat; background-size: cover; transition: 1s opacity; } 


            .volume {
                position: absolute;
                left: 15%;
                width: 70%;
                bottom: 5px;
                height: 5px;
                display: none;
            }
            .connectionstate {
                position: absolute;
                top: 0px;
                width: 100%;
                text-align: center;
                color: #fff;
                /*background-color: rgba(0, 0, 0, 0.52);*/
                height: 30px;
                z-index: 80;
                
                padding-top: 5px;
            }

            #localScreenContainer {
                display: none;
            }

            #finalizar{
              margin-top:5px; 
              margin-left:80%;
              position: absolute;
              z-index: 100;
              width: 10%;
            }

            
            
            .btn-circle {
              width: 30px;
              height: 30px;
              text-align: center;
              padding: 6px 0;
              font-size: 12px;
              line-height: 1.42;
              border-radius: 15px;
            }
        </style>
    </head>
    <body>
        

        <!-- <h3 id="title">Comenzar una sala</h3>
        <form id="createRoom">
            <input id="sessionInput"/>
            <button disabled type="submit">Crear sala!</button>
        </form> -->
        <p id="subTitle"></p>
        <!-- <div>
          <button id="screenShareButton"></button>
          (https required for screensharing to work)
        </div> -->
       
       <div class="row" style="margin: 0;">
          <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" style="padding: 0;"> 
            <div class="videoContainer" style="display:none;">
                <video id="localVideo" style="height: 100%; width: 100%;" oncontextmenu="return false;"></video>
               <!--  <meter id="localVolume" class="volume" min="-45" max="-20" high="-25" low="-40"></meter> -->

            </div>
            <div id="localScreenContainer" class="videoContainer">
            </div>
            <div id="remotes">
                <button class="btn btn-danger btn-circle" id="finalizar"  title="Finalizar Videollamada"  onclick="desconectar()">
                  <i class="fa fa-phone"></i> 
                </button>
            </div>
          </div>
        
        </div>
        <!--<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js"></script>-->
        <script src="/js/jquery.min.js"></script>
        <script src="/js/videollamada/adapter-latest.js"></script>
        <script src="/js/videollamada/simplewebrtc.bundle.js"></script>
        <script src="/js/bootstrap.min.js"></script>
        <script src="/js/sweetalert-dev.js"></script>

        <script type="text/javascript">
           <?php echo  'var token="'.$token_empresa.'";'; ?> 
           <?php echo  'var nombre="'.$nombre.'";'; ?> 
           <?php echo  'var nombre_sala="'.$nombre_sala.'";'; ?> 
           //Se coloca el señalizador del .env
           <?php echo  'var signalmaster="'.env('APP_SIGNALMASTER').'";'; ?> 
        </script>

         <script src="/js/videollamada/funciones.js"></script>

         <script type="text/javascript">
         //hover mostrar botones
          $("#remotes").hover(function(){
              $("#finalizar").css("display", "block");

            }, function(){
              $("#finalizar").css("display", "none");

            
          });
      </script>
        
    </body>
</html>