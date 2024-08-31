<?php
    session_start();
    include 'conexion.php';
    $usuario = $_SESSION['IDUsuario'];

    $sql_usuario = "SELECT * FROM usuarios WHERE IDUsuario = :usuario";
    $stmt_usuario = $con->prepare($sql_usuario);
    $stmt_usuario->bindParam(':usuario', $usuario);
    $stmt_usuario->execute();
    
    $usuario_info = $stmt_usuario->fetch(PDO::FETCH_ASSOC);

    if ($usuario_info) {
        
        $id_usuario = $usuario_info['IDUsuario']; 
        $sql_pedidos = "SELECT FolioPedido, idLibro, TituloLibro, Autor, Precio, FechaPedido FROM pedidos WHERE IDusuario = :id_usuario"; 
        $stmt_pedidos = $con->prepare($sql_pedidos);
        $stmt_pedidos->bindParam(':id_usuario', $id_usuario);
        $stmt_pedidos->execute();
        
        $_SESSION['pedidos'] = $stmt_pedidos->fetchAll(PDO::FETCH_ASSOC);
        $_SESSION['usuario_info'] = $usuario_info; 
        
        header('Location: pedidosUsuario.php');
        exit();
    } else {
        echo 'Usuario no encontrado.';
    }
?>