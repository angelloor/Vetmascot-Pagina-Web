<?php

  session_start();

  require 'conexion.php';

  if (!empty($_POST['correo']) && !empty($_POST['clave'])) {
    $records = $conn->prepare('SELECT id, correo, clave FROM usuarios WHERE correo = :correo');
    $records->bindParam(':correo', $_POST['correo']);
    $records->execute();
    $results = $records->fetch(PDO::FETCH_ASSOC);

    $message = '';

    if (count($results) > 0 && password_verify($_POST['clave'], $results['clave'])) {
      $_SESSION['user_id'] = $results['id'];
      header("Location: /vetmascot/account.php");
    } else {
      $message = 'Usuario o Contraseña Incorrecto';
    }
  }
  $conn=null;
?>

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
  <title>Login</title>
</head>
<body>
    <header class="header">
        <div class="container">
          <figure class="logo">
            <img src="img/logo.png" height="100" alt="Logo de la institucion" />
          </figure>
        </div>
    </header>
    <div class="contenedor_mensaje">
      <?php if(!empty($message)): ?>
       <script>swal("<?= $message ?>");</script>
      <?php endif; ?>
    </div>
    <section class="login-list">
        <div class="container-login">
            <h1><strong>Inicia Sesión</strong></h1>
            <div id="logo" align="center">
                <img src="img/icono_login.png" width="150" height="140">
              </div>
            <form class="form_reg" action="login.php" method="POST" onsubmit="return validarLogin();">	
              <input class="input" type="text" name="correo" id="correo" placeholder="&#9993;Correo electrónico" >
              <input class="input" type="password" name="clave" id="clave" placeholder="&#8962;Contraseña" >
              <div class="btn_form">
                <input class="btn_submit" type="submit" value="Siguiente">
                <input class="btn_regresar" onclick="location.href='index.php';" type="button" value="Atrás">
              </div>	
              <div class="formfooter">
                <a class="underlineHover" href="register.php">No tienes cuenta, Regístrate. </a>
                <a class="underlineHover" href="reset.php">¿Olvidaste la contraseña?</a>
              </div>
            </form>
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