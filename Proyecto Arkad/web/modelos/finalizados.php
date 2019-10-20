<?php 
//Incluímos inicialmente la conexión a la base de datos
require "../config/Conexion.php";

Class finalizados
{
	//Implementamos nuestro constructor
	public function __construct()
	{

	}
   //Implementamos un método para insertar registros
	public function insertar($user,$contar)
	{
		//tener pendiente cambiar de ubicacion los parametros
		$sql="INSERT INTO asignar (cuadrilla_id_cuadrilla , clientes_id_clientes)
		VALUES ('$user','$contar')";
		return ejecutarConsulta($sql);
	}
	
	//Implementar un método para listar los registros
	public function listar()
	{
		$sql="SELECT * FROM register ";
		return ejecutarConsulta($sql);		
	}
	public function editar_Estado($contar,$estado)
	{
		$sql="UPDATE clientes SET estado_id_estado='$estado' WHERE id_clientes='$contar'";
		return ejecutarConsulta($sql);		
	}
	public function editar_Estado_c($user,$estado)
	{
		$sql= "UPDATE cuadrilla SET estado_id_estado='$estado' WHERE id_cuadrilla='$user'";
		return ejecutarConsulta($sql);		
	}
	//Implementar un método para listar los registros
	public function listar_c()
	{
		$sql="SELECT * FROM cuadrilla ";
		return ejecutarConsulta($sql);		
	}
}

?>