<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    

<video id='c'></video>
    

<script src="https://cdn.jsdelivr.net/npm/peerjs@0.3.20/dist/peer.min.js"></script>

    <script>
    var peer = new Peer();

    var getUserMedia = (navigator.getUserMedia || navigator.webkitGetUserMedia || navigator.mozGetUserMedia).bind(navigator);;
        
        getUserMedia({
            'video': true,
            'audio': true
            }, function(stream) {
        var call = peer.call('tsab2w7wd3f00000', stream);
        
        call.on('stream', function(remoteStream) {
            console.log(remoteStream)
            // Show stream in some video/canvas element.
            console.log(remoteStream);
            var video = document.querySelector('#c');
            
			video.srcObject = remoteStream;
			video.onloadedmetadata = function(e) {
                video.play();
            }
            
        });
        }, function(err) {
        console.log('Failed to get local stream' ,err);
        });
    
    </script>
</body>
</html>