<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    if (isset($_POST['destino'])) {
        $destino = [
            'nombre' => $_POST['destino'],
            'fecha' => $_POST['fecha'],
            'descripcion' => $_POST['descripcion'],
        ];

        // Leer datos existentes del archivo
        $destinosAnteriores = [];
        if (file_exists('destinos.dat')) {
            $s = file_get_contents('destinos.dat');
            $destinosAnteriores = unserialize($s);
        }

        // Agregar el nuevo destino
        $destinosAnteriores[] = $destino;

        // Guardar en el archivo
        $s = serialize($destinosAnteriores);
        file_put_contents('destinos.dat', $s);
    }
}

$destinos = [];
if (file_exists('destinos.dat')) {
    $s = file_get_contents('destinos.dat');
    $destinos = unserialize($s);
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/estilo.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <title>Lista de Destinos por Visitar</title>
</head>

<body>
    <div class="container-fluid">
        <h1 class="text-center m-3">Destinos por Visitar</h1>

        <div class="card border-info mb-5 card-hover ">
            <form method="post" action="" class="p-3">

                <div class="form-floating mb-3">
                    <input type="text" class="form-control" name="destino" id="destinoInput" placeholder="Nuevo destino" autocomplete="off" required>
                    <label for="destinoInput">Nuevo destino</label>
                </div>

                <div class="form-floating mb-3">
                    <input type="date" class="form-control" name="fecha" id="fechaInput" placeholder="Fecha" required>
                    <label for="fechaInput">Fecha de planificación</label>
                </div>

                <div class="input-group mb-3">
                    <span class="input-group-text ">Descripción</span>
                    <textarea class="form-control " aria-label="Descripción" name="descripcion" autocomplete="off" required></textarea>
                </div>

                <div class="d-grid">
                    <button class="btn btn-primary mb-2" type="submit">Agregar</button>
                </div>

            </form>
        </div>


        <div class="table-responsive">
            <?php if (empty($destinos)) : ?>
                <p class="mensaje-vacio">No hay destinos por visitar.</p>
            <?php else : ?>
                <table class="table text-center table-bordered table-striped table-hover">
                    <thead class="table-dark">
                        <tr>
                            <th scope="col">Destino</th>
                            <th scope="col">Fecha de Planificación</th>
                            <th scope="col">Descripción</th>
                        </tr>
                    </thead>
                    <tbody class="table-group-divider">
                        <?php foreach ($destinos as $d) : ?>
                            <tr>
                                <td><?= $d['nombre'] ?></td>
                                <td><?= $d['fecha'] ?></td>
                                <td><?= $d['descripcion'] ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            <?php endif; ?>
        </div>

    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>

</html>