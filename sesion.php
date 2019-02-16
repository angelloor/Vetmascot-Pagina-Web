<?PHP
require 'conexion.php';
$json=array();
	if(isset($_GET["correo"]) && isset($_GET["clave"])){
		$usuario=$_GET['correo'];
		$clave=$_GET['clave'];
		
		$records = $conn->prepare('SELECT correo, clave, nombre FROM usuarios WHERE correo = :correo');
    $records->bindParam(':correo', $_GET['correo']);
    $records->execute();
    $results = $records->fetch(PDO::FETCH_ASSOC);

		if (count($results) > 0 && password_verify($_GET['clave'], $results['clave'])) {
			$json['datos'][]=$results;
			echo json_encode($json);
		}else{
			$results["correo"]='';
			$results["clave"]='';
			$results["nombre"]='';
			$json['datos'][]=$results;
			echo json_encode($json);
	}
}
?>