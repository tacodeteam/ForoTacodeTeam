<html>

<head>
    <title>Loguearse</title>
    <link rel="stylesheet" type="text/css" media="screen" href="estilo.css" />
</head>

<body>
    <?php
    $enviar = false;
    include('conexionBD.php');//igual se podría cambiar por conexionBD
    session_start();

    if (isset($_POST['login'])) {
        $username = $_POST['username'];
        $password = $_POST['password'];
        //$query = $connection->prepare("SELECT FROM users WHERE username =$username AND password = $password");
       
        $query = $connection-> prepare('SELECT * FROM users');
        /*$query->bindParam("username", $username, PDO::PARAM_STR);
        $query->bindParam("password", $password, PDO::PARAM_STR);*/
        $query->setFetchMode(PDO::FETCH_ASSOC);
        //$result = $query->fetch(PDO::FETCH_ASSOC);
        $query->execute();
        while ($row=$query->fetch()){
            if ($row["username"]== $username && password_verify($password,$row["password"]))
           
                 header("Location: index.php");
            else 
            echo "Usuario NO ENCONTRADO";

                    
        }
       /* if ($result==0){
            echo '<p class = "error"> Usuario o clave erróneos </p>';
        }else {
            if (password_verify($password,$result['PASSWORD'])){
                $_SESSION['user_id'] = $result['ID'];
                echo '<p class = "success"> Enhorabuena, ya estás logeado</p>';


            }else {
                echo '<p class = "error"> Usuario o Contraseña erróneos</p>'; 
            }
        }*/
   }
?>
    <form method="post" action="" name="login_form">
        <div class="element_form">
            <label>Usuario</label>
            <input type="text" name="username" pattern="[a-zA-Z0-9]+" required />
        </div>
        <div class="element_form">
            <label>Password</label>
            <input type="text" name="password" required />
        </div>
        <button type="submit" name="login" value="login">Inicia Sesión</button>
    </form>
</body>

</html>