<?php 
require_once "../modelos/finalizados.php";

$excel=new finalizados();



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
	break;

 		echo json_encode($results);
 		break;
	case 'listar':
		$rspta=$excel->listar();
 		//Vamos a declarar un array
 		$data= Array();

 		while ($reg=$rspta->fetch_object()){
 			$data[]=array(
 				
 				"0"=>$reg->corte,
 				"1"=>$reg->lectura,
 				"2"=>'<img src="../../../slim_prueba/photos/'.$reg->fotos1.'" width="100" height="100">',
 				"3"=>'<img src="../../../slim_prueba/photos/'.$reg->fotos2.'" width="100" height="100">',
 				"4"=>$reg->estado,
 				
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