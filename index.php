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
  <title>VetMascot</title>
</head>
<body id="body">
    <header class="header">
        <div class="container">
          <figure class="logo">
            <img src="img/logo.png" height="100" alt="Logo de la institucion" />
          </figure>
          <nav class="menu">
            <ol>
              <li>
                <a class="link" href="#body"><strong>Inicio</strong></a>            
              </li>
              <li>
                <a class="link" href="centro.php"><strong>Centro de Mascotas</strong></a>
              </li>
              <li>
                <a class="link" href="catalogo.php"><strong>Catálogo</strong></a>
              </li>
              <li>
                <a class="link" href="ubicacion.php"><strong>Ubicación</strong></a>
              </li>
              <li>
                  <a class="link" href="contacto.php"><strong>Contacto</strong></a>
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
    <section class="hero">
      <div class="container">
        <h1>
           Te Presentamos <strong> a Pet's Feeder</strong> <br/> Alimentador para mascotas  <br/><strong> Unete </strong> a la <br> comunidad <strong>!!!</strong>
        </h1>
          <img class="hero-image" src="img/hero.png" width="400" height="300" alt="imagen principal del sitio"> 
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
  <section id="intro" class="intro">
    <div class="container-product">
      <h2>Acerca de</h2>
      <article class="product">
          <div class="producct-details">
            <h3 class="product-title">Alimentador Automático De Perros V 1.0</h3>
            <p ALIGN="justify" class="product-description">Te damos la bienvenida a Pet’s Feeder, alimentador inteligente de mascotas, el será tu aliado en la alimentación de tus mascotas, su funcionamiento es simple, pero de gran ayuda con solo llenar el recipiente de almacenaje de comida y programar la hora de comer tendrás que despreocuparte y con las alarmas de nivel de alimento lo único que tendrás que hacer es ir a comprar comida y verterla en Pet’s Feeder, alimentador inteligente de mascotas.
</p>
          </div>
          <figure class="product-imageContainer">
            <img class="product-image" width="500" src="img/acercade.png" alt="imagen producto">
          </figure>
        </article>
    </div>
  <section id="eventos" class="event-list">
    <div class="container">
      <article class="event">
        <figure class="event-imageContainer">
           <img class="event-image" src="img/dos.png" width="500" />
        </figure>
        <div class="event-detail">
           <h3 class="event-title">Sólo una nutrición adaptada puede satisfacer sus necesidades</h3>
           <p class="event-description">Cada tipo de perro, según su tamaño o raza y edad, tiene diferentes características, y en VetMascot estamos comprometidos con cada uno de ellos, adaptándonos a sus necesidades nutricionales a lo largo de toda su vida.</p>
           <input class="event-url" type="button" value="Ver Mas" onclick="mensajeIndex()">
      
        </div>

      </article>
    </div>
  </section>  
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