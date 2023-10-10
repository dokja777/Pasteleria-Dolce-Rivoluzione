<?php
include('config/conexion.php');

if (isset($_POST["action"])) {
  $id_categoria = isset($_POST["id_categoria"]) ? $_POST["id_categoria"] : null;

  // Construye la consulta base
  $query = "SELECT * FROM producto";

  if (!empty($id_categoria)) {
    $query .= " WHERE ID_CATEGORIA = $id_categoria";
  }

  // Verifica si se han proporcionado valores mínimos y máximos de precio
  if (isset($_POST["minimum_price"], $_POST["maximum_price"]) && !empty($_POST["minimum_price"]) && !empty($_POST["maximum_price"])) {
    $minimum_price = floatval($_POST["minimum_price"]);
    $maximum_price = floatval($_POST["maximum_price"]);

    if (!empty($id_categoria)) {
      $query .= " AND PRECIO BETWEEN $minimum_price AND $maximum_price";
    } else {
      $query .= " WHERE PRECIO BETWEEN $minimum_price AND $maximum_price";
    }
  }

  $result = $conexion->query($query);
  $output = ''; // Inicializa la variable $output

  if ($result) {
    $total_row = mysqli_num_rows($result);

    if ($total_row > 0) {
      while ($row = $result->fetch_object()) {
        $output .= '
                <div class="card">
                    <img src="data:image/jpg;base64,' . base64_encode($row->IMG) . '">
                    <h4>' . $row->N_PRODUCTO . '</h4>
                    <p><a>S/</a>' . $row->PRECIO . '</p>
                    <button class="ver-detalle">Ver Detalle del Producto</button>
                </div>';
      }
    } else {
      $output = '<h3>No Data Found</h3>';
    }
  } else {
    $output = '<h3>Error in SQL Query</h3>';
  }

  echo $output;
}
?>