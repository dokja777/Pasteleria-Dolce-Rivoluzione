<?php
$token = $_GET["token"];
$token_hash = hash("sha256", $token);
?>

<!DOCTYPE html>
<html>

<head>
  <title>Reset Password</title>
  <meta charset="UTF-8">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/water.css@2/out/water.css">
  <link rel="stylesheet" href="../../../Cliente/css/reestablecimientoContra.css">
  
</head>

<body>

  <h1>Reestablecer Contraseña</h1>

  <form method="post" action="../../../Servidor/PHP/Cliente/passwordReset.php">

    <input type="hidden" name="token" value="<?= htmlspecialchars($token) ?>">

    <label for="password">Nueva contraseña</label>
    <input type="password" id="password" name="password" required>

    <label for="password_confirmation">Repita la contraseña</label>
    <input type="password" id="password_confirmation" name="password_confirmation" required>

    <button>Enviar</button>
  </form>

</body>

</html>