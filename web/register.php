<html>

<head>
    <title>Registro</title>
    <link rel="stylesheet" type="text/css" media="screen" href="estilo.css" />
</head>

<body>
<?php
//Creo que este código debería ir la parte de arriba de register.
//El include config.php igual se puede cambiar por conexionBD
include('conexionBD.php');
session_start();

if (isset($_POST['register'])) {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $password_hash = password_hash($password, PASSWORD_BCRYPT);

    $query = $connection->prepare("SELECT * FROM users WHERE EMAIL= :email" );
    $query->bindParam("email", $email, PDO::PARAM_STR);
    $query->execute();

    if ($query->rowCount() > 0) {
        echo '<p class = "error">El email ya está registrado</p>';
    }else{
   // if ($query->rowCount()== 0) //Aquí estaba puesto ==0 pero tiraba error.
        $query = $connection->prepare("INSERT INTO users(USERNAME,PASSWORD,EMAIL) VALUES (:username,:password_hash,:email)");
        $query->bindParam("username", $username, PDO::PARAM_STR);
        $query->bindParam("password_hash", $password_hash, PDO::PARAM_STR);
        $query->bindParam("email", $email, PDO::PARAM_STR);
        $result = $query->execute();

        if ($result) {
            echo '<p class ="success">Cuenta creada con éxito</p>';
            header("Location: index.php");
        } else {
            '<p class = "error"> Algo fue mal. Cuenta no creada</p>';
        }
    }
}

?>
    <form method="POST" action="" name="regis_form">
        <div class="element_form">
            <label>Usuario</label>
            <input type="text" name="username" pattern="[a-zA-Z0-9]+" required />
        </div>
        <div class="element_form">
            <label> Email</label>
            <input type="email" name="email" required />
        </div>
        <div class="element_form ">
            <label>Password</label>
            <input type="password" name="password" required />
        </div>
        <button type="submit" name="register" value="register">Registro</button>
    </form>


</body>

</html>