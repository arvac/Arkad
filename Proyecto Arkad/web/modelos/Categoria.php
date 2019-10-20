<?php 
//Incluímos inicialmente la conexión a la base de datos
require "../config/Conexion.php";

Class Categoria
{
	//Implementamos nuestro constructor
	public function __construct()
	{

	}

	//Implementamos un método para insertar registros
	public function insertar($nombre,$descripcion)
	{
		$sql="INSERT INTO categoria (nombre,descripcion,condicion)
		VALUES ('$nombre','$descripcion','1')";
		return ejecutarConsulta($sql);
	}

	//Implementamos un método para editar registros
	public function editar($idcategoria,$nombre,$descripcion)
	{
		$sql="UPDATE categoria SET nombre='$nombre',descripcion='$descripcion' WHERE idcategoria='$idcategoria'";
		return ejecutarConsulta($sql);
	}

	//Implementamos un método para desactivar categorías
	public function desactivar($idcategoria)
	{
		$sql="UPDATE categoria SET condicion='0' WHERE idcategoria='$idcategoria'";
		return ejecutarConsulta($sql);
	}

	//Implementamos un método para activar categorías
	public function activar($idcategoria)
	{
		$sql="UPDATE categoria SET condicion='1' WHERE idcategoria='$idcategoria'";
		return ejecutarConsulta($sql);
	}

	//Implementar un método para mostrar los datos de un registro a modificar
	public function mostrar($id_cuadrilla)
	{
		//$sql="SELECT * FROM cuadrilla WHERE id_cuadrilla = '$id_administrador'";
	      $sql="SELECT a.cuadrilla_id_cuadrilla, c.nombres, cl.codigo FROM cuadrilla c INNER JOIN asignar a ON c.id_cuadrilla = a.cuadrilla_id_cuadrilla INNER JOIN clientes cl ON cl.id_clientes = a.clientes_id_clientes WHERE id_cuadrilla = '$id_cuadrilla'";
		return ejecutarConsultaSimpleFila($sql);
	}

	//Implementar un método para listar los registros
	public function listar()
	{
		$sql="SELECT c.id_cuadrilla, c.nombres, cl.id_clientes, COUNT(a.id_asignar) as total FROM cuadrilla c INNER JOIN asignar a ON c.id_cuadrilla = a.cuadrilla_id_cuadrilla INNER JOIN clientes cl ON cl.id_clientes = a.clientes_id_clientes WHERE cl.estado_id_estado = '2' GROUP BY a.cuadrilla_id_cuadrilla";
		return ejecutarConsulta($sql);		
	}
	//Implementar un método para listar los registros
	public function listar_cu($id_cuadrilla)
	{
		$sql="SELECT a.cuadrilla_id_cuadrilla, c.nombres, cl.codigo FROM cuadrilla c INNER JOIN asignar a ON c.id_cuadrilla = a.cuadrilla_id_cuadrilla INNER JOIN clientes cl ON cl.id_clientes = a.clientes_id_clientes WHERE id_cuadrilla = '$id_cuadrilla'";
		return ejecutarConsulta($sql);		
	}
	//Implementar un método para listar los registros y mostrar en el select
	public function select()
	{
		$sql="SELECT * FROM categoria where condicion=1";
		return ejecutarConsulta($sql);		
	}
}
/*SELECT c.id_cuadrilla, c.nombres, cl.id_clientes COUNT(a.id_asignar) as total FROM cuadrilla c INNER JOIN asignar a   ON c.id_cuadrilla = a.cuadrilla_id_cuadrilla  INNER JOIN clientes cl ON
cl.id_clientes = a.clientes_id_clientes
GROUP BY c.nombres 

SELECT  cl.codigo ,a.id_asignar cl.id_clientes, COUNT(a.id_asignar) as total FROM clientes cl INNER JOIN asignar a ON cl.id_clientes = a.clientes_id_clientes WHERE cl.estado_id_estado = '2' GROUP BY cl.codigo  consulta para obtener eltablacliente solo losestado id selecionado

consulta para obtener estado id modificados  a utilizar
SELECT c.id_cuadrilla, c.nombres, cl.id_clientes, COUNT(a.id_asignar) as total FROM cuadrilla c INNER JOIN asignar a ON c.id_cuadrilla = a.cuadrilla_id_cuadrilla INNER JOIN clientes cl ON cl.id_clientes = a.clientes_id_clientes WHERE cl.estado_id_estado = '2' GROUP BY a.cuadrilla_id_cuadrilla*/


?>