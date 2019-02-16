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
  <title>Ubicación</title>
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
    <section class="centro-container">
        <div>
            <h1>
               <strong>Ubicación</strong> 
            </h1>
        </div>
    </section>
    <section class="container-ubicacion">
      <div class="ubicacion">
          <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3988.4742421161322!2d-78.00017138541769!3d-1.4872553362974739!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x91d3e0a00cf3315b%3A0xb17c9fe2e0c80642!2sUniversidad+Regional+Autonoma+de+Los+Andes+UNIANDES+Ext+Puyo!5e0!3m2!1ses-419!2sec!4v1547673780309" width="1000" height="700" frameborder="0" style="border:0" allowfullscreen></iframe>
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