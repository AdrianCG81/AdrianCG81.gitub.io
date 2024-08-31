<?php
include 'conexion.php';
date_default_timezone_set('America/Monterrey');

if (isset($_POST['btnGuardar'])) {
    $idUsuario = $_POST['usuario'];
    $titulo = $_POST['Titulo'];
    $autor = $_POST['Autor'];
    $precio = $_POST['Precio'];
    $fecha = date('Y-m-d');

    $sql = "INSERT INTO pedidos (IDusuario, TituloLibro, Autor, Precio, FechaPedido) 
            VALUES (:idUsuario, :titulo, :autor, :precio, :fecha)";

    $stmt = $con->prepare($sql);
    $stmt->bindParam(':idUsuario', $idUsuario);
    $stmt->bindParam(':titulo', $titulo);
    $stmt->bindParam(':autor', $autor);
    $stmt->bindParam(':precio', $precio);
    $stmt->bindParam(':fecha', $fecha);

    if ($stmt->execute()) {
        echo '<script>
                    alert("Registro completo");
                        setTimeout(function() {
                              window.location.href = "index.php";
                     }, 700);
              </script>';
    } else {
        echo "Error al guardar los datos.";
    }
}
