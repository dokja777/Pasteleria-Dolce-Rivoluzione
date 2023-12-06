<?php
session_start();

include('../../../Config/conexion.php');

if (!isset($_SESSION['Id'])){
    header("Location: ../../../Cliente/vistas/Cliente/inicioSesion.php");
    exit();
}

// Obtén el ID del cliente de la sesión
$cliente_id = $_SESSION['Id'];

// Realiza la consulta SQL para obtener los datos del cliente
$sql = "SELECT * FROM cliente WHERE ID_CLIENTE = $cliente_id";

$resultado = mysqli_query($conexion, $sql);

if ($resultado) {
    // Obtiene los datos del cliente como un array asociativo
    $row = mysqli_fetch_assoc($resultado);

    // Ahora, puedes acceder a los datos del cliente usando $row
    $numero_doc = $row['NUMERO_DOC'];
    $nombre = $row['NOMBRE'];
    $apellido = $row['APELLIDO'];
    $telefono = $row['TELEFONO'];
    $correo = $row['CORREO'];

    // Puedes usar estos datos para prellenar el formulario de edición, si es necesario
} else {
    echo "Error al obtener los datos del cliente: " . mysqli_error($conexion);
}
?>

<?php
include('../../../Servidor/PHP/Cliente/sessionAbiertaCliente.php');
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
  
    <link rel="stylesheet" href="../../../Cliente/css/perfil.css" />
    <!-- Iconos en font awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
        integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Productos</title>
</head>

<body>
    <!-- Configuración del navbar -->
    <?php include '../../../Cliente/vistas/Cliente/headerCliente.php'; ?>

    <!--Pefil Cliente-->
    <body class="PerfilCliente">
        <section class="grid-container">
            <div class="icono">
                <i class="fa-solid fa-circle-user"></i>
            </div>
            <div class="nombre">
                <h1>Hola, <?php echo isset($row['NOMBRE']) ? htmlspecialchars($row['NOMBRE']) : ''; ?></h1>
            </div>
        </section>

        <main class="grid-container">
            <section class="perfil">
                <h1>Editar Cliente</h1>
                <br>
                <form method="POST" action="editar_cliente.php">
                    <label for="nombre">Nombre:</label>
                    <input type="text" name="nombre" id="nombre" value="<?php echo isset($row['NOMBRE']) ? htmlspecialchars($row['NOMBRE']) : ''; ?>" required>
                    <br>
                    <br>
                    <label for="apellido">Apellido:</label>
                    <input type="text" name="apellido" id="apellido" value="<?php echo isset($row['APELLIDO']) ? htmlspecialchars($row['APELLIDO']) : ''; ?>" >
                    <br>
                    <br>
                    <label for="numero_doc">Número de Documento:</label>
                    <input type="text" name="numero_doc" id="numero_doc" value="<?php echo isset($row['NUMERO_DOC']) ? htmlspecialchars($row['NUMERO_DOC']) : ''; ?>" required>
                    <br>
                    <br>
                    <label for="telefono">Número de Teléfono:</label>
                    <input type="text" name="telefono" id="telefono" value="<?php echo isset($row['TELEFONO']) ? htmlspecialchars($row['TELEFONO']) : ''; ?>">
                    <br>
                    <br>
                    <label for="correo">Correo Electrónico:</label>
                    <input type="email" name="correo" id="correo" value="<?php echo isset($row['CORREO']) ? htmlspecialchars($row['CORREO']) : ''; ?>" required>
                    <br>
                    <br>
                    <input type="submit" value="Guardar Cambios" class="guardar-button">
                </form>
            </section>
        </main>
        <br>
        <form id="cerrarSesionForm" action="../../../Servidor/PHP/Cliente/cerrarSesionCliente.php" method="post">
            <button type="button" class="cerrar-sesion-button" onclick="confirmarCerrarSesion()">Cerrar Sesión</button>
        </form>
        <br>
        <script>
            function confirmarCerrarSesion() {
                if (confirm("¿Estás seguro de que deseas cerrar la sesión?")) {
                    document.getElementById("cerrarSesionForm").submit();
                }
            }
        </script>
    </body>

    <!-- Footer -->
    <iframe src="../../../Cliente/vistas/Cliente/footer.php" frameborder="0" scrolling="no" width="100%" height="320px"></iframe>
</body>

</html>
