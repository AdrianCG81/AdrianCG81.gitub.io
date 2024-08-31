<?php
include 'conexion.php';

if (isset($_POST['btnGuardar'])) {
    $idUsuario = $_POST['IDUsuario'];
    $nombre = $_POST['Nombre'];
    $apellido1 = $_POST['ApellidoPaterno'];
    $apellido2 = $_POST['ApellidoMaterno'];
    $edad = $_POST['Edad'];
    $sexo = $_POST['Sexo'];
    $correo = $_POST['Email'];
    $telefono = $_POST['Telefono'];
    $pass = $_POST['Password'];

    if (
        !empty($idUsuario) && !empty($nombre) && !empty($apellido1) && !empty($apellido2) &&
        !empty($edad) && !empty($sexo) && !empty($correo) && !empty($telefono) && !empty($pass)
    ) {

        // Verificar si el IDUsuario ya existe
        $sql_check = "SELECT COUNT(*) FROM usuarios WHERE IDUsuario = :idUsuario";
        $stmt_check = $con->prepare($sql_check);
        $stmt_check->bindParam(':idUsuario', $idUsuario);
        $stmt_check->execute();
        $count = $stmt_check->fetchColumn();

        if ($count == 0) {
            // Validar contraseña
            if (
                strlen($pass) >= 8 &&
                preg_match('/[A-Za-z]/', $pass) &&
                preg_match('/\d/', $pass) &&
                preg_match('/[#\$\-_&%]/', $pass)
            ) {
                $hashed_pass = password_hash($pass, PASSWORD_DEFAULT);

                $sql = "INSERT INTO usuarios 
                        (IDUsuario, Nombre, ApellidoPaterno, ApellidoMaterno, Edad, Sexo, Email, Telefono, TipoUsuario, Pass)
                        VALUES 
                        (:idUsuario, :nombre, :apellido1, :apellido2, :edad, :sexo, :correo, :telefono, 'TL', :pass)";

                $stmt = $con->prepare($sql);
                $stmt->bindParam(':idUsuario', $idUsuario);
                $stmt->bindParam(':nombre', $nombre);
                $stmt->bindParam(':apellido1', $apellido1);
                $stmt->bindParam(':apellido2', $apellido2);
                $stmt->bindParam(':edad', $edad);
                $stmt->bindParam(':sexo', $sexo);
                $stmt->bindParam(':correo', $correo);
                $stmt->bindParam(':telefono', $telefono);
                $stmt->bindParam(':pass', $hashed_pass);

                if ($stmt->execute()) {
                    echo '<script>
                         alert("Operación realizada con éxito");
                                setTimeout(function() {
                                      window.location.href = "index.php";
                             }, 3000);
                         </script>';
                } else {
                    '<script>
                        alert("Error al realizar la operación");
                                window.history.back();
                      </script>';
                }
            } else {
                echo 'La contraseña debe tener al menos 8 caracteres, incluyendo letras, números y un carácter especial (#, $, -, _, &, %).';
            }
        } else {
            echo 'El IDUsuario ya existe. Por favor, elige otro IDUsuario.';
        }
    } else {
        echo 'Campos vacíos';
    }
}
