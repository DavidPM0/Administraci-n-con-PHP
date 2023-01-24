<?php 
    include '../db.php';
    echo '<style>' . file_get_contents("bootstrap-3.3.7-dist/css/bootstrap.min.css") . '</style>';
?>

<style>
.table>tbody>tr>td,.table>tbody>tr>th {
    vertical-align: baseline; 
}
</style>

<?php
if(!isset($_SESSION['user_id'])){
    header('Location: ../login.php');
    exit;
} else {
    // Inicio sesión! 
}
?>
        <nav class="navbar navbar-expand-lg bg-body-tertiary">
            <div class="container-fluid">
                <div class="col-12">
                    <a class="navbar-brand">MVC (Cotización de proyectos)</a>
                </div>
            </div>
        </nav> 

        <table class="table">
            <thead>
                <tr>
                <th scope="col">N.°</th>
                <th scope="col">Nombre</th>
                <th scope="col">Url</th>
                <th scope="col">Duración</th>
                <th scope="col">Imagen</th>
                <th scope="col">Costo</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                    $query="SELECT * FROM paginas";
                    $resultado_paginas = mysqli_query($conn,$query);
                    while($row = mysqli_fetch_array($resultado_paginas)){ ?>
                        <tr>
                        <th scope="row"><?php echo $row['id'] ?></th>
                        <td><?php echo $row['nombre'] ?></td>
                        <td><?php echo $row['url'] ?></td>
                        <td><?php
                            $date1 = new DateTime($row['f_inicial']);
                            $date2 = new DateTime($row['f_final']);
                            $diff = $date1->diff($date2);
                                                      
                            echo $diff->days .' Días ';
                        ?></td>
                        <td><img width="60" src="data:image/jpg;base64,<?php echo base64_encode($row['imagen']) ?>"></td>
                        <td>S/ <?php echo $row['costo'] ?></td>
                        </tr>
                <?php } ?>
                <tr>                  
                    <?php 
                        $query="SELECT SUM(costo) FROM paginas";
                        $sumatotal = mysqli_query($conn,$query);
                        $total = mysqli_fetch_array($sumatotal);
                    ?>
                    <th>Subtotal</th>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td><?php echo "S/ ".$total[0] ?></td>
                </tr>
            </tbody>
        </table>


<?php
    include '../includes/footer.php';
?>