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
  <script src="js/sweetalert.min.js"></script>
  <script src="js/mensajes.js"></script>
  <title>Catalogo</title>
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
               <strong>Catalogo</strong> 
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
      <div class="container-product">
          <h1><strong>Pet's Feeder</strong></h1>
          <article class="product">
              <div class="producct-details">
                <h3  class="product-title">Funcionamiento del Sistema</h3>
                <p ALIGN="justify" class="product-description">Es un distribuidor de 10 kg de alimento para perro el cual funciona automáticamente después de su configuración, con el podremos recibiremos información sobre el alimento disponible, que cantidad de alimento se ha distribuido entre otros puntos importantes para tener un mejor control de la alimentación de nuestro perro.</p>
              </div>
            </article>
      </div>
      <div class="container-product">
        <h1><strong>Planes</strong></h1>        
      </div>
      <section id="eventos" class="event-list">
          <div class="container_catalogo">
            <article class="event">
              <figure class="event-imageContainer">
                 <img class="event-image" src="img/31.png" width="100" />
              </figure>
              <div class="event-detail">
                 <h3 class="event-title">Plan Basico</h3>
                 <p class="event-description">
                * activaciones limitadas<br/>
                * programación de horas limitadas<br/>
                * activa el alimentador desde cualquier lugar<br/>
                * Acceso a las actualizaciones del sistema<br/>
                * tiempo 31 días

                 </p>
                 <input class="event-url" type="button" value="¡Empieza Ahora!" onclick="planBasic()">
              </div>
            </article>
          </div>
            <div class="container_catalogo">
                <article class="event">
                  <figure class="event-imageContainer">
                     <img class="event-image" src="img/365.png" width="500" />
                  </figure>
                  <div class="event-detail">
                     <h3 class="event-title">Plan Experto</h3>
                     <p class="event-description">
                     * activaciones ilimitadas<br/>
                * programación de horas ilimitadas<br/>
                * activa el alimentador desde cualquier lugar<br/>
                * Acceso a las actualizaciones del sistema<br/>
                * activación desde la página web <br/>
                * tiempo 365 días
                     
                     </p>
                     <input class="event-url" type="button" value="¡Empieza Ahora!" onclick="planExpert()">
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