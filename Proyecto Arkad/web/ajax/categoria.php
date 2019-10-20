<?php 
require_once "../modelos/Categoria.php";

$categoria=new Categoria();

$id_cuadrilla=isset($_POST["id_cuadrilla"])? limpiarCadena($_POST["id_cuadrilla"]):"";
$nombres=isset($_POST["nombres"])? limpiarCadena($_POST["nombres"]):"";
$codigo=isset($_POST["codigo"])? limpiarCadena($_POST["codigo"]):"";

switch ($_GET["op"]){


	case 'mostrar':
		$rspta=$categoria->mostrar($id_cuadrilla);
 	echo json_encode($rspta);

	break;
	case 'listarDetalle':
	$id=$_GET['id'];
	$rspta=$categoria->listar_cu($id);

	 
	 echo '<thead style="background-color:#A9D0F5">
                                    <th>Opciones</th>
                                    <th>Artículo</th>
                                    <th>Cantidad</th>
                                      <th>Cantidad</th>
                                </thead>';                                     

		while ($reg = $rspta->fetch_object())
				{
					echo '<tr class="filas"><td></td><td>'.$reg->cuadrilla_id_cuadrilla.'</td><td>'.$reg->nombres.'</td><td>'.$reg->codigo.'</td><td>';
				}


	break;

	case 'listar':
		$rspta=$categoria->listar();
 		//Vamos a declarar un array
 		$data= Array();


 		while ($reg=$rspta->fetch_object()){
 			$data[]=array(
 		"0"=>'<button class="btn btn-warning" onclick="mostrar('.$reg->id_cuadrilla.')"><i class="fa fa-pencil"></i></button>'.
 					' <button class="btn btn-danger" onclick="desactivar('.$reg->id_cuadrilla.')"><i class="fa fa-close"></i></button>',
 				
 				
 				"1"=>$reg->nombres,
 				"2"=>'<small class="label pull-right bg-red">'.$reg->total.'</small>'
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