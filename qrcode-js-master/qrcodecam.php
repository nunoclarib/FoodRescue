<!DOCTYPE>
<html>
<head>
    <title>Instascan</title>
    <script type="text/javascript" src="https://rawgit.com/schmich/instascan-builds/master/instascan.min.js"></script>
</head>
<body>
<video id="preview" class="container-fluid align-content-center"></video>
<form method="post" action="scripts/sc_qrcode_validacao.php" id="formulario">
    <input type="hidden" name="conteudo" id="conteudo">
    <div id="botaoqrcode"></div>
    <script>
        let scanner = new Instascan.Scanner(
            {
                video: document.getElementById('preview')
            }
        );
        scanner.addListener('scan', function (content) {
            document.getElementById('botaoqrcode').innerHTML = "<button class=\"btn btn_edt\"><h5 class=\"text-dark font-weight-bold\">Registar</h5></button></a>";
            alert('O seu QRcode foi lido com sucesso ');
            document.getElementById('conteudo').value = content;
        });
        Instascan.Camera.getCameras().then(cameras => {
            if (cameras.length > 0) {
                scanner.start(cameras[0]);
            } else {
                console.error("Não existe câmera no dispositivo!");
            }
        });
    </script>
</form>

</body>
</html>