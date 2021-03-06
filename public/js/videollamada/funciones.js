
// grab the room from the URL
var room = location.search && location.search.split("&")[0].replace("?","");
//alert(room);

if(room == ""){swal("Error", "Error en nombre de sala", "error" );}

//nickname
var nick = location.search && location.search.split("&")[1].replace("nombre=","");
if(nick == ""){swal("Error", "Error en nombre de usuario", "error" );}
//alert(nick);

//duracion de llamada
var duracion_llamada = 0;
var intervalo_llamada;

// create our webrtc connection
var webrtc = new SimpleWebRTC({
    // the id/element dom element that will hold "our" video
    localVideoEl: 'localVideo',
    // the id/element dom element that will hold remote videos
    remoteVideosEl: '',
    // immediately ask for camera access
    autoRequestMedia: true,
    debug: true,
    detectSpeakingEvents: true,
    autoAdjustMic: false,

    nick: nick,
    //url: signalmaster
});

console.log(webrtc);



// when it's ready, join if we got a room from the URL
webrtc.on('readyToCall', function () {

        
        // you can name it anything
        if (room){ 
            //if(obtener_numero_de_usuarios(webrtc) == 2){
              //  console.log("Sala llena =(");
                
                

            //}else{
                webrtc.joinRoom(room);
               console.log("Entrando al room");
               intervalo_llamada = setInterval(function(){ tiempo_llamada() }, 1000);
            //}
            
        }else{
            mensaje_log("No se pudo entrar a la videollamada", nick);
            swal("Error", "No se pudo entrar a la videollamada", "error" );
        }

    
});


webrtc.on('createdPeer', function (peer){
    console.log("createdPeer");
    console.log(peer);
    //console.log(obtener_numero_de_usuarios(webrtc));

    // if(obtener_numero_de_usuarios(webrtc) == 2){
      
    //     console.log("Sala llena =(");
    //     swal("Error", "No se pudo entrar a la videollamada", "error" );
        

    // }
});

function showVolume(el, volume) {
    if (!el) return;
    if (volume < -45) volume = -45; // -45 to -20 is
    if (volume > -20) volume = -20; // a good range
    el.value = volume;
}

// we got access to the camera
webrtc.on('localStream', function (stream) {
    /*var button = document.querySelector('form>button');
    if (button) button.removeAttribute('disabled');
    $('#localVolume').show();*/
    console.log("Se accedio a la camara.");
});
// we did not get access to the camera
webrtc.on('localMediaError', function (err) {
    console.log(err);
    console.log("No se accedio a la camara.");
    mensaje_log("No se pudo acceder a la camara", nick);
    swal("Error", "No se pudo acceder a la camara", "error" );
});

// local screen obtained
webrtc.on('localScreenAdded', function (video) {
    console.log("local screen obtained");
    video.onclick = function () {
        //video.style.width = video.videoWidth + 'px';
        //video.style.height = video.videoHeight + 'px';

        video.style.width = '100%';
        video.style.height = '100%';
    };
    document.getElementById('localScreenContainer').appendChild(video);
    $('#localScreenContainer').show();
});
// local screen removed
webrtc.on('localScreenRemoved', function (video) {
    console.log("local screen removed");
    document.getElementById('localScreenContainer').removeChild(video);
    $('#localScreenContainer').hide();

    //cerrar ventana actual
    window.close();

});

// a peer video has been added
webrtc.on('videoAdded', function (video, peer) {
    console.log('video added', peer);
    console.log('Nickname', peer.nick);
    console.log(webrtc);
    mensaje_log("Se agrego un nuevo peer", nick);
    //console.log(obtener_numero_de_usuarios(webrtc));//numero de pares conectados


    /*if(obtener_numero_de_usuarios(webrtc) == 2){
       

        console.log('PEER ', peer);
        console.log("se elimino peer que intento entrar a la sala llena");
        


        
            


        peer.end();

    }else{*/

        var remotes = document.getElementById('remotes');
        if (remotes) {
            var container = document.createElement('div');
            //container.className = 'videoContainer col-md-6';
            if(obtener_numero_de_usuarios(webrtc) >= 2){
                container.className = ' col-md-4 abajo';
                container.id = 'container_' + webrtc.getDomId(peer);
                container.appendChild(video);
                video.className = 'video2 col-md-12';
            }else{
                container.className = ''; 
                container.id = 'container_' + webrtc.getDomId(peer);
                container.appendChild(video);   
                video.className = 'video1 col-md-12';           
            }
           

            // suppress contextmenu
            video.oncontextmenu = function () { return false; };

            // resize the video on click
            video.onclick = function () {
                //container.style.width = video.videoWidth + 'px';
                //container.style.height = video.videoHeight + 'px';
                /*if(container.style.width == '100%'){
                    container.style.width = '50%';
                    container.style.height = '50%';
                }else{
                    container.style.width = '100%';
                    container.style.height = '100%';
                }*/

                if(container.className == ''){
                    container.className = ' col-md-4 abajo';
                    container.id = 'container_' + webrtc.getDomId(peer);
                    container.appendChild(video);
                    video.className = 'video2 col-md-12';
                }else{
                    container.className = ''; 
                    container.id = 'container_' + webrtc.getDomId(peer);
                    container.appendChild(video);   
                    video.className = 'video1 col-md-12';           
                }
                
            };

            // show the remote volume
            /*var vol = document.createElement('meter');
            vol.id = 'volume_' + peer.id;
            vol.className = 'volume';
            vol.min = -45;
            vol.max = -20;
            vol.low = -40;
            vol.high = -25;
            container.appendChild(vol);*/

            // show the ice connection state
            if (peer && peer.pc) {
                var connstate = document.createElement('div');
                connstate.className = 'connectionstate';
                container.appendChild(connstate);
                peer.pc.on('iceConnectionStateChange', function (event) {
                    switch (peer.pc.iceConnectionState) {
                        case 'checking':
                            connstate.innerText = 'Conectando';
                            console.log('Conectando');
                            mensaje_log("Conectando", nick);
                            break;
                        case 'connected':
                        case 'completed': // on caller side
                            //$(vol).show();
                            connstate.innerText = 'Conectado '+peer.nick;
                            console.log('Conectado '+peer.nick);
                            mensaje_log("Conectado", nick);
                            


                            break;
                        case 'disconnected':
                            connstate.innerText = 'Desconectado.';
                            console.log('Desconectado');
                            mensaje_log("Desconectado", nick);
                            break;
                        case 'failed':
                            detener_tiempo();
                            connstate.innerText = 'Falló.';
                            console.log('Falló');
                            mensaje_log("Falló", nick);
                            swal("Error", "Videollamada Falló, intente nuevamente", "error" );

                            break;
                        case 'closed':
                            detener_tiempo();
                            connstate.innerText = 'Cerrada.';
                            console.log('Cerrada');
                            mensaje_log("Cerrada", nick);
                            break;
                    }
                });
            }
            remotes.appendChild(container);

        }

    //}


    
    
});
// a peer was removed
webrtc.on('videoRemoved', function (video, peer) {
    console.log('video removed ', peer);
    var remotes = document.getElementById('remotes');
    var el = document.getElementById(peer ? 'container_' + webrtc.getDomId(peer) : 'localScreenContainer');
    if (remotes && el) {
        remotes.removeChild(el);
    }

    console.log(peer.closed);
    if(peer.closed == true && peer.parent.peers.length == 0){
        //videollamada finalizada

        console.log(peer.nick);

        console.log(peer.parent._log());

         detener_tiempo();
         mensaje_log(peer.nick+" ha finalizado la llamada", nick);
        swal("Info", peer.nick+" ha finalizado la llamada", "success" );

        //cerrar ventana actual
        window.close();
    }


});

// local volume has changed
webrtc.on('volumeChange', function (volume, treshold) {
    showVolume(document.getElementById('localVolume'), volume);
});
// remote volume has changed
webrtc.on('remoteVolumeChange', function (peer, volume) {
    showVolume(document.getElementById('volume_' + peer.id), volume);
});

// local p2p/ice failure
webrtc.on('iceFailed', function (peer) {

    var pc = peer.pc;
    console.log('had local relay candidate', pc.hadLocalRelayCandidate);
    console.log('had remote relay candidate', pc.hadRemoteRelayCandidate);

    var connstate = document.querySelector('#container_' + webrtc.getDomId(peer) + ' .connectionstate');
    console.log('local fail', connstate);
    mensaje_log(connstate, nick);
    if (connstate) {
        connstate.innerText = 'Falló.';
        //fileinput.disabled = 'disabled';

         mensaje_log("Videollamada Falló, intente nuevamente", nick);
        swal("Error", "Videollamada Falló, intente nuevamente", "error" );
    }
});

// remote p2p/ice failure
webrtc.on('connectivityError', function (peer) {

    var pc = peer.pc;
    console.log('had local relay candidate', pc.hadLocalRelayCandidate);
    console.log('had remote relay candidate', pc.hadRemoteRelayCandidate);

    var connstate = document.querySelector('#container_' + webrtc.getDomId(peer) + ' .connectionstate');
    console.log('remote fail', connstate);
    mensaje_log(connstate, nick);
    if (connstate) {
        connstate.innerText = 'Falló.';
        //fileinput.disabled = 'disabled';
         mensaje_log("Videollamada Falló, intente nuevamente", nick);
        swal("Error", "Videollamada Falló, intente nuevamente", "error" );
    }
});

// Since we use this twice we put it here
function setRoom(name) {
    /*document.querySelector('form').remove();
    document.getElementById('title').innerText = '';
    document.getElementById('subTitle').innerText =  '';

    document.getElementById('title').style.display = "none";
    document.getElementById('subTitle').style.display = "none";*/


    //alert('Link to join: ' + location.href);
    $('body').addClass('active');
}

if (room) {
    setRoom(room);
} else {
    /*$('form').submit(function () {
        var val = $('#sessionInput').val().toLowerCase().replace(/\s/g, '-').replace(/[^A-Za-z0-9_\-]/g, '');
        webrtc.createRoom(val, function (err, name) {
            console.log(' create room cb', arguments);

            var newUrl = location.pathname + '?' + name;
            if (!err) {
                history.replaceState({foo: 'bar'}, null, newUrl);
                setRoom(name);
            } else {
                console.log(err);
            }
        });
        return false;
    });*/
    $(document).ready(function(){
        //alert(nombre_sala);
        
        var val = nombre_sala;
        webrtc.createRoom(val, function (err, name) {
            console.log(' create room cb', arguments);

            var newUrl = location.pathname + '?' + name;
            //var newUrl = location.pathname + '?token=' + token + '&nombre=' + nombre;
            if (!err) {
                history.replaceState({foo: 'bar'}, null, newUrl);
                setRoom(name);
            } else {
                console.log(err);
                 mensaje_log("No se pudo crear sala, intente nuevamente", nick);
                swal("Error", "No se pudo crear sala, intente nuevamente", "error" );
            }
        });
    });
        



}

//Compartir screen
/*var button = document.getElementById('screenShareButton'),
    setButton = function (bool) {
        button.innerText = bool ? 'share screen' : 'stop sharing';
    };
if (!webrtc.capabilities.supportScreenSharing) {
    button.disabled = 'disabled';
}
webrtc.on('localScreenRemoved', function () {
    setButton(true);
});

setButton(true);

button.onclick = function () {
    if (webrtc.getLocalScreen()) {
        webrtc.stopScreenShare();
        setButton(true);
    } else {
        webrtc.shareScreen(function (err) {
            if (err) {
                setButton(true);
            } else {
                setButton(false);
            }
        });

    }
};*/


//funciones

function desconectar(){

    if(obtener_numero_de_usuarios(webrtc) == 1){
        detener_tiempo();
        webrtc.stopLocalVideo();
        webrtc.leaveRoom();
        webrtc.disconnect();

        
         mensaje_log("Se ha finalizado la llamada");
        swal("Info", "Se ha finalizado la llamada", "success" );

        //cerrar ventana actual
        window.close();
    }

    
}

function obtener_numero_de_usuarios(webrtc){
    var n_user = webrtc.webrtc.peers.length;
    console.log("# peers: "+ n_user);

    return n_user;
}

function tiempo_llamada(){
    duracion_llamada++;
    console.log(duracion_llamada);
    //document.getElementById("duracion_llamada").text(duracion_llamada);

     
    

    $("#duracion_llamada").text(convertTime(duracion_llamada));
}

function detener_tiempo(){
    
    $("#duracion_llamada").text(convertTime(0));
    clearInterval(intervalo_llamada);
}

var convertTime = function (input, separator) {
    var pad = function(input) {return input < 10 ? "0" + input : input;};
    return [
        pad(Math.floor(input / 3600)),
        pad(Math.floor(input % 3600 / 60)),
        pad(Math.floor(input % 60)),
    ].join(typeof separator !== 'undefined' ?  separator : ':' );
}
