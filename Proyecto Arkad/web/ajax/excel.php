<?php 
require_once "../modelos/Excel.php";

$excel=new Excel();



switch ($_GET["op"]){
	case 'guardaryeditar':

	break;

	case 'desactivar':
		
 		break;
	break;

	case 'activar':
		
 		break;
	break;

	case 'listar_c':
		$rspta=$excel->listar_c();
 		//Vamos a declarar un array
 		$data= Array();

 		while ($reg=$rspta->fetch_object()){
 			$data[]=array(
 				
 				"0"=>'<input type="checkbox" name="prolangm" value="'.$reg->id_cuadrilla.'"></input>',
 				"1"=>$reg->nombres,
 				"2"=>$reg->direccion,
 				"3"=>$reg->administrador_id_administrador
 		
 				);
 		}
 		$results = array(
 			"sEcho"=>1, //Información para el datatables
 			"iTotalRecords"=>count($data), //enviamos el total registros al datatable
 			"iTotalDisplayRecords"=>count($data), //enviamos el total registros a visualizar
 			"aaData"=>$data);
 		echo json_encode($results);
 		break;
	break;

	case 'listar':
		$rspta=$excel->listar();
 		//Vamos a declarar un array
 		$data= Array();

 		while ($reg=$rspta->fetch_object()){
 			$data[]=array(
 				
 				"0"=>'<input type="checkbox" name="prolang" value="'.$reg->id_clientes.'"></input>',
 				"1"=>$reg->codigo,
 				"2"=>$reg->nombres,
 				"3"=>$reg->cedula,
 				"4"=>$reg->provincia,
 				"5"=>$reg->canton,
 				"6"=>$reg->sector,
 				"7"=>$reg->ruta,
 				"8"=>$reg->secuencia,
 				"9"=>$reg->zona,
 				"10"=>$reg->medidor,
 				"11"=>$reg->estado_id_estado
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