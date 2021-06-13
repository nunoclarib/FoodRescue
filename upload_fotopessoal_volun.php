<?php

function crop_image($fileNameNew, $max_resolution)
{
    if ($fileNameNew) {

        $og_img = imagecreatefromjpeg('uploads/'.$fileNameNew);

        $og_width = imagesx($og_img);
        $og_height = imagesy($og_img);

        if ($og_height > $og_width) {

            $ratio = $max_resolution / $og_width;
            $newWidth = $max_resolution;
            $newHeight = $og_height * $ratio;

            $diff = $newHeight - $newWidth;

            $x = 0;
            $y = round($diff / 2);

        } else {

            $ratio = $max_resolution / $og_height;
            $newHeight = $max_resolution;
            $newWidth = $og_width * $ratio;

            $diff = $newWidth - $newHeight;

            $x = round($diff / 2);
            $y = 0;

        }

        if ($og_img) {

            $new_image = imagecreatetruecolor($newWidth, $newHeight);
            imagecopyresampled($new_image, $og_img, 0, 0, 0, 0, $newWidth, $newHeight, $og_width, $og_height);

            $new_crop_image = imagecreatetruecolor($max_resolution, $max_resolution);

            imagecopyresampled($new_crop_image, $new_image, 0, 0, $x, $y, $max_resolution, $max_resolution, $max_resolution, $max_resolution);

            imagejpeg($new_crop_image, 'uploads/'.$fileNameNew, 90);


        }

    }
}

if (isset($_POST['submit'])){
    $file = $_FILES['fileupload'];
    // print_r($file); // consegue-se ver o nome, o tipo, tmp_name, erro e size da imagem
    // colocar esses dados que estão num array numa variável
    $fileName = $_FILES['fileupload']['name'];
    $fileTmpName = $_FILES['fileupload']['tmp_name'];
    $fileSize = $_FILES['fileupload']['size'];
    $fileError = $_FILES['fileupload']['error'];
    $fileType = $_FILES['fileupload']['type'];

    // separa a parte do nome da foto e do .jpg e coloca num array
    $fileExt = explode('.',$fileName);
    // transformar letras grandes em pequenas
    // vai buscar o .jpg por exemplo (end)
    $fileActualExt = strtolower(end($fileExt));

    $allowed = array('jpg','jpeg','png','gif');

    // se o fileactualext for igual aos valores no array
    if (in_array($fileActualExt, $allowed)){
        // se não ocorrer um erro
        if ($fileError===0){
            // se o ficheiro for menor que 13MB
            if ($fileSize < 13000000){
                // cria um nome de acordo com os microsegundos no momento + o .jpg
                $fileNameNew = uniqid('',true).".".$fileActualExt;

                $fileDestination = 'uploads/'.$fileNameNew;

                // move o ficheiro da localização temporal para a localização final
                move_uploaded_file($fileTmpName, $fileDestination);

                crop_image($fileNameNew, "300");

                // header("Location: perfil.php");
            }
            else{
                echo 'Ficheiro muito grande';
                header("Location: registo_forn_pic.php?msg=0");
            }
        }
        else{
            echo 'Erro ao fazer upload';
            header("Location: registo_forn_pic.php?msg=1");
        }
    }
    else{
        echo 'Não é suportado este tipo de ficheiro';
        header("Location: registo_forn_pic.php?msg=2");
    }

}
else{
    echo'Não existe file';
    header("Location: registo_forn_pic.php?msg=3");
}

if (isset($fileNameNew)){
    session_start();
    require_once 'connections/connection.php';

    $id_user = $_SESSION['iduser'];

    $link = new_db_connection();

    $stmt = mysqli_stmt_init($link);

    $query = "UPDATE utilizadores
              SET foto_pessoal = '$fileNameNew'
              WHERE  idUtilizadores=?";

    if (mysqli_stmt_prepare($stmt, $query)) {

        mysqli_stmt_bind_param($stmt,'i', $id_user);

        mysqli_stmt_execute($stmt);

        mysqli_stmt_close($stmt);

    } else {
        echo("Error description: " . mysqli_error($link));
    }

    mysqli_close($link);

    header("Location: QR_Code.php");
}