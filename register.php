<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link href="https://fonts.googleapis.com/css?family=Fjalla+One|Source+Sans+Pro" rel="stylesheet">
  <link rel="icon" href="img/favicon.png">
  <link rel="stylesheet" href="css/estilos.css">
  <link rel="stylesheet" type="text/css" href="css/sweetalert.min.css">
  <script src="js/sweetalert.min.js"></script>
  <script src="js/validar.js"></script>
  <title>Registrarse</title>
</head>
<body>
    <header class="header">
        <div class="container">
          <figure class="logo">
            <img src="img/logo.png" height="100" alt="Logo de la institucion" />
          </figure>
        </div>
    </header>
    <section class="titulo-login">
        <div>
        </div>
    </section>
    <section class="register-list">
        <div class="container-register">
            <h1><strong>Registro</strong></h1>
            <div id="logo" align="center">
                <img src="img/icono_login.png" width="150" height="140">
            </div>
            <form class="form_reg" action="register.php" method="POST" onsubmit="return validarRegister();">	
                <input class="input" type="text" name="nombre" id="nombre" placeholder="&#128100;Nombre">
                 <input class="input" type="text" name="direccion" id="direccion" placeholder="&#128441;Dirección">
                 <input class="input" type="text" name="telefono" id="telefono" placeholder="&#12848;Teléfono">
                 <input class="input" type="text" name="correo" id="correo" placeholder="&#9993;Correo electrónico">             
                 <input class="input" type="password" name="clave" id="clave" placeholder="&#8962;Contraseña">
              <div class="btn_form">
                <input class="btn_submit" type="submit" value="Enviar">
              </div>
              <div class="formfooter">
                <a class="underlineHover" href="login.php">Ir a iniciar sesión</a>
              </div>	
            </form>
            <?php 	   
            include 'conexion.php';
            if (isset($_POST['nombre'],$_POST['direccion'],$_POST['telefono'],$_POST['correo'],$_POST['clave'])) {     
                $nombre = $_POST['nombre'];
                $direccion = $_POST['direccion'];
                $telefono = $_POST['telefono'];
                $correo = $_POST['correo'];
                $clave = password_hash($_POST['clave'], PASSWORD_BCRYPT);
                
                $result=FALSE;

                try {
                  $records = $conn->prepare('SELECT * FROM usuarios WHERE correo = :correo');
                  $records->bindParam(':correo', $correo);
                  $records->execute();
                  $results = $records->fetch(PDO::FETCH_ASSOC);
                  if ($results > 0) {
                    $result = TRUE;
                    }
                } catch (Exception $e) {
                  echo 'Excepción capturada: ',  $e->getMessage(), "\n";
                }
                if ($result == TRUE) {
                  echo "<script>";
                  echo "swal({
                    text: 'Usuario Existente!',
                    icon: 'error',
                    button: 'Ok!',
                  });";
                  echo "</script>";
                }else {
                  $sql_insertar = "INSERT INTO usuarios(nombre,direccion,telefono,correo,clave) VALUES('$nombre','$direccion','$telefono','$correo','$clave')";
		              $ejecutar = $conn->prepare($sql_insertar);
                  $ejecutar->execute();
                  $conn=null;
                  //ejecutar codigo js en php
                  echo "<script>";
                  echo "swal({
                    text: 'Usuario Registrado!',
                    icon: 'success',
                    button: 'Ok!',
                  });";
                  echo "</script>";
                }
            }
            ?>
        </div>
    </section>
    <footer class="footer">
        <div class="container">
            <div>
              <p>©Uniandes 2019. Todos los derechos reservados.</p>
            </div>
            <div>
              <p class="tag">
                Designed with <img src="img/love.png" width="30" alt="logo"> by <a href="https://www.facebook.com/miguelangelloor96">@TeamUniandes</a>
              </p>
            </div>
            <div class="contacto">
                <a href="https://twitter.com/TUniandes?fbclid=IwAR0VYV4sawn0FOC-_RtpTuKrRBnXXqmYb2TgaDU438thxkphuOZp6IQFZgk" class="social-link twitter"></a>
                <a href="https://www.facebook.com/TeamUniandes-2448538085174816/?modal=admin_todo_tour" class="social-link facebook"></a>
                <a href="https://www.instagram.com/Team_Uniandes/?fbclid=IwAR0Tc8-LExwKJYX2uJjWC9ctKtmpY01qORnMGPZJAtfWaJnY04hW33djrh8" class="social-link instagram"></a>
            </div>
          </div>
    </footer>
</body>
</html>