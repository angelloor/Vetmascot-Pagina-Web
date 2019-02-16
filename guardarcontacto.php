<?PHP
require 'conexion.php';
$json=array();
	if(isset($_GET["correo"]) && isset($_GET["mensaje"])){
    $correo = $_GET['correo'];
    $mensaje = $_GET['mensaje'];
    
    $result=FALSE;

    try {
      $records = $conn->prepare('SELECT nombre, telefono FROM usuarios WHERE correo = :correo');
      $records->bindParam(':correo', $_GET['correo']);
      $records->execute();
      $results = $records->fetch(PDO::FETCH_ASSOC);
      
      $nombre = $results['nombre'];
      $telefono = $results['telefono'];

      $sql_insertar = "INSERT INTO contacto(nombre,correo,telefono,mensaje) VALUES('$nombre','$correo','$telefono','$mensaje')";
      $ejecutar = $conn->prepare($sql_insertar);
      $ejecutar->execute();
      $conn=null;

      $result=TRUE;
     } catch (Exception $e) {
      echo 'Excepción capturada: ',  $e->getMessage(), "\n";
    }
	
		if ($result == TRUE) {
		  $results["respuesta"]='true';
		  $json['datos'][]=$results;
		  echo json_encode($json);
    }else {
      $results["respuesta"]='false';
		  $json['datos'][]=$results;
		  echo json_encode($json);
    }
  }else{
      $results["respuesta"]='ingrese';
		  $json['datos'][]=$results;
		  echo json_encode($json);
  }
?>