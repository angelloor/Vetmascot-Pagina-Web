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
  <title>Centro de Mascotas</title>
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
               <strong> Centro de Mascotas</strong> 
            </h1>
        </div>
    </section>
    <section class="container-slider">
        <div class="slider">
          <ul>
            <li><img src="img/slider/perros.jpg" alt="" width="1000" height="400"></li>
            <li><img src="img/slider/once.jpg" alt="" width="1000" height="400"></li>
            <li><img src="img/slider/tres.jpg" alt="" width="1000" height="400"></li>
            <li><img src="img/slider/cuatro.jpg" alt="" width="1000" height="400"></li>
            </ul>
        </div>
      </section>
      <section id="eventos" class="event-list">
          <div class="container">
            <article class="event">
              <div class="event-detail">
                 <h3 class="event-title"> <strong>Misión</strong></h3>
                 <p ALIGN="justify" class="event-description">El desarrollo del software se dedica al sector veterinario para brindar un bienestar en la alimentación de los animales. Además, el alimentador automatizado propuesto trata de  establecer ahorro de tiempo para el propietario y control sobre la salud de su mascota. Con lo cual, se innova una tecnología accesible y fácil de usar para mantener una voluntad constante sobre el cuidado de los animales. </p>
              </div>
            </article>
            <article class="event">
                <div class="event-detail">
                   <h3 class="event-title"><strong>Visión</strong></h3>
                   <p ALIGN="justify" class="event-description">Queremos estar comprometidos con los problemas de nuestros clientes de forma transparente y eficaz para convertirnos en su socio de confianza. En nuestra visión queremos ser una empresa de referencia, que camina con el cambio de la tecnología y la sociedad, dando a conocer las posibilidades de los estándares y tecnologías libres. Esta labor se debe desempeñar de forma ética y satisfactoria para nosotros, nuestros clientes y el resto de la sociedad.</p>
                </div>
              </article>
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