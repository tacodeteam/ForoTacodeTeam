<?php
//Creo que este código debería ir la parte de arriba de register.
//El include config.php igual se puede cambiar por conexionBD
include('config.php');
session_start();

if (isset($_POST['register'])) {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $password_hash = password_hash($password, PASSWORD_BCRYPT);

    $query = $connection->prepare("SELECT * FROM users WHERE EMAIL= :email");
    $query->bindParam("email", 
    $email, PDO::PARAM_STR);
    $query->execute();

    if ($query->rowCount() > 0) {
        echo '<p class = "error">El email ya está registrado</p>';
    }
    if ($query == 0) {
        $query = $connection->prepare("INSERT INTO users(USERNAME,PASSWORD,EMAIL) VALUES (:username,:password_hash,:email)");
        $query->bindParam("username", $username, PDO::PARAM_STR);
        $query->bindParam("password_hash", $password_hash, PDO::PARAM_STR);
        $query->bindParam("email", $email, PDO::PARAM_STR);
        $result = $query->execute();

        if ($result) {
            echo '<p class ="success">Cuenta creada con éxito</p>';
        } else {
            '<p class = "error"> Algo fue mal. Cuenta no creada</p>';
        }
    }
}

?>