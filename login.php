<?php 
    include 'includes/header_login.php';
    include 'includes/footer.php';
    include 'db.php';
    include 'confirmacion_login.php';
?>

<?php 
   if(isset($_SESSION['user_id'])){
        header('Location: index.php');
        exit;
    } else {
        // No inicio sesión! 
    }
?>

<div class="container">
    <div class="row">
        <div class="col">
        </div>
        <div class="card col">

            <?php if (isset($_SESSION['mensaje'])) { ?>
                <div class="mt-2 alert alert-<?= $_SESSION['tipo_mensaje'] ?> alert-dismissible fade show" role="alert">
                    <?= $_SESSION['mensaje'] ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            <?php session_unset(); } ?>

            <form action="login.php" method="POST">
                <div class="card-header text-center">
                    Inicio de sesión
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Correo electrónico</label>
                        <input type="email" class="form-control" aria-describedby="emailHelp" name="cf_correo">
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">Contraseña</label>
                        <input type="password" class="form-control" name="cf_contrasena">
                    </div>
                </div>
                <div class="card-footer text-muted">
                    <?php 
                        $permitted_chars = 'ABCDEFGHJKLMNPQRSTUVWXYZ';
 
                        function generate_string($input, $strength = 10) {
                            $input_length = strlen($input);
                            $random_string = '';
                            for($i = 0; $i < $strength; $i++) {
                                $num_ramdom = rand(0, 9);
                                $random_character = $input[mt_rand(0, $input_length - 1)];
                                $random_string .= $random_character;
                                $random_string .= $num_ramdom;
                            }
                         
                            return $random_string;
                        }

                        $string_length = 5;
                        $captcha_string = generate_string($permitted_chars, $string_length);

                        $_SESSION['captcha_string'] = $captcha_string;
                    ?>
                    <div class="d-grid gap-2">
                        <label for="exampleInputEmail1" class="form-label">Captcha</label>
                        <div class="input-group input-group-lg">
                        <span class="input-group-text" id="inputGroup-sizing-lg">                       
                        <?php echo $captcha_string ?>
                        </span>
                        <input type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-lg" name="cf_catpcha">
                        </div>
                        <input type="submit" class="btn btn-primary" value="Entrar" name="cf_login">
                    </div>
                </div>
            </form>
        </div>
        <div class="col">
        </div>
    </div>
</div>