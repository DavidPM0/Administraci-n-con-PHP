<?php 
    include 'includes/header.php';
    include 'db.php';
?>

<?php
if(!isset($_SESSION['user_id'])){
    header('Location: login.php');
    exit;
} else {
    // Inicio sesión! 
}
?>

<div class="container text-center">
  <div class="row align-items-start">
    <div class="col-4">

        <?php if (isset($_SESSION['mensaje'])) { ?>
            <div class="alert alert-<?= $_SESSION['tipo_mensaje'] ?> alert-dismissible fade show" role="alert">
                <?= $_SESSION['mensaje'] ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php unset($_SESSION['mensaje']); unset($_SESSION['tipo_mensaje']); } ?>

        <div class="card card-body">
            <form action="guardar_pg.php" method="POST" enctype="multipart/form-data">
                <div class="mb-3">
                <input type="text" class="form-control" placeholder="Nombre de página" name="nombre">
                </div>
                <div class="input-group mb-3">
                <label class="input-group-text" for="inputGroupFile01">Inicio</label>
                <input type="date" class="form-control" name="f_inicial">
                </div>
                <div class="input-group mb-3">
                <label class="input-group-text" for="inputGroupFile01">Final</label>
                <input type="date" class="form-control" name="f_final">
                </div>
                <div class="mb-3">
                <input type="text" class="form-control" placeholder="S/ Costo" name="costo">
                </div>
                <div class="mb-3">
                <input type="text" class="form-control" placeholder="URL" name="url">
                </div>
                <div class="mb-3">
                <input type="file" class="form-control" accept=".jpg" name="imagen">
                </div>
                <div class="mb-3">
                <textarea class="form-control" rows="3" placeholder="Descripción" name="descripcion"></textarea>
                </div>
                <div class="d-grid gap-2">
                <input type="submit" class="btn btn-primary" value="Agregar" name="guardar_pg">
                </div>
            </form>
        </div>
    </div>
    <div class="col-8">
        <table class="table">
            <thead>
                <tr>
                <th scope="col">N.°</th>
                <th scope="col">Nombre de página</th>
                <th scope="col">Duración</th>
                <th scope="col">Costo</th>
                <th scope="col">Actiones</th>
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
                        <td><?php
                            $date1 = new DateTime($row['f_inicial']);
                            $date2 = new DateTime($row['f_final']);
                            $diff = $date1->diff($date2);
                                                      
                            echo $diff->days .' Días ';
                        ?></td>
                        <td>S/ <?php echo $row['costo'] ?></td>
                        <td>
                            <div class="btn-group" role="group" aria-label="Basic example">

                                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalver<?php echo $row['id'] ?>" id="btnver<?php echo $row['id'] ?>"><i class="fas fa-eye"></i></button>
                                <!-- Modal-ver -->
                                <div class="modal fade" id="modalver<?php echo $row['id'] ?>" tabindex="-1" aria-labelledby="modalver<?php echo $row['id'] ?>Label" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                        <div class="modal-header">
                                            <h1 class="modal-title fs-5" id="modalverLabel"><?php echo $row['id'] ?>. <?php echo $row['nombre'] ?></h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                        <table class="table table-bordered border-primary">
                                            <tbody>
                                                <tr>
                                                <th scope="row">Duración</th>
                                                <td><?php
                                                    $date1 = new DateTime($row['f_inicial']);
                                                    $date2 = new DateTime($row['f_final']);
                                                    $diff = $date1->diff($date2);
                                                                            
                                                    echo $diff->days .' Días ';
                                                ?></td>
                                                </tr>
                                                <tr>
                                                <th scope="row">Costo</th>
                                                <td>S/ <?php echo $row['costo'] ?></td>
                                                </tr>
                                                <tr>
                                                <th scope="row">URL</th>
                                                <td><a href="<?php echo $row['url'] ?>" target="_blank"><?php echo $row['url'] ?></a></td>
                                                </tr>
                                                <tr>
                                                <th scope="row">Descripción</th>
                                                <td><?php echo $row['descripcion'] ?></td>
                                                </tr>
                                            </tbody>                            
                                            <img width="100%" src="data:image/jpg;base64,<?php echo base64_encode($row['imagen']) ?>">
                                        </table>
                                        </div>
                                        </div>
                                    </div>
                                </div>

                                <button type="button" class="btn btn-light" data-bs-toggle="modal" data-bs-target="#modaleditar<?php echo $row['id'] ?>" id="btneditar<?php echo $row['id'] ?>"><i class="fas fa-marker"></i></button>
                                <!-- Modal-editar -->
                                <div class="modal fade" id="modaleditar<?php echo $row['id'] ?>" tabindex="-1" aria-labelledby="modaleditar<?php echo $row['id'] ?>Label" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="modaleditarLabel">Editar página</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <?php if (isset($_SESSION['mensaje'])) { ?>
                                            <div class="alert alert-<?= $_SESSION['tipo_mensaje'] ?> alert-dismissible fade show" role="alert">
                                                <?= $_SESSION['mensaje'] ?>
                                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                            </div>
                                        <?php session_unset(); } ?>

                                        <div class="card card-body">
                                            <form action="editar_pg.php?id=<?php echo $row['id'] ?>" method="POST" enctype="multipart/form-data">
                                                <div class="mb-3">
                                                <input type="text" class="form-control" placeholder="Nombre de página" name="nombre" value="<?php echo $row['nombre'] ?>">
                                                </div>
                                                <div class="input-group mb-3">
                                                <label class="input-group-text" for="inputGroupFile01">Inicio</label>
                                                <input type="date" class="form-control" name="f_inicial" value="<?php echo $row['f_inicial'] ?>">
                                                </div>
                                                <div class="input-group mb-3">
                                                <label class="input-group-text" for="inputGroupFile01">Final</label>
                                                <input type="date" class="form-control" name="f_final" value="<?php echo $row['f_final'] ?>">
                                                </div>
                                                <div class="mb-3">
                                                <input type="text" class="form-control" placeholder="S/ Costo" name="costo" value="<?php echo $row['costo'] ?>">
                                                </div>
                                                <div class="mb-3">
                                                <input type="text" class="form-control" placeholder="URL" name="url" value="<?php echo $row['url'] ?>">
                                                </div>
                                                <div class="mb-3">
                                                <input type="file" class="form-control" accept=".jpg" name="imagen">
                                                </div>
                                                <div class="mb-3">
                                                <textarea class="form-control" rows="3" placeholder="Descripción" name="descripcion"><?php echo $row['descripcion'] ?></textarea>
                                                </div>
                                                <div class="d-grid gap-2">
                                                <input type="submit" class="btn btn-primary" value="Editar" name="editar_pg">
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                    </div>
                                </div>
                                </div>

                                <a href="borrar_pg.php?id=<?php echo $row['id'] ?>" class="btn btn-danger"><i class="fas fa-trash"></i></a>
                            </div>
                        </td>
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
                    <td><?php echo "S/ ".$total[0] ?></td>
                    <td><a href="pdf/descargar.php" type="button" class="btn btn-dark"><i class="fas fa-file-pdf"></i></a></td>
                </tr>
            </tbody>
        </table>
    </div>
  </div>
</div>

<?php
    include 'includes/footer.php';
?>