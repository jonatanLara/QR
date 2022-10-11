<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="bootstrap.min.css">
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/webrtc-adapter/3.3.3/adapter.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/vue/2.1.10/vue.min.js"></script>
    <script type="text/javascript" src="https://rawgit.com/schmich/instascan-builds/master/instascan.min.js"></script>
    <title></title>
  </head>
  <body>
    <div class="container">
      <h4>QR Scanner</h4>
      <div class="row">
        <div class="col-md-6">
          <video id="preview" width="500" height="500"></video>
        </div>
        <div class="col-md-6">
          <label for="">QR Value</label>
          <input type="text" name="text" id="text" readonly="" class="form-control">
        </div>
      </div>
    </div>
    <script type="text/javascript" src="instascan.min.js"></script>
    <script type="text/javascript">
      let scanner = new Instascan.Scanner({ video: document.getElementById('preview') });
      scanner.addListener('scan', function(c){
        //leer el dato del qr
        document.getElementById("text").value = c;
        console.log(c);

        let data = new FormData();
        data.append('url', c);

        fetch('servidor.php',{
        method:'POST',
        body: data
        })
        .then(function(response){
          if(response.ok){
            return response.text();
          }else{
            throw "Error en la llamada";
          }
        })
        .then(function(texto){
          console.log(texto);
        })
        .catch(function(error){
          console.log(error);
        })
        //https://www.facebook.com/TokyoCD
        //necesito descomponer la url para encontrar la matricula
      });
      Instascan.Camera.getCameras().then(function (cameras) {
        if (cameras.length > 0) {
          scanner.start(cameras[0]);
        }else{
          alert("no camara found");
        }
      }).catch(function(e){
        console.error(e);
      });

    </script>
  </body>
</html>
