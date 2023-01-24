<?php
    include 'db.php';

    if (isset($_POST['editar_pg'])) {
        $id= $_GET['id'];
        $nombre= $_POST['nombre'];
        $f_inicial= $_POST['f_inicial'];
        $f_final= $_POST['f_final'];
        $costo= $_POST['costo'];
        $url= $_POST['url'];
        $imagen= addslashes(file_get_contents($_FILES['imagen']['tmp_name']));
        $descripcion= $_POST['descripcion'];

        $query = "UPDATE paginas set nombre = '$nombre', f_inicial = '$f_inicial', f_final = '$f_final', costo = '$costo', costo = '$costo', url = '$url', imagen = '$imagen', descripcion = '$descripcion' WHERE id = $id";
        $resultado = mysqli_query($conn,$query);

        if (!$resultado) {
            $_SESSION['mensaje'] = 'Error al editar página';
            $_SESSION['tipo_mensaje'] = 'danger';
        }else {
            $_SESSION['mensaje'] = 'Página editada correctamente';
            $_SESSION['tipo_mensaje'] = 'success';
        }

        header("Location: index.php");
    }
?>