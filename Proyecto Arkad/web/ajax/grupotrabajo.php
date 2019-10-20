<?php 
require_once "../modelos/GrupoTrabajo.php";

$categoria = new GrupoTrabajo();

$id_cuadrilla=isset($_POST["id_cuadrilla"])? limpiarCadena($_POST["id_cuadrilla"]):"";
//$nombres=isset($_POST["nombres"])? limpiarCadena($_POST["nombres"]):"";
//$descripcion=isset($_POST["codigo"])? limpiarCadena($_POST["coidgo"]):"";

switch ($_GET["op"]){
	case 'guardaryeditar':
		
	break;



	case 'mostrar':
		$rspta=$categoria->mostrar_c($id_cuadrilla);
 		//Codificar el resultado utilizando json
 		echo json_encode($rspta);
 		break;
	break;

	case 'listar':
		$rspta=$categoria->listar_cuadrilla();
 		//Vamos a declarar un array
 		$data= Array();

 		while ($reg=$rspta->fetch_object()){
 			$data[]=array(
 				"0"=>'<button class="btn btn-warning" onclick="mostrar('.$reg->id_cuadrilla.')"><i class="fa fa-pencil"></i></button>'.
 					' <button class="btn btn-danger" onclick="desactivar('.$reg->id_cuadrilla.')"><i class="fa fa-close"></i></button>',
 				
 				"1"=>$reg->id_cuadrilla,
 				"2"=>$reg->nombres,
 				"3"=>'<small class="label pull-right bg-red">'.$reg->total.'</small>'
 				);
 		}
 		$results = array(
 			"sEcho"=>1, //Información para el datatables
 			"iTotalRecords"=>count($data), //enviamos el total registros al datatable
 			"iTotalDisplayRecords"=>count($data), //enviamos el total registros a visualizar
 			"aaData"=>$data);
 		echo json_encode($results);

	break;
}
?>


<?php 

