<?PHP
require 'conexion.php';
$json=array();
	if(isset($_GET["correo"])){
    $correo = $_GET['correo'];
    $result = FALSE;

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
      actualizarPassword($correo);
    }else {
      $mensaje["mensaje"]='Usuario no registrado!!';
      $json['respuesta'][]=$mensaje;
      echo json_encode($json);
      exit();
    } 
  }else{
    $mensaje["mensaje"]='Ingrese el correo!!';
    $json['respuesta'][]=$mensaje;
    echo json_encode($json);
    exit();
}
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
       $mensaje["mensaje"]='Contraseña actualizada!!';
       $json['respuesta'][]=$mensaje;
       echo json_encode($json);
       exit();
   } catch (Exception $e) {
       echo 'Ocurrio un Error. Mailer Error: ', $mail->ErrorInfo;
       $message ='El correo no es valido';
       $mensaje["mensaje"]='Correo electronico incorrecto!!';
       $json['respuesta'][]=$mensaje;
       echo json_encode($json);
       exit();
   } 
  }
?>