<?PHP
require 'conexion.php';
$json=array();
	if(isset($_GET["nombre"]) && isset($_GET["direccion"]) && isset($_GET["telefono"]) && isset($_GET["correo"]) && isset($_GET["clave"])){
		$nombre = $_GET['nombre'];
    $direccion = $_GET['direccion'];
    $telefono = $_GET['telefono'];
    $correo = $_GET['correo'];
    $clave = password_hash($_GET['clave'], PASSWORD_BCRYPT);
    
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
      $results["respuesta"]='existente';
		  $json['datos'][]=$results;
      echo json_encode($json);
    }else {
      $sql_insertar = "INSERT INTO usuarios(nombre,direccion,telefono,correo,clave) VALUES('$nombre','$direccion','$telefono','$correo','$clave')";
      $ejecutar = $conn->prepare($sql_insertar);
      $ejecutar->execute();
      $conn=null;
		  $results["respuesta"]='registrado';
		  $json['datos'][]=$results;
		  echo json_encode($json);
    }
  }else{
      $results["respuesta"]='false';
		  $json['datos'][]=$results;
		  echo json_encode($json);
  }
?>