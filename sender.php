


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>

<script src="https://cdn.jsdelivr.net/npm/peerjs@0.3.20/dist/peer.min.js"></script>

<video id='c'></video>
<script>

var peer = new Peer();

peer.on('open', function(id) {
  console.log(id)
})

var getUserMedia = (navigator.getUserMedia || navigator.webkitGetUserMedia || navigator.mozGetUserMedia).bind(navigator);;
peer.on('call', function(call) {
  getUserMedia({video: true, audio: true}, function(stream) {
      call.answer(stream); // Answer the call with an A/V stream.
      call.on('stream', function(remoteStream) {
          console.log(stream, remoteStream);
          var video = document.querySelector('#c');
          video.src = window.URL.createObjectURL(stream);
          video.onloadedmetadata = function(e) {
              video.play();
              // Show stream in some video/canvas element.
          }
    });
  }, function(err) {
    console.log('Failed to get local stream' ,err);
  });
});



</script>
    
</body>
</html>