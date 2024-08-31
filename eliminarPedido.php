<?php
include 'conexion.php';

if (isset($_POST['btnEliminar'])) {
    $folio = $_POST['folio'];

    // Prepara la sentencia SQL para eliminar el registro
    $sql = "DELETE FROM pedidos WHERE FolioPedido = :folio";

    // Prepara la consulta
    $stmt = $con->prepare($sql);

    // Vincula el valor del folio al parámetro
    $stmt->bindParam(':folio', $folio);

    // Ejecuta la consulta
    if ($stmt->execute()) {
        echo '<script>
                    alert("Pedido Eliminado");
                        setTimeout(function() {
                              window.location.href = "verPedidos.php";
                     }, 700);
              </script>';
    } else {
        echo "Error al eliminar el pedido";
    }
}
?>
