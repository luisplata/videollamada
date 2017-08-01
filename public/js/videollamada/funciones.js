
// grab the room from the URL
var room = location.search && location.search.split("&")[0].replace("?","");
//alert(room);

//nickname
var nick = location.search && location.search.split("&")[1].replace("nombre=","");

//alert(nick);


// create our webrtc connection
var webrtc = new SimpleWebRTC({
    // the id/element dom element that will hold "our" video
    localVideoEl: 'localVideo',
    // the id/element dom element that will hold remote videos
    remoteVideosEl: '',
    // immediately ask for camera access
    autoRequestMedia: true,
    debug: false,
    detectSpeakingEvents: true,
    autoAdjustMic: false,

    nick: nick,
});

console.log(webrtc);

// when it's ready, join if we got a room from the URL
webrtc.on('readyToCall', function () {
    // you can name it anything
    if (room) webrtc.joinRoom(room);
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
});
// we did not get access to the camera
webrtc.on('localMediaError', function (err) {

});

// local screen obtained
webrtc.on('localScreenAdded', function (video) {
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

    console.log(obtener_numero_de_usuarios(webrtc));//numero de pares conectados




    var remotes = document.getElementById('remotes');
    if (remotes) {
        var container = document.createElement('div');
        container.className = 'videoContainer';
        container.id = 'container_' + webrtc.getDomId(peer);
        container.appendChild(video);

        // suppress contextmenu
        video.oncontextmenu = function () { return false; };

        // resize the video on click
        video.onclick = function () {
            //container.style.width = video.videoWidth + 'px';
            //container.style.height = video.videoHeight + 'px';

            container.style.width = '100%';
            container.style.height = '100%';
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
                        break;
                    case 'connected':
                    case 'completed': // on caller side
                        //$(vol).show();
                        connstate.innerText = 'Conectado';
                        break;
                    case 'disconnected':
                        connstate.innerText = 'Desconectado.';
                        break;
                    case 'failed':
                        connstate.innerText = 'Falló.';
                        break;
                    case 'closed':
                        connstate.innerText = 'Cerrada.';
                        break;
                }
            });
        }
        remotes.appendChild(container);
    }
});
// a peer was removed
webrtc.on('videoRemoved', function (video, peer) {
    console.log('video removed ', peer);
    var remotes = document.getElementById('remotes');
    var el = document.getElementById(peer ? 'container_' + webrtc.getDomId(peer) : 'localScreenContainer');
    if (remotes && el) {
        remotes.removeChild(el);
    }

    //cerrar ventana actual
    window.close();


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
    if (connstate) {
        connstate.innerText = 'Falló.';
        fileinput.disabled = 'disabled';
    }
});

// remote p2p/ice failure
webrtc.on('connectivityError', function (peer) {

    var pc = peer.pc;
    console.log('had local relay candidate', pc.hadLocalRelayCandidate);
    console.log('had remote relay candidate', pc.hadRemoteRelayCandidate);

    var connstate = document.querySelector('#container_' + webrtc.getDomId(peer) + ' .connectionstate');
    console.log('remote fail', connstate);
    if (connstate) {
        connstate.innerText = 'Falló.';
        fileinput.disabled = 'disabled';
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
    webrtc.stopLocalVideo();
    webrtc.leaveRoom();
    webrtc.disconnect();

    //window.location = "https://demo.nabu.com.co";

    //cerrar ventana actual
    window.close();
}

function obtener_numero_de_usuarios(webrtc){
    var n_user = webrtc.webrtc.peers.length;

    return n_user;
}
