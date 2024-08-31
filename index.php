<?php
session_start();

$rol = isset($_SESSION['TipoUsuario']) ? $_SESSION['TipoUsuario'] : null;

if ($rol == 'TL' || $rol == 'CL') {
?>
    <!DOCTYPE html>
    <html lang="es">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="style.css">
        <title>El Tesoro del Saber</title>
    </head>

    <body>
        <nav class="navbar">
            <a class="navbar-brand" href="#">El Tesoro del Saber</a>
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="index.php">Inicio</a>
                </li>
                <?php if ($rol == 'CL') { ?>
                    <li class="nav-item">
                        <a class="nav-link" href="mostrarPedidosUsuario.php">Consultar</a>
                    </li>
                <?php   } ?>
                <?php if ($rol == 'TL') { ?>
                    <li class="nav-item">
                        <a class="nav-link" href="verPedidos.php">Consultar</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="registrarPedido.php">Registrar</a>
                    </li>
                <?php   } ?>
                <li class="nav-item">
                    <form action="logout.php" method="POST">
                        <button class="btnLogout" name="btnLogout">Salir</button>
                    </form>
                </li>
            </ul>
        </nav>
    </body>

    </html>
<?php
} else {
?>
    <!DOCTYPE html>
    <html lang="es">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="style.css">
        <title>El Tesoro del Saber</title>
    </head>

    <body>
        <nav class="navbar">
            <a class="navbar-brand" href="#">El Tesoro del Saber</a>
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="index.php">Inicio</a>
                </li>
                <li class="nav-item">
                    <button class="btnLog" onclick="redirect()">Inicia sesion</button>
                    <button class="btnLog" onclick="redirect2()">Registrate</button>

                </li>
            </ul>
        </nav>
        <script>
            function redirect() {
                window.location.href = 'login.html';
            }

            function redirect2() {
                window.location.href = 'registro.html';
            }
        </script>
    </body>

    </html>
<?php
}
?>