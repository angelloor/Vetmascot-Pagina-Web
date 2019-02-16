<?php
  session_start();

  require 'conexion.php';

  if (isset($_SESSION['user_id'])) {
    $records = $conn->prepare('SELECT id, nombre, correo, clave FROM usuarios WHERE id = :id');
    $records->bindParam(':id', $_SESSION['user_id']);
    $records->execute();
    $results = $records->fetch(PDO::FETCH_ASSOC);

    $user = null;

    if (count($results) > 0) {
      $user = $results;
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
  <script src="js/contacto.js"></script>
  <title>Contacto</title>
</head>
<body>
    <header class="header">
        <div class="container">
          <figure class="logo">
            <img src="img/logo.png" height="100" alt="Logo de la institucion" />
          </figure>
          <nav class="menu">
            <ol>
              <li>
                <a class="link" href="index.php">Inicio</a>
              </li>
              <li>
                <a class="link" href="centro.php">Centro de Mascotas</a>
              </li>
              <li>
                <a class="link" href="catalogo.php">Catálogo</a>
              </li>
              <li>
                <a class="link" href="ubicacion.php">Ubicación</a>
              </li>
              <li>
                  <a class="link" href="contacto.php">Contacto</a>
              </li>
              <li><a href="#body" class="session-icono"></a>
              <?php if(!empty($user)): ?>
                <ul class="submenu">
                  <li><a href="account.php"><?php if(!empty($user)): ?>Bienvenido. <?= $user['nombre']; ?><?php endif; ?></a></li>
                  <li><a href="#"><?php if(!empty($user)): ?><?= $user['correo']; ?><?php endif; ?></a></li>
                  <li><a href="logout.php">Cerrar sesión</a></li>
                </ul>
              <?php else: ?>
                <ul class="submenu">
                  <li><a href="login.php">Inciar sesión</a></li>
                </ul>
              <?php endif; ?>
              </li>
            </ol>
          </nav>
        </div>
    </header>
    <section class="contact-list">
        <div class="container-contacto">
            <h1><strong>Contacto</strong> </h1>
            <div id="logo" align="center">
                <img src="img/favicon.png" width="150" height="140">
              </div>
            <form class="form_reg" action="contacto.php" method="POST" onsubmit="return validar();">	
              <div class="btn_form">
              <input class="input" type="text" name="nombre" id="nombre" placeholder="&#128100;Nombre" require>
              <input class="input" type="text" name="correo" id="correo" placeholder="&#9993;Correo electrónico" require>
              <input class="input" type="text" name="telefono" id="telefono" placeholder="&#8962;Teléfono" require>
              <textarea class="input" name="mensaje" id="mensaje" cols="30" rows="10" placeholder="&#8962;Mensaje" require></textarea>
              </div>
              <div class="btn_form">
                <input class="btn_submit_contacto" type="submit" value="Enviar">
                <input class="btn_regresar_contacto" onclick="location.href='index.php';" type="button" value="Atrás">
              </div>	
            </form>
            <?php 	
            include 'conexion.php';
            if (isset($_POST['nombre'],$_POST['correo'],$_POST['telefono'],$_POST['mensaje'])) {
              $nombre = $_POST['nombre'];
              $correo = $_POST['correo'];
    			    $telefono = $_POST['telefono'];
    			    $mensaje = $_POST['mensaje'];
    			    $sql_insertar = "INSERT INTO contacto(nombre,correo,telefono,mensaje) VALUES('$nombre','$correo','$telefono','$mensaje')";
				      $ejecutar = $conn->prepare($sql_insertar);
              $ejecutar->execute();
              $conn=null;
            }
            ?>
        </div>
        <div class="container_contacto">
          <div class="producct-details">
                    <h3 class="product-title">Contactos</h3>
                    <p class="product-description">
Llámanos a los números 0987066849//0998679628 <br/> Horarios de lunes a viernes de 9:00 a 18:00 y sábados de 9:00 a 12:00 <br/>
Estaremos encantados de atenderte!!<br/> teamuniandes@gmail.com
                    </p>
          </div>
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