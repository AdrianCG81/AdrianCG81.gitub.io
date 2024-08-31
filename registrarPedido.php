<?php
include 'conexion.php';
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Registrar</title>
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
                <a class="nav-link" href="verPedidos.php">Consultar</a>
            </li>
            <li class="nav-item">
                <label for="">Registrar</label>
            </li>            
            <li class="nav-item">
                <form action="logout.php" method="POST">
                    <button class="btnLogout" name="btnLogout">Salir</button>
                </form>
            </li>
        </ul>
    </nav>
        <form action="registrarP.php" method="post">
    <section class="formulario">
        <h2>Ingresa los datos para registrar el pedido</h2><br><br>
        <label for="">IDUsuario</label>
        <select name="usuario" id="usuario">
            <?php
            $sql = "SELECT IDUsuario FROM usuarios";
            $stmt = $con->prepare($sql);
            $stmt->execute();

            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                echo '<option value="' . htmlspecialchars($row['IDUsuario']) . '">' . htmlspecialchars($row['IDUsuario']) . '</option>';
            }
            ?>
        </select><br><br>
        <input type="text" name="Titulo" id="Titulo" placeholder="Ingresa El titutlo del libro"><br><br>
        <input type="text" name="Autor" id="Autor" placeholder="Ingresa el autor"><br><br>
        <input type="text" name="Precio" id="Precio" placeholder="Ingresa el precio"><br><br>

    </section>
    <input type="submit" name="btnGuardar" value="Guardar" />
    </form>
</body>

</html>