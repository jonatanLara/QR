<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="bootstrap.min.css">
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/webrtc-adapter/3.3.3/adapter.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/vue/2.1.10/vue.min.js"></script>
    <script type="text/javascript" src="https://rawgit.com/schmich/instascan-builds/master/instascan.min.js"></script>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css" integrity="sha384-DyZ88mC6Up2uqS4h/KRgHuoeGwBcD4Ng9SiP4dIRy0EXTlnuz47vAwmeGwVChigm" crossorigin="anonymous"/>

    <title></title>
    <style media="screen">
      body {
        background: whitesmoke;
      }
      .caja{

      }
      .cuadro {
        font-size: 15px;
        padding: 8px;
        border-radius: 3px;
        color: #FFF;
      }
      #preview{
        width: 100%;
        height: 100%;border-radius: 3px;
      }
      p{
        text-align: center;
      }
      .blanco{
        color: white;
      }
      .bg-color-rojo{
        background: #621132;
      }
      .bg-blanco{
        background: white;
      }
      .color-rojo{
        color: #621132;
      }
    </style>
  </head>
  <body>
    <div class="container">
      <div class="row">
        <div class="col-md-4 cuadro bg-color-rojo">
          <p class="blanco"> <i class="fas fa-camera"></i> Tap Here</p>
          <video id="preview"></video>
          <p class="blanco"> Derechos reservados</p>
        </div>
        <div class="col-md-8 cuadro bg-blanco color-rojo">
          <p class="color-rojo"><i class="fas fa-qrcode"></i> QR Value</p>
    <!--    <input type="text" name="text" id="text" readonly="" class="form-control"> -->
          <table class="table table-bordered">
            <thead>
                <tr>
                  <th scope="col">Personal</th>
                  <th scope="col">Código</th>
                  <th scope="col">Hora</th>
                  <th scope="col">Fecha</th>
                  <th scope="col">Estado</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <th scope="row">Jonatan Jair Lara Ortiz</th>
                  <td>DSA22003</td>
                  <td>9:00:21 am</td>
                  <td>2022-02-19</td>
                  <td>Entrada</td>
                </tr>
                <tr>
                  <th scope="row">Jonatan Jair Lara Ortiz</th>
                  <td>DSA22003</td>
                  <td>17:67:21 pm</td>
                  <td>2022-02-19</td>
                  <td>Salida</td>
                </tr>

              </tbody>
          </table>
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
