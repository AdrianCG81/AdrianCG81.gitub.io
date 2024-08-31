<?php
include 'conexion.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $folio = $_POST['folio'];
    $titulo = $_POST['titulo'];
    $autor = $_POST['autor'];
    $precio =  $_POST['precio'];
    $fecha = $_POST['fecha'];

    $sql = "UPDATE pedidos SET TituloLibro = :titulo, Autor = :autor, Precio = :precio, FechaPedido = :fecha WHERE FolioPedido = :folio";
    
    $stmt = $con->prepare($sql);

    $stmt->bindParam(':titulo', $titulo);
    $stmt->bindParam(':autor', $autor);
    $stmt->bindParam(':precio', $precio);
    $stmt->bindParam(':fecha', $fecha);
    $stmt->bindParam(':folio', $folio);

    if ($stmt->execute()) {
        echo '<script>
                    alert("Datos modificados");
                        setTimeout(function() {
                              window.location.href = "verPedidos.php";
                     }, 700);
              </script>';
    } else {
        echo "Error al actualizar los datos";
    }
}


?>
