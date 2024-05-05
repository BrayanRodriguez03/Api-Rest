<?php

$ch = curl_init();
$url ="http://localhost/apirestbrayan/backEnd/get_all_helado.php";

curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

$response = curl_exec($ch);
if ($response === false) {
  echo "Error en la solicitud cURL: " . curl_error($ch);
} else {
  $response = json_decode($response, true);
}
curl_close($ch);
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <link rel="stylesheet" href="style.css">
  <title>Helado</title>
</head>

<body>
  <nav class="navbar bg-dark border-bottom border-body" data-bs-theme="dark">
    <div class="container-fluid">
      <a class="navbar-brand" href="#">Información de Helados</a>
    </div>
  </nav>

  <div class="container">
    <div class=" mt-5">
      <button type="button" class="btn btn-outline-danger" data-bs-toggle="modal" data-bs-target="#helado"
        id="agregarHelado">
        <i class="fas fa-plus me-1"></i> Agregar Helado
      </button>
    </div>
    <div class="contenedor">
      <h1 class="mb-4">Helados</h1>
      <div class="table-responsive">
        <table id="tabla-conteiner" class="table table-bordered table-hover">
          <thead >
            <tr class="table-info">
              <th class="sorting">Id</th>
              <th class="sorting" style="width: 150px;">Nombre</th>
              <th class="sorting" style="width: 200px;">Sabor</th>
              <th class="sorting" style="width: 150px;">Precio</th>
              <th class="sorting" style="width: 150px;">Stock</th>
              <th class="sorting">Acciones</th>
            </tr>
          </thead>
          <tbody>
            <?php
            foreach ($response as $key => $helado) {
              echo '<tr>
                                <td>' . $helado['id'] . '</td>
                                <td>' . $helado['nombre'] . '</td>
                                <td>' . $helado['sabor'] . '</td>
                                <td>' . $helado['precio'] . '</td>
                                <td>' . $helado['stock'] . '</td>
                                <td>
                                    <button type="button" class="btn btn-warning btnEditar" data-id="' . $helado['id'] . '" data-bs-toggle="modal" data-bs-target="#helado">
                                        <i class="fas fa-pencil-alt"></i>
                                    </button>
                                    <button type="button" class="btn btn-danger btnEliminar" data-id="' . $helado['id'] . '" data-bs-toggle="modal" data-bs-target="#modalEliminar">
                                        <i class="fas fa-trash-alt"></i>
                            </button>
                         </td>
                    </tr>';
            }
            ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>

  <input type="text" id="id-helado" hidden>

  <div class="modal fade" id="helado" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-md">
      <div class="modal-content">
        <div class="modal-header bg-light">
          <h5 class="modal-title mx-auto font-weight-bold h2">Registrar helado</h5>
          
        </div>

        <form id="nuevo_form">
          <div class="modal-body">
            <div class="container-fluid">
              <div class="form-group mb-2">
                <label for="nombre">
                  <i class=""></i> Nombre del helado
                </label>
                <input type="text" name="nombre" id="nombre" class="form-control">
              </div>

              <div class="form-group mb-2">
              <label for="sabor">
              <i class=""></i> Sabor
              </label>
              <input type="text" name="sabor" id="sabor" class="form-control" >
              </div>

              <div class="form-group mb-2">
                <label for="stock">
                  <i class=""></i> Precio
                </label>
                <input type="number" name="precio" id="precio" class="form-control" min="0" step="1">
              </div>

              <div class="form-group mb-2">
                <label for="Stock">
                  <i class=""></i> Stock
                </label>
                <input type="number" name="stock" id="stock" class="form-control">
              </div>
            </div>
          </div>

          <div class="modal-footer mb-2">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
              <i class="fas fa-times mr-3"></i>Cancelar
            </button>
            <button type="button" class="btn btn-success" id="guardarHelado">
              <i class="fas fa-save mr-3"></i>Guardar
            </button>
          </div>
        </form>
      </div>
    </div>
  </div>

  <div class="modal fade" id="modalEliminar" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
    <div class=" modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Deseas eliminar este helado?</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
        <button type="button" class="btn btn-primary" id="btnEliminarHelado">Si</button>
      </div>
    </div>
  </div>
  </div>


  <script src="./jquery.js"> </script>
  <script src="./script.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
    integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r"
    crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"
    integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy"
    crossorigin="anonymous"></script>
  <script src="https://kit.fontawesome.com/16d70f32b6.js" crossorigin="anonymous"></script>
</body>

</html>

