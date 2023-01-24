<?php 
    if (isset($_POST['cf_login'])) {
        $correo= $_POST['cf_correo'];
        $contrasena= $_POST['cf_contrasena'];
        $catpcha= $_POST['cf_catpcha'];
        $captcha_string= 0;

        $cf_correo= md5($correo);
        $cf_contrasena= md5($contrasena);
        
        $query= "SELECT * FROM usuario WHERE correo='$cf_correo' AND contrasena='$cf_contrasena'";
        $resultado = mysqli_query($conn,$query);

        $row = mysqli_fetch_array($resultado);

        if ($catpcha==$_SESSION['captcha_string']) {
            if (!$row) {
                $_SESSION['mensaje'] = 'Error en el correo o contraseña';
                $_SESSION['tipo_mensaje'] = 'danger'; 
            }else{
                if ($row['correo']==$cf_correo & $row['contrasena']==$cf_contrasena) {
                    $_SESSION['user_id'] = $row['id'];
                    header("Location: index.php");
                }        
            }
        }else{
            $_SESSION['mensaje'] = 'Error en el captcha';
            $_SESSION['tipo_mensaje'] = 'danger';
        }
    }    
?>