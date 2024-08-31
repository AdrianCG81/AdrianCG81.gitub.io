<?php
include 'conexion.php'; 

if (isset($_POST['btnLog'])) {
    $usuario = $_POST['Usuario']; 
    $pass = $_POST['Contraseña'];

    $sql = "SELECT IDUsuario, Pass, TipoUsuario, Nombre FROM usuarios WHERE IDUsuario = :usuario";
    
    $stmt = $con->prepare($sql);
    $stmt->bindParam(':usuario', $usuario);
    $stmt->execute();

    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($result) {
        $idUsuario = $result['IDUsuario'];
        $dbPass = $result['Pass'];
        $tipoUsuario = $result['TipoUsuario'];
        $nombreUsuario = $result['Nombre'];

        if ($usuario == $idUsuario && $pass == $dbPass) {
            session_start();
            $_SESSION['TipoUsuario'] = $tipoUsuario;
            $_SESSION['IDUsuario'] = $idUsuario;
           echo '<script>
                    alert("Bienvenido '.$nombreUsuario.'");
                    setTimeout(function() {
                        window.location.href = "index.php";
                    }, 700);
                  </script>';
            exit();
        } else {
            echo 'Usuario o contraseña incorrectos';
        }
    } else {
        echo 'Usuario no encontrado';
    }

    $stmt->closeCursor();
}
?>
