<?php
session_start();

// Recuperar los pedidos y la información del usuario desde la sesión
$pedidos = isset($_SESSION['pedidos']) ? $_SESSION['pedidos'] : [];
$usuario_info = isset($_SESSION['usuario_info']) ? $_SESSION['usuario_info'] : [];

if (empty($pedidos) && empty($usuario_info)) {
    echo 'No hay datos para mostrar.';
    exit();
}

unset($_SESSION['pedidos']); 
unset($_SESSION['usuario_info']);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pedidos del Cliente</title>
    <link rel="stylesheet" href="style.css">
    <style>
        /* Estilos para el modal */
        .modal {
    display: none;
    position: fixed;
    z-index: 1;
    left: 0;
    top: 0;
    width: 100%;
    height: 100%;
    overflow: auto;
    background-color: rgba(0, 0, 0, 0.5);
    padding-top: 60px;
}

.modal-content {
    background-color: #fefefe;
    margin: auto;
    padding: 20px;
    border: 1px solid #888;
    width: 50%; 
    max-width: 400px; 
    border-radius: 10px; 
    box-shadow: 0 5px 15px rgba(0,0,0,0.3); 
    text-align: center; 
}

.modal-content input[type="text"],
.modal-content button {
    width: 80%; 
    margin: 10px 0; 
}

.close {
    color: #aaa;
    float: right;
    font-size: 28px;
    font-weight: bold;
    margin-top: -20px; 
}

.close:hover,
.close:focus {
    color: black;
    text-decoration: none;
    cursor: pointer;
}
    </style>
</head>
<body>
    <h1>Pedidos del Cliente</h1>
    
    <?php if ($usuario_info): ?>
        <h2>Información del Usuario</h2>
        <p>ID Usuario: <?php echo htmlspecialchars($usuario_info['IDUsuario']); ?></p>
        <p>Nombre: <?php echo htmlspecialchars($usuario_info['Nombre']); ?></p>
        <p>Apellido Paterno: <?php echo htmlspecialchars($usuario_info['ApellidoPaterno']); ?></p>
        <p>Apellido Materno: <?php echo htmlspecialchars($usuario_info['ApellidoMaterno']); ?></p>
    <?php endif; ?>

    <h2>Pedidos</h2>
    <?php if (!empty($pedidos)): ?>
        <table border="1">
            <thead>
                <tr>
                    <th>Folio</th>
                    <th>Título</th>
                    <th>Autor</th>
                    <th>Precio</th>
                    <th>Fecha</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($pedidos as $pedido): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($pedido['idLibro']); ?></td>
                        <td><?php echo htmlspecialchars($pedido['TituloLibro']); ?></td>
                        <td><?php echo htmlspecialchars($pedido['Autor']); ?></td>
                        <td><?php echo htmlspecialchars($pedido['Precio']); ?></td>
                        <td><?php echo htmlspecialchars($pedido['FechaPedido']); ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php else: ?>
        <p>No hay pedidos para mostrar.</p>
    <?php endif; ?>

    <!-- Modal para modificar pedidos -->
    <div id="modificarModal" class="modal">
    <div class="modal-content">
        <span class="close" onclick="closeModal()">&times;</span>
        <h2>Modificar Pedido</h2>
        <form action="modificarPedido.php" method="post">
            <input type="hidden" name="folio" id="modal-folio">
            <input type="text" name="titulo" id="modal-titulo" placeholder="Título del libro"><br>
            <input type="text" name="autor" id="modal-autor" placeholder="Autor"><br>
            <input type="text" name="precio" id="modal-precio" placeholder="Precio"><br>
            <input type="text" name="fecha" id="modal-fecha" placeholder="Fecha (YYYY-MM-DD)"><br>
            <button type="submit" name="btnGuardar">Guardar Cambios</button>
        </form>
    </div>
</div>

    <script>
        function openModal(folio, titulo, autor, precio, fecha) {
            document.getElementById('modal-folio').value = folio;
            document.getElementById('modal-titulo').placeholder = titulo;
            document.getElementById('modal-autor').placeholder = autor;
            document.getElementById('modal-precio').placeholder = precio;
            document.getElementById('modal-fecha').placeholder = fecha;
            document.getElementById('modificarModal').style.display = "block";
        }

        function closeModal() {
            document.getElementById('modificarModal').style.display = "none";
        }

        window.onclick = function(event) {
            if (event.target == document.getElementById('modificarModal')) {
                closeModal();
            }
        }
    </script>
</body>
</html>
