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
                <a class="link" href="index.php"><strong>Inicio</strong></a>            
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

    <section class="account">
        <div class="container-account">
            <h1><strong>Estado Sensores</strong> </h1>
            <div id="logo" align="center">
                <img src="img/favicon.png" width="150" height="140">
        
        
        <table>
            <tr>
              <td>Id</td>
              <td>Alimentador</td>
              <td>Estado</td>
              <td>Fecha</td>
            </tr>

            <?php
               require 'conexion.php';
               
               $records = $conn->prepare('SELECT * FROM sensor');
               $records->execute();
               $result = $records->fetch(PDO::FETCH_ASSOC);
               
               foreach($records as $fila): ?>
               <tr>
                 <td><?php echo $fila[0]; ?></td>
                 <td><?php echo $fila[1]; ?></td>
                 <td><?php echo $fila[2]; ?></td>
                 <td><?php echo $fila[3]; ?></td>
               </tr>
               <?php endforeach ?>
  
          </table>
        </div>
        <input class="event-url" type="button" value="Activar" onclick="">
        </div>
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