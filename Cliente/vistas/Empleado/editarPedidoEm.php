<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Editar Pedido</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
    crossorigin="anonymous"></script>

  <style>
    body {
      font-family: Arial, sans-serif;
      background-color: #f4f4f4;
      margin: 0;
      padding: 0;
    }

    .container {
      max-width: 800px;
      margin: 20px auto;
      padding: 20px;
      background-color: #fff;
      border: 1px solid #ccc;
      border-radius: 5px;
      box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
    }

    .header {
      text-align: center;
      color: #333;
      background-color: black;
      color: white;
      height: 80px;
      font-family: var;
    }

    h1 {
      text-align: center;
    }

    .sub-header {
      text-align: center;
      color: #333;
    }

    form {
      margin-top: 20px;
    }

    label {
      display: block;
      margin-bottom: 5px;
      font-weight: bold;
    }

    input[type="text"],
    select {
      width: 100%;
      padding: 10px;
      margin-bottom: 10px;
      border: 1px solid #ccc;
      border-radius: 5px;
    }

    #descripcionP {
      width: 100%;
      padding: 10px;
      margin-bottom: 10px;
      border: 1px solid #ccc;
      border-radius: 5px;
      max-height: 200px;
      overflow-y: auto;
    }

    button {
      display: block;
      width: 100%;
      padding: 10px;
      background-color: #007bff;
      color: #fff;
      border: none;
      border-radius: 5px;
      cursor: pointer;
    }

    button:hover {
      background-color: #0056b3;
    }

    .img-preview {
      max-width: 100%;
      max-height: 400px;
      width: auto;
      height: auto;
      margin-bottom: 10px;
    }
  </style>

</head>

<body>
  <?php
  include("../../../config/conexion.php");

  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $idPedido = $_POST["idPedido"];
    $montoFinal = $_POST["montoFinal"];
    $fecha = $_POST["fecha"];
    $estado = $_POST["estado"];
    $metodoPago = $_POST["metodoPago"];
    $idEmpleado = $_POST["idEmpleado"];

    // Realizar la actualización en la base de datos
    $sql = "UPDATE pedido SET MONTO_FINAL=?, FECHA=?, ESTADO=?, METODO_PAGO=?, ID_EMPLEADO=? WHERE ID_PEDIDO=?";
    $stmt = $conexion->prepare($sql);
    $stmt->bind_param("dssssi", $montoFinal, $fecha, $estado, $metodoPago, $idEmpleado, $idPedido);

    if ($stmt->execute()) {
        // JavaScript para mostrar un mensaje y redirigir
        echo '<script>';
        echo 'alert("Pedido actualizado correctamente.");';
        echo 'window.location.href = "../../../Cliente/vistas/Empleado/pedidos.php";';  // Reemplaza "ruta_a_tu_pagina_de_pedidos.php" con la URL correcta
        echo '</script>';
    } else {
        echo "Error al actualizar el pedido: " . $stmt->error;
    }

    $stmt->close();
    $conexion->close();
  } else {
    $idPedido = $_GET["id"];
    $sql = "SELECT ID_PEDIDO, MONTO_FINAL, FECHA, ESTADO, METODO_PAGO, ID_CLIENTE, ID_EMPLEADO FROM pedido WHERE ID_PEDIDO = ?";
    $stmt = $conexion->prepare($sql);
    $stmt->bind_param("i", $idPedido);

    if ($stmt->execute()) {
      $stmt->bind_result($idPedido, $montoFinal, $fecha, $estado, $metodoPago, $idCliente, $idEmpleado);
      $stmt->fetch();
      $stmt->close();
    }

    // Obtener el nombre del empleado
    $nombreEmpleado = "";
    $sqlEmpleado = "SELECT N_EMPLEADO FROM empleado WHERE ID_EMPLEADO = ?";
    $stmtEmpleado = $conexion->prepare($sqlEmpleado);
    $stmtEmpleado->bind_param("i", $idEmpleado);

    if ($stmtEmpleado->execute()) {
      $stmtEmpleado->bind_result($nombreEmpleado);
      $stmtEmpleado->fetch();
      $stmtEmpleado->close();
    }

    // Obtener información del cliente
    if (!empty($idCliente)) {
      $sqlCliente = "SELECT NOMBRE, APELLIDO, NUMERO_DOC, TELEFONO, CORREO FROM cliente WHERE ID_CLIENTE = ?";
      $stmtCliente = $conexion->prepare($sqlCliente);
      $stmtCliente->bind_param("i", $idCliente);

      if ($stmtCliente->execute()) {
        $stmtCliente->bind_result($nombreCliente, $apellidoCliente, $numeroDocCliente, $telefonoCliente, $correoCliente);
        $stmtCliente->fetch();
        $stmtCliente->close();
      }
    }
  }
  ?>

  <div class="container">
    <h1>Editar Pedido</h1>

    <form action="../../../Cliente/vistas/Empleado/editarPedidoEm.php" method="POST">
      <input type="hidden" name="idPedido" value="<?php echo $idPedido; ?>">

      <label for="montoFinal">Monto Final</label>
      <input type="text" id="montoFinal" name="montoFinal" value="<?php echo $montoFinal; ?>" readonly>

      <label for="fecha">Fecha</label>
      <input type="date" id="fecha" name="fecha" value="<?php echo $fecha; ?>">

      <label for="estado">Estado</label>
      <select id="estado" name="estado">
        <option value="Pendiente" <?php if ($estado === 'Pendiente')
          echo 'selected'; ?>>Pendiente</option>
        <option value="Completado" <?php if ($estado === 'Completado')
          echo 'selected'; ?>>Completado</option>
        <option value="Entregado" <?php if ($estado === 'Entregado')
          echo 'selected'; ?>>Entregado</option>
      </select>

      <label for="metodoPago">Método de Pago</label>
      <select id="metodoPago" name="metodoPago">
        <option value="Crédito" <?php if ($metodoPago === 'Crédito')
          echo 'selected'; ?>>Crédito</option>
        <option value="Yape" <?php if ($metodoPago === 'Yape')
          echo 'selected'; ?>>Yape</option>
        <option value="Paypal" <?php if ($metodoPago === 'Paypal')
          echo 'selected'; ?>>Paypal</option>
      </select>

      <!-- Combobox para el nombre del empleado -->
      <label for="idEmpleado">Empleado Asignado</label>
      <select id="idEmpleado" name="idEmpleado">
        <option value="<?php echo $idEmpleado; ?>" selected>
          <?php echo $nombreEmpleado; ?>
        </option>
        <?php
        $sqlEmpleados = "SELECT ID_EMPLEADO, N_EMPLEADO FROM empleado";
        $resultEmpleados = $conexion->query($sqlEmpleados);
        while ($rowEmpleado = $resultEmpleados->fetch_assoc()) {
          $empleadoID = $rowEmpleado["ID_EMPLEADO"];
          $empleadoNombre = $rowEmpleado["N_EMPLEADO"];
          if ($empleadoID != $idEmpleado) {
            echo "<option value='$empleadoID'>$empleadoNombre</option>";
          }
        }
        ?>
      </select>

      <!-- Información del cliente (solo lectura) -->
      <label for="clienteInfo">Nombres del Cliente</label>
      <input type="text" id="clienteInfo" value="<?php echo $nombreCliente . ' ' . $apellidoCliente; ?>" readonly>

      <label for="numeroDoc">Número de Documento del Cliente</label>
      <input type="text" id="numeroDoc" value="<?php echo $numeroDocCliente; ?>" readonly>

      <label for="telefono">Teléfono del Cliente</label>
      <input type="text" id="telefono" value="<?php echo $telefonoCliente; ?>" readonly>

      <label for="correo">Correo Electrónico del Cliente</label>
      <input type="text" id="correo" value="<?php echo $correoCliente; ?>" readonly>

      <button type="submit" class="btn-primary">Guardar Cambios</button>
    </form>
  </div>
</body>

</html>