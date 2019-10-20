<?php 
require_once "../modelos/administrador.php";

$excel=new administrador();



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
 				
 				"0"=>$reg->id_administrador,
 				"1"=>$reg->nombres,
 				"2"=>$reg->apellidos,
 				"3"=>$reg->usuario,
 				"4"=>$reg->clave,
 				
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