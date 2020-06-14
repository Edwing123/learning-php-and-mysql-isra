<?php 
require_once("connection.php");



// start session
session_start();

// close-session

if (isset($_GET["close-session"])) {
    session_unset();
    session_destroy();
}


// roles 
if (isset($_SESSION["role"])) {
    switch ($_SESSION["role"]) {
        case 1:
            # code...
            header("location: administrador");
            break;
        
        case 2:
            header("location: colaborador");
            break;
        default:
            # code...
            break;
    }
}


// authentication
if (isset($_POST["email"]) && isset($_POST["password"])) {
    $email = $_POST["email"];
    $password = $_POST["password"];

    $query = "SELECT * FROM users WHERE email='$email' AND password='$password'";
    $result = mysqli_query($db, $query);
    $users_array = mysqli_fetch_array($result);
  
    if ($result) {
        $_SESSION["role"] = $users_array["7"];
        $_SESSION["name"] = $users_array["1"];

        // redirect user based on the role
        $session_role = $_SESSION["role"];

        if (isset($session_role)) {
            switch ($session_role) {
                case 1:
                    # code...
                    header("location: administrador");
                    break;
                
                case 2:
                    header("location: colaborador");
                    break;
                default:
                    # code...
                    break;
            }
        }
    } else {
        echo '<script type="text/javascript">
        alert("email or password incorrect, please try again");
        </script>';
    }
}
?>

<!doctype html>
<html lang="es">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">

        <title>Login</title>
    </head>
    <body>
        <div class="container my-3">
            <h2>Iniciar Sesión</h2>

            <div class="my-3">
                <form action="" method="POST">
                    <div class="row">
                        <div class="col form-group">
                            <label for="nombre">Correo</label>
                            <input type="email" class="form-control" name="email" placeholder="Ingrese correo">
                        </div>
                        
                    </div>

                    <div class="row">
                        <div class="col form-group">
                            <label for="nombre">Contraseña</label>
                            <input type="password" class="form-control" name="password" placeholder="Ingrese contraseña">
                        </div>
                    </div>

                    <div class="row">
                        <div class="col form-group">
                            <input type="submit" class="btn btn-primary" name="submit" value="Iniciar Sesión">
                        </div>
                    </div>
                    
                </form>
            </div>

            <a href="../"> <button class="btn btn-danger">Cancelar</button></a>
        </div>

        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
    </body>
</html>