<?php
    include 'db.php';

    if (isset($_GET['id'])) {
        $id = $_GET['id'];
        $query = "DELETE FROM paginas WHERE id = $id";
        $resultado = mysqli_query($conn, $query);

        if (!$resultado) {
            $_SESSION['mensaje'] = 'Error al eliminar la página';
            $_SESSION['tipo_mensaje'] = 'danger';
        }else {
            $_SESSION['mensaje'] = 'Página eliminada correctamente';
            $_SESSION['tipo_mensaje'] = 'success';
        }
    
        header("Location: index.php");
    }
?>