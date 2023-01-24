<?php
    include 'db.php';

    if (isset($_POST['guardar_pg'])) {
        $nombre= $_POST['nombre'];
        $f_inicial= $_POST['f_inicial'];
        $f_final= $_POST['f_final'];
        $costo= $_POST['costo'];
        $url= $_POST['url'];
        $imagen= addslashes(file_get_contents($_FILES['imagen']['tmp_name']));
        $descripcion= $_POST['descripcion'];

        $query = "INSERT INTO paginas(nombre,f_inicial,f_final,costo,url,imagen,descripcion) VALUES ('$nombre','$f_inicial','$f_final','$costo','$url','$imagen','$descripcion')";
        $resultado = mysqli_query($conn,$query);

        if (!$resultado) {
            $_SESSION['mensaje'] = 'Error al guardar página';
            $_SESSION['tipo_mensaje'] = 'danger';
        }else {
            $_SESSION['mensaje'] = 'Página guardado correctamente';
            $_SESSION['tipo_mensaje'] = 'success';
        }

        header("Location: index.php");
    }
?>