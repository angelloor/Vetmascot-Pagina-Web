<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="icon" href="img/favicon.png">
  <link rel="stylesheet" href="css/estilos.css">
  <link rel="stylesheet" type="text/css" href="css/sweetalert.min.css">
  <script src="js/sweetalert.min.js"></script>
  <script src="js/validar.js"></script>
  <title>VetMascot</title>
</head>
<body>
    <header class="header">
        <div class="container">
          <figure class="logo">
            <img src="img/logo.png" height="100" alt="Logo de la institucion" />
          </figure>
        </div>
    </header>
    <section class="login-list">
        <div class="container-reset">
            <h3><strong>¿Olvidaste tu contraseña?</strong></h3>
            <div id="logo" align="center">
                <img src="img/icono_login.png" width="150" height="140">
            </div>
            <form class="form_reg" action="reset.php" method="POST" onsubmit="return validarCorreo();" >	
            <h4>Te enviaremos un enlace a tu correo para que <br> puedas cambiar la contraseña</h4>
              <input class="input" type="text" name="correo" id="correo" placeholder="&#9993;Correo Electronico">
              <div class="btn_form">
                <input class="btn_submit" type="submit" value="Siguiente">
              </div>	
              <div class="formfooter">
                <a class="underlineHover" href="login.php">Ir a iniciar sesión</a>
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
<?php
  require 'conexion.php';
  if (isset($_POST['correo'])) {
    $correo = $_POST['correo'];
    $records = $conn->prepare('SELECT * FROM usuarios WHERE correo = :correo');
    $records->bindParam(':correo', $_POST['correo']);
    $records->execute();
    $results = $records->fetch(PDO::FETCH_ASSOC);

    if ($results > 0) {
      actualizarPassword($correo);
      echo "<script>";
      echo "swal({
          text: '!Contraseña Actualizada Correctamente!',
          icon: 'success',
          button: 'Ok!',
        });";
      echo "</script>";
    } else {
      echo "<script>";
      echo "swal({
          text: '!Usuario no registrado!',
          icon: 'error',
          button: 'Ok!',
        });";
      echo "</script>";
      }
    }
    $conn=null;
  
  use PHPMailer\PHPMailer\PHPMailer;
  use PHPMailer\PHPMailer\Exception;
  
  function actualizarPassword($correo){
    require 'vendor/autoload.php';
    //generador de codigo
  
    $mail = new PHPMailer(true);                              // Passing `true` enables exceptions
    $string = '123456789abcdefghijklmnopqrstuvwxyz123456789';
    $codigo ='';
    
    for($i=0; $i<=10; $i++){
      $codigo .=substr($string,rand(0,26),1);
    }
       try {
       //Server settings
       $mail->SMTPDebug = 0;                                 // Enable verbose debug output
       $mail->isSMTP();                                      // Set mailer to use SMTP
       $mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
       $mail->SMTPAuth = true;                               // Enable SMTP authentication
       $mail->Username = 'teamuniandes@gmail.com';                 // SMTP username
       $mail->Password = 'TeamUniandes2019';                           // SMTP password
       $mail->SMTPSecure = 'ssl';                            // Enable TLS encryption, `ssl` also accepted
       $mail->Port = 465;                                    // TCP port to connect to
   
       //Recipients
       $mail->setFrom('teamuniandes@gmail.com', 'VetMascot');
       $mail->addAddress($correo, 'Miguel Angel Loor Manzano');     // Add a recipient
   
       //Abjuntos
       //$mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
       //$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
   
       //Content
       $mail->isHTML(true);                                  // Set email format to HTML
       $mail->Subject = 'New Password';
       $mail->Body    = 'Contraseña Actualizada -> ' .$codigo;
       $mail->AltBody = 'cambie inmediatamente la contraseña';
   
       $mail->send();

       include 'conexion.php';
       $clave = password_hash($codigo, PASSWORD_BCRYPT);
       $sql_insertar = "UPDATE usuarios SET clave='$clave' WHERE correo='$correo'";
       $ejecutar = $conn->prepare($sql_insertar);
       $ejecutar->execute();
       $conn=null;
       
   } catch (Exception $e) {
       echo 'Ocurrio un Error. Mailer Error: ', $mail->ErrorInfo;
       $message ='El correo no es valido';
   } 
  }
?>
