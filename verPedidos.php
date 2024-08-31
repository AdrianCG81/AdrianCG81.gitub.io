<?php
session_start();
include 'conexion.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Seleccionar cliente</title>
    <style>
        html,
        body {
            margin: 1px;
            border: 0;
            text-align: center;
        }

        .formulario {
            margin-top: 90px;
        }
    </style>
</head>
<body>
<nav class="navbar">
        <a class="navbar-brand" href="index.php">El Tesoro del Saber</a>
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" href="index.php">Inicio</a>
            </li>
            <li class="nav-item">
                <label for="">consultar</label>
            </li>
            <li class="nav-item">
            <a class="nav-link" href="registrarPedido.php">Registrar</a>
            </li>
            <li class="nav-item">
                <form action="logout.php" method="POST">
                    <button class="btnLogout" name="btnLogout">Salir</button>
                </form>
            </li>
        </ul>
    </nav>
    <h4>Selecciona el IDUsuario del cliente</h4>
    <form action="consultarPedidos.php" method="post">
<select name="usuario" id="usuario">
            <?php
            $sql = "SELECT IDUsuario FROM usuarios";
            $stmt = $con->prepare($sql);
            $stmt->execute();
            
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                echo '<option value="' . htmlspecialchars($row['IDUsuario']) . '">' . htmlspecialchars($row['IDUsuario']) . '</option>';
            }
            ?>
        </select>
        <br>
        <br>
<button name="btnConsulta" type="submit" >Consultar</button>
</form>
</body>
</html>